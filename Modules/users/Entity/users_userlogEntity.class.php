<?php

namespace Modules\users\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;


class users_userlogEntity extends EntityClass {
	private $Database,$TableName;
	public function __construct()
	{
		$this->Database=new dbquery();
		$this->TableName="users_userlog";
	}
	public function Insert($systemUserID,$Module,$Page,$Action,$Time)
	{
		$Query=$this->Database->InsertInto($this->TableName)
		->Set("role_systemuser_fid", $systemUserID)
		->Set("module", $Module)
		->Set("page", $Page)
		->Set("action", $Action)
		->Set("time", $Time);
		$Query->Execute();
		return $Query->getInsertedId();
	}
}
?>
