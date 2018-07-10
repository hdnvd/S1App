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
*@creationDate 1396-09-17 - 2017-12-08 09:41
*@lastUpdate 1396-09-17 - 2017-12-08 09:41
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageservicerequestservicestatus_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("itsap_manageservicerequestservicestatus");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['servicerequestservicestatus']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->servicestatus_fid,$this->getFieldCaption('servicestatus_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->servicerequest_fid,$this->getFieldCaption('servicerequest_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->start_date,$this->getFieldCaption('start_date'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
		foreach ($this->Data['servicestatus_fid'] as $item)
			$this->servicestatus_fid->addOption($item->getID(), $item->getTitleField());
		foreach ($this->Data['servicerequest_fid'] as $item)
			$this->servicerequest_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("servicerequestservicestatus", $this->Data)){

			/******** servicestatus_fid ********/
			$this->servicestatus_fid->setSelectedValue($this->Data['servicerequestservicestatus']->getServicestatus_fid());
			$this->setFieldCaption('servicestatus_fid',$this->Data['servicerequestservicestatus']->getFieldInfo('servicestatus_fid')->getTitle());

			/******** servicerequest_fid ********/
			$this->servicerequest_fid->setSelectedValue($this->Data['servicerequestservicestatus']->getServicerequest_fid());
			$this->setFieldCaption('servicerequest_fid',$this->Data['servicerequestservicestatus']->getFieldInfo('servicerequest_fid')->getTitle());

			/******** start_date ********/
			$this->start_date->setTime($this->Data['servicerequestservicestatus']->getStart_date());
			$this->setFieldCaption('start_date',$this->Data['servicerequestservicestatus']->getFieldInfo('start_date')->getTitle());
			$this->start_date->setFieldInfo($this->Data['servicerequestservicestatus']->getFieldInfo('start_date'));

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* servicestatus_fid *******/
		$this->servicestatus_fid= new combobox("servicestatus_fid");
		$this->servicestatus_fid->setClass("form-control");

		/******* servicerequest_fid *******/
		$this->servicerequest_fid= new combobox("servicerequest_fid");
		$this->servicerequest_fid->setClass("form-control");

		/******* start_date *******/
		$this->start_date= new DatePicker("start_date");
		$this->start_date->setClass("form-control");

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
	private $servicestatus_fid;
	/**
	 * @return combobox
	 */
	public function getServicestatus_fid()
	{
		return $this->servicestatus_fid;
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
	/** @var DatePicker */
	private $start_date;
	/**
	 * @return DatePicker
	 */
	public function getStart_date()
	{
		return $this->start_date;
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