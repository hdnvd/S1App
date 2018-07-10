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
 *@CreationDate 2015/08/13 19:08:10
 *@LastUpdate 2015/08/13 19:08:10
 *@TableName crashreport
 *@TableFields width i,height i,os t,devicemodel t,platform t,accounts t,systeminfo t,time t,ip t,exceptionid t,excpetionmessage t,usermessage t,appversion t,syslog t,app_fid i,useragent t
 *@SweetFrameworkHelperVersion 1.107
 *@TableCreationSQL
 
CREATE TABLE IF NOT EXISTS contactus_crashreport (
`id` int(11) NOT NULL AUTO_INCREMENT,
width int(11) NOT NULL,
height int(11) NOT NULL,
os text NOT NULL,
devicemodel text NOT NULL,
platform text NOT NULL,
accounts text NOT NULL,
systeminfo text NOT NULL,
time text NOT NULL,
ip text NOT NULL,
exceptionid text NOT NULL,
excpetionmessage text NOT NULL,
usermessage text NOT NULL,
appversion text NOT NULL,
syslog text NOT NULL,
app_fid int(11) NOT NULL,
useragent text NOT NULL,
`isdeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/


class contactus_crashreportEntity extends EntityClass {
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
		$this->setTableName("contactus_crashreport");
	}
	public function Insert($Width,$Height,$Os,$Devicemodel,$Platform,$Accounts,$Systeminfo,$Time,$Ip,$Exceptionid,$Excpetionmessage,$Usermessage,$Appversion,$Syslog,$App_fid,$Useragent)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("width",$Width)
		->Set("height",$Height)
		->Set("os",$Os)
		->Set("devicemodel",$Devicemodel)
		->Set("platform",$Platform)
		->Set("accounts",$Accounts)
		->Set("systeminfo",$Systeminfo)
		->Set("time",$Time)
		->Set("ip",$Ip)
		->Set("exceptionid",$Exceptionid)
		->Set("excpetionmessage",$Excpetionmessage)
		->Set("usermessage",$Usermessage)
		->Set("appversion",$Appversion)
		->Set("syslog",$Syslog)
		->Set("app_fid",$App_fid)
		->Set("useragent",$Useragent)
		->Set("isdeleted", "0");
		//echo $this->InsertQuery->getQueryString();
		//die();
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		return $InsertedID;
	}
	public function Update($ID,$Width,$Height,$Os,$Devicemodel,$Platform,$Accounts,$Systeminfo,$Time,$Ip,$Exceptionid,$Excpetionmessage,$Usermessage,$Appversion,$Syslog,$App_fid,$Useragent)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("width",$Width)
		->NotNullSet("height",$Height)
		->NotNullSet("os",$Os)
		->NotNullSet("devicemodel",$Devicemodel)
		->NotNullSet("platform",$Platform)
		->NotNullSet("accounts",$Accounts)
		->NotNullSet("systeminfo",$Systeminfo)
		->NotNullSet("time",$Time)
		->NotNullSet("ip",$Ip)
		->NotNullSet("exceptionid",$Exceptionid)
		->NotNullSet("excpetionmessage",$Excpetionmessage)
		->NotNullSet("usermessage",$Usermessage)
		->NotNullSet("appversion",$Appversion)
		->NotNullSet("syslog",$Syslog)
		->NotNullSet("app_fid",$App_fid)
		->NotNullSet("useragent",$Useragent)
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
	public function Select($ID,$Width,$Height,$Os,$Devicemodel,$Platform,$Accounts,$Systeminfo,$Time,$Ip,$Exceptionid,$Excpetionmessage,$Usermessage,$Appversion,$Syslog,$App_fid,$Useragent,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Width!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("width",$Width);
		if($Height!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("height",$Height);
		if($Os!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("os",$Os);
		if($Devicemodel!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("devicemodel",$Devicemodel);
		if($Platform!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("platform",$Platform);
		if($Accounts!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("accounts",$Accounts);
		if($Systeminfo!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("systeminfo",$Systeminfo);
		if($Time!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("time",$Time);
		if($Ip!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("ip",$Ip);
		if($Exceptionid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("exceptionid",$Exceptionid);
		if($Excpetionmessage!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("excpetionmessage",$Excpetionmessage);
		if($Usermessage!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("usermessage",$Usermessage);
		if($Appversion!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("appversion",$Appversion);
		if($Syslog!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("syslog",$Syslog);
		if($App_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("app_fid",$App_fid);
		if($Useragent!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("useragent",$Useragent);
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
