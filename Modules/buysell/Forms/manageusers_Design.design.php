<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
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
*@creationDate 1396-06-16 - 2017-09-07 01:34
*@lastUpdate 1396-06-16 - 2017-09-07 01:34
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class manageusers_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	public function __construct()
	{
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("buysell_manageusers");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
		$PageTitlePart->addElement(new Lable("manageusers"));
		$Page->addElement($PageTitlePart);
		$MessagePart=new Div();
		$MessagePart->setClass("sweet_messagepart");
		$MessagePart->addElement(new Lable($this->getMessage()));
		$Page->addElement($MessagePart);


		$LTable1=new ListTable(3);
		$LTable1->setClass("managelist");
		$LTable1->addElement(new Lable('#'));
		$LTable1->setLastElementClass("listtitle");
		$LTable1->addElement(new Lable('نام و نام خانوادگی'));
		$LTable1->setLastElementClass("listtitle");
		$LTable1->addElement(new Lable('عملیات'));
		$LTable1->setLastElementClass("listtitle");
		for($i=0;$i<count($this->Data['data']);$i++){
			$url=new AppRooter('buysell','manageuser');
			$url->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
			$delurl=new AppRooter('buysell','manageusers');
			$delurl->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
			$delurl->addParameter(new UrlParameter('delete',1));
				$Title=$this->Data['data'][$i]->getName();
			if($this->Data['data'][$i]->getName()=="")
				$Title='******************';
			$lbTit[$i]=new Lable($Title);
			$liTit[$i]=new link($url->getAbsoluteURL(),$lbTit[$i]);
			$lbDel[$i]=new Lable('حذف');
			$liDel[$i]=new link($delurl->getAbsoluteURL(),$lbDel[$i]);
			$LTable1->addElement(new Lable($i+1));
			$LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($liTit[$i]);
			$LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($liDel[$i]);
			$LTable1->setLastElementClass("listcontent");
		}
		$Page->addElement($LTable1);
		$Page->addElement($this->getPaginationPart($this->Data['pagecount']));
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	protected function getPaginationPart($PageCount,$a=null,$b=null,$c=null)
	{
		$div=new Div();
		for($i=1;$i<=$PageCount;$i++)
		{
			$RTR=null;
			if(isset($_GET['action']) && $_GET['action']=="search_Click")
				$RTR=new AppRooter("buysell","manageusers");
			else
			{
				$RTR=new AppRooter("buysell","manageusers");
				//$RTR->addParameter(new UrlParameter("g",$this->Data['groupid']));
			}
			$RTR->addParameter(new UrlParameter("pn",$i));
			$RTR->setAppendToCurrentParams(false);
			$lbl=new Lable($i);
			$lnk=new link($RTR->getAbsoluteURL(),$lbl);
			$div->addElement($lnk);
		}
		return $div;
	}
}
?>