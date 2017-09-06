<?php
namespace Modules\finance\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-15 - 2017-09-06 13:18
*@lastUpdate 1396-06-15 - 2017-09-06 13:18
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class finance_transactionEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("finance_transaction");
	}
	public static $AMOUNT="amount";
	/**
	 * @return mixed
	 */
	public function getAmount(){
		return $this->getField(finance_transactionEntity::$AMOUNT);
	}
	/**
	 * @param mixed $Amount
	 */
	public function setAmount($Amount){
		$this->setField(finance_transactionEntity::$AMOUNT,$Amount);
	}
	public static $DESCRIPTION="description";
	/**
	 * @return mixed
	 */
	public function getDescription(){
		return $this->getField(finance_transactionEntity::$DESCRIPTION);
	}
	/**
	 * @param mixed $Description
	 */
	public function setDescription($Description){
		$this->setField(finance_transactionEntity::$DESCRIPTION,$Description);
	}
	public static $ADD_TIME="add_time";
	/**
	 * @return mixed
	 */
	public function getAdd_time(){
		return $this->getField(finance_transactionEntity::$ADD_TIME);
	}
	/**
	 * @param mixed $Add_time
	 */
	public function setAdd_time($Add_time){
		$this->setField(finance_transactionEntity::$ADD_TIME,$Add_time);
	}
	public static $COMMIT_TIME="commit_time";
	/**
	 * @return mixed
	 */
	public function getCommit_time(){
		return $this->getField(finance_transactionEntity::$COMMIT_TIME);
	}
	/**
	 * @param mixed $Commit_time
	 */
	public function setCommit_time($Commit_time){
		$this->setField(finance_transactionEntity::$COMMIT_TIME,$Commit_time);
	}
	public static $ROLE_SYSTEMUSER_FID="role_systemuser_fid";
	/**
	 * @return mixed
	 */
	public function getRole_systemuser_fid(){
		return $this->getField(finance_transactionEntity::$ROLE_SYSTEMUSER_FID);
	}
	/**
	 * @param mixed $Role_systemuser_fid
	 */
	public function setRole_systemuser_fid($Role_systemuser_fid){
		$this->setField(finance_transactionEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fid);
	}
	public static $ISSUCCESSFUL="issuccessful";
	/**
	 * @return mixed
	 */
	public function getIssuccessful(){
		return $this->getField(finance_transactionEntity::$ISSUCCESSFUL);
	}
	/**
	 * @param mixed $Issuccessful
	 */
	public function setIssuccessful($Issuccessful){
		$this->setField(finance_transactionEntity::$ISSUCCESSFUL,$Issuccessful);
	}
	public static $CHAPTER_FID="chapter_fid";
	/**
	 * @return mixed
	 */
	public function getChapter_fid(){
		return $this->getField(finance_transactionEntity::$CHAPTER_FID);
	}
	/**
	 * @param mixed $Chapter_fid
	 */
	public function setChapter_fid($Chapter_fid){
		$this->setField(finance_transactionEntity::$CHAPTER_FID,$Chapter_fid);
	}
}
?>