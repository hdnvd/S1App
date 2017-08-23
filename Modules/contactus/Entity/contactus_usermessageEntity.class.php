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
 *@CreationDate 2015/06/04 20:30:11
 *@LastUpdate 2015/06/04 20:30:11
 *@TableFields name,family,tel,mobile,mail,message,date,ip,systeminfo,isread
 *@SweetFrameworkHelperVersion 1.102
 *@TableCreationSQL
 
CREATE TABLE IF NOT EXISTS contactus_usermessage (
`id` int(11) NOT NULL AUTO_INCREMENT,
name text NOT NULL,
family text NOT NULL,
tel text NOT NULL,
mobile text NOT NULL,
mail text NOT NULL,
message text NOT NULL,
date text NOT NULL,
ip text NOT NULL,
systeminfo text NOT NULL,
isread text NOT NULL,
`isdeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/


class contactus_usermessageEntity extends EntityClass {
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
		$this->setTableName("contactus_usermessage");
	}
	public function Insert($Name,$Family,$Tel,$Mobile,$Mail,$Message,$Date,$Ip,$Systeminfo,$Isread)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("name",$Name)
		->Set("family",$Family)
		->Set("tel",$Tel)
		->Set("mobile",$Mobile)
		->Set("mail",$Mail)
		->Set("message",$Message)
		->Set("date",$Date)
		->Set("ip",$Ip)
		->Set("systeminfo",$Systeminfo)
		->Set("isread",$Isread)
		->Set("isdeleted", "0");
		//echo $this->InsertQuery->getQueryString();
		//die();
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		return $InsertedID;
	}
	public function Update($ID,$Name,$Family,$Tel,$Mobile,$Mail,$Message,$Date,$Ip,$Systeminfo,$Isread)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("name",$Name)
		->NotNullSet("family",$Family)
		->NotNullSet("tel",$Tel)
		->NotNullSet("mobile",$Mobile)
		->NotNullSet("mail",$Mail)
		->NotNullSet("message",$Message)
		->NotNullSet("date",$Date)
		->NotNullSet("ip",$Ip)
		->NotNullSet("systeminfo",$Systeminfo)
		->NotNullSet("isread",$Isread)
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
	public function Select($ID,$Name,$Family,$Tel,$Mobile,$Mail,$Message,$Date,$Ip,$Systeminfo,$Isread,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Name!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("name",$Name);
		if($Family!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("family",$Family);
		if($Tel!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("tel",$Tel);
		if($Mobile!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("mobile",$Mobile);
		if($Mail!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("mail",$Mail);
		if($Message!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("message",$Message);
		if($Date!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("date",$Date);
		if($Ip!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("ip",$Ip);
		if($Systeminfo!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("systeminfo",$Systeminfo);
		if($Isread!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("isread",$Isread);
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
