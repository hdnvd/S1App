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
*@creationDate 1396-07-26 - 2017-10-18 16:38
*@lastUpdate 1396-07-26 - 2017-10-18 16:38
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class usercourselistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var combobox */
	private $user_fid;
	/**
	 * @return combobox
	 */
	public function getUser_fid()
	{
		return $this->user_fid;
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
	/** @var DatePicker */
	private $add_time_from;
	/**
	 * @return DatePicker
	 */
	public function getAdd_time_from()
	{
		return $this->add_time_from;
	}
	/** @var DatePicker */
	private $add_time_to;
	/**
	 * @return DatePicker
	 */
	public function getAdd_time_to()
	{
		return $this->add_time_to;
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

		/******* user_fid *******/
		$this->user_fid= new combobox("user_fid");
		$this->user_fid->setClass("form-control");

		/******* course_fid *******/
		$this->course_fid= new combobox("course_fid");
		$this->course_fid->setClass("form-control");

		/******* add_time_from *******/
		$this->add_time_from= new DatePicker("add_time_from");
		$this->add_time_from->setClass("form-control");

		/******* add_time_to *******/
		$this->add_time_to= new DatePicker("add_time_to");
		$this->add_time_to->setClass("form-control");

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
		$Page->setId("onlineclass_usercourselist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['usercourse']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->user_fid,$this->getFieldCaption('user_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->course_fid,$this->getFieldCaption('course_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->add_time_from,$this->getFieldCaption('add_time_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->add_time_to,$this->getFieldCaption('add_time_to'),null,'',null));
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

			/******** user_fid ********/
			$this->user_fid->addOption("", "مهم نیست");
		foreach ($this->Data['user_fid'] as $item)
			$this->user_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("usercourse", $this->Data)){
			$this->user_fid->setSelectedValue($this->Data['usercourse']->getUser_fid());
			$this->setFieldCaption('user_fid',$this->Data['usercourse']->getFieldInfo('user_fid')->getTitle());
		}

			/******** course_fid ********/
			$this->course_fid->addOption("", "مهم نیست");
		foreach ($this->Data['course_fid'] as $item)
			$this->course_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("usercourse", $this->Data)){
			$this->course_fid->setSelectedValue($this->Data['usercourse']->getCourse_fid());
			$this->setFieldCaption('course_fid',$this->Data['usercourse']->getFieldInfo('course_fid')->getTitle());
		}

			/******** add_time_from ********/
		if (key_exists("usercourse", $this->Data)){
			$this->add_time_from->setTime($this->Data['usercourse']->getAdd_time_from());
			$this->setFieldCaption('add_time_from',$this->Data['usercourse']->getFieldInfo('add_time_from')->getTitle());
		}

			/******** add_time_to ********/
		if (key_exists("usercourse", $this->Data)){
			$this->add_time_to->setTime($this->Data['usercourse']->getAdd_time_to());
			$this->setFieldCaption('add_time_to',$this->Data['usercourse']->getFieldInfo('add_time_to')->getTitle());
			$this->setFieldCaption('add_time',$this->Data['usercourse']->getFieldInfo('add_time')->getTitle());
		}

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** user_fid ********/
		$this->sortby->addOption($this->Data['usercourse']->getTableFieldID('user_fid'),$this->getFieldCaption('user_fid'));
		if(isset($_GET['user_fid']))
			$this->user_fid->setSelectedValue($_GET['user_fid']);

		/******** course_fid ********/
		$this->sortby->addOption($this->Data['usercourse']->getTableFieldID('course_fid'),$this->getFieldCaption('course_fid'));
		if(isset($_GET['course_fid']))
			$this->course_fid->setSelectedValue($_GET['course_fid']);

		/******** add_time_from ********/

		/******** add_time_to ********/
		$this->sortby->addOption($this->Data['usercourse']->getTableFieldID('add_time'),$this->getFieldCaption('add_time'));

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