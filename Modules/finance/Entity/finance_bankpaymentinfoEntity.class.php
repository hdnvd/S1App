<?php
namespace Modules\finance\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-14 - 2017-09-05 20:53
*@lastUpdate 1396-06-14 - 2017-09-05 20:53
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class finance_bankpaymentinfoEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("finance_bankpaymentinfo");
	}
	public static $CARDNUMBER="cardnumber";
	/**
	 * @return mixed
	 */
	public function getCardnumber(){
		return $this->getField(finance_bankpaymentinfoEntity::$CARDNUMBER);
	}
	/**
	 * @param mixed $Cardnumber
	 */
	public function setCardnumber($Cardnumber){
		$this->setField(finance_bankpaymentinfoEntity::$CARDNUMBER,$Cardnumber);
	}
	public static $FACTORSERIAL="factorserial";
	/**
	 * @return mixed
	 */
	public function getFactorserial(){
		return $this->getField(finance_bankpaymentinfoEntity::$FACTORSERIAL);
	}
	/**
	 * @param mixed $Factorserial
	 */
	public function setFactorserial($Factorserial){
		$this->setField(finance_bankpaymentinfoEntity::$FACTORSERIAL,$Factorserial);
	}
	public static $BANKTRANSACTIONID="banktransactionid";
	/**
	 * @return mixed
	 */
	public function getBanktransactionid(){
		return $this->getField(finance_bankpaymentinfoEntity::$BANKTRANSACTIONID);
	}
	/**
	 * @param mixed $Banktransactionid
	 */
	public function setBanktransactionid($Banktransactionid){
		$this->setField(finance_bankpaymentinfoEntity::$BANKTRANSACTIONID,$Banktransactionid);
	}
	public static $STATUS_FID="status_fid";
	/**
	 * @return mixed
	 */
	public function getStatus_fid(){
		return $this->getField(finance_bankpaymentinfoEntity::$STATUS_FID);
	}
	/**
	 * @param mixed $Status_fid
	 */
	public function setStatus_fid($Status_fid){
		$this->setField(finance_bankpaymentinfoEntity::$STATUS_FID,$Status_fid);
	}
	public static $PORTAL_FID="portal_fid";
	/**
	 * @return mixed
	 */
	public function getPortal_fid(){
		return $this->getField(finance_bankpaymentinfoEntity::$PORTAL_FID);
	}
	/**
	 * @param mixed $Portal_fid
	 */
	public function setPortal_fid($Portal_fid){
		$this->setField(finance_bankpaymentinfoEntity::$PORTAL_FID,$Portal_fid);
	}
	public static $NAME="name";
	/**
	 * @return mixed
	 */
	public function getName(){
		return $this->getField(finance_bankpaymentinfoEntity::$NAME);
	}
	/**
	 * @param mixed $Name
	 */
	public function setName($Name){
		$this->setField(finance_bankpaymentinfoEntity::$NAME,$Name);
	}
	public static $FAMILY="family";
	/**
	 * @return mixed
	 */
	public function getFamily(){
		return $this->getField(finance_bankpaymentinfoEntity::$FAMILY);
	}
	/**
	 * @param mixed $Family
	 */
	public function setFamily($Family){
		$this->setField(finance_bankpaymentinfoEntity::$FAMILY,$Family);
	}
	public static $PHONENUMBER="phonenumber";
	/**
	 * @return mixed
	 */
	public function getPhonenumber(){
		return $this->getField(finance_bankpaymentinfoEntity::$PHONENUMBER);
	}
	/**
	 * @param mixed $Phonenumber
	 */
	public function setPhonenumber($Phonenumber){
		$this->setField(finance_bankpaymentinfoEntity::$PHONENUMBER,$Phonenumber);
	}
	public static $TRANSACTION_FID="transaction_fid";
	/**
	 * @return mixed
	 */
	public function getTransaction_fid(){
		return $this->getField(finance_bankpaymentinfoEntity::$TRANSACTION_FID);
	}
	/**
	 * @param mixed $Transaction_fid
	 */
	public function setTransaction_fid($Transaction_fid){
		$this->setField(finance_bankpaymentinfoEntity::$TRANSACTION_FID,$Transaction_fid);
	}
}
?>