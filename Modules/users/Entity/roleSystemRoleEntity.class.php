<?php

namespace Modules\users\Entity;

use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;

/**
 *
 * @author nahavandi
 *        
 */
class roleSystemRoleEntity extends EntityClass {
	public function __construct()
	{
		$this->setDatabase(new dbquery());
		$this->setTableName("role_systemrole");
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
	public function insert($Title,$DefaultModule,$DefaultPage)
	{
		$Query=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("title", $Title)
		->Set("defaultmodule", $DefaultModule)
		->Set("defaultpage", $DefaultPage);
		$Query->Execute();
		return $Query->getInsertedId();
	
	}
}

?>