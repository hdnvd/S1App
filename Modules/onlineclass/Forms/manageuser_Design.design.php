<?php
namespace Modules\onlineclass\Forms;
use core\CoreClasses\html\PasswordBox;
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
*@creationDate 1396-07-25 - 2017-10-17 22:27
*@lastUpdate 1396-07-25 - 2017-10-17 22:27
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class manageuser_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("onlineclass_manageuser");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['user']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->fullname,$this->getFieldCaption('fullname'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->ismale,$this->getFieldCaption('ismale'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->email,$this->getFieldCaption('email'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->mobile,$this->getFieldCaption('mobile'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->registration_time,$this->getFieldCaption('registration_time'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->devicecode,$this->getFieldCaption('devicecode'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
        $LTable1->addElement($this->getFieldRowCode($this->UserName,$this->getFieldCaption('username'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
        $LTable1->addElement($this->getFieldRowCode($this->Password,$this->getFieldCaption('password'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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

			/******** fullname ********/
		if (key_exists("user", $this->Data)){
			$this->fullname->setValue($this->Data['user']->getFullname());
			$this->setFieldCaption('fullname',$this->Data['user']->getFieldInfo('fullname')->getTitle());
			$this->fullname->setFieldInfo($this->Data['user']->getFieldInfo('fullname'));
		}

			/******** ismale ********/
			$this->ismale->addOption(1,'مرد');
			$this->ismale->addOption(0,'زن');
		if (key_exists("user", $this->Data)){
			$this->ismale->setSelectedValue($this->Data['user']->getIsmale());
			$this->setFieldCaption('ismale',$this->Data['user']->getFieldInfo('ismale')->getTitle());
		}

			/******** email ********/
		if (key_exists("user", $this->Data)){
			$this->email->setValue($this->Data['user']->getEmail());
			$this->setFieldCaption('email',$this->Data['user']->getFieldInfo('email')->getTitle());
			$this->email->setFieldInfo($this->Data['user']->getFieldInfo('email'));
		}

			/******** mobile ********/
		if (key_exists("user", $this->Data)){
			$this->mobile->setValue($this->Data['user']->getMobile());
			$this->setFieldCaption('mobile',$this->Data['user']->getFieldInfo('mobile')->getTitle());
			$this->mobile->setFieldInfo($this->Data['user']->getFieldInfo('mobile'));
		}

			/******** registration_time ********/
		if (key_exists("user", $this->Data)){
			$this->registration_time->setTime($this->Data['user']->getRegistration_time());
			$this->setFieldCaption('registration_time',$this->Data['user']->getFieldInfo('registration_time')->getTitle());
			$this->registration_time->setFieldInfo($this->Data['user']->getFieldInfo('registration_time'));
		}

			/******** devicecode ********/
		if (key_exists("user", $this->Data)){
			$this->devicecode->setValue($this->Data['user']->getDevicecode());
			$this->setFieldCaption('devicecode',$this->Data['user']->getFieldInfo('devicecode')->getTitle());
			$this->devicecode->setFieldInfo($this->Data['user']->getFieldInfo('devicecode'));
		}

			/******** btnSave ********/
	}
	public function __construct()
	{
		parent::__construct();

		/******* fullname *******/
		$this->fullname= new textbox("fullname");
		$this->fullname->setClass("form-control");

		/******* ismale *******/
		$this->ismale= new combobox("ismale");
		$this->ismale->setClass("form-control");

		/******* email *******/
		$this->email= new textbox("email");
		$this->email->setClass("form-control");

		/******* mobile *******/
		$this->mobile= new textbox("mobile");
		$this->mobile->setClass("form-control");

		/******* registration_time *******/
		$this->registration_time= new DatePicker("registration_time");
		$this->registration_time->setClass("form-control");

		/******* devicecode *******/
		$this->devicecode= new textbox("devicecode");
		$this->devicecode->setClass("form-control");

        /******* devicecode *******/
        $this->UserName= new textbox("username");
        $this->UserName->setClass("form-control");
        /******* devicecode *******/
        $this->Password= new PasswordBox("password");
        $this->Password->setClass("form-control");
		/******* btnSave *******/
		$this->btnSave= new SweetButton(true,"ذخیره");
		$this->btnSave->setAction("btnSave");
		$this->btnSave->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
		$this->btnSave->setClass("btn btn-primary");
	}

    public function getJSON()
    {
        parent::getJSON();
        $Result=['message'=>$this->getMessage(),'messagetype'=>$this->getMessageType()];
        return json_encode($Result);
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
	private $fullname;
	/**
	 * @return textbox
	 */
	public function getFullname()
	{
		return $this->fullname;
	}
	/** @var combobox */
	private $ismale;
	/**
	 * @return combobox
	 */
	public function getIsmale()
	{
		return $this->ismale;
	}
	/** @var textbox */
	private $email;
	/**
	 * @return textbox
	 */
	public function getEmail()
	{
		return $this->email;
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
	/** @var DatePicker */
	private $registration_time;
	/**
	 * @return DatePicker
	 */
	public function getRegistration_time()
	{
		return $this->registration_time;
	}
	/** @var textbox */
	private $devicecode;
	/**
	 * @return textbox
	 */
	public function getDevicecode()
	{
		return $this->devicecode;
	}


    /** @var textbox */
    private $UserName;
    /**
     * @return textbox
     */
    public function getUserName()
    {
        return $this->UserName;
    }

    /** @var PasswordBox */
    private $Password;
    /**
     * @return PasswordBox
     */
    public function getPassword()
    {
        return $this->Password;
    }

	/** @var SweetButton */
	private $btnSave;
}
?>