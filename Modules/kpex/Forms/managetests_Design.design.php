<?php
namespace Modules\kpex\Forms;
use core\CoreClasses\html\htmlcode;
use core\CoreClasses\html\JavascriptLink;
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
use Modules\common\PublicClasses\AppJSLink;
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
    /** @var textbox */
    private $IDFrom;

    /** @var textbox */
    private $IDTo;

    /**
     * @return TextBox
     */
    public function getIDFrom()
    {
        return $this->IDFrom;
    }

    /**
     * @return TextBox
     */
    public function getIDTo()
    {
        return $this->IDTo;
    }
    /** @var ComboBox */
    private $testgroup_fid;
    /**
     * @return ComboBox
     */
    public function getTestgroup_fid()
    {
        return $this->testgroup_fid;
    }
	public function __construct()
	{
		parent::__construct();
        /******* words *******/
        $this->IDFrom= new textbox("idfrom");
        $this->IDFrom->setClass("form-control");
        $this->IDFrom->setValue($_GET['idfrom']);


        /******* words *******/
        $this->IDTo= new textbox("idto");
        $this->IDTo->setClass("form-control");
        $this->IDTo->setValue($_GET['idto']);
        /******* method_fid *******/
        $this->testgroup_fid= new combobox("testgroup_fid");
        $this->testgroup_fid->setClass("form-control selectpicker");
        $this->testgroup_fid->SetAttribute("data-live-search",true);
	}
	public function getBodyHTML($command=null)
	{
        $this->testgroup_fid->addOption("", "مهم نیست");
        foreach ($this->Data['testgroup_fid'] as $item)
            $this->testgroup_fid->addOption($item->getID(), $item->getTitleField());
        $this->testgroup_fid->setSelectedValue($_GET['testgroup_fid']);
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("kpex_managetests");
		$Page->addElement($this->getPageTitlePart(" " . $this->Data['test']->getTableTitle() . " ها"));

        $Page->addElement($this->IDFrom);
        $Page->addElement($this->IDTo);
        $Page->addElement($this->testgroup_fid);

        $Progress=new Div();
        $Progress->setId('progress');
        $Progress->setClass("progressbar");
        $Page->addElement($Progress);

        $LogBox=new Div();
//        $LogBox->setClass('logbox');
        $LogBox->setId('logbox');
        $Page->addElement($LogBox);
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
        $makeHulthCSV=new AppRooter('kpex',$this->listPage);
        $makeHulthCSV->addParameter(new URLParameter('hulth',null));
        $LblmakeHulthCSV=new Lable('ساخت فایل از hulth ' );
        $lnkmakeHulthCSV=new link($makeHulthCSV->getAbsoluteURL(),$LblmakeHulthCSV);
        $lnkmakeHulthCSV->setClass('linkbutton btn btn-primary');
        $lnkmakeHulthCSV->setGlyphiconClass('glyphicon glyphicon-plus');
        $lnkmakeHulthCSV->setId('addtestlink');
        $Page->addElement($lnkmakeHulthCSV);

        $LblRunInRange=new Lable('اجرای دسته جمعی' );
        $lnkRunInRange=new link("javascript:RunTests($('#idfrom').val(),$('#idto').val())",$LblRunInRange);
        $lnkRunInRange->setClass('linkbutton btn btn-primary');
        $lnkRunInRange->setGlyphiconClass('glyphicon glyphicon-plus');
        $lnkRunInRange->setId('addtestlink');
        $Page->addElement($lnkRunInRange);

		$SearchUrl=new AppRooter('kpex',$this->listPage);
		$SearchUrl->addParameter(new URLParameter('search',null));
		$LblSearch=new Lable('جستجو');
		$lnkSearch=new link($SearchUrl->getAbsoluteURL(),$LblSearch);
		$lnkSearch->setClass('linkbutton btn btn-primary');
		$lnkSearch->setGlyphiconClass('glyphicon glyphicon-search');
		$lnkSearch->setId('searchtestlink');
		$Page->addElement($lnkSearch);

        $Page->addElement(new JavascriptLink((new AppJSLink("kpex","ajaxrunner"))->getAbsoluteURL()));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$TableDiv=new Div();
		$TableDiv->setClass('table-responsive');
		$LTable1=new ListTable(17);
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
        $LTable1->addElement(new Lable('PT'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('ST'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('SI'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('SE'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('MTD'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('Rate'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('P'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('R'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('F'));
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
            $ViewURL->addParameter(new UrlParameter('pn',$_GET['pn']));
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


            $lbViewGraph[$i]=new Lable('Graph');
            $lnkViewGraph[$i]=new link(DEFAULT_PUBLICURL . "content/files/kpex/results/graphs/graph".$this->Data['data'][$i]->getID().".html",$lbViewGraph[$i]);
            $lnkViewGraph[$i]->setGlyphiconClass('glyphicon glyphicon-grain');
            $lnkViewGraph[$i]->setClass('btn btn-primary');

            $lbViewKeywords[$i]=new Lable('Keywords');
            $lnkViewKeywords[$i]=new link(DEFAULT_PUBLICURL . "content/files/kpex/results/keywords".$this->Data['data'][$i]->getID().".txt",$lbViewKeywords[$i]);
            $lnkViewKeywords[$i]->setGlyphiconClass('glyphicon glyphicon-check');
            $lnkViewKeywords[$i]->setClass('btn btn-primary');

			$operationDiv[$i]=new Div();
			$operationDiv[$i]->setClass('operationspart');
			$operationDiv[$i]->addElement($lnkView[$i]);
			$operationDiv[$i]->addElement($lnkDel[$i]);
			$operationDiv[$i]->addElement($lnkViewGraph[$i]);
			$operationDiv[$i]->addElement($lnkViewKeywords[$i]);
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
                $LTable1->addElement(new Lable("+"));
            else
                $LTable1->addElement(new Lable(" "));

            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement(new Lable($this->Data['data'][$i]->getSimilarity_threshold()));
            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement(new Lable($this->Data['data'][$i]->getSimilarity_influence()));
            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement(new Lable(($this->Data['data'][$i]->getIs_similarityedgeweighed()==true)?"+":""));
            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement(new Lable($this->Data['methods'][$i]->getTitle()));
            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement(new Lable($this->Data['data'][$i]->getApprate()));
            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement(new Lable(substr($this->Data['data'][$i]->getPrecisionrate(),0,5)));
            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement(new Lable(substr($this->Data['data'][$i]->getRecall(),0,5)));
            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement(new Lable(substr($this->Data['data'][$i]->getFscore(),0,5)));
            $LTable1->setLastElementClass("listcontent");
            $LblContextID=new Lable($this->Data['data'][$i]->getContext_fid());
            $LnkContext=new AppRooter('kpex','managecontext');
            $LnkContext->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getContext_fid()));
            $LTable1->addElement(new link($LnkContext->getAbsoluteURL(),$LblContextID));
            $LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($operationDiv[$i]);
			$LTable1->setLastElementClass("listcontent");
		}
        $LTable1->addElement(new Lable('#'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('Total'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable(' '));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable(' '));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable(' '));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable(' '));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable(' '));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable(' '));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable(' '));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable(' '));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable(' '));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable(substr($this->Data['total_rates'][0]['apprate'],0,8)));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable(substr($this->Data['total_rates'][0]['precisionrate'],0,5)));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable(substr($this->Data['total_rates'][0]['recall'],0,5)));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable(substr($this->Data['total_rates'][0]['fscore'],0,5)));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable(' '));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable(' '));
        $LTable1->setLastElementClass("listtitle");
		$TableDiv->addElement($LTable1);
		$Page->addElement($TableDiv);
		$Page->addElement($this->getPaginationPart($this->Data['pagecount'],"kpex",$this->listPage));
		$form=new SweetFrom("", "GET", $Page);
		return $form->getHTML();
	}    
    public function getJSON()
    {
       parent::getJSON();
       $Result=['message'=>$this->getMessage(),'precision'=>$this->Data['precision'],'messagetype'=>$this->getMessageType()];
       return json_encode($Result);
    }
}
?>