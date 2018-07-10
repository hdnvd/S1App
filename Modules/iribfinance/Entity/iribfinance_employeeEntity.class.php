<?php
namespace Modules\iribfinance\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:15
*@lastUpdate 1396-11-05 - 2018-01-25 18:15
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class iribfinance_employeeEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("iribfinance_employee");
		$this->setTableTitle("کارمند");
		$this->setTitleFieldName("family");

		/******** name ********/
		$NameInfo=new FieldInfo();
		$NameInfo->setTitle("نام");
		$this->setFieldInfo(iribfinance_employeeEntity::$NAME,$NameInfo);
		$this->addTableField('1',iribfinance_employeeEntity::$NAME);

		/******** family ********/
		$FamilyInfo=new FieldInfo();
		$FamilyInfo->setTitle("نام خانوادگی");
		$this->setFieldInfo(iribfinance_employeeEntity::$FAMILY,$FamilyInfo);
		$this->addTableField('2',iribfinance_employeeEntity::$FAMILY);

		/******** fathername ********/
		$FathernameInfo=new FieldInfo();
		$FathernameInfo->setTitle("نام پدر");
		$this->setFieldInfo(iribfinance_employeeEntity::$FATHERNAME,$FathernameInfo);
		$this->addTableField('3',iribfinance_employeeEntity::$FATHERNAME);

		/******** ismale ********/
		$IsmaleInfo=new FieldInfo();
		$IsmaleInfo->setTitle("جنسیت");
		$this->setFieldInfo(iribfinance_employeeEntity::$ISMALE,$IsmaleInfo);
		$this->addTableField('4',iribfinance_employeeEntity::$ISMALE);

		/******** mellicode ********/
		$MellicodeInfo=new FieldInfo();
		$MellicodeInfo->setTitle("کد ملی");
		$this->setFieldInfo(iribfinance_employeeEntity::$MELLICODE,$MellicodeInfo);
		$this->addTableField('5',iribfinance_employeeEntity::$MELLICODE);

		/******** shsh ********/
		$ShshInfo=new FieldInfo();
		$ShshInfo->setTitle("شماره شناسنامه");
		$this->setFieldInfo(iribfinance_employeeEntity::$SHSH,$ShshInfo);
		$this->addTableField('6',iribfinance_employeeEntity::$SHSH);

		/******** shshserial ********/
		$ShshserialInfo=new FieldInfo();
		$ShshserialInfo->setTitle("شماره سریال شناسنامه");
		$this->setFieldInfo(iribfinance_employeeEntity::$SHSHSERIAL,$ShshserialInfo);
		$this->addTableField('7',iribfinance_employeeEntity::$SHSHSERIAL);

		/******** personelcode ********/
		$PersonelcodeInfo=new FieldInfo();
		$PersonelcodeInfo->setTitle("کد پرسنلی");
		$this->setFieldInfo(iribfinance_employeeEntity::$PERSONELCODE,$PersonelcodeInfo);
		$this->addTableField('8',iribfinance_employeeEntity::$PERSONELCODE);

		/******** employmentcode ********/
		$EmploymentcodeInfo=new FieldInfo();
		$EmploymentcodeInfo->setTitle("کد کارمندی");
		$this->setFieldInfo(iribfinance_employeeEntity::$EMPLOYMENTCODE,$EmploymentcodeInfo);
		$this->addTableField('9',iribfinance_employeeEntity::$EMPLOYMENTCODE);

		/******** role_fid ********/
		$Role_fidInfo=new FieldInfo();
		$Role_fidInfo->setTitle("سمت");
		$this->setFieldInfo(iribfinance_employeeEntity::$ROLE_FID,$Role_fidInfo);
		$this->addTableField('10',iribfinance_employeeEntity::$ROLE_FID);

		/******** nationality_fid ********/
		$Nationality_fidInfo=new FieldInfo();
		$Nationality_fidInfo->setTitle("ملیت");
		$this->setFieldInfo(iribfinance_employeeEntity::$NATIONALITY_FID,$Nationality_fidInfo);
		$this->addTableField('11',iribfinance_employeeEntity::$NATIONALITY_FID);

		/******** paycenter_fid ********/
		$Paycenter_fidInfo=new FieldInfo();
		$Paycenter_fidInfo->setTitle("مرکز هزینه");
		$this->setFieldInfo(iribfinance_employeeEntity::$PAYCENTER_FID,$Paycenter_fidInfo);
		$this->addTableField('12',iribfinance_employeeEntity::$PAYCENTER_FID);

		/******** employmenttype_fid ********/
		$Employmenttype_fidInfo=new FieldInfo();
		$Employmenttype_fidInfo->setTitle("نوع استخدام");
		$this->setFieldInfo(iribfinance_employeeEntity::$EMPLOYMENTTYPE_FID,$Employmenttype_fidInfo);
		$this->addTableField('13',iribfinance_employeeEntity::$EMPLOYMENTTYPE_FID);

		/******** born_date ********/
		$Born_dateInfo=new FieldInfo();
		$Born_dateInfo->setTitle("تاریخ تولد");
		$this->setFieldInfo(iribfinance_employeeEntity::$BORN_DATE,$Born_dateInfo);
		$this->addTableField('14',iribfinance_employeeEntity::$BORN_DATE);

		/******** childcount ********/
		$ChildcountInfo=new FieldInfo();
		$ChildcountInfo->setTitle("تعداد فرزندان");
		$this->setFieldInfo(iribfinance_employeeEntity::$CHILDCOUNT,$ChildcountInfo);
		$this->addTableField('15',iribfinance_employeeEntity::$CHILDCOUNT);

		/******** ismarried ********/
		$IsmarriedInfo=new FieldInfo();
		$IsmarriedInfo->setTitle("وضعیت تاهل");
		$this->setFieldInfo(iribfinance_employeeEntity::$ISMARRIED,$IsmarriedInfo);
		$this->addTableField('16',iribfinance_employeeEntity::$ISMARRIED);

		/******** mobile ********/
		$MobileInfo=new FieldInfo();
		$MobileInfo->setTitle("تلفن همراه");
		$this->setFieldInfo(iribfinance_employeeEntity::$MOBILE,$MobileInfo);
		$this->addTableField('17',iribfinance_employeeEntity::$MOBILE);

		/******** tel ********/
		$TelInfo=new FieldInfo();
		$TelInfo->setTitle("تلفن تماس");
		$this->setFieldInfo(iribfinance_employeeEntity::$TEL,$TelInfo);
		$this->addTableField('18',iribfinance_employeeEntity::$TEL);

		/******** address ********/
		$AddressInfo=new FieldInfo();
		$AddressInfo->setTitle("آدرس");
		$this->setFieldInfo(iribfinance_employeeEntity::$ADDRESS,$AddressInfo);
		$this->addTableField('19',iribfinance_employeeEntity::$ADDRESS);

		/******** zipcode ********/
		$ZipcodeInfo=new FieldInfo();
		$ZipcodeInfo->setTitle("کد پستی");
		$this->setFieldInfo(iribfinance_employeeEntity::$ZIPCODE,$ZipcodeInfo);
		$this->addTableField('20',iribfinance_employeeEntity::$ZIPCODE);

		/******** common_city_fid ********/
		$Common_city_fidInfo=new FieldInfo();
		$Common_city_fidInfo->setTitle("محل تولد");
		$this->setFieldInfo(iribfinance_employeeEntity::$COMMON_CITY_FID,$Common_city_fidInfo);
		$this->addTableField('21',iribfinance_employeeEntity::$COMMON_CITY_FID);

		/******** accountnumber ********/
		$AccountnumberInfo=new FieldInfo();
		$AccountnumberInfo->setTitle("شماره حساب");
		$this->setFieldInfo(iribfinance_employeeEntity::$ACCOUNTNUMBER,$AccountnumberInfo);
		$this->addTableField('22',iribfinance_employeeEntity::$ACCOUNTNUMBER);

		/******** cardnumber ********/
		$CardnumberInfo=new FieldInfo();
		$CardnumberInfo->setTitle("شماره کارت بانکی");
		$this->setFieldInfo(iribfinance_employeeEntity::$CARDNUMBER,$CardnumberInfo);
		$this->addTableField('23',iribfinance_employeeEntity::$CARDNUMBER);

		/******** bank_fid ********/
		$Bank_fidInfo=new FieldInfo();
		$Bank_fidInfo->setTitle("بانک");
		$this->setFieldInfo(iribfinance_employeeEntity::$BANK_FID,$Bank_fidInfo);
		$this->addTableField('24',iribfinance_employeeEntity::$BANK_FID);

		/******** is_neededinsurance ********/
		$Is_neededinsuranceInfo=new FieldInfo();
		$Is_neededinsuranceInfo->setTitle("بیمه");
		$this->setFieldInfo(iribfinance_employeeEntity::$IS_NEEDEDINSURANCE,$Is_neededinsuranceInfo);
		$this->addTableField('25',iribfinance_employeeEntity::$IS_NEEDEDINSURANCE);

		/******** is_payabale ********/
		$Is_payabaleInfo=new FieldInfo();
		$Is_payabaleInfo->setTitle("مجوز پرداخت");
		$this->setFieldInfo(iribfinance_employeeEntity::$IS_PAYABALE,$Is_payabaleInfo);
		$this->addTableField('26',iribfinance_employeeEntity::$IS_PAYABALE);

		/******** passportnumber ********/
		$PassportnumberInfo=new FieldInfo();
		$PassportnumberInfo->setTitle("شماره پاسپورت");
		$this->setFieldInfo(iribfinance_employeeEntity::$PASSPORTNUMBER,$PassportnumberInfo);
		$this->addTableField('27',iribfinance_employeeEntity::$PASSPORTNUMBER);

		/******** passportserial ********/
		$PassportserialInfo=new FieldInfo();
		$PassportserialInfo->setTitle("شماره سریال پاسپورت");
		$this->setFieldInfo(iribfinance_employeeEntity::$PASSPORTSERIAL,$PassportserialInfo);
		$this->addTableField('28',iribfinance_employeeEntity::$PASSPORTSERIAL);

		/******** education ********/
		$EducationInfo=new FieldInfo();
		$EducationInfo->setTitle("تحصیلات");
		$this->setFieldInfo(iribfinance_employeeEntity::$EDUCATION,$EducationInfo);
		$this->addTableField('29',iribfinance_employeeEntity::$EDUCATION);

		/******** entrance_date ********/
		$Entrance_dateInfo=new FieldInfo();
		$Entrance_dateInfo->setTitle("تاریخ ورود به ایران");
		$this->setFieldInfo(iribfinance_employeeEntity::$ENTRANCE_DATE,$Entrance_dateInfo);
		$this->addTableField('30',iribfinance_employeeEntity::$ENTRANCE_DATE);

		/******** visatype_fid ********/
		$Visatype_fidInfo=new FieldInfo();
		$Visatype_fidInfo->setTitle("نوع ویزا");
		$this->setFieldInfo(iribfinance_employeeEntity::$VISATYPE_FID,$Visatype_fidInfo);
		$this->addTableField('31',iribfinance_employeeEntity::$VISATYPE_FID);

		/******** visaexpire_date ********/
		$Visaexpire_dateInfo=new FieldInfo();
		$Visaexpire_dateInfo->setTitle("تاریخ انقضای ویزا");
		$this->setFieldInfo(iribfinance_employeeEntity::$VISAEXPIRE_DATE,$Visaexpire_dateInfo);
		$this->addTableField('32',iribfinance_employeeEntity::$VISAEXPIRE_DATE);
	}
	public static $NAME="name";
	/**
	 * @return mixed
	 */
	public function getName(){
		return $this->getField(iribfinance_employeeEntity::$NAME);
	}
	/**
	 * @param mixed $Name
	 */
	public function setName($Name){
		$this->setField(iribfinance_employeeEntity::$NAME,$Name);
	}
	public static $FAMILY="family";
	/**
	 * @return mixed
	 */
	public function getFamily(){
		return $this->getField(iribfinance_employeeEntity::$FAMILY);
	}
	/**
	 * @param mixed $Family
	 */
	public function setFamily($Family){
		$this->setField(iribfinance_employeeEntity::$FAMILY,$Family);
	}
	public static $FATHERNAME="fathername";
	/**
	 * @return mixed
	 */
	public function getFathername(){
		return $this->getField(iribfinance_employeeEntity::$FATHERNAME);
	}
	/**
	 * @param mixed $Fathername
	 */
	public function setFathername($Fathername){
		$this->setField(iribfinance_employeeEntity::$FATHERNAME,$Fathername);
	}
	public static $ISMALE="ismale";
	/**
	 * @return mixed
	 */
	public function getIsmale(){
		return $this->getField(iribfinance_employeeEntity::$ISMALE);
	}
	/**
	 * @param mixed $Ismale
	 */
	public function setIsmale($Ismale){
		$this->setField(iribfinance_employeeEntity::$ISMALE,$Ismale);
	}
	public static $MELLICODE="mellicode";
	/**
	 * @return mixed
	 */
	public function getMellicode(){
		return $this->getField(iribfinance_employeeEntity::$MELLICODE);
	}
	/**
	 * @param mixed $Mellicode
	 */
	public function setMellicode($Mellicode){
		$this->setField(iribfinance_employeeEntity::$MELLICODE,$Mellicode);
	}
	public static $SHSH="shsh";
	/**
	 * @return mixed
	 */
	public function getShsh(){
		return $this->getField(iribfinance_employeeEntity::$SHSH);
	}
	/**
	 * @param mixed $Shsh
	 */
	public function setShsh($Shsh){
		$this->setField(iribfinance_employeeEntity::$SHSH,$Shsh);
	}
	public static $SHSHSERIAL="shshserial";
	/**
	 * @return mixed
	 */
	public function getShshserial(){
		return $this->getField(iribfinance_employeeEntity::$SHSHSERIAL);
	}
	/**
	 * @param mixed $Shshserial
	 */
	public function setShshserial($Shshserial){
		$this->setField(iribfinance_employeeEntity::$SHSHSERIAL,$Shshserial);
	}
	public static $PERSONELCODE="personelcode";
	/**
	 * @return mixed
	 */
	public function getPersonelcode(){
		return $this->getField(iribfinance_employeeEntity::$PERSONELCODE);
	}
	/**
	 * @param mixed $Personelcode
	 */
	public function setPersonelcode($Personelcode){
		$this->setField(iribfinance_employeeEntity::$PERSONELCODE,$Personelcode);
	}
	public static $EMPLOYMENTCODE="employmentcode";
	/**
	 * @return mixed
	 */
	public function getEmploymentcode(){
		return $this->getField(iribfinance_employeeEntity::$EMPLOYMENTCODE);
	}
	/**
	 * @param mixed $Employmentcode
	 */
	public function setEmploymentcode($Employmentcode){
		$this->setField(iribfinance_employeeEntity::$EMPLOYMENTCODE,$Employmentcode);
	}
	public static $ROLE_FID="role_fid";
	/**
	 * @return mixed
	 */
	public function getRole_fid(){
		return $this->getField(iribfinance_employeeEntity::$ROLE_FID);
	}
	/**
	 * @param mixed $Role_fid
	 */
	public function setRole_fid($Role_fid){
		$this->setField(iribfinance_employeeEntity::$ROLE_FID,$Role_fid);
	}
	public static $NATIONALITY_FID="nationality_fid";
	/**
	 * @return mixed
	 */
	public function getNationality_fid(){
		return $this->getField(iribfinance_employeeEntity::$NATIONALITY_FID);
	}
	/**
	 * @param mixed $Nationality_fid
	 */
	public function setNationality_fid($Nationality_fid){
		$this->setField(iribfinance_employeeEntity::$NATIONALITY_FID,$Nationality_fid);
	}
	public static $PAYCENTER_FID="paycenter_fid";
	/**
	 * @return mixed
	 */
	public function getPaycenter_fid(){
		return $this->getField(iribfinance_employeeEntity::$PAYCENTER_FID);
	}
	/**
	 * @param mixed $Paycenter_fid
	 */
	public function setPaycenter_fid($Paycenter_fid){
		$this->setField(iribfinance_employeeEntity::$PAYCENTER_FID,$Paycenter_fid);
	}
	public static $EMPLOYMENTTYPE_FID="employmenttype_fid";
	/**
	 * @return mixed
	 */
	public function getEmploymenttype_fid(){
		return $this->getField(iribfinance_employeeEntity::$EMPLOYMENTTYPE_FID);
	}
	/**
	 * @param mixed $Employmenttype_fid
	 */
	public function setEmploymenttype_fid($Employmenttype_fid){
		$this->setField(iribfinance_employeeEntity::$EMPLOYMENTTYPE_FID,$Employmenttype_fid);
	}
	public static $BORN_DATE="born_date";
	/**
	 * @return mixed
	 */
	public function getBorn_date(){
		return $this->getField(iribfinance_employeeEntity::$BORN_DATE);
	}
	/**
	 * @param mixed $Born_date
	 */
	public function setBorn_date($Born_date){
		$this->setField(iribfinance_employeeEntity::$BORN_DATE,$Born_date);
	}
	public static $CHILDCOUNT="childcount";
	/**
	 * @return mixed
	 */
	public function getChildcount(){
		return $this->getField(iribfinance_employeeEntity::$CHILDCOUNT);
	}
	/**
	 * @param mixed $Childcount
	 */
	public function setChildcount($Childcount){
		$this->setField(iribfinance_employeeEntity::$CHILDCOUNT,$Childcount);
	}
	public static $ISMARRIED="ismarried";
	/**
	 * @return mixed
	 */
	public function getIsmarried(){
		return $this->getField(iribfinance_employeeEntity::$ISMARRIED);
	}
	/**
	 * @param mixed $Ismarried
	 */
	public function setIsmarried($Ismarried){
		$this->setField(iribfinance_employeeEntity::$ISMARRIED,$Ismarried);
	}
	public static $MOBILE="mobile";
	/**
	 * @return mixed
	 */
	public function getMobile(){
		return $this->getField(iribfinance_employeeEntity::$MOBILE);
	}
	/**
	 * @param mixed $Mobile
	 */
	public function setMobile($Mobile){
		$this->setField(iribfinance_employeeEntity::$MOBILE,$Mobile);
	}
	public static $TEL="tel";
	/**
	 * @return mixed
	 */
	public function getTel(){
		return $this->getField(iribfinance_employeeEntity::$TEL);
	}
	/**
	 * @param mixed $Tel
	 */
	public function setTel($Tel){
		$this->setField(iribfinance_employeeEntity::$TEL,$Tel);
	}
	public static $ADDRESS="address";
	/**
	 * @return mixed
	 */
	public function getAddress(){
		return $this->getField(iribfinance_employeeEntity::$ADDRESS);
	}
	/**
	 * @param mixed $Address
	 */
	public function setAddress($Address){
		$this->setField(iribfinance_employeeEntity::$ADDRESS,$Address);
	}
	public static $ZIPCODE="zipcode";
	/**
	 * @return mixed
	 */
	public function getZipcode(){
		return $this->getField(iribfinance_employeeEntity::$ZIPCODE);
	}
	/**
	 * @param mixed $Zipcode
	 */
	public function setZipcode($Zipcode){
		$this->setField(iribfinance_employeeEntity::$ZIPCODE,$Zipcode);
	}
	public static $COMMON_CITY_FID="common_city_fid";
	/**
	 * @return mixed
	 */
	public function getCommon_city_fid(){
		return $this->getField(iribfinance_employeeEntity::$COMMON_CITY_FID);
	}
	/**
	 * @param mixed $Common_city_fid
	 */
	public function setCommon_city_fid($Common_city_fid){
		$this->setField(iribfinance_employeeEntity::$COMMON_CITY_FID,$Common_city_fid);
	}
	public static $ACCOUNTNUMBER="accountnumber";
	/**
	 * @return mixed
	 */
	public function getAccountnumber(){
		return $this->getField(iribfinance_employeeEntity::$ACCOUNTNUMBER);
	}
	/**
	 * @param mixed $Accountnumber
	 */
	public function setAccountnumber($Accountnumber){
		$this->setField(iribfinance_employeeEntity::$ACCOUNTNUMBER,$Accountnumber);
	}
	public static $CARDNUMBER="cardnumber";
	/**
	 * @return mixed
	 */
	public function getCardnumber(){
		return $this->getField(iribfinance_employeeEntity::$CARDNUMBER);
	}
	/**
	 * @param mixed $Cardnumber
	 */
	public function setCardnumber($Cardnumber){
		$this->setField(iribfinance_employeeEntity::$CARDNUMBER,$Cardnumber);
	}
	public static $BANK_FID="bank_fid";
	/**
	 * @return mixed
	 */
	public function getBank_fid(){
		return $this->getField(iribfinance_employeeEntity::$BANK_FID);
	}
	/**
	 * @param mixed $Bank_fid
	 */
	public function setBank_fid($Bank_fid){
		$this->setField(iribfinance_employeeEntity::$BANK_FID,$Bank_fid);
	}
	public static $IS_NEEDEDINSURANCE="is_neededinsurance";
	/**
	 * @return mixed
	 */
	public function getIs_neededinsurance(){
		return $this->getField(iribfinance_employeeEntity::$IS_NEEDEDINSURANCE);
	}
	/**
	 * @param mixed $Is_neededinsurance
	 */
	public function setIs_neededinsurance($Is_neededinsurance){
		$this->setField(iribfinance_employeeEntity::$IS_NEEDEDINSURANCE,$Is_neededinsurance);
	}
	public static $IS_PAYABALE="is_payabale";
	/**
	 * @return mixed
	 */
	public function getIs_payabale(){
		return $this->getField(iribfinance_employeeEntity::$IS_PAYABALE);
	}
	/**
	 * @param mixed $Is_payabale
	 */
	public function setIs_payabale($Is_payabale){
		$this->setField(iribfinance_employeeEntity::$IS_PAYABALE,$Is_payabale);
	}
	public static $PASSPORTNUMBER="passportnumber";
	/**
	 * @return mixed
	 */
	public function getPassportnumber(){
		return $this->getField(iribfinance_employeeEntity::$PASSPORTNUMBER);
	}
	/**
	 * @param mixed $Passportnumber
	 */
	public function setPassportnumber($Passportnumber){
		$this->setField(iribfinance_employeeEntity::$PASSPORTNUMBER,$Passportnumber);
	}
	public static $PASSPORTSERIAL="passportserial";
	/**
	 * @return mixed
	 */
	public function getPassportserial(){
		return $this->getField(iribfinance_employeeEntity::$PASSPORTSERIAL);
	}
	/**
	 * @param mixed $Passportserial
	 */
	public function setPassportserial($Passportserial){
		$this->setField(iribfinance_employeeEntity::$PASSPORTSERIAL,$Passportserial);
	}
	public static $EDUCATION="education";
	/**
	 * @return mixed
	 */
	public function getEducation(){
		return $this->getField(iribfinance_employeeEntity::$EDUCATION);
	}
	/**
	 * @param mixed $Education
	 */
	public function setEducation($Education){
		$this->setField(iribfinance_employeeEntity::$EDUCATION,$Education);
	}
	public static $ENTRANCE_DATE="entrance_date";
	/**
	 * @return mixed
	 */
	public function getEntrance_date(){
		return $this->getField(iribfinance_employeeEntity::$ENTRANCE_DATE);
	}
	/**
	 * @param mixed $Entrance_date
	 */
	public function setEntrance_date($Entrance_date){
		$this->setField(iribfinance_employeeEntity::$ENTRANCE_DATE,$Entrance_date);
	}
	public static $VISATYPE_FID="visatype_fid";
	/**
	 * @return mixed
	 */
	public function getVisatype_fid(){
		return $this->getField(iribfinance_employeeEntity::$VISATYPE_FID);
	}
	/**
	 * @param mixed $Visatype_fid
	 */
	public function setVisatype_fid($Visatype_fid){
		$this->setField(iribfinance_employeeEntity::$VISATYPE_FID,$Visatype_fid);
	}
	public static $VISAEXPIRE_DATE="visaexpire_date";
	/**
	 * @return mixed
	 */
	public function getVisaexpire_date(){
		return $this->getField(iribfinance_employeeEntity::$VISAEXPIRE_DATE);
	}
	/**
	 * @param mixed $Visaexpire_date
	 */
	public function setVisaexpire_date($Visaexpire_date){
		$this->setField(iribfinance_employeeEntity::$VISAEXPIRE_DATE,$Visaexpire_date);
	}
}
?>