<?php
namespace Modules\room\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-05-25 - 2017-08-16 01:03
*@lastUpdate 1396-05-25 - 2017-08-16 01:03
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class room_carEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("room_car");
	}
	public static $DETAILS="details";
	/**
	 * @return mixed
	 */
	public function getDetails(){
		return $this->getField(room_carEntity::$DETAILS);
	}
	/**
	 * @param mixed $Details
	 */
	public function setDetails($Details){
		$this->setField(room_carEntity::$DETAILS,$Details);
	}
	public static $PRICE="price";
	/**
	 * @return mixed
	 */
	public function getPrice(){
		return $this->getField(room_carEntity::$PRICE);
	}
	/**
	 * @param mixed $Price
	 */
	public function setPrice($Price){
		$this->setField(room_carEntity::$PRICE,$Price);
	}
	public static $ADDDATE="adddate";
	/**
	 * @return mixed
	 */
	public function getAdddate(){
		return $this->getField(room_carEntity::$ADDDATE);
	}
	/**
	 * @param mixed $Adddate
	 */
	public function setAdddate($Adddate){
		$this->setField(room_carEntity::$ADDDATE,$Adddate);
	}
	public static $BODY_CARCOLOR_FID="body_carcolor_fid";
	/**
	 * @return mixed
	 */
	public function getBody_carcolor_fid(){
		return $this->getField(room_carEntity::$BODY_CARCOLOR_FID);
	}
	/**
	 * @param mixed $Body_carcolor_fid
	 */
	public function setBody_carcolor_fid($Body_carcolor_fid){
		$this->setField(room_carEntity::$BODY_CARCOLOR_FID,$Body_carcolor_fid);
	}
	public static $INNER_CARCOLOR_FID="inner_carcolor_fid";
	/**
	 * @return mixed
	 */
	public function getInner_carcolor_fid(){
		return $this->getField(room_carEntity::$INNER_CARCOLOR_FID);
	}
	/**
	 * @param mixed $Inner_carcolor_fid
	 */
	public function setInner_carcolor_fid($Inner_carcolor_fid){
		$this->setField(room_carEntity::$INNER_CARCOLOR_FID,$Inner_carcolor_fid);
	}
	public static $PAYTYPE_FID="paytype_fid";
	/**
	 * @return mixed
	 */
	public function getPaytype_fid(){
		return $this->getField(room_carEntity::$PAYTYPE_FID);
	}
	/**
	 * @param mixed $Paytype_fid
	 */
	public function setPaytype_fid($Paytype_fid){
		$this->setField(room_carEntity::$PAYTYPE_FID,$Paytype_fid);
	}
	public static $CARTYPE_FID="cartype_fid";
	/**
	 * @return mixed
	 */
	public function getCartype_fid(){
		return $this->getField(room_carEntity::$CARTYPE_FID);
	}
	/**
	 * @param mixed $Cartype_fid
	 */
	public function setCartype_fid($Cartype_fid){
		$this->setField(room_carEntity::$CARTYPE_FID,$Cartype_fid);
	}
	public static $USAGECOUNT="usagecount";
	/**
	 * @return mixed
	 */
	public function getUsagecount(){
		return $this->getField(room_carEntity::$USAGECOUNT);
	}
	/**
	 * @param mixed $Usagecount
	 */
	public function setUsagecount($Usagecount){
		$this->setField(room_carEntity::$USAGECOUNT,$Usagecount);
	}
	public static $ROLE_SYSTEMUSER_FID="role_systemuser_fid";
	/**
	 * @return mixed
	 */
	public function getRole_systemuser_fid(){
		return $this->getField(room_carEntity::$ROLE_SYSTEMUSER_FID);
	}
	/**
	 * @param mixed $Role_systemuser_fid
	 */
	public function setRole_systemuser_fid($Role_systemuser_fid){
		$this->setField(room_carEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fid);
	}
	public static $WHERETODATE="wheretodate";
	/**
	 * @return mixed
	 */
	public function getWheretodate(){
		return $this->getField(room_carEntity::$WHERETODATE);
	}
	/**
	 * @param mixed $Wheretodate
	 */
	public function setWheretodate($Wheretodate){
		$this->setField(room_carEntity::$WHERETODATE,$Wheretodate);
	}
	public static $CARBODYSTATUS_FID="carbodystatus_fid";
	/**
	 * @return mixed
	 */
	public function getCarbodystatus_fid(){
		return $this->getField(room_carEntity::$CARBODYSTATUS_FID);
	}
	/**
	 * @param mixed $Carbodystatus_fid
	 */
	public function setCarbodystatus_fid($Carbodystatus_fid){
		$this->setField(room_carEntity::$CARBODYSTATUS_FID,$Carbodystatus_fid);
	}
	public static $MAKEDATE="makedate";
	/**
	 * @return mixed
	 */
	public function getMakedate(){
		return $this->getField(room_carEntity::$MAKEDATE);
	}
	/**
	 * @param mixed $Makedate
	 */
	public function setMakedate($Makedate){
		$this->setField(room_carEntity::$MAKEDATE,$Makedate);
	}
	public static $CARSTATUS_FID="carstatus_fid";
	/**
	 * @return mixed
	 */
	public function getCarstatus_fid(){
		return $this->getField(room_carEntity::$CARSTATUS_FID);
	}
	/**
	 * @param mixed $Carstatus_fid
	 */
	public function setCarstatus_fid($Carstatus_fid){
		$this->setField(room_carEntity::$CARSTATUS_FID,$Carstatus_fid);
	}
	public static $SHASITYPE_FID="shasitype_fid";
	/**
	 * @return mixed
	 */
	public function getShasitype_fid(){
		return $this->getField(room_carEntity::$SHASITYPE_FID);
	}
	/**
	 * @param mixed $Shasitype_fid
	 */
	public function setShasitype_fid($Shasitype_fid){
		$this->setField(room_carEntity::$SHASITYPE_FID,$Shasitype_fid);
	}
	public static $ISAUTOGEARBOX="isautogearbox";
	/**
	 * @return mixed
	 */
	public function getIsautogearbox(){
		return $this->getField(room_carEntity::$ISAUTOGEARBOX);
	}
	/**
	 * @param mixed $Isautogearbox
	 */
	public function setIsautogearbox($Isautogearbox){
		$this->setField(room_carEntity::$ISAUTOGEARBOX,$Isautogearbox);
	}
	public static $CARMODEL_FID="carmodel_fid";
	/**
	 * @return mixed
	 */
	public function getCarmodel_fid(){
		return $this->getField(room_carEntity::$CARMODEL_FID);
	}
	/**
	 * @param mixed $Carmodel_fid
	 */
	public function setCarmodel_fid($Carmodel_fid){
		$this->setField(room_carEntity::$CARMODEL_FID,$Carmodel_fid);
	}
	public static $CARTAGTYPE_FID="cartagtype_fid";
	/**
	 * @return mixed
	 */
	public function getCartagtype_fid(){
		return $this->getField(room_carEntity::$CARTAGTYPE_FID);
	}
	/**
	 * @param mixed $Cartagtype_fid
	 */
	public function setCartagtype_fid($Cartagtype_fid){
		$this->setField(room_carEntity::$CARTAGTYPE_FID,$Cartagtype_fid);
	}
	public static $CARENTITYTYPE_FID="carentitytype_fid";
	/**
	 * @return mixed
	 */
	public function getCarentitytype_fid(){
		return $this->getField(room_carEntity::$CARENTITYTYPE_FID);
	}
	/**
	 * @param mixed $Carentitytype_fid
	 */
	public function setCarentitytype_fid($Carentitytype_fid){
		$this->setField(room_carEntity::$CARENTITYTYPE_FID,$Carentitytype_fid);
	}
}
?>