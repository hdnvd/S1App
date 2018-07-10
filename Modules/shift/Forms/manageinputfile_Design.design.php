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
*@creationDate 1396-10-27 - 2018-01-17 00:24
*@lastUpdate 1396-10-27 - 2018-01-17 00:24
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageinputfile_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("shift_manageinputfile");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['inputfile']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->upload_time,$this->getFieldCaption('upload_time'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->systemuser,$this->getFieldCaption('systemuser'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->file_flu,$this->getFieldCaption('file_flu'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
		if (key_exists("inputfile", $this->Data)){

			/******** upload_time ********/
			$this->upload_time->setTime($this->Data['inputfile']->getUpload_time());
			$this->setFieldCaption('upload_time',$this->Data['inputfile']->getFieldInfo('upload_time')->getTitle());
			$this->upload_time->setFieldInfo($this->Data['inputfile']->getFieldInfo('upload_time'));

			/******** systemuser ********/
			$this->systemuser->setValue($this->Data['inputfile']->getSystemuser());
			$this->setFieldCaption('systemuser',$this->Data['inputfile']->getFieldInfo('systemuser')->getTitle());
			$this->systemuser->setFieldInfo($this->Data['inputfile']->getFieldInfo('systemuser'));

			/******** file_flu ********/
			$this->setFieldCaption('file_flu',$this->Data['inputfile']->getFieldInfo('file_flu')->getTitle());

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* upload_time *******/
		$this->upload_time= new DatePicker("upload_time");
		$this->upload_time->setClass("form-control");

		/******* systemuser *******/
		$this->systemuser= new textbox("systemuser");
		$this->systemuser->setClass("form-control");

		/******* file_flu *******/
		$this->file_flu= new FileUploadBox("file_flu");
		$this->file_flu->setClass("form-control-file");

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
	/** @var DatePicker */
	private $upload_time;
	/**
	 * @return DatePicker
	 */
	public function getUpload_time()
	{
		return $this->upload_time;
	}
	/** @var textbox */
	private $systemuser;
	/**
	 * @return textbox
	 */
	public function getSystemuser()
	{
		return $this->systemuser;
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