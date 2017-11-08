<?php
namespace Modules\onlineclass\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-25 - 2017-10-17 15:49
*@lastUpdate 1396-07-25 - 2017-10-17 15:49
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class onlineclass_levelEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("onlineclass_level");
		$this->setTableTitle("onlineclass_level");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("title");
		$this->setFieldInfo(onlineclass_levelEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',onlineclass_levelEntity::$TITLE);

		/******** priority ********/
		$PriorityInfo=new FieldInfo();
		$PriorityInfo->setTitle("priority");
		$this->setFieldInfo(onlineclass_levelEntity::$PRIORITY,$PriorityInfo);
		$this->addTableField('2',onlineclass_levelEntity::$PRIORITY);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(onlineclass_levelEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(onlineclass_levelEntity::$TITLE,$Title);
	}
	public static $PRIORITY="priority";
	/**
	 * @return mixed
	 */
	public function getPriority(){
		return $this->getField(onlineclass_levelEntity::$PRIORITY);
	}
	/**
	 * @param mixed $Priority
	 */
	public function setPriority($Priority){
		$this->setField(onlineclass_levelEntity::$PRIORITY,$Priority);
	}
}
?>