<?php
namespace Modules\iribfinance\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:15
*@lastUpdate 1396-11-05 - 2018-01-25 18:15
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class iribfinance_workunitEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("iribfinance_workunit");
		$this->setTableTitle("واحد انجام کار");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("عنوان");
		$this->setFieldInfo(iribfinance_workunitEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',iribfinance_workunitEntity::$TITLE);

		/******** minutes ********/
		$MinutesInfo=new FieldInfo();
		$MinutesInfo->setTitle("دقایق");
		$this->setFieldInfo(iribfinance_workunitEntity::$MINUTES,$MinutesInfo);
		$this->addTableField('2',iribfinance_workunitEntity::$MINUTES);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(iribfinance_workunitEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(iribfinance_workunitEntity::$TITLE,$Title);
	}
	public static $MINUTES="minutes";
	/**
	 * @return mixed
	 */
	public function getMinutes(){
		return $this->getField(iribfinance_workunitEntity::$MINUTES);
	}
	/**
	 * @param mixed $Minutes
	 */
	public function setMinutes($Minutes){
		$this->setField(iribfinance_workunitEntity::$MINUTES,$Minutes);
	}
}
?>