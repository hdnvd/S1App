<?php
namespace Modules\users\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\users\Entity\users_userEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-15 - 2018-02-04 12:42
*@lastUpdate 1396-11-15 - 2018-02-04 12:42
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
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
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('user_fid',$ID));
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
	public function BtnSave($ID,$name,$family,$mail,$mobile,$ismale,$profilepicture,$additionalfield1,$additionalfield2,$additionalfield3,$additionalfield4,$additionalfield5,$additionalfield6,$additionalfield7,$additionalfield8,$additionalfield9,$signup_time)
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
		$this->ValidateFieldArray([$name,$family,$mail,$mobile,$ismale,$profilepicture,$additionalfield1,$additionalfield2,$additionalfield3,$additionalfield4,$additionalfield5,$additionalfield6,$additionalfield7,$additionalfield8,$additionalfield9,$signup_time],[$userEntityObject->getFieldInfo(users_userEntity::$NAME),$userEntityObject->getFieldInfo(users_userEntity::$FAMILY),$userEntityObject->getFieldInfo(users_userEntity::$MAIL),$userEntityObject->getFieldInfo(users_userEntity::$MOBILE),$userEntityObject->getFieldInfo(users_userEntity::$ISMALE),$userEntityObject->getFieldInfo(users_userEntity::$PROFILEPICTURE),$userEntityObject->getFieldInfo(users_userEntity::$ADDITIONALFIELD1),$userEntityObject->getFieldInfo(users_userEntity::$ADDITIONALFIELD2),$userEntityObject->getFieldInfo(users_userEntity::$ADDITIONALFIELD3),$userEntityObject->getFieldInfo(users_userEntity::$ADDITIONALFIELD4),$userEntityObject->getFieldInfo(users_userEntity::$ADDITIONALFIELD5),$userEntityObject->getFieldInfo(users_userEntity::$ADDITIONALFIELD6),$userEntityObject->getFieldInfo(users_userEntity::$ADDITIONALFIELD7),$userEntityObject->getFieldInfo(users_userEntity::$ADDITIONALFIELD8),$userEntityObject->getFieldInfo(users_userEntity::$ADDITIONALFIELD9),$userEntityObject->getFieldInfo(users_userEntity::$SIGNUP_TIME)]);
		if($ID==-1){
			$userEntityObject->setName($name);
			$userEntityObject->setFamily($family);
			$userEntityObject->setMail($mail);
			$userEntityObject->setMobile($mobile);
			$userEntityObject->setIsmale($ismale);
			$userEntityObject->setProfilepicture($profilepicture);
			$userEntityObject->setAdditionalfield1($additionalfield1);
			$userEntityObject->setAdditionalfield2($additionalfield2);
			$userEntityObject->setAdditionalfield3($additionalfield3);
			$userEntityObject->setAdditionalfield4($additionalfield4);
			$userEntityObject->setAdditionalfield5($additionalfield5);
			$userEntityObject->setAdditionalfield6($additionalfield6);
			$userEntityObject->setAdditionalfield7($additionalfield7);
			$userEntityObject->setAdditionalfield8($additionalfield8);
			$userEntityObject->setAdditionalfield9($additionalfield9);
			$userEntityObject->setSignup_time($signup_time);
			$userEntityObject->Save();
			$ID=$userEntityObject->getId();
		}
		else{
			$userEntityObject->setId($ID);
			if($userEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $userEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$userEntityObject->setName($name);
			$userEntityObject->setFamily($family);
			$userEntityObject->setMail($mail);
			$userEntityObject->setMobile($mobile);
			$userEntityObject->setIsmale($ismale);
			$userEntityObject->setProfilepicture($profilepicture);
			$userEntityObject->setAdditionalfield1($additionalfield1);
			$userEntityObject->setAdditionalfield2($additionalfield2);
			$userEntityObject->setAdditionalfield3($additionalfield3);
			$userEntityObject->setAdditionalfield4($additionalfield4);
			$userEntityObject->setAdditionalfield5($additionalfield5);
			$userEntityObject->setAdditionalfield6($additionalfield6);
			$userEntityObject->setAdditionalfield7($additionalfield7);
			$userEntityObject->setAdditionalfield8($additionalfield8);
			$userEntityObject->setAdditionalfield9($additionalfield9);
			$userEntityObject->setSignup_time($signup_time);
			$userEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('user_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>