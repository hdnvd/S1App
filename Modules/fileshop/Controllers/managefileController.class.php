<?php
namespace Modules\fileshop\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\common\Entity\common_categoryEntity;
use Modules\fileshop\Entity\fileshop_filecategoryEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\fileshop\Entity\fileshop_fileEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-09 - 2017-11-30 16:33
*@lastUpdate 1396-09-09 - 2017-11-30 16:33
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managefileController extends Controller {
	private $adminMode=true;
    public function getAdminMode()
    {
        return $this->adminMode;
    }
        /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
    }
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$fileEntityObject=new fileshop_fileEntity($DBAccessor);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('file_fid',$ID));
		$CategoryListEntityObject=new common_categoryEntity($DBAccessor);
		$result['categorys']=$CategoryListEntityObject->FindAll(new QueryLogic());
		$result['file']=$fileEntityObject;
		if($ID!=-1){
			$fileEntityObject->setId($ID);
			if($fileEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $fileEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$fileshop_filecategoryEntityEntityObject=new fileshop_filecategoryEntity($DBAccessor);
			$result['filecategorys']=$fileshop_filecategoryEntityEntityObject->FindAll($RelationLogic);
			$result['file']=$fileEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$file_flu,$title,$thumbnail_flu,$add_date,$description,$price,$filecount,$Categorys)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$fileEntityObject=new fileshop_fileEntity($DBAccessor);
		$file_fluURL='';
		if($file_flu!=null && count($file_flu)>0)
			$file_fluURL=$file_flu[0]['url'];
		$thumbnail_fluURL='';
		if($thumbnail_flu!=null && count($thumbnail_flu)>0)
			$thumbnail_fluURL=$thumbnail_flu[0]['url'];
		$this->ValidateFieldArray([$file_fluURL,$title,$thumbnail_fluURL,$add_date,$description,$price,$filecount],[$fileEntityObject->getFieldInfo(fileshop_fileEntity::$FILE_FLU),$fileEntityObject->getFieldInfo(fileshop_fileEntity::$TITLE),$fileEntityObject->getFieldInfo(fileshop_fileEntity::$THUMBNAIL_FLU),$fileEntityObject->getFieldInfo(fileshop_fileEntity::$ADD_DATE),$fileEntityObject->getFieldInfo(fileshop_fileEntity::$DESCRIPTION),$fileEntityObject->getFieldInfo(fileshop_fileEntity::$PRICE),$fileEntityObject->getFieldInfo(fileshop_fileEntity::$FILECOUNT)]);
		if($ID==-1){
			if($file_fluURL!='')
			$fileEntityObject->setFile_flu($file_fluURL);
			$fileEntityObject->setTitle($title);
			if($thumbnail_fluURL!='')
			$fileEntityObject->setThumbnail_flu($thumbnail_fluURL);
			$fileEntityObject->setAdd_date($add_date);
			$fileEntityObject->setDescription($description);
			$fileEntityObject->setPrice($price);
			$fileEntityObject->setFilecount($filecount);
			$fileEntityObject->Save();
			$ID=$fileEntityObject->getId();
		}
		else{
			$fileEntityObject->setId($ID);
			if($fileEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $fileEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			if($file_fluURL!='')
			$fileEntityObject->setFile_flu($file_fluURL);
			$fileEntityObject->setTitle($title);
			if($thumbnail_fluURL!='')
			$fileEntityObject->setThumbnail_flu($thumbnail_fluURL);
			$fileEntityObject->setAdd_date($add_date);
			$fileEntityObject->setDescription($description);
			$fileEntityObject->setPrice($price);
			$fileEntityObject->setFilecount($filecount);
			$fileEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('file_fid',$ID));
		$fileshop_filecategoryEntityObject=new fileshop_filecategoryEntity($DBAccessor);
		$CurrentCategorys=$fileshop_filecategoryEntityObject->FindAll($RelationLogic);
		$CurrentCategorysCount = count($CurrentCategorys);
		for ($i = 0; $i < $CurrentCategorysCount; $i++) {
			if(array_search($CurrentCategorys[$i]->getId(),$CurrentCategorys)===FALSE)
				$CurrentCategorys[$i]->Remove();
			else
			{
				unset($CurrentCategorys[$i]);
				$CurrentCategorys=array_values($CurrentCategorys);
			}
		}
		$CategorysCount = count($Categorys);
		for ($i = 0; $i < $CategorysCount; $i++) {
			$fileshop_filecategoryEntityObject=new fileshop_filecategoryEntity($DBAccessor);
			$fileshop_filecategoryEntityObject->setFile_fid($ID);
			$fileshop_filecategoryEntityObject->setCommon_category_fid($Categorys[$i]);
			$fileshop_filecategoryEntityObject->Save();
		}
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>