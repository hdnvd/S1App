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
use Modules\onlineclass\Entity\onlineclass_userEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-25 - 2017-10-17 22:27
*@lastUpdate 1396-07-25 - 2017-10-17 22:27
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class manageuserController extends Controller {
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
		$userEntityObject=new onlineclass_userEntity($DBAccessor);
		$result['user']=$userEntityObject;
		if($ID!=-1){
			$userEntityObject->setId($ID);
			if($userEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $userEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['user']=$userEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$fullname,$ismale,$email,$mobile,$registration_time,$devicecode)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$userEntityObject=new onlineclass_userEntity($DBAccessor);
		$this->ValidateFieldArray([$fullname,$ismale,$email,$mobile,$registration_time,$devicecode],[$userEntityObject->getFieldInfo(onlineclass_userEntity::$FULLNAME),$userEntityObject->getFieldInfo(onlineclass_userEntity::$ISMALE),$userEntityObject->getFieldInfo(onlineclass_userEntity::$EMAIL),$userEntityObject->getFieldInfo(onlineclass_userEntity::$MOBILE),$userEntityObject->getFieldInfo(onlineclass_userEntity::$REGISTRATION_TIME),$userEntityObject->getFieldInfo(onlineclass_userEntity::$DEVICECODE)]);
		if($ID==-1){
			$userEntityObject->setFullname($fullname);
			$userEntityObject->setIsmale($ismale);
			$userEntityObject->setEmail($email);
			$userEntityObject->setMobile($mobile);
			$userEntityObject->setRegistration_time($registration_time);
			$userEntityObject->setDevicecode($devicecode);
			$userEntityObject->Save();
		}
		else{
			$userEntityObject->setId($ID);
			if($userEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $userEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$userEntityObject->setFullname($fullname);
			$userEntityObject->setIsmale($ismale);
			$userEntityObject->setEmail($email);
			$userEntityObject->setMobile($mobile);
			$userEntityObject->setRegistration_time($registration_time);
			$userEntityObject->setDevicecode($devicecode);
			$userEntityObject->Save();
		}
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>