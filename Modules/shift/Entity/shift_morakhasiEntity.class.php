<?php
namespace Modules\shift\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-26 - 2018-01-16 20:22
*@lastUpdate 1396-10-26 - 2018-01-16 20:22
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class shift_morakhasiEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("shift_morakhasi");
		$this->setTableTitle("مرخصی");
		$this->setTitleFieldName("id");

		/******** elat ********/
		$ElatInfo=new FieldInfo();
		$ElatInfo->setTitle("علت");
		$this->setFieldInfo(shift_morakhasiEntity::$ELAT,$ElatInfo);
		$this->addTableField('1',shift_morakhasiEntity::$ELAT);

		/******** doctor ********/
		$DoctorInfo=new FieldInfo();
		$DoctorInfo->setTitle("دکتر");
		$this->setFieldInfo(shift_morakhasiEntity::$DOCTOR,$DoctorInfo);
		$this->addTableField('2',shift_morakhasiEntity::$DOCTOR);

		/******** start_time ********/
		$Start_timeInfo=new FieldInfo();
		$Start_timeInfo->setTitle("زمان شروع");
		$this->setFieldInfo(shift_morakhasiEntity::$START_TIME,$Start_timeInfo);
		$this->addTableField('3',shift_morakhasiEntity::$START_TIME);

		/******** end_time ********/
		$End_timeInfo=new FieldInfo();
		$End_timeInfo->setTitle("زمان اتمام");
		$this->setFieldInfo(shift_morakhasiEntity::$END_TIME,$End_timeInfo);
		$this->addTableField('4',shift_morakhasiEntity::$END_TIME);

		/******** add_time ********/
		$Add_timeInfo=new FieldInfo();
		$Add_timeInfo->setTitle("زمان اضافه کردن");
		$this->setFieldInfo(shift_morakhasiEntity::$ADD_TIME,$Add_timeInfo);
		$this->addTableField('5',shift_morakhasiEntity::$ADD_TIME);

		/******** morakhasi_type ********/
		$Morakhasi_typeInfo=new FieldInfo();
		$Morakhasi_typeInfo->setTitle("نوع مرخصی");
		$this->setFieldInfo(shift_morakhasiEntity::$MORAKHASI_TYPE,$Morakhasi_typeInfo);
		$this->addTableField('6',shift_morakhasiEntity::$MORAKHASI_TYPE);

		/******** personel_fid ********/
		$Personel_fidInfo=new FieldInfo();
		$Personel_fidInfo->setTitle("personel_fid");
		$this->setFieldInfo(shift_morakhasiEntity::$PERSONEL_FID,$Personel_fidInfo);
		$this->addTableField('7',shift_morakhasiEntity::$PERSONEL_FID);

		/******** mahal ********/
		$MahalInfo=new FieldInfo();
		$MahalInfo->setTitle("محل");
		$this->setFieldInfo(shift_morakhasiEntity::$MAHAL,$MahalInfo);
		$this->addTableField('8',shift_morakhasiEntity::$MAHAL);
	}
	public static $ELAT="elat";
	/**
	 * @return mixed
	 */
	public function getElat(){
		return $this->getField(shift_morakhasiEntity::$ELAT);
	}
	/**
	 * @param mixed $Elat
	 */
	public function setElat($Elat){
		$this->setField(shift_morakhasiEntity::$ELAT,$Elat);
	}
	public static $DOCTOR="doctor";
	/**
	 * @return mixed
	 */
	public function getDoctor(){
		return $this->getField(shift_morakhasiEntity::$DOCTOR);
	}
	/**
	 * @param mixed $Doctor
	 */
	public function setDoctor($Doctor){
		$this->setField(shift_morakhasiEntity::$DOCTOR,$Doctor);
	}
	public static $START_TIME="start_time";
	/**
	 * @return mixed
	 */
	public function getStart_time(){
		return $this->getField(shift_morakhasiEntity::$START_TIME);
	}
	/**
	 * @param mixed $Start_time
	 */
	public function setStart_time($Start_time){
		$this->setField(shift_morakhasiEntity::$START_TIME,$Start_time);
	}
	public static $END_TIME="end_time";
	/**
	 * @return mixed
	 */
	public function getEnd_time(){
		return $this->getField(shift_morakhasiEntity::$END_TIME);
	}
	/**
	 * @param mixed $End_time
	 */
	public function setEnd_time($End_time){
		$this->setField(shift_morakhasiEntity::$END_TIME,$End_time);
	}
	public static $ADD_TIME="add_time";
	/**
	 * @return mixed
	 */
	public function getAdd_time(){
		return $this->getField(shift_morakhasiEntity::$ADD_TIME);
	}
	/**
	 * @param mixed $Add_time
	 */
	public function setAdd_time($Add_time){
		$this->setField(shift_morakhasiEntity::$ADD_TIME,$Add_time);
	}
	public static $MORAKHASI_TYPE="morakhasi_type";
	/**
	 * @return mixed
	 */
	public function getMorakhasi_type(){
		return $this->getField(shift_morakhasiEntity::$MORAKHASI_TYPE);
	}
	/**
	 * @param mixed $Morakhasi_type
	 */
	public function setMorakhasi_type($Morakhasi_type){
		$this->setField(shift_morakhasiEntity::$MORAKHASI_TYPE,$Morakhasi_type);
	}
	public static $PERSONEL_FID="personel_fid";
	/**
	 * @return mixed
	 */
	public function getPersonel_fid(){
		return $this->getField(shift_morakhasiEntity::$PERSONEL_FID);
	}
	/**
	 * @param mixed $Personel_fid
	 */
	public function setPersonel_fid($Personel_fid){
		$this->setField(shift_morakhasiEntity::$PERSONEL_FID,$Personel_fid);
	}
	public static $MAHAL="mahal";
	/**
	 * @return mixed
	 */
	public function getMahal(){
		return $this->getField(shift_morakhasiEntity::$MAHAL);
	}
	/**
	 * @param mixed $Mahal
	 */
	public function setMahal($Mahal){
		$this->setField(shift_morakhasiEntity::$MAHAL,$Mahal);
	}
}
?>