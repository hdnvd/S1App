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
class itsap_servicerequestservicestatusEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("itsap_servicerequestservicestatus");
		$this->setTableTitle("itsap_servicerequestservicestatus");
		$this->setTitleFieldName("id");

		/******** servicestatus_fid ********/
		$Servicestatus_fidInfo=new FieldInfo();
		$Servicestatus_fidInfo->setTitle("servicestatus_fid");
		$this->setFieldInfo(itsap_servicerequestservicestatusEntity::$SERVICESTATUS_FID,$Servicestatus_fidInfo);
		$this->addTableField('1',itsap_servicerequestservicestatusEntity::$SERVICESTATUS_FID);

		/******** servicerequest_fid ********/
		$Servicerequest_fidInfo=new FieldInfo();
		$Servicerequest_fidInfo->setTitle("servicerequest_fid");
		$this->setFieldInfo(itsap_servicerequestservicestatusEntity::$SERVICEREQUEST_FID,$Servicerequest_fidInfo);
		$this->addTableField('2',itsap_servicerequestservicestatusEntity::$SERVICEREQUEST_FID);

		/******** start_date ********/
		$Start_dateInfo=new FieldInfo();
		$Start_dateInfo->setTitle("start_date");
		$this->setFieldInfo(itsap_servicerequestservicestatusEntity::$START_DATE,$Start_dateInfo);
		$this->addTableField('3',itsap_servicerequestservicestatusEntity::$START_DATE);

		/******** role_systemuser_fid ********/
		$Role_systemuser_fidInfo=new FieldInfo();
		$Role_systemuser_fidInfo->setTitle("role_systemuser_fid");
		$this->setFieldInfo(itsap_servicerequestservicestatusEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fidInfo);
		$this->addTableField('4',itsap_servicerequestservicestatusEntity::$ROLE_SYSTEMUSER_FID);
	}
	public static $SERVICESTATUS_FID="servicestatus_fid";
	/**
	 * @return mixed
	 */
	public function getServicestatus_fid(){
		return $this->getField(itsap_servicerequestservicestatusEntity::$SERVICESTATUS_FID);
	}
	/**
	 * @param mixed $Servicestatus_fid
	 */
	public function setServicestatus_fid($Servicestatus_fid){
		$this->setField(itsap_servicerequestservicestatusEntity::$SERVICESTATUS_FID,$Servicestatus_fid);
	}
	public static $SERVICEREQUEST_FID="servicerequest_fid";
	/**
	 * @return mixed
	 */
	public function getServicerequest_fid(){
		return $this->getField(itsap_servicerequestservicestatusEntity::$SERVICEREQUEST_FID);
	}
	/**
	 * @param mixed $Servicerequest_fid
	 */
	public function setServicerequest_fid($Servicerequest_fid){
		$this->setField(itsap_servicerequestservicestatusEntity::$SERVICEREQUEST_FID,$Servicerequest_fid);
	}
	public static $START_DATE="start_date";
	/**
	 * @return mixed
	 */
	public function getStart_date(){
		return $this->getField(itsap_servicerequestservicestatusEntity::$START_DATE);
	}
	/**
	 * @param mixed $Start_date
	 */
	public function setStart_date($Start_date){
		$this->setField(itsap_servicerequestservicestatusEntity::$START_DATE,$Start_date);
	}
	public static $ROLE_SYSTEMUSER_FID="role_systemuser_fid";
	/**
	 * @return mixed
	 */
	public function getRole_systemuser_fid(){
		return $this->getField(itsap_servicerequestservicestatusEntity::$ROLE_SYSTEMUSER_FID);
	}
	/**
	 * @param mixed $Role_systemuser_fid
	 */
	public function setRole_systemuser_fid($Role_systemuser_fid){
		$this->setField(itsap_servicerequestservicestatusEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fid);
	}
}
?>