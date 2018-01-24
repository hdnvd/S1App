<?php
namespace Modules\ocms\Entity;
use core\CoreClasses\db\DBField;
use core\CoreClasses\db\selectQuery;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-23 - 2017-12-14 01:17
*@lastUpdate 1396-09-23 - 2017-12-14 01:17
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class ocms_doctorplanEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("ocms_doctorplan");
        $this->setTableTitle("برنامه ویزیت");
		$this->setTitleFieldName("id");

		/******** start_time ********/
		$Start_timeInfo=new FieldInfo();
		$Start_timeInfo->setTitle("ساعت شروع");
		$this->setFieldInfo(ocms_doctorplanEntity::$START_TIME,$Start_timeInfo);
		$this->addTableField('1',ocms_doctorplanEntity::$START_TIME);

		/******** end_time ********/
		$End_timeInfo=new FieldInfo();
		$End_timeInfo->setTitle("ساعت پایان");
		$this->setFieldInfo(ocms_doctorplanEntity::$END_TIME,$End_timeInfo);
		$this->addTableField('2',ocms_doctorplanEntity::$END_TIME);

		/******** doctor_fid ********/
		$Doctor_fidInfo=new FieldInfo();
		$Doctor_fidInfo->setTitle("doctor_fid");
		$this->setFieldInfo(ocms_doctorplanEntity::$DOCTOR_FID,$Doctor_fidInfo);
		$this->addTableField('3',ocms_doctorplanEntity::$DOCTOR_FID);
	}
	public static $START_TIME="start_time";
	/**
	 * @return mixed
	 */
	public function getStart_time(){
		return $this->getField(ocms_doctorplanEntity::$START_TIME);
	}
	/**
	 * @param mixed $Start_time
	 */
	public function setStart_time($Start_time){
		$this->setField(ocms_doctorplanEntity::$START_TIME,$Start_time);
	}
	public static $END_TIME="end_time";
	/**
	 * @return mixed
	 */
	public function getEnd_time(){
		return $this->getField(ocms_doctorplanEntity::$END_TIME);
	}
	/**
	 * @param mixed $End_time
	 */
	public function setEnd_time($End_time){
		$this->setField(ocms_doctorplanEntity::$END_TIME,$End_time);
	}
	public static $DOCTOR_FID="doctor_fid";
	/**
	 * @return mixed
	 */
	public function getDoctor_fid(){
		return $this->getField(ocms_doctorplanEntity::$DOCTOR_FID);
	}
	/**
	 * @param mixed $Doctor_fid
	 */
	public function setDoctor_fid($Doctor_fid){
		$this->setField(ocms_doctorplanEntity::$DOCTOR_FID,$Doctor_fid);
	}


	public function getDoctorFreePlans($DoctorID,$StartTime,$EndTime)
    {
        //SELECT * FROM `sweetp_ocms_doctorplan` dp LEFT JOIN sweetp_ocms_doctorreserve dr on dp.id=dr.doctorplan_fid where dr.doctorplan_fid IS NULL
        $SelectQuery=$this->getDatabase()->Select(array("dp.*"))->From("ocms_doctorplan dp LEFT JOIN (SELECT * from sweetp_ocms_doctorreserve WHERE sweetp_ocms_doctorreserve.financial_canceltransaction_fid<0)dr on dp.id=dr.doctorplan_fid")->Where()->ISNULL(new DBField("dr.doctorplan_fid",false));
        $SelectQuery=$SelectQuery->AndLogic()->Equal('dp.doctor_fid',$DoctorID);
        if($StartTime!=null)
        $SelectQuery=$SelectQuery->AndLogic()->Bigger('dp.start_time',$StartTime);
        if($EndTime!=null)
        $SelectQuery=$SelectQuery->AndLogic()->Smaller('dp.start_time',$EndTime);
//        $SelectQuery=new selectQuery();
        $SelectQuery=$SelectQuery->AddOrderBy('dp.start_time',false);
        $result=$SelectQuery->ExecuteAssociated();
        $AllCount1 = count($result);
        $res=array();
        for ($i = 0; $i < $AllCount1; $i++) {
            $item=new ocms_doctorplanEntity($this->getDatabase()->getDBAccessor());
            $item->loadFromArray($result[$i]);
            $res[$i]=$item;
        }
//        echo  $SelectQuery->getQueryString();
return $res;
    }
}
?>