<?php
namespace Modules\company\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-28 - 2017-09-19 16:34
*@lastUpdate 1396-06-28 - 2017-09-19 16:34
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class company_packageEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("company_package");
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(company_packageEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(company_packageEntity::$TITLE,$Title);
	}
	public static $PRICE="price";
	/**
	 * @return mixed
	 */
	public function getPrice(){
		return $this->getField(company_packageEntity::$PRICE);
	}
	/**
	 * @param mixed $Price
	 */
	public function setPrice($Price){
		$this->setField(company_packageEntity::$PRICE,$Price);
	}
	public static $PREPAYMENT="prepayment";
	/**
	 * @return mixed
	 */
	public function getPrepayment(){
		return $this->getField(company_packageEntity::$PREPAYMENT);
	}
	/**
	 * @param mixed $Prepayment
	 */
	public function setPrepayment($Prepayment){
		$this->setField(company_packageEntity::$PREPAYMENT,$Prepayment);
	}
}
?>