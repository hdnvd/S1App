<?php
namespace Modules\sfman\Forms;
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
*@creationDate 1396-03-17 - 2017-06-07 18:07
*@lastUpdate 1396-03-17 - 2017-06-07 18:07
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class makeEntity_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var textbox */
	private $txtModule;
	/**
	 * @return textbox
	 */
	public function getTxtModule()
	{
		return $this->txtModule;
	}
	/** @var textbox */
	private $txtEntity;
	/**
	 * @return textbox
	 */
	public function getTxtEntity()
	{
		return $this->txtEntity;
	}
    /** @var CheckBox */
    private $chkItemsToGenerate;

    /**
     * @return CheckBox
     */
    public function getChkItemsToGenerate()
    {
        return $this->chkItemsToGenerate;
    }
	/** @var SweetButton */
	private $btnGenerate;
    /** @var SweetButton */
    private $btnGenerateForms;
	public function __construct()
	{
		$this->txtModule= new textbox("txtModule");
		$this->txtEntity= new textbox("txtEntity");
        $this->chkItemsToGenerate= new CheckBox("chkItemstoGenerate[]");

        $this->chkItemsToGenerate->addOption("Manage List Controller","manage_list_controller");
        $this->chkItemsToGenerate->addSelectedValue("manage_list_controller");
        $this->chkItemsToGenerate->addOption("Manage List Code","manage_list_code");
        $this->chkItemsToGenerate->addSelectedValue("manage_list_code");
        $this->chkItemsToGenerate->addOption("Manage List Design","manage_list_design");
        $this->chkItemsToGenerate->addSelectedValue("manage_list_design");

        $this->chkItemsToGenerate->addOption("Manage Item Controller","manage_item_controller");
        $this->chkItemsToGenerate->addSelectedValue("manage_item_controller");
        $this->chkItemsToGenerate->addOption("Manage Item Code","manage_item_code");
        $this->chkItemsToGenerate->addSelectedValue("manage_item_code");
        $this->chkItemsToGenerate->addOption("Manage Item Design","manage_item_design");
        $this->chkItemsToGenerate->addSelectedValue("manage_item_design");

        $this->chkItemsToGenerate->addOption("List Controller","list_controller");
        $this->chkItemsToGenerate->addSelectedValue("list_controller");
        $this->chkItemsToGenerate->addOption("List Code","list_code");
        $this->chkItemsToGenerate->addSelectedValue("list_code");
        $this->chkItemsToGenerate->addOption("List Design","list_design");
        $this->chkItemsToGenerate->addSelectedValue("list_design");

        $this->chkItemsToGenerate->addOption("Item Display Controller","item_display_controller");
        $this->chkItemsToGenerate->addSelectedValue("item_display_controller");
        $this->chkItemsToGenerate->addOption("Item Display Code","item_display_code");
        $this->chkItemsToGenerate->addSelectedValue("item_display_code");
        $this->chkItemsToGenerate->addOption("Item Display Design","item_display_design");
        $this->chkItemsToGenerate->addSelectedValue("item_display_design");
        $this->chkItemsToGenerate->addOption("Item Search Design","search_design");
        $this->chkItemsToGenerate->addSelectedValue("search_design");

		$this->btnGenerate= new SweetButton(true,"ذخیره و تولید کد");
		$this->btnGenerate->setAction("btnGenerate");
        $this->btnGenerateForms= new SweetButton(true,"ذخیره و تولید کد فرم ها");
        $this->btnGenerateForms->setAction("btnGenerateForms");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("sfman_makeEntity");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
		$PageTitlePart->addElement(new Lable("ساخت کلاس Entity"));
		$Page->addElement($PageTitlePart);
		$MessagePart=new Div();
		$MessagePart->setClass("sweet_messagepart");
		$MessagePart->addElement(new Lable($this->getMessage()));
		$Page->addElement($MessagePart);
		$LTable1=new ListTable(2);
		$LTable1->addElement(new Lable("ماژول"));
		$LTable1->addElement($this->txtModule);
		$LTable1->addElement(new Lable("عنوان کلاس"));
		$LTable1->addElement($this->txtEntity);
        $LTable1->addElement(new Lable("فرم های تولیدی"));
        $LTable1->addElement($this->chkItemsToGenerate);
		$LTable1->addElement($this->btnGenerate,2);
        $LTable1->addElement($this->btnGenerateForms,2);
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>