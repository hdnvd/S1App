<?php
namespace Modules\oras\Forms;
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
*@creationDate 1396-07-12 - 2017-10-04 18:49
*@lastUpdate 1396-07-12 - 2017-10-04 18:49
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managerecords_Design extends FormDesign {
	private $Data;
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
        private $listPage;
    private $itemPage;
    /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
        if($adminMode==true)
        {
            $this->itemPage = 'managerecord';
            $this->listPage = 'managerecords';
        }
        else
        {
            $this->itemPage = 'manageuserrecord';
            $this->listPage = 'manageuserrecords';
        }
    }
	public function __construct()
	{
		parent::__construct();
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("oras_managerecords");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['record']->getTableTitle() . " ها"));
		$addUrl=new AppRooter('oras',$this->itemPage);
        if(isset($this->Data['employee']) && $this->Data['employee']!=null)
            $addUrl->addParameter(new URLParameter('employeeid',$this->Data['employee']->getID()));
        if(isset($this->Data['place']) && $this->Data['place']!=null)
            $addUrl->addParameter(new URLParameter('placeid',$this->Data['place']->getID()));
		$LblAdd=new Lable('ثبت گزارش جدید');
		$lnkAdd=new link($addUrl->getAbsoluteURL(),$LblAdd);
		$lnkAdd->setClass('linkbutton btn btn-primary');
		$lnkAdd->setGlyphiconClass('glyphicon glyphicon-plus');
		$lnkAdd->setId('addrecordlink');
		$Page->addElement($lnkAdd);
		$SearchUrl=new AppRooter('oras',$this->listPage);
		$SearchUrl->addParameter(new URLParameter('search',null));
		if(isset($this->Data['employee']) && $this->Data['employee']!=null)
            $SearchUrl->addParameter(new URLParameter('employeemellicode',$this->Data['employee']->getMellicode()));
        if(isset($this->Data['place']) && $this->Data['place']!=null)
            $SearchUrl->addParameter(new URLParameter('place_fid',$this->Data['place']->getID()));
		$LblSearch=new Lable('جستجو');
		$lnkSearch=new link($SearchUrl->getAbsoluteURL(),$LblSearch);
		$lnkSearch->setClass('linkbutton btn btn-primary');
		$lnkSearch->setGlyphiconClass('glyphicon glyphicon-search');
		$lnkSearch->setId('searchrecordlink');
		$Page->addElement($lnkSearch);

        $StatsPartDiv=new Div();
        $StatsPartDiv->setClass('table-responsive');
		$StatsPart=new ListTable(7);
        $StatsPart->setHeaderRowCount(1);
        $StatsPart->setClass('statspart table table-striped table-inverse');
		$StatsPart->addElement(new Lable('تعداد نتایج'));
        $StatsPart->setLastElementClass("listtitle");
        $StatsPart->addElement(new Lable('تعداد نتایج بی تاثیر'));
        $StatsPart->setLastElementClass("listtitle");
        $StatsPart->addElement(new Lable('تعداد نتایج منفی'));
        $StatsPart->setLastElementClass("listtitle");
        $StatsPart->addElement(new Lable('تعداد نتایج مثبت'));
        $StatsPart->setLastElementClass("listtitle");
        $StatsPart->addElement(new Lable('جمع امتیاز منفی'));
        $StatsPart->setLastElementClass("listtitle");
        $StatsPart->addElement(new Lable('جمع امتیاز مثبت'));
        $StatsPart->setLastElementClass("listtitle");
        $StatsPart->addElement(new Lable('تعداد اسناد'));
        $StatsPart->setLastElementClass("listtitle");

        $lblTotalCount=new Lable($this->Data['totalcount']);
        $StatsPart->addElement($lblTotalCount);
        $StatsPart->setLastElementClass("listcontent");
        $lblTotalZeroCount=new Lable($this->Data['totalzeropointscount']);
        $StatsPart->addElement($lblTotalZeroCount);
        $StatsPart->setLastElementClass("listcontent");
        $lbltotalnegativepointscount=new Lable($this->Data['totalnegativepointscount']);
        $StatsPart->addElement($lbltotalnegativepointscount);
        $StatsPart->setLastElementClass("listcontent");
        $lbltotalpositivepointscount=new Lable($this->Data['totalpositivepointscount']);
        $StatsPart->addElement($lbltotalpositivepointscount);
        $StatsPart->setLastElementClass("listcontent");
        $lbltotalnegativepoints=new Lable($this->Data['totalnegativepoints']);
        $StatsPart->addElement($lbltotalnegativepoints);
        $StatsPart->setLastElementClass("listcontent");
        $lbltotalpositivepoints=new Lable($this->Data['totalpositivepoints']);
        $StatsPart->addElement($lbltotalpositivepoints);
        $StatsPart->setLastElementClass("listcontent");
        $lbltotalfilecount=new Lable($this->Data['totalfilecount']);
        $StatsPart->addElement($lbltotalfilecount);
        $StatsPart->setLastElementClass("listcontent");

        $StatsPartDiv->addElement($StatsPart);



		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$TableDiv=new Div();
		$TableDiv->setClass('table-responsive');
		$LTable1=new ListTable(9);
		$LTable1->setHeaderRowCount(1);
		$LTable1->setClass("table-striped table-hover managelist");
		$LTable1->addElement(new Lable('#'));
		$LTable1->setLastElementClass("listtitle");
		$LTable1->addElement(new Lable('بخش'));
		$LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('کارمند'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('تاریخ'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('نوع'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('امتیاز'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('شیفت'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('تعداد سند'));
        $LTable1->setLastElementClass("listtitle");
		$LTable1->addElement(new Lable('عملیات'));
		$LTable1->setLastElementClass("listtitle");
		for($i=0;$i<count($this->Data['data']);$i++){
            $delurl=new AppRooter('oras',$this->listPage);
            $delurl->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
            if(isset($_GET['employeeid']))
                $delurl->addParameter(new UrlParameter('employeeid',$_GET['employeeid']));
            if(isset($_GET['placeid']))
                $delurl->addParameter(new UrlParameter('placeid',$_GET['placeid']));
            $delurl->addParameter(new UrlParameter('delete',null));
            $lbDel[$i]=new Lable('حذف');
            $liDel[$i]=new link($delurl->getAbsoluteURL(),$lbDel[$i]);
            $liDel[$i]->setGlyphiconClass('glyphicon glyphicon-remove');
            $liDel[$i]->setClass('btn btn-danger');

            $Recordurl=new AppRooter('oras','record');
            $Recordurl->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
            $lbRecord[$i]=new Lable('مشاهده');
            $liRecord[$i]=new link($Recordurl->getAbsoluteURL(),$lbRecord[$i]);
            $liRecord[$i]->setGlyphiconClass('glyphicon glyphicon-eye-open');
            $liRecord[$i]->setClass('btn btn-primary');

            $operationDiv[$i]=new Div();
            $operationDiv[$i]->setClass('operationspart');
            $operationDiv[$i]->addElement($liRecord[$i]);
            $operationDiv[$i]->addElement($liDel[$i]);


			$url=new AppRooter('oras',$this->itemPage);
			$url->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));


			$Place=$this->Data['itemplace'][$i];
			if($Place==null)
                $Place='- - -';
			else
                $Place=$Place->getTitle();
			$lbPlace[$i]=new Lable($Place);
			$liPlace[$i]=new link($url->getAbsoluteURL(),$lbPlace[$i]);

			$Employee=$this->Data['itememployee'][$i];
			if($Employee==null)
                $Employee='- - -';
            else
                $Employee=$Employee->getName() . " " . $Employee->getFamily();
			$lbEmployee[$i]=new Lable($Employee);
			$liEmployee[$i]=new link($url->getAbsoluteURL(),$lbEmployee[$i]);


			$Type=$this->Data['itemtype'][$i];
			if($Type==null)
            {
                $Point=0;
                $Type='- - -';
            }
            else
            {
                $Point=$Type->getPoints();
                $Type=$Type->getTitle();
            }
			$lbType[$i]=new Lable($Type);
			$liType[$i]=new link($url->getAbsoluteURL(),$lbType[$i]);
            $lbPoint[$i]=new Lable($Point);
            $liPoint[$i]=new link($url->getAbsoluteURL(),$lbPoint[$i]);


			$ShiftType=$this->Data['itemshifttype'][$i];
			if($ShiftType==null)
                $ShiftType='- - -';
            else
                $ShiftType=$ShiftType->getTitle();
			$lbShiftType[$i]=new Lable($ShiftType);
			$liShiftType[$i]=new link($url->getAbsoluteURL(),$lbShiftType[$i]);


            $OCTime=$this->Data['data'][$i]->getOccurance_date();
            $SD=new SweetDate();
            $OCDate=$SD->date("l Y/m/d",$OCTime);
            $lbOCDate[$i]=new Lable($OCDate);
            $liOCDate[$i]=new link($url->getAbsoluteURL(),$lbOCDate[$i]);


            $FileCount=$this->Data['itemfilecount'][$i];
            $lbFileCount[$i]=new Lable($FileCount);
            $liFileCount[$i]=new link($url->getAbsoluteURL(),$lbFileCount[$i]);

			$LTable1->addElement(new Lable($i+1));
			$LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($liPlace[$i]);
			$LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($liEmployee[$i]);
			$LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($liOCDate[$i]);
			$LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($liType[$i]);
			$LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($liPoint[$i]);
			$LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($liShiftType[$i]);
			$LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($liFileCount[$i]);
			$LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($operationDiv[$i]);
			$LTable1->setLastElementClass("listcontent");
		}
		$TableDiv->addElement($LTable1);
		$Page->addElement($TableDiv);
		$Page->addElement($this->getPaginationPart($this->Data['pagecount'],"oras",$this->listPage));
		$Page->addElement($StatsPartDiv);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>