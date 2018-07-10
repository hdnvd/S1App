<?php
namespace Modules\shift\Controllers;
use core\CoreClasses\File\SweetZipArchive;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\SweetDate;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\shift\Entity\shift_bakhshEntity;
use Modules\shift\Entity\shift_personelEntity;
use Modules\shift\Entity\shift_shifttypeEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-23 - 2018-02-12 00:13
*@lastUpdate 1396-11-23 - 2018-02-12 00:13
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class makesampleinputController extends Controller {
	private $PAGESIZE=10;
    private function getDateFromTime($time)
    {
        date_default_timezone_set("Asia/Tehran");
        $sweetDate = new SweetDate(false, true, 'Asia/Tehran');
        $dt = $sweetDate->date("Y/m/d", $time);
        return $dt;
    }
    public function GenerateAll($StartTime,$DayCount)
    {
        $DBAccessor=new dbaccess();
        $Bakhsh=new shift_bakhshEntity($DBAccessor);

        $AllBakhsh=$Bakhsh->FindAll(new QueryLogic());
        $AllCount1 = count($AllBakhsh);
        $path=DEFAULT_PUBLICPATH . "content/files/shift/samplexlsx/";
        if(file_exists($path))
            $this->deleteDir($path);
        for ($i = 0; $i < $AllCount1; $i++) {
            $Bakhsh=$AllBakhsh[$i];
            $this->BtnGenerate($Bakhsh->getId(),$StartTime,$DayCount);
        }
        $ZipPath=DEFAULT_PUBLICPATH . "content/files/shift/samplexlsx-all.zip";
        unlink($ZipPath);
        $zip=new SweetZipArchive();
        if ($zip->open($ZipPath, \ZipArchive::CREATE)!==TRUE) {
            exit("cannot open <$path>\n");
        }
        $zip->addTree($path);
        $zip->close();
//        $result=$this->load(1);
        $result['fileurl']=DEFAULT_PUBLICURL."content/files/shift/samplexlsx-all.zip";
        $DBAccessor->close_connection();
        return $result;
    }
    public function BtnGenerate($BakhshID,$StartTime,$DayCount)
    {
        if($BakhshID<0)
            return $this->GenerateAll($StartTime,$DayCount);
        $DBAccessor=new dbaccess();
        $Bakhsh=new shift_bakhshEntity($DBAccessor);
        $Bakhsh->setId($BakhshID);
        $ex=new \XLSXWriter();
        $ex->setTitle('اطلاعات شیفت های بخش' . $Bakhsh->getTitleField());
        $title=['نام و نام خانوادگی','کد ملی'];
        $titleStyle=['fill'=>'#2c8182',"color"=>'#ffffff','font'=>"B Homa"];
        $ItemStyle=['fill'=>'#428BCA',"color"=>'#ffffff','font'=>"B Homa"];
        $HelpStyle=['fill'=>'#2c8182',"color"=>'#ffffff','font'=>"B Homa"];
        $titleStyles = array( $titleStyle,$titleStyle);
        $DayLength=86400;
        for ($i=0;$i<$DayCount;$i++)
        {
            $day=$StartTime+$i*$DayLength;
            array_push($title,$this->getDateFromTime($day));
            array_push($titleStyles,$titleStyle);

        }
        $ex->writeSheetRow('اطلاعات شیفت ها',$title,$titleStyles);
        $personel=new shift_personelEntity($DBAccessor);
        $allPersonel=$personel->FindAll(new QueryLogic([new FieldCondition(shift_personelEntity::$BAKHSH_FID,$BakhshID)]));
        $AllCount1 = count($allPersonel);
        for ($i = 0; $i < $AllCount1; $i++) {
            $item=$allPersonel[$i];
            $name=$item->getName() . " " . $item->getFamily();
            $PersonCode=$item->getMellicode();
            $ex->writeSheetRow('اطلاعات شیفت ها',[$name,$PersonCode],[$ItemStyle,$ItemStyle]);
        }
        $ex->writeSheetRow('اطلاعات شیفت ها',['بخش',$Bakhsh->getTitleField()],[$HelpStyle,$HelpStyle]);
        $shiftTypeEnt=new shift_shifttypeEntity($DBAccessor);
        $allShiftTypes=$shiftTypeEnt->FindAll(new QueryLogic([new FieldCondition(shift_shifttypeEntity::$ISVISIBLE,1)]));
        $AllCount1 = count($allShiftTypes);
        for ($i = 0; $i < $AllCount1; $i++) {
            $shiftTypeEnt=$allShiftTypes[$i];
            $ex->writeSheetRow('اطلاعات شیفت ها',[$shiftTypeEnt->getTitle(),strtoupper($shiftTypeEnt->getLatinabbreviation())],[$HelpStyle,$HelpStyle]);
        }
//        $ex->writeSheetRow('اطلاعات شیفت ها',["شیفت صبح","M"],[$HelpStyle,$HelpStyle]);
//        $ex->writeSheetRow('اطلاعات شیفت ها',["شیفت بعد از ظهر","A"],[$HelpStyle,$HelpStyle]);
//        $ex->writeSheetRow('اطلاعات شیفت ها',["شیفت شب","N"],[$HelpStyle,$HelpStyle]);
//        $ex->writeSheetRow('اطلاعات شیفت ها',["مرخصی متفرقه","V"],[$HelpStyle,$HelpStyle]);
//        $ex->writeSheetRow('اطلاعات شیفت ها',["مرخصی استعلاجی","C"],[$HelpStyle,$HelpStyle]);
//        $ex->writeSheetRow('اطلاعات شیفت ها',["مرخصی زایمان","P"],[$HelpStyle,$HelpStyle]);
//        $ex->writeSheetRow('اطلاعات شیفت ها',["خالی","F"],[$HelpStyle,$HelpStyle]);

        $path="content/files/shift/samplexlsx/";
if(!is_dir(DEFAULT_PUBLICPATH.$path))
            mkdir(DEFAULT_PUBLICPATH.$path);
        $FilePath=$path. "samplexlsx-".$BakhshID."-" . $Bakhsh->getTitle() . ".xlsx";

        $ex->writeToFile(DEFAULT_PUBLICPATH . $FilePath);

        $DBAccessor->close_connection();
        $result=$this->load($BakhshID);
        $result['fileurl']=DEFAULT_PUBLICURL . $FilePath;
        return $result;
    }
    public function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
            throw new \InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
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
}
?>