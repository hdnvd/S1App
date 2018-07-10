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
class iribfinance_paycenterEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("iribfinance_paycenter");
		$this->setTableTitle("مرکز هزینه");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("عنوان");
		$this->setFieldInfo(iribfinance_paycenterEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',iribfinance_paycenterEntity::$TITLE);

		/******** chapter ********/
		$ChapterInfo=new FieldInfo();
		$ChapterInfo->setTitle("سرفصل");
		$this->setFieldInfo(iribfinance_paycenterEntity::$CHAPTER,$ChapterInfo);
		$this->addTableField('2',iribfinance_paycenterEntity::$CHAPTER);

		/******** accountingcode ********/
		$AccountingcodeInfo=new FieldInfo();
		$AccountingcodeInfo->setTitle("کد حسابداری");
		$this->setFieldInfo(iribfinance_paycenterEntity::$ACCOUNTINGCODE,$AccountingcodeInfo);
		$this->addTableField('3',iribfinance_paycenterEntity::$ACCOUNTINGCODE);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(iribfinance_paycenterEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(iribfinance_paycenterEntity::$TITLE,$Title);
	}
	public static $CHAPTER="chapter";
	/**
	 * @return mixed
	 */
	public function getChapter(){
		return $this->getField(iribfinance_paycenterEntity::$CHAPTER);
	}
	/**
	 * @param mixed $Chapter
	 */
	public function setChapter($Chapter){
		$this->setField(iribfinance_paycenterEntity::$CHAPTER,$Chapter);
	}
	public static $ACCOUNTINGCODE="accountingcode";
	/**
	 * @return mixed
	 */
	public function getAccountingcode(){
		return $this->getField(iribfinance_paycenterEntity::$ACCOUNTINGCODE);
	}
	/**
	 * @param mixed $Accountingcode
	 */
	public function setAccountingcode($Accountingcode){
		$this->setField(iribfinance_paycenterEntity::$ACCOUNTINGCODE,$Accountingcode);
	}
}
?>