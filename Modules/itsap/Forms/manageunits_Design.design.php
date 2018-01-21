<?php
namespace Modules\itsap\Forms;
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
*@creationDate 1396-09-17 - 2017-12-08 09:41
*@lastUpdate 1396-09-17 - 2017-12-08 09:41
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageunits_Design extends FormDesign {
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
        $this->itemViewPage = 'manageemployees';
        if($adminMode==true)
        {
            $this->itemPage = 'manageunit';
            $this->listPage = 'manageunits';
        }
        else
        {
            $this->itemPage = 'manageuserunit';
            $this->listPage = 'manageuserunits';
        }
    }

    /** @var lable */
    private $topunit_fid;
    /** @var lable */
    private $title;
	public function __construct()
	{
		parent::__construct();

        /******* topunit_fid *******/
        $this->topunit_fid= new lable("topunit_fid");

        /******* title *******/
        $this->title= new lable("title");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("itsap_manageunits");


		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['unit']->getTableTitle() . " ها"));

		if (key_exists("topunit", $this->Data)){
            $this->setFieldCaption('topunit_fid',$this->Data['topunit']->getFieldInfo('topunit_fid')->getTitle());
            if($this->Data['topunit_fid']->getId()>0)
                $this->topunit_fid->setText($this->Data['topunit_fid']->getTitle());
            else
                $this->topunit_fid->setText("ندارد");
            $this->setFieldCaption('title',$this->Data['topunit']->getFieldInfo('title')->getTitle());
            $this->title->setText($this->Data['topunit']->getTitle());
        }
        $LTable2=new Div();
        $LTable2->setClass("formtable");
        $LTable2->addElement($this->getInfoRowCode($this->topunit_fid,$this->getFieldCaption('topunit_fid')));
        $LTable2->addElement($this->getInfoRowCode($this->title,$this->getFieldCaption('title')));
        $Page->addElement($LTable2);

		$addUrl=new AppRooter('itsap',$this->itemPage);
		$LblAdd=new Lable('افزودن آیتم جدید');
		$lnkAdd=new link($addUrl->getAbsoluteURL(),$LblAdd);
		$lnkAdd->setClass('linkbutton btn btn-primary');
		$lnkAdd->setGlyphiconClass('glyphicon glyphicon-plus');
		$lnkAdd->setId('addunitlink');
		$Page->addElement($lnkAdd);
		$SearchUrl=new AppRooter('itsap',$this->listPage);
		$SearchUrl->addParameter(new URLParameter('search',null));
		$LblSearch=new Lable('جستجو');
		$lnkSearch=new link($SearchUrl->getAbsoluteURL(),$LblSearch);
		$lnkSearch->setClass('linkbutton btn btn-primary');
		$lnkSearch->setGlyphiconClass('glyphicon glyphicon-search');
		$lnkSearch->setId('searchunitlink');
		$Page->addElement($lnkSearch);
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
			$url=new AppRooter('itsap',$this->itemPage);
			$url->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
			$Title=$this->Data['data'][$i]->getTitleField();
			if($Title=="")
				$Title='- بدون عنوان -';
			$lbTit[$i]=new Lable($Title);
			$liTit[$i]=new link($url->getAbsoluteURL(),$lbTit[$i]);
			$ViewURL=new AppRooter('itsap',$this->itemViewPage);
			$ViewURL->addParameter(new UrlParameter('uid',$this->Data['data'][$i]->getID()));
			$lbView[$i]=new Lable('مشاهده');
			$lnkView[$i]=new link($ViewURL->getAbsoluteURL(),$lbView[$i]);
			$lnkView[$i]->setGlyphiconClass('glyphicon glyphicon-eye-open');
			$lnkView[$i]->setClass('btn btn-primary');
			$delurl=new AppRooter('itsap',$this->listPage);
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
			$LTable1->addElement($operationDiv[$i]);
			$LTable1->setLastElementClass("listcontent");
		}
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