<?php
namespace Modules\itsap\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-08-04 - 2018-10-26 00:59
*@lastUpdate 1397-08-04 - 2018-10-26 00:59
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class itsap_referenceEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("itsap_reference");
		$this->setTableTitle("ارجاع");
		$this->setTitleFieldName("message");

		/******** servicerequest_fid ********/
		$Servicerequest_fidInfo=new FieldInfo();
		$Servicerequest_fidInfo->setTitle("درخواست");
		$this->setFieldInfo(itsap_referenceEntity::$SERVICEREQUEST_FID,$Servicerequest_fidInfo);
		$this->addTableField('1',itsap_referenceEntity::$SERVICEREQUEST_FID);

		/******** message ********/
		$MessageInfo=new FieldInfo();
		$MessageInfo->setTitle("پیام");
		$this->setFieldInfo(itsap_referenceEntity::$MESSAGE,$MessageInfo);
		$this->addTableField('2',itsap_referenceEntity::$MESSAGE);

		/******** role_systemuser_fid ********/
		$Role_systemuser_fidInfo=new FieldInfo();
		$Role_systemuser_fidInfo->setTitle("کاربر");
		$this->setFieldInfo(itsap_referenceEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fidInfo);
		$this->addTableField('3',itsap_referenceEntity::$ROLE_SYSTEMUSER_FID);

		/******** unit_fid ********/
		$Unit_fidInfo=new FieldInfo();
		$Unit_fidInfo->setTitle("بخش");
		$this->setFieldInfo(itsap_referenceEntity::$UNIT_FID,$Unit_fidInfo);
		$this->addTableField('4',itsap_referenceEntity::$UNIT_FID);

		/******** employee_fid ********/
		$Employee_fidInfo=new FieldInfo();
		$Employee_fidInfo->setTitle("کارمند");
		$this->setFieldInfo(itsap_referenceEntity::$EMPLOYEE_FID,$Employee_fidInfo);
		$this->addTableField('5',itsap_referenceEntity::$EMPLOYEE_FID);

		/******** reference_time ********/
		$Reference_timeInfo=new FieldInfo();
		$Reference_timeInfo->setTitle("تاریخ ارجاع");
		$this->setFieldInfo(itsap_referenceEntity::$REFERENCE_TIME,$Reference_timeInfo);
		$this->addTableField('6',itsap_referenceEntity::$REFERENCE_TIME);
	}
	public static $SERVICEREQUEST_FID="servicerequest_fid";
	/**
	 * @return mixed
	 */
	public function getServicerequest_fid(){
		return $this->getField(itsap_referenceEntity::$SERVICEREQUEST_FID);
	}
	/**
	 * @param mixed $Servicerequest_fid
	 */
	public function setServicerequest_fid($Servicerequest_fid){
		$this->setField(itsap_referenceEntity::$SERVICEREQUEST_FID,$Servicerequest_fid);
	}
	public static $MESSAGE="message";
	/**
	 * @return mixed
	 */
	public function getMessage(){
		return $this->getField(itsap_referenceEntity::$MESSAGE);
	}
	/**
	 * @param mixed $Message
	 */
	public function setMessage($Message){
		$this->setField(itsap_referenceEntity::$MESSAGE,$Message);
	}
	public static $ROLE_SYSTEMUSER_FID="role_systemuser_fid";
	/**
	 * @return mixed
	 */
	public function getRole_systemuser_fid(){
		return $this->getField(itsap_referenceEntity::$ROLE_SYSTEMUSER_FID);
	}
	/**
	 * @param mixed $Role_systemuser_fid
	 */
	public function setRole_systemuser_fid($Role_systemuser_fid){
		$this->setField(itsap_referenceEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fid);
	}
	public static $UNIT_FID="unit_fid";
	/**
	 * @return mixed
	 */
	public function getUnit_fid(){
		return $this->getField(itsap_referenceEntity::$UNIT_FID);
	}
	/**
	 * @param mixed $Unit_fid
	 */
	public function setUnit_fid($Unit_fid){
		$this->setField(itsap_referenceEntity::$UNIT_FID,$Unit_fid);
	}
	public static $EMPLOYEE_FID="employee_fid";
	/**
	 * @return mixed
	 */
	public function getEmployee_fid(){
		return $this->getField(itsap_referenceEntity::$EMPLOYEE_FID);
	}
	/**
	 * @param mixed $Employee_fid
	 */
	public function setEmployee_fid($Employee_fid){
		$this->setField(itsap_referenceEntity::$EMPLOYEE_FID,$Employee_fid);
	}
	public static $REFERENCE_TIME="reference_time";
	/**
	 * @return mixed
	 */
	public function getReference_time(){
		return $this->getField(itsap_referenceEntity::$REFERENCE_TIME);
	}
	/**
	 * @param mixed $Reference_time
	 */
	public function setReference_time($Reference_time){
		$this->setField(itsap_referenceEntity::$REFERENCE_TIME,$Reference_time);
	}
}
?>