<?php
namespace Modules\finance\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-07 - 2017-11-28 18:02
*@lastUpdate 1396-09-07 - 2017-11-28 18:02
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class finance_payrequestEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("finance_payrequest");
		$this->setTableTitle("finance_payrequest");
		$this->setTitleFieldName("id");

		/******** role_systemuser_fid ********/
		$Role_systemuser_fidInfo=new FieldInfo();
		$Role_systemuser_fidInfo->setTitle("role_systemuser_fid");
		$this->setFieldInfo(finance_payrequestEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fidInfo);
		$this->addTableField('1',finance_payrequestEntity::$ROLE_SYSTEMUSER_FID);

		/******** request_date ********/
		$Request_dateInfo=new FieldInfo();
		$Request_dateInfo->setTitle("request_date");
		$this->setFieldInfo(finance_payrequestEntity::$REQUEST_DATE,$Request_dateInfo);
		$this->addTableField('2',finance_payrequestEntity::$REQUEST_DATE);

		/******** price ********/
		$PriceInfo=new FieldInfo();
		$PriceInfo->setTitle("price");
		$this->setFieldInfo(finance_payrequestEntity::$PRICE,$PriceInfo);
		$this->addTableField('3',finance_payrequestEntity::$PRICE);

		/******** commit_date ********/
		$Commit_dateInfo=new FieldInfo();
		$Commit_dateInfo->setTitle("commit_date");
		$this->setFieldInfo(finance_payrequestEntity::$COMMIT_DATE,$Commit_dateInfo);
		$this->addTableField('4',finance_payrequestEntity::$COMMIT_DATE);

		/******** committype_fid ********/
		$Committype_fidInfo=new FieldInfo();
		$Committype_fidInfo->setTitle("committype_fid");
		$this->setFieldInfo(finance_payrequestEntity::$COMMITTYPE_FID,$Committype_fidInfo);
		$this->addTableField('5',finance_payrequestEntity::$COMMITTYPE_FID);
	}
	public static $ROLE_SYSTEMUSER_FID="role_systemuser_fid";
	/**
	 * @return mixed
	 */
	public function getRole_systemuser_fid(){
		return $this->getField(finance_payrequestEntity::$ROLE_SYSTEMUSER_FID);
	}
	/**
	 * @param mixed $Role_systemuser_fid
	 */
	public function setRole_systemuser_fid($Role_systemuser_fid){
		$this->setField(finance_payrequestEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fid);
	}
	public static $REQUEST_DATE="request_date";
	/**
	 * @return mixed
	 */
	public function getRequest_date(){
		return $this->getField(finance_payrequestEntity::$REQUEST_DATE);
	}
	/**
	 * @param mixed $Request_date
	 */
	public function setRequest_date($Request_date){
		$this->setField(finance_payrequestEntity::$REQUEST_DATE,$Request_date);
	}
	public static $PRICE="price";
	/**
	 * @return mixed
	 */
	public function getPrice(){
		return $this->getField(finance_payrequestEntity::$PRICE);
	}
	/**
	 * @param mixed $Price
	 */
	public function setPrice($Price){
		$this->setField(finance_payrequestEntity::$PRICE,$Price);
	}
	public static $COMMIT_DATE="commit_date";
	/**
	 * @return mixed
	 */
	public function getCommit_date(){
		return $this->getField(finance_payrequestEntity::$COMMIT_DATE);
	}
	/**
	 * @param mixed $Commit_date
	 */
	public function setCommit_date($Commit_date){
		$this->setField(finance_payrequestEntity::$COMMIT_DATE,$Commit_date);
	}
	public static $COMMITTYPE_FID="committype_fid";
	/**
	 * @return mixed
	 */
	public function getCommittype_fid(){
		return $this->getField(finance_payrequestEntity::$COMMITTYPE_FID);
	}
	/**
	 * @param mixed $Committype_fid
	 */
	public function setCommittype_fid($Committype_fid){
		$this->setField(finance_payrequestEntity::$COMMITTYPE_FID,$Committype_fid);
	}
}
?>