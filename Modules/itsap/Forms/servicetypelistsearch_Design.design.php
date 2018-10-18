<?php
namespace Modules\itsap\Forms;
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
*@creationDate 1397-07-26 - 2018-10-18 17:12
*@lastUpdate 1397-07-26 - 2018-10-18 17:12
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class servicetypelistsearch_Design extends FormDesign {
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
	private $priority;
	/**
	 * @return textbox
	 */
	public function getPriority()
	{
		return $this->priority;
	}
	/** @var combobox */
	private $servicetypegroup_fid;
	/**
	 * @return combobox
	 */
	public function getServicetypegroup_fid()
	{
		return $this->servicetypegroup_fid;
	}
	/** @var combobox */
	private $is_needdevice;
	/**
	 * @return combobox
	 */
	public function getIs_needdevice()
	{
		return $this->is_needdevice;
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

		/******* priority *******/
		$this->priority= new textbox("priority");
		$this->priority->setClass("form-control");

		/******* servicetypegroup_fid *******/
		$this->servicetypegroup_fid= new combobox("servicetypegroup_fid");
		$this->servicetypegroup_fid->setClass("form-control selectpicker");
		$this->servicetypegroup_fid->SetAttribute("data-live-search",true);

		/******* is_needdevice *******/
		$this->is_needdevice= new combobox("is_needdevice");
		$this->is_needdevice->setClass("form-control selectpicker");

		/******* sortby *******/
		$this->sortby= new combobox("sortby");
		$this->sortby->setClass("form-control selectpicker");

		/******* isdesc *******/
		$this->isdesc= new combobox("isdesc");
		$this->isdesc->setClass("form-control selectpicker");

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
		$Page->setId("itsap_servicetypelist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['servicetype']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->priority,$this->getFieldCaption('priority'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->servicetypegroup_fid,$this->getFieldCaption('servicetypegroup_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->is_needdevice,$this->getFieldCaption('is_needdevice'),null,'',null));
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
			$this->servicetypegroup_fid->addOption("", "مهم نیست");
		foreach ($this->Data['servicetypegroup_fid'] as $item)
			$this->servicetypegroup_fid->addOption($item->getID(), $item->getTitleField());
			$this->is_needdevice->addOption("", "مهم نیست");
			$this->is_needdevice->addOption(1,'بله');
			$this->is_needdevice->addOption(0,'خیر');
		if (key_exists("servicetype", $this->Data)){

			/******** title ********/
			$this->title->setValue($this->Data['servicetype']->getTitle());
			$this->setFieldCaption('title',$this->Data['servicetype']->getFieldInfo('title')->getTitle());

			/******** priority ********/
			$this->priority->setValue($this->Data['servicetype']->getPriority());
			$this->setFieldCaption('priority',$this->Data['servicetype']->getFieldInfo('priority')->getTitle());

			/******** servicetypegroup_fid ********/
			$this->servicetypegroup_fid->setSelectedValue($this->Data['servicetype']->getServicetypegroup_fid());
			$this->setFieldCaption('servicetypegroup_fid',$this->Data['servicetype']->getFieldInfo('servicetypegroup_fid')->getTitle());

			/******** is_needdevice ********/
			$this->is_needdevice->setSelectedValue($this->Data['servicetype']->getIs_needdevice());
			$this->setFieldCaption('is_needdevice',$this->Data['servicetype']->getFieldInfo('is_needdevice')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** title ********/
		$this->sortby->addOption($this->Data['servicetype']->getTableFieldID('title'),$this->getFieldCaption('title'));
		if(isset($_GET['title']))
			$this->title->setValue($_GET['title']);

		/******** priority ********/
		$this->sortby->addOption($this->Data['servicetype']->getTableFieldID('priority'),$this->getFieldCaption('priority'));
		if(isset($_GET['priority']))
			$this->priority->setValue($_GET['priority']);

		/******** servicetypegroup_fid ********/
		$this->sortby->addOption($this->Data['servicetype']->getTableFieldID('servicetypegroup_fid'),$this->getFieldCaption('servicetypegroup_fid'));
		if(isset($_GET['servicetypegroup_fid']))
			$this->servicetypegroup_fid->setSelectedValue($_GET['servicetypegroup_fid']);

		/******** is_needdevice ********/
		$this->sortby->addOption($this->Data['servicetype']->getTableFieldID('is_needdevice'),$this->getFieldCaption('is_needdevice'));
		if(isset($_GET['is_needdevice']))
			$this->is_needdevice->setSelectedValue($_GET['is_needdevice']);

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