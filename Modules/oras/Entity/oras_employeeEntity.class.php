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
class oras_employeeEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("oras_employee");
		$this->setTableTitle("کارمند");
		$this->setTitleFieldName("family");

		/******** mellicode ********/
		$MellicodeInfo=new FieldInfo();
		$MellicodeInfo->setTitle("شماره ملی");
		$this->setFieldInfo(oras_employeeEntity::$MELLICODE,$MellicodeInfo);
		$this->addTableField('1',oras_employeeEntity::$MELLICODE);

		/******** name ********/
		$NameInfo=new FieldInfo();
		$NameInfo->setTitle("نام");
		$this->setFieldInfo(oras_employeeEntity::$NAME,$NameInfo);
		$this->addTableField('2',oras_employeeEntity::$NAME);

		/******** family ********/
		$FamilyInfo=new FieldInfo();
		$FamilyInfo->setTitle("نام خانوادگی");
		$this->setFieldInfo(oras_employeeEntity::$FAMILY,$FamilyInfo);
		$this->addTableField('3',oras_employeeEntity::$FAMILY);

		/******** ismale ********/
		$IsmaleInfo=new FieldInfo();
		$IsmaleInfo->setTitle("جنسیت");
		$this->setFieldInfo(oras_employeeEntity::$ISMALE,$IsmaleInfo);
		$this->addTableField('4',oras_employeeEntity::$ISMALE);

		/******** phonenumber ********/
		$PhonenumberInfo=new FieldInfo();
		$PhonenumberInfo->setTitle("شماره موبایل");
		$this->setFieldInfo(oras_employeeEntity::$PHONENUMBER,$PhonenumberInfo);
		$this->addTableField('5',oras_employeeEntity::$PHONENUMBER);

		/******** photo_flu ********/
		$Photo_fluInfo=new FieldInfo();
		$Photo_fluInfo->setTitle("تصویر پروفایل");
		$this->setFieldInfo(oras_employeeEntity::$PHOTO_FLU,$Photo_fluInfo);
		$this->addTableField('6',oras_employeeEntity::$PHOTO_FLU);
	}
	public static $MELLICODE="mellicode";
	/**
	 * @return mixed
	 */
	public function getMellicode(){
		return $this->getField(oras_employeeEntity::$MELLICODE);
	}
	/**
	 * @param mixed $Mellicode
	 */
	public function setMellicode($Mellicode){
		$this->setField(oras_employeeEntity::$MELLICODE,$Mellicode);
	}
	public static $NAME="name";
	/**
	 * @return mixed
	 */
	public function getName(){
		return $this->getField(oras_employeeEntity::$NAME);
	}
	/**
	 * @param mixed $Name
	 */
	public function setName($Name){
		$this->setField(oras_employeeEntity::$NAME,$Name);
	}
	public static $FAMILY="family";
	/**
	 * @return mixed
	 */
	public function getFamily(){
		return $this->getField(oras_employeeEntity::$FAMILY);
	}
	/**
	 * @param mixed $Family
	 */
	public function setFamily($Family){
		$this->setField(oras_employeeEntity::$FAMILY,$Family);
	}
	public static $ISMALE="ismale";
	/**
	 * @return mixed
	 */
	public function getIsmale(){
		return $this->getField(oras_employeeEntity::$ISMALE);
	}
	/**
	 * @param mixed $Ismale
	 */
	public function setIsmale($Ismale){
		$this->setField(oras_employeeEntity::$ISMALE,$Ismale);
	}
	public static $PHONENUMBER="phonenumber";
	/**
	 * @return mixed
	 */
	public function getPhonenumber(){
		return $this->getField(oras_employeeEntity::$PHONENUMBER);
	}
	/**
	 * @param mixed $Phonenumber
	 */
	public function setPhonenumber($Phonenumber){
		$this->setField(oras_employeeEntity::$PHONENUMBER,$Phonenumber);
	}
	public static $PHOTO_FLU="photo_flu";
	/**
	 * @return mixed
	 */
	public function getPhoto_flu(){
		return $this->getField(oras_employeeEntity::$PHOTO_FLU);
	}
	/**
	 * @param mixed $Photo_flu
	 */
	public function setPhoto_flu($Photo_flu){
		$this->setField(oras_employeeEntity::$PHOTO_FLU,$Photo_flu);
	}
}
?>