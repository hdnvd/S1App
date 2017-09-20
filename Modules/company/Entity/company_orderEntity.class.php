<?php
namespace Modules\company\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-29 - 2017-09-20 02:33
*@lastUpdate 1396-06-29 - 2017-09-20 02:33
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class company_orderEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("company_order");
	}
	public static $DESCRIPTIONS="descriptions";
	/**
	 * @return mixed
	 */
	public function getDescriptions(){
		return $this->getField(company_orderEntity::$DESCRIPTIONS);
	}
	/**
	 * @param mixed $Descriptions
	 */
	public function setDescriptions($Descriptions){
		$this->setField(company_orderEntity::$DESCRIPTIONS,$Descriptions);
	}
	public static $SIMILARPRODUCTS="similarproducts";
	/**
	 * @return mixed
	 */
	public function getSimilarproducts(){
		return $this->getField(company_orderEntity::$SIMILARPRODUCTS);
	}
	/**
	 * @param mixed $Similarproducts
	 */
	public function setSimilarproducts($Similarproducts){
		$this->setField(company_orderEntity::$SIMILARPRODUCTS,$Similarproducts);
	}
	public static $EMAIL="email";
	/**
	 * @return mixed
	 */
	public function getEmail(){
		return $this->getField(company_orderEntity::$EMAIL);
	}
	/**
	 * @param mixed $Email
	 */
	public function setEmail($Email){
		$this->setField(company_orderEntity::$EMAIL,$Email);
	}
	public static $ORDERDATE="orderdate";
	/**
	 * @return mixed
	 */
	public function getOrderdate(){
		return $this->getField(company_orderEntity::$ORDERDATE);
	}
	/**
	 * @param mixed $Orderdate
	 */
	public function setOrderdate($Orderdate){
		$this->setField(company_orderEntity::$ORDERDATE,$Orderdate);
	}
	public static $MOBILE="mobile";
	/**
	 * @return mixed
	 */
	public function getMobile(){
		return $this->getField(company_orderEntity::$MOBILE);
	}
	/**
	 * @param mixed $Mobile
	 */
	public function setMobile($Mobile){
		$this->setField(company_orderEntity::$MOBILE,$Mobile);
	}
	public static $NAME="name";
	/**
	 * @return mixed
	 */
	public function getName(){
		return $this->getField(company_orderEntity::$NAME);
	}
	/**
	 * @param mixed $Name
	 */
	public function setName($Name){
		$this->setField(company_orderEntity::$NAME,$Name);
	}
	public static $FAMILY="family";
	/**
	 * @return mixed
	 */
	public function getFamily(){
		return $this->getField(company_orderEntity::$FAMILY);
	}
	/**
	 * @param mixed $Family
	 */
	public function setFamily($Family){
		$this->setField(company_orderEntity::$FAMILY,$Family);
	}
	public static $PAYDATE="paydate";
	/**
	 * @return mixed
	 */
	public function getPaydate(){
		return $this->getField(company_orderEntity::$PAYDATE);
	}
	/**
	 * @param mixed $Paydate
	 */
	public function setPaydate($Paydate){
		$this->setField(company_orderEntity::$PAYDATE,$Paydate);
	}
	public static $PACKAGE_FID="package_fid";
	/**
	 * @return mixed
	 */
	public function getPackage_fid(){
		return $this->getField(company_orderEntity::$PACKAGE_FID);
	}
	/**
	 * @param mixed $Package_fid
	 */
	public function setPackage_fid($Package_fid){
		$this->setField(company_orderEntity::$PACKAGE_FID,$Package_fid);
	}
	public static $FINANCE_TRANSACTION_FID="finance_transaction_fid";
	/**
	 * @return mixed
	 */
	public function getFinance_transaction_fid(){
		return $this->getField(company_orderEntity::$FINANCE_TRANSACTION_FID);
	}
	/**
	 * @param mixed $Finance_transaction_fid
	 */
	public function setFinance_transaction_fid($Finance_transaction_fid){
		$this->setField(company_orderEntity::$FINANCE_TRANSACTION_FID,$Finance_transaction_fid);
	}
	public static $PREPAYMENT_FINANCE_TRANSACTION_FID="prepayment_finance_transaction_fid";
	/**
	 * @return mixed
	 */
	public function getPrepayment_finance_transaction_fid(){
		return $this->getField(company_orderEntity::$PREPAYMENT_FINANCE_TRANSACTION_FID);
	}
	/**
	 * @param mixed $Prepayment_finance_transaction_fid
	 */
	public function setPrepayment_finance_transaction_fid($Prepayment_finance_transaction_fid){
		$this->setField(company_orderEntity::$PREPAYMENT_FINANCE_TRANSACTION_FID,$Prepayment_finance_transaction_fid);
	}
	public static $ORDERSERIAL="orderserial";
	/**
	 * @return mixed
	 */
	public function getOrderserial(){
		return $this->getField(company_orderEntity::$ORDERSERIAL);
	}
	/**
	 * @param mixed $Orderserial
	 */
	public function setOrderserial($Orderserial){
		$this->setField(company_orderEntity::$ORDERSERIAL,$Orderserial);
	}
}
?>