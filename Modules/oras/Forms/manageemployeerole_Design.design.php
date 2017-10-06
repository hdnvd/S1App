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
*@creationDate 1396-07-12 - 2017-10-04 03:02
*@lastUpdate 1396-07-12 - 2017-10-04 03:02
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class manageemployeerole_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("oras_manageemployeerole");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['employeerole']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->employee_fid,$this->getFieldCaption('employee_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->role_fid,$this->getFieldCaption('role_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->recruitmenttype_fid,$this->getFieldCaption('recruitmenttype_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->place_fid,$this->getFieldCaption('place_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->start_time,$this->getFieldCaption('start_time'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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

			/******** employee_fid ********/
			$this->employee_fid->setValue($this->Data['employee_fid']->getName() . " " . $this->Data['employee_fid']->getFamily(). "-(" . $this->Data['employee_fid']->getMellicode() . ")");


			/******** role_fid ********/
		foreach ($this->Data['role_fid'] as $item)
			$this->role_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("employeerole", $this->Data)){
			$this->role_fid->setSelectedValue($this->Data['employeerole']->getRole_fid());
			$this->setFieldCaption('role_fid',$this->Data['employeerole']->getFieldInfo('role_fid')->getTitle());
		}

			/******** recruitmenttype_fid ********/
		foreach ($this->Data['recruitmenttype_fid'] as $item)
			$this->recruitmenttype_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("employeerole", $this->Data)){
			$this->recruitmenttype_fid->setSelectedValue($this->Data['employeerole']->getRecruitmenttype_fid());
			$this->setFieldCaption('recruitmenttype_fid',$this->Data['employeerole']->getFieldInfo('recruitmenttype_fid')->getTitle());
		}

			/******** place_fid ********/
		foreach ($this->Data['place_fid'] as $item)
			$this->place_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("employeerole", $this->Data)){
			$this->place_fid->setSelectedValue($this->Data['employeerole']->getPlace_fid());
			$this->setFieldCaption('place_fid',$this->Data['employeerole']->getFieldInfo('place_fid')->getTitle());
		}

			/******** start_time ********/
		if (key_exists("employeerole", $this->Data)){
			$this->start_time->setTime($this->Data['employeerole']->getStart_time());
			$this->setFieldCaption('start_time',$this->Data['employeerole']->getFieldInfo('start_time')->getTitle());
			$this->start_time->setFieldInfo($this->Data['employeerole']->getFieldInfo('start_time'));
		}

			/******** btnSave ********/
	}
	public function __construct()
	{
		parent::__construct();

		/******* employee_fid *******/
		$this->employee_fid= new TextBox("employee_fid");
        $this->employee_fid->setReadonly(true);
		$this->employee_fid->setClass("form-control");

		/******* role_fid *******/
		$this->role_fid= new combobox("role_fid");
		$this->role_fid->setClass("form-control");

		/******* recruitmenttype_fid *******/
		$this->recruitmenttype_fid= new combobox("recruitmenttype_fid");
		$this->recruitmenttype_fid->setClass("form-control");

		/******* place_fid *******/
		$this->place_fid= new combobox("place_fid");
		$this->place_fid->setClass("form-control");

		/******* start_time *******/
		$this->start_time= new DatePicker("start_time");
		$this->start_time->setClass("form-control");

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
	/** @var TextBox */
	private $employee_fid;
	/**
	 * @return TextBox
	 */
	public function getEmployee_fid()
	{
		return $this->employee_fid;
	}
	/** @var combobox */
	private $role_fid;
	/**
	 * @return combobox
	 */
	public function getRole_fid()
	{
		return $this->role_fid;
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
	/** @var combobox */
	private $place_fid;
	/**
	 * @return combobox
	 */
	public function getPlace_fid()
	{
		return $this->place_fid;
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
	/** @var SweetButton */
	private $btnSave;
}
?>