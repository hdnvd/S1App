<?php
namespace Modules\oras\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-12 - 2017-10-04 03:01
*@lastUpdate 1396-07-12 - 2017-10-04 03:01
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class oras_recordtypeEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("oras_recordtype");
		$this->setTableTitle("نوع گزارش");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("عنوان");
		$this->setFieldInfo(oras_recordtypeEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',oras_recordtypeEntity::$TITLE);

		/******** points ********/
		$PointsInfo=new FieldInfo();
		$PointsInfo->setTitle("امتیاز");
		$this->setFieldInfo(oras_recordtypeEntity::$POINTS,$PointsInfo);
		$this->addTableField('2',oras_recordtypeEntity::$POINTS);

		/******** isbad ********/
		$IsbadInfo=new FieldInfo();
		$IsbadInfo->setTitle("نوع");
		$this->setFieldInfo(oras_recordtypeEntity::$ISBAD,$IsbadInfo);
		$this->addTableField('3',oras_recordtypeEntity::$ISBAD);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(oras_recordtypeEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(oras_recordtypeEntity::$TITLE,$Title);
	}
	public static $POINTS="points";
	/**
	 * @return mixed
	 */
	public function getPoints(){
		return $this->getField(oras_recordtypeEntity::$POINTS);
	}
	/**
	 * @param mixed $Points
	 */
	public function setPoints($Points){
		$this->setField(oras_recordtypeEntity::$POINTS,$Points);
	}
	public static $ISBAD="isbad";
	/**
	 * @return mixed
	 */
	public function getIsbad(){
		return $this->getField(oras_recordtypeEntity::$ISBAD);
	}
	/**
	 * @param mixed $Isbad
	 */
	public function setIsbad($Isbad){
		$this->setField(oras_recordtypeEntity::$ISBAD,$Isbad);
	}
}
?>