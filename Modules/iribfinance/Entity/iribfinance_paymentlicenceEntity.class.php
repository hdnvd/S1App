<?php
namespace Modules\iribfinance\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:15
*@lastUpdate 1396-11-05 - 2018-01-25 18:15
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class iribfinance_paymentlicenceEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("iribfinance_paymentlicence");
		$this->setTableTitle("مجوز قطعی پرداخت");
		$this->setTitleFieldName("id");

		/******** programestimationemployee_fid ********/
		$Programestimationemployee_fidInfo=new FieldInfo();
		$Programestimationemployee_fidInfo->setTitle("فعالیت برآوردی");
		$this->setFieldInfo(iribfinance_paymentlicenceEntity::$PROGRAMESTIMATIONEMPLOYEE_FID,$Programestimationemployee_fidInfo);
		$this->addTableField('1',iribfinance_paymentlicenceEntity::$PROGRAMESTIMATIONEMPLOYEE_FID);

		/******** month ********/
		$MonthInfo=new FieldInfo();
		$MonthInfo->setTitle("ماه");
		$this->setFieldInfo(iribfinance_paymentlicenceEntity::$MONTH,$MonthInfo);
		$this->addTableField('2',iribfinance_paymentlicenceEntity::$MONTH);

		/******** pay_date ********/
		$Pay_dateInfo=new FieldInfo();
		$Pay_dateInfo->setTitle("تاریخ پرداخت");
		$this->setFieldInfo(iribfinance_paymentlicenceEntity::$PAY_DATE,$Pay_dateInfo);
		$this->addTableField('3',iribfinance_paymentlicenceEntity::$PAY_DATE);

		/******** work ********/
		$WorkInfo=new FieldInfo();
		$WorkInfo->setTitle("میزان کار");
		$this->setFieldInfo(iribfinance_paymentlicenceEntity::$WORK,$WorkInfo);
		$this->addTableField('4',iribfinance_paymentlicenceEntity::$WORK);

		/******** decrementtime ********/
		$DecrementtimeInfo=new FieldInfo();
		$DecrementtimeInfo->setTitle("کسر تایم");
		$this->setFieldInfo(iribfinance_paymentlicenceEntity::$DECREMENTTIME,$DecrementtimeInfo);
		$this->addTableField('5',iribfinance_paymentlicenceEntity::$DECREMENTTIME);

		/******** workfactor ********/
		$WorkfactorInfo=new FieldInfo();
		$WorkfactorInfo->setTitle("درصد انجام کار");
		$this->setFieldInfo(iribfinance_paymentlicenceEntity::$WORKFACTOR,$WorkfactorInfo);
		$this->addTableField('6',iribfinance_paymentlicenceEntity::$WORKFACTOR);
	}
	public static $PROGRAMESTIMATIONEMPLOYEE_FID="programestimationemployee_fid";
	/**
	 * @return mixed
	 */
	public function getProgramestimationemployee_fid(){
		return $this->getField(iribfinance_paymentlicenceEntity::$PROGRAMESTIMATIONEMPLOYEE_FID);
	}
	/**
	 * @param mixed $Programestimationemployee_fid
	 */
	public function setProgramestimationemployee_fid($Programestimationemployee_fid){
		$this->setField(iribfinance_paymentlicenceEntity::$PROGRAMESTIMATIONEMPLOYEE_FID,$Programestimationemployee_fid);
	}
	public static $MONTH="month";
	/**
	 * @return mixed
	 */
	public function getMonth(){
		return $this->getField(iribfinance_paymentlicenceEntity::$MONTH);
	}
	/**
	 * @param mixed $Month
	 */
	public function setMonth($Month){
		$this->setField(iribfinance_paymentlicenceEntity::$MONTH,$Month);
	}
	public static $PAY_DATE="pay_date";
	/**
	 * @return mixed
	 */
	public function getPay_date(){
		return $this->getField(iribfinance_paymentlicenceEntity::$PAY_DATE);
	}
	/**
	 * @param mixed $Pay_date
	 */
	public function setPay_date($Pay_date){
		$this->setField(iribfinance_paymentlicenceEntity::$PAY_DATE,$Pay_date);
	}
	public static $WORK="work";
	/**
	 * @return mixed
	 */
	public function getWork(){
		return $this->getField(iribfinance_paymentlicenceEntity::$WORK);
	}
	/**
	 * @param mixed $Work
	 */
	public function setWork($Work){
		$this->setField(iribfinance_paymentlicenceEntity::$WORK,$Work);
	}
	public static $DECREMENTTIME="decrementtime";
	/**
	 * @return mixed
	 */
	public function getDecrementtime(){
		return $this->getField(iribfinance_paymentlicenceEntity::$DECREMENTTIME);
	}
	/**
	 * @param mixed $Decrementtime
	 */
	public function setDecrementtime($Decrementtime){
		$this->setField(iribfinance_paymentlicenceEntity::$DECREMENTTIME,$Decrementtime);
	}
	public static $WORKFACTOR="workfactor";
	/**
	 * @return mixed
	 */
	public function getWorkfactor(){
		return $this->getField(iribfinance_paymentlicenceEntity::$WORKFACTOR);
	}
	/**
	 * @param mixed $Workfactor
	 */
	public function setWorkfactor($Workfactor){
		$this->setField(iribfinance_paymentlicenceEntity::$WORKFACTOR,$Workfactor);
	}
}
?>