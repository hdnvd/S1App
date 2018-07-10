<?php

namespace Modules\products\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\selectQuery;


/**
 * @author nahavandi
 *
 */
class products_productproductgroupEntity extends EntityClass {
	/**
	 * @var selectQuery
	 */
	private $query;
	public function __construct()
	{
		$this->setDatabase(new dbquery());
		$this->setTableName("productproductgroup");
	}
	public function Insert($ProductID,$GroupID)
	{
		$this->getDatabase()->InsertInto($this->getTableName())
		->Set("product_fid", $ProductID)
		->Set("productgroup_fid", $GroupID)
		->Set("isdeleted", "0")
		->Execute();
	}
	public function Update($ID,$ProductID,$GroupID,$IsDeleted)
	{
		
		$Query=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("product_fid", $ProductID)
		->NotNullSet("productgroup_fid", $GroupID)
		->NotNullSet("isdeleted", $IsDeleted)
		->Where()->Equal("id", $ID);
 		//echo $Query->getQueryString();
		$Query->Execute();
	}
	public function Select($ID,$ProductID,$GroupID,$IsDeleted)
	{
		$this->query=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1", "1");
		if($ID!==null)
			$this->query=$this->query->AndLogic()->Equal("id", $ID);
		if($ProductID!==null)
			$this->query=$this->query->AndLogic()->Equal("product_fid", $ProductID);
		if($GroupID!==null)
			$this->query=$this->query->AndLogic()->Equal("productgroup_fid", $GroupID);
		if($IsDeleted!==null)
			$this->query=$this->query->AndLogic()->Equal("isdeleted", $IsDeleted);
// 		echo $this->query->getQueryString();
		return $this->query->ExecuteAssociated();
	}
}
?>
