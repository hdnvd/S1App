<?php
namespace Modules\shift\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\shift\Entity\shift_inputfileEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-24 - 2018-02-13 10:17
*@lastUpdate 1396-11-24 - 2018-02-13 10:17
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageinputfileController extends Controller {
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
		$inputfileEntityObject=new shift_inputfileEntity($DBAccessor);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('inputfile_fid',$ID));
		$result['inputfile']=$inputfileEntityObject;
		if($ID!=-1){
			$inputfileEntityObject->setId($ID);
			if($inputfileEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $inputfileEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['inputfile']=$inputfileEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$upload_time,$systemuser,$file_flu)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$inputfileEntityObject=new shift_inputfileEntity($DBAccessor);
		$file_fluURL='';
		if($file_flu!=null && count($file_flu)>0)
			$file_fluURL=$file_flu[0]['url'];
		$this->ValidateFieldArray([$upload_time,$systemuser,$file_fluURL],[$inputfileEntityObject->getFieldInfo(shift_inputfileEntity::$UPLOAD_TIME),$inputfileEntityObject->getFieldInfo(shift_inputfileEntity::$SYSTEMUSER),$inputfileEntityObject->getFieldInfo(shift_inputfileEntity::$FILE_FLU)]);
		if($ID==-1){
			$inputfileEntityObject->setUpload_time($upload_time);
			$inputfileEntityObject->setSystemuser($systemuser);
			if($file_fluURL!='')
			$inputfileEntityObject->setFile_flu($file_fluURL);
			$inputfileEntityObject->Save();
			$ID=$inputfileEntityObject->getId();
		}
		else{
			$inputfileEntityObject->setId($ID);
			if($inputfileEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $inputfileEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$inputfileEntityObject->setUpload_time($upload_time);
			$inputfileEntityObject->setSystemuser($systemuser);
			if($file_fluURL!='')
			$inputfileEntityObject->setFile_flu($file_fluURL);
			$inputfileEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('inputfile_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>