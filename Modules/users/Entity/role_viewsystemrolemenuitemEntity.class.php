<?php

namespace Modules\users\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;


class role_viewsystemrolemenuitemEntity extends EntityClass {
	private $Database,$TableName;
	public function __construct()
	{
		$this->Database=new dbquery();
		$this->TableName="role_menuitem";
	}
	public function Select(array $Fields,$ID,$LatinTitle,$Module,$Page,$Parameters)
	{
		$Query=$this->Database->Select($Fields)->From($this->TableName)->Where()->Smaller("deletetime", 1);
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
		if(!is_null($Module))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Like("module", $Module);
		}

		if(!is_null($Page))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Like("page", $Page);
		}
		if(!is_null($Parameters))
		{
		    $Query=$Query->AndLogic();
		    $Query=$Query->Like("parameters", $Parameters);
		}
 		//echo $Query->getQueryString();
		return $Query->ExecuteAssociated();
		
	}	
}
?>
