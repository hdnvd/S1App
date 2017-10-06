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
 *@CreationDate 2016/05/16 23:06:44
 *@LastUpdate 2016/05/16 23:06:44
 *@TableName form
 *@TableFields name t,caption t,module_fid t,isenabled b
 *@SweetFrameworkHelperVersion 1.110
 *@TableCreationSQL
 
CREATE TABLE IF NOT EXISTS sweetp_form (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` text NOT NULL,
`caption` text NOT NULL,
`module_fid` text NOT NULL,
`isenabled` tinyint(1) NOT NULL,
`deletetime` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/


class sfman_formEntity extends EntityClass {
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
		$this->setTableName("form");
	}
	public function Insert($Name,$Caption,$Module_fid,$Isenabled)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("name",$Name)
		->Set("caption",$Caption)
		->Set("module_fid",$Module_fid)
		->Set("isenabled",$Isenabled)
		->Set("deletetime", "-1");
		//echo $this->InsertQuery->getQueryString();
		//die();
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		return $InsertedID;
	}
	public function Update($ID,$Name,$Caption,$Module_fid,$Isenabled)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("name",$Name)
		->NotNullSet("caption",$Caption)
		->NotNullSet("module_fid",$Module_fid)
		->NotNullSet("isenabled",$Isenabled)
		->Where()->Smaller("deletetime", "0")->AndLogic()->Equal("id",$ID);
		//echo $this->UpdateQuery->getQueryString();
		//die();
		$this->UpdateQuery->Execute();
	}
	public function Delete($ID)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->Set("deletetime", time())
		->Where()->Smaller("deletetime", "1")->AndLogic()->Equal("id",$ID);
//		echo $this->UpdateQuery->getQueryString();
		//die();
		$this->UpdateQuery->Execute();
	}
	public function Select($ID,$Name,$Caption,$Module_fid,$Isenabled,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Name!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("name",$Name);
		if($Caption!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("caption",$Caption);
		if($Module_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("module_fid",$Module_fid);
		if($Isenabled!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("isenabled",$Isenabled);
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
