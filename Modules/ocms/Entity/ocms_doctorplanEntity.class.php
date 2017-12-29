<?php
namespace Modules\ocms\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-23 - 2017-12-14 01:17
*@lastUpdate 1396-09-23 - 2017-12-14 01:17
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class ocms_doctorplanEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("ocms_doctorplan");
		$this->setTableTitle("ocms_doctorplan");
		$this->setTitleFieldName("id");

		/******** start_time ********/
		$Start_timeInfo=new FieldInfo();
		$Start_timeInfo->setTitle("start_time");
		$this->setFieldInfo(ocms_doctorplanEntity::$START_TIME,$Start_timeInfo);
		$this->addTableField('1',ocms_doctorplanEntity::$START_TIME);

		/******** end_time ********/
		$End_timeInfo=new FieldInfo();
		$End_timeInfo->setTitle("end_time");
		$this->setFieldInfo(ocms_doctorplanEntity::$END_TIME,$End_timeInfo);
		$this->addTableField('2',ocms_doctorplanEntity::$END_TIME);

		/******** doctor_fid ********/
		$Doctor_fidInfo=new FieldInfo();
		$Doctor_fidInfo->setTitle("doctor_fid");
		$this->setFieldInfo(ocms_doctorplanEntity::$DOCTOR_FID,$Doctor_fidInfo);
		$this->addTableField('3',ocms_doctorplanEntity::$DOCTOR_FID);
	}
	public static $START_TIME="start_time";
	/**
	 * @return mixed
	 */
	public function getStart_time(){
		return $this->getField(ocms_doctorplanEntity::$START_TIME);
	}
	/**
	 * @param mixed $Start_time
	 */
	public function setStart_time($Start_time){
		$this->setField(ocms_doctorplanEntity::$START_TIME,$Start_time);
	}
	public static $END_TIME="end_time";
	/**
	 * @return mixed
	 */
	public function getEnd_time(){
		return $this->getField(ocms_doctorplanEntity::$END_TIME);
	}
	/**
	 * @param mixed $End_time
	 */
	public function setEnd_time($End_time){
		$this->setField(ocms_doctorplanEntity::$END_TIME,$End_time);
	}
	public static $DOCTOR_FID="doctor_fid";
	/**
	 * @return mixed
	 */
	public function getDoctor_fid(){
		return $this->getField(ocms_doctorplanEntity::$DOCTOR_FID);
	}
	/**
	 * @param mixed $Doctor_fid
	 */
	public function setDoctor_fid($Doctor_fid){
		$this->setField(ocms_doctorplanEntity::$DOCTOR_FID,$Doctor_fid);
	}
}
?>