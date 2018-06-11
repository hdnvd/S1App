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
*@creationDate 1397-01-06 - 2018-03-26 16:43
*@lastUpdate 1397-01-06 - 2018-03-26 16:43
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managedoctorfile_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("ocms_managedoctorfile");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['doctorfile']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->file_flu,$this->getFieldCaption('file_flu'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->description,$this->getFieldCaption('description'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
//		$LTable1->addElement($this->getFieldRowCode($this->doctor_fid,$this->getFieldCaption('doctor_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
		if (key_exists("doctorfile", $this->Data)){

			/******** file_flu ********/
			$this->setFieldCaption('file_flu',$this->Data['doctorfile']->getFieldInfo('file_flu')->getTitle());

			/******** description ********/
			$this->description->setValue($this->Data['doctorfile']->getDescription());
			$this->setFieldCaption('description',$this->Data['doctorfile']->getFieldInfo('description')->getTitle());
			$this->description->setFieldInfo($this->Data['doctorfile']->getFieldInfo('description'));

			/******** doctor_fid ********/
			$this->doctor_fid->setSelectedValue($this->Data['doctorfile']->getDoctor_fid());
			$this->setFieldCaption('doctor_fid',$this->Data['doctorfile']->getFieldInfo('doctor_fid')->getTitle());

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* file_flu *******/
		$this->file_flu= new FileUploadBox("file_flu");
		$this->file_flu->setClass("form-control-file");

		/******* description *******/
		$this->description= new textbox("description");
		$this->description->setClass("form-control");

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
	/** @var FileUploadBox */
	private $file_flu;
	/**
	 * @return FileUploadBox
	 */
	public function getFile_flu()
	{
		return $this->file_flu;
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