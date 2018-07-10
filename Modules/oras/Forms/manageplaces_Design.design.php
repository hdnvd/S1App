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
class manageplaces_Design extends FormDesign {
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
            $this->itemPage = 'manageplace';
            $this->listPage = 'manageplaces';
        }
        else
        {
            $this->itemPage = 'manageuserplace';
            $this->listPage = 'manageuserplaces';
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
		$Page->setId("oras_manageplaces");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['place']->getTableTitle() . " ها"));
		$addUrl=new AppRooter('oras',$this->itemPage);
		$LblAdd=new Lable('افزودن آیتم جدید');
		$lnkAdd=new link($addUrl->getAbsoluteURL(),$LblAdd);
		$lnkAdd->setClass('linkbutton btn btn-primary');
		$lnkAdd->setGlyphiconClass('glyphicon glyphicon-plus');
		$lnkAdd->setId('addplacelink');
		$Page->addElement($lnkAdd);
		$SearchUrl=new AppRooter('oras',$this->listPage);
		$SearchUrl->addParameter(new URLParameter('search',null));
		$LblSearch=new Lable('جستجو');
		$lnkSearch=new link($SearchUrl->getAbsoluteURL(),$LblSearch);
		$lnkSearch->setClass('linkbutton btn btn-primary');
		$lnkSearch->setGlyphiconClass('glyphicon glyphicon-search');
		$lnkSearch->setId('searchplacelink');
		$Page->addElement($lnkSearch);
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$TableDiv=new Div();
		$TableDiv->setClass('table-responsive');
		$LTable1=new ListTable(3);
		$LTable1->setHeaderRowCount(1);
		$LTable1->setClass("table-striped managelist");
		$LTable1->addElement(new Lable('#'));
		$LTable1->setLastElementClass("listtitle");
		$LTable1->addElement(new Lable('عنوان'));
		$LTable1->setLastElementClass("listtitle");
		$LTable1->addElement(new Lable('عملیات'));
		$LTable1->setLastElementClass("listtitle");
		for($i=0;$i<count($this->Data['data']);$i++){
			$url=new AppRooter('oras',$this->itemPage);
			$url->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
			$Title=$this->Data['data'][$i]->getTitleField();
			if($Title=="")
				$Title='- بدون عنوان -';
			$lbTit[$i]=new Lable($Title);
			$liTit[$i]=new link($url->getAbsoluteURL(),$lbTit[$i]);
			$delurl=new AppRooter('oras',$this->listPage);
			$delurl->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
			$delurl->addParameter(new UrlParameter('delete',1));
			$lbDel[$i]=new Lable('حذف');
			$liDel[$i]=new link($delurl->getAbsoluteURL(),$lbDel[$i]);
			$liDel[$i]->setGlyphiconClass('glyphicon glyphicon-remove');
			$liDel[$i]->setClass('btn btn-danger');

            $Recordurl=new AppRooter('oras','manageuserrecords');
            $Recordurl->addParameter(new UrlParameter('placeid',$this->Data['data'][$i]->getID()));
            $lbRecord[$i]=new Lable('گزارش ها');
            $liRecord[$i]=new link($Recordurl->getAbsoluteURL(),$lbRecord[$i]);
            $liRecord[$i]->setGlyphiconClass('glyphicon glyphicon-duplicate');
            $liRecord[$i]->setClass('btn btn-primary');

            $AdminRecordurl=new AppRooter('oras','managerecords');
            $AdminRecordurl->addParameter(new UrlParameter('placeid',$this->Data['data'][$i]->getID()));
            $lbAdminRecord[$i]=new Lable('گزارش مدیر');
            $liAdminRecord[$i]=new link($AdminRecordurl->getAbsoluteURL(),$lbAdminRecord[$i]);
            $liAdminRecord[$i]->setGlyphiconClass('glyphicon glyphicon-king');
            $liAdminRecord[$i]->setClass('btn btn-primary');


			$operationDiv[$i]=new Div();
			$operationDiv[$i]->setClass('operationspart');
            $operationDiv[$i]->addElement($liRecord[$i]);
            $operationDiv[$i]->addElement($liAdminRecord[$i]);
			$operationDiv[$i]->addElement($liDel[$i]);
			$LTable1->addElement(new Lable($i+1));
			$LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($liTit[$i]);
			$LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($operationDiv[$i]);
			$LTable1->setLastElementClass("listcontent");
		}
		$TableDiv->addElement($LTable1);
		$Page->addElement($TableDiv);
		$Page->addElement($this->getPaginationPart($this->Data['pagecount'],"oras",$this->listPage));
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>