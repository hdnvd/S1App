<?php
namespace Modules\ocms\Entity;
use core\CoreClasses\db\DBField;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-03 - 2018-01-23 18:57
*@lastUpdate 1396-11-03 - 2018-01-23 18:57
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class ocms_doctorreserveEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("ocms_doctorreserve");
		$this->setTableTitle("ocms_doctorreserve");
		$this->setTitleFieldName("id");

		/******** doctorplan_fid ********/
		$Doctorplan_fidInfo=new FieldInfo();
		$Doctorplan_fidInfo->setTitle("doctorplan_fid");
		$this->setFieldInfo(ocms_doctorreserveEntity::$DOCTORPLAN_FID,$Doctorplan_fidInfo);
		$this->addTableField('1',ocms_doctorreserveEntity::$DOCTORPLAN_FID);

		/******** financial_transaction_fid ********/
		$Financial_transaction_fidInfo=new FieldInfo();
		$Financial_transaction_fidInfo->setTitle("financial_transaction_fid");
		$this->setFieldInfo(ocms_doctorreserveEntity::$FINANCIAL_TRANSACTION_FID,$Financial_transaction_fidInfo);
		$this->addTableField('2',ocms_doctorreserveEntity::$FINANCIAL_TRANSACTION_FID);

		/******** financial_canceltransaction_fid ********/
		$Financial_canceltransaction_fidInfo=new FieldInfo();
		$Financial_canceltransaction_fidInfo->setTitle("financial_canceltransaction_fid");
		$this->setFieldInfo(ocms_doctorreserveEntity::$FINANCIAL_CANCELTRANSACTION_FID,$Financial_canceltransaction_fidInfo);
		$this->addTableField('3',ocms_doctorreserveEntity::$FINANCIAL_CANCELTRANSACTION_FID);

		/******** presencetype_fid ********/
		$Presencetype_fidInfo=new FieldInfo();
		$Presencetype_fidInfo->setTitle("presencetype_fid");
		$this->setFieldInfo(ocms_doctorreserveEntity::$PRESENCETYPE_FID,$Presencetype_fidInfo);
		$this->addTableField('4',ocms_doctorreserveEntity::$PRESENCETYPE_FID);

		/******** reserve_date ********/
		$Reserve_dateInfo=new FieldInfo();
		$Reserve_dateInfo->setTitle("reserve_date");
		$this->setFieldInfo(ocms_doctorreserveEntity::$RESERVE_DATE,$Reserve_dateInfo);
		$this->addTableField('5',ocms_doctorreserveEntity::$RESERVE_DATE);

		/******** role_systemuser_fid ********/
		$Role_systemuser_fidInfo=new FieldInfo();
		$Role_systemuser_fidInfo->setTitle("role_systemuser_fid");
		$this->setFieldInfo(ocms_doctorreserveEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fidInfo);
		$this->addTableField('6',ocms_doctorreserveEntity::$ROLE_SYSTEMUSER_FID);
	}
	public static $DOCTORPLAN_FID="doctorplan_fid";
	/**
	 * @return mixed
	 */
	public function getDoctorplan_fid(){
		return $this->getField(ocms_doctorreserveEntity::$DOCTORPLAN_FID);
	}
	/**
	 * @param mixed $Doctorplan_fid
	 */
	public function setDoctorplan_fid($Doctorplan_fid){
		$this->setField(ocms_doctorreserveEntity::$DOCTORPLAN_FID,$Doctorplan_fid);
	}
	public static $FINANCIAL_TRANSACTION_FID="financial_transaction_fid";
	/**
	 * @return mixed
	 */
	public function getFinancial_transaction_fid(){
		return $this->getField(ocms_doctorreserveEntity::$FINANCIAL_TRANSACTION_FID);
	}
	/**
	 * @param mixed $Financial_transaction_fid
	 */
	public function setFinancial_transaction_fid($Financial_transaction_fid){
		$this->setField(ocms_doctorreserveEntity::$FINANCIAL_TRANSACTION_FID,$Financial_transaction_fid);
	}
	public static $FINANCIAL_CANCELTRANSACTION_FID="financial_canceltransaction_fid";
	/**
	 * @return mixed
	 */
	public function getFinancial_canceltransaction_fid(){
		return $this->getField(ocms_doctorreserveEntity::$FINANCIAL_CANCELTRANSACTION_FID);
	}
	/**
	 * @param mixed $Financial_canceltransaction_fid
	 */
	public function setFinancial_canceltransaction_fid($Financial_canceltransaction_fid){
		$this->setField(ocms_doctorreserveEntity::$FINANCIAL_CANCELTRANSACTION_FID,$Financial_canceltransaction_fid);
	}
	public static $PRESENCETYPE_FID="presencetype_fid";
	/**
	 * @return mixed
	 */
	public function getPresencetype_fid(){
		return $this->getField(ocms_doctorreserveEntity::$PRESENCETYPE_FID);
	}
	/**
	 * @param mixed $Presencetype_fid
	 */
	public function setPresencetype_fid($Presencetype_fid){
		$this->setField(ocms_doctorreserveEntity::$PRESENCETYPE_FID,$Presencetype_fid);
	}
	public static $RESERVE_DATE="reserve_date";
	/**
	 * @return mixed
	 */
	public function getReserve_date(){
		return $this->getField(ocms_doctorreserveEntity::$RESERVE_DATE);
	}
	/**
	 * @param mixed $Reserve_date
	 */
	public function setReserve_date($Reserve_date){
		$this->setField(ocms_doctorreserveEntity::$RESERVE_DATE,$Reserve_date);
	}
	public static $ROLE_SYSTEMUSER_FID="role_systemuser_fid";
	/**
	 * @return mixed
	 */
	public function getRole_systemuser_fid(){
		return $this->getField(ocms_doctorreserveEntity::$ROLE_SYSTEMUSER_FID);
	}
	/**
	 * @param mixed $Role_systemuser_fid
	 */
	public function setRole_systemuser_fid($Role_systemuser_fid){
		$this->setField(ocms_doctorreserveEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fid);
	}
    public function getDoctorReserves($DoctorID,$Limit,$SelectCount)
    {
        $Fields=array("dp.start_time as start_time","us.family as family",'us.mobile mobile');
        if($SelectCount)
            $Fields=array("count(dp.start_time) as count");
        $SelectQuery=$this->getDatabase()->Select($Fields)->From(["ocms_doctorplan dp",'ocms_doctorreserve res','users_user us','ocms_presencetype pt'])->Where()
            ->Equal('res.doctorplan_fid',new DBField("dp.id",false));
        $SelectQuery=$SelectQuery->AndLogic()->Equal('res.role_systemuser_fid',new DBField("us.role_systemuser_fid",false));
        $SelectQuery=$SelectQuery->AndLogic()->Equal('res.presencetype_fid',new DBField("pt.id",false));
        $SelectQuery=$SelectQuery->AndLogic()->Smaller('res.financial_canceltransaction_fid','1');
        $SelectQuery=$SelectQuery->AndLogic()->Equal('dp.doctor_fid',$DoctorID);
        $SelectQuery=$SelectQuery->AddOrderBy('dp.start_time',false);
        if($Limit!=null)
            $SelectQuery->setLimit($Limit);
//        echo $SelectQuery->getQueryString();
        $result=$SelectQuery->ExecuteAssociated();
        return $result;
    }
}
?>