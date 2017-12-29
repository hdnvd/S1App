<?php
namespace Modules\itsap\Forms;
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
*@creationDate 1396-09-17 - 2017-12-08 11:51
*@lastUpdate 1396-09-17 - 2017-12-08 11:51
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageemployee_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("itsap_manageemployee");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['employee']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->unit_fid,$this->getFieldCaption('unit_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->emp_code,$this->getFieldCaption('emp_code'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->mellicode,$this->getFieldCaption('mellicode'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->name,$this->getFieldCaption('name'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->family,$this->getFieldCaption('family'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->mobile,$this->getFieldCaption('mobile'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->degree_fid,$this->getFieldCaption('degree_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getSingleFieldRowCode($this->btnSave));
        $LTable1->addElement($this->getSingleFieldRowCode($this->btnResetPassword));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		$form->SetAttribute("novalidate","novalidate");
		$form->SetAttribute("data-toggle","validator");
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
	public function FillItems()
	{
		foreach ($this->Data['unit_fid'] as $item)
			$this->unit_fid->addOption($item->getID(), $item->getTitleField());
		foreach ($this->Data['degree_fid'] as $item)
			$this->degree_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("employee", $this->Data)){

			/******** unit_fid ********/
			$this->unit_fid->setSelectedValue($this->Data['employee']->getUnit_fid());
			$this->setFieldCaption('unit_fid',$this->Data['employee']->getFieldInfo('unit_fid')->getTitle());

			/******** emp_code ********/
			$this->emp_code->setValue($this->Data['employee']->getEmp_code());
			$this->setFieldCaption('emp_code',$this->Data['employee']->getFieldInfo('emp_code')->getTitle());
			$this->emp_code->setFieldInfo($this->Data['employee']->getFieldInfo('emp_code'));

			/******** mellicode ********/
			$this->mellicode->setValue($this->Data['employee']->getMellicode());
			$this->setFieldCaption('mellicode',$this->Data['employee']->getFieldInfo('mellicode')->getTitle());
			$this->mellicode->setFieldInfo($this->Data['employee']->getFieldInfo('mellicode'));

			/******** name ********/
			$this->name->setValue($this->Data['employee']->getName());
			$this->setFieldCaption('name',$this->Data['employee']->getFieldInfo('name')->getTitle());
			$this->name->setFieldInfo($this->Data['employee']->getFieldInfo('name'));

			/******** family ********/
			$this->family->setValue($this->Data['employee']->getFamily());
			$this->setFieldCaption('family',$this->Data['employee']->getFieldInfo('family')->getTitle());
			$this->family->setFieldInfo($this->Data['employee']->getFieldInfo('family'));

			/******** mobile ********/
			$this->mobile->setValue($this->Data['employee']->getMobile());
			$this->setFieldCaption('mobile',$this->Data['employee']->getFieldInfo('mobile')->getTitle());
			$this->mobile->setFieldInfo($this->Data['employee']->getFieldInfo('mobile'));

			/******** degree_fid ********/
			$this->degree_fid->setSelectedValue($this->Data['employee']->getDegree_fid());
			$this->setFieldCaption('degree_fid',$this->Data['employee']->getFieldInfo('degree_fid')->getTitle());

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* unit_fid *******/
		$this->unit_fid= new combobox("unit_fid");
		$this->unit_fid->setClass("form-control");

		/******* emp_code *******/
		$this->emp_code= new textbox("emp_code");
		$this->emp_code->setClass("form-control");

		/******* mellicode *******/
		$this->mellicode= new textbox("mellicode");
		$this->mellicode->setClass("form-control");

		/******* name *******/
		$this->name= new textbox("name");
		$this->name->setClass("form-control");

		/******* family *******/
		$this->family= new textbox("family");
		$this->family->setClass("form-control");

		/******* mobile *******/
		$this->mobile= new textbox("mobile");
		$this->mobile->setClass("form-control");

		/******* degree_fid *******/
		$this->degree_fid= new combobox("degree_fid");
		$this->degree_fid->setClass("form-control");

		/******* btnSave *******/
		$this->btnSave= new SweetButton(true,"ذخیره");
		$this->btnSave->setAction("btnSave");
		$this->btnSave->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
		$this->btnSave->setClass("btn btn-primary");

        /******* btnResetPassword *******/
        $this->btnResetPassword= new SweetButton(true,"بازنشانی کلمه عبور");
        $this->btnResetPassword->setAction("btnResetPassword");
        $this->btnResetPassword->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
        $this->btnResetPassword->setClass("btn btn-primary");
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
	private $unit_fid;
	/**
	 * @return combobox
	 */
	public function getUnit_fid()
	{
		return $this->unit_fid;
	}
	/** @var textbox */
	private $emp_code;
	/**
	 * @return textbox
	 */
	public function getEmp_code()
	{
		return $this->emp_code;
	}
	/** @var textbox */
	private $mellicode;
	/**
	 * @return textbox
	 */
	public function getMellicode()
	{
		return $this->mellicode;
	}
	/** @var textbox */
	private $name;
	/**
	 * @return textbox
	 */
	public function getName()
	{
		return $this->name;
	}
	/** @var textbox */
	private $family;
	/**
	 * @return textbox
	 */
	public function getFamily()
	{
		return $this->family;
	}
	/** @var textbox */
	private $mobile;
	/**
	 * @return textbox
	 */
	public function getMobile()
	{
		return $this->mobile;
	}
	/** @var combobox */
	private $degree_fid;
	/**
	 * @return combobox
	 */
	public function getDegree_fid()
	{
		return $this->degree_fid;
	}
	/** @var SweetButton */
	private $btnSave;
    /** @var SweetButton */
    private $btnResetPassword;
    public function getJSON()
    {
       parent::getJSON();
       $Result=['message'=>$this->getMessage(),'messagetype'=>$this->getMessageType()];
       return json_encode($Result);
    }
}
?>