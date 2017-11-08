<?php
namespace Modules\onlineclass\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-25 - 2017-10-17 15:49
*@lastUpdate 1396-07-25 - 2017-10-17 15:49
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class onlineclass_courseEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("onlineclass_course");
		$this->setTableTitle("onlineclass_course");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("title");
		$this->setFieldInfo(onlineclass_courseEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',onlineclass_courseEntity::$TITLE);

		/******** start_date ********/
		$Start_dateInfo=new FieldInfo();
		$Start_dateInfo->setTitle("start_date");
		$this->setFieldInfo(onlineclass_courseEntity::$START_DATE,$Start_dateInfo);
		$this->addTableField('2',onlineclass_courseEntity::$START_DATE);

		/******** end_date ********/
		$End_dateInfo=new FieldInfo();
		$End_dateInfo->setTitle("end_date");
		$this->setFieldInfo(onlineclass_courseEntity::$END_DATE,$End_dateInfo);
		$this->addTableField('3',onlineclass_courseEntity::$END_DATE);

		/******** tutor_fid ********/
		$Tutor_fidInfo=new FieldInfo();
		$Tutor_fidInfo->setTitle("tutor_fid");
		$this->setFieldInfo(onlineclass_courseEntity::$TUTOR_FID,$Tutor_fidInfo);
		$this->addTableField('4',onlineclass_courseEntity::$TUTOR_FID);

		/******** price ********/
		$PriceInfo=new FieldInfo();
		$PriceInfo->setTitle("price");
		$this->setFieldInfo(onlineclass_courseEntity::$PRICE,$PriceInfo);
		$this->addTableField('5',onlineclass_courseEntity::$PRICE);

		/******** description ********/
		$DescriptionInfo=new FieldInfo();
		$DescriptionInfo->setTitle("description");
		$this->setFieldInfo(onlineclass_courseEntity::$DESCRIPTION,$DescriptionInfo);
		$this->addTableField('6',onlineclass_courseEntity::$DESCRIPTION);

		/******** level_fid ********/
		$Level_fidInfo=new FieldInfo();
		$Level_fidInfo->setTitle("level_fid");
		$this->setFieldInfo(onlineclass_courseEntity::$LEVEL_FID,$Level_fidInfo);
		$this->addTableField('7',onlineclass_courseEntity::$LEVEL_FID);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(onlineclass_courseEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(onlineclass_courseEntity::$TITLE,$Title);
	}
	public static $START_DATE="start_date";
	/**
	 * @return mixed
	 */
	public function getStart_date(){
		return $this->getField(onlineclass_courseEntity::$START_DATE);
	}
	/**
	 * @param mixed $Start_date
	 */
	public function setStart_date($Start_date){
		$this->setField(onlineclass_courseEntity::$START_DATE,$Start_date);
	}
	public static $END_DATE="end_date";
	/**
	 * @return mixed
	 */
	public function getEnd_date(){
		return $this->getField(onlineclass_courseEntity::$END_DATE);
	}
	/**
	 * @param mixed $End_date
	 */
	public function setEnd_date($End_date){
		$this->setField(onlineclass_courseEntity::$END_DATE,$End_date);
	}
	public static $TUTOR_FID="tutor_fid";
	/**
	 * @return mixed
	 */
	public function getTutor_fid(){
		return $this->getField(onlineclass_courseEntity::$TUTOR_FID);
	}
	/**
	 * @param mixed $Tutor_fid
	 */
	public function setTutor_fid($Tutor_fid){
		$this->setField(onlineclass_courseEntity::$TUTOR_FID,$Tutor_fid);
	}
	public static $PRICE="price";
	/**
	 * @return mixed
	 */
	public function getPrice(){
		return $this->getField(onlineclass_courseEntity::$PRICE);
	}
	/**
	 * @param mixed $Price
	 */
	public function setPrice($Price){
		$this->setField(onlineclass_courseEntity::$PRICE,$Price);
	}
	public static $DESCRIPTION="description";
	/**
	 * @return mixed
	 */
	public function getDescription(){
		return $this->getField(onlineclass_courseEntity::$DESCRIPTION);
	}
	/**
	 * @param mixed $Description
	 */
	public function setDescription($Description){
		$this->setField(onlineclass_courseEntity::$DESCRIPTION,$Description);
	}
	public static $LEVEL_FID="level_fid";
	/**
	 * @return mixed
	 */
	public function getLevel_fid(){
		return $this->getField(onlineclass_courseEntity::$LEVEL_FID);
	}
	/**
	 * @param mixed $Level_fid
	 */
	public function setLevel_fid($Level_fid){
		$this->setField(onlineclass_courseEntity::$LEVEL_FID,$Level_fid);
	}
}
?>