<?php
namespace Modules\shift\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-27 - 2018-01-17 00:24
*@lastUpdate 1396-10-27 - 2018-01-17 00:24
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class shift_inputfileEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("shift_inputfile");
		$this->setTableTitle("فایل ورودی");
		$this->setTitleFieldName("id");

		/******** upload_time ********/
		$Upload_timeInfo=new FieldInfo();
		$Upload_timeInfo->setTitle("زمان به روز رسانی");
		$this->setFieldInfo(shift_inputfileEntity::$UPLOAD_TIME,$Upload_timeInfo);
		$this->addTableField('1',shift_inputfileEntity::$UPLOAD_TIME);

		/******** systemuser ********/
		$SystemuserInfo=new FieldInfo();
		$SystemuserInfo->setTitle("سیستم کاربر");
		$this->setFieldInfo(shift_inputfileEntity::$SYSTEMUSER,$SystemuserInfo);
		$this->addTableField('2',shift_inputfileEntity::$SYSTEMUSER);

		/******** role_systemuser_fid ********/
		$Role_systemuser_fidInfo=new FieldInfo();
		$Role_systemuser_fidInfo->setTitle("دسترسی کاربر");
		$this->setFieldInfo(shift_inputfileEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fidInfo);
		$this->addTableField('3',shift_inputfileEntity::$ROLE_SYSTEMUSER_FID);

		/******** file_flu ********/
		$File_fluInfo=new FieldInfo();
		$File_fluInfo->setTitle("فایل");
		$this->setFieldInfo(shift_inputfileEntity::$FILE_FLU,$File_fluInfo);
		$this->addTableField('4',shift_inputfileEntity::$FILE_FLU);
	}
	public static $UPLOAD_TIME="upload_time";
	/**
	 * @return mixed
	 */
	public function getUpload_time(){
		return $this->getField(shift_inputfileEntity::$UPLOAD_TIME);
	}
	/**
	 * @param mixed $Upload_time
	 */
	public function setUpload_time($Upload_time){
		$this->setField(shift_inputfileEntity::$UPLOAD_TIME,$Upload_time);
	}
	public static $SYSTEMUSER="systemuser";
	/**
	 * @return mixed
	 */
	public function getSystemuser(){
		return $this->getField(shift_inputfileEntity::$SYSTEMUSER);
	}
	/**
	 * @param mixed $Systemuser
	 */
	public function setSystemuser($Systemuser){
		$this->setField(shift_inputfileEntity::$SYSTEMUSER,$Systemuser);
	}
	public static $ROLE_SYSTEMUSER_FID="role_systemuser_fid";
	/**
	 * @return mixed
	 */
	public function getRole_systemuser_fid(){
		return $this->getField(shift_inputfileEntity::$ROLE_SYSTEMUSER_FID);
	}
	/**
	 * @param mixed $Role_systemuser_fid
	 */
	public function setRole_systemuser_fid($Role_systemuser_fid){
		$this->setField(shift_inputfileEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fid);
	}
	public static $FILE_FLU="file_flu";
	/**
	 * @return mixed
	 */
	public function getFile_flu(){
		return $this->getField(shift_inputfileEntity::$FILE_FLU);
	}
	/**
	 * @param mixed $File_flu
	 */
	public function setFile_flu($File_flu){
		$this->setField(shift_inputfileEntity::$FILE_FLU,$File_flu);
	}
}
?>