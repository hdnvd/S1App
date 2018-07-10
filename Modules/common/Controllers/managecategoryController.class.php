<?php
namespace Modules\common\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\common\Entity\common_categoryEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-12 - 2017-12-03 02:52
*@lastUpdate 1396-09-12 - 2017-12-03 02:52
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managecategoryController extends Controller {
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
		$categoryEntityObject=new common_categoryEntity($DBAccessor);
		$categoryEntityObject=new common_categoryEntity($DBAccessor);
		$result['category_fid']=$categoryEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('category_fid',$ID));
		$result['category']=$categoryEntityObject;
		if($ID!=-1){
			$categoryEntityObject->setId($ID);
			if($categoryEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $categoryEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['category']=$categoryEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title,$latintitle,$category_fid)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$categoryEntityObject=new common_categoryEntity($DBAccessor);
		$this->ValidateFieldArray([$title,$latintitle,$category_fid],[$categoryEntityObject->getFieldInfo(common_categoryEntity::$TITLE),$categoryEntityObject->getFieldInfo(common_categoryEntity::$LATINTITLE),$categoryEntityObject->getFieldInfo(common_categoryEntity::$CATEGORY_FID)]);
		if($ID==-1){
			$categoryEntityObject->setTitle($title);
			$categoryEntityObject->setLatintitle($latintitle);
			$categoryEntityObject->setCategory_fid($category_fid);
			$categoryEntityObject->Save();
			$ID=$categoryEntityObject->getId();
		}
		else{
			$categoryEntityObject->setId($ID);
			if($categoryEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $categoryEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$categoryEntityObject->setTitle($title);
			$categoryEntityObject->setLatintitle($latintitle);
			$categoryEntityObject->setCategory_fid($category_fid);
			$categoryEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('category_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>