<?php
namespace Modules\itsap\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-08 - 2017-11-29 16:59
*@lastUpdate 1396-09-08 - 2017-11-29 16:59
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class itsap_topunitEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("itsap_topunit");
		$this->setTableTitle("یگان");
		$this->setTitleFieldName("title");

		/******** topunit_fid ********/
		$Topunit_fidInfo=new FieldInfo();
		$Topunit_fidInfo->setTitle("یگان مادر");
		$this->setFieldInfo(itsap_topunitEntity::$TOPUNIT_FID,$Topunit_fidInfo);
		$this->addTableField('1',itsap_topunitEntity::$TOPUNIT_FID);

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("عنوان");
		$this->setFieldInfo(itsap_topunitEntity::$TITLE,$TitleInfo);
		$this->addTableField('2',itsap_topunitEntity::$TITLE);
	}
	public static $TOPUNIT_FID="topunit_fid";
	/**
	 * @return mixed
	 */
	public function getTopunit_fid(){
		return $this->getField(itsap_topunitEntity::$TOPUNIT_FID);
	}
	/**
	 * @param mixed $Topunit_fid
	 */
	public function setTopunit_fid($Topunit_fid){
		$this->setField(itsap_topunitEntity::$TOPUNIT_FID,$Topunit_fid);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(itsap_topunitEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(itsap_topunitEntity::$TITLE,$Title);
	}
}
?>