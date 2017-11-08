<?php
namespace Modules\onlineclass\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-25 - 2017-10-17 22:27
*@lastUpdate 1396-07-25 - 2017-10-17 22:27
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class onlineclass_userEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("onlineclass_user");
		$this->setTableTitle("onlineclass_user");
		$this->setTitleFieldName("email");

		/******** fullname ********/
		$FullnameInfo=new FieldInfo();
		$FullnameInfo->setTitle("fullname");
		$this->setFieldInfo(onlineclass_userEntity::$FULLNAME,$FullnameInfo);
		$this->addTableField('1',onlineclass_userEntity::$FULLNAME);

		/******** ismale ********/
		$IsmaleInfo=new FieldInfo();
		$IsmaleInfo->setTitle("ismale");
		$this->setFieldInfo(onlineclass_userEntity::$ISMALE,$IsmaleInfo);
		$this->addTableField('2',onlineclass_userEntity::$ISMALE);

		/******** email ********/
		$EmailInfo=new FieldInfo();
		$EmailInfo->setTitle("email");
		$this->setFieldInfo(onlineclass_userEntity::$EMAIL,$EmailInfo);
		$this->addTableField('3',onlineclass_userEntity::$EMAIL);

		/******** mobile ********/
		$MobileInfo=new FieldInfo();
		$MobileInfo->setTitle("mobile");
		$this->setFieldInfo(onlineclass_userEntity::$MOBILE,$MobileInfo);
		$this->addTableField('4',onlineclass_userEntity::$MOBILE);

		/******** role_systemuser_fid ********/
		$Role_systemuser_fidInfo=new FieldInfo();
		$Role_systemuser_fidInfo->setTitle("role_systemuser_fid");
		$this->setFieldInfo(onlineclass_userEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fidInfo);
		$this->addTableField('5',onlineclass_userEntity::$ROLE_SYSTEMUSER_FID);

		/******** registration_time ********/
		$Registration_timeInfo=new FieldInfo();
		$Registration_timeInfo->setTitle("registration_time");
		$this->setFieldInfo(onlineclass_userEntity::$REGISTRATION_TIME,$Registration_timeInfo);
		$this->addTableField('6',onlineclass_userEntity::$REGISTRATION_TIME);

		/******** devicecode ********/
		$DevicecodeInfo=new FieldInfo();
		$DevicecodeInfo->setTitle("devicecode");
		$this->setFieldInfo(onlineclass_userEntity::$DEVICECODE,$DevicecodeInfo);
		$this->addTableField('7',onlineclass_userEntity::$DEVICECODE);
	}
	public static $FULLNAME="fullname";
	/**
	 * @return mixed
	 */
	public function getFullname(){
		return $this->getField(onlineclass_userEntity::$FULLNAME);
	}
	/**
	 * @param mixed $Fullname
	 */
	public function setFullname($Fullname){
		$this->setField(onlineclass_userEntity::$FULLNAME,$Fullname);
	}
	public static $ISMALE="ismale";
	/**
	 * @return mixed
	 */
	public function getIsmale(){
		return $this->getField(onlineclass_userEntity::$ISMALE);
	}
	/**
	 * @param mixed $Ismale
	 */
	public function setIsmale($Ismale){
		$this->setField(onlineclass_userEntity::$ISMALE,$Ismale);
	}
	public static $EMAIL="email";
	/**
	 * @return mixed
	 */
	public function getEmail(){
		return $this->getField(onlineclass_userEntity::$EMAIL);
	}
	/**
	 * @param mixed $Email
	 */
	public function setEmail($Email){
		$this->setField(onlineclass_userEntity::$EMAIL,$Email);
	}
	public static $MOBILE="mobile";
	/**
	 * @return mixed
	 */
	public function getMobile(){
		return $this->getField(onlineclass_userEntity::$MOBILE);
	}
	/**
	 * @param mixed $Mobile
	 */
	public function setMobile($Mobile){
		$this->setField(onlineclass_userEntity::$MOBILE,$Mobile);
	}
	public static $ROLE_SYSTEMUSER_FID="role_systemuser_fid";
	/**
	 * @return mixed
	 */
	public function getRole_systemuser_fid(){
		return $this->getField(onlineclass_userEntity::$ROLE_SYSTEMUSER_FID);
	}
	/**
	 * @param mixed $Role_systemuser_fid
	 */
	public function setRole_systemuser_fid($Role_systemuser_fid){
		$this->setField(onlineclass_userEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fid);
	}
	public static $REGISTRATION_TIME="registration_time";
	/**
	 * @return mixed
	 */
	public function getRegistration_time(){
		return $this->getField(onlineclass_userEntity::$REGISTRATION_TIME);
	}
	/**
	 * @param mixed $Registration_time
	 */
	public function setRegistration_time($Registration_time){
		$this->setField(onlineclass_userEntity::$REGISTRATION_TIME,$Registration_time);
	}
	public static $DEVICECODE="devicecode";
	/**
	 * @return mixed
	 */
	public function getDevicecode(){
		return $this->getField(onlineclass_userEntity::$DEVICECODE);
	}
	/**
	 * @param mixed $Devicecode
	 */
	public function setDevicecode($Devicecode){
		$this->setField(onlineclass_userEntity::$DEVICECODE,$Devicecode);
	}
}
?>