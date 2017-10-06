<?php
namespace Modules\oras\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-12 - 2017-10-04 03:01
*@lastUpdate 1396-07-12 - 2017-10-04 03:01
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class oras_employeeroleEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("oras_employeerole");
		$this->setTableTitle("سمت کارمند");
		$this->setTitleFieldName("id");

		/******** employee_fid ********/
		$Employee_fidInfo=new FieldInfo();
		$Employee_fidInfo->setTitle("کارمند");
		$this->setFieldInfo(oras_employeeroleEntity::$EMPLOYEE_FID,$Employee_fidInfo);
		$this->addTableField('1',oras_employeeroleEntity::$EMPLOYEE_FID);

		/******** role_fid ********/
		$Role_fidInfo=new FieldInfo();
		$Role_fidInfo->setTitle("سمت");
		$this->setFieldInfo(oras_employeeroleEntity::$ROLE_FID,$Role_fidInfo);
		$this->addTableField('2',oras_employeeroleEntity::$ROLE_FID);

		/******** recruitmenttype_fid ********/
		$Recruitmenttype_fidInfo=new FieldInfo();
		$Recruitmenttype_fidInfo->setTitle("recruitmenttype_fid");
		$this->setFieldInfo(oras_employeeroleEntity::$RECRUITMENTTYPE_FID,$Recruitmenttype_fidInfo);
		$this->addTableField('3',oras_employeeroleEntity::$RECRUITMENTTYPE_FID);

		/******** place_fid ********/
		$Place_fidInfo=new FieldInfo();
		$Place_fidInfo->setTitle("بخش");
		$this->setFieldInfo(oras_employeeroleEntity::$PLACE_FID,$Place_fidInfo);
		$this->addTableField('4',oras_employeeroleEntity::$PLACE_FID);

		/******** start_time ********/
		$Start_timeInfo=new FieldInfo();
		$Start_timeInfo->setTitle("تاریخ شروع");
		$this->setFieldInfo(oras_employeeroleEntity::$START_TIME,$Start_timeInfo);
		$this->addTableField('5',oras_employeeroleEntity::$START_TIME);
	}
	public static $EMPLOYEE_FID="employee_fid";
	/**
	 * @return mixed
	 */
	public function getEmployee_fid(){
		return $this->getField(oras_employeeroleEntity::$EMPLOYEE_FID);
	}
	/**
	 * @param mixed $Employee_fid
	 */
	public function setEmployee_fid($Employee_fid){
		$this->setField(oras_employeeroleEntity::$EMPLOYEE_FID,$Employee_fid);
	}
	public static $ROLE_FID="role_fid";
	/**
	 * @return mixed
	 */
	public function getRole_fid(){
		return $this->getField(oras_employeeroleEntity::$ROLE_FID);
	}
	/**
	 * @param mixed $Role_fid
	 */
	public function setRole_fid($Role_fid){
		$this->setField(oras_employeeroleEntity::$ROLE_FID,$Role_fid);
	}
	public static $RECRUITMENTTYPE_FID="recruitmenttype_fid";
	/**
	 * @return mixed
	 */
	public function getRecruitmenttype_fid(){
		return $this->getField(oras_employeeroleEntity::$RECRUITMENTTYPE_FID);
	}
	/**
	 * @param mixed $Recruitmenttype_fid
	 */
	public function setRecruitmenttype_fid($Recruitmenttype_fid){
		$this->setField(oras_employeeroleEntity::$RECRUITMENTTYPE_FID,$Recruitmenttype_fid);
	}
	public static $PLACE_FID="place_fid";
	/**
	 * @return mixed
	 */
	public function getPlace_fid(){
		return $this->getField(oras_employeeroleEntity::$PLACE_FID);
	}
	/**
	 * @param mixed $Place_fid
	 */
	public function setPlace_fid($Place_fid){
		$this->setField(oras_employeeroleEntity::$PLACE_FID,$Place_fid);
	}
	public static $START_TIME="start_time";
	/**
	 * @return mixed
	 */
	public function getStart_time(){
		return $this->getField(oras_employeeroleEntity::$START_TIME);
	}
	/**
	 * @param mixed $Start_time
	 */
	public function setStart_time($Start_time){
		$this->setField(oras_employeeroleEntity::$START_TIME,$Start_time);
	}
}
?>