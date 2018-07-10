<?php
namespace Modules\iribfinance\Forms;
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
*@creationDate 1396-11-05 - 2018-01-25 18:27
*@lastUpdate 1396-11-05 - 2018-01-25 18:27
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageprogramestimation_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("iribfinance_manageprogramestimation");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['programestimation']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->department_fid,$this->getFieldCaption('department_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->class_fid,$this->getFieldCaption('class_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->programmaketype_fid,$this->getFieldCaption('programmaketype_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->totalprogramcount,$this->getFieldCaption('totalprogramcount'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->timeperprogram,$this->getFieldCaption('timeperprogram'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->is_haslegalproblem,$this->getFieldCaption('is_haslegalproblem'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->approval_date,$this->getFieldCaption('approval_date'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->end_date,$this->getFieldCaption('end_date'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->add_date,$this->getFieldCaption('add_date'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->producer_employee_fid,$this->getFieldCaption('producer_employee_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->executor_employee_fid,$this->getFieldCaption('executor_employee_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->paycenter_fid,$this->getFieldCaption('paycenter_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->makergroup_paycenter_fid,$this->getFieldCaption('makergroup_paycenter_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
		foreach ($this->Data['department_fid'] as $item)
			$this->department_fid->addOption($item->getID(), $item->getTitleField());
		foreach ($this->Data['class_fid'] as $item)
			$this->class_fid->addOption($item->getID(), $item->getTitleField());
		foreach ($this->Data['programmaketype_fid'] as $item)
			$this->programmaketype_fid->addOption($item->getID(), $item->getTitleField());
			$this->is_haslegalproblem->addOption(1,'بله');
			$this->is_haslegalproblem->addOption(0,'خیر');
		foreach ($this->Data['producer_employee_fid'] as $item)
			$this->producer_employee_fid->addOption($item->getID(), $item->getTitleField());
		foreach ($this->Data['executor_employee_fid'] as $item)
			$this->executor_employee_fid->addOption($item->getID(), $item->getTitleField());
		foreach ($this->Data['paycenter_fid'] as $item)
			$this->paycenter_fid->addOption($item->getID(), $item->getTitleField());
		foreach ($this->Data['makergroup_paycenter_fid'] as $item)
			$this->makergroup_paycenter_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("programestimation", $this->Data)){

			/******** title ********/
			$this->title->setValue($this->Data['programestimation']->getTitle());
			$this->setFieldCaption('title',$this->Data['programestimation']->getFieldInfo('title')->getTitle());
			$this->title->setFieldInfo($this->Data['programestimation']->getFieldInfo('title'));

			/******** department_fid ********/
			$this->department_fid->setSelectedValue($this->Data['programestimation']->getDepartment_fid());
			$this->setFieldCaption('department_fid',$this->Data['programestimation']->getFieldInfo('department_fid')->getTitle());

			/******** class_fid ********/
			$this->class_fid->setSelectedValue($this->Data['programestimation']->getClass_fid());
			$this->setFieldCaption('class_fid',$this->Data['programestimation']->getFieldInfo('class_fid')->getTitle());

			/******** programmaketype_fid ********/
			$this->programmaketype_fid->setSelectedValue($this->Data['programestimation']->getProgrammaketype_fid());
			$this->setFieldCaption('programmaketype_fid',$this->Data['programestimation']->getFieldInfo('programmaketype_fid')->getTitle());

			/******** totalprogramcount ********/
			$this->totalprogramcount->setValue($this->Data['programestimation']->getTotalprogramcount());
			$this->setFieldCaption('totalprogramcount',$this->Data['programestimation']->getFieldInfo('totalprogramcount')->getTitle());
			$this->totalprogramcount->setFieldInfo($this->Data['programestimation']->getFieldInfo('totalprogramcount'));

			/******** timeperprogram ********/
			$this->timeperprogram->setValue($this->Data['programestimation']->getTimeperprogram());
			$this->setFieldCaption('timeperprogram',$this->Data['programestimation']->getFieldInfo('timeperprogram')->getTitle());
			$this->timeperprogram->setFieldInfo($this->Data['programestimation']->getFieldInfo('timeperprogram'));

			/******** is_haslegalproblem ********/
			$this->is_haslegalproblem->setSelectedValue($this->Data['programestimation']->getIs_haslegalproblem());
			$this->setFieldCaption('is_haslegalproblem',$this->Data['programestimation']->getFieldInfo('is_haslegalproblem')->getTitle());

			/******** approval_date ********/
			$this->approval_date->setTime($this->Data['programestimation']->getApproval_date());
			$this->setFieldCaption('approval_date',$this->Data['programestimation']->getFieldInfo('approval_date')->getTitle());
			$this->approval_date->setFieldInfo($this->Data['programestimation']->getFieldInfo('approval_date'));

			/******** end_date ********/
			$this->end_date->setTime($this->Data['programestimation']->getEnd_date());
			$this->setFieldCaption('end_date',$this->Data['programestimation']->getFieldInfo('end_date')->getTitle());
			$this->end_date->setFieldInfo($this->Data['programestimation']->getFieldInfo('end_date'));

			/******** add_date ********/
			$this->add_date->setTime($this->Data['programestimation']->getAdd_date());
			$this->setFieldCaption('add_date',$this->Data['programestimation']->getFieldInfo('add_date')->getTitle());
			$this->add_date->setFieldInfo($this->Data['programestimation']->getFieldInfo('add_date'));

			/******** producer_employee_fid ********/
			$this->producer_employee_fid->setSelectedValue($this->Data['programestimation']->getProducer_employee_fid());
			$this->setFieldCaption('producer_employee_fid',$this->Data['programestimation']->getFieldInfo('producer_employee_fid')->getTitle());

			/******** executor_employee_fid ********/
			$this->executor_employee_fid->setSelectedValue($this->Data['programestimation']->getExecutor_employee_fid());
			$this->setFieldCaption('executor_employee_fid',$this->Data['programestimation']->getFieldInfo('executor_employee_fid')->getTitle());

			/******** paycenter_fid ********/
			$this->paycenter_fid->setSelectedValue($this->Data['programestimation']->getPaycenter_fid());
			$this->setFieldCaption('paycenter_fid',$this->Data['programestimation']->getFieldInfo('paycenter_fid')->getTitle());

			/******** makergroup_paycenter_fid ********/
			$this->makergroup_paycenter_fid->setSelectedValue($this->Data['programestimation']->getMakergroup_paycenter_fid());
			$this->setFieldCaption('makergroup_paycenter_fid',$this->Data['programestimation']->getFieldInfo('makergroup_paycenter_fid')->getTitle());

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* title *******/
		$this->title= new textbox("title");
		$this->title->setClass("form-control");

		/******* department_fid *******/
		$this->department_fid= new combobox("department_fid");
		$this->department_fid->setClass("form-control");

		/******* class_fid *******/
		$this->class_fid= new combobox("class_fid");
		$this->class_fid->setClass("form-control");

		/******* programmaketype_fid *******/
		$this->programmaketype_fid= new combobox("programmaketype_fid");
		$this->programmaketype_fid->setClass("form-control");

		/******* totalprogramcount *******/
		$this->totalprogramcount= new textbox("totalprogramcount");
		$this->totalprogramcount->setClass("form-control");

		/******* timeperprogram *******/
		$this->timeperprogram= new textbox("timeperprogram");
		$this->timeperprogram->setClass("form-control");

		/******* is_haslegalproblem *******/
		$this->is_haslegalproblem= new combobox("is_haslegalproblem");
		$this->is_haslegalproblem->setClass("form-control");

		/******* approval_date *******/
		$this->approval_date= new DatePicker("approval_date");
		$this->approval_date->setClass("form-control");

		/******* end_date *******/
		$this->end_date= new DatePicker("end_date");
		$this->end_date->setClass("form-control");

		/******* add_date *******/
		$this->add_date= new DatePicker("add_date");
		$this->add_date->setClass("form-control");

		/******* producer_employee_fid *******/
		$this->producer_employee_fid= new combobox("producer_employee_fid");
		$this->producer_employee_fid->setClass("form-control");

		/******* executor_employee_fid *******/
		$this->executor_employee_fid= new combobox("executor_employee_fid");
		$this->executor_employee_fid->setClass("form-control");

		/******* paycenter_fid *******/
		$this->paycenter_fid= new combobox("paycenter_fid");
		$this->paycenter_fid->setClass("form-control");

		/******* makergroup_paycenter_fid *******/
		$this->makergroup_paycenter_fid= new combobox("makergroup_paycenter_fid");
		$this->makergroup_paycenter_fid->setClass("form-control");

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
	private $title;
	/**
	 * @return textbox
	 */
	public function getTitle()
	{
		return $this->title;
	}
	/** @var combobox */
	private $department_fid;
	/**
	 * @return combobox
	 */
	public function getDepartment_fid()
	{
		return $this->department_fid;
	}
	/** @var combobox */
	private $class_fid;
	/**
	 * @return combobox
	 */
	public function getClass_fid()
	{
		return $this->class_fid;
	}
	/** @var combobox */
	private $programmaketype_fid;
	/**
	 * @return combobox
	 */
	public function getProgrammaketype_fid()
	{
		return $this->programmaketype_fid;
	}
	/** @var textbox */
	private $totalprogramcount;
	/**
	 * @return textbox
	 */
	public function getTotalprogramcount()
	{
		return $this->totalprogramcount;
	}
	/** @var textbox */
	private $timeperprogram;
	/**
	 * @return textbox
	 */
	public function getTimeperprogram()
	{
		return $this->timeperprogram;
	}
	/** @var combobox */
	private $is_haslegalproblem;
	/**
	 * @return combobox
	 */
	public function getIs_haslegalproblem()
	{
		return $this->is_haslegalproblem;
	}
	/** @var DatePicker */
	private $approval_date;
	/**
	 * @return DatePicker
	 */
	public function getApproval_date()
	{
		return $this->approval_date;
	}
	/** @var DatePicker */
	private $end_date;
	/**
	 * @return DatePicker
	 */
	public function getEnd_date()
	{
		return $this->end_date;
	}
	/** @var DatePicker */
	private $add_date;
	/**
	 * @return DatePicker
	 */
	public function getAdd_date()
	{
		return $this->add_date;
	}
	/** @var combobox */
	private $producer_employee_fid;
	/**
	 * @return combobox
	 */
	public function getProducer_employee_fid()
	{
		return $this->producer_employee_fid;
	}
	/** @var combobox */
	private $executor_employee_fid;
	/**
	 * @return combobox
	 */
	public function getExecutor_employee_fid()
	{
		return $this->executor_employee_fid;
	}
	/** @var combobox */
	private $paycenter_fid;
	/**
	 * @return combobox
	 */
	public function getPaycenter_fid()
	{
		return $this->paycenter_fid;
	}
	/** @var combobox */
	private $makergroup_paycenter_fid;
	/**
	 * @return combobox
	 */
	public function getMakergroup_paycenter_fid()
	{
		return $this->makergroup_paycenter_fid;
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