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
class ocms_userEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("ocms_user");
		$this->setTableTitle("ocms_user");
		$this->setTitleFieldName("family");

		/******** name ********/
		$NameInfo=new FieldInfo();
		$NameInfo->setTitle("name");
		$this->setFieldInfo(ocms_userEntity::$NAME,$NameInfo);
		$this->addTableField('1',ocms_userEntity::$NAME);

		/******** family ********/
		$FamilyInfo=new FieldInfo();
		$FamilyInfo->setTitle("family");
		$this->setFieldInfo(ocms_userEntity::$FAMILY,$FamilyInfo);
		$this->addTableField('2',ocms_userEntity::$FAMILY);

		/******** born_date ********/
		$Born_dateInfo=new FieldInfo();
		$Born_dateInfo->setTitle("born_date");
		$this->setFieldInfo(ocms_userEntity::$BORN_DATE,$Born_dateInfo);
		$this->addTableField('3',ocms_userEntity::$BORN_DATE);

		/******** mobile ********/
		$MobileInfo=new FieldInfo();
		$MobileInfo->setTitle("mobile");
		$this->setFieldInfo(ocms_userEntity::$MOBILE,$MobileInfo);
		$this->addTableField('4',ocms_userEntity::$MOBILE);

		/******** device_id ********/
		$Device_idInfo=new FieldInfo();
		$Device_idInfo->setTitle("device_id");
		$this->setFieldInfo(ocms_userEntity::$DEVICE_ID,$Device_idInfo);
		$this->addTableField('5',ocms_userEntity::$DEVICE_ID);

		/******** email ********/
		$EmailInfo=new FieldInfo();
		$EmailInfo->setTitle("email");
		$this->setFieldInfo(ocms_userEntity::$EMAIL,$EmailInfo);
		$this->addTableField('6',ocms_userEntity::$EMAIL);

		/******** ismale ********/
		$IsmaleInfo=new FieldInfo();
		$IsmaleInfo->setTitle("ismale");
		$this->setFieldInfo(ocms_userEntity::$ISMALE,$IsmaleInfo);
		$this->addTableField('7',ocms_userEntity::$ISMALE);
	}
	public static $NAME="name";
	/**
	 * @return mixed
	 */
	public function getName(){
		return $this->getField(ocms_userEntity::$NAME);
	}
	/**
	 * @param mixed $Name
	 */
	public function setName($Name){
		$this->setField(ocms_userEntity::$NAME,$Name);
	}
	public static $FAMILY="family";
	/**
	 * @return mixed
	 */
	public function getFamily(){
		return $this->getField(ocms_userEntity::$FAMILY);
	}
	/**
	 * @param mixed $Family
	 */
	public function setFamily($Family){
		$this->setField(ocms_userEntity::$FAMILY,$Family);
	}
	public static $BORN_DATE="born_date";
	/**
	 * @return mixed
	 */
	public function getBorn_date(){
		return $this->getField(ocms_userEntity::$BORN_DATE);
	}
	/**
	 * @param mixed $Born_date
	 */
	public function setBorn_date($Born_date){
		$this->setField(ocms_userEntity::$BORN_DATE,$Born_date);
	}
	public static $MOBILE="mobile";
	/**
	 * @return mixed
	 */
	public function getMobile(){
		return $this->getField(ocms_userEntity::$MOBILE);
	}
	/**
	 * @param mixed $Mobile
	 */
	public function setMobile($Mobile){
		$this->setField(ocms_userEntity::$MOBILE,$Mobile);
	}
	public static $DEVICE_ID="device_id";
	/**
	 * @return mixed
	 */
	public function getDevice_id(){
		return $this->getField(ocms_userEntity::$DEVICE_ID);
	}
	/**
	 * @param mixed $Device_id
	 */
	public function setDevice_id($Device_id){
		$this->setField(ocms_userEntity::$DEVICE_ID,$Device_id);
	}
	public static $EMAIL="email";
	/**
	 * @return mixed
	 */
	public function getEmail(){
		return $this->getField(ocms_userEntity::$EMAIL);
	}
	/**
	 * @param mixed $Email
	 */
	public function setEmail($Email){
		$this->setField(ocms_userEntity::$EMAIL,$Email);
	}
	public static $ISMALE="ismale";
	/**
	 * @return mixed
	 */
	public function getIsmale(){
		return $this->getField(ocms_userEntity::$ISMALE);
	}
	/**
	 * @param mixed $Ismale
	 */
	public function setIsmale($Ismale){
		$this->setField(ocms_userEntity::$ISMALE,$Ismale);
	}
}
?>