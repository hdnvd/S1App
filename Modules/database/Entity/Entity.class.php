<?php

namespace Modules\database\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;


class Entity extends EntityClass {
	private $Database,$TableName;
	public function __construct()
	{
		$this->setDatabase(new dbquery());
		$this->setTableName("");
	}
}
?>
