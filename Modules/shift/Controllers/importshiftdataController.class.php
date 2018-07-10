<?php
namespace Modules\shift\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\SweetDate;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\shift\Entity\shift_inputfileEntity;
use Modules\shift\Entity\shift_personelEntity;
use Modules\shift\Entity\shift_shiftEntity;
use Modules\shift\Entity\shift_shifttypeEntity;
use Modules\shift\Exceptions\ShiftExistsException;
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
	private $AddedShifts=0;
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

    /**
     * @param $ID
     * @param $inputfile
     * @param $datatype
     * @return array
     * @throws DataNotFoundException
     * @throws ShiftExistsException
     */
    public function Btnsave($ID, $inputfile, $datatype)
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

    /**
     * @param $ID
     * @param $inputfile
     * @return array
     * @throws DataNotFoundException
     * @throws ShiftExistsException
     */
    public function ImportShiftData($ID, $inputfile)
    {
        $MetaDataColCount=2;
//        $HelpMetaDataRowCount=8;

        $Language_fid=CurrentLanguageManager::getCurrentLanguageID();
        $TransactionDBAccessor=new dbaccess();
        $TransactionDBAccessor->beginTransaction();
        $DBAccessor=new dbaccess();
        $shiftTypeEnt=new shift_shifttypeEntity($DBAccessor);
        $allShiftTypes=$shiftTypeEnt->FindAll(new QueryLogic([new FieldCondition(shift_shifttypeEntity::$ISVISIBLE,1)]));
        $HelpMetaDataRowCount=count($allShiftTypes)+1;
        $su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $result=array();
        $InputFileEnt=new shift_inputfileEntity($TransactionDBAccessor);
        $InputFileEnt->setFile_flu($inputfile[0]['path']);
        $InputFileEnt->setRole_systemuser_fid($su->getSystemUserID());
        $InputFileEnt->setUpload_time(time());
        $InputFileEnt->Save();
        $exel=new \SimpleXLSX($inputfile[0]['path']);
//        $exel=\SimpleXLSX::parse($inputfile[0]['path']);
//        echo $inputfile[0]['path'];
        if ($exel->success())
        {
            $sheetdata=$exel->rows();
            echo "Row Count:" . count($sheetdata);
            $firstrow=$sheetdata[0];
            $AllCount2 = count($firstrow);
            echo "<br>Collumn Count:" . $AllCount2;
            $day=array();
            for ($collumnNumber = $MetaDataColCount; $collumnNumber < $AllCount2; $collumnNumber++) {
                $day[$collumnNumber]=$firstrow[$collumnNumber];
                $day[$collumnNumber]=str_replace(" ","",$day[$collumnNumber]);
                $day[$collumnNumber]=str_replace("-","/",$day[$collumnNumber]);
                $day[$collumnNumber]=str_replace("_","/",$day[$collumnNumber]);
                $day[$collumnNumber]=str_replace("\\","/",$day[$collumnNumber]);
                $day[$collumnNumber]=SweetDate::getTimeFromDateText($day[$collumnNumber],0,0,'/');
            }
            $AllCount1 = count($sheetdata);
//            echo $AllCount1;
            for ($RowNumber = 1; $RowNumber < ($AllCount1-$HelpMetaDataRowCount); $RowNumber++) {
                $row=$sheetdata[$RowNumber];
                $row[0]=$this->removeExtraCharsAndNormalize($row[0]);
                $data[$RowNumber-1]['personid']=$row[1];
                $pcode=$data[$RowNumber-1]['personid'];
                $AllCount2 = count($row);

                for ($collumnNumber = $MetaDataColCount; $collumnNumber < $AllCount2; $collumnNumber++) {
                    $row[$collumnNumber]=$this->removeExtraCharsAndNormalize($row[$collumnNumber]);
                    $presenceinfo=$row[$collumnNumber];
                    $data[$RowNumber-1]['presenceinfo'][$collumnNumber-$MetaDataColCount]=$presenceinfo;
                    $data[$RowNumber-1]['time'][$collumnNumber-$MetaDataColCount]=$day[$collumnNumber];
                }
            }

            /************************Check if other record exists for this day and bakhsh in db  **********************/
            if(count($data)>0)
            {

                $Pent=new shift_personelEntity($DBAccessor);
                $Pent=$Pent->FindOne(new QueryLogic([new FieldCondition(shift_personelEntity::$MELLICODE,$data[0]['personid'])],[],[]));
//                $Pent->setId($data[0]['personid']);
                if($Pent==null || $Pent->getId()<=0)
                    throw new DataNotFoundException("ردیف:1,کد ملی:".$data[0]['personid']);
                $PersonCurrentBakhshID=$Pent->getBakhsh_fid();
                $AllCount1 = count($day);
                for ($collumnNumber = $MetaDataColCount; $collumnNumber < $AllCount2; $collumnNumber++) {
                    $shift=new shift_shiftEntity($DBAccessor);
                    $cnt=$shift->FindAllCount(new QueryLogic([new FieldCondition(shift_shiftEntity::$DUE_DATE,$day[$collumnNumber]),new FieldCondition(shift_shiftEntity::$BAKHSH_FID,$PersonCurrentBakhshID)]));
                    if($cnt>0)
                        throw new ShiftExistsException("ستون:".($collumnNumber+1));
                }
            }

            /************************Check if other record exists for this day and bakhsh in db  **********************/

            $AllCount3 = count($data);
            for ($i = 0; $i < $AllCount3; $i++) {
                $item=$data[$i];
                $personid=$item['personid'];
                $Pent=new shift_personelEntity($DBAccessor);
                $Pent=$Pent->FindOne(new QueryLogic([new FieldCondition(shift_personelEntity::$MELLICODE,$personid)],[],[]));
                if($Pent==null || $Pent->getId()<=0)
                    throw new DataNotFoundException("ردیف:".($i+1).",کد ملی:$personid");
                $PersonID=$Pent->getId();
                $PersonCurrentBakhshID=$Pent->getBakhsh_fid();
                $PersonCurrentRoleID=$Pent->getRole_fid();

                $AllCount4 = count($item['time']);

                for ($PersonTimeNum = 0; $PersonTimeNum < $AllCount4; $PersonTimeNum++) {
                    $pTime=$item['time'][$PersonTimeNum];
                    $pShiftInfo=$item['presenceinfo'][$PersonTimeNum];
                    if($pShiftInfo==null)
                        $pShiftInfo=" ";
                    $this->AddNewShiftFromShiftTitle($TransactionDBAccessor,$allShiftTypes,$pTime,$PersonID,$PersonCurrentBakhshID,$PersonCurrentRoleID,$pShiftInfo,$InputFileEnt->getId());
                }
            }
        }
        else
            echo 'xlsx error: '.$exel->error();

        $result=$this->load($ID);
        $result['addedshifts']=$this->AddedShifts;
        $TransactionDBAccessor->commit();
        $TransactionDBAccessor->close_connection();
        $DBAccessor->close_connection();
        return $result;
    }
    private function AddNewShiftFromShiftTitle($TransactionDBAccessor,$allShiftTypes,$pTime,$PersonID,$PersonCurrentBakhshID,$PersonCurrentRoleID,$pShiftInfo,$InputFileID)
    {
        $ifAddedOne=false;
        $AllCount1 = count($allShiftTypes);
        for ($i = 0; $i < $AllCount1; $i++) {
            $shiftTypeEnt=$allShiftTypes[$i];
//            echo "<br>" . $pShiftInfo . " : " . strtolower(trim($shiftTypeEnt->getLatinabbreviation()));
            if(strpos($pShiftInfo,strtolower(trim($shiftTypeEnt->getLatinabbreviation())))!==false){
                $ifAddedOne=true;
                $this->AddNewShift($TransactionDBAccessor,$pTime,$PersonID,$PersonCurrentBakhshID,$PersonCurrentRoleID,$shiftTypeEnt->getId(),$InputFileID);
//echo "-Accepted";
            }

        }
        if($ifAddedOne)
            $this->AddedShifts++;

    }
    private function AddNewShift($DBAccessor,$pTime,$PersonID,$PersonCurrentBakhshID,$PersonCurrentRoleID,$ShiftTypeID,$FileID)
    {
        $shiftEnt=new shift_shiftEntity($DBAccessor);
        $shiftEnt->setDue_date($pTime);
        $shiftEnt->setPersonel_fid($PersonID);
        $shiftEnt->setBakhsh_fid($PersonCurrentBakhshID);
        $shiftEnt->setRole_fid($PersonCurrentRoleID);
        $shiftEnt->setRegister_date(time());
        $shiftEnt->setShifttype_fid($ShiftTypeID);
        $shiftEnt->setInputfile_fid($FileID);
        $shiftEnt->Save();
    }
}
?>