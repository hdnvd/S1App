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
*@creationDate 1396-11-19 - 2018-02-08 15:47
*@lastUpdate 1396-11-19 - 2018-02-08 15:47
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class systemrolelistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
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
	/** @var textbox */
	private $defaultmodule;
	/**
	 * @return textbox
	 */
	public function getDefaultmodule()
	{
		return $this->defaultmodule;
	}
	/** @var textbox */
	private $defaultpage;
	/**
	 * @return textbox
	 */
	public function getDefaultpage()
	{
		return $this->defaultpage;
	}
	/** @var textbox */
	private $indexparameters;
	/**
	 * @return textbox
	 */
	public function getIndexparameters()
	{
		return $this->indexparameters;
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

		/******* title *******/
		$this->title= new textbox("title");
		$this->title->setClass("form-control");

		/******* defaultmodule *******/
		$this->defaultmodule= new textbox("defaultmodule");
		$this->defaultmodule->setClass("form-control");

		/******* defaultpage *******/
		$this->defaultpage= new textbox("defaultpage");
		$this->defaultpage->setClass("form-control");

		/******* indexparameters *******/
		$this->indexparameters= new textbox("indexparameters");
		$this->indexparameters->setClass("form-control");

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

		/******* Systemtask *******/
		$this->Systemtasks= new  CheckBox('systemtask[]');
	}
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("users_systemrolelist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['systemrole']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->defaultmodule,$this->getFieldCaption('defaultmodule'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->defaultpage,$this->getFieldCaption('defaultpage'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->indexparameters,$this->getFieldCaption('indexparameters'),null,'',null));
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
		if (key_exists("systemrole", $this->Data)){

			/******** title ********/
			$this->title->setValue($this->Data['systemrole']->getTitle());
			$this->setFieldCaption('title',$this->Data['systemrole']->getFieldInfo('title')->getTitle());

			/******** defaultmodule ********/
			$this->defaultmodule->setValue($this->Data['systemrole']->getDefaultmodule());
			$this->setFieldCaption('defaultmodule',$this->Data['systemrole']->getFieldInfo('defaultmodule')->getTitle());

			/******** defaultpage ********/
			$this->defaultpage->setValue($this->Data['systemrole']->getDefaultpage());
			$this->setFieldCaption('defaultpage',$this->Data['systemrole']->getFieldInfo('defaultpage')->getTitle());

			/******** indexparameters ********/
			$this->indexparameters->setValue($this->Data['systemrole']->getIndexparameters());
			$this->setFieldCaption('indexparameters',$this->Data['systemrole']->getFieldInfo('indexparameters')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** title ********/
		$this->sortby->addOption($this->Data['systemrole']->getTableFieldID('title'),$this->getFieldCaption('title'));
		if(isset($_GET['title']))
			$this->title->setValue($_GET['title']);

		/******** defaultmodule ********/
		$this->sortby->addOption($this->Data['systemrole']->getTableFieldID('defaultmodule'),$this->getFieldCaption('defaultmodule'));
		if(isset($_GET['defaultmodule']))
			$this->defaultmodule->setValue($_GET['defaultmodule']);

		/******** defaultpage ********/
		$this->sortby->addOption($this->Data['systemrole']->getTableFieldID('defaultpage'),$this->getFieldCaption('defaultpage'));
		if(isset($_GET['defaultpage']))
			$this->defaultpage->setValue($_GET['defaultpage']);

		/******** indexparameters ********/
		$this->sortby->addOption($this->Data['systemrole']->getTableFieldID('indexparameters'),$this->getFieldCaption('indexparameters'));
		if(isset($_GET['indexparameters']))
			$this->indexparameters->setValue($_GET['indexparameters']);

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