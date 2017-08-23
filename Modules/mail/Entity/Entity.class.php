<?php

namespace Modules\mail\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;


class Entity extends EntityClass {
	private $Database,$Query,$TableName;
	public function __construct()
	{
		$this->Database=new dbquery();
		$this->Query=null;
		$this->TableName="";
	}
}
?>
