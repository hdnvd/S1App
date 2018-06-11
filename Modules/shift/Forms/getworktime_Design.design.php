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
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-17 - 2018-04-06 18:22
*@lastUpdate 1397-01-17 - 2018-04-06 18:22
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class getworktime_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	private $FieldCaptions;
	/** @var DatePicker */
	private $startdate;

    /**
     * @return DatePicker
     */
    public function getStartdate()
    {
        return $this->startdate;
    }
	/** @var textbox */
	private $txtdaycount;
	/**
	 * @return textbox
	 */
	public function getTxtdaycount()
	{
		return $this->txtdaycount;
	}
	/** @var SweetButton */
	private $btnGenerate;
	public function __construct()
	{
		$this->FieldCaptions=array();

		/******* startdate *******/
		$this->startdate= new DatePicker("startdate");
		$this->startdate->setClass("form-control");

		/******* txtdaycount *******/
		$this->txtdaycount= new textbox("txtdaycount");
		$this->txtdaycount->setClass("form-control");

		/******* btnGenerate *******/
		$this->btnGenerate= new SweetButton(true,"استخراج اضافه کاری ها");
		$this->btnGenerate->setAction("btnGenerate");
		$this->btnGenerate->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
		$this->btnGenerate->setClass("btn btn-primary");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("shift_getworktime");
		$Page->addElement($this->getPageTitlePart("استخراج اضافه کاری"));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable2=new Div();
		$LTable2->setClass("formtable");
        $LTable2->addElement($this->getFieldRowCode($this->startdate,"تاریخ شروع",null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
        $LTable2->addElement($this->getFieldRowCode($this->txtdaycount,"تعداد روزها",null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
        $LTable2->addElement($this->getSingleFieldRowCode($this->btnGenerate));
		$Page->addElement($LTable2);
		if(key_exists('personel',$this->Data) )
        {
            $InfoDiv=new Div();
            $InfoDiv->addElement(new Lable("تعداد کل روزها: ".$this->Data['alldaycount']));
            $InfoDiv->addElement(new Lable("تعداد کل روزهای کاری: ".$this->Data['workdaycount']));
            $InfoDiv->addElement(new Lable("تعداد کل روزهای تعطیل: ".$this->Data['freedaycount']));
            $InfoDiv->addElement(new Lable("تعداد ساعات مورد انتظار: ".round($this->Data['requiredworktime']/60)));
            $Page->addElement($InfoDiv);
            $TableDiv=new Div();
            $TableDiv->setClass('table-responsive');
            $LTable1=new ListTable(7);
            $LTable1->setHeaderRowCount(1);
            $LTable1->setClass("table-striped table-hover managelist");
            $LTable1->addElement(new Lable('#'));
            $LTable1->setLastElementClass("listtitle");
            $LTable1->addElement(new Lable('نام و نام خانوادگی'));
            $LTable1->setLastElementClass("listtitle");
            $LTable1->addElement(new Lable('تعداد کل شیفت ها'));
            $LTable1->setLastElementClass("listtitle");
            $LTable1->addElement(new Lable('تعداد کل شیفت های تعطیل'));
            $LTable1->setLastElementClass("listtitle");
            $LTable1->addElement(new Lable('مجموع ساعات کاری'));
            $LTable1->setLastElementClass("listtitle");
            $LTable1->addElement(new Lable('مجموع ساعات کاری با ضریب'));
            $LTable1->setLastElementClass("listtitle");
            $LTable1->addElement(new Lable('اضافه کاری'));
            $LTable1->setLastElementClass("listtitle");
            for($i=0;$i<count($this->Data['personel']);$i++){
                $Title=$this->Data['personel'][$i]->getName() . " " . $this->Data['personel'][$i]->getFamily();
                if($Title=="")
                    $Title='- بدون عنوان -';
                $lbTit[$i]=new Lable($Title);

                $totaltimewithoutfactor[$i]=$this->Data['timeinfo'][$i]['totaltimewithoutfactor']/60;
                $lbtotaltimewithoutfactor[$i]=new Lable(round($totaltimewithoutfactor[$i])." ساعت");
                $totaltimewithfactor[$i]=$this->Data['timeinfo'][$i]['totaltimewithfactor']/60;
                $lbtotaltimewithfactor[$i]=new Lable(round($totaltimewithfactor[$i])." ساعت");
                $lbholidayshiftcount[$i]=new Lable($this->Data['timeinfo'][$i]['holidayshiftcount']);
                $lbshiftcount[$i]=new Lable($this->Data['timeinfo'][$i]['shiftcount']);
                $extratime[$i]=$this->Data['timeinfo'][$i]['extratime']/60;
                $lbextratime[$i]=new Lable(round($extratime[$i]) . "ساعت");


                $LTable1->addElement(new Lable($i+1));
                $LTable1->setLastElementClass("listcontent");
                $LTable1->addElement($lbTit[$i]);
                $LTable1->setLastElementClass("listcontent");

                $LTable1->addElement($lbshiftcount[$i]);
                $LTable1->setLastElementClass("listcontent");
                $LTable1->addElement($lbholidayshiftcount[$i]);
                $LTable1->setLastElementClass("listcontent");
                $LTable1->addElement($lbtotaltimewithoutfactor[$i]);
                $LTable1->setLastElementClass("listcontent");
                $LTable1->addElement($lbtotaltimewithfactor[$i]);
                $LTable1->setLastElementClass("listcontent");
                $LTable1->addElement($lbextratime[$i]);
                $LTable1->setLastElementClass("listcontent");
            }
            $TableDiv->addElement($LTable1);
            $Page->addElement($TableDiv);
        }

		$form=new SweetFrom("", "POST", $Page);
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
}
?>