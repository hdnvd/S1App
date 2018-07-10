<?php

namespace Modules\files\Entity;

use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;

/**
 *
 * @author nahavandi
 *        
 */
class FileEntity extends EntityClass {
	private $Database,$TableName;
	public function __construct()
	{
		$this->Database=new dbquery();
		$this->TableName="files_file";
	}
	public function Insert($Url,$Title)
	{
		$Query=$this->Database->InsertInto($this->TableName)
		->Set("url", $Url)
		->Set("title",$Title);
		$Query->Execute();
		return $Query->getInsertedId();
	}
	public function Find($Url,$Title)
	{
		$Query=$this->Database->Select("*")->From($this->TableName);
		$isFirst=true;
		if(!is_null($Url))
		{
			if($isFirst)
				$Query=$Query->Where();
			else 
				$Query=$Query->AndLogic();
			$isFirst=false;
			$Query=$Query->Equal("url",$Url);
		}
		if(!is_null($Title))
		{
			if($isFirst)
				$Query=$Query->Where();
			else
				$Query=$Query->AndLogic();
			$isFirst=false;
			$Query=$Query->Equal("title",$Title);
		}
		return $Query->ExecuteAssociated();
	}
}

?>