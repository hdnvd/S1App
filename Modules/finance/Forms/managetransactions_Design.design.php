<?php
namespace Modules\finance\Forms;
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
*@creationDate 1396-11-09 - 2018-01-29 11:26
*@lastUpdate 1396-11-09 - 2018-01-29 11:26
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managetransactions_Design extends FormDesign {
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
        $this->itemViewPage = 'transaction';
        if($adminMode==true)
        {
            $this->itemPage = 'managetransaction';
            $this->listPage = 'managetransactions';
        }
        else
        {
            $this->itemPage = 'manageusertransaction';
            $this->listPage = 'manageusertransactions';
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
		$Page->setId("finance_managetransactions");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['transaction']->getTableTitle() . " ها"));
		$addUrl=new AppRooter('finance',$this->itemPage);
		$LblAdd=new Lable('افزودن آیتم جدید');
		$lnkAdd=new link($addUrl->getAbsoluteURL(),$LblAdd);
		$lnkAdd->setClass('linkbutton btn btn-primary');
		$lnkAdd->setGlyphiconClass('glyphicon glyphicon-plus');
		$lnkAdd->setId('addtransactionlink');
		$Page->addElement($lnkAdd);
		$SearchUrl=new AppRooter('finance',$this->listPage);
		$SearchUrl->addParameter(new URLParameter('search',null));
		$LblSearch=new Lable('جستجو');
		$lnkSearch=new link($SearchUrl->getAbsoluteURL(),$LblSearch);
		$lnkSearch->setClass('linkbutton btn btn-primary');
		$lnkSearch->setGlyphiconClass('glyphicon glyphicon-search');
		$lnkSearch->setId('searchtransactionlink');
		$Page->addElement($lnkSearch);
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$TableDiv=new Div();
		$TableDiv->setClass('table-responsive');
		$LTable1=new ListTable(7);
		$LTable1->setHeaderRowCount(1);
		$LTable1->setClass("table-striped table-hover managelist");
		$LTable1->addElement(new Lable('#'));
		$LTable1->setLastElementClass("listtitle");
		$LTable1->addElement(new Lable('عنوان'));
		$LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('مبلغ'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('صاحب حساب'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('وضعیت'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('تاریخ'));
        $LTable1->setLastElementClass("listtitle");
		$LTable1->addElement(new Lable('عملیات'));
		$LTable1->setLastElementClass("listtitle");
		for($i=0;$i<count($this->Data['data']);$i++){
			$url=new AppRooter('finance',$this->itemPage);
			$url->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
			$Title=$this->Data['data'][$i]->getTitleField();
            $Price[$i]=$this->Data['data'][$i]->getAmount();
            $Time[$i]=$this->Data['data'][$i]->getAdd_Time();
            date_default_timezone_set("Asia/Tehran");
            $sweetDate = new SweetDate(false, true, 'Asia/Tehran');
            $Time[$i] = $sweetDate->date("Y/m/d H:i", $Time[$i]);
            if(key_exists('userinfo',$this->Data) && key_exists($i,$this->Data['userinfo']) && $this->Data['userinfo'][$i]!=null)
                $UserName[$i]=$this->Data['userinfo'][$i]->getName(). " " . $this->Data['userinfo'][$i]->getFamily();
            elseif(key_exists('bankpayment',$this->Data) && key_exists($i,$this->Data['bankpayment']) && $this->Data['bankpayment'][$i]!=null)
                $UserName[$i]=$this->Data['bankpayment'][$i]->getName() . " " . $this->Data['bankpayment'][$i]->getFamily();
            else
                $UserName[$i]="--";
            if(trim($UserName[$i])=='-1')
                $UserName[$i]='سیستم';
            $Status[$i]=$this->Data['data'][$i]->getIsSuccessful();
            if(trim($Status[$i])=='1')
                $Status[$i]='موفق';
            else
                $Status[$i]='نا موفق';
			if($Title=="")
				$Title='- بدون توضیحات -';
			$lbTit[$i]=new Lable($Title);
			$liTit[$i]=new link($url->getAbsoluteURL(),$lbTit[$i]);
			$ViewURL=new AppRooter('finance',$this->itemViewPage);
			$ViewURL->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
			$lbView[$i]=new Lable('مشاهده');
			$lnkView[$i]=new link($ViewURL->getAbsoluteURL(),$lbView[$i]);
			$lnkView[$i]->setGlyphiconClass('glyphicon glyphicon-eye-open');
			$lnkView[$i]->setClass('btn btn-primary');
			$delurl=new AppRooter('finance',$this->listPage);
			$delurl->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
			$delurl->addParameter(new UrlParameter('delete',1));
			$lbDel[$i]=new Lable('حذف');
			$lnkDel[$i]=new link($delurl->getAbsoluteURL(),$lbDel[$i]);
			$lnkDel[$i]->setGlyphiconClass('glyphicon glyphicon-remove');
			$lnkDel[$i]->setClass('btn btn-danger');
			$operationDiv[$i]=new Div();
			$operationDiv[$i]->setClass('operationspart');
//			$operationDiv[$i]->addElement($lnkView[$i]);
//			$operationDiv[$i]->addElement($lnkDel[$i]);
			$LTable1->addElement(new Lable($i+1));
			$LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($liTit[$i]);
			$LTable1->setLastElementClass("listcontent");
            $LTable1->addElement(new Lable($Price[$i]));
            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement(new Lable($UserName[$i]));
            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement(new Lable($Status[$i]));
            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement(new Lable($Time[$i]));
            $LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($operationDiv[$i]);
			$LTable1->setLastElementClass("listcontent");
		}
		$TableDiv->addElement($LTable1);
		$Page->addElement($TableDiv);
		$Page->addElement($this->getPaginationPart($this->Data['pagecount'],"finance",$this->listPage));
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