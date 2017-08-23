<?php
namespace Modules\room\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-03-30 - 2017-06-20 02:44
*@lastUpdate 1396-03-30 - 2017-06-20 02:44
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class room_carmakerEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("room_carmaker");
	}
	public static $LATINTITLE="latintitle";
	/**
	 * @return mixed
	 */
	public function getLatintitle(){
		return $this->getField(room_carmakerEntity::$LATINTITLE);
	}
	/**
	 * @param mixed $Latintitle
	 */
	public function setLatintitle($Latintitle){
		$this->setField(room_carmakerEntity::$LATINTITLE,$Latintitle);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(room_carmakerEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(room_carmakerEntity::$TITLE,$Title);
	}
	public static $LOGO="logo";
	/**
	 * @return mixed
	 */
	public function getLogo(){
		return $this->getField(room_carmakerEntity::$LOGO);
	}
	/**
	 * @param mixed $Logo
	 */
	public function setLogo($Logo){
		$this->setField(room_carmakerEntity::$LOGO,$Logo);
	}
}
?>