<?php

namespace Modules\users\Entity;

use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;

/**
 *
 * @author nahavandi
 *        
 */
class RoleRoleAccessEntity extends EntityClass {
	public function getRoleAccess($RoleID,$Module,$Page,$Action)
	{
		
		$Database=new dbquery();
		$Query=$Database->Select("*")->From("role_roleaccess")->Where()->Equal("module", $Module)->AndLogic()->Equal("page", $Page);
		$res=$Query->ExecuteAssociated();
		
		if(is_array($res) && count($res)>0)//If A Record For this Module Page Exists
		{
			$Query=$Database->Select("*")->From("role_roleaccess")->Where()->Equal("roleid", $RoleID)->AndLogic()->Equal("module", $Module)->AndLogic()->Equal("page", $Page)->AndLogic()->Equal("action", $Action);
			$res=$Query->ExecuteAssociated();
			if(is_array($res) && count($res)>0)
				return true;
			else
				return false;
		}
		else 
			return true;
	}
}

?>