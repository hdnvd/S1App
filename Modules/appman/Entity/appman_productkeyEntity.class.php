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
 *@CreationDate 2015/10/17 00:33:12
 *@LastUpdate 2015/10/17 00:33:12
 *@TableName productkey
 *@TableFields appkey t,userdevice_fid i,reg_date t,generator_fid i,systemuser_fid i,generationdate t,app_fid i
 *@SweetFrameworkHelperVersion 1.108
 *@TableCreationSQL
 
CREATE TABLE IF NOT EXISTS sweetp_appman_productkey (
`id` int(11) NOT NULL AUTO_INCREMENT,
`appkey` text NOT NULL,
`userdevice_fid` int(11) NOT NULL,
`reg_date` text NOT NULL,
`generator_fid` int(11) NOT NULL,
`systemuser_fid` int(11) NOT NULL,
`generationdate` text NOT NULL,
`app_fid` int(11) NOT NULL,
`isdeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/


class appman_productkeyEntity extends EntityClass {
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
		$this->setTableName("appman_productkey");
	}
	public function Insert($Appkey,$Userdevice_fid,$Reg_date,$Generator_fid,$Systemuser_fid,$Generationdate,$App_fid)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("appkey",$Appkey)
		->Set("userdevice_fid",$Userdevice_fid)
		->Set("reg_date",$Reg_date)
		->Set("generator_fid",$Generator_fid)
		->Set("systemuser_fid",$Systemuser_fid)
		->Set("generationdate",$Generationdate)
		->Set("app_fid",$App_fid)
		->Set("isdeleted", "0");
		//echo $this->InsertQuery->getQueryString();
		//die();
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		return $InsertedID;
	}
	public function Update($ID,$Appkey,$Userdevice_fid,$Reg_date,$Generator_fid,$Systemuser_fid,$Generationdate,$App_fid)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("appkey",$Appkey)
		->NotNullSet("userdevice_fid",$Userdevice_fid)
		->NotNullSet("reg_date",$Reg_date)
		->NotNullSet("generator_fid",$Generator_fid)
		->NotNullSet("systemuser_fid",$Systemuser_fid)
		->NotNullSet("generationdate",$Generationdate)
		->NotNullSet("app_fid",$App_fid)
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
	public function Select($ID,$Appkey,$Userdevice_fid,$Reg_date,$Generator_fid,$Systemuser_fid,$Generationdate,$App_fid,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Appkey!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("appkey",$Appkey);
		if($Userdevice_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("userdevice_fid",$Userdevice_fid);
		if($Reg_date!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("reg_date",$Reg_date);
		if($Generator_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("generator_fid",$Generator_fid);
		if($Systemuser_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("systemuser_fid",$Systemuser_fid);
		if($Generationdate!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("generationdate",$Generationdate);
		if($App_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("app_fid",$App_fid);
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
