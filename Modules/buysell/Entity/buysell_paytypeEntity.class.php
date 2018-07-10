<?php
namespace Modules\buysell\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-03-24 - 2017-06-14 19:23
*@lastUpdate 1396-03-24 - 2017-06-14 19:23
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class buysell_paytypeEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("buysell_paytype");
	}
	public static $LATINTITLE="latintitle";
	/**
	 * @return mixed
	 */
	public function getLatintitle(){
		return $this->getField(buysell_paytypeEntity::$LATINTITLE);
	}
	/**
	 * @param mixed $Latintitle
	 */
	public function setLatintitle($Latintitle){
		$this->setField(buysell_paytypeEntity::$LATINTITLE,$Latintitle);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(buysell_paytypeEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(buysell_paytypeEntity::$TITLE,$Title);
	}
}
?>