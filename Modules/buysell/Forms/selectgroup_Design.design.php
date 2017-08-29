<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\html\Image;
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
use Modules\buysell\PublicClasses\CarGroups;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-07 - 2017-08-29 16:28
*@lastUpdate 1396-06-07 - 2017-08-29 16:28
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class selectgroup_Design extends FormDesign {
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
	    $page=$this->Data['page'];
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("buysell_selectgroup");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
		$PageTitlePart->addElement(new Lable("انتخاب گروه"));
		$Page->addElement($PageTitlePart);
		$MessagePart=new Div();
		$MessagePart->setClass("sweet_messagepart");
		$MessagePart->addElement(new Lable($this->getMessage()));
		$Page->addElement($MessagePart);
		$LTable1=new Div();
		$cg=new CarGroups();

		$d1=new Div();
        $d1->setClass("cargroupicon");
        $d1->setId('personalcargroupicon');
		$img1=new Image(DEFAULT_PUBLICURL . "content/files/buysell/car.png");
        $url1=DEFAULT_PUBLICURL . "fa/" . $cg->getGroupName(1) . "/" . $page . ".jsp";
		$lnk1=new link($url1,$img1);
        $d1->addElement($lnk1);
		$lbl1=new Lable("قطعات خودروهای سواری");
		$lbl1->setClass("cargrouptitle");
        $lnklbl1=new link($url1,$lbl1);
        $d1->addElement($lnklbl1);
		$LTable1->addElement($d1);


        $d2=new Div();
        $d2->setClass("cargroupicon");
        $d2->setId('heavyvehiclegroupicon');
        $img2=new Image(DEFAULT_PUBLICURL . "content/files/buysell/sangin.png");
        $url2=DEFAULT_PUBLICURL . "fa/" . $cg->getGroupName(2) . "/" . $page . ".jsp";
        $lnk2=new link($url2,$img2);
        $d2->addElement($lnk2);
        $lbl2=new Lable("قطعات خودروهای سنگین");
        $lbl2->setClass("cargrouptitle");
        $lnklbl2=new link($url2,$lbl2);
        $d2->addElement($lnklbl2);
        $LTable1->addElement($d2);

		$LTable1->setClass("formtable");
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>