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
class itsap_servicestatusEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("itsap_servicestatus");
		$this->setTableTitle("itsap_servicestatus");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("title");
		$this->setFieldInfo(itsap_servicestatusEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',itsap_servicestatusEntity::$TITLE);

		/******** iscommited ********/
		$IscommitedInfo=new FieldInfo();
		$IscommitedInfo->setTitle("iscommited");
		$this->setFieldInfo(itsap_servicestatusEntity::$ISCOMMITED,$IscommitedInfo);
		$this->addTableField('2',itsap_servicestatusEntity::$ISCOMMITED);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(itsap_servicestatusEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(itsap_servicestatusEntity::$TITLE,$Title);
	}
	public static $ISCOMMITED="iscommited";
	/**
	 * @return mixed
	 */
	public function getIscommited(){
		return $this->getField(itsap_servicestatusEntity::$ISCOMMITED);
	}
	/**
	 * @param mixed $Iscommited
	 */
	public function setIscommited($Iscommited){
		$this->setField(itsap_servicestatusEntity::$ISCOMMITED,$Iscommited);
	}
}
?>