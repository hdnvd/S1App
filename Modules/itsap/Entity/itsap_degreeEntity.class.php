<?php
namespace Modules\itsap\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-08 - 2017-11-29 16:59
*@lastUpdate 1396-09-08 - 2017-11-29 16:59
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class itsap_degreeEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("itsap_degree");
		$this->setTableTitle("itsap_degree");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("عنوان");
		$this->setFieldInfo(itsap_degreeEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',itsap_degreeEntity::$TITLE);

		/******** priority ********/
		$PriorityInfo=new FieldInfo();
		$PriorityInfo->setTitle("کد");
		$this->setFieldInfo(itsap_degreeEntity::$PRIORITY,$PriorityInfo);
		$this->addTableField('2',itsap_degreeEntity::$PRIORITY);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(itsap_degreeEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(itsap_degreeEntity::$TITLE,$Title);
	}
	public static $PRIORITY="priority";
	/**
	 * @return mixed
	 */
	public function getPriority(){
		return $this->getField(itsap_degreeEntity::$PRIORITY);
	}
	/**
	 * @param mixed $Priority
	 */
	public function setPriority($Priority){
		$this->setField(itsap_degreeEntity::$PRIORITY,$Priority);
	}
}
?>