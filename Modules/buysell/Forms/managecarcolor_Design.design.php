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
*@creationDate 1396-03-25 - 2017-06-15 02:06
*@lastUpdate 1396-03-25 - 2017-06-15 02:06
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class managecarcolor_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var textbox */
	private $latintitle;
	/**
	 * @return textbox
	 */
	public function getLatintitle()
	{
		return $this->latintitle;
	}
	/** @var textbox */
	private $title;
	/**
	 * @return textbox
	 */
	public function getTitle()
	{
		return $this->title;
	}
	/** @var SweetButton */
	private $btnSave;
	public function __construct()
	{
		$this->latintitle= new textbox("latintitle");
		$this->title= new textbox("title");
		$this->btnSave= new SweetButton(true,"ذخیره");
		$this->btnSave->setAction("btnSave");
	}
	public function getBodyHTML($command=null)
	{
		if (key_exists("carcolor", $this->Data))
			$this->latintitle->setValue($this->Data['carcolor']->getLatintitle());
		if (key_exists("carcolor", $this->Data))
			$this->title->setValue($this->Data['carcolor']->getTitle());
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("buysell_managecarcolor");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
		$PageTitlePart->addElement(new Lable("manage carcolor"));
		$Page->addElement($PageTitlePart);
		$MessagePart=new Div();
		$MessagePart->setClass("sweet_messagepart");
		$MessagePart->addElement(new Lable($this->getMessage()));
		$Page->addElement($MessagePart);
		$LTable1=new ListTable(2);
		$LTable1->setClass("formtable");
		$LTable1->addElement(new Lable("latintitle"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->latintitle);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("title"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->title);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement($this->btnSave,2);
		$LTable1->setLastElementClass('form_item_sweetbutton');
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>