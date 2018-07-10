<?php
namespace Modules\kpex\Forms;
use core\CoreClasses\html\htmlcode;
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
use Modules\kpex\Entity\kpex_testEntity;

/**
*@author Hadi AmirNahavandi
*@creationDate 1397-03-24 - 2018-06-14 03:29
*@lastUpdate 1397-03-24 - 2018-06-14 03:29
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managetests_Design extends FormDesign {
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
        $this->itemViewPage = 'test';
        if($adminMode==true)
        {
            $this->itemPage = 'managetest';
            $this->listPage = 'managetests';
        }
        else
        {
            $this->itemPage = 'manageusertest';
            $this->listPage = 'manageusertests';
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
		$Page->setId("kpex_managetests");
		$Page->addElement($this->getPageTitlePart(" " . $this->Data['test']->getTableTitle() . " ها"));



		if(key_exists('shellscript',$this->Data))
        {
            $Terminal=new Div();
            $Terminal->setClass('terminal');
            $ShellData=new Lable($this->Data['shellscript']);
            $ShellData->setHtmlContent(false);
            $Terminal->addElement($ShellData);
            $Page->addElement($Terminal);
            $Page->addElement(new htmlcode("<script language='JavaScript'>
function PlaySound(soundObj) {
  var sound = document.getElementById(soundObj);
  sound.play();
}
PlaySound('boom');
</script>"));
            $Page->addElement(new htmlcode("<audio id=\"boom\" autoplay='false'>
   <source src=\"".DEFAULT_PUBLICURL."content/files/1.mp3\" type=\"audio/wav\">
  </audio>"));
        }
		$addUrl=new AppRooter('kpex',$this->itemPage);
		$LblAdd=new Lable('ثبت ' . $this->Data['test']->getTableTitle() . ' جدید');
		$lnkAdd=new link($addUrl->getAbsoluteURL(),$LblAdd);
		$lnkAdd->setClass('linkbutton btn btn-primary');
		$lnkAdd->setGlyphiconClass('glyphicon glyphicon-plus');
		$lnkAdd->setId('addtestlink');
		$Page->addElement($lnkAdd);
		$SearchUrl=new AppRooter('kpex',$this->listPage);
		$SearchUrl->addParameter(new URLParameter('search',null));
		$LblSearch=new Lable('جستجو');
		$lnkSearch=new link($SearchUrl->getAbsoluteURL(),$LblSearch);
		$lnkSearch->setClass('linkbutton btn btn-primary');
		$lnkSearch->setGlyphiconClass('glyphicon glyphicon-search');
		$lnkSearch->setId('searchtestlink');
		$Page->addElement($lnkSearch);
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$TableDiv=new Div();
		$TableDiv->setClass('table-responsive');
		$LTable1=new ListTable(10);
		$LTable1->setHeaderRowCount(1);
		$LTable1->setClass("table-striped table-hover managelist");
		$LTable1->addElement(new Lable('#'));
		$LTable1->setLastElementClass("listtitle");
		$LTable1->addElement(new Lable('عنوان'));
		$LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('NI'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('NOI'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('AI'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('AOI'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('PosTag'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('App Rate'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('Context'));
        $LTable1->setLastElementClass("listtitle");
		$LTable1->addElement(new Lable('عملیات'));
		$LTable1->setLastElementClass("listtitle");
		for($i=0;$i<count($this->Data['data']);$i++){
			$url=new AppRooter('kpex',$this->itemPage);
			$url->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
			$Title=$this->Data['data'][$i]->getID();
			if($Title=="")
				$Title='- بدون عنوان -';
			$lbTit[$i]=new Lable($Title);
			$liTit[$i]=new link($url->getAbsoluteURL(),$lbTit[$i]);
			$ViewURL=new AppRooter('kpex',$this->listPage);
			$ViewURL->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
			$ViewURL->addParameter(new UrlParameter('run',null));
			$lbView[$i]=new Lable('اجرا');
			$lnkView[$i]=new link($ViewURL->getAbsoluteURL(),$lbView[$i]);
			$lnkView[$i]->setGlyphiconClass('glyphicon glyphicon-eye-open');
			$lnkView[$i]->setClass('btn btn-primary');
			$delurl=new AppRooter('kpex',$this->listPage);
			$delurl->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
			$delurl->addParameter(new UrlParameter('delete',1));
			$lbDel[$i]=new Lable('حذف');
			$lnkDel[$i]=new link($delurl->getAbsoluteURL(),$lbDel[$i]);
			$lnkDel[$i]->setGlyphiconClass('glyphicon glyphicon-remove');
			$lnkDel[$i]->setClass('btn btn-danger');
			$operationDiv[$i]=new Div();
			$operationDiv[$i]->setClass('operationspart');
			$operationDiv[$i]->addElement($lnkView[$i]);
			$operationDiv[$i]->addElement($lnkDel[$i]);
			$LTable1->addElement(new Lable($i+1));
			$LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($liTit[$i]);
			$LTable1->setLastElementClass("listcontent");
//            $t=new kpex_testEntity();
            $LTable1->addElement(new Lable($this->Data['data'][$i]->getNouninfluence()));
            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement(new Lable($this->Data['data'][$i]->getNounoutinfluence()));
            $LTable1->addElement(new Lable($this->Data['data'][$i]->getAdjectiveinfluence()));
            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement(new Lable($this->Data['data'][$i]->getAdjectiveoutinfluence()));
            $LTable1->setLastElementClass("listcontent");
            if($this->Data['data'][$i]->getIs_postaged())
                $LTable1->addElement(new Lable("PosTag"));
            else
                $LTable1->addElement(new Lable("-"));

            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement(new Lable($this->Data['data'][$i]->getApprate()));
            $LTable1->setLastElementClass("listcontent");
            $LblContextID=new Lable($this->Data['data'][$i]->getContext_fid());
            $LnkContext=new AppRooter('kpex','managecontext');
            $LnkContext->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getContext_fid()));
            $LTable1->addElement(new link($LnkContext->getAbsoluteURL(),$LblContextID));
            $LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($operationDiv[$i]);
			$LTable1->setLastElementClass("listcontent");
		}
		$TableDiv->addElement($LTable1);
		$Page->addElement($TableDiv);
		$Page->addElement($this->getPaginationPart($this->Data['pagecount'],"kpex",$this->listPage));
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