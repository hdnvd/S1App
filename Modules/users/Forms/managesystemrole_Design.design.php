<?php
namespace Modules\users\Forms;
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
*@creationDate 1396-11-19 - 2018-02-08 15:47
*@lastUpdate 1396-11-19 - 2018-02-08 15:47
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managesystemrole_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("users_managesystemrole");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['systemrole']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->defaultmodule,$this->getFieldCaption('defaultmodule'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->defaultpage,$this->getFieldCaption('defaultpage'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->indexparameters,$this->getFieldCaption('indexparameters'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getSingleFieldRowCode($this->btnSave));
		$LTable1->addElement($this->getFieldRowCode($this->Systemtasks,$this->getFieldCaption('Systemtasks'),null,'',null));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		$form->SetAttribute("novalidate","novalidate");
		$form->SetAttribute("data-toggle","validator");
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
	public function FillItems()
	{
		if (key_exists("systemrole", $this->Data)){

			/******** title ********/
			$this->title->setValue($this->Data['systemrole']->getTitle());
			$this->setFieldCaption('title',$this->Data['systemrole']->getFieldInfo('title')->getTitle());
			$this->title->setFieldInfo($this->Data['systemrole']->getFieldInfo('title'));

			/******** defaultmodule ********/
			$this->defaultmodule->setValue($this->Data['systemrole']->getDefaultmodule());
			$this->setFieldCaption('defaultmodule',$this->Data['systemrole']->getFieldInfo('defaultmodule')->getTitle());
			$this->defaultmodule->setFieldInfo($this->Data['systemrole']->getFieldInfo('defaultmodule'));

			/******** defaultpage ********/
			$this->defaultpage->setValue($this->Data['systemrole']->getDefaultpage());
			$this->setFieldCaption('defaultpage',$this->Data['systemrole']->getFieldInfo('defaultpage')->getTitle());
			$this->defaultpage->setFieldInfo($this->Data['systemrole']->getFieldInfo('defaultpage'));

			/******** indexparameters ********/
			$this->indexparameters->setValue($this->Data['systemrole']->getIndexparameters());
			$this->setFieldCaption('indexparameters',$this->Data['systemrole']->getFieldInfo('indexparameters')->getTitle());
			$this->indexparameters->setFieldInfo($this->Data['systemrole']->getFieldInfo('indexparameters'));

			/******** btnSave ********/
		}
		if (key_exists("systemtasks", $this->Data)) {
		$AllSystemtaskCount = count($this->Data['systemtasks']);
		for ($i = 0; $i < $AllSystemtaskCount; $i++) {

			$this->Systemtasks->addOption($this->Data['systemtasks'][$i]->getModule() . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $this->Data['systemtasks'][$i]->getPage(), $this->Data['systemtasks'][$i]->getId());
		}
	}
		if (key_exists("systemrolesystemtasks", $this->Data)) {
		$AllSystemtaskCount = count($this->Data['systemrolesystemtasks']);
		for ($i = 0; $i < $AllSystemtaskCount; $i++) {
			$this->Systemtasks->addSelectedValue($this->Data['systemrolesystemtasks'][$i]->getSystemtask_fid());
		}
	}
	}
	public function __construct()
	{
		parent::__construct();

		/******* title *******/
		$this->title= new textbox("title");
		$this->title->setClass("form-control");

		/******* defaultmodule *******/
		$this->defaultmodule= new textbox("defaultmodule");
		$this->defaultmodule->setClass("form-control");

		/******* defaultpage *******/
		$this->defaultpage= new textbox("defaultpage");
		$this->defaultpage->setClass("form-control");

		/******* indexparameters *******/
		$this->indexparameters= new textbox("indexparameters");
		$this->indexparameters->setClass("form-control");

		/******* btnSave *******/
		$this->btnSave= new SweetButton(true,"ذخیره");
		$this->btnSave->setAction("btnSave");
		$this->btnSave->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
		$this->btnSave->setClass("btn btn-primary");

		/******* Systemtask *******/
		$this->Systemtasks= new  CheckBox('systemtask[]');
		$this->Systemtasks->setClass('users_systemtasks');
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
	/** @var textbox */
	private $defaultmodule;
	/**
	 * @return textbox
	 */
	public function getDefaultmodule()
	{
		return $this->defaultmodule;
	}
	/** @var textbox */
	private $defaultpage;
	/**
	 * @return textbox
	 */
	public function getDefaultpage()
	{
		return $this->defaultpage;
	}
	/** @var textbox */
	private $indexparameters;
	/**
	 * @return textbox
	 */
	public function getIndexparameters()
	{
		return $this->indexparameters;
	}
	/** @var SweetButton */
	private $btnSave;
	/** @var CheckBox */
	private $Systemtasks;
	/**
	 * @return CheckBox
	 */
	public function getSystemtasks()
	{
		return $this->Systemtasks;
	}
    public function getJSON()
    {
       parent::getJSON();
       $Result=['message'=>$this->getMessage(),'messagetype'=>$this->getMessageType()];
       return json_encode($Result);
    }
}
?>