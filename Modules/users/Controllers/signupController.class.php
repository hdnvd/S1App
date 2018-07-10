<?php

namespace Modules\users\Controllers;

use core\CoreClasses\db\dbaccess;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\services\Controller;
use Modules\users\Entity\studentLevelEntity;
use Modules\users\Entity\roleSystemUserEntity;
use Modules\users\Entity\users_systemroleEntity;
use Modules\users\Entity\users_systemuserroleEntity;
use Modules\users\Entity\users_userEntity;
use Modules\users\Entity\users_userinfostatusEntity;
use Modules\users\Exceptions\usernameexists;
use Modules\users\Exceptions\UsernameExistsException;
use Modules\users\PublicClasses\User;

/**
 *
 * @author nahavandi
 *        
 */
class signupController extends Controller {
	public function load()
	{
        $DBAccessor=new dbaccess();
	    $FieldStatusEnt=new users_userinfostatusEntity($DBAccessor);
	    $EnabledFields=$FieldStatusEnt->FindAll(new QueryLogic([new FieldCondition(users_userinfostatusEntity::$ISENABLED,1)]));
	    $r['enabledfields']=$EnabledFields;
		$RoleEnt=new users_systemroleEntity($DBAccessor);
		$r['roles']=$RoleEnt->FindAll(new QueryLogic());
        $DBAccessor->close_connection();
		return $r;
	}
	/**
	 * @param Boolean $ismale
	 * @param string $father
	 * @param string $postalcode
	 * @param string $name
	 * @param string $family
	 * @param string $tel
	 * @param string $mobile
	 * @param string $mail
	 * @param string $username
	 * @param string $password
	 * @return Boolean IsSuccessful
	 */
	public function signup($ismale,$name,$family,$mobile,$mail,$username,$password,$profilepictureURL,$Role,$AdditionalFields)
	{
        $DBAccessor=new dbaccess();
		$sysuserid=User::addUser($username,$password,$DBAccessor);
		if($sysuserid>0)
		{
			$userroleEnt=new users_systemuserroleEntity($DBAccessor);
			$oldRecords=$userroleEnt->FindAll(new QueryLogic([new FieldCondition(users_systemuserroleEntity::$SYSTEMUSER_FID,$sysuserid)]));
			if($oldRecords!=null)
            {
                $AllCount1 = count($oldRecords);
                for ($i = 0; $i < $AllCount1; $i++) {
                    $oldRecords[$i]->Remove();
                }
            }
			$userroleEnt->setSystemuser_fid($sysuserid);
			$userroleEnt->setSystemrole_fid($Role);
			$userroleEnt->Save();
			$sysuserroleid=$userroleEnt->getId();
			if($sysuserroleid!=-1)
			{
				$userEnt=new users_userEntity($DBAccessor);
				$userEnt->setRole_systemuser_fid($sysuserid);
                $userEnt->setName($name);
                $userEnt->setFamily($family);
                $userEnt->setMobile($mobile);
                $userEnt->setMail($mail);
                $userEnt->setProfilepicture($profilepictureURL);
                    $FieldNames=array_keys($AdditionalFields);
                    for($i=0;$i<count($FieldNames);$i++)
                    {
                        $methodName="set" . ucfirst($FieldNames[$i]);
                        $userEnt->$methodName($AdditionalFields[$FieldNames[$i]]);
                    }
                $DBAccessor->close_connection();
				if($userEnt->getId()!=-1)
					return false;
				else 
					return true;
			}
			else 
				return false;
		}
		else
			return false;
	}
	
}

?>