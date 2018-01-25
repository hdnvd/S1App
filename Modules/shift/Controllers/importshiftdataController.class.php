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
	public function Btnsave($ID,$inputfile,$datatype)
	{
		if($datatype==1)
		    return $this->ImportShiftData($ID,$inputfile);
		elseif ($datatype==2)
            return $this->ImportPersonelData($ID,$inputfile);
	}
    public function ImportPersonelData($ID,$inputfile)
    {
        $Language_fid=CurrentLanguageManager::getCurrentLanguageID();
        $DBAccessor=new dbaccess();
        $DBAccessor->beginTransaction();
        $su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $result=array();
        $exel=new \SimpleXLSX($inputfile[0]['path']);
        if ($exel->success())
        {
            $sheetdata=$exel->rows();
            $AllCount1 = count($sheetdata);
            for ($RowNumber = 1; $RowNumber < $AllCount1; $RowNumber++) {
                $curRow=$sheetdata[$RowNumber];
//                $row[0]=$this->removeExtraCharsAndNormalize($row[0]);
                $personEnt=new shift_personelEntity($DBAccessor);
                $personEnt->setId($curRow[0]);
                $personEnt->setChildcount($curRow[1]);
                $personEnt->setAddress($curRow[2]);
                $personEnt->setFathername($curRow[3]);
                $personEnt->setPriority($curRow[4]);
                $date=$curRow[5];
                $date=SweetDate::getTimeFromDateText($date,0,0,'/');
                $personEnt->setEmployment_date($date);
                $personEnt->setPersonelcode($curRow[6]);
                $personEnt->setSanavat($curRow[7]);
                $personEnt->setShhesab($curRow[8]);
                $personEnt->setBakhsh_fid($curRow[9]);
                $personEnt->setMadrak_fid($curRow[10]);
                $personEnt->setName($curRow[11]);
                $personEnt->setFamily($curRow[12]);
                $personEnt->setTel($curRow[13]);
                $date2=$curRow[14];
                $date2=SweetDate::getTimeFromDateText($date2,0,0,'/');
                $personEnt->setBorn_date($date2);
                $personEnt->setIs_male($curRow[15]);
                $personEnt->setExtrasanavat($curRow[16]);
                $personEnt->setMonthsanavat($curRow[17]);
                $personEnt->setEshteghal_fid($curRow[18]);
                $personEnt->setZarib($curRow[19]);
                $personEnt->setRole_fid($curRow[20]);
                $personEnt->setShsh($curRow[21]);
                $personEnt->setComputercode($curRow[22]);
                $personEnt->setMellicode($this->removeExtraCharsAndNormalize($curRow[23]));
                $personEnt->setIs_married($curRow[24]);
                $personEnt->Save();
            }

            $DBAccessor->commit();
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
    public function ImportShiftData($ID,$inputfile)
    {
        $Language_fid=CurrentLanguageManager::getCurrentLanguageID();
        $DBAccessor=new dbaccess();
        $DBAccessor2=new dbaccess();
        $su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $result=array();
        $exel=new \SimpleXLSX($inputfile[0]['path']);
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
                $Pent=new shift_personelEntity($DBAccessor2);
                $q=new QueryLogic();
                $q->addCondition(new FieldCondition(shift_personelEntity::$PERSONELCODE,$personCode));
                $Pent=$Pent->FindOne($q);
                if($Pent==null || $Pent->getId()<=0)
                    throw new DataNotFoundException();
                $PersonID=$Pent->getId();
                $PersonCurrentBakhshID=$Pent->getBakhsh_fid();
                $PersonCurrentRoleID=$Pent->getRole_fid();

                $AllCount4 = count($item['time']);
                for ($PersonTimeNum = 0; $PersonTimeNum < $AllCount4; $PersonTimeNum++) {
                    $pTime=$item['time'][$PersonTimeNum];
                    $pShiftInfo=$item['presenceinfo'][$PersonTimeNum];

                    if(strpos('m',$pShiftInfo)!==false)
                    {
                        $shiftEnt=new shift_shiftEntity($DBAccessor);
                        $shiftEnt->setDue_date($pTime);
                        $shiftEnt->setPersonel_fid($PersonID);
                        $shiftEnt->setBakhsh_fid($PersonCurrentBakhshID);
                        $shiftEnt->setRole_fid($PersonCurrentBakhshID);
                        $shiftEnt->setRegister_date(time());
                        $shiftEnt->setShifttype_fid(1);
                        $shiftEnt->Save();
                    }
                    if(strpos('a',$pShiftInfo)!==false)
                    {
                        $shiftEnt=new shift_shiftEntity($DBAccessor);
                        $shiftEnt->setDue_date($pTime);
                        $shiftEnt->setPersonel_fid($PersonID);
                        $shiftEnt->setBakhsh_fid($PersonCurrentBakhshID);
                        $shiftEnt->setRole_fid($PersonCurrentBakhshID);
                        $shiftEnt->setRegister_date(time());
                        $shiftEnt->setShifttype_fid(2);
                        $shiftEnt->Save();
                    }
                    if(strpos('n',$pShiftInfo)!==false)
                    {
                        $shiftEnt=new shift_shiftEntity($DBAccessor);
                        $shiftEnt->setDue_date($pTime);
                        $shiftEnt->setPersonel_fid($PersonID);
                        $shiftEnt->setBakhsh_fid($PersonCurrentBakhshID);
                        $shiftEnt->setRole_fid($PersonCurrentBakhshID);
                        $shiftEnt->setRegister_date(time());
                        $shiftEnt->setShifttype_fid(3);
                        $shiftEnt->Save();
                    }
                    if(strpos('f',$pShiftInfo)!==false)
                    {
                        $shiftEnt=new shift_shiftEntity($DBAccessor);
                        $shiftEnt->setDue_date($pTime);
                        $shiftEnt->setPersonel_fid($PersonID);
                        $shiftEnt->setBakhsh_fid($PersonCurrentBakhshID);
                        $shiftEnt->setRole_fid($PersonCurrentBakhshID);
                        $shiftEnt->setRegister_date(time());
                        $shiftEnt->setShifttype_fid(4);
                        $shiftEnt->Save();
                    }
                    if(strpos('v',$pShiftInfo)!==false)
                    {
                        $shiftEnt=new shift_shiftEntity($DBAccessor);
                        $shiftEnt->setDue_date($pTime);
                        $shiftEnt->setPersonel_fid($PersonID);
                        $shiftEnt->setBakhsh_fid($PersonCurrentBakhshID);
                        $shiftEnt->setRole_fid($PersonCurrentBakhshID);
                        $shiftEnt->setRegister_date(time());
                        $shiftEnt->setShifttype_fid(5);
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
        $DBAccessor->commit();
        $DBAccessor->close_connection();
        $DBAccessor2->close_connection();
        return $result;
    }
}
?>