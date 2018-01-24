<?php
namespace Modules\shift\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\SweetDate;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\shift\Entity\shift_personelEntity;
use Modules\shift\Entity\shift_shiftEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-27 - 2018-01-17 16:12
*@lastUpdate 1396-10-27 - 2018-01-17 16:12
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class importshiftdataController extends Controller {
	private $PAGESIZE=10;
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
	private function removeExtraCharsAndNormalize($InputData)
    {

        $InputData=str_replace(" ","",$InputData);
        $InputData=str_replace("-","",$InputData);
        $InputData=str_replace("/","",$InputData);
        $InputData=str_replace("\\","",$InputData);
        $InputData=str_replace("\n","",$InputData);
        $InputData=str_replace("\t","",$InputData);
        $InputData=str_replace("\r","",$InputData);
        $InputData=strtolower($InputData);
        return $InputData;
    }
	public function Btnsave($ID,$inputfile)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
        $exel=new \SimpleXLSX($inputfile[0]['path']);
		$inputfile[0]['path'];//Address of Excel File
        if ($exel->success())
        {
            $sheetdata=$exel->rows();
            $firstrow=$sheetdata[0];
            $AllCount2 = count($firstrow);
            $day=array();
            for ($collumnNumber = 1; $collumnNumber < $AllCount2; $collumnNumber++) {
                $day[$collumnNumber]=$firstrow[$collumnNumber];
                $day[$collumnNumber]=str_replace(" ","",$day[$collumnNumber]);
                $day[$collumnNumber]=str_replace("-","/",$day[$collumnNumber]);
                $day[$collumnNumber]=str_replace("_","/",$day[$collumnNumber]);
                $day[$collumnNumber]=str_replace("\\","/",$day[$collumnNumber]);
                $day[$collumnNumber]=SweetDate::getTimeFromDateText($day[$collumnNumber],0,0,'/');
            }

            $AllCount1 = count($sheetdata);
            for ($RowNumber = 1; $RowNumber < $AllCount1; $RowNumber++) {
                $row=$sheetdata[$RowNumber];
                $row[0]=$this->removeExtraCharsAndNormalize($row[0]);
                $data[$RowNumber-1]['personcode']=$row[0];
                $pcode=$data[$RowNumber-1]['personcode'];
                $AllCount2 = count($row);
                for ($collumnNumber = 1; $collumnNumber < $AllCount2; $collumnNumber++) {
                    $row[$collumnNumber]=$this->removeExtraCharsAndNormalize($row[$collumnNumber]);
                    $presenceinfo=$row[$collumnNumber];
                    $data[$RowNumber-1]['presenceinfo'][$collumnNumber-1]=$presenceinfo;
                    $data[$RowNumber-1]['time'][$collumnNumber-1]=$day[$collumnNumber];
                }
            }
            $AllCount3 = count($data);
            for ($i = 0; $i < $AllCount3; $i++) {
                $item=$data[$i];
                $personCode=$item['personcode'];
                $Pent=new shift_personelEntity($DBAccessor);
                $q=new QueryLogic();
                $q->addCondition(new FieldCondition(shift_personelEntity::$PERSONELCODE,$personCode));
                $Pent=$Pent->FindOne($q);
                if($Pent==null || $Pent->getId()<=0)
                    throw new DataNotFoundException();
                $PersonID=$Pent->getId();
                $AllCount4 = count($item['time']);
                for ($PersonTimeNum = 0; $PersonTimeNum < $AllCount4; $PersonTimeNum++) {
                    $pTime=$item['time'][$PersonTimeNum];
                    $pShiftInfo=$item['presenceinfo'][$PersonTimeNum];

                    if(strpos('m',$pShiftInfo)!==false)
                    {
                        $shiftEnt=new shift_shiftEntity($DBAccessor);
                        $shiftEnt->setDue_date($pTime);
                        $shiftEnt->setPerson_fid($PersonID);
                        $shiftEnt->setRegister_date(time());
                        $shiftEnt->setShifttype(1);
                        $shiftEnt->Save();
                    }
                    if(strpos('a',$pShiftInfo)!==false)
                    {
                        $shiftEnt=new shift_shiftEntity($DBAccessor);
                        $shiftEnt->setDue_date($pTime);
                        $shiftEnt->setPerson_fid($PersonID);
                        $shiftEnt->setRegister_date(time());
                        $shiftEnt->setShifttype(2);
                        $shiftEnt->Save();
                    }
                    if(strpos('n',$pShiftInfo)!==false)
                    {
                        $shiftEnt=new shift_shiftEntity($DBAccessor);
                        $shiftEnt->setDue_date($pTime);
                        $shiftEnt->setPerson_fid($PersonID);
                        $shiftEnt->setRegister_date(time());
                        $shiftEnt->setShifttype(3);
                        $shiftEnt->Save();
                    }
                    if(strpos('f',$pShiftInfo)!==false)
                    {
                        $shiftEnt=new shift_shiftEntity($DBAccessor);
                        $shiftEnt->setDue_date($pTime);
                        $shiftEnt->setPerson_fid($PersonID);
                        $shiftEnt->setRegister_date(time());
                        $shiftEnt->setShifttype(4);
                        $shiftEnt->Save();
                    }
                    if(strpos('v',$pShiftInfo)!==false)
                    {
                        $shiftEnt=new shift_shiftEntity($DBAccessor);
                        $shiftEnt->setDue_date($pTime);
                        $shiftEnt->setPerson_fid($PersonID);
                        $shiftEnt->setRegister_date(time());
                        $shiftEnt->setShifttype(5);
                        $shiftEnt->Save();
                    }
                }
            }
        }
        else
            echo 'xlsx error: '.$exel->error();

        if($ID==-1){
			//INSERT NEW DATA
		}
		else{
			//UPDATE DATA
		}
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>