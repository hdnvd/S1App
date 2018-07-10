<?php
namespace Modules\shift\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-27 - 2018-01-17 15:45
*@lastUpdate 1396-10-27 - 2018-01-17 15:45
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class shift_roleEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("shift_role");
		$this->setTableTitle("shift_role");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("title");
		$this->setFieldInfo(shift_roleEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',shift_roleEntity::$TITLE);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(shift_roleEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(shift_roleEntity::$TITLE,$Title);
	}
}
?>