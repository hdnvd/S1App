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
*@creationDate 1396-10-26 - 2018-01-16 20:22
*@lastUpdate 1396-10-26 - 2018-01-16 20:22
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class morakhasilistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var textbox */
	private $elat;
	/**
	 * @return textbox
	 */
	public function getElat()
	{
		return $this->elat;
	}
	/** @var textbox */
	private $doctor;
	/**
	 * @return textbox
	 */
	public function getDoctor()
	{
		return $this->doctor;
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
	/** @var textbox */
	private $morakhasi_type;
	/**
	 * @return textbox
	 */
	public function getMorakhasi_type()
	{
		return $this->morakhasi_type;
	}
	/** @var combobox */
	private $personel_fid;
	/**
	 * @return combobox
	 */
	public function getPersonel_fid()
	{
		return $this->personel_fid;
	}
	/** @var textbox */
	private $mahal;
	/**
	 * @return textbox
	 */
	public function getMahal()
	{
		return $this->mahal;
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

		/******* elat *******/
		$this->elat= new textbox("elat");
		$this->elat->setClass("form-control");

		/******* doctor *******/
		$this->doctor= new textbox("doctor");
		$this->doctor->setClass("form-control");

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

		/******* add_time_from *******/
		$this->add_time_from= new DatePicker("add_time_from");
		$this->add_time_from->setClass("form-control");

		/******* add_time_to *******/
		$this->add_time_to= new DatePicker("add_time_to");
		$this->add_time_to->setClass("form-control");

		/******* morakhasi_type *******/
		$this->morakhasi_type= new textbox("morakhasi_type");
		$this->morakhasi_type->setClass("form-control");

		/******* personel_fid *******/
		$this->personel_fid= new combobox("personel_fid");
		$this->personel_fid->setClass("form-control");

		/******* mahal *******/
		$this->mahal= new textbox("mahal");
		$this->mahal->setClass("form-control");

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
		$Page->setId("shift_morakhasilist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['morakhasi']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->elat,$this->getFieldCaption('elat'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->doctor,$this->getFieldCaption('doctor'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->start_time_from,$this->getFieldCaption('start_time_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->start_time_to,$this->getFieldCaption('start_time_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->end_time_from,$this->getFieldCaption('end_time_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->end_time_to,$this->getFieldCaption('end_time_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->add_time_from,$this->getFieldCaption('add_time_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->add_time_to,$this->getFieldCaption('add_time_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->morakhasi_type,$this->getFieldCaption('morakhasi_type'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->personel_fid,$this->getFieldCaption('personel_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->mahal,$this->getFieldCaption('mahal'),null,'',null));
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
			$this->personel_fid->addOption("", "مهم نیست");
		foreach ($this->Data['personel_fid'] as $item)
			$this->personel_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("morakhasi", $this->Data)){

			/******** elat ********/
			$this->elat->setValue($this->Data['morakhasi']->getElat());
			$this->setFieldCaption('elat',$this->Data['morakhasi']->getFieldInfo('elat')->getTitle());

			/******** doctor ********/
			$this->doctor->setValue($this->Data['morakhasi']->getDoctor());
			$this->setFieldCaption('doctor',$this->Data['morakhasi']->getFieldInfo('doctor')->getTitle());

			/******** start_time_from ********/
			$this->start_time_from->setTime($this->Data['morakhasi']->getStart_time_from());
			$this->setFieldCaption('start_time_from',$this->Data['morakhasi']->getFieldInfo('start_time_from')->getTitle());

			/******** start_time_to ********/
			$this->start_time_to->setTime($this->Data['morakhasi']->getStart_time_to());
			$this->setFieldCaption('start_time_to',$this->Data['morakhasi']->getFieldInfo('start_time_to')->getTitle());
			$this->setFieldCaption('start_time',$this->Data['morakhasi']->getFieldInfo('start_time')->getTitle());

			/******** end_time_from ********/
			$this->end_time_from->setTime($this->Data['morakhasi']->getEnd_time_from());
			$this->setFieldCaption('end_time_from',$this->Data['morakhasi']->getFieldInfo('end_time_from')->getTitle());

			/******** end_time_to ********/
			$this->end_time_to->setTime($this->Data['morakhasi']->getEnd_time_to());
			$this->setFieldCaption('end_time_to',$this->Data['morakhasi']->getFieldInfo('end_time_to')->getTitle());
			$this->setFieldCaption('end_time',$this->Data['morakhasi']->getFieldInfo('end_time')->getTitle());

			/******** add_time_from ********/
			$this->add_time_from->setTime($this->Data['morakhasi']->getAdd_time_from());
			$this->setFieldCaption('add_time_from',$this->Data['morakhasi']->getFieldInfo('add_time_from')->getTitle());

			/******** add_time_to ********/
			$this->add_time_to->setTime($this->Data['morakhasi']->getAdd_time_to());
			$this->setFieldCaption('add_time_to',$this->Data['morakhasi']->getFieldInfo('add_time_to')->getTitle());
			$this->setFieldCaption('add_time',$this->Data['morakhasi']->getFieldInfo('add_time')->getTitle());

			/******** morakhasi_type ********/
			$this->morakhasi_type->setValue($this->Data['morakhasi']->getMorakhasi_type());
			$this->setFieldCaption('morakhasi_type',$this->Data['morakhasi']->getFieldInfo('morakhasi_type')->getTitle());

			/******** personel_fid ********/
			$this->personel_fid->setSelectedValue($this->Data['morakhasi']->getPersonel_fid());
			$this->setFieldCaption('personel_fid',$this->Data['morakhasi']->getFieldInfo('personel_fid')->getTitle());

			/******** mahal ********/
			$this->mahal->setValue($this->Data['morakhasi']->getMahal());
			$this->setFieldCaption('mahal',$this->Data['morakhasi']->getFieldInfo('mahal')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** elat ********/
		$this->sortby->addOption($this->Data['morakhasi']->getTableFieldID('elat'),$this->getFieldCaption('elat'));
		if(isset($_GET['elat']))
			$this->elat->setValue($_GET['elat']);

		/******** doctor ********/
		$this->sortby->addOption($this->Data['morakhasi']->getTableFieldID('doctor'),$this->getFieldCaption('doctor'));
		if(isset($_GET['doctor']))
			$this->doctor->setValue($_GET['doctor']);

		/******** start_time_from ********/

		/******** start_time_to ********/
		$this->sortby->addOption($this->Data['morakhasi']->getTableFieldID('start_time'),$this->getFieldCaption('start_time'));

		/******** end_time_from ********/

		/******** end_time_to ********/
		$this->sortby->addOption($this->Data['morakhasi']->getTableFieldID('end_time'),$this->getFieldCaption('end_time'));

		/******** add_time_from ********/

		/******** add_time_to ********/
		$this->sortby->addOption($this->Data['morakhasi']->getTableFieldID('add_time'),$this->getFieldCaption('add_time'));

		/******** morakhasi_type ********/
		$this->sortby->addOption($this->Data['morakhasi']->getTableFieldID('morakhasi_type'),$this->getFieldCaption('morakhasi_type'));
		if(isset($_GET['morakhasi_type']))
			$this->morakhasi_type->setValue($_GET['morakhasi_type']);

		/******** personel_fid ********/
		$this->sortby->addOption($this->Data['morakhasi']->getTableFieldID('personel_fid'),$this->getFieldCaption('personel_fid'));
		if(isset($_GET['personel_fid']))
			$this->personel_fid->setSelectedValue($_GET['personel_fid']);

		/******** mahal ********/
		$this->sortby->addOption($this->Data['morakhasi']->getTableFieldID('mahal'),$this->getFieldCaption('mahal'));
		if(isset($_GET['mahal']))
			$this->mahal->setValue($_GET['mahal']);

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