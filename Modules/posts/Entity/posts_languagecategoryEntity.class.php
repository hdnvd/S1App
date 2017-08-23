<?php

namespace Modules\posts\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;


class posts_languagecategoryEntity extends EntityClass {
	private $Database,$TableName;
	public function __construct()
	{
		$this->Database=new dbquery();
		$this->TableName="posts_languagecategory";
		parent::__construct($this->Database,$this->TableName);
	}
	public function Insert($LanguageID,$Title,$Latintitle,$MotherID)
	{
		$Query=$this->Database->InsertInto($this->TableName)
		->Set("language_fid", $LanguageID)
		->Set("title", $Title)
		->Set("latintitle", $Latintitle)
		->Set("mother_fid", $MotherID)
		->Set("isdeleted", '0');
		$Query->Execute();
		return $Query->getInsertedId();
	}
	public function Update($ID,$LanguageID,$Title,$Latintitle,$MotherID)
	{
		$Database=new dbquery();
		$Query=$Database->Update($this->TableName)
		->NotNullSet("language_fid", $LanguageID)
		->NotNullSet("title", $Title)
		->NotNullSet("latintitle", $Latintitle)
		->NotNullSet("mother_fid", $MotherID)
		
		->Where()
		->Equal("id", $ID);
		return $Query->Execute();
	}
	public function Delete($ID)
	{
		$Query=$this->Database->Update($this->TableName)
		->Set("isdeleted",1)
		->Where()
		->Equal("id", $ID)->Execute();
		return true;
	}
	public function Select(array $Fields,$ID,$LanguageID,$Title,$Latintitle,$MotherID)
	{
		$Query=$this->Database->Select($Fields)->From($this->TableName)->Where()->Equal("isdeleted", 0);
		if(!is_null($ID))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Equal("id", $ID);
		}
		if(!is_null($LanguageID))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Equal("language_fid", $LanguageID);
		}
		if(!is_null($Title))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Like("title", $Title);
		}
		if(!is_null($Latintitle))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Like("latintitle", $Latintitle);
		}
		if(!is_null($MotherID))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Equal("mother_fid", $MotherID);
		}
// 		echo $Query->getQueryString();
		return $Query->ExecuteAssociated();
	
	}
}
?>
