<?php
namespace Modules\onlineclass\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\onlineclass\Entity\onlineclass_tutorEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-25 - 2017-10-17 15:53
*@lastUpdate 1396-07-25 - 2017-10-17 15:53
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managetutorController extends Controller {
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
		$tutorEntityObject=new onlineclass_tutorEntity($DBAccessor);
		$result['tutor']=$tutorEntityObject;
		if($ID!=-1){
			$tutorEntityObject->setId($ID);
			if($tutorEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $tutorEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['tutor']=$tutorEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$name,$family)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$tutorEntityObject=new onlineclass_tutorEntity($DBAccessor);
		$this->ValidateFieldArray([$name,$family],[$tutorEntityObject->getFieldInfo(onlineclass_tutorEntity::$NAME),$tutorEntityObject->getFieldInfo(onlineclass_tutorEntity::$FAMILY)]);
		if($ID==-1){
			$tutorEntityObject->setName($name);
			$tutorEntityObject->setFamily($family);
			$tutorEntityObject->Save();
		}
		else{
			$tutorEntityObject->setId($ID);
			if($tutorEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $tutorEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$tutorEntityObject->setName($name);
			$tutorEntityObject->setFamily($family);
			$tutorEntityObject->Save();
		}
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>