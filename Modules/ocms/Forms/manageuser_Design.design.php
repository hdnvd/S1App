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
class manageuser_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("ocms_manageuser");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['user']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->name,$this->getFieldCaption('name'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->family,$this->getFieldCaption('family'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->born_date,$this->getFieldCaption('born_date'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->mobile,$this->getFieldCaption('mobile'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->device_id,$this->getFieldCaption('device_id'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->email,$this->getFieldCaption('email'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->ismale,$this->getFieldCaption('ismale'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
			$this->ismale->addOption(1,'مرد');
			$this->ismale->addOption(0,'زن');
		if (key_exists("user", $this->Data)){

			/******** name ********/
			$this->name->setValue($this->Data['user']->getName());
			$this->setFieldCaption('name',$this->Data['user']->getFieldInfo('name')->getTitle());
			$this->name->setFieldInfo($this->Data['user']->getFieldInfo('name'));

			/******** family ********/
			$this->family->setValue($this->Data['user']->getFamily());
			$this->setFieldCaption('family',$this->Data['user']->getFieldInfo('family')->getTitle());
			$this->family->setFieldInfo($this->Data['user']->getFieldInfo('family'));

			/******** born_date ********/
			$this->born_date->setTime($this->Data['user']->getBorn_date());
			$this->setFieldCaption('born_date',$this->Data['user']->getFieldInfo('born_date')->getTitle());
			$this->born_date->setFieldInfo($this->Data['user']->getFieldInfo('born_date'));

			/******** mobile ********/
			$this->mobile->setValue($this->Data['user']->getMobile());
			$this->setFieldCaption('mobile',$this->Data['user']->getFieldInfo('mobile')->getTitle());
			$this->mobile->setFieldInfo($this->Data['user']->getFieldInfo('mobile'));

			/******** device_id ********/
			$this->device_id->setValue($this->Data['user']->getDevice_id());
			$this->setFieldCaption('device_id',$this->Data['user']->getFieldInfo('device_id')->getTitle());
			$this->device_id->setFieldInfo($this->Data['user']->getFieldInfo('device_id'));

			/******** email ********/
			$this->email->setValue($this->Data['user']->getEmail());
			$this->setFieldCaption('email',$this->Data['user']->getFieldInfo('email')->getTitle());
			$this->email->setFieldInfo($this->Data['user']->getFieldInfo('email'));

			/******** ismale ********/
			$this->ismale->setSelectedValue($this->Data['user']->getIsmale());
			$this->setFieldCaption('ismale',$this->Data['user']->getFieldInfo('ismale')->getTitle());

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* name *******/
		$this->name= new textbox("name");
		$this->name->setClass("form-control");

		/******* family *******/
		$this->family= new textbox("family");
		$this->family->setClass("form-control");

		/******* born_date *******/
		$this->born_date= new DatePicker("born_date");
		$this->born_date->setClass("form-control");

		/******* mobile *******/
		$this->mobile= new textbox("mobile");
		$this->mobile->setClass("form-control");

		/******* device_id *******/
		$this->device_id= new textbox("device_id");
		$this->device_id->setClass("form-control");

		/******* email *******/
		$this->email= new textbox("email");
		$this->email->setClass("form-control");

		/******* ismale *******/
		$this->ismale= new combobox("ismale");
		$this->ismale->setClass("form-control");

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
	/** @var DatePicker */
	private $born_date;
	/**
	 * @return DatePicker
	 */
	public function getBorn_date()
	{
		return $this->born_date;
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
	/** @var textbox */
	private $device_id;
	/**
	 * @return textbox
	 */
	public function getDevice_id()
	{
		return $this->device_id;
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
	/** @var combobox */
	private $ismale;
	/**
	 * @return combobox
	 */
	public function getIsmale()
	{
		return $this->ismale;
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