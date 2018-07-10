<?php

namespace Modules\users\Controllers;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\services\Controller;
use Modules\users\Entity\users_menuitemEntity;
use Modules\users\PublicClasses\sessionuser;
use Modules\users\PublicClasses\User;


class usermenuController extends Controller {
	public function load()
	{

        $dbaccess=new dbaccess();
		$Su=new sessionuser();
		$ID=$Su->getSystemUserID();
		$User=new User($ID);
		$SystemRoleIDs=$User->getSystemUserRoles();
		$SystemRoleID=-1;
		if(!is_null($SystemRoleIDs))
			$SystemRoleID=$SystemRoleIDs[0];
		$roleMenuE=new users_menuitemEntity($dbaccess);
		
		$result['menuitems']=$roleMenuE->FindAll(new QueryLogic([],[users_menuitemEntity::$PRIORITY],[true]));
        $dbaccess->close_connection();
		return $result;
	}
}
?>
