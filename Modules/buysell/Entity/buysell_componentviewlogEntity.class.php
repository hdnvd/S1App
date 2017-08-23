<?php

namespace Modules\buysell\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\selectQuery;
use core\CoreClasses\db\updateQuery;
use core\CoreClasses\db\insertQuery;
use core\CoreClasses\db\dbaccess;


/**
 *@author Hadi AmirNahavandi
 *@CreationDate 1395/11/26 - 2017/02/14 10:30:44
 *@LastUpdate 1395/11/26 - 2017/02/14 10:30:44
 *@TableName componentviewlog
 *@TableFields component_fid t,time t,viewer_role_systemuser_fid t
 *@SweetFrameworkHelperVersion 1.112
 *@TableCreationSQL
 
CREATE TABLE IF NOT EXISTS sweetp_buysell_componentviewlog (
`id` int(11) NOT NULL AUTO_INCREMENT,
`component_fid` text NOT NULL,
`time` text NOT NULL,
`viewer_role_systemuser_fid` text NOT NULL,
`deletetime` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/


class buysell_componentviewlogEntity extends EntityClass {
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
		$this->setTableName("buysell_componentviewlog");
	}
	public function Insert($Component_fid,$Time,$Viewer_role_systemuser_fid)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("component_fid",$Component_fid)
		->Set("time",$Time)
		->Set("viewer_role_systemuser_fid",$Viewer_role_systemuser_fid)
		->Set("deletetime", "-1");
		//echo $this->InsertQuery->getQueryString();
		//die();
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		return $InsertedID;
	}
	public function Update($ID,$Component_fid,$Time,$Viewer_role_systemuser_fid)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("component_fid",$Component_fid)
		->NotNullSet("time",$Time)
		->NotNullSet("viewer_role_systemuser_fid",$Viewer_role_systemuser_fid)
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
	public function Select($ID,$Component_fid,$Time,$Viewer_role_systemuser_fid,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Component_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("component_fid",$Component_fid);
		if($Time!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("time",$Time);
		if($Viewer_role_systemuser_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("viewer_role_systemuser_fid",$Viewer_role_systemuser_fid);
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
