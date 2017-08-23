<?php
namespace Modules\room\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-05-25 - 2017-08-16 01:14
*@lastUpdate 1396-05-25 - 2017-08-16 01:14
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class room_carentitytypeEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("room_carentitytype");
	}
	public static $LATINTITLE="latintitle";
	/**
	 * @return mixed
	 */
	public function getLatintitle(){
		return $this->getField(room_carentitytypeEntity::$LATINTITLE);
	}
	/**
	 * @param mixed $Latintitle
	 */
	public function setLatintitle($Latintitle){
		$this->setField(room_carentitytypeEntity::$LATINTITLE,$Latintitle);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(room_carentitytypeEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(room_carentitytypeEntity::$TITLE,$Title);
	}
}
?>