<?php
namespace Modules\common\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-07 - 2017-11-28 18:03
*@lastUpdate 1396-09-07 - 2017-11-28 18:03
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class common_categoryEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("common_category");
		$this->setTableTitle("common_category");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("title");
		$this->setFieldInfo(common_categoryEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',common_categoryEntity::$TITLE);

		/******** latintitle ********/
		$LatintitleInfo=new FieldInfo();
		$LatintitleInfo->setTitle("latintitle");
		$this->setFieldInfo(common_categoryEntity::$LATINTITLE,$LatintitleInfo);
		$this->addTableField('2',common_categoryEntity::$LATINTITLE);

		/******** category_fid ********/
		$Category_fidInfo=new FieldInfo();
		$Category_fidInfo->setTitle("category_fid");
		$this->setFieldInfo(common_categoryEntity::$CATEGORY_FID,$Category_fidInfo);
		$this->addTableField('3',common_categoryEntity::$CATEGORY_FID);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(common_categoryEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(common_categoryEntity::$TITLE,$Title);
	}
	public static $LATINTITLE="latintitle";
	/**
	 * @return mixed
	 */
	public function getLatintitle(){
		return $this->getField(common_categoryEntity::$LATINTITLE);
	}
	/**
	 * @param mixed $Latintitle
	 */
	public function setLatintitle($Latintitle){
		$this->setField(common_categoryEntity::$LATINTITLE,$Latintitle);
	}
	public static $CATEGORY_FID="category_fid";
	/**
	 * @return mixed
	 */
	public function getCategory_fid(){
		return $this->getField(common_categoryEntity::$CATEGORY_FID);
	}
	/**
	 * @param mixed $Category_fid
	 */
	public function setCategory_fid($Category_fid){
		$this->setField(common_categoryEntity::$CATEGORY_FID,$Category_fid);
	}
}
?>