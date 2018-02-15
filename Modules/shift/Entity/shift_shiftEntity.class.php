<?php
namespace Modules\shift\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 00:32
*@lastUpdate 1396-11-05 - 2018-01-25 00:32
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class shift_shiftEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("shift_shift");
		$this->setTableTitle("شیفت");
		$this->setTitleFieldName("id");

		/******** shifttype_fid ********/
		$Shifttype_fidInfo=new FieldInfo();
		$Shifttype_fidInfo->setTitle("نوع شیفت");
		$this->setFieldInfo(shift_shiftEntity::$SHIFTTYPE_FID,$Shifttype_fidInfo);
		$this->addTableField('1',shift_shiftEntity::$SHIFTTYPE_FID);

		/******** due_date ********/
		$Due_dateInfo=new FieldInfo();
		$Due_dateInfo->setTitle("تاریخ");
		$this->setFieldInfo(shift_shiftEntity::$DUE_DATE,$Due_dateInfo);
		$this->addTableField('2',shift_shiftEntity::$DUE_DATE);

		/******** register_date ********/
		$Register_dateInfo=new FieldInfo();
		$Register_dateInfo->setTitle("تاریخ ثبت در سیستم");
		$this->setFieldInfo(shift_shiftEntity::$REGISTER_DATE,$Register_dateInfo);
		$this->addTableField('3',shift_shiftEntity::$REGISTER_DATE);

		/******** personel_fid ********/
		$Personel_fidInfo=new FieldInfo();
		$Personel_fidInfo->setTitle("شخص");
		$this->setFieldInfo(shift_shiftEntity::$PERSONEL_FID,$Personel_fidInfo);
		$this->addTableField('4',shift_shiftEntity::$PERSONEL_FID);

		/******** bakhsh_fid ********/
		$Bakhsh_fidInfo=new FieldInfo();
		$Bakhsh_fidInfo->setTitle("بخش");
		$this->setFieldInfo(shift_shiftEntity::$BAKHSH_FID,$Bakhsh_fidInfo);
		$this->addTableField('5',shift_shiftEntity::$BAKHSH_FID);

		/******** role_fid ********/
		$Role_fidInfo=new FieldInfo();
		$Role_fidInfo->setTitle("سمت");
		$this->setFieldInfo(shift_shiftEntity::$ROLE_FID,$Role_fidInfo);
		$this->addTableField('6',shift_shiftEntity::$ROLE_FID);

		/******** inputfile_fid ********/
		$Inputfile_fidInfo=new FieldInfo();
		$Inputfile_fidInfo->setTitle("فایل ورودی");
		$this->setFieldInfo(shift_shiftEntity::$INPUTFILE_FID,$Inputfile_fidInfo);
		$this->addTableField('7',shift_shiftEntity::$INPUTFILE_FID);
	}
	public static $SHIFTTYPE_FID="shifttype_fid";
	/**
	 * @return mixed
	 */
	public function getShifttype_fid(){
		return $this->getField(shift_shiftEntity::$SHIFTTYPE_FID);
	}
	/**
	 * @param mixed $Shifttype_fid
	 */
	public function setShifttype_fid($Shifttype_fid){
		$this->setField(shift_shiftEntity::$SHIFTTYPE_FID,$Shifttype_fid);
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
	public static $BAKHSH_FID="bakhsh_fid";
	/**
	 * @return mixed
	 */
	public function getBakhsh_fid(){
		return $this->getField(shift_shiftEntity::$BAKHSH_FID);
	}
	/**
	 * @param mixed $Bakhsh_fid
	 */
	public function setBakhsh_fid($Bakhsh_fid){
		$this->setField(shift_shiftEntity::$BAKHSH_FID,$Bakhsh_fid);
	}
	public static $ROLE_FID="role_fid";
	/**
	 * @return mixed
	 */
	public function getRole_fid(){
		return $this->getField(shift_shiftEntity::$ROLE_FID);
	}
	/**
	 * @param mixed $Role_fid
	 */
	public function setRole_fid($Role_fid){
		$this->setField(shift_shiftEntity::$ROLE_FID,$Role_fid);
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