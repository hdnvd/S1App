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
class onlineclass_tutorEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("onlineclass_tutor");
		$this->setTableTitle("onlineclass_tutor");
		$this->setTitleFieldName("family");

		/******** name ********/
		$NameInfo=new FieldInfo();
		$NameInfo->setTitle("name");
		$this->setFieldInfo(onlineclass_tutorEntity::$NAME,$NameInfo);
		$this->addTableField('1',onlineclass_tutorEntity::$NAME);

		/******** family ********/
		$FamilyInfo=new FieldInfo();
		$FamilyInfo->setTitle("family");
		$this->setFieldInfo(onlineclass_tutorEntity::$FAMILY,$FamilyInfo);
		$this->addTableField('2',onlineclass_tutorEntity::$FAMILY);
	}
	public static $NAME="name";
	/**
	 * @return mixed
	 */
	public function getName(){
		return $this->getField(onlineclass_tutorEntity::$NAME);
	}
	/**
	 * @param mixed $Name
	 */
	public function setName($Name){
		$this->setField(onlineclass_tutorEntity::$NAME,$Name);
	}
	public static $FAMILY="family";
	/**
	 * @return mixed
	 */
	public function getFamily(){
		return $this->getField(onlineclass_tutorEntity::$FAMILY);
	}
	/**
	 * @param mixed $Family
	 */
	public function setFamily($Family){
		$this->setField(onlineclass_tutorEntity::$FAMILY,$Family);
	}
}
?>