<?php
namespace Modules\iribfinance\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:27
*@lastUpdate 1396-11-05 - 2018-01-25 18:27
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class iribfinance_programestimationEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("iribfinance_programestimation");
		$this->setTableTitle("برآورد");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("عنوان");
		$this->setFieldInfo(iribfinance_programestimationEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',iribfinance_programestimationEntity::$TITLE);

		/******** department_fid ********/
		$Department_fidInfo=new FieldInfo();
		$Department_fidInfo->setTitle("بخش");
		$this->setFieldInfo(iribfinance_programestimationEntity::$DEPARTMENT_FID,$Department_fidInfo);
		$this->addTableField('2',iribfinance_programestimationEntity::$DEPARTMENT_FID);

		/******** class_fid ********/
		$Class_fidInfo=new FieldInfo();
		$Class_fidInfo->setTitle("طبقه");
		$this->setFieldInfo(iribfinance_programestimationEntity::$CLASS_FID,$Class_fidInfo);
		$this->addTableField('3',iribfinance_programestimationEntity::$CLASS_FID);

		/******** programmaketype_fid ********/
		$Programmaketype_fidInfo=new FieldInfo();
		$Programmaketype_fidInfo->setTitle("ساخت");
		$this->setFieldInfo(iribfinance_programestimationEntity::$PROGRAMMAKETYPE_FID,$Programmaketype_fidInfo);
		$this->addTableField('4',iribfinance_programestimationEntity::$PROGRAMMAKETYPE_FID);

		/******** totalprogramcount ********/
		$TotalprogramcountInfo=new FieldInfo();
		$TotalprogramcountInfo->setTitle("تعداد کل برنامه ها");
		$this->setFieldInfo(iribfinance_programestimationEntity::$TOTALPROGRAMCOUNT,$TotalprogramcountInfo);
		$this->addTableField('5',iribfinance_programestimationEntity::$TOTALPROGRAMCOUNT);

		/******** timeperprogram ********/
		$TimeperprogramInfo=new FieldInfo();
		$TimeperprogramInfo->setTitle("مدت هر برنامه");
		$this->setFieldInfo(iribfinance_programestimationEntity::$TIMEPERPROGRAM,$TimeperprogramInfo);
		$this->addTableField('6',iribfinance_programestimationEntity::$TIMEPERPROGRAM);

		/******** is_haslegalproblem ********/
		$Is_haslegalproblemInfo=new FieldInfo();
		$Is_haslegalproblemInfo->setTitle("مشکل حقوقی");
		$this->setFieldInfo(iribfinance_programestimationEntity::$IS_HASLEGALPROBLEM,$Is_haslegalproblemInfo);
		$this->addTableField('7',iribfinance_programestimationEntity::$IS_HASLEGALPROBLEM);

		/******** approval_date ********/
		$Approval_dateInfo=new FieldInfo();
		$Approval_dateInfo->setTitle("تاریخ تصویب");
		$this->setFieldInfo(iribfinance_programestimationEntity::$APPROVAL_DATE,$Approval_dateInfo);
		$this->addTableField('8',iribfinance_programestimationEntity::$APPROVAL_DATE);

		/******** end_date ********/
		$End_dateInfo=new FieldInfo();
		$End_dateInfo->setTitle("تاریخ اتمام");
		$this->setFieldInfo(iribfinance_programestimationEntity::$END_DATE,$End_dateInfo);
		$this->addTableField('9',iribfinance_programestimationEntity::$END_DATE);

		/******** add_date ********/
		$Add_dateInfo=new FieldInfo();
		$Add_dateInfo->setTitle("تاریخ ثبت در سیستم");
		$this->setFieldInfo(iribfinance_programestimationEntity::$ADD_DATE,$Add_dateInfo);
		$this->addTableField('10',iribfinance_programestimationEntity::$ADD_DATE);

		/******** producer_employee_fid ********/
		$Producer_employee_fidInfo=new FieldInfo();
		$Producer_employee_fidInfo->setTitle("تولید کننده");
		$this->setFieldInfo(iribfinance_programestimationEntity::$PRODUCER_EMPLOYEE_FID,$Producer_employee_fidInfo);
		$this->addTableField('11',iribfinance_programestimationEntity::$PRODUCER_EMPLOYEE_FID);

		/******** executor_employee_fid ********/
		$Executor_employee_fidInfo=new FieldInfo();
		$Executor_employee_fidInfo->setTitle("مجری طرح");
		$this->setFieldInfo(iribfinance_programestimationEntity::$EXECUTOR_EMPLOYEE_FID,$Executor_employee_fidInfo);
		$this->addTableField('12',iribfinance_programestimationEntity::$EXECUTOR_EMPLOYEE_FID);

		/******** paycenter_fid ********/
		$Paycenter_fidInfo=new FieldInfo();
		$Paycenter_fidInfo->setTitle("مرکز هزینه");
		$this->setFieldInfo(iribfinance_programestimationEntity::$PAYCENTER_FID,$Paycenter_fidInfo);
		$this->addTableField('13',iribfinance_programestimationEntity::$PAYCENTER_FID);

		/******** makergroup_paycenter_fid ********/
		$Makergroup_paycenter_fidInfo=new FieldInfo();
		$Makergroup_paycenter_fidInfo->setTitle("مرکز هزینه گروه تولید");
		$this->setFieldInfo(iribfinance_programestimationEntity::$MAKERGROUP_PAYCENTER_FID,$Makergroup_paycenter_fidInfo);
		$this->addTableField('14',iribfinance_programestimationEntity::$MAKERGROUP_PAYCENTER_FID);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(iribfinance_programestimationEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(iribfinance_programestimationEntity::$TITLE,$Title);
	}
	public static $DEPARTMENT_FID="department_fid";
	/**
	 * @return mixed
	 */
	public function getDepartment_fid(){
		return $this->getField(iribfinance_programestimationEntity::$DEPARTMENT_FID);
	}
	/**
	 * @param mixed $Department_fid
	 */
	public function setDepartment_fid($Department_fid){
		$this->setField(iribfinance_programestimationEntity::$DEPARTMENT_FID,$Department_fid);
	}
	public static $CLASS_FID="class_fid";
	/**
	 * @return mixed
	 */
	public function getClass_fid(){
		return $this->getField(iribfinance_programestimationEntity::$CLASS_FID);
	}
	/**
	 * @param mixed $Class_fid
	 */
	public function setClass_fid($Class_fid){
		$this->setField(iribfinance_programestimationEntity::$CLASS_FID,$Class_fid);
	}
	public static $PROGRAMMAKETYPE_FID="programmaketype_fid";
	/**
	 * @return mixed
	 */
	public function getProgrammaketype_fid(){
		return $this->getField(iribfinance_programestimationEntity::$PROGRAMMAKETYPE_FID);
	}
	/**
	 * @param mixed $Programmaketype_fid
	 */
	public function setProgrammaketype_fid($Programmaketype_fid){
		$this->setField(iribfinance_programestimationEntity::$PROGRAMMAKETYPE_FID,$Programmaketype_fid);
	}
	public static $TOTALPROGRAMCOUNT="totalprogramcount";
	/**
	 * @return mixed
	 */
	public function getTotalprogramcount(){
		return $this->getField(iribfinance_programestimationEntity::$TOTALPROGRAMCOUNT);
	}
	/**
	 * @param mixed $Totalprogramcount
	 */
	public function setTotalprogramcount($Totalprogramcount){
		$this->setField(iribfinance_programestimationEntity::$TOTALPROGRAMCOUNT,$Totalprogramcount);
	}
	public static $TIMEPERPROGRAM="timeperprogram";
	/**
	 * @return mixed
	 */
	public function getTimeperprogram(){
		return $this->getField(iribfinance_programestimationEntity::$TIMEPERPROGRAM);
	}
	/**
	 * @param mixed $Timeperprogram
	 */
	public function setTimeperprogram($Timeperprogram){
		$this->setField(iribfinance_programestimationEntity::$TIMEPERPROGRAM,$Timeperprogram);
	}
	public static $IS_HASLEGALPROBLEM="is_haslegalproblem";
	/**
	 * @return mixed
	 */
	public function getIs_haslegalproblem(){
		return $this->getField(iribfinance_programestimationEntity::$IS_HASLEGALPROBLEM);
	}
	/**
	 * @param mixed $Is_haslegalproblem
	 */
	public function setIs_haslegalproblem($Is_haslegalproblem){
		$this->setField(iribfinance_programestimationEntity::$IS_HASLEGALPROBLEM,$Is_haslegalproblem);
	}
	public static $APPROVAL_DATE="approval_date";
	/**
	 * @return mixed
	 */
	public function getApproval_date(){
		return $this->getField(iribfinance_programestimationEntity::$APPROVAL_DATE);
	}
	/**
	 * @param mixed $Approval_date
	 */
	public function setApproval_date($Approval_date){
		$this->setField(iribfinance_programestimationEntity::$APPROVAL_DATE,$Approval_date);
	}
	public static $END_DATE="end_date";
	/**
	 * @return mixed
	 */
	public function getEnd_date(){
		return $this->getField(iribfinance_programestimationEntity::$END_DATE);
	}
	/**
	 * @param mixed $End_date
	 */
	public function setEnd_date($End_date){
		$this->setField(iribfinance_programestimationEntity::$END_DATE,$End_date);
	}
	public static $ADD_DATE="add_date";
	/**
	 * @return mixed
	 */
	public function getAdd_date(){
		return $this->getField(iribfinance_programestimationEntity::$ADD_DATE);
	}
	/**
	 * @param mixed $Add_date
	 */
	public function setAdd_date($Add_date){
		$this->setField(iribfinance_programestimationEntity::$ADD_DATE,$Add_date);
	}
	public static $PRODUCER_EMPLOYEE_FID="producer_employee_fid";
	/**
	 * @return mixed
	 */
	public function getProducer_employee_fid(){
		return $this->getField(iribfinance_programestimationEntity::$PRODUCER_EMPLOYEE_FID);
	}
	/**
	 * @param mixed $Producer_employee_fid
	 */
	public function setProducer_employee_fid($Producer_employee_fid){
		$this->setField(iribfinance_programestimationEntity::$PRODUCER_EMPLOYEE_FID,$Producer_employee_fid);
	}
	public static $EXECUTOR_EMPLOYEE_FID="executor_employee_fid";
	/**
	 * @return mixed
	 */
	public function getExecutor_employee_fid(){
		return $this->getField(iribfinance_programestimationEntity::$EXECUTOR_EMPLOYEE_FID);
	}
	/**
	 * @param mixed $Executor_employee_fid
	 */
	public function setExecutor_employee_fid($Executor_employee_fid){
		$this->setField(iribfinance_programestimationEntity::$EXECUTOR_EMPLOYEE_FID,$Executor_employee_fid);
	}
	public static $PAYCENTER_FID="paycenter_fid";
	/**
	 * @return mixed
	 */
	public function getPaycenter_fid(){
		return $this->getField(iribfinance_programestimationEntity::$PAYCENTER_FID);
	}
	/**
	 * @param mixed $Paycenter_fid
	 */
	public function setPaycenter_fid($Paycenter_fid){
		$this->setField(iribfinance_programestimationEntity::$PAYCENTER_FID,$Paycenter_fid);
	}
	public static $MAKERGROUP_PAYCENTER_FID="makergroup_paycenter_fid";
	/**
	 * @return mixed
	 */
	public function getMakergroup_paycenter_fid(){
		return $this->getField(iribfinance_programestimationEntity::$MAKERGROUP_PAYCENTER_FID);
	}
	/**
	 * @param mixed $Makergroup_paycenter_fid
	 */
	public function setMakergroup_paycenter_fid($Makergroup_paycenter_fid){
		$this->setField(iribfinance_programestimationEntity::$MAKERGROUP_PAYCENTER_FID,$Makergroup_paycenter_fid);
	}
}
?>