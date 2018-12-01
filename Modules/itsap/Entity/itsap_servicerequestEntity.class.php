<?php
namespace Modules\itsap\Entity;
use core\CoreClasses\db\DBField;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-08-01 - 2018-10-23 03:04
*@lastUpdate 1397-08-01 - 2018-10-23 03:04
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class itsap_servicerequestEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
        $this->setDatabase(new dbquery($DBAccessor));
        $this->setTableName("itsap_servicerequest");
        $this->setTableTitle("درخواست");
        $this->setTitleFieldName("title");

        /******** title ********/
        $TitleInfo=new FieldInfo();
        $TitleInfo->setTitle("عنوان");
        $this->setFieldInfo(itsap_servicerequestEntity::$TITLE,$TitleInfo);
        $this->addTableField('1',itsap_servicerequestEntity::$TITLE);

        /******** role_systemuser_fid ********/
        $Role_systemuser_fidInfo=new FieldInfo();
        $Role_systemuser_fidInfo->setTitle("ثبت کننده");
        $this->setFieldInfo(itsap_servicerequestEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fidInfo);
        $this->addTableField('2',itsap_servicerequestEntity::$ROLE_SYSTEMUSER_FID);

        /******** unit_fid ********/
        $Unit_fidInfo=new FieldInfo();
        $Unit_fidInfo->setTitle("بخش");
        $this->setFieldInfo(itsap_servicerequestEntity::$UNIT_FID,$Unit_fidInfo);
        $this->addTableField('3',itsap_servicerequestEntity::$UNIT_FID);

        /******** servicetype_fid ********/
        $Servicetype_fidInfo=new FieldInfo();
        $Servicetype_fidInfo->setTitle("نوع خدمات");
        $this->setFieldInfo(itsap_servicerequestEntity::$SERVICETYPE_FID,$Servicetype_fidInfo);
        $this->addTableField('4',itsap_servicerequestEntity::$SERVICETYPE_FID);

        /******** description ********/
        $DescriptionInfo=new FieldInfo();
        $DescriptionInfo->setTitle("شرح خدمات");
        $this->setFieldInfo(itsap_servicerequestEntity::$DESCRIPTION,$DescriptionInfo);
        $this->addTableField('5',itsap_servicerequestEntity::$DESCRIPTION);

        /******** priority ********/
        $PriorityInfo=new FieldInfo();
        $PriorityInfo->setTitle("اولویت");
        $this->setFieldInfo(itsap_servicerequestEntity::$PRIORITY,$PriorityInfo);
        $this->addTableField('6',itsap_servicerequestEntity::$PRIORITY);

        /******** file1_flu ********/
        $File1_fluInfo=new FieldInfo();
        $File1_fluInfo->setTitle("فایل پیوستی");
        $this->setFieldInfo(itsap_servicerequestEntity::$FILE1_FLU,$File1_fluInfo);
        $this->addTableField('7',itsap_servicerequestEntity::$FILE1_FLU);

        /******** request_date ********/
        $Request_dateInfo=new FieldInfo();
        $Request_dateInfo->setTitle("تاریخ درخواست");
        $this->setFieldInfo(itsap_servicerequestEntity::$REQUEST_DATE,$Request_dateInfo);
        $this->addTableField('8',itsap_servicerequestEntity::$REQUEST_DATE);


        /******** letterfile_flu ********/
        $Letterfile_fluInfo=new FieldInfo();
        $Letterfile_fluInfo->setTitle("عکس حکم کار");
        $this->setFieldInfo(itsap_servicerequestEntity::$LETTERFILE_FLU,$Letterfile_fluInfo);
        $this->addTableField('9',itsap_servicerequestEntity::$LETTERFILE_FLU);

        /******** securityacceptor_role_systemuser_fid ********/
        $Securityacceptor_role_systemuser_fidInfo=new FieldInfo();
        $Securityacceptor_role_systemuser_fidInfo->setTitle("تایید کننده");
        $this->setFieldInfo(itsap_servicerequestEntity::$SECURITYACCEPTOR_ROLE_SYSTEMUSER_FID,$Securityacceptor_role_systemuser_fidInfo);
        $this->addTableField('10',itsap_servicerequestEntity::$SECURITYACCEPTOR_ROLE_SYSTEMUSER_FID);

        /******** is_securityaccepted ********/
        $Is_securityacceptedInfo=new FieldInfo();
        $Is_securityacceptedInfo->setTitle("تایید شده توسط حراست");
        $this->setFieldInfo(itsap_servicerequestEntity::$IS_SECURITYACCEPTED,$Is_securityacceptedInfo);
        $this->addTableField('11',itsap_servicerequestEntity::$IS_SECURITYACCEPTED);

        /******** securityacceptancemessage ********/
        $SecurityacceptancemessageInfo=new FieldInfo();
        $SecurityacceptancemessageInfo->setTitle("پیام حراست");
        $this->setFieldInfo(itsap_servicerequestEntity::$SECURITYACCEPTANCEMESSAGE,$SecurityacceptancemessageInfo);
        $this->addTableField('12',itsap_servicerequestEntity::$SECURITYACCEPTANCEMESSAGE);
        /******** securityacceptance_date ********/
        $Securityacceptance_dateInfo=new FieldInfo();
        $Securityacceptance_dateInfo->setTitle("تاریخ بررسی توسط حراست");
        $this->setFieldInfo(itsap_servicerequestEntity::$SECURITYACCEPTANCE_DATE,$Securityacceptance_dateInfo);
        $this->addTableField('13',itsap_servicerequestEntity::$SECURITYACCEPTANCE_DATE);

        /******** letternumber ********/
        $LetternumberInfo=new FieldInfo();
        $LetternumberInfo->setTitle("شماره نامه");
        $this->setFieldInfo(itsap_servicerequestEntity::$LETTERNUMBER,$LetternumberInfo);
        $this->addTableField('14',itsap_servicerequestEntity::$LETTERNUMBER);

        /******** letter_date ********/
        $Letter_dateInfo=new FieldInfo();
        $Letter_dateInfo->setTitle("تاریخ نامه");
        $this->setFieldInfo(itsap_servicerequestEntity::$LETTER_DATE,$Letter_dateInfo);
        $this->addTableField('15',itsap_servicerequestEntity::$LETTER_DATE);
		/******** last_servicestatus_fid ********/
		$Last_servicestatus_fidInfo=new FieldInfo();
		$Last_servicestatus_fidInfo->setTitle("آخرین وضعیت");
		$this->setFieldInfo(itsap_servicerequestEntity::$LAST_SERVICESTATUS_FID,$Last_servicestatus_fidInfo);
		$this->addTableField('16',itsap_servicerequestEntity::$LAST_SERVICESTATUS_FID);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(itsap_servicerequestEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(itsap_servicerequestEntity::$TITLE,$Title);
	}
	public static $ROLE_SYSTEMUSER_FID="role_systemuser_fid";
	/**
	 * @return mixed
	 */
	public function getRole_systemuser_fid(){
		return $this->getField(itsap_servicerequestEntity::$ROLE_SYSTEMUSER_FID);
	}
	/**
	 * @param mixed $Role_systemuser_fid
	 */
	public function setRole_systemuser_fid($Role_systemuser_fid){
		$this->setField(itsap_servicerequestEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fid);
	}
	public static $UNIT_FID="unit_fid";
	/**
	 * @return mixed
	 */
	public function getUnit_fid(){
		return $this->getField(itsap_servicerequestEntity::$UNIT_FID);
	}
	/**
	 * @param mixed $Unit_fid
	 */
	public function setUnit_fid($Unit_fid){
		$this->setField(itsap_servicerequestEntity::$UNIT_FID,$Unit_fid);
	}
	public static $SERVICETYPE_FID="servicetype_fid";
	/**
	 * @return mixed
	 */
	public function getServicetype_fid(){
		return $this->getField(itsap_servicerequestEntity::$SERVICETYPE_FID);
	}
	/**
	 * @param mixed $Servicetype_fid
	 */
	public function setServicetype_fid($Servicetype_fid){
		$this->setField(itsap_servicerequestEntity::$SERVICETYPE_FID,$Servicetype_fid);
	}
	public static $DESCRIPTION="description";
	/**
	 * @return mixed
	 */
	public function getDescription(){
		return $this->getField(itsap_servicerequestEntity::$DESCRIPTION);
	}
	/**
	 * @param mixed $Description
	 */
	public function setDescription($Description){
		$this->setField(itsap_servicerequestEntity::$DESCRIPTION,$Description);
	}
	public static $PRIORITY="priority";
	/**
	 * @return mixed
	 */
	public function getPriority(){
		return $this->getField(itsap_servicerequestEntity::$PRIORITY);
	}
	/**
	 * @param mixed $Priority
	 */
	public function setPriority($Priority){
		$this->setField(itsap_servicerequestEntity::$PRIORITY,$Priority);
	}
	public static $FILE1_FLU="file1_flu";
	/**
	 * @return mixed
	 */
	public function getFile1_flu(){
		return $this->getField(itsap_servicerequestEntity::$FILE1_FLU);
	}
	/**
	 * @param mixed $File1_flu
	 */
	public function setFile1_flu($File1_flu){
		$this->setField(itsap_servicerequestEntity::$FILE1_FLU,$File1_flu);
	}
	public static $REQUEST_DATE="request_date";
	/**
	 * @return mixed
	 */
	public function getRequest_date(){
		return $this->getField(itsap_servicerequestEntity::$REQUEST_DATE);
	}
	/**
	 * @param mixed $Request_date
	 */
	public function setRequest_date($Request_date){
		$this->setField(itsap_servicerequestEntity::$REQUEST_DATE,$Request_date);
	}
	public static $LETTERFILE_FLU="letterfile_flu";
	/**
	 * @return mixed
	 */
	public function getLetterfile_flu(){
		return $this->getField(itsap_servicerequestEntity::$LETTERFILE_FLU);
	}
	/**
	 * @param mixed $Letterfile_flu
	 */
	public function setLetterfile_flu($Letterfile_flu){
		$this->setField(itsap_servicerequestEntity::$LETTERFILE_FLU,$Letterfile_flu);
	}
	public static $SECURITYACCEPTOR_ROLE_SYSTEMUSER_FID="securityacceptor_role_systemuser_fid";
	/**
	 * @return mixed
	 */
	public function getSecurityacceptor_role_systemuser_fid(){
		return $this->getField(itsap_servicerequestEntity::$SECURITYACCEPTOR_ROLE_SYSTEMUSER_FID);
	}
	/**
	 * @param mixed $Securityacceptor_role_systemuser_fid
	 */
	public function setSecurityacceptor_role_systemuser_fid($Securityacceptor_role_systemuser_fid){
		$this->setField(itsap_servicerequestEntity::$SECURITYACCEPTOR_ROLE_SYSTEMUSER_FID,$Securityacceptor_role_systemuser_fid);
	}
	public static $IS_SECURITYACCEPTED="is_securityaccepted";
	/**
	 * @return mixed
	 */
	public function getIs_securityaccepted(){
		return $this->getField(itsap_servicerequestEntity::$IS_SECURITYACCEPTED);
	}
	/**
	 * @param mixed $Is_securityaccepted
	 */
	public function setIs_securityaccepted($Is_securityaccepted){
		$this->setField(itsap_servicerequestEntity::$IS_SECURITYACCEPTED,$Is_securityaccepted);
	}
	public static $SECURITYACCEPTANCEMESSAGE="securityacceptancemessage";
	/**
	 * @return mixed
	 */
	public function getSecurityacceptancemessage(){
		return $this->getField(itsap_servicerequestEntity::$SECURITYACCEPTANCEMESSAGE);
	}
	/**
	 * @param mixed $Securityacceptancemessage
	 */
	public function setSecurityacceptancemessage($Securityacceptancemessage){
		$this->setField(itsap_servicerequestEntity::$SECURITYACCEPTANCEMESSAGE,$Securityacceptancemessage);
	}
	public static $SECURITYACCEPTANCE_DATE="securityacceptance_date";
	/**
	 * @return mixed
	 */
	public function getSecurityacceptance_date(){
		return $this->getField(itsap_servicerequestEntity::$SECURITYACCEPTANCE_DATE);
	}
	/**
	 * @param mixed $Securityacceptance_date
	 */
	public function setSecurityacceptance_date($Securityacceptance_date){
		$this->setField(itsap_servicerequestEntity::$SECURITYACCEPTANCE_DATE,$Securityacceptance_date);
	}
	public static $LETTERNUMBER="letternumber";
	/**
	 * @return mixed
	 */
	public function getLetternumber(){
		return $this->getField(itsap_servicerequestEntity::$LETTERNUMBER);
	}
	/**
	 * @param mixed $Letternumber
	 */
	public function setLetternumber($Letternumber){
		$this->setField(itsap_servicerequestEntity::$LETTERNUMBER,$Letternumber);
	}
	public static $LETTER_DATE="letter_date";
	/**
	 * @return mixed
	 */
	public function getLetter_date(){
		return $this->getField(itsap_servicerequestEntity::$LETTER_DATE);
	}
	/**
	 * @param mixed $Letter_date
	 */
	public function setLetter_date($Letter_date){
		$this->setField(itsap_servicerequestEntity::$LETTER_DATE,$Letter_date);
	}
	public static $LAST_SERVICESTATUS_FID="last_servicestatus_fid";
	/**
	 * @return mixed
	 */
	public function getLast_servicestatus_fid(){
		return $this->getField(itsap_servicerequestEntity::$LAST_SERVICESTATUS_FID);
	}
	/**
	 * @param mixed $Last_servicestatus_fid
	 */
	public function setLast_servicestatus_fid($Last_servicestatus_fid){
		$this->setField(itsap_servicerequestEntity::$LAST_SERVICESTATUS_FID,$Last_servicestatus_fid);
	}


    public function getRequests($isSecurity,$IsFava,$IsAdmin,$EmployeeID,$TopUnitID,$UnitID,QueryLogic $AdditionalQuery,$Limit,$LoadOnlyCount)
    {
        if($isSecurity)
        {
            return $this->getSecurityAcceptorRequests($EmployeeID,$TopUnitID,$UnitID,$AdditionalQuery,$Limit,$LoadOnlyCount);
        }
        if($IsFava)
        {
            if($IsAdmin)
                return $this->getITAdminRequests($EmployeeID,$TopUnitID,$UnitID,$AdditionalQuery,$Limit,$LoadOnlyCount);
            else
                return $this->getITUserRequests($EmployeeID,$TopUnitID,$UnitID,$AdditionalQuery,$Limit,$LoadOnlyCount);
        }
        else
        {
            return $this->getNonITUserRequests($EmployeeID,$TopUnitID,$UnitID,$AdditionalQuery,$Limit,$LoadOnlyCount);
        }
    }
    private function getNonITUserRequests($EmployeeID,$TopUnitID,$UnitID,QueryLogic $AdditionalQuery,$Limit,$LoadOnlyCount)
    {

        if($LoadOnlyCount)
            $sq=$this->getDatabase()->Select("count(DISTINCT sr.id) allcount");
        else
            $sq=$this->getDatabase()->Select("sr.*");

        $sq=$sq->From(array('itsap_servicerequest sr'))->Where()->Equal(new DBField('sr.unit_fid',false),$UnitID);
        if($Limit!=null)
            $sq=$sq->setLimit($Limit);
        if(!$LoadOnlyCount)
        {

            $sq->AddGroupBy('sr.id');
            $res= $sq->ExecuteAssociated();
            $AllCount1 = count($res);
            $result=array();
            for ($i = 0; $i < $AllCount1; $i++) {
                $item=$res[$i];
                $obj=new itsap_servicerequestEntity($this->getDatabase()->getDBAccessor());
                $obj->loadFromArray($res[$i]);
                $result[$i]=$obj;
            }
        }
        else
        {
            $result= $sq->ExecuteAssociated();
        }
//        echo $sq->getQueryString();
        $this->getDatabase()->getDBAccessor()->close_connection();
        return $result;
    }
    private function getITUserRequests($EmployeeID,$TopUnitID,$UnitID,QueryLogic $AdditionalQuery,$Limit,$LoadOnlyCount)
    {

        if($LoadOnlyCount)
            $sq=$this->getDatabase()->Select("count(DISTINCT sr.id) allcount");
        else
            $sq=$this->getDatabase()->Select("sr.*");

        $sq=$sq->From(array('itsap_servicerequest sr','itsap_reference ref'))->Where()->Equal(new DBField('sr.id',false),new DBField('ref.servicerequest_fid',false));
        $sq=$sq->AndLogic()->Equal(new DBField('ref.employee_fid',false),$EmployeeID);

        if($Limit!=null)
            $sq=$sq->setLimit($Limit);

        if(!$LoadOnlyCount)
        {

            $sq->AddGroupBy('sr.id');
            $res= $sq->ExecuteAssociated();
            $AllCount1 = count($res);
            $result=array();
            for ($i = 0; $i < $AllCount1; $i++) {
                $item=$res[$i];
                $obj=new itsap_servicerequestEntity($this->getDatabase()->getDBAccessor());
                $obj->loadFromArray($res[$i]);
                $result[$i]=$obj;
            }
        }
        else
        {
            $result= $sq->ExecuteAssociated();
        }
//        echo $sq->getQueryString();
        $this->getDatabase()->getDBAccessor()->close_connection();
        return $result;
    }
    private function getITAdminRequests($EmployeeID,$TopUnitID,$UnitID,QueryLogic $AdditionalQuery,$Limit,$LoadOnlyCount)
    {

        return $this->getTopUnitRequests($EmployeeID,$TopUnitID,$UnitID,$AdditionalQuery,true,$Limit,$LoadOnlyCount);
    }
    private function getSecurityAcceptorRequests($EmployeeID,$TopUnitID,$UnitID,QueryLogic $AdditionalQuery,$Limit,$LoadOnlyCount)
    {

        return $this->getTopUnitRequests($EmployeeID,$TopUnitID,$UnitID,$AdditionalQuery,false,$Limit,$LoadOnlyCount);
    }
    private function getTopUnitRequests($EmployeeID,$TopUnitID,$UnitID,QueryLogic $AdditionalQuery,$LoadOnlySecurityAccepted,$Limit,$LoadOnlyCount)
    {

        if($LoadOnlyCount)
            $sq=$this->getDatabase()->Select("count(DISTINCT sr.id) allcount");
        else
            $sq=$this->getDatabase()->Select("sr.*");

        $sq=$sq->From(array('itsap_servicerequest sr','itsap_reference ref','itsap_unit u','itsap_servicerequestdevice device','itsap_servicerequestservicestatus thestatus','itsap_servicetype st'))->Where()->OpenParenthesis()->Equal(new DBField('sr.id',false),new DBField('ref.servicerequest_fid',false));

        $sq=$sq->AndLogic()->OpenParenthesis()->Equal(new DBField('ref.unit_fid',false),$UnitID);
        $sq=$sq->OrLogic()->Equal(new DBField('ref.employee_fid',false),$EmployeeID)->CloseParenthesis()->CloseParenthesis();
        $sq=$sq->OrLogic()->OpenParenthesis()->Equal(new DBField('sr.unit_fid',false),new DBField('u.id',false));
        $sq=$sq->AndLogic()->Equal(new DBField('u.topunit_fid',false),$TopUnitID)->CloseParenthesis();
        $sq=$sq->AndLogic()->Equal(new DBField('sr.last_servicestatus_fid',false),new DBField('thestatus.id',false));
        $sq=$sq->AndLogic()->Equal(new DBField('sr.servicetype_fid',false),new DBField('st.id',false));
        if($AdditionalQuery!=null && ($AdditionalQuery->isFieldInConditions("device.code") || $AdditionalQuery->isFieldInConditions("device.devicetype_fid")))
            $sq=$sq->AndLogic()->Equal(new DBField('sr.id',false),new DBField('device.servicerequest_fid',false));
        if($LoadOnlySecurityAccepted)
            $sq=$sq->AndLogic()->Equal(new DBField('sr.is_securityaccepted',false),1);
        $sq=$this->AddSelectParamsToQuery($sq,$AdditionalQuery);
        if($Limit!=null)
            $sq=$sq->setLimit($Limit);

        if(!$LoadOnlyCount)
        {

            $sq->AddGroupBy('sr.id');
//        $sq=new selectQuery();
            $res= $sq->ExecuteAssociated();
            $AllCount1 = count($res);
            $result=array();
            for ($i = 0; $i < $AllCount1; $i++) {
                $item=$res[$i];
                $obj=new itsap_servicerequestEntity($this->getDatabase()->getDBAccessor());
                $obj->loadFromArray($res[$i]);
                $result[$i]=$obj;
            }
        }
        else
        {
            $result= $sq->ExecuteAssociated();
        }
//        echo $sq->getQueryString();
        $this->getDatabase()->getDBAccessor()->close_connection();
        return $result;
    }
}
?>