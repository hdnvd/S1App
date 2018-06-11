<?php
namespace Modules\itsap\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-16 - 2018-04-05 00:53
*@lastUpdate 1397-01-16 - 2018-04-05 00:53
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class itsap_servicerequestdeviceEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("itsap_servicerequestdevice");
		$this->setTableTitle("itsap_servicerequestdevice");
		$this->setTitleFieldName("id");

		/******** code ********/
		$CodeInfo=new FieldInfo();
		$CodeInfo->setTitle("code");
		$this->setFieldInfo(itsap_servicerequestdeviceEntity::$CODE,$CodeInfo);
		$this->addTableField('1',itsap_servicerequestdeviceEntity::$CODE);

		/******** devicetype_fid ********/
		$Devicetype_fidInfo=new FieldInfo();
		$Devicetype_fidInfo->setTitle("devicetype_fid");
		$this->setFieldInfo(itsap_servicerequestdeviceEntity::$DEVICETYPE_FID,$Devicetype_fidInfo);
		$this->addTableField('2',itsap_servicerequestdeviceEntity::$DEVICETYPE_FID);

		/******** servicerequest_fid ********/
		$Servicerequest_fidInfo=new FieldInfo();
		$Servicerequest_fidInfo->setTitle("servicerequest_fid");
		$this->setFieldInfo(itsap_servicerequestdeviceEntity::$SERVICEREQUEST_FID,$Servicerequest_fidInfo);
		$this->addTableField('3',itsap_servicerequestdeviceEntity::$SERVICEREQUEST_FID);

		/******** description ********/
		$DescriptionInfo=new FieldInfo();
		$DescriptionInfo->setTitle("description");
		$this->setFieldInfo(itsap_servicerequestdeviceEntity::$DESCRIPTION,$DescriptionInfo);
		$this->addTableField('4',itsap_servicerequestdeviceEntity::$DESCRIPTION);
	}
	public static $CODE="code";
	/**
	 * @return mixed
	 */
	public function getCode(){
		return $this->getField(itsap_servicerequestdeviceEntity::$CODE);
	}
	/**
	 * @param mixed $Code
	 */
	public function setCode($Code){
		$this->setField(itsap_servicerequestdeviceEntity::$CODE,$Code);
	}
	public static $DEVICETYPE_FID="devicetype_fid";
	/**
	 * @return mixed
	 */
	public function getDevicetype_fid(){
		return $this->getField(itsap_servicerequestdeviceEntity::$DEVICETYPE_FID);
	}
	/**
	 * @param mixed $Devicetype_fid
	 */
	public function setDevicetype_fid($Devicetype_fid){
		$this->setField(itsap_servicerequestdeviceEntity::$DEVICETYPE_FID,$Devicetype_fid);
	}
	public static $SERVICEREQUEST_FID="servicerequest_fid";
	/**
	 * @return mixed
	 */
	public function getServicerequest_fid(){
		return $this->getField(itsap_servicerequestdeviceEntity::$SERVICEREQUEST_FID);
	}
	/**
	 * @param mixed $Servicerequest_fid
	 */
	public function setServicerequest_fid($Servicerequest_fid){
		$this->setField(itsap_servicerequestdeviceEntity::$SERVICEREQUEST_FID,$Servicerequest_fid);
	}
	public static $DESCRIPTION="description";
	/**
	 * @return mixed
	 */
	public function getDescription(){
		return $this->getField(itsap_servicerequestdeviceEntity::$DESCRIPTION);
	}
	/**
	 * @param mixed $Description
	 */
	public function setDescription($Description){
		$this->setField(itsap_servicerequestdeviceEntity::$DESCRIPTION,$Description);
	}
}
?>