<?php

namespace Modules\users\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;


class role_systemtaskEntity extends EntityClass {
	private $Database,$TableName;
	public function __construct()
	{
		$this->setDatabase(new dbquery());
		$this->setTableName("role_systemtask");
	}
	public function Select(array $Fields,array $FieldValues,array $Logics=null)
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
		
		return $this->getSelect(array("*"), $theFields,$Logics);
	}
	public function insert($Module,$Page,$Action)
	{
		$Query=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("module", $Module)
		->Set("page", $Page)
		->Set("action", $Action);
		$Query->Execute();
		return $Query->getInsertedId();
	
	}
}
?>
