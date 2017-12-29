<?php
namespace Modules\itsap\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-01 - 2017-12-22 18:12
*@lastUpdate 1396-10-01 - 2017-12-22 18:12
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class itsap_servicerequestEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("itsap_servicerequest");
		$this->setTableTitle("itsap_servicerequest");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("title");
		$this->setFieldInfo(itsap_servicerequestEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',itsap_servicerequestEntity::$TITLE);

		/******** role_systemuser_fid ********/
		$Role_systemuser_fidInfo=new FieldInfo();
		$Role_systemuser_fidInfo->setTitle("role_systemuser_fid");
		$this->setFieldInfo(itsap_servicerequestEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fidInfo);
		$this->addTableField('2',itsap_servicerequestEntity::$ROLE_SYSTEMUSER_FID);

		/******** unit_fid ********/
		$Unit_fidInfo=new FieldInfo();
		$Unit_fidInfo->setTitle("unit_fid");
		$this->setFieldInfo(itsap_servicerequestEntity::$UNIT_FID,$Unit_fidInfo);
		$this->addTableField('3',itsap_servicerequestEntity::$UNIT_FID);

		/******** servicetype_fid ********/
		$Servicetype_fidInfo=new FieldInfo();
		$Servicetype_fidInfo->setTitle("servicetype_fid");
		$this->setFieldInfo(itsap_servicerequestEntity::$SERVICETYPE_FID,$Servicetype_fidInfo);
		$this->addTableField('4',itsap_servicerequestEntity::$SERVICETYPE_FID);

		/******** description ********/
		$DescriptionInfo=new FieldInfo();
		$DescriptionInfo->setTitle("description");
		$this->setFieldInfo(itsap_servicerequestEntity::$DESCRIPTION,$DescriptionInfo);
		$this->addTableField('5',itsap_servicerequestEntity::$DESCRIPTION);

		/******** priority ********/
		$PriorityInfo=new FieldInfo();
		$PriorityInfo->setTitle("priority");
		$this->setFieldInfo(itsap_servicerequestEntity::$PRIORITY,$PriorityInfo);
		$this->addTableField('6',itsap_servicerequestEntity::$PRIORITY);

		/******** file1_flu ********/
		$File1_fluInfo=new FieldInfo();
		$File1_fluInfo->setTitle("file1_flu");
		$this->setFieldInfo(itsap_servicerequestEntity::$FILE1_FLU,$File1_fluInfo);
		$this->addTableField('7',itsap_servicerequestEntity::$FILE1_FLU);

		/******** request_date ********/
		$Request_dateInfo=new FieldInfo();
		$Request_dateInfo->setTitle("request_date");
		$this->setFieldInfo(itsap_servicerequestEntity::$REQUEST_DATE,$Request_dateInfo);
		$this->addTableField('8',itsap_servicerequestEntity::$REQUEST_DATE);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(itsap_servicerequestEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(itsap_servicerequestEntity::$TITLE,$Title);
	}
	public static $ROLE_SYSTEMUSER_FID="role_systemuser_fid";
	/**
	 * @return mixed
	 */
	public function getRole_systemuser_fid(){
		return $this->getField(itsap_servicerequestEntity::$ROLE_SYSTEMUSER_FID);
	}
	/**
	 * @param mixed $Role_systemuser_fid
	 */
	public function setRole_systemuser_fid($Role_systemuser_fid){
		$this->setField(itsap_servicerequestEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fid);
	}
	public static $UNIT_FID="unit_fid";
	/**
	 * @return mixed
	 */
	public function getUnit_fid(){
		return $this->getField(itsap_servicerequestEntity::$UNIT_FID);
	}
	/**
	 * @param mixed $Unit_fid
	 */
	public function setUnit_fid($Unit_fid){
		$this->setField(itsap_servicerequestEntity::$UNIT_FID,$Unit_fid);
	}
	public static $SERVICETYPE_FID="servicetype_fid";
	/**
	 * @return mixed
	 */
	public function getServicetype_fid(){
		return $this->getField(itsap_servicerequestEntity::$SERVICETYPE_FID);
	}
	/**
	 * @param mixed $Servicetype_fid
	 */
	public function setServicetype_fid($Servicetype_fid){
		$this->setField(itsap_servicerequestEntity::$SERVICETYPE_FID,$Servicetype_fid);
	}
	public static $DESCRIPTION="description";
	/**
	 * @return mixed
	 */
	public function getDescription(){
		return $this->getField(itsap_servicerequestEntity::$DESCRIPTION);
	}
	/**
	 * @param mixed $Description
	 */
	public function setDescription($Description){
		$this->setField(itsap_servicerequestEntity::$DESCRIPTION,$Description);
	}
	public static $PRIORITY="priority";
	/**
	 * @return mixed
	 */
	public function getPriority(){
		return $this->getField(itsap_servicerequestEntity::$PRIORITY);
	}
	/**
	 * @param mixed $Priority
	 */
	public function setPriority($Priority){
		$this->setField(itsap_servicerequestEntity::$PRIORITY,$Priority);
	}
	public static $FILE1_FLU="file1_flu";
	/**
	 * @return mixed
	 */
	public function getFile1_flu(){
		return $this->getField(itsap_servicerequestEntity::$FILE1_FLU);
	}
	/**
	 * @param mixed $File1_flu
	 */
	public function setFile1_flu($File1_flu){
		$this->setField(itsap_servicerequestEntity::$FILE1_FLU,$File1_flu);
	}
	public static $REQUEST_DATE="request_date";
	/**
	 * @return mixed
	 */
	public function getRequest_date(){
		return $this->getField(itsap_servicerequestEntity::$REQUEST_DATE);
	}
	/**
	 * @param mixed $Request_date
	 */
	public function setRequest_date($Request_date){
		$this->setField(itsap_servicerequestEntity::$REQUEST_DATE,$Request_date);
	}
}
?>