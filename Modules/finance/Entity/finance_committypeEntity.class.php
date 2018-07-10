<?php
namespace Modules\finance\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-07 - 2017-11-28 18:02
*@lastUpdate 1396-09-07 - 2017-11-28 18:02
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class finance_committypeEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("finance_committype");
		$this->setTableTitle("finance_committype");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("title");
		$this->setFieldInfo(finance_committypeEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',finance_committypeEntity::$TITLE);

		/******** issuccessful ********/
		$IssuccessfulInfo=new FieldInfo();
		$IssuccessfulInfo->setTitle("issuccessful");
		$this->setFieldInfo(finance_committypeEntity::$ISSUCCESSFUL,$IssuccessfulInfo);
		$this->addTableField('2',finance_committypeEntity::$ISSUCCESSFUL);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(finance_committypeEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(finance_committypeEntity::$TITLE,$Title);
	}
	public static $ISSUCCESSFUL="issuccessful";
	/**
	 * @return mixed
	 */
	public function getIssuccessful(){
		return $this->getField(finance_committypeEntity::$ISSUCCESSFUL);
	}
	/**
	 * @param mixed $Issuccessful
	 */
	public function setIssuccessful($Issuccessful){
		$this->setField(finance_committypeEntity::$ISSUCCESSFUL,$Issuccessful);
	}
}
?>