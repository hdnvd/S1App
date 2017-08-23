<?php

namespace Modules\users\Entity;

use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\DBField;

/**
 *
 * @author nahavandi
 *        
 */
class roleUserEntity extends EntityClass {
private $Database;
	public function __construct()
	{
		$this->Database=new dbquery();
	}
	public function SelectRoleUsers($Fields,$RoleID)
	{
		$Query=$this->Database->Select($Fields)->From(array("user user","role_systemuser su","role_systemuserrole sur"))->Where()
		->Equal("su.id", new DBField("user.role_systemuser_fid",false))->AndLogic()
		->Equal("su.id", new DBField("sur.systemuser_fid",false))->AndLogic()
		->Equal("sur.systemrole_fid", $RoleID);
		return $Query->ExecuteAssociated();
	}
}

?>