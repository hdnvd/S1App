<?php

namespace Modules\posts\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\selectQuery;
use core\CoreClasses\db\updateQuery;
use core\CoreClasses\db\insertQuery;
use core\CoreClasses\db\dbaccess;


/**
 *@author Hadi AmirNahavandi
 *@CreationDate 2015/03/11 12:51:14
 *@LastUpdate 2015/03/11 12:51:14
 *@TableFields title,summary,content,externallink,thumbnail,rank,visits,ispublished,adddate,lastupdate,linktitle,description,keywords,canonicalurl
 *@SweetFrameworkHelperVersion 1.102
 *@TableCreationSQL
 
CREATE TABLE IF NOT EXISTS posts_post (
`id` int(11) NOT NULL AUTO_INCREMENT,
title text NOT NULL,
summary text NOT NULL,
content text NOT NULL,
externallink text NOT NULL,
thumbnail text NOT NULL,
rank text NOT NULL,
visits text NOT NULL,
ispublished text NOT NULL,
adddate text NOT NULL,
lastupdate text NOT NULL,
linktitle text NOT NULL,
description text NOT NULL,
keywords text NOT NULL,
canonicalurl text NOT NULL,
`isdeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/


class posts_postEntity extends EntityClass {
	/**
	 * @var updateQuery
	 */
	private $UpdateQuery;
	/**
	 * @var selectQuery
	 */
	private $SelectQuery;
	/**
	 * @var insertQuery
	 */
	private $InsertQuery;
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("posts_post");
	}
	public function Insert($Title,$Summary,$Content,$Externallink,$Thumbnail,$Rank,$Visits,$Ispublished,$Adddate,$Lastupdate,$Linktitle,$Description,$Keywords,$Canonicalurl)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("title",$Title)
		->Set("summary",$Summary)
		->Set("content",$Content)
		->Set("externallink",$Externallink)
		->Set("thumbnail",$Thumbnail)
		->Set("rank",$Rank)
		->Set("visits",$Visits)
		->Set("ispublished",$Ispublished)
		->Set("adddate",$Adddate)
		->Set("lastupdate",$Lastupdate)
		->Set("linktitle",$Linktitle)
		->Set("description",$Description)
		->Set("keywords",$Keywords)
		->Set("canonicalurl",$Canonicalurl)
		->Set("isdeleted", "0");
		//echo $this->InsertQuery->getQueryString();
		//die();
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		return $InsertedID;
	}
	public function Update($ID,$Title,$Summary,$Content,$Externallink,$Thumbnail,$Rank,$Visits,$Ispublished,$Adddate,$Lastupdate,$Linktitle,$Description,$Keywords,$Canonicalurl)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("title",$Title)
		->NotNullSet("summary",$Summary)
		->NotNullSet("content",$Content)
		->NotNullSet("externallink",$Externallink)
		->NotNullSet("thumbnail",$Thumbnail)
		->NotNullSet("rank",$Rank)
		->NotNullSet("visits",$Visits)
		->NotNullSet("ispublished",$Ispublished)
		->NotNullSet("adddate",$Adddate)
		->NotNullSet("lastupdate",$Lastupdate)
		->NotNullSet("linktitle",$Linktitle)
		->NotNullSet("description",$Description)
		->NotNullSet("keywords",$Keywords)
		->NotNullSet("canonicalurl",$Canonicalurl)
		->Where()->Equal("isdeleted", "0")->AndLogic()->Equal("id",$ID);
		//echo $this->UpdateQuery->getQueryString();
		//die();
		$this->UpdateQuery->Execute();
	}
	public function Delete($ID)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->Set("isdeleted","1")
		->Where()->Equal("isdeleted", "0")->AndLogic()->Equal("id",$ID);
		//echo $this->UpdateQuery->getQueryString();
		//die();
		$this->UpdateQuery->Execute();
	}
	public function Select($ID,$Title,$Summary,$Content,$Externallink,$Thumbnail,$Rank,$Visits,$Ispublished,$Adddate,$Lastupdate,$Linktitle,$Description,$Keywords,$Canonicalurl,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Title!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("title",$Title);
		if($Summary!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("summary",$Summary);
		if($Content!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("content",$Content);
		if($Externallink!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("externallink",$Externallink);
		if($Thumbnail!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("thumbnail",$Thumbnail);
		if($Rank!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("rank",$Rank);
		if($Visits!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("visits",$Visits);
		if($Ispublished!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("ispublished",$Ispublished);
		if($Adddate!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("adddate",$Adddate);
		if($Lastupdate!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("lastupdate",$Lastupdate);
		if($Linktitle!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("linktitle",$Linktitle);
		if($Description!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("description",$Description);
		if($Keywords!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("keywords",$Keywords);
		if($Canonicalurl!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("canonicalurl",$Canonicalurl);
		for($i=0;$OrderByFields!==null && $i<count($OrderByFields);$i++)
			$this->SelectQuery=$this->SelectQuery->AddOrderBy($OrderByFields[$i], $IsDescendings[$i]);
		if($Limit!==null)
			$this->SelectQuery=$this->SelectQuery->setLimit($Limit);
		$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("isdeleted", "0");
		//echo $this->SelectQuery->getQueryString();
		//die();
		return $this->SelectQuery->ExecuteAssociated();
	}
}
?>
