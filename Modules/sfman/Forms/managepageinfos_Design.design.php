<?php
namespace Modules\sfman\Forms;
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
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\CheckBox;
use core\CoreClasses\html\RadioBox;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\ComboBox;
use core\CoreClasses\html\FileUploadBox;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-07 - 2017-09-29 14:25
*@lastUpdate 1396-07-07 - 2017-09-29 14:25
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managepageinfos_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}    
private $adminMode=true;
    
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
            $this->itemPage = 'managepageinfo';
            $this->listPage = 'managepageinfos';
        }
        else
        {
            $this->itemPage = 'manageuserpageinfo';
            $this->listPage = 'manageuserpageinfos';
        }
    }
	public function __construct()
	{
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("sfman_managepageinfos");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
		$PageTitlePart->addElement(new Lable("managepageinfos"));
		$Page->addElement($PageTitlePart);
		if($this->getMessage()!=""){
			$MessagePart=new Div();
			if($this->getMessageType()==MessageType::$ERROR)
				$MessagePart->setClass("sweet_messagepart alert alert-danger");
			else
				$MessagePart->setClass("sweet_messagepart alert alert-success");
			$MessagePart->addElement(new Lable($this->getMessage()));
			$Page->addElement($MessagePart);
		}
		$addUrl=new AppRooter('sfman',$this->itemPage);
		$LblAdd=new Lable('افزودن آیتم جدید');
		$lnkAdd=new link($addUrl->getAbsoluteURL(),$LblAdd);
		$lnkAdd->setClass('linkbutton btn btn-primary');
		$lnkAdd->setId('addpageinfolink');
		$Page->addElement($lnkAdd);
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
			$url=new AppRooter('sfman',$this->itemPage);
			$url->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
			$delurl=new AppRooter('sfman',$this->listPage);
			$delurl->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
			$delurl->addParameter(new UrlParameter('delete',1));
				$Title=$this->Data['data'][$i]->getTitle();
			if($this->Data['data'][$i]->getTitle()=="")
				$Title='- بدون عنوان -';
			$lbTit[$i]=new Lable($Title);
			$liTit[$i]=new link($url->getAbsoluteURL(),$lbTit[$i]);
			$lbDel[$i]=new Lable('حذف');
			$liDel[$i]=new link($delurl->getAbsoluteURL(),$lbDel[$i]);
			$liDel[$i]->setClass('btn btn-danger');
			$LTable1->addElement(new Lable($i+1));
			$LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($liTit[$i]);
			$LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($liDel[$i]);
			$LTable1->setLastElementClass("listcontent");
		}
		$TableDiv->addElement($LTable1);
		$Page->addElement($TableDiv);
		$Page->addElement($this->getPaginationPart($this->Data['pagecount']));
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	private function getPaginationPart($PageCount)
	{
		$Pagination=new UList();
		$Pagination->setClass("pagination");
		for($i=1;$i<=$PageCount;$i++)
		{
			$RTR=null;
			if(isset($_GET['action']) && $_GET['action']=="search_Click")
				$RTR=new AppRooter("sfman",$this->listPage);
			else
			{
				$RTR=new AppRooter("sfman",$this->listPage);
				//$RTR->addParameter(new UrlParameter("g",$this->Data['groupid']));
			}
			$RTR->addParameter(new UrlParameter("pn",$i));
			$RTR->setAppendToCurrentParams(false);
			$lbl=new Lable($i);
			$lnk=new link($RTR->getAbsoluteURL(),$lbl);
			$Pagination->addElement(new UListElement($lnk));
		}
		return $Pagination;
	}
}
?>