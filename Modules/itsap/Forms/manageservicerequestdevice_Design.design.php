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
*@creationDate 1397-01-16 - 2018-04-05 00:53
*@lastUpdate 1397-01-16 - 2018-04-05 00:53
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageservicerequestdevice_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("itsap_manageservicerequestdevice");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['servicerequestdevice']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->code,$this->getFieldCaption('code'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->devicetype_fid,$this->getFieldCaption('devicetype_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
//		$LTable1->addElement($this->getFieldRowCode($this->servicerequest_fid,$this->getFieldCaption('servicerequest_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->description,$this->getFieldCaption('description'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
		foreach ($this->Data['devicetype_fid'] as $item)
			$this->devicetype_fid->addOption($item->getID(), $item->getTitleField());
		foreach ($this->Data['servicerequest_fid'] as $item)
			$this->servicerequest_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("servicerequestdevice", $this->Data)){

			/******** code ********/
			$this->code->setValue($this->Data['servicerequestdevice']->getCode());
			$this->setFieldCaption('code',$this->Data['servicerequestdevice']->getFieldInfo('code')->getTitle());
			$this->code->setFieldInfo($this->Data['servicerequestdevice']->getFieldInfo('code'));

			/******** devicetype_fid ********/
			$this->devicetype_fid->setSelectedValue($this->Data['servicerequestdevice']->getDevicetype_fid());
			$this->setFieldCaption('devicetype_fid',$this->Data['servicerequestdevice']->getFieldInfo('devicetype_fid')->getTitle());

			/******** servicerequest_fid ********/
			$this->servicerequest_fid->setSelectedValue($this->Data['servicerequestdevice']->getServicerequest_fid());
			$this->setFieldCaption('servicerequest_fid',$this->Data['servicerequestdevice']->getFieldInfo('servicerequest_fid')->getTitle());

			/******** description ********/
			$this->description->setValue($this->Data['servicerequestdevice']->getDescription());
			$this->setFieldCaption('description',$this->Data['servicerequestdevice']->getFieldInfo('description')->getTitle());
			$this->description->setFieldInfo($this->Data['servicerequestdevice']->getFieldInfo('description'));

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* code *******/
		$this->code= new textbox("code");
		$this->code->setClass("form-control");

		/******* devicetype_fid *******/
		$this->devicetype_fid= new combobox("devicetype_fid");
		$this->devicetype_fid->setClass("form-control");

		/******* servicerequest_fid *******/
		$this->servicerequest_fid= new combobox("servicerequest_fid");
		$this->servicerequest_fid->setClass("form-control");

		/******* description *******/
		$this->description= new textbox("description");
		$this->description->setClass("form-control");

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
	private $code;
	/**
	 * @return textbox
	 */
	public function getCode()
	{
		return $this->code;
	}
	/** @var combobox */
	private $devicetype_fid;
	/**
	 * @return combobox
	 */
	public function getDevicetype_fid()
	{
		return $this->devicetype_fid;
	}
	/** @var combobox */
	private $servicerequest_fid;
	/**
	 * @return combobox
	 */
	public function getServicerequest_fid()
	{
		return $this->servicerequest_fid;
	}
	/** @var textbox */
	private $description;
	/**
	 * @return textbox
	 */
	public function getDescription()
	{
		return $this->description;
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