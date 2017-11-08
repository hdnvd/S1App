<?php
namespace Modules\onlineclass\Forms;
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
*@creationDate 1396-07-25 - 2017-10-17 15:59
*@lastUpdate 1396-07-25 - 2017-10-17 15:59
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class videolistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var DatePicker */
	private $hold_date_from;
	/**
	 * @return DatePicker
	 */
	public function getHold_date_from()
	{
		return $this->hold_date_from;
	}
	/** @var DatePicker */
	private $hold_date_to;
	/**
	 * @return DatePicker
	 */
	public function getHold_date_to()
	{
		return $this->hold_date_to;
	}
	/** @var combobox */
	private $course_fid;
	/**
	 * @return combobox
	 */
	public function getCourse_fid()
	{
		return $this->course_fid;
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

		/******* hold_date_from *******/
		$this->hold_date_from= new DatePicker("hold_date_from");
		$this->hold_date_from->setClass("form-control");

		/******* hold_date_to *******/
		$this->hold_date_to= new DatePicker("hold_date_to");
		$this->hold_date_to->setClass("form-control");

		/******* course_fid *******/
		$this->course_fid= new combobox("course_fid");
		$this->course_fid->setClass("form-control");

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
		$Page->setId("onlineclass_videolist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['video']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->hold_date_from,$this->getFieldCaption('hold_date_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->hold_date_to,$this->getFieldCaption('hold_date_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->course_fid,$this->getFieldCaption('course_fid'),null,'',null));
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

			/******** hold_date_from ********/
		if (key_exists("video", $this->Data)){
			$this->hold_date_from->setTime($this->Data['video']->getHold_date_from());
			$this->setFieldCaption('hold_date_from',$this->Data['video']->getFieldInfo('hold_date_from')->getTitle());
		}

			/******** hold_date_to ********/
		if (key_exists("video", $this->Data)){
			$this->hold_date_to->setTime($this->Data['video']->getHold_date_to());
			$this->setFieldCaption('hold_date_to',$this->Data['video']->getFieldInfo('hold_date_to')->getTitle());
			$this->setFieldCaption('hold_date',$this->Data['video']->getFieldInfo('hold_date')->getTitle());
		}

			/******** course_fid ********/
			$this->course_fid->addOption("", "مهم نیست");
		foreach ($this->Data['course_fid'] as $item)
			$this->course_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("video", $this->Data)){
			$this->course_fid->setSelectedValue($this->Data['video']->getCourse_fid());
			$this->setFieldCaption('course_fid',$this->Data['video']->getFieldInfo('course_fid')->getTitle());
		}

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** hold_date_from ********/

		/******** hold_date_to ********/
		$this->sortby->addOption($this->Data['video']->getTableFieldID('hold_date'),$this->getFieldCaption('hold_date'));

		/******** course_fid ********/
		$this->sortby->addOption($this->Data['video']->getTableFieldID('course_fid'),$this->getFieldCaption('course_fid'));
		if(isset($_GET['course_fid']))
			$this->course_fid->setSelectedValue($_GET['course_fid']);

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