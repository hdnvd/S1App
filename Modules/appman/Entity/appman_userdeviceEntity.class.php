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
 *@CreationDate 2015/10/17 00:30:36
 *@LastUpdate 2015/10/17 00:30:36
 *@TableName userdevice
 *@TableFields devicecode t,os t,name t,width t,height t,osversion t,accounts t
 *@SweetFrameworkHelperVersion 1.108
 *@TableCreationSQL
 
CREATE TABLE IF NOT EXISTS sweetp_appman_userdevice (
`id` int(11) NOT NULL AUTO_INCREMENT,
`devicecode` text NOT NULL,
`os` text NOT NULL,
`name` text NOT NULL,
`width` text NOT NULL,
`height` text NOT NULL,
`osversion` text NOT NULL,
`accounts` text NOT NULL,
`isdeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/


class appman_userdeviceEntity extends EntityClass {
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
		$this->setTableName("appman_userdevice");
	}
	public function Insert($Devicecode,$Os,$Name,$Width,$Height,$Osversion,$Accounts)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("devicecode",$Devicecode)
		->Set("os",$Os)
		->Set("name",$Name)
		->Set("width",$Width)
		->Set("height",$Height)
		->Set("osversion",$Osversion)
		->Set("accounts",$Accounts)
		->Set("isdeleted", "0");
		//echo $this->InsertQuery->getQueryString();
		//die();
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		return $InsertedID;
	}
	public function Update($ID,$Devicecode,$Os,$Name,$Width,$Height,$Osversion,$Accounts)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("devicecode",$Devicecode)
		->NotNullSet("os",$Os)
		->NotNullSet("name",$Name)
		->NotNullSet("width",$Width)
		->NotNullSet("height",$Height)
		->NotNullSet("osversion",$Osversion)
		->NotNullSet("accounts",$Accounts)
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
	public function Select($ID,$Devicecode,$Os,$Name,$Width,$Height,$Osversion,$Accounts,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Devicecode!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("devicecode",$Devicecode);
		if($Os!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("os",$Os);
		if($Name!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("name",$Name);
		if($Width!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("width",$Width);
		if($Height!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("height",$Height);
		if($Osversion!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("osversion",$Osversion);
		if($Accounts!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("accounts",$Accounts);
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
