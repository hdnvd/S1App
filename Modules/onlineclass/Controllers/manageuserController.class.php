<?php
namespace Modules\onlineclass\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\Entity\users_userEntity;
use Modules\users\PublicClasses\sessionuser;
use Modules\users\PublicClasses\User;

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
		$userEntityObject=new users_userEntity($DBAccessor);
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
	public function BtnSave($ID,$fullname,$ismale,$email,$mobile,$registration_time,$devicecode,$username,$password)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();

		$userEntityObject=new users_userEntity($DBAccessor);
		$this->ValidateFieldArray([$fullname,$ismale,$email,$mobile,$registration_time,$devicecode],[$userEntityObject->getFieldInfo(users_userEntity::$FAMILY),$userEntityObject->getFieldInfo(users_userEntity::$ISMALE),$userEntityObject->getFieldInfo(users_userEntity::$MAIL),$userEntityObject->getFieldInfo(users_userEntity::$MOBILE),$userEntityObject->getFieldInfo(users_userEntity::$SIGNUP_TIME),$userEntityObject->getFieldInfo(users_userEntity::$ADDITIONALFIELD1)]);
		if($ID==-1){

            $DBAccessor->beginTransaction();
            $NewUserID=User::addUser($username,$password);
            User::setUserRole($NewUserID,5);
			$userEntityObject->setFamily($fullname);
			$userEntityObject->setIsmale($ismale);
			$userEntityObject->setMail($email);
			$userEntityObject->setMobile($mobile);
			$userEntityObject->setSignup_time($registration_time);
			$userEntityObject->setAdditionalfield1($devicecode);
			$userEntityObject->setRole_systemuser_fid($NewUserID);
			$userEntityObject->Save();
			$DBAccessor->commit();
		}
		else{
			$userEntityObject->setId($ID);
			if($userEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $userEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$userEntityObject->setFamily($fullname);
			$userEntityObject->setIsmale($ismale);
			$userEntityObject->setMail($email);
			$userEntityObject->setMobile($mobile);
			$userEntityObject->setSignup_time($registration_time);
			$userEntityObject->setAdditionalfield1($devicecode);
			$userEntityObject->Save();
		}
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>