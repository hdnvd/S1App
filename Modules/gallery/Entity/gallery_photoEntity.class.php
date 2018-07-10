<?php

namespace Modules\gallery\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\selectQuery;
use core\CoreClasses\db\updateQuery;
use core\CoreClasses\db\insertQuery;


/**
 *@author Hadi AmirNahavandi
 *@CreationDate 2014/12/20 23:12:05
 *@LastUpdate 2014/12/20 23:12:05
 *@TableFields title,description,thumburl,url
*/


class gallery_photoEntity extends EntityClass {
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
	public function __construct()
	{
		$this->setDatabase(new dbquery());
		$this->setTableName("gallery_photo");
	}
	public function Insert($Title,$Description,$Thumburl,$Url,$AddDate,$LastUpdate,$PublishDate)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("title",$Title)
		->Set("description",$Description)
		->Set("thumburl",$Thumburl)
		->Set("publishdate",$PublishDate)
		->Set("adddate",$AddDate)
		->Set("lastupdate",$LastUpdate)
		->Set("url",$Url)
		->Set("isdeleted", "0");
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		return $InsertedID;
	}
	public function Update($ID,$Title,$Description,$Thumburl,$Url,$AddDate,$LastUpdate,$PublishDate)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("title",$Title)
		->NotNullSet("description",$Description)
		->NotNullSet("thumburl",$Thumburl)
		->NotNullSet("publishdate",$PublishDate)
		->NotNullSet("adddate",$AddDate)
		->NotNullSet("lastupdate",$LastUpdate)
		->NotNullSet("url",$Url)
		->Where()->Equal("isdeleted", "0")->AndLogic()->Equal("id",$ID);
		$this->UpdateQuery->Execute();
	}
	public function Delete($ID)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->Set("isdeleted","1")
		->Where()->Equal("isdeleted", "0")->AndLogic()->Equal("id",$ID);
		$this->UpdateQuery->Execute();
	}
	public function Select($ID,$Title,$Description,$Thumburl,$Url,$MinPublishDate,$MaxPublishDate,$MinDate,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($MinPublishDate!==null)
		    $this->SelectQuery=$this->SelectQuery->AndLogic()->Bigger("cast(publishdate as signed)",$MinPublishDate);
		if($MinDate!==null)
		    $this->SelectQuery=$this->SelectQuery->AndLogic()->Bigger("cast(adddate as signed)",$MinDate);
		if($MaxPublishDate!==null)
		    $this->SelectQuery=$this->SelectQuery->AndLogic()->Smaller("cast(publishdate as signed)",$MaxPublishDate);
		if($Title!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("title",$Title);
		if($Description!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("description",$Description);
		if($Thumburl!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("thumburl",$Thumburl);
		if($Url!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("url",$Url);
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
