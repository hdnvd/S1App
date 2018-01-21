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
*@creationDate 1396-09-29 - 2017-12-20 15:49
*@lastUpdate 1396-09-29 - 2017-12-20 15:49
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageservicerequest_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("itsap_manageservicerequest");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['servicerequest']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
        $LTable1->addElement($this->getInfoRowCode(new Lable($this->Data['topunit']->getTitle()),"یگان مادر"));
        $LTable1->addElement($this->getInfoRowCode(new Lable($this->Data['itunitadmin']->getName() . " " . $this->Data['itunitadmin']->getFamily()),"مدیر یگان فاوا"));
        $LTable1->addElement($this->getInfoRowCode(new Lable($this->Data['unit']->getTitle()),"یگان درخواست کننده"));
        $LTable1->addElement($this->getInfoRowCode(new Lable($this->Data['employee']->getName() . " " . $this->Data['employee']->getFamily()),"درخواست کننده"));

        $LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->servicetype_fid,$this->getFieldCaption('servicetype_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->description,$this->getFieldCaption('description'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
//		$LTable1->addElement($this->getFieldRowCode($this->priority,$this->getFieldCaption('priority'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->file1_flu,$this->getFieldCaption('file1_flu'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
//		$LTable1->addElement($this->getFieldRowCode($this->request_date,$this->getFieldCaption('request_date'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
		foreach ($this->Data['servicetype_fid'] as $item)
			$this->servicetype_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("servicerequest", $this->Data)){

			/******** title ********/
			$this->title->setValue($this->Data['servicerequest']->getTitle());
			$this->setFieldCaption('title',$this->Data['servicerequest']->getFieldInfo('title')->getTitle());
			$this->title->setFieldInfo($this->Data['servicerequest']->getFieldInfo('title'));

			/******** servicetype_fid ********/
			$this->servicetype_fid->setSelectedValue($this->Data['servicerequest']->getServicetype_fid());
			$this->setFieldCaption('servicetype_fid',$this->Data['servicerequest']->getFieldInfo('servicetype_fid')->getTitle());

			/******** description ********/
			$this->description->setValue($this->Data['servicerequest']->getDescription());
			$this->setFieldCaption('description',$this->Data['servicerequest']->getFieldInfo('description')->getTitle());
			$this->description->setFieldInfo($this->Data['servicerequest']->getFieldInfo('description'));

			/******** priority ********/
			$this->priority->setValue($this->Data['servicerequest']->getPriority());
			$this->setFieldCaption('priority',$this->Data['servicerequest']->getFieldInfo('priority')->getTitle());
			$this->priority->setFieldInfo($this->Data['servicerequest']->getFieldInfo('priority'));

			/******** file1_flu ********/
			$this->setFieldCaption('file1_flu',$this->Data['servicerequest']->getFieldInfo('file1_flu')->getTitle());

			/******** request_date ********/
			$this->request_date->setTime($this->Data['servicerequest']->getRequest_date());
			$this->setFieldCaption('request_date',$this->Data['servicerequest']->getFieldInfo('request_date')->getTitle());
			$this->request_date->setFieldInfo($this->Data['servicerequest']->getFieldInfo('request_date'));

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* title *******/
		$this->title= new textbox("title");
		$this->title->setClass("form-control");

		/******* servicetype_fid *******/
		$this->servicetype_fid= new combobox("servicetype_fid");
		$this->servicetype_fid->setClass("form-control");

		/******* description *******/
		$this->description= new textbox("description");
		$this->description->setClass("form-control");

		/******* priority *******/
		$this->priority= new textbox("priority");
		$this->priority->setClass("form-control");

		/******* file1_flu *******/
		$this->file1_flu= new FileUploadBox("file1_flu");
		$this->file1_flu->setClass("form-control-file");

		/******* request_date *******/
		$this->request_date= new DatePicker("request_date");
		$this->request_date->setClass("form-control");

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
	private $servicetype_fid;
	/**
	 * @return combobox
	 */
	public function getServicetype_fid()
	{
		return $this->servicetype_fid;
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
	/** @var textbox */
	private $priority;
	/**
	 * @return textbox
	 */
	public function getPriority()
	{
		return $this->priority;
	}
	/** @var FileUploadBox */
	private $file1_flu;
	/**
	 * @return FileUploadBox
	 */
	public function getFile1_flu()
	{
		return $this->file1_flu;
	}
	/** @var DatePicker */
	private $request_date;
	/**
	 * @return DatePicker
	 */
	public function getRequest_date()
	{
		return $this->request_date;
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