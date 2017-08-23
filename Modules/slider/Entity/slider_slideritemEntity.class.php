<?php

namespace Modules\slider\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\selectQuery;


class slider_slideritemEntity extends EntityClass {
	/**
	 * @var selectQuery
	 */
	private $SelectQuery;
	public function __construct()
	{
		$this->setDatabase(new dbquery());
		$this->setTableName("slider_slideritem");
	}
	/**
	 * @param Integer $ID
	 * @param string or null $Title
	 * @param string or null $PhotoURL
	 * @param string or null $Priority
	 * @param Boolean $OrderDesc
	 * @param string $Limit
	 */
	public function select($ID=null,$Title=null,$PhotoURL=null,$Priority=null,$OrderDesc=false,$Limit="0,15")
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName());
 		$this->SelectQuery->Where()->Equal("isdeleted", "0");
 		if($ID!==null)
 			$this->SelectQuery->AndLogic()->Equal("id", $ID);
 		if($Title!==null)
 			$this->SelectQuery->AndLogic()->Like("title", $Title);
 		if($PhotoURL!==null)
 			$this->SelectQuery->AndLogic()->Like("photourl", $PhotoURL);
 		if($Priority!==null)
 			$this->SelectQuery->AndLogic()->Equal("priority", $Priority);
 		$this->SelectQuery->AddOrderBy("priority", $OrderDesc);
 		$this->SelectQuery->AddOrderBy("id", $OrderDesc);
 		$this->SelectQuery->setLimit($Limit);	
 		return $this->SelectQuery->ExecuteAssociated();
	}
	public function Insert($Title,$PhotoURL,$Priority)
	{
		$Query=$this->Database->InsertInto($this->getTableName())
		->Set("title", $Title)
		->Set("photourl", $PhotoURL)
		->Set("priority", $Priority)
		->Set("isdeleted", "0");
		$Query->Execute();
		return $Query->getInsertedId();
	}
	public function Update($ID,$Title=null,$PhotoURL=null,$Priority=null)
	{
		$Query=$this->Database->Update($this->getTableName())
		->NotNullSet("title", $Title)
		->NotNullSet("photourl", $PhotoURL)
		->NotNullSet("priority", $Priority)
		->where()
		->Equal("id", $ID)->AndLogic()->Equal("isdeleted", "0");
		$Query->Execute();
		return true;
	}
	public function Delete($ID)
	{
		$Query=$this->Database->Update($this->getTableName())
		->Set("isdeleted", "1")
		->where()
		->Equal("id", $ID);
		$Query->Execute();
		return true;
	}
}
?>
