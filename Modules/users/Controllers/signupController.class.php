<?php

namespace Modules\users\Controllers;

use core\CoreClasses\services\Controller;
use Modules\users\Entity\userEntity;
use Modules\users\Entity\studentLevelEntity;
use Modules\users\Entity\RoleSystemUserRoleEntity;
use Modules\users\Entity\roleSystemUserEntity;
use Modules\users\Entity\roleSystemRoleEntity;
use Modules\users\Entity\role_userinfostatusEntity;
use Modules\users\Exceptions\usernameexists;
use Modules\users\Exceptions\UsernameExistsException;

/**
 *
 * @author nahavandi
 *        
 */
class signupController extends Controller {
	public function load()
	{
	    $FieldStatusEnt=new role_userinfostatusEntity();
	    $EnabledFields=$FieldStatusEnt->Select(null, null, null, '1', array(), array(), "0,150");
	    $r['enabledfields']=$EnabledFields;
		$RoleEnt=new roleSystemRoleEntity();
		$r['roles']=$RoleEnt->Select(array(), array());
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
		$RoleSysUserEnt=new roleSystemUserEntity();
		$Co_users=$RoleSysUserEnt->Select(array("username"), array($username));
		if(count($Co_users)>0)
		    throw new UsernameExistsException();
		$sysuserid=$RoleSysUserEnt->Add($username, $password);
		if($sysuserid>0)
		{
			$userroleEnt=new RoleSystemUserRoleEntity();
			$sysuserroleid=$userroleEnt->addUserRole($sysuserid, $Role);
			if($sysuserroleid!=-1)
			{
				$userEnt=new userEntity();
				$result=$userEnt->AddUser($sysuserid,$ismale, $name, $family, $mobile, $mail, $username, $password,$profilepictureURL,$AdditionalFields);
				if($result!=-1)
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