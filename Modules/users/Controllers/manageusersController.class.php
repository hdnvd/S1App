<?php

namespace Modules\users\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\Entity\role_userinfostatusEntity;
use Modules\users\Entity\roleSystemRoleEntity;
use Modules\users\Entity\userEntity;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 1395/3/1 - 2016/05/21 20:34:37
 *@lastUpdate 1395/3/1 - 2016/05/21 20:34:37
 *@SweetFrameworkHelperVersion 1.112
*/


class manageusersController extends Controller {
	public function load()
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
		$FieldStatusEnt=new role_userinfostatusEntity();
		$EnabledFields=$FieldStatusEnt->Select(null, null, null, '1', array(), array(), "0,150");
		$result['enabledfields']=$EnabledFields;
		$UserEnt=new userEntity();
		$result['users']=$UserEnt->Select(array("*"), null, null, null, null, null, null, null, null, null, null, null, null, null, null);
		$RoleEnt=new roleSystemRoleEntity();
		$result['roles']=$RoleEnt->Select(array(), array());
		$DBAccessor->close_connection();
		return $result;
	}
}
?>
