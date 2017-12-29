<?php
namespace Modules\ocms\Forms;
use core\CoreClasses\html\TimePicker;
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
class managedoctorplan_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("ocms_managedoctorplan");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['doctorplan']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
        $LTable1->addElement($this->getFieldRowCode($this->date,$this->getFieldCaption('date'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
        $LTable1->addElement($this->getFieldRowCode($this->start_time,$this->getFieldCaption('start_time'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->end_time,$this->getFieldCaption('end_time'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->doctor_fid,$this->getFieldCaption('doctor_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
		foreach ($this->Data['doctor_fid'] as $item)
			$this->doctor_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("doctorplan", $this->Data)){

            /******** date ********/
            $this->date->setTime($this->Data['doctorplan']->getStart_time());
            $this->setFieldCaption('date',"تاریخ");


			/******** start_time ********/
			$this->start_time->setTime($this->Data['doctorplan']->getStart_time());
			$this->setFieldCaption('start_time',$this->Data['doctorplan']->getFieldInfo('start_time')->getTitle());
			$this->start_time->setFieldInfo($this->Data['doctorplan']->getFieldInfo('start_time'));

			/******** end_time ********/
			$this->end_time->setTime($this->Data['doctorplan']->getEnd_time());
			$this->setFieldCaption('end_time',$this->Data['doctorplan']->getFieldInfo('end_time')->getTitle());
			$this->end_time->setFieldInfo($this->Data['doctorplan']->getFieldInfo('end_time'));

			/******** doctor_fid ********/
			$this->doctor_fid->setSelectedValue($this->Data['doctorplan']->getDoctor_fid());
			$this->setFieldCaption('doctor_fid',$this->Data['doctorplan']->getFieldInfo('doctor_fid')->getTitle());

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

        /******* date *******/
        $this->date= new DatePicker("date");
        $this->date->setClass("form-control");


		/******* start_time *******/
		$this->start_time= new TimePicker("start_time");
		$this->start_time->setClass("form-control");

		/******* end_time *******/
		$this->end_time= new TimePicker("end_time");
		$this->end_time->setClass("form-control");

		/******* doctor_fid *******/
		$this->doctor_fid= new combobox("doctor_fid");
		$this->doctor_fid->setClass("form-control");

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
    /** @var DatePicker */
    private $date;
    /**
     * @return DatePicker
     */
    public function getDate()
    {
        return $this->date;
    }
	/** @var TimePicker */
	private $start_time;
	/**
	 * @return TimePicker
	 */
	public function getStart_time()
	{
		return $this->start_time;
	}
	/** @var TimePicker */
	private $end_time;
	/**
	 * @return TimePicker
	 */
	public function getEnd_time()
	{
		return $this->end_time;
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