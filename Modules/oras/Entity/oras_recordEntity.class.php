<?php
namespace Modules\oras\Entity;
use core\CoreClasses\db\DBField;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-12 - 2017-10-04 03:01
*@lastUpdate 1396-07-12 - 2017-10-04 03:01
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class oras_recordEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("oras_record");
		$this->setTableTitle("گزارش");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("عنوان");
		$TitleInfo->setRequired(true);
		$this->setFieldInfo(oras_recordEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',oras_recordEntity::$TITLE);

		/******** occurance_date ********/
		$Occurance_dateInfo=new FieldInfo();
		$Occurance_dateInfo->setTitle("تاریخ گزارش");
		$this->setFieldInfo(oras_recordEntity::$OCCURANCE_DATE,$Occurance_dateInfo);
		$this->addTableField('2',oras_recordEntity::$OCCURANCE_DATE);

		/******** description ********/
		$DescriptionInfo=new FieldInfo();
		$DescriptionInfo->setTitle("توضیحات");
		$this->setFieldInfo(oras_recordEntity::$DESCRIPTION,$DescriptionInfo);
		$this->addTableField('3',oras_recordEntity::$DESCRIPTION);

		/******** shifttype_fid ********/
		$Shifttype_fidInfo=new FieldInfo();
		$Shifttype_fidInfo->setTitle("شیفت");
		$this->setFieldInfo(oras_recordEntity::$SHIFTTYPE_FID,$Shifttype_fidInfo);
		$this->addTableField('4',oras_recordEntity::$SHIFTTYPE_FID);

		/******** recordtype_fid ********/
		$Recordtype_fidInfo=new FieldInfo();
		$Recordtype_fidInfo->setTitle("سرفصل گزارش");
		$this->setFieldInfo(oras_recordEntity::$RECORDTYPE_FID,$Recordtype_fidInfo);
		$this->addTableField('5',oras_recordEntity::$RECORDTYPE_FID);

		/******** employee_fid ********/
		$Employee_fidInfo=new FieldInfo();
		$Employee_fidInfo->setTitle("کارمند");
		$this->setFieldInfo(oras_recordEntity::$EMPLOYEE_FID,$Employee_fidInfo);
		$this->addTableField('6',oras_recordEntity::$EMPLOYEE_FID);

		/******** place_fid ********/
		$Place_fidInfo=new FieldInfo();
		$Place_fidInfo->setTitle("بخش");
		$this->setFieldInfo(oras_recordEntity::$PLACE_FID,$Place_fidInfo);
		$this->addTableField('7',oras_recordEntity::$PLACE_FID);

		/******** registration_time ********/
		$Registration_timeInfo=new FieldInfo();
		$Registration_timeInfo->setTitle("تاریخ ثبت در سیستم");
		$this->setFieldInfo(oras_recordEntity::$REGISTRATION_TIME,$Registration_timeInfo);
		$this->addTableField('8',oras_recordEntity::$REGISTRATION_TIME);

		/******** file1_flu ********/
		$File1_fluInfo=new FieldInfo();
		$File1_fluInfo->setTitle("سند 1");
		$this->setFieldInfo(oras_recordEntity::$FILE1_FLU,$File1_fluInfo);
		$this->addTableField('9',oras_recordEntity::$FILE1_FLU);

		/******** file2_flu ********/
		$File2_fluInfo=new FieldInfo();
		$File2_fluInfo->setTitle("سند 2");
		$this->setFieldInfo(oras_recordEntity::$FILE2_FLU,$File2_fluInfo);
		$this->addTableField('10',oras_recordEntity::$FILE2_FLU);

		/******** file3_flu ********/
		$File3_fluInfo=new FieldInfo();
		$File3_fluInfo->setTitle("سند 3");
		$this->setFieldInfo(oras_recordEntity::$FILE3_FLU,$File3_fluInfo);
		$this->addTableField('11',oras_recordEntity::$FILE3_FLU);

		/******** file4_flu ********/
		$File4_fluInfo=new FieldInfo();
		$File4_fluInfo->setTitle("سند 4");
		$this->setFieldInfo(oras_recordEntity::$FILE4_FLU,$File4_fluInfo);
		$this->addTableField('12',oras_recordEntity::$FILE4_FLU);

		/******** role_systemuser_fid ********/
		$Role_systemuser_fidInfo=new FieldInfo();
		$Role_systemuser_fidInfo->setTitle("کاربر ثبت کننده");
		$this->setFieldInfo(oras_recordEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fidInfo);
		$this->addTableField('13',oras_recordEntity::$ROLE_SYSTEMUSER_FID);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(oras_recordEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(oras_recordEntity::$TITLE,$Title);
	}
	public static $OCCURANCE_DATE="occurance_date";
	/**
	 * @return mixed
	 */
	public function getOccurance_date(){
		return $this->getField(oras_recordEntity::$OCCURANCE_DATE);
	}
	/**
	 * @param mixed $Occurance_date
	 */
	public function setOccurance_date($Occurance_date){
		$this->setField(oras_recordEntity::$OCCURANCE_DATE,$Occurance_date);
	}
	public static $DESCRIPTION="description";
	/**
	 * @return mixed
	 */
	public function getDescription(){
		return $this->getField(oras_recordEntity::$DESCRIPTION);
	}
	/**
	 * @param mixed $Description
	 */
	public function setDescription($Description){
		$this->setField(oras_recordEntity::$DESCRIPTION,$Description);
	}
	public static $SHIFTTYPE_FID="shifttype_fid";
	/**
	 * @return mixed
	 */
	public function getShifttype_fid(){
		return $this->getField(oras_recordEntity::$SHIFTTYPE_FID);
	}
	/**
	 * @param mixed $Shifttype_fid
	 */
	public function setShifttype_fid($Shifttype_fid){
		$this->setField(oras_recordEntity::$SHIFTTYPE_FID,$Shifttype_fid);
	}
	public static $RECORDTYPE_FID="recordtype_fid";
	/**
	 * @return mixed
	 */
	public function getRecordtype_fid(){
		return $this->getField(oras_recordEntity::$RECORDTYPE_FID);
	}
	/**
	 * @param mixed $Recordtype_fid
	 */
	public function setRecordtype_fid($Recordtype_fid){
		$this->setField(oras_recordEntity::$RECORDTYPE_FID,$Recordtype_fid);
	}
	public static $EMPLOYEE_FID="employee_fid";
	/**
	 * @return mixed
	 */
	public function getEmployee_fid(){
		return $this->getField(oras_recordEntity::$EMPLOYEE_FID);
	}
	/**
	 * @param mixed $Employee_fid
	 */
	public function setEmployee_fid($Employee_fid){
		$this->setField(oras_recordEntity::$EMPLOYEE_FID,$Employee_fid);
	}
	public static $PLACE_FID="place_fid";
	/**
	 * @return mixed
	 */
	public function getPlace_fid(){
		return $this->getField(oras_recordEntity::$PLACE_FID);
	}
	/**
	 * @param mixed $Place_fid
	 */
	public function setPlace_fid($Place_fid){
		$this->setField(oras_recordEntity::$PLACE_FID,$Place_fid);
	}
	public static $REGISTRATION_TIME="registration_time";
	/**
	 * @return mixed
	 */
	public function getRegistration_time(){
		return $this->getField(oras_recordEntity::$REGISTRATION_TIME);
	}
	/**
	 * @param mixed $Registration_time
	 */
	public function setRegistration_time($Registration_time){
		$this->setField(oras_recordEntity::$REGISTRATION_TIME,$Registration_time);
	}
	public static $FILE1_FLU="file1_flu";
	/**
	 * @return mixed
	 */
	public function getFile1_flu(){
		return $this->getField(oras_recordEntity::$FILE1_FLU);
	}
	/**
	 * @param mixed $File1_flu
	 */
	public function setFile1_flu($File1_flu){
		$this->setField(oras_recordEntity::$FILE1_FLU,$File1_flu);
	}
	public static $FILE2_FLU="file2_flu";
	/**
	 * @return mixed
	 */
	public function getFile2_flu(){
		return $this->getField(oras_recordEntity::$FILE2_FLU);
	}
	/**
	 * @param mixed $File2_flu
	 */
	public function setFile2_flu($File2_flu){
		$this->setField(oras_recordEntity::$FILE2_FLU,$File2_flu);
	}
	public static $FILE3_FLU="file3_flu";
	/**
	 * @return mixed
	 */
	public function getFile3_flu(){
		return $this->getField(oras_recordEntity::$FILE3_FLU);
	}
	/**
	 * @param mixed $File3_flu
	 */
	public function setFile3_flu($File3_flu){
		$this->setField(oras_recordEntity::$FILE3_FLU,$File3_flu);
	}
	public static $FILE4_FLU="file4_flu";
	/**
	 * @return mixed
	 */
	public function getFile4_flu(){
		return $this->getField(oras_recordEntity::$FILE4_FLU);
	}
	/**
	 * @param mixed $File4_flu
	 */
	public function setFile4_flu($File4_flu){
		$this->setField(oras_recordEntity::$FILE4_FLU,$File4_flu);
	}
	public static $ROLE_SYSTEMUSER_FID="role_systemuser_fid";
	/**
	 * @return mixed
	 */
	public function getRole_systemuser_fid(){
		return $this->getField(oras_recordEntity::$ROLE_SYSTEMUSER_FID);
	}
	/**
	 * @param mixed $Role_systemuser_fid
	 */
	public function setRole_systemuser_fid($Role_systemuser_fid){
		$this->setField(oras_recordEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fid);
	}

//    /**
//     * @param QueryLogic $QueryObject
//     * @return EntityClass[]
//     */
//    public function FullFind(QueryLogic $QueryObject)
//    {
//        $resFields= "rec.*";
//        $resFields=new DBField($resFields,false);
//        $SelectQuery=$this->getSelectQuery();
//        $SelectQuery=$this->getDatabase()->Select(array($resFields))->From(array($this->getTableName() . " rec",'oras_recordtype tp'))->Where()->Smaller("rec.deletetime", "1")
//        ->AndLogic()->Smaller("tp.deletetime", "1")
//        ->AndLogic()->Equal( "recordtype_fid", new DBField("tp.id",false));
//        $this->fillSelectParams($QueryObject);
////        echo $SelectQuery->getQueryString() . "\n";
////        die();
//        $results= $SelectQuery->ExecuteAssociated();
//        $Objects=array();
//        for($i=0;$i<count($results);$i++)
//        {
//            $class=get_class($this);
//            $Objects[$i]=new $class($this->getDatabase()->getDBAccessor(),$this->getTableName());
//            $Objects[$i]->loadFromArray($results[$i]);
//
//        }
//        return $Objects;
//    }
}
?>