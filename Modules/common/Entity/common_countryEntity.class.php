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
 *@CreationDate 1395/11/26 - 2017/02/14 15:14:05
 *@LastUpdate 1395/11/26 - 2017/02/14 15:14:05
 *@TableName country
 *@TableFields latinname t,name t
 *@SweetFrameworkHelperVersion 1.112
 *@TableCreationSQL
 
CREATE TABLE IF NOT EXISTS sweetp_common_country (
`id` int(11) NOT NULL AUTO_INCREMENT,
`latinname` text NOT NULL,
`name` text NOT NULL,
`deletetime` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/


class common_countryEntity extends EntityClass {
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
		$this->setTableName("common_country");
	}
	public function Insert($Latinname,$Name)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("latinname",$Latinname)
		->Set("name",$Name)
		->Set("deletetime", "-1");
		//echo $this->InsertQuery->getQueryString();
		//die();
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		return $InsertedID;
	}
	public function Update($ID,$Latinname,$Name)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("latinname",$Latinname)
		->NotNullSet("name",$Name)
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
	public function Select($ID,$Latinname,$Name,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Latinname!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("latinname",$Latinname);
		if($Name!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("name",$Name);
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
