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
 *@CreationDate 2015/08/13 18:52:43
 *@LastUpdate 2015/08/13 18:52:43
 *@TableName sweetapp
 *@TableFields name t,lastversion t,platforms t,customerphone t,customername t,customersite t,price t,payed t,lastrelease t
 *@SweetFrameworkHelperVersion 1.107
 *@TableCreationSQL
 
CREATE TABLE IF NOT EXISTS contactus_sweetapp (
`id` int(11) NOT NULL AUTO_INCREMENT,
name text NOT NULL,
lastversion text NOT NULL,
platforms text NOT NULL,
customerphone text NOT NULL,
customername text NOT NULL,
customersite text NOT NULL,
price text NOT NULL,
payed text NOT NULL,
lastrelease text NOT NULL,
`isdeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/


class contactus_sweetappEntity extends EntityClass {
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
		$this->setTableName("contactus_sweetapp");
	}
	public function Insert($Name,$Lastversion,$Platforms,$Customerphone,$Customername,$Customersite,$Price,$Payed,$Lastrelease)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("name",$Name)
		->Set("lastversion",$Lastversion)
		->Set("platforms",$Platforms)
		->Set("customerphone",$Customerphone)
		->Set("customername",$Customername)
		->Set("customersite",$Customersite)
		->Set("price",$Price)
		->Set("payed",$Payed)
		->Set("lastrelease",$Lastrelease)
		->Set("isdeleted", "0");
		//echo $this->InsertQuery->getQueryString();
		//die();
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		return $InsertedID;
	}
	public function Update($ID,$Name,$Lastversion,$Platforms,$Customerphone,$Customername,$Customersite,$Price,$Payed,$Lastrelease)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("name",$Name)
		->NotNullSet("lastversion",$Lastversion)
		->NotNullSet("platforms",$Platforms)
		->NotNullSet("customerphone",$Customerphone)
		->NotNullSet("customername",$Customername)
		->NotNullSet("customersite",$Customersite)
		->NotNullSet("price",$Price)
		->NotNullSet("payed",$Payed)
		->NotNullSet("lastrelease",$Lastrelease)
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
	public function Select($ID,$Name,$Lastversion,$Platforms,$Customerphone,$Customername,$Customersite,$Price,$Payed,$Lastrelease,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Name!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("name",$Name);
		if($Lastversion!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("lastversion",$Lastversion);
		if($Platforms!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("platforms",$Platforms);
		if($Customerphone!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("customerphone",$Customerphone);
		if($Customername!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("customername",$Customername);
		if($Customersite!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("customersite",$Customersite);
		if($Price!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("price",$Price);
		if($Payed!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("payed",$Payed);
		if($Lastrelease!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("lastrelease",$Lastrelease);
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
