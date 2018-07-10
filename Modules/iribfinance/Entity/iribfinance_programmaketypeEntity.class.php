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
class iribfinance_programmaketypeEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("iribfinance_programmaketype");
		$this->setTableTitle("نوع ساخت برنامه");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("عنوان");
		$this->setFieldInfo(iribfinance_programmaketypeEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',iribfinance_programmaketypeEntity::$TITLE);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(iribfinance_programmaketypeEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(iribfinance_programmaketypeEntity::$TITLE,$Title);
	}
}
?>