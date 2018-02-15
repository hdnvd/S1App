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
*@creationDate 1396-11-20 - 2018-02-09 00:17
*@lastUpdate 1396-11-20 - 2018-02-09 00:17
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managemenuitem_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("users_managemenuitem");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['menuitem']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->latintitle,$this->getFieldCaption('latintitle'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->module,$this->getFieldCaption('module'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->page,$this->getFieldCaption('page'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->parameters,$this->getFieldCaption('parameters'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
		if (key_exists("menuitem", $this->Data)){

			/******** latintitle ********/
			$this->latintitle->setValue($this->Data['menuitem']->getLatintitle());
			$this->setFieldCaption('latintitle',$this->Data['menuitem']->getFieldInfo('latintitle')->getTitle());
			$this->latintitle->setFieldInfo($this->Data['menuitem']->getFieldInfo('latintitle'));

			/******** module ********/
			$this->module->setValue($this->Data['menuitem']->getModule());
			$this->setFieldCaption('module',$this->Data['menuitem']->getFieldInfo('module')->getTitle());
			$this->module->setFieldInfo($this->Data['menuitem']->getFieldInfo('module'));

			/******** page ********/
			$this->page->setValue($this->Data['menuitem']->getPage());
			$this->setFieldCaption('page',$this->Data['menuitem']->getFieldInfo('page')->getTitle());
			$this->page->setFieldInfo($this->Data['menuitem']->getFieldInfo('page'));

			/******** parameters ********/
			$this->parameters->setValue($this->Data['menuitem']->getParameters());
			$this->setFieldCaption('parameters',$this->Data['menuitem']->getFieldInfo('parameters')->getTitle());
			$this->parameters->setFieldInfo($this->Data['menuitem']->getFieldInfo('parameters'));

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* latintitle *******/
		$this->latintitle= new textbox("latintitle");
		$this->latintitle->setClass("form-control");

		/******* module *******/
		$this->module= new textbox("module");
		$this->module->setClass("form-control");

		/******* page *******/
		$this->page= new textbox("page");
		$this->page->setClass("form-control");

		/******* parameters *******/
		$this->parameters= new textbox("parameters");
		$this->parameters->setClass("form-control");

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
	private $latintitle;
	/**
	 * @return textbox
	 */
	public function getLatintitle()
	{
		return $this->latintitle;
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
	private $parameters;
	/**
	 * @return textbox
	 */
	public function getParameters()
	{
		return $this->parameters;
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