<?php

namespace Modules\users\Controllers;
use core\CoreClasses\services\Controller;
use Modules\users\Entity\role_systemrolemenuitemEntity;
use Modules\users\PublicClasses\sessionuser;
use Modules\users\PublicClasses\User;
use Modules\users\Entity\role_viewsystemrolemenuitemEntity;


class usermenuController extends Controller {
	public function load()
	{
		
		$Su=new sessionuser();
		$ID=$Su->getSystemUserID();
		$User=new User($ID);
		$SystemRoleIDs=$User->getSystemUserRoles();
		$SystemRoleID=-1;
		if(!is_null($SystemRoleIDs))
			$SystemRoleID=$SystemRoleIDs[0];
		$roleMenuE=new role_viewsystemrolemenuitemEntity();
		
		$result['menuitems']=$roleMenuE->Select(array("*"), null, null, null,null,null);
		return $result;
	}
}
?>
