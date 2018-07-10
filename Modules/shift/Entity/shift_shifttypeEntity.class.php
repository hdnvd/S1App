<?php
namespace Modules\shift\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-17 - 2018-04-06 21:17
*@lastUpdate 1397-01-17 - 2018-04-06 21:17
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class shift_shifttypeEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("shift_shifttype");
		$this->setTableTitle("shift_shifttype");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("عنوان");
		$this->setFieldInfo(shift_shifttypeEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',shift_shifttypeEntity::$TITLE);

		/******** valueinminutes ********/
		$ValueinminutesInfo=new FieldInfo();
		$ValueinminutesInfo->setTitle("valueinminutes");
		$this->setFieldInfo(shift_shifttypeEntity::$VALUEINMINUTES,$ValueinminutesInfo);
		$this->addTableField('2',shift_shifttypeEntity::$VALUEINMINUTES);

		/******** abbreviation ********/
		$AbbreviationInfo=new FieldInfo();
		$AbbreviationInfo->setTitle("abbreviation");
		$this->setFieldInfo(shift_shifttypeEntity::$ABBREVIATION,$AbbreviationInfo);
		$this->addTableField('3',shift_shifttypeEntity::$ABBREVIATION);

		/******** latinabbreviation ********/
		$LatinabbreviationInfo=new FieldInfo();
		$LatinabbreviationInfo->setTitle("latinabbreviation");
		$this->setFieldInfo(shift_shifttypeEntity::$LATINABBREVIATION,$LatinabbreviationInfo);
		$this->addTableField('4',shift_shifttypeEntity::$LATINABBREVIATION);

		/******** isvisible ********/
		$IsvisibleInfo=new FieldInfo();
		$IsvisibleInfo->setTitle("isvisible");
		$this->setFieldInfo(shift_shifttypeEntity::$ISVISIBLE,$IsvisibleInfo);
		$this->addTableField('5',shift_shifttypeEntity::$ISVISIBLE);

		/******** holidayfactor ********/
		$HolidayfactorInfo=new FieldInfo();
		$HolidayfactorInfo->setTitle("holidayfactor");
		$this->setFieldInfo(shift_shifttypeEntity::$HOLIDAYFACTOR,$HolidayfactorInfo);
		$this->addTableField('6',shift_shifttypeEntity::$HOLIDAYFACTOR);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(shift_shifttypeEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(shift_shifttypeEntity::$TITLE,$Title);
	}
	public static $VALUEINMINUTES="valueinminutes";
	/**
	 * @return mixed
	 */
	public function getValueinminutes(){
		return $this->getField(shift_shifttypeEntity::$VALUEINMINUTES);
	}
	/**
	 * @param mixed $Valueinminutes
	 */
	public function setValueinminutes($Valueinminutes){
		$this->setField(shift_shifttypeEntity::$VALUEINMINUTES,$Valueinminutes);
	}
	public static $ABBREVIATION="abbreviation";
	/**
	 * @return mixed
	 */
	public function getAbbreviation(){
		return $this->getField(shift_shifttypeEntity::$ABBREVIATION);
	}
	/**
	 * @param mixed $Abbreviation
	 */
	public function setAbbreviation($Abbreviation){
		$this->setField(shift_shifttypeEntity::$ABBREVIATION,$Abbreviation);
	}
	public static $LATINABBREVIATION="latinabbreviation";
	/**
	 * @return mixed
	 */
	public function getLatinabbreviation(){
		return $this->getField(shift_shifttypeEntity::$LATINABBREVIATION);
	}
	/**
	 * @param mixed $Latinabbreviation
	 */
	public function setLatinabbreviation($Latinabbreviation){
		$this->setField(shift_shifttypeEntity::$LATINABBREVIATION,$Latinabbreviation);
	}
	public static $ISVISIBLE="isvisible";
	/**
	 * @return mixed
	 */
	public function getIsvisible(){
		return $this->getField(shift_shifttypeEntity::$ISVISIBLE);
	}
	/**
	 * @param mixed $Isvisible
	 */
	public function setIsvisible($Isvisible){
		$this->setField(shift_shifttypeEntity::$ISVISIBLE,$Isvisible);
	}
	public static $HOLIDAYFACTOR="holidayfactor";
	/**
	 * @return mixed
	 */
	public function getHolidayfactor(){
		return $this->getField(shift_shifttypeEntity::$HOLIDAYFACTOR);
	}
	/**
	 * @param mixed $Holidayfactor
	 */
	public function setHolidayfactor($Holidayfactor){
		$this->setField(shift_shifttypeEntity::$HOLIDAYFACTOR,$Holidayfactor);
	}
}
?>