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
*@creationDate 1397-01-13 - 2018-04-02 02:09
*@lastUpdate 1397-01-13 - 2018-04-02 02:09
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managedevicecomponent_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("itsap_managedevicecomponent");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['devicecomponent']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->devicetype_fid,$this->getFieldCaption('devicetype_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
		if (key_exists("devicecomponent", $this->Data)){

			/******** devicetype_fid ********/
			$this->devicetype_fid->setSelectedValue($this->Data['devicecomponent']->getDevicetype_fid());
			$this->setFieldCaption('devicetype_fid',$this->Data['devicecomponent']->getFieldInfo('devicetype_fid')->getTitle());

			/******** title ********/
			$this->title->setValue($this->Data['devicecomponent']->getTitle());
			$this->setFieldCaption('title',$this->Data['devicecomponent']->getFieldInfo('title')->getTitle());
			$this->title->setFieldInfo($this->Data['devicecomponent']->getFieldInfo('title'));

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* devicetype_fid *******/
		$this->devicetype_fid= new combobox("devicetype_fid");
		$this->devicetype_fid->setClass("form-control");

		/******* title *******/
		$this->title= new textbox("title");
		$this->title->setClass("form-control");

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
	private $devicetype_fid;
	/**
	 * @return combobox
	 */
	public function getDevicetype_fid()
	{
		return $this->devicetype_fid;
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