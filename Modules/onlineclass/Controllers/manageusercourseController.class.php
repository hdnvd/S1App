<?php
namespace Modules\onlineclass\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\Entity\users_userEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\onlineclass\Entity\onlineclass_usercourseEntity;
use Modules\onlineclass\Entity\onlineclass_userEntity;
use Modules\onlineclass\Entity\onlineclass_courseEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-26 - 2017-10-18 16:38
*@lastUpdate 1396-07-26 - 2017-10-18 16:38
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class manageusercourseController extends Controller {
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
		$usercourseEntityObject=new onlineclass_usercourseEntity($DBAccessor);
			$userEntityObject=new users_userEntity($DBAccessor);
			$result['user_fid']=$userEntityObject->FindAll(new QueryLogic());
			$courseEntityObject=new onlineclass_courseEntity($DBAccessor);
			$result['course_fid']=$courseEntityObject->FindAll(new QueryLogic());
		$result['usercourse']=$usercourseEntityObject;
		if($ID!=-1){
			$usercourseEntityObject->setId($ID);
			if($usercourseEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $usercourseEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['usercourse']=$usercourseEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$user_fid,$course_fid,$add_time)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$usercourseEntityObject=new onlineclass_usercourseEntity($DBAccessor);
		$this->ValidateFieldArray([$user_fid,$course_fid,$add_time],[$usercourseEntityObject->getFieldInfo(onlineclass_usercourseEntity::$USER_FID),$usercourseEntityObject->getFieldInfo(onlineclass_usercourseEntity::$COURSE_FID),$usercourseEntityObject->getFieldInfo(onlineclass_usercourseEntity::$ADD_TIME)]);
		if($ID==-1){
			$usercourseEntityObject->setUser_fid($user_fid);
			$usercourseEntityObject->setCourse_fid($course_fid);
			$usercourseEntityObject->setAdd_time($add_time);
			$usercourseEntityObject->Save();
		}
		else{
			$usercourseEntityObject->setId($ID);
			if($usercourseEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $usercourseEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$usercourseEntityObject->setUser_fid($user_fid);
			$usercourseEntityObject->setCourse_fid($course_fid);
			$usercourseEntityObject->setAdd_time($add_time);
			$usercourseEntityObject->Save();
		}
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>