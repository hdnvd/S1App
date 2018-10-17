<?php
namespace Modules\itsap\Forms;
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
*@creationDate 1396-09-29 - 2017-12-20 15:49
*@lastUpdate 1396-09-29 - 2017-12-20 15:49
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class outbox_Design extends FormDesign {
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
    private $itemViewPage;
    /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
        $this->itemViewPage = 'servicerequest';
        if($adminMode==true)
        {
            $this->itemPage = 'servicerequest';
            $this->listPage = 'manageservicerequests';
        }
        else
        {
            $this->itemPage = 'manageuserservicerequest';
            $this->listPage = 'manageuserservicerequests';
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
		$Page->setId("itsap_manageservicerequests");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['servicerequest']->getTableTitle() . " ها"));
//		$addUrl=new AppRooter('itsap','manageservicerequest');
//		$LblAdd=new Lable('افزودن آیتم جدید');
//		$lnkAdd=new link($addUrl->getAbsoluteURL(),$LblAdd);
//		$lnkAdd->setClass('linkbutton btn btn-primary');
//		$lnkAdd->setGlyphiconClass('glyphicon glyphicon-plus');
//		$lnkAdd->setId('addservicerequestlink');
//		$Page->addElement($lnkAdd);
		$SearchUrl=new AppRooter('itsap',$this->listPage);
		$SearchUrl->addParameter(new URLParameter('search',null));
		$LblSearch=new Lable('جستجو');
		$lnkSearch=new link($SearchUrl->getAbsoluteURL(),$LblSearch);
		$lnkSearch->setClass('linkbutton btn btn-primary');
		$lnkSearch->setGlyphiconClass('glyphicon glyphicon-search');
		$lnkSearch->setId('searchservicerequestlink');
		$Page->addElement($lnkSearch);
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$TableDiv=new Div();
		$TableDiv->setClass('table-responsive');

        $TOPDiv=new Div();
        $TOPDiv->setClass("formtable");
        $TOPDiv->addElement($this->getInfoRowCode(new Lable($this->Data['topunit']->getTitle()),"یگان مادر"));
        $TOPDiv->addElement($this->getInfoRowCode(new Lable($this->Data['itunitadmin']->getName() . " " . $this->Data['itunitadmin']->getFamily()),"مدیر یگان فاوا"));
        $TOPDiv->addElement($this->getInfoRowCode(new Lable($this->Data['unit']->getTitle()),"یگان درخواست کننده"));
        $TOPDiv->addElement($this->getInfoRowCode(new Lable($this->Data['employee']->getName() . " " . $this->Data['employee']->getFamily()),"درخواست کننده"));

        $LTable1=new ListTable(8);
		$LTable1->setHeaderRowCount(1);
		$LTable1->setClass("table-striped table-hover managelist");
		$LTable1->addElement(new Lable('#'));
		$LTable1->setLastElementClass("listtitle");
		$LTable1->addElement(new Lable('عنوان'));
		$LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('درخواست کننده'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('یگان درخواست کننده'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('تاریخ درخواست'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('وضعیت'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('اولویت'));
        $LTable1->setLastElementClass("listtitle");
		$LTable1->addElement(new Lable('عملیات'));
		$LTable1->setLastElementClass("listtitle");
		for($i=0;$i<count($this->Data['data']);$i++){
			$url=new AppRooter('itsap',$this->itemPage);
			$url->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
			$Title=$this->Data['data'][$i]->getTitleField();
			if($Title=="")
				$Title='- بدون عنوان -';
			$lbTit[$i]=new Lable($Title);
			$liTit[$i]=new link($url->getAbsoluteURL(),$lbTit[$i]);
			$ViewURL=new AppRooter('itsap',$this->itemViewPage);
			$ViewURL->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
			$lbView[$i]=new Lable('مشاهده');
			$lnkView[$i]=new link($ViewURL->getAbsoluteURL(),$lbView[$i]);
			$lnkView[$i]->setGlyphiconClass('glyphicon glyphicon-eye-open');
			$lnkView[$i]->setClass('btn btn-primary');
			$delurl=new AppRooter('itsap',$this->listPage);
			$delurl->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
			$delurl->addParameter(new UrlParameter('delete',1));
//			$lbDel[$i]=new Lable('حذف');
//			$lnkDel[$i]=new link($delurl->getAbsoluteURL(),$lbDel[$i]);
//			$lnkDel[$i]->setGlyphiconClass('glyphicon glyphicon-remove');
//			$lnkDel[$i]->setClass('btn btn-danger');
			$operationDiv[$i]=new Div();
			$operationDiv[$i]->setClass('operationspart');
			$operationDiv[$i]->addElement($lnkView[$i]);
//			$operationDiv[$i]->addElement($lnkDel[$i]);
			$LTable1->addElement(new Lable($i+1));
			$LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($liTit[$i]);
			$LTable1->setLastElementClass("listcontent");
            $LTable1->addElement(new Lable($this->Data['requesters'][$i]['employee']->getName() . " " . $this->Data['requesters'][$i]['employee']->getFamily()));
            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement(new Lable($this->Data['requesters'][$i]['unit']->getTitle() . " - " . $this->Data['requesters'][$i]['topunit']->getTitle()));
            $LTable1->setLastElementClass("listcontent");

            $request_date_SD=new SweetDate(true, true, 'Asia/Tehran');
            $request_date_Text=$request_date_SD->date("l d F Y",$this->Data['data'][$i]->getRequest_date());
            $LTable1->addElement(new Lable($request_date_Text));
            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement(new Lable($this->Data['currentstatusinfo'][$i]->getTitle()));
            $LTable1->setLastElementClass("listcontent");
            $priorityImages=new Div();
            $priorityImages->setClass('priorityimagesbox');
            for($starindex=0;$starindex<$this->Data['data'][$i]->getPriority();$starindex++)
            {
                $img=new Image(DEFAULT_PUBLICURL . "content/files/img/star.png");
                $priorityImages->addElement($img);
            }
            $LTable1->addElement($priorityImages);
            $LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($operationDiv[$i]);
			$LTable1->setLastElementClass("listcontent");
		}
        $TableDiv->addElement($TOPDiv);
		$TableDiv->addElement($LTable1);
		$Page->addElement($TableDiv);
		$Page->addElement($this->getPaginationPart($this->Data['pagecount'],"itsap",$this->listPage));
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}    
    public function getJSON()
    {
       parent::getJSON();
       $Result=['message'=>$this->getMessage(),'messagetype'=>$this->getMessageType()];
       return json_encode($Result);
    }
}
?>