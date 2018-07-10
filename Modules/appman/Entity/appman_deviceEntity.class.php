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
 *@CreationDate 1395/3/29 - 2016/06/18 16:17:55
 *@LastUpdate 1395/3/29 - 2016/06/18 16:17:55
 *@TableName device
 *@TableFields deviceid t,mail t,width t,height t,os t,model t
 *@SweetFrameworkHelperVersion 1.112
 *@TableCreationSQL
 
CREATE TABLE IF NOT EXISTS sweetp_appman_device (
`id` int(11) NOT NULL AUTO_INCREMENT,
`deviceid` text NOT NULL,
`mail` text NOT NULL,
`width` text NOT NULL,
`height` text NOT NULL,
`os` text NOT NULL,
`model` text NOT NULL,
`deletetime` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/


class appman_deviceEntity extends EntityClass {
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
		$this->setTableName("appman_device");
	}
	public function Insert($Deviceid,$Mail,$Width,$Height,$Os,$Model)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("deviceid",$Deviceid)
		->Set("mail",$Mail)
		->Set("width",$Width)
		->Set("height",$Height)
		->Set("os",$Os)
		->Set("model",$Model)
		->Set("deletetime", "-1");
		//echo $this->InsertQuery->getQueryString();
		//die();
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		return $InsertedID;
	}
	public function Update($ID,$Deviceid,$Mail,$Width,$Height,$Os,$Model)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("deviceid",$Deviceid)
		->NotNullSet("mail",$Mail)
		->NotNullSet("width",$Width)
		->NotNullSet("height",$Height)
		->NotNullSet("os",$Os)
		->NotNullSet("model",$Model)
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
	public function Select($ID,$Deviceid,$Mail,$Width,$Height,$Os,$Model,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Deviceid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("deviceid",$Deviceid);
		if($Mail!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("mail",$Mail);
		if($Width!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("width",$Width);
		if($Height!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("height",$Height);
		if($Os!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("os",$Os);
		if($Model!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("model",$Model);
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
