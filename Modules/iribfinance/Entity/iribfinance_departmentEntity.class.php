<?php
namespace Modules\iribfinance\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:22
*@lastUpdate 1396-11-05 - 2018-01-25 18:22
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class iribfinance_departmentEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("iribfinance_department");
		$this->setTableTitle("بخش");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("عنوان");
		$this->setFieldInfo(iribfinance_departmentEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',iribfinance_departmentEntity::$TITLE);

		/******** region_fid ********/
		$Region_fidInfo=new FieldInfo();
		$Region_fidInfo->setTitle("حوزه");
		$this->setFieldInfo(iribfinance_departmentEntity::$REGION_FID,$Region_fidInfo);
		$this->addTableField('2',iribfinance_departmentEntity::$REGION_FID);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(iribfinance_departmentEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(iribfinance_departmentEntity::$TITLE,$Title);
	}
	public static $REGION_FID="region_fid";
	/**
	 * @return mixed
	 */
	public function getRegion_fid(){
		return $this->getField(iribfinance_departmentEntity::$REGION_FID);
	}
	/**
	 * @param mixed $Region_fid
	 */
	public function setRegion_fid($Region_fid){
		$this->setField(iribfinance_departmentEntity::$REGION_FID,$Region_fid);
	}
}
?>