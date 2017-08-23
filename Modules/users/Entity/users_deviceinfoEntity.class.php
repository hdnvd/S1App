<?php

namespace Modules\users\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\selectQuery;
use core\CoreClasses\db\updateQuery;
use core\CoreClasses\db\insertQuery;
use core\CoreClasses\db\dbaccess;


/**
 *@author Hadi AmirNahavandi
 *@CreationDate 2015/06/26 16:27:43
 *@LastUpdate 2015/06/26 16:27:43
 *@TableName deviceinfo
 *@TableFields devicecode t,devicetitle t,apiversion t,width i,height i,accounts t,role_systemuser_fid i
 *@SweetFrameworkHelperVersion 1.103
 *@TableCreationSQL
 
CREATE TABLE IF NOT EXISTS users_deviceinfo (
`id` int(11) NOT NULL AUTO_INCREMENT,
devicecode text NOT NULL,
devicetitle text NOT NULL,
apiversion text NOT NULL,
width int(11) NOT NULL,
height int(11) NOT NULL,
accounts text NOT NULL,
role_systemuser_fid int(11) NOT NULL,
`isdeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/


class users_deviceinfoEntity extends EntityClass {
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
		$this->setTableName("users_deviceinfo");
	}
	public function Insert($Devicecode,$Devicetitle,$Apiversion,$Width,$Height,$Accounts,$Role_systemuser_fid)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("devicecode",$Devicecode)
		->Set("devicetitle",$Devicetitle)
		->Set("apiversion",$Apiversion)
		->Set("width",$Width)
		->Set("height",$Height)
		->Set("accounts",$Accounts)
		->Set("role_systemuser_fid",$Role_systemuser_fid)
		->Set("isdeleted", "0");
		//echo $this->InsertQuery->getQueryString();
		//die();
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		return $InsertedID;
	}
	public function Update($ID,$Devicecode,$Devicetitle,$Apiversion,$Width,$Height,$Accounts,$Role_systemuser_fid)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("devicecode",$Devicecode)
		->NotNullSet("devicetitle",$Devicetitle)
		->NotNullSet("apiversion",$Apiversion)
		->NotNullSet("width",$Width)
		->NotNullSet("height",$Height)
		->NotNullSet("accounts",$Accounts)
		->NotNullSet("role_systemuser_fid",$Role_systemuser_fid)
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
	public function Select($ID,$Devicecode,$Devicetitle,$Apiversion,$Width,$Height,$Accounts,$Role_systemuser_fid,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Devicecode!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("devicecode",$Devicecode);
		if($Devicetitle!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("devicetitle",$Devicetitle);
		if($Apiversion!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("apiversion",$Apiversion);
		if($Width!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("width",$Width);
		if($Height!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("height",$Height);
		if($Accounts!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("accounts",$Accounts);
		if($Role_systemuser_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("role_systemuser_fid",$Role_systemuser_fid);
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
