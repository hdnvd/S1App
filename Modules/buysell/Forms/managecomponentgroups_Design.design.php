<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\html\link;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\CheckBox;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\ComboBox;
use core\CoreClasses\html\FileUploadBox;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;

/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-26 - 2017-02-14 08:52
*@lastUpdate 1395-11-26 - 2017-02-14 08:52
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class managecomponentgroups_Design extends FormDesign {
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
		$Page->setId("buysell_managecomponents");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
		$PageTitlePart->addElement(new Lable("مدیریت قطعات"));
		$Page->addElement($PageTitlePart);
		$MessagePart=new Div();
		$MessagePart->setClass("sweet_messagepart");
		$MessagePart->addElement(new Lable($this->getMessage()));
		$Page->addElement($MessagePart);
		$LTable1=new ListTable(2);
        for ($i=0;$i<count($this->Data['components']);$i++)
        {
            $curC=$this->Data['components'][$i];
            $LTable1->addElement(new Lable($i+1));
            $lbTitle=new Lable($curC['title']);
            $ar=new AppRooter('buysell','managecomponentgroup');
            $ar->addParameter(new UrlParameter('id',$curC['id']));
            $liTitle=new link($ar->getAbsoluteURL(),$lbTitle);
            $LTable1->addElement($liTitle);
        }
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>