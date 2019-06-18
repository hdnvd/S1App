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
	/** @var ComboBox */
	private $cmbModule;
	/**
	 * @return ComboBox
	 */
	public function getCmbModule()
	{
		return $this->cmbModule;
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
    /** @var SweetButton */
    private $btnRemoveForms;
	public function __construct()
	{
		$this->cmbModule= new ComboBox("cmbModule");
		$this->txtEntity= new textbox("txtEntity");
        $this->chkItemsToGenerate= new CheckBox("chkItemstoGenerate[]");

        $this->chkItemsToGenerate->addOption("Manage List Controller","manage_list_controller");
//        $this->chkItemsToGenerate->addSelectedValue("manage_list_controller");
        $this->chkItemsToGenerate->addOption("Manage List Code","manage_list_code");
//        $this->chkItemsToGenerate->addSelectedValue("manage_list_code");
        $this->chkItemsToGenerate->addOption("Manage User List Code","manage_userlist_code");
//        $this->chkItemsToGenerate->addSelectedValue("manage_userlist_code");
        $this->chkItemsToGenerate->addOption("Manage List Design","manage_list_design");
//        $this->chkItemsToGenerate->addSelectedValue("manage_list_design");

        $this->chkItemsToGenerate->addOption("Manage Item Controller","manage_item_controller");
//        $this->chkItemsToGenerate->addSelectedValue("manage_item_controller");
        $this->chkItemsToGenerate->addOption("Manage Item Code","manage_item_code");
//        $this->chkItemsToGenerate->addSelectedValue("manage_item_code");
        $this->chkItemsToGenerate->addOption("Manage User Item Code","manage_useritem_code");
//        $this->chkItemsToGenerate->addSelectedValue("manage_useritem_code");
        $this->chkItemsToGenerate->addOption("Manage Item Design","manage_item_design");
//        $this->chkItemsToGenerate->addSelectedValue("manage_item_design");

        $this->chkItemsToGenerate->addOption("List Controller","list_controller");
//        $this->chkItemsToGenerate->addSelectedValue("list_controller");
        $this->chkItemsToGenerate->addOption("List Code","list_code");
//        $this->chkItemsToGenerate->addSelectedValue("list_code");
        $this->chkItemsToGenerate->addOption("List Design","list_design");
//        $this->chkItemsToGenerate->addSelectedValue("list_design");

        $this->chkItemsToGenerate->addOption("Item Display Controller","item_display_controller");
//        $this->chkItemsToGenerate->addSelectedValue("item_display_controller");
        $this->chkItemsToGenerate->addOption("Item Display Code","item_display_code");
//        $this->chkItemsToGenerate->addSelectedValue("item_display_code");
        $this->chkItemsToGenerate->addOption("Item Display Design","item_display_design");
//        $this->chkItemsToGenerate->addSelectedValue("item_display_design");
        $this->chkItemsToGenerate->addOption("Item Search Design","search_design");
//        $this->chkItemsToGenerate->addSelectedValue("search_design");
        $this->chkItemsToGenerate->addOption("Sencha Framework Codes","sencha_codes");
        $this->chkItemsToGenerate->addOption("Laravel Framework Codes","laravel_api_codes");
        $this->chkItemsToGenerate->addSelectedValue("laravel_api_codes");
        $this->chkItemsToGenerate->addOption("React Framework Codes","react_codes");
        $this->chkItemsToGenerate->addSelectedValue("react_codes");

        $this->chkItemsToGenerate->addOption("React Native Codes","react_native_codes");
        $this->chkItemsToGenerate->addSelectedValue("react_native_codes");


        $this->chkItemsToGenerate->addOption("Android Class","android_class");

		$this->btnGenerate= new SweetButton(true,"ذخیره و تولید کد");
		$this->btnGenerate->setAction("btnGenerate");
        $this->btnGenerateForms= new SweetButton(true,"ذخیره و تولید کد فرم ها");
        $this->btnGenerateForms->setAction("btnGenerateForms");
        $this->btnRemoveForms= new SweetButton(true,"حذف فرم های انتخاب شده");
        $this->btnRemoveForms->setAction("btnRemoveForms");
        $this->btnRemoveForms->setClass("btn btn-danger");
	}
	public function getBodyHTML($command=null)
	{
	    $ModuleCount=count($this->Data['modules']);
	    for ($i=0;$i<$ModuleCount;$i++)
            $this->cmbModule->addOption($this->Data['modules'][$i]->getID(),$this->Data['modules'][$i]->getCaption());
	    if(key_exists('entity',$this->Data))
            $this->txtEntity->setValue($this->Data['entity']);
        if(key_exists('module',$this->Data))
            $this->cmbModule->setSelectedValue($this->Data['module']);

		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("sfman_makeEntity");
        $Page->addElement($this->getPageTitlePart("ساخت کلاس Entity"));
        if($this->getMessage()!="")
            $Page->addElement($this->getMessagePart());
        $LTable1=new Div();
        $LTable1->setClass("formtable");
        $LTable1->addElement($this->getFieldRowCode($this->cmbModule,"ماژول",null,''));
        $LTable1->addElement($this->getFieldRowCode($this->txtEntity,"عنوان کلاس",null,''));
        $LTable1->addElement($this->getFieldRowCode($this->chkItemsToGenerate,"فرم های تولیدی",null,''));
        $LTable1->addElement($this->getSingleFieldRowCode($this->btnGenerate));
        $LTable1->addElement($this->getSingleFieldRowCode($this->btnGenerateForms));
        $LTable1->addElement($this->getSingleFieldRowCode($this->btnRemoveForms));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
        $form->SetAttribute("novalidate","novalidate");
        $form->setClass('form-horizontal');
		return $form->getHTML();
	}
}
?>