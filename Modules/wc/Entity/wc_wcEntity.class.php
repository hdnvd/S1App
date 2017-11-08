<?php
namespace Modules\wc\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-16 - 2017-10-08 02:30
*@lastUpdate 1396-07-16 - 2017-10-08 02:30
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class wc_wcEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("wc_wc");
		$this->setTableTitle("wc_wc");
		$this->setTitleFieldName("id");

		/******** latitude ********/
		$LatitudeInfo=new FieldInfo();
		$LatitudeInfo->setTitle("latitude");
		$this->setFieldInfo(wc_wcEntity::$LATITUDE,$LatitudeInfo);
		$this->addTableField('1',wc_wcEntity::$LATITUDE);

		/******** longitude ********/
		$LongitudeInfo=new FieldInfo();
		$LongitudeInfo->setTitle("longitude");
		$this->setFieldInfo(wc_wcEntity::$LONGITUDE,$LongitudeInfo);
		$this->addTableField('2',wc_wcEntity::$LONGITUDE);

		/******** common_city_fid ********/
		$Common_city_fidInfo=new FieldInfo();
		$Common_city_fidInfo->setTitle("common_city_fid");
		$this->setFieldInfo(wc_wcEntity::$COMMON_CITY_FID,$Common_city_fidInfo);
		$this->addTableField('3',wc_wcEntity::$COMMON_CITY_FID);

		/******** isfarangi ********/
		$IsfarangiInfo=new FieldInfo();
		$IsfarangiInfo->setTitle("isfarangi");
		$this->setFieldInfo(wc_wcEntity::$ISFARANGI,$IsfarangiInfo);
		$this->addTableField('4',wc_wcEntity::$ISFARANGI);

		/******** isnormal ********/
		$IsnormalInfo=new FieldInfo();
		$IsnormalInfo->setTitle("isnormal");
		$this->setFieldInfo(wc_wcEntity::$ISNORMAL,$IsnormalInfo);
		$this->addTableField('5',wc_wcEntity::$ISNORMAL);

		/******** register_time ********/
		$Register_timeInfo=new FieldInfo();
		$Register_timeInfo->setTitle("register_time");
		$this->setFieldInfo(wc_wcEntity::$REGISTER_TIME,$Register_timeInfo);
		$this->addTableField('6',wc_wcEntity::$REGISTER_TIME);

		/******** role_systemuser_fid ********/
		$Role_systemuser_fidInfo=new FieldInfo();
		$Role_systemuser_fidInfo->setTitle("role_systemuser_fid");
		$this->setFieldInfo(wc_wcEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fidInfo);
		$this->addTableField('7',wc_wcEntity::$ROLE_SYSTEMUSER_FID);

		/******** ispublished ********/
		$IspublishedInfo=new FieldInfo();
		$IspublishedInfo->setTitle("ispublished");
		$this->setFieldInfo(wc_wcEntity::$ISPUBLISHED,$IspublishedInfo);
		$this->addTableField('8',wc_wcEntity::$ISPUBLISHED);

		/******** opentimes ********/
		$OpentimesInfo=new FieldInfo();
		$OpentimesInfo->setTitle("opentimes");
		$this->setFieldInfo(wc_wcEntity::$OPENTIMES,$OpentimesInfo);
		$this->addTableField('9',wc_wcEntity::$OPENTIMES);

		/******** placetitle ********/
		$PlacetitleInfo=new FieldInfo();
		$PlacetitleInfo->setTitle("placetitle");
		$this->setFieldInfo(wc_wcEntity::$PLACETITLE,$PlacetitleInfo);
		$this->addTableField('10',wc_wcEntity::$PLACETITLE);

		/******** isfree ********/
		$IsfreeInfo=new FieldInfo();
		$IsfreeInfo->setTitle("isfree");
		$this->setFieldInfo(wc_wcEntity::$ISFREE,$IsfreeInfo);
		$this->addTableField('11',wc_wcEntity::$ISFREE);
	}
	public static $LATITUDE="latitude";
	/**
	 * @return mixed
	 */
	public function getLatitude(){
		return $this->getField(wc_wcEntity::$LATITUDE);
	}
	/**
	 * @param mixed $Latitude
	 */
	public function setLatitude($Latitude){
		$this->setField(wc_wcEntity::$LATITUDE,$Latitude);
	}
	public static $LONGITUDE="longitude";
	/**
	 * @return mixed
	 */
	public function getLongitude(){
		return $this->getField(wc_wcEntity::$LONGITUDE);
	}
	/**
	 * @param mixed $Longitude
	 */
	public function setLongitude($Longitude){
		$this->setField(wc_wcEntity::$LONGITUDE,$Longitude);
	}
	public static $COMMON_CITY_FID="common_city_fid";
	/**
	 * @return mixed
	 */
	public function getCommon_city_fid(){
		return $this->getField(wc_wcEntity::$COMMON_CITY_FID);
	}
	/**
	 * @param mixed $Common_city_fid
	 */
	public function setCommon_city_fid($Common_city_fid){
		$this->setField(wc_wcEntity::$COMMON_CITY_FID,$Common_city_fid);
	}
	public static $ISFARANGI="isfarangi";
	/**
	 * @return mixed
	 */
	public function getIsfarangi(){
		return $this->getField(wc_wcEntity::$ISFARANGI);
	}
	/**
	 * @param mixed $Isfarangi
	 */
	public function setIsfarangi($Isfarangi){
		$this->setField(wc_wcEntity::$ISFARANGI,$Isfarangi);
	}
	public static $ISNORMAL="isnormal";
	/**
	 * @return mixed
	 */
	public function getIsnormal(){
		return $this->getField(wc_wcEntity::$ISNORMAL);
	}
	/**
	 * @param mixed $Isnormal
	 */
	public function setIsnormal($Isnormal){
		$this->setField(wc_wcEntity::$ISNORMAL,$Isnormal);
	}
	public static $REGISTER_TIME="register_time";
	/**
	 * @return mixed
	 */
	public function getRegister_time(){
		return $this->getField(wc_wcEntity::$REGISTER_TIME);
	}
	/**
	 * @param mixed $Register_time
	 */
	public function setRegister_time($Register_time){
		$this->setField(wc_wcEntity::$REGISTER_TIME,$Register_time);
	}
	public static $ROLE_SYSTEMUSER_FID="role_systemuser_fid";
	/**
	 * @return mixed
	 */
	public function getRole_systemuser_fid(){
		return $this->getField(wc_wcEntity::$ROLE_SYSTEMUSER_FID);
	}
	/**
	 * @param mixed $Role_systemuser_fid
	 */
	public function setRole_systemuser_fid($Role_systemuser_fid){
		$this->setField(wc_wcEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fid);
	}
	public static $ISPUBLISHED="ispublished";
	/**
	 * @return mixed
	 */
	public function getIspublished(){
		return $this->getField(wc_wcEntity::$ISPUBLISHED);
	}
	/**
	 * @param mixed $Ispublished
	 */
	public function setIspublished($Ispublished){
		$this->setField(wc_wcEntity::$ISPUBLISHED,$Ispublished);
	}
	public static $OPENTIMES="opentimes";
	/**
	 * @return mixed
	 */
	public function getOpentimes(){
		return $this->getField(wc_wcEntity::$OPENTIMES);
	}
	/**
	 * @param mixed $Opentimes
	 */
	public function setOpentimes($Opentimes){
		$this->setField(wc_wcEntity::$OPENTIMES,$Opentimes);
	}
	public static $PLACETITLE="placetitle";
	/**
	 * @return mixed
	 */
	public function getPlacetitle(){
		return $this->getField(wc_wcEntity::$PLACETITLE);
	}
	/**
	 * @param mixed $Placetitle
	 */
	public function setPlacetitle($Placetitle){
		$this->setField(wc_wcEntity::$PLACETITLE,$Placetitle);
	}
	public static $ISFREE="isfree";
	/**
	 * @return mixed
	 */
	public function getIsfree(){
		return $this->getField(wc_wcEntity::$ISFREE);
	}
	/**
	 * @param mixed $Isfree
	 */
	public function setIsfree($Isfree){
		$this->setField(wc_wcEntity::$ISFREE,$Isfree);
	}
}
?>