<?php
namespace Modules\ocms\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\ocms\Entity\ocms_userEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-23 - 2017-12-14 01:18
*@lastUpdate 1396-09-23 - 2017-12-14 01:18
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
		$userEntityObject=new ocms_userEntity($DBAccessor);
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
	public function BtnSave($ID,$name,$family,$born_date,$mobile,$device_id,$email,$ismale)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$userEntityObject=new ocms_userEntity($DBAccessor);
		$this->ValidateFieldArray([$name,$family,$born_date,$mobile,$device_id,$email,$ismale],[$userEntityObject->getFieldInfo(ocms_userEntity::$NAME),$userEntityObject->getFieldInfo(ocms_userEntity::$FAMILY),$userEntityObject->getFieldInfo(ocms_userEntity::$BORN_DATE),$userEntityObject->getFieldInfo(ocms_userEntity::$MOBILE),$userEntityObject->getFieldInfo(ocms_userEntity::$DEVICE_ID),$userEntityObject->getFieldInfo(ocms_userEntity::$EMAIL),$userEntityObject->getFieldInfo(ocms_userEntity::$ISMALE)]);
		if($ID==-1){
			$userEntityObject->setName($name);
			$userEntityObject->setFamily($family);
			$userEntityObject->setBorn_date($born_date);
			$userEntityObject->setMobile($mobile);
			$userEntityObject->setDevice_id($device_id);
			$userEntityObject->setEmail($email);
			$userEntityObject->setIsmale($ismale);
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
			$userEntityObject->setBorn_date($born_date);
			$userEntityObject->setMobile($mobile);
			$userEntityObject->setDevice_id($device_id);
			$userEntityObject->setEmail($email);
			$userEntityObject->setIsmale($ismale);
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