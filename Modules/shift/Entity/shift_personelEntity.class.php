<?php
namespace Modules\shift\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-28 - 2018-01-18 17:32
*@lastUpdate 1396-10-28 - 2018-01-18 17:32
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class shift_personelEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("shift_personel");
		$this->setTableTitle("shift_personel");
		$this->setTitleFieldName("family");

		/******** childcount ********/
		$ChildcountInfo=new FieldInfo();
		$ChildcountInfo->setTitle("childcount");
		$this->setFieldInfo(shift_personelEntity::$CHILDCOUNT,$ChildcountInfo);
		$this->addTableField('1',shift_personelEntity::$CHILDCOUNT);

		/******** address ********/
		$AddressInfo=new FieldInfo();
		$AddressInfo->setTitle("address");
		$this->setFieldInfo(shift_personelEntity::$ADDRESS,$AddressInfo);
		$this->addTableField('2',shift_personelEntity::$ADDRESS);

		/******** fathername ********/
		$FathernameInfo=new FieldInfo();
		$FathernameInfo->setTitle("fathername");
		$this->setFieldInfo(shift_personelEntity::$FATHERNAME,$FathernameInfo);
		$this->addTableField('3',shift_personelEntity::$FATHERNAME);

		/******** priority ********/
		$PriorityInfo=new FieldInfo();
		$PriorityInfo->setTitle("priority");
		$this->setFieldInfo(shift_personelEntity::$PRIORITY,$PriorityInfo);
		$this->addTableField('4',shift_personelEntity::$PRIORITY);

		/******** employment_date ********/
		$Employment_dateInfo=new FieldInfo();
		$Employment_dateInfo->setTitle("employment_date");
		$this->setFieldInfo(shift_personelEntity::$EMPLOYMENT_DATE,$Employment_dateInfo);
		$this->addTableField('5',shift_personelEntity::$EMPLOYMENT_DATE);

		/******** personelcode ********/
		$PersonelcodeInfo=new FieldInfo();
		$PersonelcodeInfo->setTitle("personelcode");
		$this->setFieldInfo(shift_personelEntity::$PERSONELCODE,$PersonelcodeInfo);
		$this->addTableField('6',shift_personelEntity::$PERSONELCODE);

		/******** sanavat ********/
		$SanavatInfo=new FieldInfo();
		$SanavatInfo->setTitle("sanavat");
		$this->setFieldInfo(shift_personelEntity::$SANAVAT,$SanavatInfo);
		$this->addTableField('7',shift_personelEntity::$SANAVAT);

		/******** shhesab ********/
		$ShhesabInfo=new FieldInfo();
		$ShhesabInfo->setTitle("shhesab");
		$this->setFieldInfo(shift_personelEntity::$SHHESAB,$ShhesabInfo);
		$this->addTableField('8',shift_personelEntity::$SHHESAB);

		/******** bakhsh_fid ********/
		$Bakhsh_fidInfo=new FieldInfo();
		$Bakhsh_fidInfo->setTitle("bakhsh_fid");
		$this->setFieldInfo(shift_personelEntity::$BAKHSH_FID,$Bakhsh_fidInfo);
		$this->addTableField('9',shift_personelEntity::$BAKHSH_FID);

		/******** madrak_fid ********/
		$Madrak_fidInfo=new FieldInfo();
		$Madrak_fidInfo->setTitle("madrak_fid");
		$this->setFieldInfo(shift_personelEntity::$MADRAK_FID,$Madrak_fidInfo);
		$this->addTableField('10',shift_personelEntity::$MADRAK_FID);

		/******** name ********/
		$NameInfo=new FieldInfo();
		$NameInfo->setTitle("name");
		$this->setFieldInfo(shift_personelEntity::$NAME,$NameInfo);
		$this->addTableField('11',shift_personelEntity::$NAME);

		/******** family ********/
		$FamilyInfo=new FieldInfo();
		$FamilyInfo->setTitle("family");
		$this->setFieldInfo(shift_personelEntity::$FAMILY,$FamilyInfo);
		$this->addTableField('12',shift_personelEntity::$FAMILY);

		/******** tel ********/
		$TelInfo=new FieldInfo();
		$TelInfo->setTitle("tel");
		$this->setFieldInfo(shift_personelEntity::$TEL,$TelInfo);
		$this->addTableField('13',shift_personelEntity::$TEL);

		/******** born_date ********/
		$Born_dateInfo=new FieldInfo();
		$Born_dateInfo->setTitle("born_date");
		$this->setFieldInfo(shift_personelEntity::$BORN_DATE,$Born_dateInfo);
		$this->addTableField('14',shift_personelEntity::$BORN_DATE);

		/******** is_male ********/
		$Is_maleInfo=new FieldInfo();
		$Is_maleInfo->setTitle("is_male");
		$this->setFieldInfo(shift_personelEntity::$IS_MALE,$Is_maleInfo);
		$this->addTableField('15',shift_personelEntity::$IS_MALE);

		/******** extrasanavat ********/
		$ExtrasanavatInfo=new FieldInfo();
		$ExtrasanavatInfo->setTitle("extrasanavat");
		$this->setFieldInfo(shift_personelEntity::$EXTRASANAVAT,$ExtrasanavatInfo);
		$this->addTableField('16',shift_personelEntity::$EXTRASANAVAT);

		/******** monthsanavat ********/
		$MonthsanavatInfo=new FieldInfo();
		$MonthsanavatInfo->setTitle("monthsanavat");
		$this->setFieldInfo(shift_personelEntity::$MONTHSANAVAT,$MonthsanavatInfo);
		$this->addTableField('17',shift_personelEntity::$MONTHSANAVAT);

		/******** eshteghal_fid ********/
		$Eshteghal_fidInfo=new FieldInfo();
		$Eshteghal_fidInfo->setTitle("eshteghal_fid");
		$this->setFieldInfo(shift_personelEntity::$ESHTEGHAL_FID,$Eshteghal_fidInfo);
		$this->addTableField('18',shift_personelEntity::$ESHTEGHAL_FID);

		/******** zarib ********/
		$ZaribInfo=new FieldInfo();
		$ZaribInfo->setTitle("zarib");
		$this->setFieldInfo(shift_personelEntity::$ZARIB,$ZaribInfo);
		$this->addTableField('19',shift_personelEntity::$ZARIB);

		/******** role_fid ********/
		$Role_fidInfo=new FieldInfo();
		$Role_fidInfo->setTitle("role_fid");
		$this->setFieldInfo(shift_personelEntity::$ROLE_FID,$Role_fidInfo);
		$this->addTableField('20',shift_personelEntity::$ROLE_FID);

		/******** shsh ********/
		$ShshInfo=new FieldInfo();
		$ShshInfo->setTitle("shsh");
		$this->setFieldInfo(shift_personelEntity::$SHSH,$ShshInfo);
		$this->addTableField('21',shift_personelEntity::$SHSH);

		/******** computercode ********/
		$ComputercodeInfo=new FieldInfo();
		$ComputercodeInfo->setTitle("computercode");
		$this->setFieldInfo(shift_personelEntity::$COMPUTERCODE,$ComputercodeInfo);
		$this->addTableField('22',shift_personelEntity::$COMPUTERCODE);

		/******** mellicode ********/
		$MellicodeInfo=new FieldInfo();
		$MellicodeInfo->setTitle("mellicode");
		$this->setFieldInfo(shift_personelEntity::$MELLICODE,$MellicodeInfo);
		$this->addTableField('23',shift_personelEntity::$MELLICODE);

		/******** is_married ********/
		$Is_marriedInfo=new FieldInfo();
		$Is_marriedInfo->setTitle("is_married");
		$this->setFieldInfo(shift_personelEntity::$IS_MARRIED,$Is_marriedInfo);
		$this->addTableField('24',shift_personelEntity::$IS_MARRIED);
	}
	public static $CHILDCOUNT="childcount";
	/**
	 * @return mixed
	 */
	public function getChildcount(){
		return $this->getField(shift_personelEntity::$CHILDCOUNT);
	}
	/**
	 * @param mixed $Childcount
	 */
	public function setChildcount($Childcount){
		$this->setField(shift_personelEntity::$CHILDCOUNT,$Childcount);
	}
	public static $ADDRESS="address";
	/**
	 * @return mixed
	 */
	public function getAddress(){
		return $this->getField(shift_personelEntity::$ADDRESS);
	}
	/**
	 * @param mixed $Address
	 */
	public function setAddress($Address){
		$this->setField(shift_personelEntity::$ADDRESS,$Address);
	}
	public static $FATHERNAME="fathername";
	/**
	 * @return mixed
	 */
	public function getFathername(){
		return $this->getField(shift_personelEntity::$FATHERNAME);
	}
	/**
	 * @param mixed $Fathername
	 */
	public function setFathername($Fathername){
		$this->setField(shift_personelEntity::$FATHERNAME,$Fathername);
	}
	public static $PRIORITY="priority";
	/**
	 * @return mixed
	 */
	public function getPriority(){
		return $this->getField(shift_personelEntity::$PRIORITY);
	}
	/**
	 * @param mixed $Priority
	 */
	public function setPriority($Priority){
		$this->setField(shift_personelEntity::$PRIORITY,$Priority);
	}
	public static $EMPLOYMENT_DATE="employment_date";
	/**
	 * @return mixed
	 */
	public function getEmployment_date(){
		return $this->getField(shift_personelEntity::$EMPLOYMENT_DATE);
	}
	/**
	 * @param mixed $Employment_date
	 */
	public function setEmployment_date($Employment_date){
		$this->setField(shift_personelEntity::$EMPLOYMENT_DATE,$Employment_date);
	}
	public static $PERSONELCODE="personelcode";
	/**
	 * @return mixed
	 */
	public function getPersonelcode(){
		return $this->getField(shift_personelEntity::$PERSONELCODE);
	}
	/**
	 * @param mixed $Personelcode
	 */
	public function setPersonelcode($Personelcode){
		$this->setField(shift_personelEntity::$PERSONELCODE,$Personelcode);
	}
	public static $SANAVAT="sanavat";
	/**
	 * @return mixed
	 */
	public function getSanavat(){
		return $this->getField(shift_personelEntity::$SANAVAT);
	}
	/**
	 * @param mixed $Sanavat
	 */
	public function setSanavat($Sanavat){
		$this->setField(shift_personelEntity::$SANAVAT,$Sanavat);
	}
	public static $SHHESAB="shhesab";
	/**
	 * @return mixed
	 */
	public function getShhesab(){
		return $this->getField(shift_personelEntity::$SHHESAB);
	}
	/**
	 * @param mixed $Shhesab
	 */
	public function setShhesab($Shhesab){
		$this->setField(shift_personelEntity::$SHHESAB,$Shhesab);
	}
	public static $BAKHSH_FID="bakhsh_fid";
	/**
	 * @return mixed
	 */
	public function getBakhsh_fid(){
		return $this->getField(shift_personelEntity::$BAKHSH_FID);
	}
	/**
	 * @param mixed $Bakhsh_fid
	 */
	public function setBakhsh_fid($Bakhsh_fid){
		$this->setField(shift_personelEntity::$BAKHSH_FID,$Bakhsh_fid);
	}
	public static $MADRAK_FID="madrak_fid";
	/**
	 * @return mixed
	 */
	public function getMadrak_fid(){
		return $this->getField(shift_personelEntity::$MADRAK_FID);
	}
	/**
	 * @param mixed $Madrak_fid
	 */
	public function setMadrak_fid($Madrak_fid){
		$this->setField(shift_personelEntity::$MADRAK_FID,$Madrak_fid);
	}
	public static $NAME="name";
	/**
	 * @return mixed
	 */
	public function getName(){
		return $this->getField(shift_personelEntity::$NAME);
	}
	/**
	 * @param mixed $Name
	 */
	public function setName($Name){
		$this->setField(shift_personelEntity::$NAME,$Name);
	}
	public static $FAMILY="family";
	/**
	 * @return mixed
	 */
	public function getFamily(){
		return $this->getField(shift_personelEntity::$FAMILY);
	}
	/**
	 * @param mixed $Family
	 */
	public function setFamily($Family){
		$this->setField(shift_personelEntity::$FAMILY,$Family);
	}
	public static $TEL="tel";
	/**
	 * @return mixed
	 */
	public function getTel(){
		return $this->getField(shift_personelEntity::$TEL);
	}
	/**
	 * @param mixed $Tel
	 */
	public function setTel($Tel){
		$this->setField(shift_personelEntity::$TEL,$Tel);
	}
	public static $BORN_DATE="born_date";
	/**
	 * @return mixed
	 */
	public function getBorn_date(){
		return $this->getField(shift_personelEntity::$BORN_DATE);
	}
	/**
	 * @param mixed $Born_date
	 */
	public function setBorn_date($Born_date){
		$this->setField(shift_personelEntity::$BORN_DATE,$Born_date);
	}
	public static $IS_MALE="is_male";
	/**
	 * @return mixed
	 */
	public function getIs_male(){
		return $this->getField(shift_personelEntity::$IS_MALE);
	}
	/**
	 * @param mixed $Is_male
	 */
	public function setIs_male($Is_male){
		$this->setField(shift_personelEntity::$IS_MALE,$Is_male);
	}
	public static $EXTRASANAVAT="extrasanavat";
	/**
	 * @return mixed
	 */
	public function getExtrasanavat(){
		return $this->getField(shift_personelEntity::$EXTRASANAVAT);
	}
	/**
	 * @param mixed $Extrasanavat
	 */
	public function setExtrasanavat($Extrasanavat){
		$this->setField(shift_personelEntity::$EXTRASANAVAT,$Extrasanavat);
	}
	public static $MONTHSANAVAT="monthsanavat";
	/**
	 * @return mixed
	 */
	public function getMonthsanavat(){
		return $this->getField(shift_personelEntity::$MONTHSANAVAT);
	}
	/**
	 * @param mixed $Monthsanavat
	 */
	public function setMonthsanavat($Monthsanavat){
		$this->setField(shift_personelEntity::$MONTHSANAVAT,$Monthsanavat);
	}
	public static $ESHTEGHAL_FID="eshteghal_fid";
	/**
	 * @return mixed
	 */
	public function getEshteghal_fid(){
		return $this->getField(shift_personelEntity::$ESHTEGHAL_FID);
	}
	/**
	 * @param mixed $Eshteghal_fid
	 */
	public function setEshteghal_fid($Eshteghal_fid){
		$this->setField(shift_personelEntity::$ESHTEGHAL_FID,$Eshteghal_fid);
	}
	public static $ZARIB="zarib";
	/**
	 * @return mixed
	 */
	public function getZarib(){
		return $this->getField(shift_personelEntity::$ZARIB);
	}
	/**
	 * @param mixed $Zarib
	 */
	public function setZarib($Zarib){
		$this->setField(shift_personelEntity::$ZARIB,$Zarib);
	}
	public static $ROLE_FID="role_fid";
	/**
	 * @return mixed
	 */
	public function getRole_fid(){
		return $this->getField(shift_personelEntity::$ROLE_FID);
	}
	/**
	 * @param mixed $Role_fid
	 */
	public function setRole_fid($Role_fid){
		$this->setField(shift_personelEntity::$ROLE_FID,$Role_fid);
	}
	public static $SHSH="shsh";
	/**
	 * @return mixed
	 */
	public function getShsh(){
		return $this->getField(shift_personelEntity::$SHSH);
	}
	/**
	 * @param mixed $Shsh
	 */
	public function setShsh($Shsh){
		$this->setField(shift_personelEntity::$SHSH,$Shsh);
	}
	public static $COMPUTERCODE="computercode";
	/**
	 * @return mixed
	 */
	public function getComputercode(){
		return $this->getField(shift_personelEntity::$COMPUTERCODE);
	}
	/**
	 * @param mixed $Computercode
	 */
	public function setComputercode($Computercode){
		$this->setField(shift_personelEntity::$COMPUTERCODE,$Computercode);
	}
	public static $MELLICODE="mellicode";
	/**
	 * @return mixed
	 */
	public function getMellicode(){
		return $this->getField(shift_personelEntity::$MELLICODE);
	}
	/**
	 * @param mixed $Mellicode
	 */
	public function setMellicode($Mellicode){
		$this->setField(shift_personelEntity::$MELLICODE,$Mellicode);
	}
	public static $IS_MARRIED="is_married";
	/**
	 * @return mixed
	 */
	public function getIs_married(){
		return $this->getField(shift_personelEntity::$IS_MARRIED);
	}
	/**
	 * @param mixed $Is_married
	 */
	public function setIs_married($Is_married){
		$this->setField(shift_personelEntity::$IS_MARRIED,$Is_married);
	}

}
?>