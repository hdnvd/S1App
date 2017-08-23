<?php

namespace Modules\gallery\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\selectQuery;
use core\CoreClasses\db\updateQuery;
use core\CoreClasses\db\insertQuery;


/**
 *@author Hadi AmirNahavandi
 *@CreationDate 2014/12/20 23:12:50
 *@LastUpdate 2014/12/20 23:12:50
 *@TableFields latintitle,title,mother_fid,language_fid
*/


class gallery_albumEntity extends EntityClass {
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
		$this->setTableName("gallery_album");
	}
	public function Insert($Latintitle,$Title,$Mother_fid,$Language_fid)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("latintitle",$Latintitle)
		->Set("title",$Title)
		->Set("mother_fid",$Mother_fid)
		->Set("language_fid",$Language_fid)
		->Set("isdeleted", "0");
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		return $InsertedID;
	}
	public function Update($ID,$Latintitle,$Title,$Mother_fid,$Language_fid)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("latintitle",$Latintitle)
		->NotNullSet("title",$Title)
		->NotNullSet("mother_fid",$Mother_fid)
		->NotNullSet("language_fid",$Language_fid)
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
	public function Select($ID,$Latintitle,$Title,$Mother_fid,$Language_fid,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Latintitle!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("latintitle",$Latintitle);
		if($Title!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("title",$Title);
		if($Mother_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("mother_fid",$Mother_fid);
		if($Language_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("language_fid",$Language_fid);
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
