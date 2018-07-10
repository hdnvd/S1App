<?php
namespace Modules\shift\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\parameters\Entity\ParameterEntity;
use Modules\parameters\PublicClasses\ParameterManager;
use Modules\shift\Entity\shift_dateEntity;
use Modules\shift\Entity\shift_personelEntity;
use Modules\shift\Entity\shift_shiftEntity;
use Modules\shift\Entity\shift_shifttypeEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-17 - 2018-04-06 18:22
*@lastUpdate 1397-01-17 - 2018-04-06 18:22
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class getworktimeController extends Controller {
	private $PAGESIZE=10;
	private $freedates;
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		if($ID!=-1){
			//Do Something...
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}

	public function BtnGenerate($BakhshID,$StartDate,$txtdaycount)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
        $result=$this->load($BakhshID);

        $result['alldaycount']=$txtdaycount;
        $daySeconds=86400;
        $EndDate=$StartDate+($daySeconds*($txtdaycount-1));

        $freedateEnt=new shift_dateEntity($DBAccessor);
        $freedatequery=new QueryLogic();
        $freedatequery->addCondition(new FieldCondition(shift_dateEntity::$DAY_DATE,($StartDate-1),LogicalOperator::Bigger));
        $freedatequery->addCondition(new FieldCondition(shift_dateEntity::$DAY_DATE,($EndDate+1),LogicalOperator::Smaller));
        $this->freedates=$freedateEnt->FindAll($freedatequery);

        $FreeDayCount=0;
        for ($i = 0; $i < $txtdaycount; $i++) {
            $day=$StartDate+$daySeconds*$i;
//            echo $day;
            if($this->getIsHoliday($day))
                $FreeDayCount++;
        }
        $result['freedaycount']=$FreeDayCount;
        $WorkDayCount=$txtdaycount-$FreeDayCount;
        $result['workdaycount']=$WorkDayCount;
        $requireddayminutes=ParameterManager::getParameter('shift_requireddayminutes');
        $RequiredWorkTime=$WorkDayCount*$requireddayminutes;
        $result['requiredworktime']=$RequiredWorkTime;

		/************ Get Bakhsh Personels*******************/
		$personelEnt=new shift_personelEntity($DBAccessor);
		$AllPersonels=$personelEnt->FindAll(new QueryLogic([new FieldCondition(shift_personelEntity::$BAKHSH_FID,$BakhshID)]));
        /************ Get Bakhsh Personels*******************/

        $shifttypeEnt=new shift_shifttypeEntity($DBAccessor);
        $shifttypes=$shifttypeEnt->FindAll(new QueryLogic());
        $AllCount1 = count($shifttypes);
        $shiftTimes=array();
        $shiftHolidayTimes=array();
        for ($i = 0; $i < $AllCount1; $i++) {
            $shiftTimes[$shifttypes[$i]->getId()]=$shifttypes[$i]->getValueinminutes();
            $shiftHolidayTimes[$shifttypes[$i]->getId()]=$shiftTimes[$shifttypes[$i]->getId()]*$shifttypes[$i]->getHolidayfactor();
        }


        $AllCount1 = count($AllPersonels);
        $result['personel']=$AllPersonels;
        for ($i = 0; $i < $AllCount1; $i++) {
//            $Person=new shift_personelEntity($DBAccessor);
            $Person=$AllPersonels[$i];
            $result['timeinfo'][$i]['totaltimewithoutfactor']=0;
            $result['timeinfo'][$i]['totaltimewithfactor']=0;
            $result['timeinfo'][$i]['extratime']=0;
            $result['timeinfo'][$i]['holidayshiftcount']=0;
            $result['timeinfo'][$i]['shiftcount']=0;

            $shiftEnt=new shift_shiftEntity($DBAccessor);
            $query=new QueryLogic();
            $query->addCondition(new FieldCondition(shift_shiftEntity::$PERSONEL_FID,$Person->getId()));
            $query->addCondition(new FieldCondition(shift_shiftEntity::$DUE_DATE,($StartDate-1),LogicalOperator::Bigger));
            $query->addCondition(new FieldCondition(shift_shiftEntity::$DUE_DATE,($EndDate+1),LogicalOperator::Smaller));
            $PersonShifts=$shiftEnt->FindAll($query);

            $AllPersonShiftsCount1 = count($PersonShifts);
//            echo $AllPersonShiftsCount1;
            for ($PersonShiftsIndex = 0; $PersonShiftsIndex < $AllPersonShiftsCount1; $PersonShiftsIndex++) {
                $shift=$PersonShifts[$PersonShiftsIndex];
//                $shift=new shift_shiftEntity($DBAccessor);
                $shifttypeid=$shift->getShifttype_fid();
                $result['timeinfo'][$i]['totaltimewithoutfactor']+=$shiftTimes[$shifttypeid];

                $result['timeinfo'][$i]['shiftcount']++;
                if($this->getIsHoliday($shift->getDue_date()))
                {
                    $result['timeinfo'][$i]['totaltimewithfactor']+=$shiftHolidayTimes[$shifttypeid];
                    $result['timeinfo'][$i]['holidayshiftcount']++;
                }
                else
                {
                    $result['timeinfo'][$i]['totaltimewithfactor']+=$shiftTimes[$shifttypeid];
                }

            }

            $result['timeinfo'][$i]['extratime']=$result['timeinfo'][$i]['totaltimewithfactor']-$RequiredWorkTime;
        }



		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	private function getIsHoliday($day)
    {
//        echo $day . "\n";
        for($t=0;$t<count($this->freedates);$t++)
        {
//            echo "-FD:".$this->freedates[$t]->getDay_date()." \n";
            if(abs($this->freedates[$t]->getDay_date()-$day)<43200)
                return true;
        }
        return false;
    }
}
?>