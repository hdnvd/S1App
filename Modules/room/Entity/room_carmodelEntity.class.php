<?php
namespace Modules\room\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-03-30 - 2017-06-20 04:18
*@lastUpdate 1396-03-30 - 2017-06-20 04:18
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class room_carmodelEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("room_carmodel");
	}
	public static $CARMAKER_FID="carmaker_fid";
	/**
	 * @return mixed
	 */
	public function getCarmaker_fid(){
		return $this->getField(room_carmodelEntity::$CARMAKER_FID);
	}
	/**
	 * @param mixed $Carmaker_fid
	 */
	public function setCarmaker_fid($Carmaker_fid){
		$this->setField(room_carmodelEntity::$CARMAKER_FID,$Carmaker_fid);
	}
	public static $LATINTITLE="latintitle";
	/**
	 * @return mixed
	 */
	public function getLatintitle(){
		return $this->getField(room_carmodelEntity::$LATINTITLE);
	}
	/**
	 * @param mixed $Latintitle
	 */
	public function setLatintitle($Latintitle){
		$this->setField(room_carmodelEntity::$LATINTITLE,$Latintitle);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(room_carmodelEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(room_carmodelEntity::$TITLE,$Title);
	}
	public static $LOGO_FLU="logo_flu";
	/**
	 * @return mixed
	 */
	public function getLogo_flu(){
		return $this->getField(room_carmodelEntity::$LOGO_FLU);
	}
	/**
	 * @param mixed $Logo_flu
	 */
	public function setLogo_flu($Logo_flu){
		$this->setField(room_carmodelEntity::$LOGO_FLU,$Logo_flu);
	}
}
?>