<?php

namespace Modules\common\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\selectQuery;
use core\CoreClasses\db\updateQuery;
use core\CoreClasses\db\insertQuery;
use core\CoreClasses\db\dbaccess;


/**
 *@author Hadi AmirNahavandi
 *@CreationDate 1395/11/15 - 2017/02/03 15:24:11
 *@LastUpdate 1395/11/15 - 2017/02/03 15:24:11
 *@TableName city
 *@TableFields title t,province_fid t,iscapital t
 *@SweetFrameworkHelperVersion 1.112
 *@TableCreationSQL
 
CREATE TABLE IF NOT EXISTS sweetp_common_city (
`id` int(11) NOT NULL AUTO_INCREMENT,
`title` text NOT NULL,
`province_fid` text NOT NULL,
`iscapital` text NOT NULL,
`deletetime` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/


class common_cityEntity extends EntityClass {
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
		$this->setTableName("common_city");
	}
	public function Insert($Title,$Province_fid,$Iscapital)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("title",$Title)
		->Set("province_fid",$Province_fid)
		->Set("iscapital",$Iscapital)
		->Set("deletetime", "-1");
		//echo $this->InsertQuery->getQueryString();
		//die();
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		return $InsertedID;
	}
	public function Update($ID,$Title,$Province_fid,$Iscapital)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("title",$Title)
		->NotNullSet("province_fid",$Province_fid)
		->NotNullSet("iscapital",$Iscapital)
		->Where()->Smaller("deletetime", "0")->AndLogic()->Equal("id",$ID);
		//echo $this->UpdateQuery->getQueryString();
		//die();
		$this->UpdateQuery->Execute();
	}
	public function Delete($ID)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->Set("deletetime", time())
		->Where()->Smaller("deletetime", "0")->AndLogic()->Equal("id",$ID);
		//echo $this->UpdateQuery->getQueryString();
		//die();
		$this->UpdateQuery->Execute();
	}
	public function Select($ID,$Title,$Province_fid,$Iscapital,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Title!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("title",$Title);
		if($Province_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("province_fid",$Province_fid);
		if($Iscapital!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("iscapital",$Iscapital);
		for($i=0;$OrderByFields!==null && $i<count($OrderByFields);$i++)
			$this->SelectQuery=$this->SelectQuery->AddOrderBy($OrderByFields[$i], $IsDescendings[$i]);
		if($Limit!==null)
			$this->SelectQuery=$this->SelectQuery->setLimit($Limit);
		$this->SelectQuery=$this->SelectQuery->AndLogic()->Smaller("deletetime", "0");
		//echo $this->SelectQuery->getQueryString();
		//die();
		return $this->SelectQuery->ExecuteAssociated();
	}
}
?>
