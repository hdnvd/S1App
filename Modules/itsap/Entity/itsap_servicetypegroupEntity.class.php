<?php
namespace Modules\itsap\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-13 - 2018-04-02 01:58
*@lastUpdate 1397-01-13 - 2018-04-02 01:58
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class itsap_servicetypegroupEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("itsap_servicetypegroup");
		$this->setTableTitle("itsap_servicetypegroup");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("عنوان");
		$this->setFieldInfo(itsap_servicetypegroupEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',itsap_servicetypegroupEntity::$TITLE);

		/******** servicetypegroup_fid ********/
		$Servicetypegroup_fidInfo=new FieldInfo();
		$Servicetypegroup_fidInfo->setTitle("servicetypegroup_fid");
		$this->setFieldInfo(itsap_servicetypegroupEntity::$SERVICETYPEGROUP_FID,$Servicetypegroup_fidInfo);
		$this->addTableField('2',itsap_servicetypegroupEntity::$SERVICETYPEGROUP_FID);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(itsap_servicetypegroupEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(itsap_servicetypegroupEntity::$TITLE,$Title);
	}
	public static $SERVICETYPEGROUP_FID="servicetypegroup_fid";
	/**
	 * @return mixed
	 */
	public function getServicetypegroup_fid(){
		return $this->getField(itsap_servicetypegroupEntity::$SERVICETYPEGROUP_FID);
	}
	/**
	 * @param mixed $Servicetypegroup_fid
	 */
	public function setServicetypegroup_fid($Servicetypegroup_fid){
		$this->setField(itsap_servicetypegroupEntity::$SERVICETYPEGROUP_FID,$Servicetypegroup_fid);
	}
}
?>