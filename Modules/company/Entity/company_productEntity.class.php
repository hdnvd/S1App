<?php

namespace Modules\company\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\selectQuery;
use core\CoreClasses\db\updateQuery;
use core\CoreClasses\db\insertQuery;
use core\CoreClasses\db\dbaccess;


/**
 *@author Hadi AmirNahavandi
 *@CreationDate 2015/02/19 13:42:01
 *@LastUpdate 2015/02/19 13:42:01
 *@TableFields title,description,thumbnail,url,technology
 *@SweetFrameworkHelperVersion 1.102
 *@TableCreationSQL
 
CREATE TABLE IF NOT EXISTS company_product (
`id` int(11) NOT NULL AUTO_INCREMENT,
title text NOT NULL,
description text NOT NULL,
thumbnail text NOT NULL,
url text NOT NULL,
technology text NOT NULL,
`isdeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
)
*/


class company_productEntity extends EntityClass {
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
		$this->setTableName("company_product");
	}
	public function Insert($Title,$Description,$Thumbnail,$Url,$Technology)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("title",$Title)
		->Set("description",$Description)
		->Set("thumbnail",$Thumbnail)
		->Set("url",$Url)
		->Set("technology",$Technology)
		->Set("isdeleted", "0");
		//echo $this->InsertQuery->getQueryString();
		//die();
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		return $InsertedID;
	}
	public function Update($ID,$Title,$Description,$Thumbnail,$Url,$Technology)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("title",$Title)
		->NotNullSet("description",$Description)
		->NotNullSet("thumbnail",$Thumbnail)
		->NotNullSet("url",$Url)
		->NotNullSet("technology",$Technology)
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
	public function Select($ID,$Title,$Description,$Thumbnail,$Url,$Technology,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Title!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("title",$Title);
		if($Description!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("description",$Description);
		if($Thumbnail!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("thumbnail",$Thumbnail);
		if($Url!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("url",$Url);
		if($Technology!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("technology",$Technology);
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
