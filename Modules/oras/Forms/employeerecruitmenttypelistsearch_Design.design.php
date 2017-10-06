<?php
namespace Modules\oras\Forms;
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
*@creationDate 1396-07-10 - 2017-10-02 23:05
*@lastUpdate 1396-07-10 - 2017-10-02 23:05
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class employeerecruitmenttypelistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var combobox */
	private $employee_fid;
	/**
	 * @return combobox
	 */
	public function getEmployee_fid()
	{
		return $this->employee_fid;
	}
	/** @var combobox */
	private $recruitmenttype_fid;
	/**
	 * @return combobox
	 */
	public function getRecruitmenttype_fid()
	{
		return $this->recruitmenttype_fid;
	}
	/** @var DatePicker */
	private $start_date_from;
	/**
	 * @return DatePicker
	 */
	public function getStart_date_from()
	{
		return $this->start_date_from;
	}
	/** @var DatePicker */
	private $start_date_to;
	/**
	 * @return DatePicker
	 */
	public function getStart_date_to()
	{
		return $this->start_date_to;
	}
	/** @var DatePicker */
	private $end_date_from;
	/**
	 * @return DatePicker
	 */
	public function getEnd_date_from()
	{
		return $this->end_date_from;
	}
	/** @var DatePicker */
	private $end_date_to;
	/**
	 * @return DatePicker
	 */
	public function getEnd_date_to()
	{
		return $this->end_date_to;
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

		/******* employee_fid *******/
		$this->employee_fid= new combobox("employee_fid");
		$this->employee_fid->setClass("form-control");

		/******* recruitmenttype_fid *******/
		$this->recruitmenttype_fid= new combobox("recruitmenttype_fid");
		$this->recruitmenttype_fid->setClass("form-control");

		/******* start_date_from *******/
		$this->start_date_from= new DatePicker("start_date_from");
		$this->start_date_from->setClass("form-control");

		/******* start_date_to *******/
		$this->start_date_to= new DatePicker("start_date_to");
		$this->start_date_to->setClass("form-control");

		/******* end_date_from *******/
		$this->end_date_from= new DatePicker("end_date_from");
		$this->end_date_from->setClass("form-control");

		/******* end_date_to *******/
		$this->end_date_to= new DatePicker("end_date_to");
		$this->end_date_to->setClass("form-control");

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
		$Page->setId("oras_employeerecruitmenttypelist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['employeerecruitmenttype']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->employee_fid,$this->getFieldCaption('employee_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->recruitmenttype_fid,$this->getFieldCaption('recruitmenttype_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->start_date_from,$this->getFieldCaption('start_date_from'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->start_date_to,$this->getFieldCaption('start_date_to'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->end_date_from,$this->getFieldCaption('end_date_from'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->end_date_to,$this->getFieldCaption('end_date_to'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->sortby,$this->getFieldCaption('sortby'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->isdesc,$this->getFieldCaption('isdesc'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getSingleFieldRowCode($this->search));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "GET", $Page);
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
	public function FillItems()
	{

			/******** employee_fid ********/
			$this->employee_fid->addOption("", "مهم نیست");
		foreach ($this->Data['employee_fid'] as $item)
			$this->employee_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("employeerecruitmenttype", $this->Data)){
			$this->employee_fid->setSelectedValue($this->Data['employeerecruitmenttype']->getEmployee_fid());
			$this->setFieldCaption('employee_fid',$this->Data['employeerecruitmenttype']->getFieldInfo('employee_fid')->getTitle());
		}

			/******** recruitmenttype_fid ********/
			$this->recruitmenttype_fid->addOption("", "مهم نیست");
		foreach ($this->Data['recruitmenttype_fid'] as $item)
			$this->recruitmenttype_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("employeerecruitmenttype", $this->Data)){
			$this->recruitmenttype_fid->setSelectedValue($this->Data['employeerecruitmenttype']->getRecruitmenttype_fid());
			$this->setFieldCaption('recruitmenttype_fid',$this->Data['employeerecruitmenttype']->getFieldInfo('recruitmenttype_fid')->getTitle());
		}

			/******** start_date_from ********/
		if (key_exists("employeerecruitmenttype", $this->Data)){
			$this->start_date_from->setTime($this->Data['employeerecruitmenttype']->getStart_date_from());
			$this->setFieldCaption('start_date_from',$this->Data['employeerecruitmenttype']->getFieldInfo('start_date_from')->getTitle());
		}

			/******** start_date_to ********/
		if (key_exists("employeerecruitmenttype", $this->Data)){
			$this->start_date_to->setTime($this->Data['employeerecruitmenttype']->getStart_date_to());
			$this->setFieldCaption('start_date_to',$this->Data['employeerecruitmenttype']->getFieldInfo('start_date_to')->getTitle());
		}

			/******** end_date_from ********/
		if (key_exists("employeerecruitmenttype", $this->Data)){
			$this->end_date_from->setTime($this->Data['employeerecruitmenttype']->getEnd_date_from());
			$this->setFieldCaption('end_date_from',$this->Data['employeerecruitmenttype']->getFieldInfo('end_date_from')->getTitle());
		}

			/******** end_date_to ********/
		if (key_exists("employeerecruitmenttype", $this->Data)){
			$this->end_date_to->setTime($this->Data['employeerecruitmenttype']->getEnd_date_to());
			$this->setFieldCaption('end_date_to',$this->Data['employeerecruitmenttype']->getFieldInfo('end_date_to')->getTitle());
		}

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** employee_fid ********/
		$this->sortby->addOption('employee_fid',$this->getFieldCaption('employee_fid'));
		if(isset($_GET['employee_fid']))
			$this->employee_fid->setSelectedValue($_GET['employee_fid']);

		/******** recruitmenttype_fid ********/
		$this->sortby->addOption('recruitmenttype_fid',$this->getFieldCaption('recruitmenttype_fid'));
		if(isset($_GET['recruitmenttype_fid']))
			$this->recruitmenttype_fid->setSelectedValue($_GET['recruitmenttype_fid']);

		/******** start_date_from ********/
		$this->sortby->addOption('start_date_from',$this->getFieldCaption('start_date_from'));

		/******** start_date_to ********/
		$this->sortby->addOption('start_date_to',$this->getFieldCaption('start_date_to'));

		/******** end_date_from ********/
		$this->sortby->addOption('end_date_from',$this->getFieldCaption('end_date_from'));

		/******** end_date_to ********/
		$this->sortby->addOption('end_date_to',$this->getFieldCaption('end_date_to'));

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