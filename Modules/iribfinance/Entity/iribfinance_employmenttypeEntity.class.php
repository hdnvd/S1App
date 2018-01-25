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
class iribfinance_employmenttypeEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("iribfinance_employmenttype");
		$this->setTableTitle("نوع استخدام");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("عنوان");
		$this->setFieldInfo(iribfinance_employmenttypeEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',iribfinance_employmenttypeEntity::$TITLE);

		/******** taxfactor ********/
		$TaxfactorInfo=new FieldInfo();
		$TaxfactorInfo->setTitle("ضریب مالیات");
		$this->setFieldInfo(iribfinance_employmenttypeEntity::$TAXFACTOR,$TaxfactorInfo);
		$this->addTableField('2',iribfinance_employmenttypeEntity::$TAXFACTOR);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(iribfinance_employmenttypeEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(iribfinance_employmenttypeEntity::$TITLE,$Title);
	}
	public static $TAXFACTOR="taxfactor";
	/**
	 * @return mixed
	 */
	public function getTaxfactor(){
		return $this->getField(iribfinance_employmenttypeEntity::$TAXFACTOR);
	}
	/**
	 * @param mixed $Taxfactor
	 */
	public function setTaxfactor($Taxfactor){
		$this->setField(iribfinance_employmenttypeEntity::$TAXFACTOR,$Taxfactor);
	}
}
?>