<?php
namespace Modules\itsap\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-21 - 2018-01-11 19:00
*@lastUpdate 1396-10-21 - 2018-01-11 19:00
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class itsap_unitEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("itsap_unit");
		$this->setTableTitle("بخش");
		$this->setTitleFieldName("title");

		/******** topunit_fid ********/
		$Topunit_fidInfo=new FieldInfo();
		$Topunit_fidInfo->setTitle("یگان مادر");
		$this->setFieldInfo(itsap_unitEntity::$TOPUNIT_FID,$Topunit_fidInfo);
		$this->addTableField('1',itsap_unitEntity::$TOPUNIT_FID);

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("عنوان");
		$this->setFieldInfo(itsap_unitEntity::$TITLE,$TitleInfo);
		$this->addTableField('2',itsap_unitEntity::$TITLE);

		/******** isfava ********/
		$IsfavaInfo=new FieldInfo();
		$IsfavaInfo->setTitle("یگان فاوا");
		$this->setFieldInfo(itsap_unitEntity::$ISFAVA,$IsfavaInfo);
		$this->addTableField('3',itsap_unitEntity::$ISFAVA);

		/******** admin_employee_fid ********/
		$Admin_employee_fidInfo=new FieldInfo();
		$Admin_employee_fidInfo->setTitle("مدیر بخش");
		$this->setFieldInfo(itsap_unitEntity::$ADMIN_EMPLOYEE_FID,$Admin_employee_fidInfo);
		$this->addTableField('4',itsap_unitEntity::$ADMIN_EMPLOYEE_FID);
	}
	public static $TOPUNIT_FID="topunit_fid";
	/**
	 * @return mixed
	 */
	public function getTopunit_fid(){
		return $this->getField(itsap_unitEntity::$TOPUNIT_FID);
	}
	/**
	 * @param mixed $Topunit_fid
	 */
	public function setTopunit_fid($Topunit_fid){
		$this->setField(itsap_unitEntity::$TOPUNIT_FID,$Topunit_fid);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(itsap_unitEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(itsap_unitEntity::$TITLE,$Title);
	}
	public static $ISFAVA="isfava";
	/**
	 * @return mixed
	 */
	public function getIsfava(){
		return $this->getField(itsap_unitEntity::$ISFAVA);
	}
	/**
	 * @param mixed $Isfava
	 */
	public function setIsfava($Isfava){
		$this->setField(itsap_unitEntity::$ISFAVA,$Isfava);
	}
	public static $ADMIN_EMPLOYEE_FID="admin_employee_fid";
	/**
	 * @return mixed
	 */
	public function getAdmin_employee_fid(){
		return $this->getField(itsap_unitEntity::$ADMIN_EMPLOYEE_FID);
	}
	/**
	 * @param mixed $Admin_employee_fid
	 */
	public function setAdmin_employee_fid($Admin_employee_fid){
		$this->setField(itsap_unitEntity::$ADMIN_EMPLOYEE_FID,$Admin_employee_fid);
	}
}
?>