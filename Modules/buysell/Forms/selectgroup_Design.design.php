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

        $url1=DEFAULT_PUBLICURL . "fa/" . $cg->getGroupName(1) . "/" . $page ;
		$d1=new Div();
        $d1->setClass("cargroupicon");
        $d1->setId('personalcargroupicon');
		$img1=new Image(DEFAULT_PUBLICURL . "content/files/buysell/car.png");
        $d1->addElement($img1);
		$lbl1=new Lable("قطعات خودروهای سواری");
		$lbl1->setClass("cargrouptitle");
        $d1->addElement($lbl1);
        $lnk1=new link($url1,$d1);
        $LTable1->addElement($lnk1);


        $url2=DEFAULT_PUBLICURL . "fa/" . $cg->getGroupName(2) . "/" . $page ;
        $d2=new Div();
        $d2->setClass("cargroupicon");
        $d2->setId('heavyvehiclegroupicon');
        $img2=new Image(DEFAULT_PUBLICURL . "content/files/buysell/sangin.png");
        $d2->addElement($img2);
        $lbl2=new Lable("قطعات خودروهای سنگین");
        $lbl2->setClass("cargrouptitle");
        $d2->addElement($lbl2);

        $lnk2=new link($url2,$d2);
        $LTable1->addElement($lnk2);

		$LTable1->setClass("formtable");
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>