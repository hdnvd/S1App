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
 *@CreationDate 1395/11/26 - 2017/02/14 10:23:01
 *@LastUpdate 1395/11/26 - 2017/02/14 10:23:01
 *@TableName tag
 *@TableFields tag_fid t,component_fid t
 *@SweetFrameworkHelperVersion 1.112
 *@TableCreationSQL
 
CREATE TABLE IF NOT EXISTS sweetp_buysell_tag (
`id` int(11) NOT NULL AUTO_INCREMENT,
`tag_fid` text NOT NULL,
`component_fid` text NOT NULL,
`deletetime` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/


class buysell_tagEntity extends EntityClass {
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
		$this->setTableName("buysell_tag");
	}
	public function Insert($Tag_fid,$Component_fid)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("tag_fid",$Tag_fid)
		->Set("component_fid",$Component_fid)
		->Set("deletetime", "-1");
		//echo $this->InsertQuery->getQueryString();
		//die();
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		return $InsertedID;
	}
	public function Update($ID,$Tag_fid,$Component_fid)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("tag_fid",$Tag_fid)
		->NotNullSet("component_fid",$Component_fid)
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
	public function Select($ID,$Tag_fid,$Component_fid,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Tag_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("tag_fid",$Tag_fid);
		if($Component_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("component_fid",$Component_fid);
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
