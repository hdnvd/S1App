<?php

namespace Modules\pages\Entity;

use core\CoreClasses\services\EntityClass;
use Modules\pages\EntityObjects\pageEntityObject;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\WhereClause;

class pageEntity extends EntityClass {
	private $obj;
	public function __construct(pageEntityObject $obj=null)
	{
		$this->obj=$obj;
	}
	public function addPage($Name,$Title,$Content,$Language,$Date,$Thumb,$IsPublished)
	{
		$Database=new dbquery();
		$InsertQuery=$Database->InsertInto("page")
		->Set("name", $Name)
		->Set("title", $Title)
		->Set("content",$Content)
		->Set("language_fid", $Language)
		->Set("date",$Date)
		->Set("thumb",$Thumb)
		->Set("isdeleted", 0)
		->Set("ispublished", $IsPublished);
		$InsertQuery->Execute();	
		$pageId=$InsertQuery->getInsertedId();
		return $pageId;
	}
	public function Update($ID,$Name=null,$Title=null,$Content=null,$Language=null,$Date=null,$Thumb=null,$IsPublished=null,$IsDeleted=null)
	{
		$Database=new dbquery();
		$UpdateQuery=$Database->Update("page")
		->NotNullSet("name", $Name)
		->NotNullSet("title", $Title)
		->NotNullSet("content",$Content)
		->NotNullSet("language_fid", $Language)
		->NotNullSet("date",$Date)
		->NotNullSet("thumb",$Thumb)
		->NotNullSet("isdeleted", $IsDeleted)
		->NotNullSet("ispublished", $IsPublished)
		->Where()->Equal("id", $ID);
// 		echo $UpdateQuery->getQueryString();
		$UpdateQuery->Execute();
		return true;
	}
	
	public function loadPage($PageID)
	{
		$Database=new dbquery();
		$Query=$InsertQuery=$Database->Select("*")->From("page")->Where()->Equal("id", $PageID);
		$result=$Query->ExecuteAssociated();
		return $result;
	}
}

?>