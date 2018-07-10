<?php
namespace Modules\buysell\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-03-31 - 2017-06-21 02:23
*@lastUpdate 1396-03-31 - 2017-06-21 02:23
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class buysell_carphotoEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("buysell_carphoto");
	}
	public static $CAR_FID="car_fid";
	/**
	 * @return mixed
	 */
	public function getCar_fid(){
		return $this->getField(buysell_carphotoEntity::$CAR_FID);
	}
	/**
	 * @param mixed $Car_fid
	 */
	public function setCar_fid($Car_fid){
		$this->setField(buysell_carphotoEntity::$CAR_FID,$Car_fid);
	}
	public static $PRIORITY="priority";
	/**
	 * @return mixed
	 */
	public function getPriority(){
		return $this->getField(buysell_carphotoEntity::$PRIORITY);
	}
	/**
	 * @param mixed $Priority
	 */
	public function setPriority($Priority){
		$this->setField(buysell_carphotoEntity::$PRIORITY,$Priority);
	}
	public static $IMG_FLU="img_flu";
	/**
	 * @return mixed
	 */
	public function getImg_flu(){
		return $this->getField(buysell_carphotoEntity::$IMG_FLU);
	}
	/**
	 * @param mixed $Img_flu
	 */
	public function setImg_flu($Img_flu){
		$this->setField(buysell_carphotoEntity::$IMG_FLU,$Img_flu);
	}
	public static $THUMBURL="thumburl";
	/**
	 * @return mixed
	 */
	public function getThumburl(){
		return $this->getField(buysell_carphotoEntity::$THUMBURL);
	}
	/**
	 * @param mixed $Thumburl
	 */
	public function setThumburl($Thumburl){
		$this->setField(buysell_carphotoEntity::$THUMBURL,$Thumburl);
	}
}
?>