<?php
namespace Modules\shift\Forms;
use core\CoreClasses\html\Image;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\services\baseHTMLElement;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\UList;
use core\CoreClasses\html\FormLabel;
use core\CoreClasses\html\UListElement;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\link;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DatePicker;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\Button;
use core\CoreClasses\html\CheckBox;
use core\CoreClasses\html\RadioBox;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\ComboBox;
use core\CoreClasses\html\FileUploadBox;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
use core\CoreClasses\SweetDate;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 00:33
*@lastUpdate 1396-11-05 - 2018-01-25 00:33
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class twoweeksreport_Design extends FormDesign {
	private $Data;
	private $EmployeeIDs;
	private $row;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
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
	private function getDateFromTime($time)
    {
        date_default_timezone_set("Asia/Tehran");
        $sweetDate = new SweetDate(false, true, 'Asia/Tehran');
        $dt = $sweetDate->date("l\n y/m/d", $time);
        return $dt;
    }
    private function loadData()
    {
        $this->row=[];
        $AllCount1 = count($this->Data['data']);
        for ($i = 0; $i < $AllCount1; $i++) {
            $item=$this->Data['data'][$i];
            $rowIndex=$this->getEmployeeIndex($this->Data['personel'][$i]->getId());
            $this->row[$rowIndex]['employee']=$this->Data['personel'][$i];
            $this->row[$rowIndex]['bakhsh']=$this->Data['bakhsh'][$i];
            $this->row[$rowIndex]['role']=$this->Data['role'][$i];
            $this->row[$rowIndex]['eshteghaltype']=$this->Data['eshteghaltype'][$i];

//            echo $item->getShifttype_fid() . "  --  ";
            $this->row[$rowIndex][$item->getDue_date()][$item->getShifttype_fid()]['exists']=true;
            $this->row[$rowIndex][$item->getDue_date()][$item->getShifttype_fid()]['id']=$item->getId();
            $this->row[$rowIndex][$item->getDue_date()][$item->getShifttype_fid()]['shifttype']=$this->Data['shifttype'][$i];
        }
//        print_r($this->row);
    }
    private function getEmployeeIndex($EmployeeID)
    {
        if($this->EmployeeIDs==null)
        {
            $this->EmployeeIDs=[$EmployeeID];
            return 0;
        }
        else
        {
            $Index=array_search($EmployeeID,$this->EmployeeIDs);
            if($Index===false)
            {

                array_push($this->EmployeeIDs,$EmployeeID);
                return count($this->EmployeeIDs)-1;
            }
            return $Index;
        }
    }
	public function getBodyHTML($command=null)
	{
		$this->loadData();
		if(key_exists('bakhsh',$this->Data) && count($this->Data['bakhsh'])>0)
        {
        $l=new Lable('مرکز آموزشی و درمانی و تحقیقاتی بیمارستان امام رضا(ع)');
        $l->setClass('lable');
        $l2=new Lable('گزارش گیری از جدول شیفت');
        $l2->setClass('lable2');
        $l5=new Lable('نام بخش:  ');
        $l5->setClass('lable5');
        $l4=new Lable($this->Data['bakhsh'][0]->getTitleField());
        $l4->setClass('lable4');

        $l6=new Lable('امضاء سرپرستار');
        $l6->setClass('lable6');
        $l7=new Lable('مسئول شیفت');
        $l7->setClass('lable7');
        $l8=new Lable('امضاء مدیر خدمات پرستاری');
        $l8->setClass('lable8');
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("shift_shiftlist");
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
        $AllCount1 = 14;
        if($_GET['reporttype']==4)
            $AllCount1=7;
		$Div1=new ListTable($AllCount1+6);
		$Div1->setClass("twoweekshifttable");
		$Div1->addElement(new Lable('#'));
        $Div1->addElement(new Lable('نام'));
        $Div1->addElement(new Lable('نام خانوادگی'));
        $Div1->addElement(new Lable('سمت'));
        $Div1->addElement(new Lable('نوع استخدام'));
        $Div1->addElement(new Lable('سابقه'));
        $Div1->setHeaderRowCount(1);
        $Div1->SetAttribute('cellspacing',0);
        $daylength=86400;
        for ($i = 0; $i < $AllCount1; $i++)
        {

            $time=$this->Data['starttime']+$daylength*$i;
            $lbl1=new Lable($this->getDateFromTime($time));
            for($t=0;$t<count($this->Data['freedates']);$t++)
            {
                if($this->Data['freedates'][$t]->getDay_date()==$time)
                    $lbl1->setClass('freeday');
            }
            $Div1->addElement($lbl1);
        }

		for($i=0;$i<count($this->row);$i++){
			$Name=$this->row[$i]['employee']->getName();
            $Sanavat=$this->row[$i]['employee']->getSanavat();
            $Family=$this->row[$i]['employee']->getFamily();
            $Role=$this->row[$i]['role']->getTitleField();
            $eshteghal=$this->row[$i]['eshteghaltype']->getTitleField();

            $Div1->addElement(new Lable($i+1));
			$Div1->addElement(new Lable($Name));
            $Div1->addElement(new Lable($Family));
            $Div1->addElement(new Lable($Role));
            $Div1->addElement(new Lable($eshteghal));
            $Div1->addElement(new Lable($Sanavat));
            for ($j = 0; $j < $AllCount1; $j++) {
                $daydiv=new Div();
                $daydiv->setClass('twoweekreportitem');


//                echo $this->Data['starttime']+$daylength*$j . " ";

                if(key_exists($this->Data['starttime']+$daylength*$j,$this->row[$i]))
                {
                    $shift=$this->row[$i][$this->Data['starttime']+$daylength*$j];

                    $keys=array_keys($shift);
//                    print_r($keys);
                    $AllKeysCount1 = count($keys);
                    for ($KeyIndex = 0; $KeyIndex < $AllKeysCount1; $KeyIndex++) {
//                        echo $KeyIndex;
                        $ar=new AppRooter('shift','manageshift');
                        $ar->addParameter(new UrlParameter('id',$shift[$keys[$KeyIndex]]['id']));
                        $lnk=new link($ar->getAbsoluteURL(),new Lable($shift[$keys[$KeyIndex]]['shifttype']->getAbbreviation()));
                        $daydiv->addElement($lnk);
                    }
                }
                $Div1->addElement($daydiv);

            }
		}
        $Page->addElement($l);
        $Page->addElement($l2);
        $Page->addElement($l5);
        $Page->addElement($l4);
		$Page->addElement($Div1);
        $Page->addElement($l6);

        $Page->addElement($l8);
        $Page->addElement($l7);


        }
        else
        {
            $Page=new Div();
            $Page->addElement(new Lable('متاسفانه هیچ اطلاعاتی برای این بازه زمانی موجود نیست'));
        }
		$form=new SweetFrom("", "GET", $Page);
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
}
?>