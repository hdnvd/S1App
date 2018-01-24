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
class managemorakhasi_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("shift_managemorakhasi");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['morakhasi']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->elat,$this->getFieldCaption('elat'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->doctor,$this->getFieldCaption('doctor'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->start_time,$this->getFieldCaption('start_time'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->end_time,$this->getFieldCaption('end_time'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->add_time,$this->getFieldCaption('add_time'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->morakhasi_type,$this->getFieldCaption('morakhasi_type'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->personel_fid,$this->getFieldCaption('personel_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->mahal,$this->getFieldCaption('mahal'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getSingleFieldRowCode($this->btnSave));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		$form->SetAttribute("novalidate","novalidate");
		$form->SetAttribute("data-toggle","validator");
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
	public function FillItems()
	{
		foreach ($this->Data['personel_fid'] as $item)
			$this->personel_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("morakhasi", $this->Data)){

			/******** elat ********/
			$this->elat->setValue($this->Data['morakhasi']->getElat());
			$this->setFieldCaption('elat',$this->Data['morakhasi']->getFieldInfo('elat')->getTitle());
			$this->elat->setFieldInfo($this->Data['morakhasi']->getFieldInfo('elat'));

			/******** doctor ********/
			$this->doctor->setValue($this->Data['morakhasi']->getDoctor());
			$this->setFieldCaption('doctor',$this->Data['morakhasi']->getFieldInfo('doctor')->getTitle());
			$this->doctor->setFieldInfo($this->Data['morakhasi']->getFieldInfo('doctor'));

			/******** start_time ********/
			$this->start_time->setTime($this->Data['morakhasi']->getStart_time());
			$this->setFieldCaption('start_time',$this->Data['morakhasi']->getFieldInfo('start_time')->getTitle());
			$this->start_time->setFieldInfo($this->Data['morakhasi']->getFieldInfo('start_time'));

			/******** end_time ********/
			$this->end_time->setTime($this->Data['morakhasi']->getEnd_time());
			$this->setFieldCaption('end_time',$this->Data['morakhasi']->getFieldInfo('end_time')->getTitle());
			$this->end_time->setFieldInfo($this->Data['morakhasi']->getFieldInfo('end_time'));

			/******** add_time ********/
			$this->add_time->setTime($this->Data['morakhasi']->getAdd_time());
			$this->setFieldCaption('add_time',$this->Data['morakhasi']->getFieldInfo('add_time')->getTitle());
			$this->add_time->setFieldInfo($this->Data['morakhasi']->getFieldInfo('add_time'));

			/******** morakhasi_type ********/
			$this->morakhasi_type->setValue($this->Data['morakhasi']->getMorakhasi_type());
			$this->setFieldCaption('morakhasi_type',$this->Data['morakhasi']->getFieldInfo('morakhasi_type')->getTitle());
			$this->morakhasi_type->setFieldInfo($this->Data['morakhasi']->getFieldInfo('morakhasi_type'));

			/******** personel_fid ********/
			$this->personel_fid->setSelectedValue($this->Data['morakhasi']->getPersonel_fid());
			$this->setFieldCaption('personel_fid',$this->Data['morakhasi']->getFieldInfo('personel_fid')->getTitle());

			/******** mahal ********/
			$this->mahal->setValue($this->Data['morakhasi']->getMahal());
			$this->setFieldCaption('mahal',$this->Data['morakhasi']->getFieldInfo('mahal')->getTitle());
			$this->mahal->setFieldInfo($this->Data['morakhasi']->getFieldInfo('mahal'));

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* elat *******/
		$this->elat= new textbox("elat");
		$this->elat->setClass("form-control");

		/******* doctor *******/
		$this->doctor= new textbox("doctor");
		$this->doctor->setClass("form-control");

		/******* start_time *******/
		$this->start_time= new DatePicker("start_time");
		$this->start_time->setClass("form-control");

		/******* end_time *******/
		$this->end_time= new DatePicker("end_time");
		$this->end_time->setClass("form-control");

		/******* add_time *******/
		$this->add_time= new DatePicker("add_time");
		$this->add_time->setClass("form-control");

		/******* morakhasi_type *******/
		$this->morakhasi_type= new textbox("morakhasi_type");
		$this->morakhasi_type->setClass("form-control");

		/******* personel_fid *******/
		$this->personel_fid= new combobox("personel_fid");
		$this->personel_fid->setClass("form-control");

		/******* mahal *******/
		$this->mahal= new textbox("mahal");
		$this->mahal->setClass("form-control");

		/******* btnSave *******/
		$this->btnSave= new SweetButton(true,"ذخیره");
		$this->btnSave->setAction("btnSave");
		$this->btnSave->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
		$this->btnSave->setClass("btn btn-primary");
	}
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	private $adminMode=true;
    public function getAdminMode()
    {
        return $this->adminMode;
    }
        /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
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
	private $start_time;
	/**
	 * @return DatePicker
	 */
	public function getStart_time()
	{
		return $this->start_time;
	}
	/** @var DatePicker */
	private $end_time;
	/**
	 * @return DatePicker
	 */
	public function getEnd_time()
	{
		return $this->end_time;
	}
	/** @var DatePicker */
	private $add_time;
	/**
	 * @return DatePicker
	 */
	public function getAdd_time()
	{
		return $this->add_time;
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
	/** @var SweetButton */
	private $btnSave;
    public function getJSON()
    {
       parent::getJSON();
       $Result=['message'=>$this->getMessage(),'messagetype'=>$this->getMessageType()];
       return json_encode($Result);
    }
}
?>