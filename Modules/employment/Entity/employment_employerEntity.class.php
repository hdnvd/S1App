<?php

namespace Modules\employment\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\selectQuery;
use core\CoreClasses\db\updateQuery;
use core\CoreClasses\db\insertQuery;
use core\CoreClasses\db\dbaccess;


/**
 *@author Hadi AmirNahavandi
 *@CreationDate 2015/06/25 19:38:46
 *@LastUpdate 2015/06/25 19:38:46
 *@TableName employer
 *@TableFields title t,latintitle t,tel t,mob t,email t,website t,fax t,logourl t,address t,city_fid i,systemuser_fid i,mellicardpath t,isaccepted i,finance_type i,distancefromcity f,employeecount i,description t
 *@SweetFrameworkHelperVersion 1.103
 *@TableCreationSQL
 
CREATE TABLE IF NOT EXISTS employment_employer (
`id` int(11) NOT NULL AUTO_INCREMENT,
title text NOT NULL,
latintitle text NOT NULL,
tel text NOT NULL,
mob text NOT NULL,
email text NOT NULL,
website text NOT NULL,
fax text NOT NULL,
logourl text NOT NULL,
address text NOT NULL,
city_fid int(11) NOT NULL,
systemuser_fid int(11) NOT NULL,
mellicardpath text NOT NULL,
isaccepted int(11) NOT NULL,
finance_type int(11) NOT NULL,
distancefromcity text NOT NULL,
employeecount int(11) NOT NULL,
description text NOT NULL,
`isdeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/


class employment_employerEntity extends EntityClass {
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
		$this->setTableName("employment_employer");
	}
	public function Insert($Title,$Latintitle,$Tel,$Mob,$Email,$Website,$Fax,$Logourl,$Address,$City_fid,$Systemuser_fid,$Mellicardpath,$Isaccepted,$Finance_type,$Distancefromcity,$Employeecount,$Description)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("title",$Title)
		->Set("latintitle",$Latintitle)
		->Set("tel",$Tel)
		->Set("mob",$Mob)
		->Set("email",$Email)
		->Set("website",$Website)
		->Set("fax",$Fax)
		->Set("logourl",$Logourl)
		->Set("address",$Address)
		->Set("city_fid",$City_fid)
		->Set("systemuser_fid",$Systemuser_fid)
		->Set("mellicardpath",$Mellicardpath)
		->Set("isaccepted",$Isaccepted)
		->Set("finance_type",$Finance_type)
		->Set("distancefromcity",$Distancefromcity)
		->Set("employeecount",$Employeecount)
		->Set("description",$Description)
		->Set("isdeleted", "0");
		//echo $this->InsertQuery->getQueryString();
		//die();
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		return $InsertedID;
	}
	public function Update($ID,$Title,$Latintitle,$Tel,$Mob,$Email,$Website,$Fax,$Logourl,$Address,$City_fid,$Systemuser_fid,$Mellicardpath,$Isaccepted,$Finance_type,$Distancefromcity,$Employeecount,$Description)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("title",$Title)
		->NotNullSet("latintitle",$Latintitle)
		->NotNullSet("tel",$Tel)
		->NotNullSet("mob",$Mob)
		->NotNullSet("email",$Email)
		->NotNullSet("website",$Website)
		->NotNullSet("fax",$Fax)
		->NotNullSet("logourl",$Logourl)
		->NotNullSet("address",$Address)
		->NotNullSet("city_fid",$City_fid)
		->NotNullSet("systemuser_fid",$Systemuser_fid)
		->NotNullSet("mellicardpath",$Mellicardpath)
		->NotNullSet("isaccepted",$Isaccepted)
		->NotNullSet("finance_type",$Finance_type)
		->NotNullSet("distancefromcity",$Distancefromcity)
		->NotNullSet("employeecount",$Employeecount)
		->NotNullSet("description",$Description)
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
	public function Select($ID,$Title,$Latintitle,$Tel,$Mob,$Email,$Website,$Fax,$Logourl,$Address,$City_fid,$Systemuser_fid,$Mellicardpath,$Isaccepted,$Finance_type,$Distancefromcity,$Employeecount,$Description,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Title!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("title",$Title);
		if($Latintitle!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("latintitle",$Latintitle);
		if($Tel!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("tel",$Tel);
		if($Mob!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("mob",$Mob);
		if($Email!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("email",$Email);
		if($Website!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("website",$Website);
		if($Fax!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("fax",$Fax);
		if($Logourl!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("logourl",$Logourl);
		if($Address!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("address",$Address);
		if($City_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("city_fid",$City_fid);
		if($Systemuser_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("systemuser_fid",$Systemuser_fid);
		if($Mellicardpath!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("mellicardpath",$Mellicardpath);
		if($Isaccepted!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("isaccepted",$Isaccepted);
		if($Finance_type!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("finance_type",$Finance_type);
		if($Distancefromcity!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("distancefromcity",$Distancefromcity);
		if($Employeecount!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("employeecount",$Employeecount);
		if($Description!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("description",$Description);
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
