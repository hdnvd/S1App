<?php
namespace Modules\ocms\Forms;
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
*@creationDate 1396-09-23 - 2017-12-14 01:18
*@lastUpdate 1396-09-23 - 2017-12-14 01:18
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class doctorplanlistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var DatePicker */
	private $start_time_from;
	/**
	 * @return DatePicker
	 */
	public function getStart_time_from()
	{
		return $this->start_time_from;
	}
	/** @var DatePicker */
	private $start_time_to;
	/**
	 * @return DatePicker
	 */
	public function getStart_time_to()
	{
		return $this->start_time_to;
	}
	/** @var DatePicker */
	private $end_time_from;
	/**
	 * @return DatePicker
	 */
	public function getEnd_time_from()
	{
		return $this->end_time_from;
	}
	/** @var DatePicker */
	private $end_time_to;
	/**
	 * @return DatePicker
	 */
	public function getEnd_time_to()
	{
		return $this->end_time_to;
	}
	/** @var combobox */
	private $doctor_fid;
	/**
	 * @return combobox
	 */
	public function getDoctor_fid()
	{
		return $this->doctor_fid;
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

		/******* start_time_from *******/
		$this->start_time_from= new DatePicker("start_time_from");
		$this->start_time_from->setClass("form-control");

		/******* start_time_to *******/
		$this->start_time_to= new DatePicker("start_time_to");
		$this->start_time_to->setClass("form-control");

		/******* end_time_from *******/
		$this->end_time_from= new DatePicker("end_time_from");
		$this->end_time_from->setClass("form-control");

		/******* end_time_to *******/
		$this->end_time_to= new DatePicker("end_time_to");
		$this->end_time_to->setClass("form-control");

		/******* doctor_fid *******/
		$this->doctor_fid= new combobox("doctor_fid");
		$this->doctor_fid->setClass("form-control");

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
		$Page->setId("ocms_doctorplanlist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['doctorplan']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->start_time_from,$this->getFieldCaption('start_time_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->start_time_to,$this->getFieldCaption('start_time_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->end_time_from,$this->getFieldCaption('end_time_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->end_time_to,$this->getFieldCaption('end_time_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->doctor_fid,$this->getFieldCaption('doctor_fid'),null,'',null));
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
			$this->doctor_fid->addOption("", "مهم نیست");
		foreach ($this->Data['doctor_fid'] as $item)
			$this->doctor_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("doctorplan", $this->Data)){

			/******** start_time_from ********/
			$this->start_time_from->setTime($this->Data['doctorplan']->getStart_time_from());
			$this->setFieldCaption('start_time_from',$this->Data['doctorplan']->getFieldInfo('start_time_from')->getTitle());

			/******** start_time_to ********/
			$this->start_time_to->setTime($this->Data['doctorplan']->getStart_time_to());
			$this->setFieldCaption('start_time_to',$this->Data['doctorplan']->getFieldInfo('start_time_to')->getTitle());
			$this->setFieldCaption('start_time',$this->Data['doctorplan']->getFieldInfo('start_time')->getTitle());

			/******** end_time_from ********/
			$this->end_time_from->setTime($this->Data['doctorplan']->getEnd_time_from());
			$this->setFieldCaption('end_time_from',$this->Data['doctorplan']->getFieldInfo('end_time_from')->getTitle());

			/******** end_time_to ********/
			$this->end_time_to->setTime($this->Data['doctorplan']->getEnd_time_to());
			$this->setFieldCaption('end_time_to',$this->Data['doctorplan']->getFieldInfo('end_time_to')->getTitle());
			$this->setFieldCaption('end_time',$this->Data['doctorplan']->getFieldInfo('end_time')->getTitle());

			/******** doctor_fid ********/
			$this->doctor_fid->setSelectedValue($this->Data['doctorplan']->getDoctor_fid());
			$this->setFieldCaption('doctor_fid',$this->Data['doctorplan']->getFieldInfo('doctor_fid')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** start_time_from ********/

		/******** start_time_to ********/
		$this->sortby->addOption($this->Data['doctorplan']->getTableFieldID('start_time'),$this->getFieldCaption('start_time'));

		/******** end_time_from ********/

		/******** end_time_to ********/
		$this->sortby->addOption($this->Data['doctorplan']->getTableFieldID('end_time'),$this->getFieldCaption('end_time'));

		/******** doctor_fid ********/
		$this->sortby->addOption($this->Data['doctorplan']->getTableFieldID('doctor_fid'),$this->getFieldCaption('doctor_fid'));
		if(isset($_GET['doctor_fid']))
			$this->doctor_fid->setSelectedValue($_GET['doctor_fid']);

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