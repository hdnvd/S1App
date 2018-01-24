<?php
namespace Modules\shift\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-27 - 2018-01-17 00:24
*@lastUpdate 1396-10-27 - 2018-01-17 00:24
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class shift_dateEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("shift_date");
		$this->setTableTitle("تاریخ");
		$this->setTitleFieldName("id");

		/******** day_date ********/
		$Day_dateInfo=new FieldInfo();
		$Day_dateInfo->setTitle("تاریخ روز");
		$this->setFieldInfo(shift_dateEntity::$DAY_DATE,$Day_dateInfo);
		$this->addTableField('1',shift_dateEntity::$DAY_DATE);

		/******** score ********/
		$ScoreInfo=new FieldInfo();
		$ScoreInfo->setTitle("امتیاز");
		$this->setFieldInfo(shift_dateEntity::$SCORE,$ScoreInfo);
		$this->addTableField('2',shift_dateEntity::$SCORE);
	}
	public static $DAY_DATE="day_date";
	/**
	 * @return mixed
	 */
	public function getDay_date(){
		return $this->getField(shift_dateEntity::$DAY_DATE);
	}
	/**
	 * @param mixed $Day_date
	 */
	public function setDay_date($Day_date){
		$this->setField(shift_dateEntity::$DAY_DATE,$Day_date);
	}
	public static $SCORE="score";
	/**
	 * @return mixed
	 */
	public function getScore(){
		return $this->getField(shift_dateEntity::$SCORE);
	}
	/**
	 * @param mixed $Score
	 */
	public function setScore($Score){
		$this->setField(shift_dateEntity::$SCORE,$Score);
	}
}
?>