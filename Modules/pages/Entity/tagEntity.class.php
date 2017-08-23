<?php

namespace Modules\pages\Entity;

use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\TableField;
use core\CoreClasses\db\DBField;

/**
 *
 * @author Hadi Nahavandi
 * @version 0.1
 * @lastupdate 2014/May/15
 *        
 */
class tagEntity extends EntityClass {
	private $tags,$contentID;
	private $relationTable;
	
	/**
	 */
	function __construct($contentID) 
	{
		$this->contentID=$contentID;
	}
	public function setTags($Tags)
	{
		$tagsArray=preg_split("/,/", $Tags);
		$this->tags=$tagsArray;
	}
	/*
	 * sets Relation Table
	 * For Example When This Is Tags Of A Page The Relation Table Is Pagestag and When this is Tags of A Product The Relation Table Is producttags.
	 */
	protected function setRelationTable($TableName)
	{
		$this->relationTable=$TableName;
	}
	public function addTags()
	{
// 		echo "adding!";
		$Database=new dbquery();
		$tagsCount=count($this->tags);
		for($i=0;$i<$tagsCount;$i++)
		{
			$result=$Database->Select("*")->From("tag")->Where()->Equal("title", $this->tags[$i])->ExecuteAssociated();
			$tagid=-1;
			if(!is_null($result))//If Tag Exists
			{
				$tagid=$result[0]['id'];
			}
			else
			{
				//Add Tag
				$insertQuery=$Database->InsertInto("tag")->Set("title", $this->tags[$i]);
				$insertQuery->Execute();
				$tagid=$insertQuery->getInsertedId();
				//End Of Add Tag
			}
			
			$insertQuery2=$Database->InsertInto($this->relationTable)->Set("tag_fid", $tagid)->Set("content_fid", $this->contentID);
// 			echo $insertQuery2->getQueryString();
			$insertQuery2->Execute();
		}
		
	}
	public function getContentTags()
	{
		$Database=new dbquery();
		$selectfield=new DBField("t.title",false);
		$query=$Database->Select($selectfield)->From(array("tag as t",$this->relationTable . " AS rt"))->Where()->Equal("t.id", new DBField("tag_fid",false))->AndLogic()->Equal("content_fid", $this->contentID);
// 		echo $query->getQueryString();
		$result=$query->ExecuteAssociated();
		
		return $result;
	}
	public function getTagContents($Tag)
	{
		$Database=new dbquery();
		$query=$Database->Select("content_fid as id")->From(array($this->relationTable . " rt","tag tag"))->Where()->Equal("tag_fid", new DBField("tag.id",false))->AndLogic()->Equal("tag.title", $Tag);
		//echo $query->getQueryString();
		$result=$query->Execute();
		return $result;
	}
}

?>