<?php
namespace Modules\ocms\Forms;
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
*@creationDate 1396-09-23 - 2017-12-14 01:18
*@lastUpdate 1396-09-23 - 2017-12-14 01:18
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managedoctorplans_Design extends FormDesign {
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
        $this->itemViewPage = 'doctorplan';
        if($adminMode==true)
        {
            $this->itemPage = 'managedoctorplan';
            $this->listPage = 'managedoctorplans';
        }
        else
        {
            $this->itemPage = 'manageuserdoctorplan';
            $this->listPage = 'manageuserdoctorplans';
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
		$Page->setId("ocms_managedoctorplans");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['doctorplan']->getTableTitle() . " ها"));
		$addUrl=new AppRooter('ocms',$this->itemPage);
        $addUrl->addParameter(new UrlParameter('username',$_GET['username']));
        $addUrl->addParameter(new UrlParameter('password',$_GET['password']));
		$LblAdd=new Lable('وقت تکی جدید');
		$lnkAdd=new link($addUrl->getAbsoluteURL(),$LblAdd);
		$lnkAdd->setClass('linkbutton btn btn-primary');
		$lnkAdd->setGlyphiconClass('glyphicon glyphicon-plus');
		$lnkAdd->setId('adddoctorplanlink');
		$Page->addElement($lnkAdd);

        $addBatchUrl=new AppRooter('ocms',$this->itemPage);
        $addBatchUrl->addParameter(new UrlParameter('username',$_GET['username']));
        $addBatchUrl->addParameter(new UrlParameter('password',$_GET['password']));
        $addBatchUrl->addParameter(new UrlParameter('batch_mode','1'));
        $LblBatchAdd=new Lable('مجموعه وقت جدید');
        $lnkBatchAdd=new link($addBatchUrl->getAbsoluteURL(),$LblBatchAdd);
        $lnkBatchAdd->setClass('linkbutton btn btn-primary');
        $lnkBatchAdd->setGlyphiconClass('glyphicon glyphicon-plus');
        $lnkBatchAdd->setId('adddoctorplanlink');
        $Page->addElement($lnkBatchAdd);

		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$TableDiv=new Div();
		$TableDiv->setClass('table-responsive');
		$LTable1=new ListTable(3);
		$LTable1->setHeaderRowCount(1);
		$LTable1->setClass("table-striped table-hover managelist");
		$LTable1->addElement(new Lable('#'));
		$LTable1->setLastElementClass("listtitle");
		$LTable1->addElement(new Lable('عنوان'));
		$LTable1->setLastElementClass("listtitle");
		$LTable1->addElement(new Lable('عملیات'));
		$LTable1->setLastElementClass("listtitle");
		for($i=0;$i<count($this->Data['data']);$i++){
			$url=new AppRooter('ocms',$this->itemPage);
			$url->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
            $url->addParameter(new UrlParameter('username',$_GET['username']));
            $url->addParameter(new UrlParameter('password',$_GET['password']));
			$Title=$this->Data['data'][$i]->getStart_time();
            date_default_timezone_set("Asia/Tehran");
            $sweetDate = new SweetDate(false, true, 'Asia/Tehran');
            $Title = $sweetDate->date("Y/m/d H:i", $Title);
			if($Title=="")
				$Title='- بدون عنوان -';
			$lbTit[$i]=new Lable($Title);
			$liTit[$i]=new link($url->getAbsoluteURL(),$lbTit[$i]);
			$ViewURL=new AppRooter('ocms',$this->itemViewPage);
			$ViewURL->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
//			$lbView[$i]=new Lable('مشاهده');
//			$lnkView[$i]=new link($ViewURL->getAbsoluteURL(),$lbView[$i]);
//			$lnkView[$i]->setGlyphiconClass('glyphicon glyphicon-eye-open');
//			$lnkView[$i]->setClass('btn btn-primary');
			$delurl=new AppRooter('ocms',$this->listPage);
			$delurl->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
			$delurl->addParameter(new UrlParameter('delete',1));
            $delurl->addParameter(new UrlParameter('username',$_GET['username']));
            $delurl->addParameter(new UrlParameter('password',$_GET['password']));
			$lbDel[$i]=new Lable('حذف');
			$lnkDel[$i]=new link($delurl->getAbsoluteURL(),$lbDel[$i]);
			$lnkDel[$i]->setGlyphiconClass('glyphicon glyphicon-remove');
			$lnkDel[$i]->setClass('btn btn-danger');
			$operationDiv[$i]=new Div();
			$operationDiv[$i]->setClass('operationspart');
//			$operationDiv[$i]->addElement($lnkView[$i]);
			$operationDiv[$i]->addElement($lnkDel[$i]);
			$LTable1->addElement(new Lable($i+1));
			$LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($liTit[$i]);
			$LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($operationDiv[$i]);
			$LTable1->setLastElementClass("listcontent");
		}
		$TableDiv->addElement($LTable1);
		$Page->addElement($TableDiv);
		$Page->addElement($this->getPaginationPart($this->Data['pagecount'],"ocms",$this->listPage,[new UrlParameter('username',$_GET['username']),new UrlParameter('password',$_GET['password'])]));
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