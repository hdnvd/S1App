<?php
namespace Modules\iribfinance\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 19:04
*@lastUpdate 1396-11-05 - 2018-01-25 19:04
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class iribfinance_prosperityfundEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("iribfinance_prosperityfund");
		$this->setTableTitle("وام صندوق رفاه");
		$this->setTitleFieldName("id");

		/******** employee_fid ********/
		$Employee_fidInfo=new FieldInfo();
		$Employee_fidInfo->setTitle("کارمند");
		$this->setFieldInfo(iribfinance_prosperityfundEntity::$EMPLOYEE_FID,$Employee_fidInfo);
		$this->addTableField('1',iribfinance_prosperityfundEntity::$EMPLOYEE_FID);

		/******** totalamount ********/
		$TotalamountInfo=new FieldInfo();
		$TotalamountInfo->setTitle("مبلغ کل");
		$this->setFieldInfo(iribfinance_prosperityfundEntity::$TOTALAMOUNT,$TotalamountInfo);
		$this->addTableField('2',iribfinance_prosperityfundEntity::$TOTALAMOUNT);

		/******** add_date ********/
		$Add_dateInfo=new FieldInfo();
		$Add_dateInfo->setTitle("تاریخ ثبت در سیستم");
		$this->setFieldInfo(iribfinance_prosperityfundEntity::$ADD_DATE,$Add_dateInfo);
		$this->addTableField('3',iribfinance_prosperityfundEntity::$ADD_DATE);

		/******** monthcount ********/
		$MonthcountInfo=new FieldInfo();
		$MonthcountInfo->setTitle("تعداد کل اقساط");
		$this->setFieldInfo(iribfinance_prosperityfundEntity::$MONTHCOUNT,$MonthcountInfo);
		$this->addTableField('4',iribfinance_prosperityfundEntity::$MONTHCOUNT);

		/******** amountpermonth ********/
		$AmountpermonthInfo=new FieldInfo();
		$AmountpermonthInfo->setTitle("مبلغ هر قسط");
		$this->setFieldInfo(iribfinance_prosperityfundEntity::$AMOUNTPERMONTH,$AmountpermonthInfo);
		$this->addTableField('5',iribfinance_prosperityfundEntity::$AMOUNTPERMONTH);

		/******** isactive ********/
		$IsactiveInfo=new FieldInfo();
		$IsactiveInfo->setTitle("فعال");
		$this->setFieldInfo(iribfinance_prosperityfundEntity::$ISACTIVE,$IsactiveInfo);
		$this->addTableField('6',iribfinance_prosperityfundEntity::$ISACTIVE);
	}
	public static $EMPLOYEE_FID="employee_fid";
	/**
	 * @return mixed
	 */
	public function getEmployee_fid(){
		return $this->getField(iribfinance_prosperityfundEntity::$EMPLOYEE_FID);
	}
	/**
	 * @param mixed $Employee_fid
	 */
	public function setEmployee_fid($Employee_fid){
		$this->setField(iribfinance_prosperityfundEntity::$EMPLOYEE_FID,$Employee_fid);
	}
	public static $TOTALAMOUNT="totalamount";
	/**
	 * @return mixed
	 */
	public function getTotalamount(){
		return $this->getField(iribfinance_prosperityfundEntity::$TOTALAMOUNT);
	}
	/**
	 * @param mixed $Totalamount
	 */
	public function setTotalamount($Totalamount){
		$this->setField(iribfinance_prosperityfundEntity::$TOTALAMOUNT,$Totalamount);
	}
	public static $ADD_DATE="add_date";
	/**
	 * @return mixed
	 */
	public function getAdd_date(){
		return $this->getField(iribfinance_prosperityfundEntity::$ADD_DATE);
	}
	/**
	 * @param mixed $Add_date
	 */
	public function setAdd_date($Add_date){
		$this->setField(iribfinance_prosperityfundEntity::$ADD_DATE,$Add_date);
	}
	public static $MONTHCOUNT="monthcount";
	/**
	 * @return mixed
	 */
	public function getMonthcount(){
		return $this->getField(iribfinance_prosperityfundEntity::$MONTHCOUNT);
	}
	/**
	 * @param mixed $Monthcount
	 */
	public function setMonthcount($Monthcount){
		$this->setField(iribfinance_prosperityfundEntity::$MONTHCOUNT,$Monthcount);
	}
	public static $AMOUNTPERMONTH="amountpermonth";
	/**
	 * @return mixed
	 */
	public function getAmountpermonth(){
		return $this->getField(iribfinance_prosperityfundEntity::$AMOUNTPERMONTH);
	}
	/**
	 * @param mixed $Amountpermonth
	 */
	public function setAmountpermonth($Amountpermonth){
		$this->setField(iribfinance_prosperityfundEntity::$AMOUNTPERMONTH,$Amountpermonth);
	}
	public static $ISACTIVE="isactive";
	/**
	 * @return mixed
	 */
	public function getIsactive(){
		return $this->getField(iribfinance_prosperityfundEntity::$ISACTIVE);
	}
	/**
	 * @param mixed $Isactive
	 */
	public function setIsactive($Isactive){
		$this->setField(iribfinance_prosperityfundEntity::$ISACTIVE,$Isactive);
	}
}
?>