<?php
namespace Modules\finance\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-15 - 2017-09-06 17:42
*@lastUpdate 1396-06-15 - 2017-09-06 17:42
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class finance_chapterEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("finance_chapter");
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(finance_chapterEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(finance_chapterEntity::$TITLE,$Title);
	}
	public static $LATINTITLE="latintitle";
	/**
	 * @return mixed
	 */
	public function getLatintitle(){
		return $this->getField(finance_chapterEntity::$LATINTITLE);
	}
	/**
	 * @param mixed $Latintitle
	 */
	public function setLatintitle($Latintitle){
		$this->setField(finance_chapterEntity::$LATINTITLE,$Latintitle);
	}
}
?>