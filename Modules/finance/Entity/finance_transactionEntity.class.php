<?php
namespace Modules\finance\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-09 - 2018-01-29 11:25
*@lastUpdate 1396-11-09 - 2018-01-29 11:25
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class finance_transactionEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("finance_transaction");
		$this->setTableTitle("تراکنش");
		$this->setTitleFieldName("description");

		/******** amount ********/
		$AmountInfo=new FieldInfo();
		$AmountInfo->setTitle("مبلغ");
		$this->setFieldInfo(finance_transactionEntity::$AMOUNT,$AmountInfo);
		$this->addTableField('1',finance_transactionEntity::$AMOUNT);

		/******** description ********/
		$DescriptionInfo=new FieldInfo();
		$DescriptionInfo->setTitle("توضیحات");
		$this->setFieldInfo(finance_transactionEntity::$DESCRIPTION,$DescriptionInfo);
		$this->addTableField('2',finance_transactionEntity::$DESCRIPTION);

		/******** add_time ********/
		$Add_timeInfo=new FieldInfo();
		$Add_timeInfo->setTitle("تاریخ ثبت");
		$this->setFieldInfo(finance_transactionEntity::$ADD_TIME,$Add_timeInfo);
		$this->addTableField('3',finance_transactionEntity::$ADD_TIME);

		/******** commit_time ********/
		$Commit_timeInfo=new FieldInfo();
		$Commit_timeInfo->setTitle("تاریخ تایید");
		$this->setFieldInfo(finance_transactionEntity::$COMMIT_TIME,$Commit_timeInfo);
		$this->addTableField('4',finance_transactionEntity::$COMMIT_TIME);

		/******** role_systemuser_fid ********/
		$Role_systemuser_fidInfo=new FieldInfo();
		$Role_systemuser_fidInfo->setTitle("role_systemuser_fid");
		$this->setFieldInfo(finance_transactionEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fidInfo);
		$this->addTableField('5',finance_transactionEntity::$ROLE_SYSTEMUSER_FID);

		/******** issuccessful ********/
		$IssuccessfulInfo=new FieldInfo();
		$IssuccessfulInfo->setTitle("موفق");
		$this->setFieldInfo(finance_transactionEntity::$ISSUCCESSFUL,$IssuccessfulInfo);
		$this->addTableField('6',finance_transactionEntity::$ISSUCCESSFUL);

		/******** chapter_fid ********/
		$Chapter_fidInfo=new FieldInfo();
		$Chapter_fidInfo->setTitle("سرفصل");
		$this->setFieldInfo(finance_transactionEntity::$CHAPTER_FID,$Chapter_fidInfo);
		$this->addTableField('7',finance_transactionEntity::$CHAPTER_FID);
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