<?php
namespace Modules\itsap\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-13 - 2018-04-02 02:02
*@lastUpdate 1397-01-13 - 2018-04-02 02:02
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class itsap_servicetypeEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("itsap_servicetype");
		$this->setTableTitle("نوع درخواست");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("عنوان");
		$this->setFieldInfo(itsap_servicetypeEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',itsap_servicetypeEntity::$TITLE);

		/******** priority ********/
		$PriorityInfo=new FieldInfo();
		$PriorityInfo->setTitle("اولویت");
		$this->setFieldInfo(itsap_servicetypeEntity::$PRIORITY,$PriorityInfo);
		$this->addTableField('2',itsap_servicetypeEntity::$PRIORITY);

		/******** servicetypegroup_fid ********/
		$Servicetypegroup_fidInfo=new FieldInfo();
		$Servicetypegroup_fidInfo->setTitle("گروه بندی");
		$this->setFieldInfo(itsap_servicetypeEntity::$SERVICETYPEGROUP_FID,$Servicetypegroup_fidInfo);
		$this->addTableField('3',itsap_servicetypeEntity::$SERVICETYPEGROUP_FID);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(itsap_servicetypeEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(itsap_servicetypeEntity::$TITLE,$Title);
	}
	public static $PRIORITY="priority";
	/**
	 * @return mixed
	 */
	public function getPriority(){
		return $this->getField(itsap_servicetypeEntity::$PRIORITY);
	}
	/**
	 * @param mixed $Priority
	 */
	public function setPriority($Priority){
		$this->setField(itsap_servicetypeEntity::$PRIORITY,$Priority);
	}
	public static $SERVICETYPEGROUP_FID="servicetypegroup_fid";
	/**
	 * @return mixed
	 */
	public function getServicetypegroup_fid(){
		return $this->getField(itsap_servicetypeEntity::$SERVICETYPEGROUP_FID);
	}
	/**
	 * @param mixed $Servicetypegroup_fid
	 */
	public function setServicetypegroup_fid($Servicetypegroup_fid){
		$this->setField(itsap_servicetypeEntity::$SERVICETYPEGROUP_FID,$Servicetypegroup_fid);
	}
}
?>