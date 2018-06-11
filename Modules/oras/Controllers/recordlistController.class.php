<?php
namespace Modules\oras\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\oras\Entity\oras_roleEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\oras\Entity\oras_recordEntity;
use Modules\oras\Entity\oras_shifttypeEntity;
use Modules\oras\Entity\oras_recordtypeEntity;
use Modules\oras\Entity\oras_employeeEntity;
use Modules\oras\Entity\oras_placeEntity;
use Modules\oras\Entity\oras_file1Entity;
use Modules\oras\Entity\oras_file2Entity;
use Modules\oras\Entity\oras_file3Entity;
use Modules\oras\Entity\oras_file4Entity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-12 - 2017-10-04 16:20
*@lastUpdate 1396-07-12 - 2017-10-04 16:20
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class recordlistController extends Controller {
	private $PAGESIZE=25;
	public function getData($PageNum,QueryLogic $QueryLogic,$EmployeeID,$PlaceID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		if($EmployeeID>0)
            $QueryLogic->addCondition(new FieldCondition(oras_recordEntity::$EMPLOYEE_FID,$EmployeeID));
        if($PlaceID>0)
            $QueryLogic->addCondition(new FieldCondition(oras_recordEntity::$PLACE_FID,$PlaceID));
		$shifttypeEntityObject=new oras_shifttypeEntity($DBAccessor);
		$result['shifttype_fid']=$shifttypeEntityObject->FindAll(new QueryLogic());
		$recordtypeEntityObject=new oras_recordtypeEntity($DBAccessor);
		$result['recordtype_fid']=$recordtypeEntityObject->FindAll(new QueryLogic());
        $employeeEntityObject = new oras_employeeEntity($DBAccessor);
        if($EmployeeID>0)
        {
            $employeeEntityObject->setId($EmployeeID);
            $result['employee'] = $employeeEntityObject;
        }
        $result['employee_fid'] = $employeeEntityObject->FindAll(new QueryLogic());
		$placeEntityObject=new oras_placeEntity($DBAccessor);
		$result['place_fid']=$placeEntityObject->FindAll(new QueryLogic());
        if($PlaceID>0)
        {
            $placeEntityObject->setId($PlaceID);
            $result['place'] = $placeEntityObject;
        }

        $roleEntityObject=new oras_roleEntity($DBAccessor);
        $result['role_fid']=$roleEntityObject->FindAll(new QueryLogic());


		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(oras_recordEntity::$ROLE_SYSTEMUSER_FID,$UserID));

		$recordEnt=new oras_recordEntity($DBAccessor);
		$result['record']=$recordEnt;
		$allcount=$recordEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$recordEnt->FindAll($QueryLogic);
		$Data=$result['data'];
		$DataCount=0;
		if($Data!=null)
            $DataCount=count($Data);
        $result['totalfilecount']=0;
            $result['totalnegativepoints']=0;
            $result['totalnegativepointscount']=0;
            $result['totalpositivepoints']=0;
            $result['totalpositivepointscount']=0;
            $result['totalzeropointscount']=0;
        $result['totalcount']=$DataCount;
		for($i=0;$i<$DataCount;$i++)
        {
            $thisData=$Data[$i];
            $plc=new oras_placeEntity($DBAccessor);
            $plc->setId($thisData->getPlace_fid());
            $result['itemplace'][$i]=$plc;

            $EmployeeEnt=new oras_employeeEntity($DBAccessor);
            $EmployeeEnt->setId($thisData->getEmployee_fid());
            $result['itememployee'][$i]=$EmployeeEnt;

            $FileCount=0;
            if($thisData->getFile1_flu()!="") $FileCount++;
            if($thisData->getFile2_flu()!="") $FileCount++;
            if($thisData->getFile3_flu()!="") $FileCount++;
            if($thisData->getFile4_flu()!="") $FileCount++;
            $result['itemfilecount'][$i]=$FileCount;

            $TypeEnt=new oras_recordtypeEntity($DBAccessor);
            $TypeEnt->setId($thisData->getRecordtype_fid());
            $result['itemtype'][$i]=$TypeEnt;

            $ShiftTypeEnt=new oras_shifttypeEntity($DBAccessor);
            $ShiftTypeEnt->setId($thisData->getShifttype_fid());
            $result['itemshifttype'][$i]=$ShiftTypeEnt;


            $result['totalfilecount']+=$result['itemfilecount'][$i];
            if($TypeEnt->getPoints()<0)
            {
                $result['totalnegativepoints']+=$TypeEnt->getPoints();
                $result['totalnegativepointscount']++;
            }
            elseif ($TypeEnt->getPoints()>0)
            {

                $result['totalpositivepoints']+=$TypeEnt->getPoints();
                $result['totalpositivepointscount']++;
            }
            else
                $result['totalzeropointscount']++;
        }
		$DBAccessor->close_connection();
		return $result;
	}
	private $adminMode=true;
    public function getAdminMode()
    {
        return $this->adminMode;
    }
        /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
    }
	public function load($PageNum,$EmployeeID,$PlaceID)
	{
		$DBAccessor=new dbaccess();
		$recordEnt=new oras_recordEntity($DBAccessor);
		$q=new QueryLogic();
		if($EmployeeID>0)
		    $q->addOrderBy(oras_recordEntity::$EMPLOYEE_FID,$EmployeeID);
        if($PlaceID>0)
            $q->addOrderBy(oras_recordEntity::$PLACE_FID,$PlaceID);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q,$EmployeeID,$PlaceID);
	}
	public function Search($PageNum,$title,$occurance_date_from,$occurance_date_to,$description,$shifttype_fid,$recordtype_fid,$employeeMelliCode,$place_fid,$registration_time_from,$registration_time_to,$sortby,$isdesc,$recordtypeisbad,$ResultType,$role_fid)
	{
		$DBAccessor=new dbaccess();
		$recordEnt=new oras_recordEntity($DBAccessor);
		$Empent=new oras_employeeEntity($DBAccessor);
		$EmpQ=new QueryLogic();
		$EmpQ->addCondition(new FieldCondition(oras_employeeEntity::$MELLICODE,$employeeMelliCode));
		$Empent=$Empent->FindOne($EmpQ);
        $employee_fid="";
		if($Empent!=null)
            $employee_fid=$Empent->getId();



		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("title","%$title%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("occurance_date",$occurance_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("occurance_date",$occurance_date_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("description","%$description%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("shifttype_fid","%$shifttype_fid%",LogicalOperator::LIKE));

        if($recordtype_fid=="" && $recordtypeisbad!=null && $recordtypeisbad>0)
        {
            $recTypeEnt=new oras_recordtypeEntity($DBAccessor);
            $qRecType=new QueryLogic();
            $qRecType->addCondition(new FieldCondition(oras_recordtypeEntity::$ISBAD,$recordtypeisbad-1));
            $recTypeEnt=$recTypeEnt->FindAll($qRecType);
            $recTypeIDs=array();
            for ($j=0;$recTypeEnt!=null && $j<count($recTypeEnt);$j++)
            {
                $recTypeIDs[$j]=$recTypeEnt[$j]->getID();
            }
            $q->addCondition(new FieldCondition("recordtype_fid",$recTypeIDs,LogicalOperator::IN));
        }
		$q->addCondition(new FieldCondition("recordtype_fid","%$recordtype_fid%",LogicalOperator::LIKE));


        if($ResultType==2)//Only Place Records
            $employee_fid=-1;
        if($ResultType==1)//Only Person Records
            $q->addCondition(new FieldCondition("employee_fid","0",LogicalOperator::Bigger));
        $q->addCondition(new FieldCondition("employee_fid","%$employee_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("place_fid","%$place_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("role_fid","%$role_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("registration_time",$registration_time_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("registration_time",$registration_time_to,LogicalOperator::Smaller));
		$sortByField=$recordEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
        if($employee_fid=="")
            $employee_fid=-1;
        if($place_fid=="")
            $place_fid=-1;

		return $this->getData($PageNum,$q,$employee_fid,$place_fid);
	}
}
?>