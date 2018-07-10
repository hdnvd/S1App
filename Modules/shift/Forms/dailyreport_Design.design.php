<?php
namespace Modules\shift\Forms;
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
use Modules\shift\Entity\shift_eshteghalEntity;

/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 00:33
*@lastUpdate 1396-11-05 - 2018-01-25 00:33
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class dailyreport_Design extends FormDesign {
	private $Data;
	private $Roles;
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
        $dt = $sweetDate->date("l d F y", $time);
        return $dt;
    }
    private function loadData()
    {
        $this->row=[];
        $this->Roles=[];
        $AllCount1 = count($this->Data['data']);
        for ($i = 0; $i < $AllCount1; $i++) {
            $item=$this->Data['data'][$i];
            $this->row[$item->getBakhsh_fid()]['bakhsh']=$this->Data['bakhsh'][$i];
            $shiftindex=0;
            if(key_exists('employees',$this->row[$item->getBakhsh_fid()]))
                $shiftindex=count($this->row[$item->getBakhsh_fid()]['employees']);
//            echo $shiftindex;
            $this->row[$item->getBakhsh_fid()]['employees'][$shiftindex]=$this->Data['personel'][$i];
            $this->row[$item->getBakhsh_fid()]['roles'][$shiftindex]=$this->Data['role'][$i];
            if(!key_exists($this->Data['role'][$i]->getId(),$this->Roles))
            {
                $this->Roles[$this->Data['role'][$i]->getId()]['count']=1;
                $this->Roles[$this->Data['role'][$i]->getId()]['title']=$this->Data['role'][$i]->getTitleField();
            }
            else
            {
                $this->Roles[$this->Data['role'][$i]->getId()]['count']++;
            }
        }
//        print_r($this->row);
    }

	public function getBodyHTML($command=null)
	{
        if(key_exists('data',$this->Data) && count($this->Data['data'])>0)
        {
	    $l=new Lable('مرکز آموزشی و درمانی و تحقیقاتی بیمارستان امام رضا(ع)');
	    $l->setClass('lable');
        $l2=new Lable('گزارش گیری از جدول شیفت روزانه تاریخ');
        $l2->setClass('lable2');
        $l3=new Lable($this->getDateFromTime($this->Data['starttime']));
        $l3->setClass('lable3');
        $l5=new Lable('نوع شیفت:  ');
        $l5->setClass('lable5');
        $shift=$this->Data['data'][0]->getShifttype_fid();
        switch ($shift)
        {
            case 1:
            $shift='صبح';
            break;

            case 2:
            $shift='بعد از ظهر';
            break;

            case 3:
            $shift='شب';
            break;

            case 4:
            $shift='';
            break;

            case 5:
            $shift='مرخصی متفرقه';
            break;
            case 6:
                $shift=' مرخصی استعلاجی';
                break;
            case 7:
                $shift=' مرخصی زایمان';
                break;
        }
        $l4=new Lable($shift);
        $l4->setClass('lable4');
		$this->loadData();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("shift_shiftlist");
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$Div1=new ListTable(1);
		$Div1->setClass("dilyshiftdiv");

		$PageLength=$_GET['pagelength'];
		$pageIndex=-1;
        $pageDivs=[];
		$bakhshIDs=array_keys($this->row);
        $AllCount1 = count($bakhshIDs);

        for ($i = 0; $i < $AllCount1; $i++) {
            if($i%$PageLength==0)
            {
                if($pageIndex>=0)
                    $Div1->addElement($pageDivs[$pageIndex]);
                $pageIndex++;
                $pageDivs[$pageIndex]=new Div();
                $pageDivs[$pageIndex]->setClass('dailyreportpage');
            }

            $key=$bakhshIDs[$i];
            $item=$this->row[$key];
            $BakhshTable=new Div();
            $topDiv=new Div();
            $topDiv->setClass('topdiv');

            $bakhshdiv=new Div();
            $bakhshdiv->setClass('bakhshdiv');
            $bakhshdiv->addElement(new Lable("بخش"));
            $titlediv=new Div();
            $titlediv->setClass('titlediv');
            $titlediv->addElement(new Lable($item['bakhsh']->getTitleField()));
            $bastaricountdiv=new Div();
            $bastaricountdiv->setClass('bastaricountdiv');
            $bastaricountdiv->addElement(new Lable("تعداد بستری:"));

            $topDiv->addElement($bakhshdiv);
            $topDiv->addElement($titlediv);
            $topDiv->addElement($bastaricountdiv);

            $BakhshTable->addElement($topDiv);

            $AllCount2 = count($item['employees']);
            $personelDiv=new Div();
            $personelDiv->setClass('personel');
            for ($j = 0; $j < $AllCount2; $j++) {
                $item2=$item['employees'][$j];
                $role=substr(trim($item['roles'][$j]->getTitleField()),0,2);
                $name=new Lable($item2->getName() . " " . $item2->getFamily() . "("  . $role. ")");
                $personDiv=new Div();
                $personDiv->setClass('person');
                $personDiv->addElement($name);
                $personelDiv->addElement($personDiv);
            }
            $BakhshTable->addElement($personelDiv);
            $pageDivs[$pageIndex]->addElement($BakhshTable);
        }

        $StatsDiv=new Div();
        $StatsDiv->setClass('dailyreportstats');

        $keys=array_keys($this->Roles);
        $AllCount1 = count($keys);
        for ($i = 0; $i < $AllCount1; $i++) {

            $key=$keys[$i];
            $item=$this->Roles[$key];
            $ItemDiv=new Div();
            $ItemDiv->addElement(new Lable("جمع " . $item['title'] . " : " . $item['count']));
            $StatsDiv->addElement($ItemDiv);
        }
        $pageDivs[$pageIndex]->addElement($StatsDiv);
        $Div1->addElement($pageDivs[$pageIndex]);
        $Page->addElement($l);
        $Page->addElement($l2);
        $Page->addElement($l3);
        $Page->addElement($l4);
        $Page->addElement($l5);
        $Page->addElement($Div1);
        }
        else
        {
            $Page=new Div();
            $Page->addElement(new Lable('متاسفانه هیچ اطلاعاتی برای این روز موجود نیست'));
        }
		$form=new SweetFrom("", "GET", $Page);
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
}
?>