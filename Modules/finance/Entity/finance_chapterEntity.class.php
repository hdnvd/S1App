<?php
namespace Modules\finance\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-09 - 2018-01-29 11:29
*@lastUpdate 1396-11-09 - 2018-01-29 11:29
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class finance_chapterEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("finance_chapter");
		$this->setTableTitle("finance_chapter");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("عنوان");
		$this->setFieldInfo(finance_chapterEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',finance_chapterEntity::$TITLE);

		/******** latintitle ********/
		$LatintitleInfo=new FieldInfo();
		$LatintitleInfo->setTitle("latintitle");
		$this->setFieldInfo(finance_chapterEntity::$LATINTITLE,$LatintitleInfo);
		$this->addTableField('2',finance_chapterEntity::$LATINTITLE);
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