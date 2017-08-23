<?php

namespace Modules\users\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\selectQuery;
use core\CoreClasses\db\updateQuery;
use core\CoreClasses\db\insertQuery;


/**
 *@author Hadi AmirNahavandi
 *@CreationDate 2015/02/12 00:10:51
 *@LastUpdate 2015/02/12 00:10:51
 *@TableFields userinfo_field,userinfo_fieldcaption,isenabled
*/


class role_userinfostatusEntity extends EntityClass {
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
	public function __construct()
	{
		$this->setDatabase(new dbquery());
		$this->setTableName("role_userinfostatus");
	}
	public function Insert($Userinfo_field,$Userinfo_fieldcaption,$Isenabled)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("userinfo_field",$Userinfo_field)
		->Set("userinfo_fieldcaption",$Userinfo_fieldcaption)
		->Set("isenabled",$Isenabled)
		->Set("isdeleted", "0");
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		//echo $this->InsertQuery->getQueryString();
		//die();
		return $InsertedID;
	}
	public function Update($ID,$Userinfo_field,$Userinfo_fieldcaption,$Isenabled)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("userinfo_field",$Userinfo_field)
		->NotNullSet("userinfo_fieldcaption",$Userinfo_fieldcaption)
		->NotNullSet("isenabled",$Isenabled)
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
	public function Select($ID,$Userinfo_field,$Userinfo_fieldcaption,$Isenabled,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Userinfo_field!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("userinfo_field",$Userinfo_field);
		if($Userinfo_fieldcaption!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("userinfo_fieldcaption",$Userinfo_fieldcaption);
		if($Isenabled!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("isenabled",$Isenabled);
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
