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
*@creationDate 1396-09-17 - 2017-12-08 09:41
*@lastUpdate 1396-09-17 - 2017-12-08 09:41
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class unitlistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var combobox */
	private $topunit_fid;
	/**
	 * @return combobox
	 */
	public function getTopunit_fid()
	{
		return $this->topunit_fid;
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
	/** @var combobox */
	private $isfava;
	/**
	 * @return combobox
	 */
	public function getIsfava()
	{
		return $this->isfava;
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

		/******* topunit_fid *******/
		$this->topunit_fid= new combobox("topunit_fid");
		$this->topunit_fid->setClass("form-control");

		/******* title *******/
		$this->title= new textbox("title");
		$this->title->setClass("form-control");

		/******* isfava *******/
		$this->isfava= new combobox("isfava");
		$this->isfava->setClass("form-control");

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
		$Page->setId("itsap_unitlist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['unit']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->topunit_fid,$this->getFieldCaption('topunit_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->isfava,$this->getFieldCaption('isfava'),null,'',null));
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
			$this->topunit_fid->addOption("", "مهم نیست");
		foreach ($this->Data['topunit_fid'] as $item)
			$this->topunit_fid->addOption($item->getID(), $item->getTitleField());
			$this->isfava->addOption("", "مهم نیست");
			$this->isfava->addOption(1,'بله');
			$this->isfava->addOption(0,'خیر');
		if (key_exists("unit", $this->Data)){

			/******** topunit_fid ********/
			$this->topunit_fid->setSelectedValue($this->Data['unit']->getTopunit_fid());
			$this->setFieldCaption('topunit_fid',$this->Data['unit']->getFieldInfo('topunit_fid')->getTitle());

			/******** title ********/
			$this->title->setValue($this->Data['unit']->getTitle());
			$this->setFieldCaption('title',$this->Data['unit']->getFieldInfo('title')->getTitle());

			/******** isfava ********/
			$this->isfava->setSelectedValue($this->Data['unit']->getIsfava());
			$this->setFieldCaption('isfava',$this->Data['unit']->getFieldInfo('isfava')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** topunit_fid ********/
		$this->sortby->addOption($this->Data['unit']->getTableFieldID('topunit_fid'),$this->getFieldCaption('topunit_fid'));
		if(isset($_GET['topunit_fid']))
			$this->topunit_fid->setSelectedValue($_GET['topunit_fid']);

		/******** title ********/
		$this->sortby->addOption($this->Data['unit']->getTableFieldID('title'),$this->getFieldCaption('title'));
		if(isset($_GET['title']))
			$this->title->setValue($_GET['title']);

		/******** isfava ********/
		$this->sortby->addOption($this->Data['unit']->getTableFieldID('isfava'),$this->getFieldCaption('isfava'));
		if(isset($_GET['isfava']))
			$this->isfava->setSelectedValue($_GET['isfava']);

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