<?php

namespace Modules\contactus\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\selectQuery;
use core\CoreClasses\db\updateQuery;
use core\CoreClasses\db\insertQuery;
use core\CoreClasses\db\dbaccess;


/**
 *@author Hadi AmirNahavandi
 *@CreationDate 2015/02/26 00:51:38
 *@LastUpdate 2015/02/26 00:51:38
 *@TableFields language_fid,title,link,info
 *@SweetFrameworkHelperVersion 1.102
 *@TableCreationSQL
 
CREATE TABLE IF NOT EXISTS contactus_contactinfo (
`id` int(11) NOT NULL AUTO_INCREMENT,
language_fid text NOT NULL,
title text NOT NULL,
link text NOT NULL,
info text NOT NULL,
`isdeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/


class contactus_contactinfoEntity extends EntityClass {
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
		$this->setTableName("contactus_contactinfo");
	}
	public function Insert($Language_fid,$Title,$Link,$Info)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("language_fid",$Language_fid)
		->Set("title",$Title)
		->Set("link",$Link)
		->Set("info",$Info)
		->Set("isdeleted", "0");
		//echo $this->InsertQuery->getQueryString();
		//die();
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		return $InsertedID;
	}
	public function Update($ID,$Language_fid,$Title,$Link,$Info)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("language_fid",$Language_fid)
		->NotNullSet("title",$Title)
		->NotNullSet("link",$Link)
		->NotNullSet("info",$Info)
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
	public function Select($ID,$Language_fid,$Title,$Link,$Info,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Language_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("language_fid",$Language_fid);
		if($Title!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("title",$Title);
		if($Link!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("link",$Link);
		if($Info!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("info",$Info);
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
