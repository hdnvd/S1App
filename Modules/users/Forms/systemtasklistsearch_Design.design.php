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
class systemtasklistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
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
	/** @var combobox */
	private $sortby;
	/**
	 * @return combobox
	 */
	public function getSortby()
	{
		return $this->sortby;
	}
	/** @var combobox */
	private $isdesc;
	/**
	 * @return combobox
	 */
	public function getIsdesc()
	{
		return $this->isdesc;
	}
	/** @var SweetButton */
	private $search;
	public function __construct()
	{
		parent::__construct();

		/******* module *******/
		$this->module= new textbox("module");
		$this->module->setClass("form-control");

		/******* page *******/
		$this->page= new textbox("page");
		$this->page->setClass("form-control");

		/******* action *******/
		$this->action= new textbox("action");
		$this->action->setClass("form-control");

		/******* sortby *******/
		$this->sortby= new combobox("sortby");
		$this->sortby->setClass("form-control");

		/******* isdesc *******/
		$this->isdesc= new combobox("isdesc");
		$this->isdesc->setClass("form-control");

		/******* search *******/
		$this->search= new SweetButton(true,"جستجو");
		$this->search->setAction("search");
		$this->search->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
		$this->search->setClass("btn btn-primary");
	}
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("users_systemtasklist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['systemtask']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->module,$this->getFieldCaption('module'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->page,$this->getFieldCaption('page'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->action,$this->getFieldCaption('action'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->sortby,$this->getFieldCaption('sortby'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->isdesc,$this->getFieldCaption('isdesc'),null,'',null));
		$LTable1->addElement($this->getSingleFieldRowCode($this->search));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "GET", $Page);
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
	public function FillItems()
	{
		if (key_exists("systemtask", $this->Data)){

			/******** module ********/
			$this->module->setValue($this->Data['systemtask']->getModule());
			$this->setFieldCaption('module',$this->Data['systemtask']->getFieldInfo('module')->getTitle());

			/******** page ********/
			$this->page->setValue($this->Data['systemtask']->getPage());
			$this->setFieldCaption('page',$this->Data['systemtask']->getFieldInfo('page')->getTitle());

			/******** action ********/
			$this->action->setValue($this->Data['systemtask']->getAction());
			$this->setFieldCaption('action',$this->Data['systemtask']->getFieldInfo('action')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** module ********/
		$this->sortby->addOption($this->Data['systemtask']->getTableFieldID('module'),$this->getFieldCaption('module'));
		if(isset($_GET['module']))
			$this->module->setValue($_GET['module']);

		/******** page ********/
		$this->sortby->addOption($this->Data['systemtask']->getTableFieldID('page'),$this->getFieldCaption('page'));
		if(isset($_GET['page']))
			$this->page->setValue($_GET['page']);

		/******** action ********/
		$this->sortby->addOption($this->Data['systemtask']->getTableFieldID('action'),$this->getFieldCaption('action'));
		if(isset($_GET['action']))
			$this->action->setValue($_GET['action']);

		/******** sortby ********/
		if(isset($_GET['sortby']))
			$this->sortby->setSelectedValue($_GET['sortby']);

		/******** isdesc ********/
		if(isset($_GET['isdesc']))
			$this->isdesc->setSelectedValue($_GET['isdesc']);

		/******** search ********/
	}
}
?>