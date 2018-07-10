<?php
namespace Modules\itsap\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-02-26 - 2018-05-16 00:55
*@lastUpdate 1397-02-26 - 2018-05-16 00:55
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

		/******** security_systemuser_fid ********/
		$Security_systemuser_fidInfo=new FieldInfo();
		$Security_systemuser_fidInfo->setTitle("کاربر امنیتی");
		$this->setFieldInfo(itsap_topunitEntity::$SECURITY_SYSTEMUSER_FID,$Security_systemuser_fidInfo);
		$this->addTableField('3',itsap_topunitEntity::$SECURITY_SYSTEMUSER_FID);
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
	public static $SECURITY_SYSTEMUSER_FID="security_systemuser_fid";
	/**
	 * @return mixed
	 */
	public function getSecurity_systemuser_fid(){
		return $this->getField(itsap_topunitEntity::$SECURITY_SYSTEMUSER_FID);
	}
	/**
	 * @param mixed $Security_systemuser_fid
	 */
	public function setSecurity_systemuser_fid($Security_systemuser_fid){
		$this->setField(itsap_topunitEntity::$SECURITY_SYSTEMUSER_FID,$Security_systemuser_fid);
	}
}
?>