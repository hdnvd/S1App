<?php
namespace Modules\shift\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\SweetDate;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\shift\Entity\shift_bakhshEntity;
use Modules\shift\Entity\shift_personelEntity;
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
    public function BtnGenerate($BakhshID,$StartTime,$DayCount)
    {
        $DBAccessor=new dbaccess();
        $Bakhsh=new shift_bakhshEntity($DBAccessor);
        $Bakhsh->setId($BakhshID);
        $FilePath="content/files/shift/samplexlsx" . $BakhshID . ".xlsx";
        $ex=new \XLSXWriter();
        $ex->setTitle('اطلاعات شیفت های بخش' . $Bakhsh->getTitleField());
        $title=['نام و نام خانوادگی','شماره پرسنلی'];
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
            $PersonCode=$item->getPersonelcode();
            $ex->writeSheetRow('اطلاعات شیفت ها',[$name,$PersonCode],[$ItemStyle,$ItemStyle]);
        }
        $ex->writeSheetRow('اطلاعات شیفت ها',['بخش',$Bakhsh->getTitleField()],[$HelpStyle,$HelpStyle]);
        $ex->writeSheetRow('اطلاعات شیفت ها',["شیفت صبح","M"],[$HelpStyle,$HelpStyle]);
        $ex->writeSheetRow('اطلاعات شیفت ها',["شیفت بعد از ظهر","A"],[$HelpStyle,$HelpStyle]);
        $ex->writeSheetRow('اطلاعات شیفت ها',["شیفت شب","N"],[$HelpStyle,$HelpStyle]);
        $ex->writeSheetRow('اطلاعات شیفت ها',["مرخصی متفرقه","V"],[$HelpStyle,$HelpStyle]);
        $ex->writeSheetRow('اطلاعات شیفت ها',["مرخصی استعلاجی","C"],[$HelpStyle,$HelpStyle]);
        $ex->writeSheetRow('اطلاعات شیفت ها',["مرخصی زایمان","P"],[$HelpStyle,$HelpStyle]);
        $ex->writeSheetRow('اطلاعات شیفت ها',["خالی","F"],[$HelpStyle,$HelpStyle]);
        $ex->writeToFile(DEFAULT_PUBLICPATH . $FilePath);

        $DBAccessor->close_connection();
        $result=$this->load($BakhshID);
        $result['fileurl']=DEFAULT_PUBLICURL . $FilePath;
        return $result;
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