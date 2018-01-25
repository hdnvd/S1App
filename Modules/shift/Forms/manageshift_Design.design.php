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
*@creationDate 1396-11-05 - 2018-01-25 00:33
*@lastUpdate 1396-11-05 - 2018-01-25 00:33
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageshift_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("shift_manageshift");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['shift']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->shifttype_fid,$this->getFieldCaption('shifttype_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->due_date,$this->getFieldCaption('due_date'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->register_date,$this->getFieldCaption('register_date'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->personel_fid,$this->getFieldCaption('personel_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->bakhsh_fid,$this->getFieldCaption('bakhsh_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->role_fid,$this->getFieldCaption('role_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->inputfile_fid,$this->getFieldCaption('inputfile_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
		foreach ($this->Data['shifttype_fid'] as $item)
			$this->shifttype_fid->addOption($item->getID(), $item->getTitleField());
		foreach ($this->Data['personel_fid'] as $item)
			$this->personel_fid->addOption($item->getID(), $item->getTitleField());
		foreach ($this->Data['bakhsh_fid'] as $item)
			$this->bakhsh_fid->addOption($item->getID(), $item->getTitleField());
		foreach ($this->Data['role_fid'] as $item)
			$this->role_fid->addOption($item->getID(), $item->getTitleField());
		foreach ($this->Data['inputfile_fid'] as $item)
			$this->inputfile_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("shift", $this->Data)){

			/******** shifttype_fid ********/
			$this->shifttype_fid->setSelectedValue($this->Data['shift']->getShifttype_fid());
			$this->setFieldCaption('shifttype_fid',$this->Data['shift']->getFieldInfo('shifttype_fid')->getTitle());

			/******** due_date ********/
			$this->due_date->setTime($this->Data['shift']->getDue_date());
			$this->setFieldCaption('due_date',$this->Data['shift']->getFieldInfo('due_date')->getTitle());
			$this->due_date->setFieldInfo($this->Data['shift']->getFieldInfo('due_date'));

			/******** register_date ********/
			$this->register_date->setTime($this->Data['shift']->getRegister_date());
			$this->setFieldCaption('register_date',$this->Data['shift']->getFieldInfo('register_date')->getTitle());
			$this->register_date->setFieldInfo($this->Data['shift']->getFieldInfo('register_date'));

			/******** personel_fid ********/
			$this->personel_fid->setSelectedValue($this->Data['shift']->getPersonel_fid());
			$this->setFieldCaption('personel_fid',$this->Data['shift']->getFieldInfo('personel_fid')->getTitle());

			/******** bakhsh_fid ********/
			$this->bakhsh_fid->setSelectedValue($this->Data['shift']->getBakhsh_fid());
			$this->setFieldCaption('bakhsh_fid',$this->Data['shift']->getFieldInfo('bakhsh_fid')->getTitle());

			/******** role_fid ********/
			$this->role_fid->setSelectedValue($this->Data['shift']->getRole_fid());
			$this->setFieldCaption('role_fid',$this->Data['shift']->getFieldInfo('role_fid')->getTitle());

			/******** inputfile_fid ********/
			$this->inputfile_fid->setSelectedValue($this->Data['shift']->getInputfile_fid());
			$this->setFieldCaption('inputfile_fid',$this->Data['shift']->getFieldInfo('inputfile_fid')->getTitle());

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* shifttype_fid *******/
		$this->shifttype_fid= new combobox("shifttype_fid");
		$this->shifttype_fid->setClass("form-control");

		/******* due_date *******/
		$this->due_date= new DatePicker("due_date");
		$this->due_date->setClass("form-control");

		/******* register_date *******/
		$this->register_date= new DatePicker("register_date");
		$this->register_date->setClass("form-control");

		/******* personel_fid *******/
		$this->personel_fid= new combobox("personel_fid");
		$this->personel_fid->setClass("form-control");

		/******* bakhsh_fid *******/
		$this->bakhsh_fid= new combobox("bakhsh_fid");
		$this->bakhsh_fid->setClass("form-control");

		/******* role_fid *******/
		$this->role_fid= new combobox("role_fid");
		$this->role_fid->setClass("form-control");

		/******* inputfile_fid *******/
		$this->inputfile_fid= new combobox("inputfile_fid");
		$this->inputfile_fid->setClass("form-control");

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
	/** @var combobox */
	private $shifttype_fid;
	/**
	 * @return combobox
	 */
	public function getShifttype_fid()
	{
		return $this->shifttype_fid;
	}
	/** @var DatePicker */
	private $due_date;
	/**
	 * @return DatePicker
	 */
	public function getDue_date()
	{
		return $this->due_date;
	}
	/** @var DatePicker */
	private $register_date;
	/**
	 * @return DatePicker
	 */
	public function getRegister_date()
	{
		return $this->register_date;
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
	/** @var combobox */
	private $bakhsh_fid;
	/**
	 * @return combobox
	 */
	public function getBakhsh_fid()
	{
		return $this->bakhsh_fid;
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
	private $inputfile_fid;
	/**
	 * @return combobox
	 */
	public function getInputfile_fid()
	{
		return $this->inputfile_fid;
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