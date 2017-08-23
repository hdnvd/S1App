<?php

namespace Modules\sfman\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\selectQuery;
use core\CoreClasses\db\updateQuery;
use core\CoreClasses\db\insertQuery;
use core\CoreClasses\db\dbaccess;


/**
 *@author Hadi AmirNahavandi
 *@CreationDate 1395/11/7 - 2017/01/26 18:42:30
 *@LastUpdate 1395/11/7 - 2017/01/26 18:42:30
 *@TableName formelement
 *@TableFields form_fid t,type_fid i,name t,caption t,priority i
 *@SweetFrameworkHelperVersion 1.112
 *@TableCreationSQL

CREATE TABLE IF NOT EXISTS sweetp_sfman_formelement (
`id` int(11) NOT NULL AUTO_INCREMENT,
`form_fid` text NOT NULL,
`type_fid` int(11) NOT NULL,
`name` text NOT NULL,
`caption` text NOT NULL,
`priority` int(11) NOT NULL,
`deletetime` text NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
 */


class sfman_formelementEntity extends EntityClass {
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
		$this->setTableName("sfman_formelement");
	}
	public function Insert($Form_fid,$Type_fid,$Name,$Caption,$Priority)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
			->Set("form_fid",$Form_fid)
			->Set("type_fid",$Type_fid)
			->Set("name",$Name)
			->Set("caption",$Caption)
			->Set("priority",$Priority)
			->Set("deletetime", "-1");
		//echo $this->InsertQuery->getQueryString();
		//die();
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		return $InsertedID;
	}
	public function Update($ID,$Form_fid,$Type_fid,$Name,$Caption,$Priority)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
			->NotNullSet("form_fid",$Form_fid)
			->NotNullSet("type_fid",$Type_fid)
			->NotNullSet("name",$Name)
			->NotNullSet("caption",$Caption)
			->NotNullSet("priority",$Priority)
			->Where()->Smaller("deletetime", "0")->AndLogic()->Equal("id",$ID);
//		echo $this->UpdateQuery->getQueryString();
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
	public function Select($ID,$Form_fid,$Type_fid,$Name,$Caption,$Priority,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Form_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("form_fid",$Form_fid);
		if($Type_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("type_fid",$Type_fid);
		if($Name!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("name",$Name);
		if($Caption!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("caption",$Caption);
		if($Priority!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("priority",$Priority);
		for($i=0;$OrderByFields!==null && $i<count($OrderByFields);$i++)
			$this->SelectQuery=$this->SelectQuery->AddOrderBy($OrderByFields[$i], $IsDescendings[$i]);
		if($Limit!==null)
			$this->SelectQuery=$this->SelectQuery->setLimit($Limit);
		$this->SelectQuery=$this->SelectQuery->AndLogic()->Smaller("deletetime", "0");
//		echo $this->SelectQuery->getQueryString();
		//die();
		return $this->SelectQuery->ExecuteAssociated();
	}
}
?>
