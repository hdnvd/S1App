<?php
namespace Modules\itsap\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-02 - 2017-12-23 00:54
*@lastUpdate 1396-10-02 - 2017-12-23 00:54
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class itsap_viewservicerequesthandlerEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("itsap_viewservicerequesthandler");
		$this->setTableTitle("درخواست خدمت");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("title");
		$this->setFieldInfo(itsap_viewservicerequesthandlerEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',itsap_viewservicerequesthandlerEntity::$TITLE);

		/******** role_systemuser_fid ********/
		$Role_systemuser_fidInfo=new FieldInfo();
		$Role_systemuser_fidInfo->setTitle("role_systemuser_fid");
		$this->setFieldInfo(itsap_viewservicerequesthandlerEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fidInfo);
		$this->addTableField('2',itsap_viewservicerequesthandlerEntity::$ROLE_SYSTEMUSER_FID);

		/******** unit_fid ********/
		$Unit_fidInfo=new FieldInfo();
		$Unit_fidInfo->setTitle("unit_fid");
		$this->setFieldInfo(itsap_viewservicerequesthandlerEntity::$UNIT_FID,$Unit_fidInfo);
		$this->addTableField('3',itsap_viewservicerequesthandlerEntity::$UNIT_FID);

		/******** servicetype_fid ********/
		$Servicetype_fidInfo=new FieldInfo();
		$Servicetype_fidInfo->setTitle("servicetype_fid");
		$this->setFieldInfo(itsap_viewservicerequesthandlerEntity::$SERVICETYPE_FID,$Servicetype_fidInfo);
		$this->addTableField('4',itsap_viewservicerequesthandlerEntity::$SERVICETYPE_FID);

		/******** description ********/
		$DescriptionInfo=new FieldInfo();
		$DescriptionInfo->setTitle("description");
		$this->setFieldInfo(itsap_viewservicerequesthandlerEntity::$DESCRIPTION,$DescriptionInfo);
		$this->addTableField('5',itsap_viewservicerequesthandlerEntity::$DESCRIPTION);

		/******** priority ********/
		$PriorityInfo=new FieldInfo();
		$PriorityInfo->setTitle("priority");
		$this->setFieldInfo(itsap_viewservicerequesthandlerEntity::$PRIORITY,$PriorityInfo);
		$this->addTableField('6',itsap_viewservicerequesthandlerEntity::$PRIORITY);

		/******** file1_flu ********/
		$File1_fluInfo=new FieldInfo();
		$File1_fluInfo->setTitle("file1_flu");
		$this->setFieldInfo(itsap_viewservicerequesthandlerEntity::$FILE1_FLU,$File1_fluInfo);
		$this->addTableField('7',itsap_viewservicerequesthandlerEntity::$FILE1_FLU);

		/******** request_date ********/
		$Request_dateInfo=new FieldInfo();
		$Request_dateInfo->setTitle("request_date");
		$this->setFieldInfo(itsap_viewservicerequesthandlerEntity::$REQUEST_DATE,$Request_dateInfo);
		$this->addTableField('8',itsap_viewservicerequesthandlerEntity::$REQUEST_DATE);

		/******** tuid ********/
		$TuidInfo=new FieldInfo();
		$TuidInfo->setTitle("tuid");
		$this->setFieldInfo(itsap_viewservicerequesthandlerEntity::$TUID,$TuidInfo);
		$this->addTableField('9',itsap_viewservicerequesthandlerEntity::$TUID);

		/******** handleruid ********/
		$HandleruidInfo=new FieldInfo();
		$HandleruidInfo->setTitle("handleruid");
		$this->setFieldInfo(itsap_viewservicerequesthandlerEntity::$HANDLERUID,$HandleruidInfo);
		$this->addTableField('10',itsap_viewservicerequesthandlerEntity::$HANDLERUID);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(itsap_viewservicerequesthandlerEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(itsap_viewservicerequesthandlerEntity::$TITLE,$Title);
	}
	public static $ROLE_SYSTEMUSER_FID="role_systemuser_fid";
	/**
	 * @return mixed
	 */
	public function getRole_systemuser_fid(){
		return $this->getField(itsap_viewservicerequesthandlerEntity::$ROLE_SYSTEMUSER_FID);
	}
	/**
	 * @param mixed $Role_systemuser_fid
	 */
	public function setRole_systemuser_fid($Role_systemuser_fid){
		$this->setField(itsap_viewservicerequesthandlerEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fid);
	}
	public static $UNIT_FID="unit_fid";
	/**
	 * @return mixed
	 */
	public function getUnit_fid(){
		return $this->getField(itsap_viewservicerequesthandlerEntity::$UNIT_FID);
	}
	/**
	 * @param mixed $Unit_fid
	 */
	public function setUnit_fid($Unit_fid){
		$this->setField(itsap_viewservicerequesthandlerEntity::$UNIT_FID,$Unit_fid);
	}
	public static $SERVICETYPE_FID="servicetype_fid";
	/**
	 * @return mixed
	 */
	public function getServicetype_fid(){
		return $this->getField(itsap_viewservicerequesthandlerEntity::$SERVICETYPE_FID);
	}
	/**
	 * @param mixed $Servicetype_fid
	 */
	public function setServicetype_fid($Servicetype_fid){
		$this->setField(itsap_viewservicerequesthandlerEntity::$SERVICETYPE_FID,$Servicetype_fid);
	}
	public static $DESCRIPTION="description";
	/**
	 * @return mixed
	 */
	public function getDescription(){
		return $this->getField(itsap_viewservicerequesthandlerEntity::$DESCRIPTION);
	}
	/**
	 * @param mixed $Description
	 */
	public function setDescription($Description){
		$this->setField(itsap_viewservicerequesthandlerEntity::$DESCRIPTION,$Description);
	}
	public static $PRIORITY="priority";
	/**
	 * @return mixed
	 */
	public function getPriority(){
		return $this->getField(itsap_viewservicerequesthandlerEntity::$PRIORITY);
	}
	/**
	 * @param mixed $Priority
	 */
	public function setPriority($Priority){
		$this->setField(itsap_viewservicerequesthandlerEntity::$PRIORITY,$Priority);
	}
	public static $FILE1_FLU="file1_flu";
	/**
	 * @return mixed
	 */
	public function getFile1_flu(){
		return $this->getField(itsap_viewservicerequesthandlerEntity::$FILE1_FLU);
	}
	/**
	 * @param mixed $File1_flu
	 */
	public function setFile1_flu($File1_flu){
		$this->setField(itsap_viewservicerequesthandlerEntity::$FILE1_FLU,$File1_flu);
	}
	public static $REQUEST_DATE="request_date";
	/**
	 * @return mixed
	 */
	public function getRequest_date(){
		return $this->getField(itsap_viewservicerequesthandlerEntity::$REQUEST_DATE);
	}
	/**
	 * @param mixed $Request_date
	 */
	public function setRequest_date($Request_date){
		$this->setField(itsap_viewservicerequesthandlerEntity::$REQUEST_DATE,$Request_date);
	}
	public static $TUID="tuid";
	/**
	 * @return mixed
	 */
	public function getTuid(){
		return $this->getField(itsap_viewservicerequesthandlerEntity::$TUID);
	}
	/**
	 * @param mixed $Tuid
	 */
	public function setTuid($Tuid){
		$this->setField(itsap_viewservicerequesthandlerEntity::$TUID,$Tuid);
	}
	public static $HANDLERUID="handleruid";
	/**
	 * @return mixed
	 */
	public function getHandleruid(){
		return $this->getField(itsap_viewservicerequesthandlerEntity::$HANDLERUID);
	}
	/**
	 * @param mixed $Handleruid
	 */
	public function setHandleruid($Handleruid){
		$this->setField(itsap_viewservicerequesthandlerEntity::$HANDLERUID,$Handleruid);
	}
}
?>