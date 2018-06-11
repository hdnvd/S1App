<?php
namespace Modules\shift\Forms;
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
*@creationDate 1397-01-17 - 2018-04-06 21:17
*@lastUpdate 1397-01-17 - 2018-04-06 21:17
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class shifttypelistsearch_Design extends FormDesign {
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
	private $valueinminutes;
	/**
	 * @return textbox
	 */
	public function getValueinminutes()
	{
		return $this->valueinminutes;
	}
	/** @var textbox */
	private $abbreviation;
	/**
	 * @return textbox
	 */
	public function getAbbreviation()
	{
		return $this->abbreviation;
	}
	/** @var textbox */
	private $latinabbreviation;
	/**
	 * @return textbox
	 */
	public function getLatinabbreviation()
	{
		return $this->latinabbreviation;
	}
	/** @var combobox */
	private $isvisible;
	/**
	 * @return combobox
	 */
	public function getIsvisible()
	{
		return $this->isvisible;
	}
	/** @var textbox */
	private $holidayfactor;
	/**
	 * @return textbox
	 */
	public function getHolidayfactor()
	{
		return $this->holidayfactor;
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

		/******* valueinminutes *******/
		$this->valueinminutes= new textbox("valueinminutes");
		$this->valueinminutes->setClass("form-control");

		/******* abbreviation *******/
		$this->abbreviation= new textbox("abbreviation");
		$this->abbreviation->setClass("form-control");

		/******* latinabbreviation *******/
		$this->latinabbreviation= new textbox("latinabbreviation");
		$this->latinabbreviation->setClass("form-control");

		/******* isvisible *******/
		$this->isvisible= new combobox("isvisible");
		$this->isvisible->setClass("form-control");

		/******* holidayfactor *******/
		$this->holidayfactor= new textbox("holidayfactor");
		$this->holidayfactor->setClass("form-control");

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
		$Page->setId("shift_shifttypelist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['shifttype']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->valueinminutes,$this->getFieldCaption('valueinminutes'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->abbreviation,$this->getFieldCaption('abbreviation'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->latinabbreviation,$this->getFieldCaption('latinabbreviation'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->isvisible,$this->getFieldCaption('isvisible'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->holidayfactor,$this->getFieldCaption('holidayfactor'),null,'',null));
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
			$this->isvisible->addOption("", "مهم نیست");
			$this->isvisible->addOption(1,'بله');
			$this->isvisible->addOption(0,'خیر');
		if (key_exists("shifttype", $this->Data)){

			/******** title ********/
			$this->title->setValue($this->Data['shifttype']->getTitle());
			$this->setFieldCaption('title',$this->Data['shifttype']->getFieldInfo('title')->getTitle());

			/******** valueinminutes ********/
			$this->valueinminutes->setValue($this->Data['shifttype']->getValueinminutes());
			$this->setFieldCaption('valueinminutes',$this->Data['shifttype']->getFieldInfo('valueinminutes')->getTitle());

			/******** abbreviation ********/
			$this->abbreviation->setValue($this->Data['shifttype']->getAbbreviation());
			$this->setFieldCaption('abbreviation',$this->Data['shifttype']->getFieldInfo('abbreviation')->getTitle());

			/******** latinabbreviation ********/
			$this->latinabbreviation->setValue($this->Data['shifttype']->getLatinabbreviation());
			$this->setFieldCaption('latinabbreviation',$this->Data['shifttype']->getFieldInfo('latinabbreviation')->getTitle());

			/******** isvisible ********/
			$this->isvisible->setSelectedValue($this->Data['shifttype']->getIsvisible());
			$this->setFieldCaption('isvisible',$this->Data['shifttype']->getFieldInfo('isvisible')->getTitle());

			/******** holidayfactor ********/
			$this->holidayfactor->setValue($this->Data['shifttype']->getHolidayfactor());
			$this->setFieldCaption('holidayfactor',$this->Data['shifttype']->getFieldInfo('holidayfactor')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** title ********/
		$this->sortby->addOption($this->Data['shifttype']->getTableFieldID('title'),$this->getFieldCaption('title'));
		if(isset($_GET['title']))
			$this->title->setValue($_GET['title']);

		/******** valueinminutes ********/
		$this->sortby->addOption($this->Data['shifttype']->getTableFieldID('valueinminutes'),$this->getFieldCaption('valueinminutes'));
		if(isset($_GET['valueinminutes']))
			$this->valueinminutes->setValue($_GET['valueinminutes']);

		/******** abbreviation ********/
		$this->sortby->addOption($this->Data['shifttype']->getTableFieldID('abbreviation'),$this->getFieldCaption('abbreviation'));
		if(isset($_GET['abbreviation']))
			$this->abbreviation->setValue($_GET['abbreviation']);

		/******** latinabbreviation ********/
		$this->sortby->addOption($this->Data['shifttype']->getTableFieldID('latinabbreviation'),$this->getFieldCaption('latinabbreviation'));
		if(isset($_GET['latinabbreviation']))
			$this->latinabbreviation->setValue($_GET['latinabbreviation']);

		/******** isvisible ********/
		$this->sortby->addOption($this->Data['shifttype']->getTableFieldID('isvisible'),$this->getFieldCaption('isvisible'));
		if(isset($_GET['isvisible']))
			$this->isvisible->setSelectedValue($_GET['isvisible']);

		/******** holidayfactor ********/
		$this->sortby->addOption($this->Data['shifttype']->getTableFieldID('holidayfactor'),$this->getFieldCaption('holidayfactor'));
		if(isset($_GET['holidayfactor']))
			$this->holidayfactor->setValue($_GET['holidayfactor']);

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