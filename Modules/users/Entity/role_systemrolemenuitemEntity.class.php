<?php

namespace Modules\users\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;


class role_systemrolemenuitemEntity extends EntityClass {
	private $Database,$TableName;
	public function __construct()
	{
		$this->Database=new dbquery();
		$this->TableName="role_systemrolemenuitem";
	}
	public function Select(array $Fields,$ID,$LatinTitle,$Link,$SystemRoleID)
	{
		$Query=$this->Database->Select($Fields)->From($this->TableName)->Where()->Equal("isdeleted", 0);
		if(!is_null($ID))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Equal("id", $ID);
		}
		if(!is_null($LatinTitle))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Like("latintitle", $LatinTitle);
		}
		if(!is_null($Link))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Like("link", $Link);
		}
		if(!is_null($SystemRoleID))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Equal("systemrole_fid", $SystemRoleID);
		}
// 		echo $Query->getQueryString();
		return $Query->ExecuteAssociated();
		
	}	
}
?>
