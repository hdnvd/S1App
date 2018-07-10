<?php
namespace Modules\users\Forms;
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
*@creationDate 1396-11-24 - 2018-02-13 22:37
*@lastUpdate 1396-11-24 - 2018-02-13 22:37
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managesystemtask_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("users_managesystemtask");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['systemtask']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->module,$this->getFieldCaption('module'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->page,$this->getFieldCaption('page'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->action,$this->getFieldCaption('action'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getSingleFieldRowCode($this->btnSave));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		$form->SetAttribute("novalidate","novalidate");
		$form->SetAttribute("data-toggle","validator");
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
	public function FillItems()
	{
		if (key_exists("systemtask", $this->Data)){

			/******** module ********/
			$this->module->setValue($this->Data['systemtask']->getModule());
			$this->setFieldCaption('module',$this->Data['systemtask']->getFieldInfo('module')->getTitle());
			$this->module->setFieldInfo($this->Data['systemtask']->getFieldInfo('module'));

			/******** page ********/
			$this->page->setValue($this->Data['systemtask']->getPage());
			$this->setFieldCaption('page',$this->Data['systemtask']->getFieldInfo('page')->getTitle());
			$this->page->setFieldInfo($this->Data['systemtask']->getFieldInfo('page'));

			/******** action ********/
			if($this->Data['systemtask']->getAction()!="")
			    $this->action->setValue($this->Data['systemtask']->getAction());
			else
                $this->action->setValue("*");

			$this->setFieldCaption('action',$this->Data['systemtask']->getFieldInfo('action')->getTitle());
			$this->action->setFieldInfo($this->Data['systemtask']->getFieldInfo('action'));

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* module *******/
		$this->module= new textbox("txtmodule");
		$this->module->setClass("form-control");

		/******* page *******/
		$this->page= new textbox("txtpage");
		$this->page->setClass("form-control");

		/******* action *******/
		$this->action= new textbox("txtaction");
		$this->action->setClass("form-control");

		/******* btnSave *******/
		$this->btnSave= new SweetButton(true,"ذخیره");
		$this->btnSave->setAction("btnSave");
		$this->btnSave->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
		$this->btnSave->setClass("btn btn-primary");
	}
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
        /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
    }
	/** @var textbox */
	private $module;
	/**
	 * @return textbox
	 */
	public function getModule()
	{
		return $this->module;
	}
	/** @var textbox */
	private $page;
	/**
	 * @return textbox
	 */
	public function getPage()
	{
		return $this->page;
	}
	/** @var textbox */
	private $action;
	/**
	 * @return textbox
	 */
	public function getAction()
	{
		return $this->action;
	}
	/** @var SweetButton */
	private $btnSave;
    public function getJSON()
    {
       parent::getJSON();
       $Result=['message'=>$this->getMessage(),'messagetype'=>$this->getMessageType()];
       return json_encode($Result);
    }
}
?>