<?php

namespace Modules\buysell\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\selectQuery;
use core\CoreClasses\db\updateQuery;
use core\CoreClasses\db\insertQuery;
use core\CoreClasses\db\dbaccess;


/**
 *@author Hadi AmirNahavandi
 *@CreationDate 1395/11/20 - 2017/02/08 16:28:26
 *@LastUpdate 1395/11/20 - 2017/02/08 16:28:26
 *@TableName user
 *@TableFields name t,email t,tel t,mob t,postalcode t,ismale b,common_city_fid i,birthday t,ispayed b,signupdate t,photo t,is_info_visible b,bankcard_fid i,carmodel_fid i,role_systemuser_fid i
 *@SweetFrameworkHelperVersion 1.112
 *@TableCreationSQL
 
CREATE TABLE IF NOT EXISTS sweetp_buysell_user (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` text NOT NULL,
`email` text NOT NULL,
`tel` text NOT NULL,
`mob` text NOT NULL,
`postalcode` text NOT NULL,
`ismale` tinyint(1) NOT NULL,
`common_city_fid` int(11) NOT NULL,
`birthday` text NOT NULL,
`ispayed` tinyint(1) NOT NULL,
`signupdate` text NOT NULL,
`photo` text NOT NULL,
`is_info_visible` tinyint(1) NOT NULL,
`bankcard_fid` int(11) NOT NULL,
`carmodel_fid` int(11) NOT NULL,
`role_systemuser_fid` int(11) NOT NULL,
`deletetime` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/


class buysell_userEntity extends EntityClass {
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
		$this->setTableName("buysell_user");
	}
	public function Insert($Name,$Email,$Tel,$Mob,$Postalcode,$Ismale,$Common_city_fid,$Birthday,$Ispayed,$Signupdate,$Photo,$Is_info_visible,$Bankcard_fid,$Carmodel_fid,$Role_systemuser_fid)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("name",$Name)
		->Set("email",$Email)
		->Set("tel",$Tel)
		->Set("mob",$Mob)
		->Set("postalcode",$Postalcode)
		->Set("ismale",$Ismale)
		->Set("common_city_fid",$Common_city_fid)
		->Set("birthday",$Birthday)
		->Set("ispayed",$Ispayed)
		->Set("signupdate",$Signupdate)
		->Set("photo",$Photo)
		->Set("is_info_visible",$Is_info_visible)
		->Set("bankcard_fid",$Bankcard_fid)
		->Set("carmodel_fid",$Carmodel_fid)
		->Set("role_systemuser_fid",$Role_systemuser_fid)
		->Set("deletetime", "-1");
		//echo $this->InsertQuery->getQueryString();
		//die();
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		return $InsertedID;
	}
	public function Update($ID,$Name,$Email,$Tel,$Mob,$Postalcode,$Ismale,$Common_city_fid,$Birthday,$Ispayed,$Signupdate,$Photo,$Is_info_visible,$Bankcard_fid,$Carmodel_fid,$Role_systemuser_fid)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("name",$Name)
		->NotNullSet("email",$Email)
		->NotNullSet("tel",$Tel)
		->NotNullSet("mob",$Mob)
		->NotNullSet("postalcode",$Postalcode)
		->NotNullSet("ismale",$Ismale)
		->NotNullSet("common_city_fid",$Common_city_fid)
		->NotNullSet("birthday",$Birthday)
		->NotNullSet("ispayed",$Ispayed)
		->NotNullSet("signupdate",$Signupdate)
		->NotNullSet("photo",$Photo)
		->NotNullSet("is_info_visible",$Is_info_visible)
		->NotNullSet("bankcard_fid",$Bankcard_fid)
		->NotNullSet("carmodel_fid",$Carmodel_fid)
		->NotNullSet("role_systemuser_fid",$Role_systemuser_fid)
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
	public function Select($ID,$Name,$Email,$Tel,$Mob,$Postalcode,$Ismale,$Common_city_fid,$Birthday,$Ispayed,$Signupdate,$Photo,$Is_info_visible,$Bankcard_fid,$Carmodel_fid,$Role_systemuser_fid,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Name!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("name",$Name);
		if($Email!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("email",$Email);
		if($Tel!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("tel",$Tel);
		if($Mob!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("mob",$Mob);
		if($Postalcode!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("postalcode",$Postalcode);
		if($Ismale!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("ismale",$Ismale);
		if($Common_city_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("common_city_fid",$Common_city_fid);
		if($Birthday!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("birthday",$Birthday);
		if($Ispayed!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("ispayed",$Ispayed);
		if($Signupdate!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("signupdate",$Signupdate);
		if($Photo!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("photo",$Photo);
		if($Is_info_visible!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("is_info_visible",$Is_info_visible);
		if($Bankcard_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("bankcard_fid",$Bankcard_fid);
		if($Carmodel_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("carmodel_fid",$Carmodel_fid);
		if($Role_systemuser_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("role_systemuser_fid",$Role_systemuser_fid);
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
