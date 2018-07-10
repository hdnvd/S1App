<?php

namespace Modules\products\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;


class products_productgroupEntity extends EntityClass {
	public function __construct()
	{
		$this->setDatabase(new dbquery());
		$this->setTableName("productgroup");
	}
	public function Insert($LanguageID,$Title,$LatinTitle,$MotherID)
	{
		$Query=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("language_fid", $LanguageID)
		->Set("mother_fid", $MotherID)
		->Set("latintitle", $LatinTitle)
		->Set("title", $Title);
		$Query->Execute();
		return $Query->getInsertedId();	
	}
	public function Update($ID,$MotherID,$LanguageID,$Title,$LatinTitle,$IsDeleted)
	{
		$Query=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("mother_fid", $MotherID)
		->NotNullSet("language_fid", $LanguageID)
		->NotNullSet("latintitle", $LatinTitle)
		->NotNullSet("title", $Title)
		->NotNullSet("isdeleted", $IsDeleted)
		->Where()->Equal("id", $ID);
// 		echo $Query->getQueryString();
		$Query->Execute();
		return true;
	}
	public function Select($ID,$MotherID,$LanguageID,$Title,$LatinTitle,$ShowInMenu,$Limit,$Orders,$IsDescendings)
	{
		$Query=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("isdeleted", "0");
		if($ID!==null)
			$Query=$Query->AndLogic()->Equal("id", $ID);
		if($MotherID!==null)
			$Query=$Query->AndLogic()->Equal("mother_fid", $MotherID);
		if($LanguageID!==null)
			$Query=$Query->AndLogic()->Equal("language_fid", $LanguageID);
		if($Title!==null)
			$Query=$Query->AndLogic()->Like("title", $Title);
		if($LatinTitle!==null)
			$Query=$Query->AndLogic()->Like("latintitle", $LatinTitle);
		if($ShowInMenu!==null)
			$Query=$Query->AndLogic()->Equal("showinmenu", $ShowInMenu);
		$Query=$Query->AndLogic()->Like("isdeleted", "0");
//  		echo $Query->getQueryString();
		return $Query->ExecuteAssociated();
	}
}
?>
