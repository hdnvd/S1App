<?php
namespace Modules\users\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-19 - 2018-02-08 15:47
*@lastUpdate 1396-11-19 - 2018-02-08 15:47
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class users_systemtaskEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("users_systemtask");
		$this->setTableTitle("users_systemtask");
		$this->setTitleFieldName("id");

		/******** module ********/
		$ModuleInfo=new FieldInfo();
		$ModuleInfo->setTitle("module");
		$this->setFieldInfo(users_systemtaskEntity::$MODULE,$ModuleInfo);
		$this->addTableField('1',users_systemtaskEntity::$MODULE);

		/******** page ********/
		$PageInfo=new FieldInfo();
		$PageInfo->setTitle("page");
		$this->setFieldInfo(users_systemtaskEntity::$PAGE,$PageInfo);
		$this->addTableField('2',users_systemtaskEntity::$PAGE);

		/******** action ********/
		$ActionInfo=new FieldInfo();
		$ActionInfo->setTitle("action");
		$this->setFieldInfo(users_systemtaskEntity::$ACTION,$ActionInfo);
		$this->addTableField('3',users_systemtaskEntity::$ACTION);
	}
	public static $MODULE="module";
	/**
	 * @return mixed
	 */
	public function getModule(){
		return $this->getField(users_systemtaskEntity::$MODULE);
	}
	/**
	 * @param mixed $Module
	 */
	public function setModule($Module){
		$this->setField(users_systemtaskEntity::$MODULE,$Module);
	}
	public static $PAGE="page";
	/**
	 * @return mixed
	 */
	public function getPage(){
		return $this->getField(users_systemtaskEntity::$PAGE);
	}
	/**
	 * @param mixed $Page
	 */
	public function setPage($Page){
		$this->setField(users_systemtaskEntity::$PAGE,$Page);
	}
	public static $ACTION="action";
	/**
	 * @return mixed
	 */
	public function getAction(){
		return $this->getField(users_systemtaskEntity::$ACTION);
	}
	/**
	 * @param mixed $Action
	 */
	public function setAction($Action){
		$this->setField(users_systemtaskEntity::$ACTION,$Action);
	}
}
?>