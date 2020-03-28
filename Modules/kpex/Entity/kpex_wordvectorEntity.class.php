<?php
namespace Modules\kpex\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-09-21 - 2018-12-12 17:13
*@lastUpdate 1397-09-21 - 2018-12-12 17:13
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class kpex_wordvectorEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("kpex_wordvector");
		$this->setTableTitle("kpex_wordvector");
		$this->setTitleFieldName("id");

		/******** created_at ********/
		$Created_atInfo=new FieldInfo();
		$Created_atInfo->setTitle("تاریخ ایجاد");
		$this->setFieldInfo(kpex_wordvectorEntity::$CREATED_AT,$Created_atInfo);
		$this->addTableField('1',kpex_wordvectorEntity::$CREATED_AT);

		/******** updated_at ********/
		$Updated_atInfo=new FieldInfo();
		$Updated_atInfo->setTitle("تاریخ بروزرسانی");
		$this->setFieldInfo(kpex_wordvectorEntity::$UPDATED_AT,$Updated_atInfo);
		$this->addTableField('2',kpex_wordvectorEntity::$UPDATED_AT);

		/******** word ********/
		$WordInfo=new FieldInfo();
		$WordInfo->setTitle("کلمه");
		$this->setFieldInfo(kpex_wordvectorEntity::$WORD,$WordInfo);
		$this->addTableField('3',kpex_wordvectorEntity::$WORD);

		/******** vector ********/
		$VectorInfo=new FieldInfo();
		$VectorInfo->setTitle("vector");
		$this->setFieldInfo(kpex_wordvectorEntity::$VECTOR,$VectorInfo);
		$this->addTableField('4',kpex_wordvectorEntity::$VECTOR);
	}
	public static $CREATED_AT="created_at";
	/**
	 * @return mixed
	 */
	public function getCreated_at(){
		return $this->getField(kpex_wordvectorEntity::$CREATED_AT);
	}
	/**
	 * @param mixed $Created_at
	 */
	public function setCreated_at($Created_at){
		$this->setField(kpex_wordvectorEntity::$CREATED_AT,$Created_at);
	}
	public static $UPDATED_AT="updated_at";
	/**
	 * @return mixed
	 */
	public function getUpdated_at(){
		return $this->getField(kpex_wordvectorEntity::$UPDATED_AT);
	}
	/**
	 * @param mixed $Updated_at
	 */
	public function setUpdated_at($Updated_at){
		$this->setField(kpex_wordvectorEntity::$UPDATED_AT,$Updated_at);
	}
	public static $WORD="word";
	/**
	 * @return mixed
	 */
	public function getWord(){
		return $this->getField(kpex_wordvectorEntity::$WORD);
	}
	/**
	 * @param mixed $Word
	 */
	public function setWord($Word){
		$this->setField(kpex_wordvectorEntity::$WORD,$Word);
	}
	public static $VECTOR="vector";
	/**
	 * @return mixed
	 */
	public function getVector(){
		return $this->getField(kpex_wordvectorEntity::$VECTOR);
	}
	/**
	 * @param mixed $Vector
	 */
	public function setVector($Vector){
		$this->setField(kpex_wordvectorEntity::$VECTOR,$Vector);
	}
}
?>