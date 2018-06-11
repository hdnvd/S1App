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
*@creationDate 1397-01-17 - 2018-04-06 23:29
*@lastUpdate 1397-01-17 - 2018-04-06 23:29
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class menuitemlistsearch_Design extends FormDesign {
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
	/** @var textbox */
	private $priority;
	/**
	 * @return textbox
	 */
	public function getPriority()
	{
		return $this->priority;
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

		/******* priority *******/
		$this->priority= new textbox("priority");
		$this->priority->setClass("form-control");

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
		$Page->setId("users_menuitemlist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['menuitem']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->latintitle,$this->getFieldCaption('latintitle'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->module,$this->getFieldCaption('module'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->page,$this->getFieldCaption('page'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->parameters,$this->getFieldCaption('parameters'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->priority,$this->getFieldCaption('priority'),null,'',null));
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
		if (key_exists("menuitem", $this->Data)){

			/******** latintitle ********/
			$this->latintitle->setValue($this->Data['menuitem']->getLatintitle());
			$this->setFieldCaption('latintitle',$this->Data['menuitem']->getFieldInfo('latintitle')->getTitle());

			/******** module ********/
			$this->module->setValue($this->Data['menuitem']->getModule());
			$this->setFieldCaption('module',$this->Data['menuitem']->getFieldInfo('module')->getTitle());

			/******** page ********/
			$this->page->setValue($this->Data['menuitem']->getPage());
			$this->setFieldCaption('page',$this->Data['menuitem']->getFieldInfo('page')->getTitle());

			/******** parameters ********/
			$this->parameters->setValue($this->Data['menuitem']->getParameters());
			$this->setFieldCaption('parameters',$this->Data['menuitem']->getFieldInfo('parameters')->getTitle());

			/******** priority ********/
			$this->priority->setValue($this->Data['menuitem']->getPriority());
			$this->setFieldCaption('priority',$this->Data['menuitem']->getFieldInfo('priority')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** latintitle ********/
		$this->sortby->addOption($this->Data['menuitem']->getTableFieldID('latintitle'),$this->getFieldCaption('latintitle'));
		if(isset($_GET['latintitle']))
			$this->latintitle->setValue($_GET['latintitle']);

		/******** module ********/
		$this->sortby->addOption($this->Data['menuitem']->getTableFieldID('module'),$this->getFieldCaption('module'));
		if(isset($_GET['module']))
			$this->module->setValue($_GET['module']);

		/******** page ********/
		$this->sortby->addOption($this->Data['menuitem']->getTableFieldID('page'),$this->getFieldCaption('page'));
		if(isset($_GET['page']))
			$this->page->setValue($_GET['page']);

		/******** parameters ********/
		$this->sortby->addOption($this->Data['menuitem']->getTableFieldID('parameters'),$this->getFieldCaption('parameters'));
		if(isset($_GET['parameters']))
			$this->parameters->setValue($_GET['parameters']);

		/******** priority ********/
		$this->sortby->addOption($this->Data['menuitem']->getTableFieldID('priority'),$this->getFieldCaption('priority'));
		if(isset($_GET['priority']))
			$this->priority->setValue($_GET['priority']);

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