<?php
namespace Modules\oras\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-10 - 2017-10-02 15:41
*@lastUpdate 1396-07-10 - 2017-10-02 15:41
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class oras_employeerecruitmenttypeEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("oras_employeerecruitmenttype");
		$this->setTableTitle("نوع استخدام کارمند");
		$this->setTitleFieldName("id");

		/******** employee_fid ********/
		$Employee_fidInfo=new FieldInfo();
		$Employee_fidInfo->setTitle("کارمند");
		$this->setFieldInfo(oras_employeerecruitmenttypeEntity::$EMPLOYEE_FID,$Employee_fidInfo);

		/******** recruitmenttype_fid ********/
		$Recruitmenttype_fidInfo=new FieldInfo();
		$Recruitmenttype_fidInfo->setTitle("نوع استخدام");
		$this->setFieldInfo(oras_employeerecruitmenttypeEntity::$RECRUITMENTTYPE_FID,$Recruitmenttype_fidInfo);

		/******** start_date ********/
		$Start_dateInfo=new FieldInfo();
		$Start_dateInfo->setTitle("تاریخ شروع");
		$this->setFieldInfo(oras_employeerecruitmenttypeEntity::$START_DATE,$Start_dateInfo);

		/******** end_date ********/
		$End_dateInfo=new FieldInfo();
		$End_dateInfo->setTitle("تاریخ اتمام");
		$this->setFieldInfo(oras_employeerecruitmenttypeEntity::$END_DATE,$End_dateInfo);
	}
	public static $EMPLOYEE_FID="employee_fid";
	/**
	 * @return mixed
	 */
	public function getEmployee_fid(){
		return $this->getField(oras_employeerecruitmenttypeEntity::$EMPLOYEE_FID);
	}
	/**
	 * @param mixed $Employee_fid
	 */
	public function setEmployee_fid($Employee_fid){
		$this->setField(oras_employeerecruitmenttypeEntity::$EMPLOYEE_FID,$Employee_fid);
	}
	public static $RECRUITMENTTYPE_FID="recruitmenttype_fid";
	/**
	 * @return mixed
	 */
	public function getRecruitmenttype_fid(){
		return $this->getField(oras_employeerecruitmenttypeEntity::$RECRUITMENTTYPE_FID);
	}
	/**
	 * @param mixed $Recruitmenttype_fid
	 */
	public function setRecruitmenttype_fid($Recruitmenttype_fid){
		$this->setField(oras_employeerecruitmenttypeEntity::$RECRUITMENTTYPE_FID,$Recruitmenttype_fid);
	}
	public static $START_DATE="start_date";
	/**
	 * @return mixed
	 */
	public function getStart_date(){
		return $this->getField(oras_employeerecruitmenttypeEntity::$START_DATE);
	}
	/**
	 * @param mixed $Start_date
	 */
	public function setStart_date($Start_date){
		$this->setField(oras_employeerecruitmenttypeEntity::$START_DATE,$Start_date);
	}
	public static $END_DATE="end_date";
	/**
	 * @return mixed
	 */
	public function getEnd_date(){
		return $this->getField(oras_employeerecruitmenttypeEntity::$END_DATE);
	}
	/**
	 * @param mixed $End_date
	 */
	public function setEnd_date($End_date){
		$this->setField(oras_employeerecruitmenttypeEntity::$END_DATE,$End_date);
	}
}
?>