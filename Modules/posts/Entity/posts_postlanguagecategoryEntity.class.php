<?php

namespace Modules\posts\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;


class posts_postlanguagecategoryEntity extends EntityClass {
	private $Database,$TableName;
	public function __construct(dbaccess $DBAccessor=null)
	{
	    if($DBAccessor===null)
		  $this->Database=new dbquery();
	    else 
	        $this->Database=new dbquery($DBAccessor);
		$this->TableName="posts_postlanguagecategory";
	}
	public function Insert($PostID,$LanguageCategoryID)
	{
		$Query=$this->Database->InsertInto($this->TableName)
		->Set("isdeleted", 0)
		->Set("post_fid", $PostID)
		->Set("languagecategory_fid", $LanguageCategoryID);
		$Query->Execute();
		return $Query->getInsertedId();
	}
	public function Update($ID,$PostID,$LanguageCategoryID)
	{
		 $Query=$this->Database->Update($this->TableName)
		->NotNullSet("post_fid", $PostID)
		->NotNullSet("languagecategory_fid", $LanguageCategoryID)
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
	public function Select(array $Fields,$ID,$PostID,$LanguageCategoryID)
	{
		$Query=$this->Database->Select($Fields)->From($this->TableName)->Where()->Equal("isdeleted", 0);
		if(!is_null($ID))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Equal("id", $ID);
		}
		if(!is_null($PostID))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Equal("post_fid", $PostID);
		}
		if(!is_null($LanguageCategoryID))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Equal("languagecategory_fid", $LanguageCategoryID);
		}
		return $Query->ExecuteAssociated();
	
	}
}
?>
