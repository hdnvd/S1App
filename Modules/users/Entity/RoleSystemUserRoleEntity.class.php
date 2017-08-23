<?php

namespace Modules\users\Entity;

use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;

/**
 *
 * @author nahavandi
 *        
 */
class RoleSystemUserRoleEntity extends EntityClass {
	public function addUserRole($sysuserid,$sysroleid)
	{
		$Database=new dbquery();
		$Query=$Database->InsertInto("role_systemuserrole")
		->Set("systemuser_fid", $sysuserid)
		->Set("systemrole_fid", $sysroleid);
// 		echo $Query->getQueryString();
		$Query->Execute();
	}
	public function getUserRole($SystemUserID)
	{
		$Database=new dbquery();
		$Query=$Database->Select("systemrole_fid as roleid")->from("role_systemuserrole")->Where()->Equal("systemuser_fid", $SystemUserID);
// 		echo $Query->getQueryString();
		$result=$Query->ExecuteAssociated();
		return $result;
	}
	public function update($roleid,$userid)
	{
		$Database=new dbquery();
		$Database->Update("role_systemuserrole")
		->Set("systemrole_fid", $roleid)
		->Where()
		->Equal("systemuser_fid", $userid)->Execute();
	}
}

?>