<?php
namespace Modules\shift\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-26 - 2018-01-16 20:27
*@lastUpdate 1396-10-26 - 2018-01-16 20:27
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class shift_madrakEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("shift_madrak");
		$this->setTableTitle("مدرک");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("عنوان");
		$this->setFieldInfo(shift_madrakEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',shift_madrakEntity::$TITLE);

		/******** zarib ********/
		$ZaribInfo=new FieldInfo();
		$ZaribInfo->setTitle("ضریب");
		$this->setFieldInfo(shift_madrakEntity::$ZARIB,$ZaribInfo);
		$this->addTableField('2',shift_madrakEntity::$ZARIB);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(shift_madrakEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(shift_madrakEntity::$TITLE,$Title);
	}
	public static $ZARIB="zarib";
	/**
	 * @return mixed
	 */
	public function getZarib(){
		return $this->getField(shift_madrakEntity::$ZARIB);
	}
	/**
	 * @param mixed $Zarib
	 */
	public function setZarib($Zarib){
		$this->setField(shift_madrakEntity::$ZARIB,$Zarib);
	}
}
?>