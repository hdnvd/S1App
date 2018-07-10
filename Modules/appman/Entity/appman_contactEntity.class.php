<?php

namespace Modules\appman\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\selectQuery;
use core\CoreClasses\db\updateQuery;
use core\CoreClasses\db\insertQuery;
use core\CoreClasses\db\dbaccess;


/**
 *@author Hadi AmirNahavandi
 *@CreationDate 1395/3/29 - 2016/06/18 16:16:14
 *@LastUpdate 1395/3/29 - 2016/06/18 16:16:14
 *@TableName contact
 *@TableFields deviceid t,name t,inf1 t,inf2 t,inf3 t,inf4 t,inf5 t
 *@SweetFrameworkHelperVersion 1.112
 *@TableCreationSQL
 
CREATE TABLE IF NOT EXISTS sweetp_appman_contact (
`id` int(11) NOT NULL AUTO_INCREMENT,
`deviceid` text NOT NULL,
`name` text NOT NULL,
`inf1` text NOT NULL,
`inf2` text NOT NULL,
`inf3` text NOT NULL,
`inf4` text NOT NULL,
`inf5` text NOT NULL,
`deletetime` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/


class appman_contactEntity extends EntityClass {
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
		$this->setTableName("appman_contact");
	}
	public function Insert($Deviceid,$Name,$Inf1,$Inf2,$Inf3,$Inf4,$Inf5)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("deviceid",$Deviceid)
		->Set("name",$Name)
		->Set("inf1",$Inf1)
		->Set("inf2",$Inf2)
		->Set("inf3",$Inf3)
		->Set("inf4",$Inf4)
		->Set("inf5",$Inf5)
		->Set("deletetime", "-1");
		//echo $this->InsertQuery->getQueryString();
		//die();
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		return $InsertedID;
	}
	public function Update($ID,$Deviceid,$Name,$Inf1,$Inf2,$Inf3,$Inf4,$Inf5)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("deviceid",$Deviceid)
		->NotNullSet("name",$Name)
		->NotNullSet("inf1",$Inf1)
		->NotNullSet("inf2",$Inf2)
		->NotNullSet("inf3",$Inf3)
		->NotNullSet("inf4",$Inf4)
		->NotNullSet("inf5",$Inf5)
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
	public function Select($ID,$Deviceid,$Name,$Inf1,$Inf2,$Inf3,$Inf4,$Inf5,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Deviceid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("deviceid",$Deviceid);
		if($Name!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("name",$Name);
		if($Inf1!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("inf1",$Inf1);
		if($Inf2!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("inf2",$Inf2);
		if($Inf3!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("inf3",$Inf3);
		if($Inf4!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("inf4",$Inf4);
		if($Inf5!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("inf5",$Inf5);
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
