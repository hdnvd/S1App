<?php
namespace Modules\fileshop\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-07 - 2017-11-28 18:01
*@lastUpdate 1396-09-07 - 2017-11-28 18:01
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class fileshop_filecategoryEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("fileshop_filecategory");
		$this->setTableTitle("fileshop_filecategory");
		$this->setTitleFieldName("id");

		/******** file_fid ********/
		$File_fidInfo=new FieldInfo();
		$File_fidInfo->setTitle("file_fid");
		$this->setFieldInfo(fileshop_filecategoryEntity::$FILE_FID,$File_fidInfo);
		$this->addTableField('1',fileshop_filecategoryEntity::$FILE_FID);

		/******** common_category_fid ********/
		$Common_category_fidInfo=new FieldInfo();
		$Common_category_fidInfo->setTitle("common_category_fid");
		$this->setFieldInfo(fileshop_filecategoryEntity::$COMMON_CATEGORY_FID,$Common_category_fidInfo);
		$this->addTableField('2',fileshop_filecategoryEntity::$COMMON_CATEGORY_FID);
	}
	public static $FILE_FID="file_fid";
	/**
	 * @return mixed
	 */
	public function getFile_fid(){
		return $this->getField(fileshop_filecategoryEntity::$FILE_FID);
	}
	/**
	 * @param mixed $File_fid
	 */
	public function setFile_fid($File_fid){
		$this->setField(fileshop_filecategoryEntity::$FILE_FID,$File_fid);
	}
	public static $COMMON_CATEGORY_FID="common_category_fid";
	/**
	 * @return mixed
	 */
	public function getCommon_category_fid(){
		return $this->getField(fileshop_filecategoryEntity::$COMMON_CATEGORY_FID);
	}
	/**
	 * @param mixed $Common_category_fid
	 */
	public function setCommon_category_fid($Common_category_fid){
		$this->setField(fileshop_filecategoryEntity::$COMMON_CATEGORY_FID,$Common_category_fid);
	}
}
?>