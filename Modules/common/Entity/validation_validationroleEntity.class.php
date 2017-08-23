<?php

namespace Modules\common\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;


class validation_validationroleEntity extends EntityClass {
	private $Database,$TableName;
	public function __construct()
	{
		$this->setDatabase(new dbquery());
		$this->setTableName("validation_validationrole");
	}
	public function Select(array $Fields,array $FieldValues)
	{
		$theFields=array();
		for($i=0;$i<count($Fields);$i++)
		{
		$theFields[$i]['name']=$Fields[$i];
		if($i<count($FieldValues))
			$theFields[$i]['value']=$FieldValues[$i];
			else
				$theFields[$i]['value']=null;
		}
		return $this->getSelect(array("*"), $theFields);
	}
}
?>
