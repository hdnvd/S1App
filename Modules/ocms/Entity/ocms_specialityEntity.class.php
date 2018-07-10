<?php
namespace Modules\ocms\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-30 - 2017-12-21 18:36
*@lastUpdate 1396-09-30 - 2017-12-21 18:36
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class ocms_specialityEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("ocms_speciality");
		$this->setTableTitle("تخصص");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("عنوان");
		$this->setFieldInfo(ocms_specialityEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',ocms_specialityEntity::$TITLE);

		/******** speciality_fid ********/
		$Speciality_fidInfo=new FieldInfo();
		$Speciality_fidInfo->setTitle("تخصص مادر");
		$this->setFieldInfo(ocms_specialityEntity::$SPECIALITY_FID,$Speciality_fidInfo);
		$this->addTableField('2',ocms_specialityEntity::$SPECIALITY_FID);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(ocms_specialityEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(ocms_specialityEntity::$TITLE,$Title);
	}
	public static $SPECIALITY_FID="speciality_fid";
	/**
	 * @return mixed
	 */
	public function getSpeciality_fid(){
		return $this->getField(ocms_specialityEntity::$SPECIALITY_FID);
	}
	/**
	 * @param mixed $Speciality_fid
	 */
	public function setSpeciality_fid($Speciality_fid){
		$this->setField(ocms_specialityEntity::$SPECIALITY_FID,$Speciality_fid);
	}
}
?>