<?php
namespace Modules\eshop\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-08-26 - 2017-11-17 18:15
*@lastUpdate 1396-08-26 - 2017-11-17 18:15
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class eshop_colorEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("eshop_color");
		$this->setTableTitle("eshop_color");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("title");
		$this->setFieldInfo(eshop_colorEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',eshop_colorEntity::$TITLE);

		/******** latintitle ********/
		$LatintitleInfo=new FieldInfo();
		$LatintitleInfo->setTitle("latintitle");
		$this->setFieldInfo(eshop_colorEntity::$LATINTITLE,$LatintitleInfo);
		$this->addTableField('2',eshop_colorEntity::$LATINTITLE);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(eshop_colorEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(eshop_colorEntity::$TITLE,$Title);
	}
	public static $LATINTITLE="latintitle";
	/**
	 * @return mixed
	 */
	public function getLatintitle(){
		return $this->getField(eshop_colorEntity::$LATINTITLE);
	}
	/**
	 * @param mixed $Latintitle
	 */
	public function setLatintitle($Latintitle){
		$this->setField(eshop_colorEntity::$LATINTITLE,$Latintitle);
	}
}
?>