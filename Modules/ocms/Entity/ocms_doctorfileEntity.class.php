<?php
namespace Modules\ocms\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-06 - 2018-03-26 16:43
*@lastUpdate 1397-01-06 - 2018-03-26 16:43
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class ocms_doctorfileEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("ocms_doctorfile");
		$this->setTableTitle("فایل");
		$this->setTitleFieldName("description");

		/******** file_flu ********/
		$File_fluInfo=new FieldInfo();
		$File_fluInfo->setTitle("فایل پیوستی");
		$this->setFieldInfo(ocms_doctorfileEntity::$FILE_FLU,$File_fluInfo);
		$this->addTableField('1',ocms_doctorfileEntity::$FILE_FLU);

		/******** description ********/
		$DescriptionInfo=new FieldInfo();
		$DescriptionInfo->setTitle("عنوان");
		$this->setFieldInfo(ocms_doctorfileEntity::$DESCRIPTION,$DescriptionInfo);
		$this->addTableField('2',ocms_doctorfileEntity::$DESCRIPTION);

		/******** doctor_fid ********/
		$Doctor_fidInfo=new FieldInfo();
		$Doctor_fidInfo->setTitle("پزشک");
		$this->setFieldInfo(ocms_doctorfileEntity::$DOCTOR_FID,$Doctor_fidInfo);
		$this->addTableField('3',ocms_doctorfileEntity::$DOCTOR_FID);

		/******** role_systemuser_fid ********/
		$Role_systemuser_fidInfo=new FieldInfo();
		$Role_systemuser_fidInfo->setTitle("role_systemuser_fid");
		$this->setFieldInfo(ocms_doctorfileEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fidInfo);
		$this->addTableField('4',ocms_doctorfileEntity::$ROLE_SYSTEMUSER_FID);
	}
	public static $FILE_FLU="file_flu";
	/**
	 * @return mixed
	 */
	public function getFile_flu(){
		return $this->getField(ocms_doctorfileEntity::$FILE_FLU);
	}
	/**
	 * @param mixed $File_flu
	 */
	public function setFile_flu($File_flu){
		$this->setField(ocms_doctorfileEntity::$FILE_FLU,$File_flu);
	}
	public static $DESCRIPTION="description";
	/**
	 * @return mixed
	 */
	public function getDescription(){
		return $this->getField(ocms_doctorfileEntity::$DESCRIPTION);
	}
	/**
	 * @param mixed $Description
	 */
	public function setDescription($Description){
		$this->setField(ocms_doctorfileEntity::$DESCRIPTION,$Description);
	}
	public static $DOCTOR_FID="doctor_fid";
	/**
	 * @return mixed
	 */
	public function getDoctor_fid(){
		return $this->getField(ocms_doctorfileEntity::$DOCTOR_FID);
	}
	/**
	 * @param mixed $Doctor_fid
	 */
	public function setDoctor_fid($Doctor_fid){
		$this->setField(ocms_doctorfileEntity::$DOCTOR_FID,$Doctor_fid);
	}
	public static $ROLE_SYSTEMUSER_FID="role_systemuser_fid";
	/**
	 * @return mixed
	 */
	public function getRole_systemuser_fid(){
		return $this->getField(ocms_doctorfileEntity::$ROLE_SYSTEMUSER_FID);
	}
	/**
	 * @param mixed $Role_systemuser_fid
	 */
	public function setRole_systemuser_fid($Role_systemuser_fid){
		$this->setField(ocms_doctorfileEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fid);
	}
}
?>