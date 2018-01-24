<?php
namespace Modules\shift\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-28 - 2018-01-18 18:55
*@lastUpdate 1396-10-28 - 2018-01-18 18:55
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class shift_shiftEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("shift_shift");
		$this->setTableTitle("shift_shift");
		$this->setTitleFieldName("id");

		/******** shifttype ********/
		$ShifttypeInfo=new FieldInfo();
		$ShifttypeInfo->setTitle("shifttype");
		$this->setFieldInfo(shift_shiftEntity::$SHIFTTYPE,$ShifttypeInfo);
		$this->addTableField('1',shift_shiftEntity::$SHIFTTYPE);

		/******** due_date ********/
		$Due_dateInfo=new FieldInfo();
		$Due_dateInfo->setTitle("due_date");
		$this->setFieldInfo(shift_shiftEntity::$DUE_DATE,$Due_dateInfo);
		$this->addTableField('2',shift_shiftEntity::$DUE_DATE);

		/******** register_date ********/
		$Register_dateInfo=new FieldInfo();
		$Register_dateInfo->setTitle("register_date");
		$this->setFieldInfo(shift_shiftEntity::$REGISTER_DATE,$Register_dateInfo);
		$this->addTableField('3',shift_shiftEntity::$REGISTER_DATE);

		/******** personel_fid ********/
		$Personel_fidInfo=new FieldInfo();
		$Personel_fidInfo->setTitle("personel_fid");
		$this->setFieldInfo(shift_shiftEntity::$PERSONEL_FID,$Personel_fidInfo);
		$this->addTableField('4',shift_shiftEntity::$PERSONEL_FID);

		/******** inputfile_fid ********/
		$Inputfile_fidInfo=new FieldInfo();
		$Inputfile_fidInfo->setTitle("inputfile_fid");
		$this->setFieldInfo(shift_shiftEntity::$INPUTFILE_FID,$Inputfile_fidInfo);
		$this->addTableField('5',shift_shiftEntity::$INPUTFILE_FID);
	}
	public static $SHIFTTYPE="shifttype";
	/**
	 * @return mixed
	 */
	public function getShifttype(){
		return $this->getField(shift_shiftEntity::$SHIFTTYPE);
	}
	/**
	 * @param mixed $Shifttype
	 */
	public function setShifttype($Shifttype){
		$this->setField(shift_shiftEntity::$SHIFTTYPE,$Shifttype);
	}
	public static $DUE_DATE="due_date";
	/**
	 * @return mixed
	 */
	public function getDue_date(){
		return $this->getField(shift_shiftEntity::$DUE_DATE);
	}
	/**
	 * @param mixed $Due_date
	 */
	public function setDue_date($Due_date){
		$this->setField(shift_shiftEntity::$DUE_DATE,$Due_date);
	}
	public static $REGISTER_DATE="register_date";
	/**
	 * @return mixed
	 */
	public function getRegister_date(){
		return $this->getField(shift_shiftEntity::$REGISTER_DATE);
	}
	/**
	 * @param mixed $Register_date
	 */
	public function setRegister_date($Register_date){
		$this->setField(shift_shiftEntity::$REGISTER_DATE,$Register_date);
	}
	public static $PERSONEL_FID="personel_fid";
	/**
	 * @return mixed
	 */
	public function getPersonel_fid(){
		return $this->getField(shift_shiftEntity::$PERSONEL_FID);
	}
	/**
	 * @param mixed $Personel_fid
	 */
	public function setPersonel_fid($Personel_fid){
		$this->setField(shift_shiftEntity::$PERSONEL_FID,$Personel_fid);
	}
	public static $INPUTFILE_FID="inputfile_fid";
	/**
	 * @return mixed
	 */
	public function getInputfile_fid(){
		return $this->getField(shift_shiftEntity::$INPUTFILE_FID);
	}
	/**
	 * @param mixed $Inputfile_fid
	 */
	public function setInputfile_fid($Inputfile_fid){
		$this->setField(shift_shiftEntity::$INPUTFILE_FID,$Inputfile_fid);
	}
}
?>