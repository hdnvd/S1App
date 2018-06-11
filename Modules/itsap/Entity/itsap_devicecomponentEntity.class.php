<?php
namespace Modules\itsap\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-13 - 2018-04-02 02:08
*@lastUpdate 1397-01-13 - 2018-04-02 02:08
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class itsap_devicecomponentEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("itsap_devicecomponent");
		$this->setTableTitle("itsap_devicecomponent");
		$this->setTitleFieldName("title");

		/******** devicetype_fid ********/
		$Devicetype_fidInfo=new FieldInfo();
		$Devicetype_fidInfo->setTitle("devicetype_fid");
		$this->setFieldInfo(itsap_devicecomponentEntity::$DEVICETYPE_FID,$Devicetype_fidInfo);
		$this->addTableField('1',itsap_devicecomponentEntity::$DEVICETYPE_FID);

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("عنوان");
		$this->setFieldInfo(itsap_devicecomponentEntity::$TITLE,$TitleInfo);
		$this->addTableField('2',itsap_devicecomponentEntity::$TITLE);
	}
	public static $DEVICETYPE_FID="devicetype_fid";
	/**
	 * @return mixed
	 */
	public function getDevicetype_fid(){
		return $this->getField(itsap_devicecomponentEntity::$DEVICETYPE_FID);
	}
	/**
	 * @param mixed $Devicetype_fid
	 */
	public function setDevicetype_fid($Devicetype_fid){
		$this->setField(itsap_devicecomponentEntity::$DEVICETYPE_FID,$Devicetype_fid);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(itsap_devicecomponentEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(itsap_devicecomponentEntity::$TITLE,$Title);
	}
}
?>