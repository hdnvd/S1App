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
*@creationDate 1396-07-12 - 2017-10-04 03:02
*@lastUpdate 1396-07-12 - 2017-10-04 03:02
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class manageemployeeroles_Design extends FormDesign {
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
            $this->itemPage = 'manageemployeerole';
            $this->listPage = 'manageemployeeroles';
        }
        else
        {
            $this->itemPage = 'manageuseremployeerole';
            $this->listPage = 'manageuseremployeeroles';
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
		$Page->setId("oras_manageemployeeroles");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['employeerole']->getTableTitle() . " ها"));
		$addUrl=new AppRooter('oras',$this->itemPage);
        $addUrl->addParameter(new URLParameter('employeeid',$_GET['employeeid']));
		$LblAdd=new Lable('ثبت پست جدید');
		$lnkAdd=new link($addUrl->getAbsoluteURL(),$LblAdd);
		$lnkAdd->setClass('linkbutton btn btn-primary');
		$lnkAdd->setGlyphiconClass('glyphicon glyphicon-plus');
		$lnkAdd->setId('addemployeerolelink');
		$Page->addElement($lnkAdd);

		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$TableDiv=new Div();
		$TableDiv->setClass('table-responsive');
		$LTable1=new ListTable(6);
		$LTable1->setHeaderRowCount(1);
		$LTable1->setClass("table-striped managelist");
		$LTable1->addElement(new Lable('#'));
		$LTable1->setLastElementClass("listtitle");

		$LTable1->addElement(new Lable('سمت'));
		$LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('بخش'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('نوع استخدام'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('تاریخ شروع'));
        $LTable1->setLastElementClass("listtitle");
		$LTable1->addElement(new Lable('عملیات'));
		$LTable1->setLastElementClass("listtitle");
		for($i=0;$i<count($this->Data['data']);$i++){
			$url=new AppRooter('oras',$this->itemPage);
			$url->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));

			$delurl=new AppRooter('oras',$this->listPage);
			$delurl->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
			$delurl->addParameter(new UrlParameter('delete',1));

			$Role=$this->Data['role_fids'][$i]->getTitleField();
			if($Role=="")
                $Role='- بدون سمت -';
			$lbTit[$i]=new Lable($Role);
			$liTit[$i]=new link($url->getAbsoluteURL(),$lbTit[$i]);


            $recruitmenttype=$this->Data['recruitmenttype_fids'][$i]->getTitleField();
            if($recruitmenttype=="")
                $recruitmenttype='- بدون نوع استخدام -';
            $recruitmenttypes[$i]=new Lable($recruitmenttype);


            $place=$this->Data['place_fids'][$i]->getTitleField();
            if($place=="")
                $place='- بدون نوع استخدام -';
            $places[$i]=new Lable($place);


            $StartTime=$this->Data['data'][$i]->getStart_time();
            $StartTimeDate=new SweetDate();
            $StartTime=$StartTimeDate->date('Y/m/d',$StartTime);
            $StartTimes[$i]=new Lable($StartTime);


			$lbDel[$i]=new Lable('حذف');
			$liDel[$i]=new link($delurl->getAbsoluteURL(),$lbDel[$i]);
			$liDel[$i]->setGlyphiconClass('glyphicon glyphicon-remove');
			$liDel[$i]->setClass('btn btn-danger');

			$LTable1->addElement(new Lable($i+1));
			$LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($liTit[$i]);
			$LTable1->setLastElementClass("listcontent");
            $LTable1->addElement($places[$i]);
            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement($recruitmenttypes[$i]);
            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement($StartTimes[$i]);
            $LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($liDel[$i]);
			$LTable1->setLastElementClass("listcontent");
		}
		$TableDiv->addElement($LTable1);
		$Page->addElement($TableDiv);
		$empParams=new UrlParameter('employeeid',$_GET['employeeid']);
		$Page->addElement($this->getPaginationPart($this->Data['pagecount'],"oras",$this->listPage,[$empParams]));
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>