<?php
namespace Modules\shift\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-26 - 2018-01-16 19:11
*@lastUpdate 1396-10-26 - 2018-01-16 19:11
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class shift_bakhshEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("shift_bakhsh");
		$this->setTableTitle("بخش");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("عنوان");
		$this->setFieldInfo(shift_bakhshEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',shift_bakhshEntity::$TITLE);

		/******** sakhtikar ********/
		$SakhtikarInfo=new FieldInfo();
		$SakhtikarInfo->setTitle("سختی کار");
		$this->setFieldInfo(shift_bakhshEntity::$SAKHTIKAR,$SakhtikarInfo);
		$this->addTableField('2',shift_bakhshEntity::$SAKHTIKAR);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(shift_bakhshEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(shift_bakhshEntity::$TITLE,$Title);
	}
	public static $SAKHTIKAR="sakhtikar";
	/**
	 * @return mixed
	 */
	public function getSakhtikar(){
		return $this->getField(shift_bakhshEntity::$SAKHTIKAR);
	}
	/**
	 * @param mixed $Sakhtikar
	 */
	public function setSakhtikar($Sakhtikar){
		$this->setField(shift_bakhshEntity::$SAKHTIKAR,$Sakhtikar);
	}
}
?>