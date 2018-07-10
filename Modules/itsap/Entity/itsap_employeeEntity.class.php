<?php
namespace Modules\itsap\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-17 - 2017-12-08 11:51
*@lastUpdate 1396-09-17 - 2017-12-08 11:51
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class itsap_employeeEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("itsap_employee");
		$this->setTableTitle("کارکنان");
		$this->setTitleFieldName("family");

		/******** unit_fid ********/
		$Unit_fidInfo=new FieldInfo();
		$Unit_fidInfo->setTitle("بخش");
		$this->setFieldInfo(itsap_employeeEntity::$UNIT_FID,$Unit_fidInfo);
		$this->addTableField('1',itsap_employeeEntity::$UNIT_FID);

		/******** emp_code ********/
		$Emp_codeInfo=new FieldInfo();
		$Emp_codeInfo->setTitle("کد استخدام");
		$this->setFieldInfo(itsap_employeeEntity::$EMP_CODE,$Emp_codeInfo);
		$this->addTableField('2',itsap_employeeEntity::$EMP_CODE);

		/******** mellicode ********/
		$MellicodeInfo=new FieldInfo();
		$MellicodeInfo->setTitle("کد ملی");
		$this->setFieldInfo(itsap_employeeEntity::$MELLICODE,$MellicodeInfo);
		$this->addTableField('3',itsap_employeeEntity::$MELLICODE);

		/******** name ********/
		$NameInfo=new FieldInfo();
		$NameInfo->setTitle("نام");
		$this->setFieldInfo(itsap_employeeEntity::$NAME,$NameInfo);
		$this->addTableField('4',itsap_employeeEntity::$NAME);

		/******** family ********/
		$FamilyInfo=new FieldInfo();
		$FamilyInfo->setTitle("نام خانوادگی");
		$this->setFieldInfo(itsap_employeeEntity::$FAMILY,$FamilyInfo);
		$this->addTableField('5',itsap_employeeEntity::$FAMILY);

		/******** mobile ********/
		$MobileInfo=new FieldInfo();
		$MobileInfo->setTitle("تلفن همراه");
		$this->setFieldInfo(itsap_employeeEntity::$MOBILE,$MobileInfo);
		$this->addTableField('6',itsap_employeeEntity::$MOBILE);

		/******** degree_fid ********/
		$Degree_fidInfo=new FieldInfo();
		$Degree_fidInfo->setTitle("درجه");
		$this->setFieldInfo(itsap_employeeEntity::$DEGREE_FID,$Degree_fidInfo);
		$this->addTableField('7',itsap_employeeEntity::$DEGREE_FID);

		/******** role_systemuser_fid ********/
		$Role_systemuser_fidInfo=new FieldInfo();
		$Role_systemuser_fidInfo->setTitle("role_systemuser_fid");
		$this->setFieldInfo(itsap_employeeEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fidInfo);
		$this->addTableField('8',itsap_employeeEntity::$ROLE_SYSTEMUSER_FID);
	}
	public static $UNIT_FID="unit_fid";
	/**
	 * @return mixed
	 */
	public function getUnit_fid(){
		return $this->getField(itsap_employeeEntity::$UNIT_FID);
	}
	/**
	 * @param mixed $Unit_fid
	 */
	public function setUnit_fid($Unit_fid){
		$this->setField(itsap_employeeEntity::$UNIT_FID,$Unit_fid);
	}
	public static $EMP_CODE="emp_code";
	/**
	 * @return mixed
	 */
	public function getEmp_code(){
		return $this->getField(itsap_employeeEntity::$EMP_CODE);
	}
	/**
	 * @param mixed $Emp_code
	 */
	public function setEmp_code($Emp_code){
		$this->setField(itsap_employeeEntity::$EMP_CODE,$Emp_code);
	}
	public static $MELLICODE="mellicode";
	/**
	 * @return mixed
	 */
	public function getMellicode(){
		return $this->getField(itsap_employeeEntity::$MELLICODE);
	}
	/**
	 * @param mixed $Mellicode
	 */
	public function setMellicode($Mellicode){
		$this->setField(itsap_employeeEntity::$MELLICODE,$Mellicode);
	}
	public static $NAME="name";
	/**
	 * @return mixed
	 */
	public function getName(){
		return $this->getField(itsap_employeeEntity::$NAME);
	}
	/**
	 * @param mixed $Name
	 */
	public function setName($Name){
		$this->setField(itsap_employeeEntity::$NAME,$Name);
	}
	public static $FAMILY="family";
	/**
	 * @return mixed
	 */
	public function getFamily(){
		return $this->getField(itsap_employeeEntity::$FAMILY);
	}
	/**
	 * @param mixed $Family
	 */
	public function setFamily($Family){
		$this->setField(itsap_employeeEntity::$FAMILY,$Family);
	}
	public static $MOBILE="mobile";
	/**
	 * @return mixed
	 */
	public function getMobile(){
		return $this->getField(itsap_employeeEntity::$MOBILE);
	}
	/**
	 * @param mixed $Mobile
	 */
	public function setMobile($Mobile){
		$this->setField(itsap_employeeEntity::$MOBILE,$Mobile);
	}
	public static $DEGREE_FID="degree_fid";
	/**
	 * @return mixed
	 */
	public function getDegree_fid(){
		return $this->getField(itsap_employeeEntity::$DEGREE_FID);
	}
	/**
	 * @param mixed $Degree_fid
	 */
	public function setDegree_fid($Degree_fid){
		$this->setField(itsap_employeeEntity::$DEGREE_FID,$Degree_fid);
	}
	public static $ROLE_SYSTEMUSER_FID="role_systemuser_fid";
	/**
	 * @return mixed
	 */
	public function getRole_systemuser_fid(){
		return $this->getField(itsap_employeeEntity::$ROLE_SYSTEMUSER_FID);
	}
	/**
	 * @param mixed $Role_systemuser_fid
	 */
	public function setRole_systemuser_fid($Role_systemuser_fid){
		$this->setField(itsap_employeeEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fid);
	}
}
?>