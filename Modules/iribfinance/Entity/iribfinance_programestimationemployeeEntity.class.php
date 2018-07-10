<?php
namespace Modules\iribfinance\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 20:01
*@lastUpdate 1396-11-05 - 2018-01-25 20:01
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class iribfinance_programestimationemployeeEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("iribfinance_programestimationemployee");
		$this->setTableTitle("عامل برنامه");
		$this->setTitleFieldName("id");

		/******** employee_fid ********/
		$Employee_fidInfo=new FieldInfo();
		$Employee_fidInfo->setTitle("کارمند");
		$this->setFieldInfo(iribfinance_programestimationemployeeEntity::$EMPLOYEE_FID,$Employee_fidInfo);
		$this->addTableField('1',iribfinance_programestimationemployeeEntity::$EMPLOYEE_FID);

		/******** activity_fid ********/
		$Activity_fidInfo=new FieldInfo();
		$Activity_fidInfo->setTitle("فعالیت");
		$this->setFieldInfo(iribfinance_programestimationemployeeEntity::$ACTIVITY_FID,$Activity_fidInfo);
		$this->addTableField('2',iribfinance_programestimationemployeeEntity::$ACTIVITY_FID);

		/******** programestimation_fid ********/
		$Programestimation_fidInfo=new FieldInfo();
		$Programestimation_fidInfo->setTitle("برآورد");
		$this->setFieldInfo(iribfinance_programestimationemployeeEntity::$PROGRAMESTIMATION_FID,$Programestimation_fidInfo);
		$this->addTableField('3',iribfinance_programestimationemployeeEntity::$PROGRAMESTIMATION_FID);

		/******** employmenttype_fid ********/
		$Employmenttype_fidInfo=new FieldInfo();
		$Employmenttype_fidInfo->setTitle("نوع استخدام");
		$this->setFieldInfo(iribfinance_programestimationemployeeEntity::$EMPLOYMENTTYPE_FID,$Employmenttype_fidInfo);
		$this->addTableField('4',iribfinance_programestimationemployeeEntity::$EMPLOYMENTTYPE_FID);

		/******** totalwork ********/
		$TotalworkInfo=new FieldInfo();
		$TotalworkInfo->setTitle("جمع کار");
		$this->setFieldInfo(iribfinance_programestimationemployeeEntity::$TOTALWORK,$TotalworkInfo);
		$this->addTableField('5',iribfinance_programestimationemployeeEntity::$TOTALWORK);

		/******** workunit_fid ********/
		$Workunit_fidInfo=new FieldInfo();
		$Workunit_fidInfo->setTitle("واحد");
		$this->setFieldInfo(iribfinance_programestimationemployeeEntity::$WORKUNIT_FID,$Workunit_fidInfo);
		$this->addTableField('6',iribfinance_programestimationemployeeEntity::$WORKUNIT_FID);
	}
	public static $EMPLOYEE_FID="employee_fid";
	/**
	 * @return mixed
	 */
	public function getEmployee_fid(){
		return $this->getField(iribfinance_programestimationemployeeEntity::$EMPLOYEE_FID);
	}
	/**
	 * @param mixed $Employee_fid
	 */
	public function setEmployee_fid($Employee_fid){
		$this->setField(iribfinance_programestimationemployeeEntity::$EMPLOYEE_FID,$Employee_fid);
	}
	public static $ACTIVITY_FID="activity_fid";
	/**
	 * @return mixed
	 */
	public function getActivity_fid(){
		return $this->getField(iribfinance_programestimationemployeeEntity::$ACTIVITY_FID);
	}
	/**
	 * @param mixed $Activity_fid
	 */
	public function setActivity_fid($Activity_fid){
		$this->setField(iribfinance_programestimationemployeeEntity::$ACTIVITY_FID,$Activity_fid);
	}
	public static $PROGRAMESTIMATION_FID="programestimation_fid";
	/**
	 * @return mixed
	 */
	public function getProgramestimation_fid(){
		return $this->getField(iribfinance_programestimationemployeeEntity::$PROGRAMESTIMATION_FID);
	}
	/**
	 * @param mixed $Programestimation_fid
	 */
	public function setProgramestimation_fid($Programestimation_fid){
		$this->setField(iribfinance_programestimationemployeeEntity::$PROGRAMESTIMATION_FID,$Programestimation_fid);
	}
	public static $EMPLOYMENTTYPE_FID="employmenttype_fid";
	/**
	 * @return mixed
	 */
	public function getEmploymenttype_fid(){
		return $this->getField(iribfinance_programestimationemployeeEntity::$EMPLOYMENTTYPE_FID);
	}
	/**
	 * @param mixed $Employmenttype_fid
	 */
	public function setEmploymenttype_fid($Employmenttype_fid){
		$this->setField(iribfinance_programestimationemployeeEntity::$EMPLOYMENTTYPE_FID,$Employmenttype_fid);
	}
	public static $TOTALWORK="totalwork";
	/**
	 * @return mixed
	 */
	public function getTotalwork(){
		return $this->getField(iribfinance_programestimationemployeeEntity::$TOTALWORK);
	}
	/**
	 * @param mixed $Totalwork
	 */
	public function setTotalwork($Totalwork){
		$this->setField(iribfinance_programestimationemployeeEntity::$TOTALWORK,$Totalwork);
	}
	public static $WORKUNIT_FID="workunit_fid";
	/**
	 * @return mixed
	 */
	public function getWorkunit_fid(){
		return $this->getField(iribfinance_programestimationemployeeEntity::$WORKUNIT_FID);
	}
	/**
	 * @param mixed $Workunit_fid
	 */
	public function setWorkunit_fid($Workunit_fid){
		$this->setField(iribfinance_programestimationemployeeEntity::$WORKUNIT_FID,$Workunit_fid);
	}
}
?>