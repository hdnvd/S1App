<?php
namespace Modules\ocms\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-24 - 2018-01-14 18:41
*@lastUpdate 1396-10-24 - 2018-01-14 18:41
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class ocms_doctorEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("ocms_doctor");
		$this->setTableTitle("متخصص");
		$this->setTitleFieldName("family");

		/******** name ********/
		$NameInfo=new FieldInfo();
		$NameInfo->setTitle("نام");
		$this->setFieldInfo(ocms_doctorEntity::$NAME,$NameInfo);
		$this->addTableField('1',ocms_doctorEntity::$NAME);

		/******** family ********/
		$FamilyInfo=new FieldInfo();
		$FamilyInfo->setTitle("نام خانوادگی");
		$this->setFieldInfo(ocms_doctorEntity::$FAMILY,$FamilyInfo);
		$this->addTableField('2',ocms_doctorEntity::$FAMILY);

		/******** nezam_code ********/
		$Nezam_codeInfo=new FieldInfo();
		$Nezam_codeInfo->setTitle("شناسه شغلی");
		$this->setFieldInfo(ocms_doctorEntity::$NEZAM_CODE,$Nezam_codeInfo);
		$this->addTableField('3',ocms_doctorEntity::$NEZAM_CODE);

		/******** mellicode ********/
		$MellicodeInfo=new FieldInfo();
		$MellicodeInfo->setTitle("کد ملی");
		$this->setFieldInfo(ocms_doctorEntity::$MELLICODE,$MellicodeInfo);
		$this->addTableField('4',ocms_doctorEntity::$MELLICODE);

		/******** mobile ********/
		$MobileInfo=new FieldInfo();
		$MobileInfo->setTitle("موبایل");
		$this->setFieldInfo(ocms_doctorEntity::$MOBILE,$MobileInfo);
		$this->addTableField('5',ocms_doctorEntity::$MOBILE);

		/******** email ********/
		$EmailInfo=new FieldInfo();
		$EmailInfo->setTitle("ایمیل");
		$this->setFieldInfo(ocms_doctorEntity::$EMAIL,$EmailInfo);
		$this->addTableField('6',ocms_doctorEntity::$EMAIL);

		/******** tel ********/
		$TelInfo=new FieldInfo();
		$TelInfo->setTitle("تلفن");
		$this->setFieldInfo(ocms_doctorEntity::$TEL,$TelInfo);
		$this->addTableField('7',ocms_doctorEntity::$TEL);

		/******** ismale ********/
		$IsmaleInfo=new FieldInfo();
		$IsmaleInfo->setTitle("جنسیت");
		$this->setFieldInfo(ocms_doctorEntity::$ISMALE,$IsmaleInfo);
		$this->addTableField('8',ocms_doctorEntity::$ISMALE);

		/******** speciality_fid ********/
		$Speciality_fidInfo=new FieldInfo();
		$Speciality_fidInfo->setTitle("تخصص");
		$this->setFieldInfo(ocms_doctorEntity::$SPECIALITY_FID,$Speciality_fidInfo);
		$this->addTableField('9',ocms_doctorEntity::$SPECIALITY_FID);

		/******** education ********/
		$EducationInfo=new FieldInfo();
		$EducationInfo->setTitle("تحصیلات");
		$this->setFieldInfo(ocms_doctorEntity::$EDUCATION,$EducationInfo);
		$this->addTableField('10',ocms_doctorEntity::$EDUCATION);

		/******** matabtel ********/
		$MatabtelInfo=new FieldInfo();
		$MatabtelInfo->setTitle("تلفن مطب");
		$this->setFieldInfo(ocms_doctorEntity::$MATABTEL,$MatabtelInfo);
		$this->addTableField('11',ocms_doctorEntity::$MATABTEL);

		/******** matabaddress ********/
		$MatabaddressInfo=new FieldInfo();
		$MatabaddressInfo->setTitle("آدرس مطب");
		$this->setFieldInfo(ocms_doctorEntity::$MATABADDRESS,$MatabaddressInfo);
		$this->addTableField('12',ocms_doctorEntity::$MATABADDRESS);

		/******** longitude ********/
		$LongitudeInfo=new FieldInfo();
		$LongitudeInfo->setTitle("longitude");
		$this->setFieldInfo(ocms_doctorEntity::$LONGITUDE,$LongitudeInfo);
		$this->addTableField('13',ocms_doctorEntity::$LONGITUDE);

		/******** latitude ********/
		$LatitudeInfo=new FieldInfo();
		$LatitudeInfo->setTitle("latitude");
		$this->setFieldInfo(ocms_doctorEntity::$LATITUDE,$LatitudeInfo);
		$this->addTableField('14',ocms_doctorEntity::$LATITUDE);

		/******** common_city_fid ********/
		$Common_city_fidInfo=new FieldInfo();
		$Common_city_fidInfo->setTitle("شهر");
		$this->setFieldInfo(ocms_doctorEntity::$COMMON_CITY_FID,$Common_city_fidInfo);
		$this->addTableField('15',ocms_doctorEntity::$COMMON_CITY_FID);

		/******** isactiveonphone ********/
		$IsactiveonphoneInfo=new FieldInfo();
		$IsactiveonphoneInfo->setTitle("امکان مشاوره تلفنی");
		$this->setFieldInfo(ocms_doctorEntity::$ISACTIVEONPHONE,$IsactiveonphoneInfo);
		$this->addTableField('16',ocms_doctorEntity::$ISACTIVEONPHONE);

		/******** isactiveonplace ********/
		$IsactiveonplaceInfo=new FieldInfo();
		$IsactiveonplaceInfo->setTitle("امکان مراجعه به محل کار");
		$this->setFieldInfo(ocms_doctorEntity::$ISACTIVEONPLACE,$IsactiveonplaceInfo);
		$this->addTableField('17',ocms_doctorEntity::$ISACTIVEONPLACE);

		/******** isactiveonhome ********/
		$IsactiveonhomeInfo=new FieldInfo();
		$IsactiveonhomeInfo->setTitle("امکان ویزیت در منزل");
		$this->setFieldInfo(ocms_doctorEntity::$ISACTIVEONHOME,$IsactiveonhomeInfo);
		$this->addTableField('18',ocms_doctorEntity::$ISACTIVEONHOME);

		/******** photo_flu ********/
		$Photo_fluInfo=new FieldInfo();
		$Photo_fluInfo->setTitle("تصویر پروفایل");
		$this->setFieldInfo(ocms_doctorEntity::$PHOTO_FLU,$Photo_fluInfo);
		$this->addTableField('19',ocms_doctorEntity::$PHOTO_FLU);

		/******** price ********/
		$PriceInfo=new FieldInfo();
		$PriceInfo->setTitle("هزینه ویزیت");
		$this->setFieldInfo(ocms_doctorEntity::$PRICE,$PriceInfo);
		$this->addTableField('20',ocms_doctorEntity::$PRICE);

		/******** role_systemuser_fid ********/
		$Role_systemuser_fidInfo=new FieldInfo();
		$Role_systemuser_fidInfo->setTitle("role_systemuser_fid");
		$this->setFieldInfo(ocms_doctorEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fidInfo);
		$this->addTableField('21',ocms_doctorEntity::$ROLE_SYSTEMUSER_FID);
	}
	public static $NAME="name";
	/**
	 * @return mixed
	 */
	public function getName(){
		return $this->getField(ocms_doctorEntity::$NAME);
	}
	/**
	 * @param mixed $Name
	 */
	public function setName($Name){
		$this->setField(ocms_doctorEntity::$NAME,$Name);
	}
	public static $FAMILY="family";
	/**
	 * @return mixed
	 */
	public function getFamily(){
		return $this->getField(ocms_doctorEntity::$FAMILY);
	}
	/**
	 * @param mixed $Family
	 */
	public function setFamily($Family){
		$this->setField(ocms_doctorEntity::$FAMILY,$Family);
	}
	public static $NEZAM_CODE="nezam_code";
	/**
	 * @return mixed
	 */
	public function getNezam_code(){
		return $this->getField(ocms_doctorEntity::$NEZAM_CODE);
	}
	/**
	 * @param mixed $Nezam_code
	 */
	public function setNezam_code($Nezam_code){
		$this->setField(ocms_doctorEntity::$NEZAM_CODE,$Nezam_code);
	}
	public static $MELLICODE="mellicode";
	/**
	 * @return mixed
	 */
	public function getMellicode(){
		return $this->getField(ocms_doctorEntity::$MELLICODE);
	}
	/**
	 * @param mixed $Mellicode
	 */
	public function setMellicode($Mellicode){
		$this->setField(ocms_doctorEntity::$MELLICODE,$Mellicode);
	}
	public static $MOBILE="mobile";
	/**
	 * @return mixed
	 */
	public function getMobile(){
		return $this->getField(ocms_doctorEntity::$MOBILE);
	}
	/**
	 * @param mixed $Mobile
	 */
	public function setMobile($Mobile){
		$this->setField(ocms_doctorEntity::$MOBILE,$Mobile);
	}
	public static $EMAIL="email";
	/**
	 * @return mixed
	 */
	public function getEmail(){
		return $this->getField(ocms_doctorEntity::$EMAIL);
	}
	/**
	 * @param mixed $Email
	 */
	public function setEmail($Email){
		$this->setField(ocms_doctorEntity::$EMAIL,$Email);
	}
	public static $TEL="tel";
	/**
	 * @return mixed
	 */
	public function getTel(){
		return $this->getField(ocms_doctorEntity::$TEL);
	}
	/**
	 * @param mixed $Tel
	 */
	public function setTel($Tel){
		$this->setField(ocms_doctorEntity::$TEL,$Tel);
	}
	public static $ISMALE="ismale";
	/**
	 * @return mixed
	 */
	public function getIsmale(){
		return $this->getField(ocms_doctorEntity::$ISMALE);
	}
	/**
	 * @param mixed $Ismale
	 */
	public function setIsmale($Ismale){
		$this->setField(ocms_doctorEntity::$ISMALE,$Ismale);
	}
	public static $SPECIALITY_FID="speciality_fid";
	/**
	 * @return mixed
	 */
	public function getSpeciality_fid(){
		return $this->getField(ocms_doctorEntity::$SPECIALITY_FID);
	}
	/**
	 * @param mixed $Speciality_fid
	 */
	public function setSpeciality_fid($Speciality_fid){
		$this->setField(ocms_doctorEntity::$SPECIALITY_FID,$Speciality_fid);
	}
	public static $EDUCATION="education";
	/**
	 * @return mixed
	 */
	public function getEducation(){
		return $this->getField(ocms_doctorEntity::$EDUCATION);
	}
	/**
	 * @param mixed $Education
	 */
	public function setEducation($Education){
		$this->setField(ocms_doctorEntity::$EDUCATION,$Education);
	}
	public static $MATABTEL="matabtel";
	/**
	 * @return mixed
	 */
	public function getMatabtel(){
		return $this->getField(ocms_doctorEntity::$MATABTEL);
	}
	/**
	 * @param mixed $Matabtel
	 */
	public function setMatabtel($Matabtel){
		$this->setField(ocms_doctorEntity::$MATABTEL,$Matabtel);
	}
	public static $MATABADDRESS="matabaddress";
	/**
	 * @return mixed
	 */
	public function getMatabaddress(){
		return $this->getField(ocms_doctorEntity::$MATABADDRESS);
	}
	/**
	 * @param mixed $Matabaddress
	 */
	public function setMatabaddress($Matabaddress){
		$this->setField(ocms_doctorEntity::$MATABADDRESS,$Matabaddress);
	}
	public static $LONGITUDE="longitude";
	/**
	 * @return mixed
	 */
	public function getLongitude(){
		return $this->getField(ocms_doctorEntity::$LONGITUDE);
	}
	/**
	 * @param mixed $Longitude
	 */
	public function setLongitude($Longitude){
		$this->setField(ocms_doctorEntity::$LONGITUDE,$Longitude);
	}
	public static $LATITUDE="latitude";
	/**
	 * @return mixed
	 */
	public function getLatitude(){
		return $this->getField(ocms_doctorEntity::$LATITUDE);
	}
	/**
	 * @param mixed $Latitude
	 */
	public function setLatitude($Latitude){
		$this->setField(ocms_doctorEntity::$LATITUDE,$Latitude);
	}
	public static $COMMON_CITY_FID="common_city_fid";
	/**
	 * @return mixed
	 */
	public function getCommon_city_fid(){
		return $this->getField(ocms_doctorEntity::$COMMON_CITY_FID);
	}
	/**
	 * @param mixed $Common_city_fid
	 */
	public function setCommon_city_fid($Common_city_fid){
		$this->setField(ocms_doctorEntity::$COMMON_CITY_FID,$Common_city_fid);
	}
	public static $ISACTIVEONPHONE="isactiveonphone";
	/**
	 * @return mixed
	 */
	public function getIsactiveonphone(){
		return $this->getField(ocms_doctorEntity::$ISACTIVEONPHONE);
	}
	/**
	 * @param mixed $Isactiveonphone
	 */
	public function setIsactiveonphone($Isactiveonphone){
		$this->setField(ocms_doctorEntity::$ISACTIVEONPHONE,$Isactiveonphone);
	}
	public static $ISACTIVEONPLACE="isactiveonplace";
	/**
	 * @return mixed
	 */
	public function getIsactiveonplace(){
		return $this->getField(ocms_doctorEntity::$ISACTIVEONPLACE);
	}
	/**
	 * @param mixed $Isactiveonplace
	 */
	public function setIsactiveonplace($Isactiveonplace){
		$this->setField(ocms_doctorEntity::$ISACTIVEONPLACE,$Isactiveonplace);
	}
	public static $ISACTIVEONHOME="isactiveonhome";
	/**
	 * @return mixed
	 */
	public function getIsactiveonhome(){
		return $this->getField(ocms_doctorEntity::$ISACTIVEONHOME);
	}
	/**
	 * @param mixed $Isactiveonhome
	 */
	public function setIsactiveonhome($Isactiveonhome){
		$this->setField(ocms_doctorEntity::$ISACTIVEONHOME,$Isactiveonhome);
	}
	public static $PHOTO_FLU="photo_flu";
	/**
	 * @return mixed
	 */
	public function getPhoto_flu(){
		return $this->getField(ocms_doctorEntity::$PHOTO_FLU);
	}
	/**
	 * @param mixed $Photo_flu
	 */
	public function setPhoto_flu($Photo_flu){
		$this->setField(ocms_doctorEntity::$PHOTO_FLU,$Photo_flu);
	}
	public static $PRICE="price";
	/**
	 * @return mixed
	 */
	public function getPrice(){
		return $this->getField(ocms_doctorEntity::$PRICE);
	}
	/**
	 * @param mixed $Price
	 */
	public function setPrice($Price){
		$this->setField(ocms_doctorEntity::$PRICE,$Price);
	}
	public static $ROLE_SYSTEMUSER_FID="role_systemuser_fid";
	/**
	 * @return mixed
	 */
	public function getRole_systemuser_fid(){
		return $this->getField(ocms_doctorEntity::$ROLE_SYSTEMUSER_FID);
	}
	/**
	 * @param mixed $Role_systemuser_fid
	 */
	public function setRole_systemuser_fid($Role_systemuser_fid){
		$this->setField(ocms_doctorEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fid);
	}
}
?>