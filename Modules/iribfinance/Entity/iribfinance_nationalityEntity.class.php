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
class iribfinance_nationalityEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("iribfinance_nationality");
		$this->setTableTitle("ملیت");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("عنوان");
		$this->setFieldInfo(iribfinance_nationalityEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',iribfinance_nationalityEntity::$TITLE);

		/******** flag_flu ********/
		$Flag_fluInfo=new FieldInfo();
		$Flag_fluInfo->setTitle("flag_flu");
		$this->setFieldInfo(iribfinance_nationalityEntity::$FLAG_FLU,$Flag_fluInfo);
		$this->addTableField('2',iribfinance_nationalityEntity::$FLAG_FLU);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(iribfinance_nationalityEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(iribfinance_nationalityEntity::$TITLE,$Title);
	}
	public static $FLAG_FLU="flag_flu";
	/**
	 * @return mixed
	 */
	public function getFlag_flu(){
		return $this->getField(iribfinance_nationalityEntity::$FLAG_FLU);
	}
	/**
	 * @param mixed $Flag_flu
	 */
	public function setFlag_flu($Flag_flu){
		$this->setField(iribfinance_nationalityEntity::$FLAG_FLU,$Flag_flu);
	}
}
?>