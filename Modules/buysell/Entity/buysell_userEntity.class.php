<?php
namespace Modules\buysell\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-16 - 2017-09-07 01:22
*@lastUpdate 1396-06-16 - 2017-09-07 01:22
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class buysell_userEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("buysell_user");
	}
	public static $NAME="name";
	/**
	 * @return mixed
	 */
	public function getName(){
		return $this->getField(buysell_userEntity::$NAME);
	}
	/**
	 * @param mixed $Name
	 */
	public function setName($Name){
		$this->setField(buysell_userEntity::$NAME,$Name);
	}
	public static $EMAIL="email";
	/**
	 * @return mixed
	 */
	public function getEmail(){
		return $this->getField(buysell_userEntity::$EMAIL);
	}
	/**
	 * @param mixed $Email
	 */
	public function setEmail($Email){
		$this->setField(buysell_userEntity::$EMAIL,$Email);
	}
	public static $TEL="tel";
	/**
	 * @return mixed
	 */
	public function getTel(){
		return $this->getField(buysell_userEntity::$TEL);
	}
	/**
	 * @param mixed $Tel
	 */
	public function setTel($Tel){
		$this->setField(buysell_userEntity::$TEL,$Tel);
	}
	public static $MOB="mob";
	/**
	 * @return mixed
	 */
	public function getMob(){
		return $this->getField(buysell_userEntity::$MOB);
	}
	/**
	 * @param mixed $Mob
	 */
	public function setMob($Mob){
		$this->setField(buysell_userEntity::$MOB,$Mob);
	}
	public static $POSTALCODE="postalcode";
	/**
	 * @return mixed
	 */
	public function getPostalcode(){
		return $this->getField(buysell_userEntity::$POSTALCODE);
	}
	/**
	 * @param mixed $Postalcode
	 */
	public function setPostalcode($Postalcode){
		$this->setField(buysell_userEntity::$POSTALCODE,$Postalcode);
	}
	public static $ISMALE="ismale";
	/**
	 * @return mixed
	 */
	public function getIsmale(){
		return $this->getField(buysell_userEntity::$ISMALE);
	}
	/**
	 * @param mixed $Ismale
	 */
	public function setIsmale($Ismale){
		$this->setField(buysell_userEntity::$ISMALE,$Ismale);
	}
	public static $COMMON_CITY_FID="common_city_fid";
	/**
	 * @return mixed
	 */
	public function getCommon_city_fid(){
		return $this->getField(buysell_userEntity::$COMMON_CITY_FID);
	}
	/**
	 * @param mixed $Common_city_fid
	 */
	public function setCommon_city_fid($Common_city_fid){
		$this->setField(buysell_userEntity::$COMMON_CITY_FID,$Common_city_fid);
	}
	public static $BIRTHDAY="birthday";
	/**
	 * @return mixed
	 */
	public function getBirthday(){
		return $this->getField(buysell_userEntity::$BIRTHDAY);
	}
	/**
	 * @param mixed $Birthday
	 */
	public function setBirthday($Birthday){
		$this->setField(buysell_userEntity::$BIRTHDAY,$Birthday);
	}
	public static $ISPAYED="ispayed";
	/**
	 * @return mixed
	 */
	public function getIspayed(){
		return $this->getField(buysell_userEntity::$ISPAYED);
	}
	/**
	 * @param mixed $Ispayed
	 */
	public function setIspayed($Ispayed){
		$this->setField(buysell_userEntity::$ISPAYED,$Ispayed);
	}
	public static $SIGNUPDATE="signupdate";
	/**
	 * @return mixed
	 */
	public function getSignupdate(){
		return $this->getField(buysell_userEntity::$SIGNUPDATE);
	}
	/**
	 * @param mixed $Signupdate
	 */
	public function setSignupdate($Signupdate){
		$this->setField(buysell_userEntity::$SIGNUPDATE,$Signupdate);
	}
	public static $PHOTO="photo";
	/**
	 * @return mixed
	 */
	public function getPhoto(){
		return $this->getField(buysell_userEntity::$PHOTO);
	}
	/**
	 * @param mixed $Photo
	 */
	public function setPhoto($Photo){
		$this->setField(buysell_userEntity::$PHOTO,$Photo);
	}
	public static $IS_INFO_VISIBLE="is_info_visible";
	/**
	 * @return mixed
	 */
	public function getIs_info_visible(){
		return $this->getField(buysell_userEntity::$IS_INFO_VISIBLE);
	}
	/**
	 * @param mixed $Is_info_visible
	 */
	public function setIs_info_visible($Is_info_visible){
		$this->setField(buysell_userEntity::$IS_INFO_VISIBLE,$Is_info_visible);
	}
	public static $CARMODEL_FID="carmodel_fid";
	/**
	 * @return mixed
	 */
	public function getCarmodel_fid(){
		return $this->getField(buysell_userEntity::$CARMODEL_FID);
	}
	/**
	 * @param mixed $Carmodel_fid
	 */
	public function setCarmodel_fid($Carmodel_fid){
		$this->setField(buysell_userEntity::$CARMODEL_FID,$Carmodel_fid);
	}
	public static $ROLE_SYSTEMUSER_FID="role_systemuser_fid";
	/**
	 * @return mixed
	 */
	public function getRole_systemuser_fid(){
		return $this->getField(buysell_userEntity::$ROLE_SYSTEMUSER_FID);
	}
	/**
	 * @param mixed $Role_systemuser_fid
	 */
	public function setRole_systemuser_fid($Role_systemuser_fid){
		$this->setField(buysell_userEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fid);
	}
}
?>