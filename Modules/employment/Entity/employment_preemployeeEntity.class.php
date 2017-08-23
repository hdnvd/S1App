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
 *@CreationDate 2015/06/25 19:40:40
 *@LastUpdate 2015/06/25 19:40:40
 *@TableName preemployee
 *@TableFields name t,family t,mobile t,email t,city_fid i,website t,degree i,sciencefield t,sex b,ismarried i,birthyear i,soldierstatus i,adddate t,unitype i,uniname t,mellicode t,foreignlanguage t,foreignlanguagerank i
 *@SweetFrameworkHelperVersion 1.103
 *@TableCreationSQL
 
CREATE TABLE IF NOT EXISTS employment_preemployee (
`id` int(11) NOT NULL AUTO_INCREMENT,
name text NOT NULL,
family text NOT NULL,
mobile text NOT NULL,
email text NOT NULL,
city_fid int(11) NOT NULL,
website text NOT NULL,
degree int(11) NOT NULL,
sciencefield text NOT NULL,
sex tinyint(1) NOT NULL,
ismarried int(11) NOT NULL,
birthyear int(11) NOT NULL,
soldierstatus int(11) NOT NULL,
adddate text NOT NULL,
unitype int(11) NOT NULL,
uniname text NOT NULL,
mellicode text NOT NULL,
foreignlanguage text NOT NULL,
foreignlanguagerank int(11) NOT NULL,
`isdeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/


class employment_preemployeeEntity extends EntityClass {
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
		$this->setTableName("employment_preemployee");
	}
	public function Insert($Name,$Family,$Mobile,$Email,$City_fid,$Website,$Degree,$Sciencefield,$Sex,$Ismarried,$Birthyear,$Soldierstatus,$Adddate,$Unitype,$Uniname,$Mellicode,$Foreignlanguage,$Foreignlanguagerank)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("name",$Name)
		->Set("family",$Family)
		->Set("mobile",$Mobile)
		->Set("email",$Email)
		->Set("city_fid",$City_fid)
		->Set("website",$Website)
		->Set("degree",$Degree)
		->Set("sciencefield",$Sciencefield)
		->Set("sex",$Sex)
		->Set("ismarried",$Ismarried)
		->Set("birthyear",$Birthyear)
		->Set("soldierstatus",$Soldierstatus)
		->Set("adddate",$Adddate)
		->Set("unitype",$Unitype)
		->Set("uniname",$Uniname)
		->Set("mellicode",$Mellicode)
		->Set("foreignlanguage",$Foreignlanguage)
		->Set("foreignlanguagerank",$Foreignlanguagerank)
		->Set("isdeleted", "0");
		//echo $this->InsertQuery->getQueryString();
		//die();
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		return $InsertedID;
	}
	public function Update($ID,$Name,$Family,$Mobile,$Email,$City_fid,$Website,$Degree,$Sciencefield,$Sex,$Ismarried,$Birthyear,$Soldierstatus,$Adddate,$Unitype,$Uniname,$Mellicode,$Foreignlanguage,$Foreignlanguagerank)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("name",$Name)
		->NotNullSet("family",$Family)
		->NotNullSet("mobile",$Mobile)
		->NotNullSet("email",$Email)
		->NotNullSet("city_fid",$City_fid)
		->NotNullSet("website",$Website)
		->NotNullSet("degree",$Degree)
		->NotNullSet("sciencefield",$Sciencefield)
		->NotNullSet("sex",$Sex)
		->NotNullSet("ismarried",$Ismarried)
		->NotNullSet("birthyear",$Birthyear)
		->NotNullSet("soldierstatus",$Soldierstatus)
		->NotNullSet("adddate",$Adddate)
		->NotNullSet("unitype",$Unitype)
		->NotNullSet("uniname",$Uniname)
		->NotNullSet("mellicode",$Mellicode)
		->NotNullSet("foreignlanguage",$Foreignlanguage)
		->NotNullSet("foreignlanguagerank",$Foreignlanguagerank)
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
	public function Select($ID,$Name,$Family,$Mobile,$Email,$City_fid,$Website,$Degree,$Sciencefield,$Sex,$Ismarried,$Birthyear,$Soldierstatus,$Adddate,$Unitype,$Uniname,$Mellicode,$Foreignlanguage,$Foreignlanguagerank,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Name!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("name",$Name);
		if($Family!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("family",$Family);
		if($Mobile!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("mobile",$Mobile);
		if($Email!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("email",$Email);
		if($City_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("city_fid",$City_fid);
		if($Website!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("website",$Website);
		if($Degree!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("degree",$Degree);
		if($Sciencefield!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("sciencefield",$Sciencefield);
		if($Sex!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("sex",$Sex);
		if($Ismarried!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("ismarried",$Ismarried);
		if($Birthyear!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("birthyear",$Birthyear);
		if($Soldierstatus!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("soldierstatus",$Soldierstatus);
		if($Adddate!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("adddate",$Adddate);
		if($Unitype!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("unitype",$Unitype);
		if($Uniname!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("uniname",$Uniname);
		if($Mellicode!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("mellicode",$Mellicode);
		if($Foreignlanguage!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("foreignlanguage",$Foreignlanguage);
		if($Foreignlanguagerank!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("foreignlanguagerank",$Foreignlanguagerank);
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
