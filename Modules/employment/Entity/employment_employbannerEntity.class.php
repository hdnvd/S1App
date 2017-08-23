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
 *@CreationDate 2015/06/25 19:42:49
 *@LastUpdate 2015/06/25 19:42:49
 *@TableName employbanner
 *@TableFields title t,latintitle t,details t,registerationways t,employtype i,mindegree i,sciencefield t,minage i,maxage i,onlylocal i,priorities t,unitype i,employer_fid i,expiredate t,adddate t,minexperience i,visits i,jobtitle t,ismarried i,soldierstatus i,neededsex i
 *@SweetFrameworkHelperVersion 1.103
 *@TableCreationSQL
 
CREATE TABLE IF NOT EXISTS employment_employbanner (
`id` int(11) NOT NULL AUTO_INCREMENT,
title text NOT NULL,
latintitle text NOT NULL,
details text NOT NULL,
registerationways text NOT NULL,
employtype int(11) NOT NULL,
mindegree int(11) NOT NULL,
sciencefield text NOT NULL,
minage int(11) NOT NULL,
maxage int(11) NOT NULL,
onlylocal int(11) NOT NULL,
priorities text NOT NULL,
unitype int(11) NOT NULL,
employer_fid int(11) NOT NULL,
expiredate text NOT NULL,
adddate text NOT NULL,
minexperience int(11) NOT NULL,
visits int(11) NOT NULL,
jobtitle text NOT NULL,
ismarried int(11) NOT NULL,
soldierstatus int(11) NOT NULL,
neededsex int(11) NOT NULL,
`isdeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/


class employment_employbannerEntity extends EntityClass {
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
		$this->setTableName("employment_employbanner");
	}
	public function Insert($Title,$Latintitle,$Details,$Registerationways,$Employtype,$Mindegree,$Sciencefield,$Minage,$Maxage,$Onlylocal,$Priorities,$Unitype,$Employer_fid,$Expiredate,$Adddate,$Minexperience,$Visits,$Jobtitle,$Ismarried,$Soldierstatus,$Neededsex)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("title",$Title)
		->Set("latintitle",$Latintitle)
		->Set("details",$Details)
		->Set("registerationways",$Registerationways)
		->Set("employtype",$Employtype)
		->Set("mindegree",$Mindegree)
		->Set("sciencefield",$Sciencefield)
		->Set("minage",$Minage)
		->Set("maxage",$Maxage)
		->Set("onlylocal",$Onlylocal)
		->Set("priorities",$Priorities)
		->Set("unitype",$Unitype)
		->Set("employer_fid",$Employer_fid)
		->Set("expiredate",$Expiredate)
		->Set("adddate",$Adddate)
		->Set("minexperience",$Minexperience)
		->Set("visits",$Visits)
		->Set("jobtitle",$Jobtitle)
		->Set("ismarried",$Ismarried)
		->Set("soldierstatus",$Soldierstatus)
		->Set("neededsex",$Neededsex)
		->Set("isdeleted", "0");
		//echo $this->InsertQuery->getQueryString();
		//die();
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		return $InsertedID;
	}
	public function Update($ID,$Title,$Latintitle,$Details,$Registerationways,$Employtype,$Mindegree,$Sciencefield,$Minage,$Maxage,$Onlylocal,$Priorities,$Unitype,$Employer_fid,$Expiredate,$Adddate,$Minexperience,$Visits,$Jobtitle,$Ismarried,$Soldierstatus,$Neededsex)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("title",$Title)
		->NotNullSet("latintitle",$Latintitle)
		->NotNullSet("details",$Details)
		->NotNullSet("registerationways",$Registerationways)
		->NotNullSet("employtype",$Employtype)
		->NotNullSet("mindegree",$Mindegree)
		->NotNullSet("sciencefield",$Sciencefield)
		->NotNullSet("minage",$Minage)
		->NotNullSet("maxage",$Maxage)
		->NotNullSet("onlylocal",$Onlylocal)
		->NotNullSet("priorities",$Priorities)
		->NotNullSet("unitype",$Unitype)
		->NotNullSet("employer_fid",$Employer_fid)
		->NotNullSet("expiredate",$Expiredate)
		->NotNullSet("adddate",$Adddate)
		->NotNullSet("minexperience",$Minexperience)
		->NotNullSet("visits",$Visits)
		->NotNullSet("jobtitle",$Jobtitle)
		->NotNullSet("ismarried",$Ismarried)
		->NotNullSet("soldierstatus",$Soldierstatus)
		->NotNullSet("neededsex",$Neededsex)
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
	public function Select($ID,$Title,$Latintitle,$Details,$Registerationways,$Employtype,$Mindegree,$Sciencefield,$Minage,$Maxage,$Onlylocal,$Priorities,$Unitype,$Employer_fid,$Expiredate,$Adddate,$Minexperience,$Visits,$Jobtitle,$Ismarried,$Soldierstatus,$Neededsex,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Title!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("title",$Title);
		if($Latintitle!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("latintitle",$Latintitle);
		if($Details!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("details",$Details);
		if($Registerationways!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("registerationways",$Registerationways);
		if($Employtype!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("employtype",$Employtype);
		if($Mindegree!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("mindegree",$Mindegree);
		if($Sciencefield!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("sciencefield",$Sciencefield);
		if($Minage!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("minage",$Minage);
		if($Maxage!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("maxage",$Maxage);
		if($Onlylocal!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("onlylocal",$Onlylocal);
		if($Priorities!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("priorities",$Priorities);
		if($Unitype!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("unitype",$Unitype);
		if($Employer_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("employer_fid",$Employer_fid);
		if($Expiredate!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("expiredate",$Expiredate);
		if($Adddate!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("adddate",$Adddate);
		if($Minexperience!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("minexperience",$Minexperience);
		if($Visits!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("visits",$Visits);
		if($Jobtitle!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("jobtitle",$Jobtitle);
		if($Ismarried!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("ismarried",$Ismarried);
		if($Soldierstatus!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("soldierstatus",$Soldierstatus);
		if($Neededsex!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("neededsex",$Neededsex);
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
