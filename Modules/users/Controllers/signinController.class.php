<?php

namespace Modules\users\Controllers;

use core\CoreClasses\services\Controller;
use Modules\users\Entity\userEntity;
use Modules\users\Entity\roleSystemUserEntity;
use Modules\users\Entity\roleSystemRoleEntity;
use Modules\users\Entity\RoleSystemUserRoleEntity;
use Modules\parameters\PublicClasses\ParameterManager;

/**
 *
 * @author nahavandi
 *        
 */
class signinController extends Controller {
    public function load()
    {
        $result['showsignup']=ParameterManager::getParameter("users_showsignuplink");
        $result['signupmodule']=ParameterManager::getParameter("users_signupmodule");
        $result['signuppage']=ParameterManager::getParameter("users_signuppage");
        if($result['showsignup']==null || $result['showsignup']!=true)
            $result['showsignup']=false;
        return $result;
    }
	public function getUserID($Username,$Password)
	{
		$ent=new roleSystemUserEntity();
		$isTrue=$ent->checkUserPass($Username, $Password);
		if($isTrue)
			return $ent->getUserId($Username);
		else 
			return null;
	}
	public function getUserIDWithSecondPass($Username,$Password)
	{
		$ent=new roleSystemUserEntity();
		$isTrue=$ent->checkSecondUserPass($Username, $Password);
		if($isTrue)
			return $ent->getUserId($Username);
		else
			return null;
	}
	public function getUserIndex($SystemUserID)
	{
		$ent1=new RoleSystemUserRoleEntity();
		$Userrole=$ent1->getUserRole($SystemUserID);
		$ent=new roleSystemRoleEntity();
		//print_r($Userrole);
		$role=$ent->Select(array("id"), array($Userrole[0]['roleid']));

		$result['module']=$role[0]['defaultmodule'];
		$result['page']=$role[0]['defaultpage'];
		$result['parameters']=$role[0]['indexparameters'];
		//print_r($result);
		return $result;
	}
	
}

?>