<?php
namespace Modules\shift\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-26 - 2018-01-16 20:22
*@lastUpdate 1396-10-26 - 2018-01-16 20:22
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class shift_eshteghalEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("shift_eshteghal");
		$this->setTableTitle("اشتغال");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("عنوان");
		$this->setFieldInfo(shift_eshteghalEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',shift_eshteghalEntity::$TITLE);

		/******** nameeshteghal ********/
		$NameeshteghalInfo=new FieldInfo();
		$NameeshteghalInfo->setTitle("نام اشتغال");
		$this->setFieldInfo(shift_eshteghalEntity::$NAMEESHTEGHAL,$NameeshteghalInfo);
		$this->addTableField('2',shift_eshteghalEntity::$NAMEESHTEGHAL);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(shift_eshteghalEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(shift_eshteghalEntity::$TITLE,$Title);
	}
	public static $NAMEESHTEGHAL="nameeshteghal";
	/**
	 * @return mixed
	 */
	public function getNameeshteghal(){
		return $this->getField(shift_eshteghalEntity::$NAMEESHTEGHAL);
	}
	/**
	 * @param mixed $Nameeshteghal
	 */
	public function setNameeshteghal($Nameeshteghal){
		$this->setField(shift_eshteghalEntity::$NAMEESHTEGHAL,$Nameeshteghal);
	}
}
?>