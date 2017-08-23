<?php

namespace Modules\users\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;


class role_systemroletaskEntity extends EntityClass {
	private $Database,$TableName;
	public function __construct()
	{
		$this->setDatabase(new dbquery());
		$this->setTableName("role_systemroletask");
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
	public function insert($SystemRole_FID,$SystemTask_FID)
	{
		$Query=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("systemrole_fid", $SystemRole_FID)
		->Set("systemtask_fid", $SystemTask_FID);
		$Query->Execute();
		return $Query->getInsertedId();
	}
	public function Update($ID,$SystemRole_FID,$SystemTask_FID)
	{
		$Query=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("systemrole_fid", $SystemRole_FID)
		->NotNullSet("systemtask_fid", $SystemTask_FID)
		->Where()->Equal("systemroletaskid", $ID);
		$Query->Execute();
		return $Query->getInsertedId();
	}
	public function DeleteRoleTasks($RoleID)
	{
		$this->getDatabase()->Delete($this->getTableName())->Where()->Equal("systemrole_fid", $RoleID)->Execute();
	}
}
?>
