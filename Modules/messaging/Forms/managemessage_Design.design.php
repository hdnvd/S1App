<?php
namespace Modules\messaging\Forms;
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
*@creationDate 1396-09-08 - 2017-11-29 15:51
*@lastUpdate 1396-09-08 - 2017-11-29 15:51
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managemessage_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("messaging_managemessage");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['message']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->sender_role_systemuser_fid,$this->getFieldCaption('sender_role_systemuser_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->receiver_role_systemuser_fid,$this->getFieldCaption('receiver_role_systemuser_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->send_date,$this->getFieldCaption('send_date'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->messagetext,$this->getFieldCaption('messagetext'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
		foreach ($this->Data['sender_role_systemuser_fid'] as $item)
			$this->sender_role_systemuser_fid->addOption($item->getID(), $item->getTitleField());
		foreach ($this->Data['receiver_role_systemuser_fid'] as $item)
			$this->receiver_role_systemuser_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("message", $this->Data)){

			/******** sender_role_systemuser_fid ********/
			$this->sender_role_systemuser_fid->setSelectedValue($this->Data['message']->getSender_role_systemuser_fid());
			$this->setFieldCaption('sender_role_systemuser_fid',$this->Data['message']->getFieldInfo('sender_role_systemuser_fid')->getTitle());

			/******** receiver_role_systemuser_fid ********/
			$this->receiver_role_systemuser_fid->setSelectedValue($this->Data['message']->getReceiver_role_systemuser_fid());
			$this->setFieldCaption('receiver_role_systemuser_fid',$this->Data['message']->getFieldInfo('receiver_role_systemuser_fid')->getTitle());

			/******** send_date ********/
			$this->send_date->setTime($this->Data['message']->getSend_date());
			$this->setFieldCaption('send_date',$this->Data['message']->getFieldInfo('send_date')->getTitle());
			$this->send_date->setFieldInfo($this->Data['message']->getFieldInfo('send_date'));

			/******** title ********/
			$this->title->setValue($this->Data['message']->getTitle());
			$this->setFieldCaption('title',$this->Data['message']->getFieldInfo('title')->getTitle());
			$this->title->setFieldInfo($this->Data['message']->getFieldInfo('title'));

			/******** messagetext ********/
			$this->messagetext->setValue($this->Data['message']->getMessagetext());
			$this->setFieldCaption('messagetext',$this->Data['message']->getFieldInfo('messagetext')->getTitle());
			$this->messagetext->setFieldInfo($this->Data['message']->getFieldInfo('messagetext'));

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* sender_role_systemuser_fid *******/
		$this->sender_role_systemuser_fid= new combobox("sender_role_systemuser_fid");
		$this->sender_role_systemuser_fid->setClass("form-control");

		/******* receiver_role_systemuser_fid *******/
		$this->receiver_role_systemuser_fid= new combobox("receiver_role_systemuser_fid");
		$this->receiver_role_systemuser_fid->setClass("form-control");

		/******* send_date *******/
		$this->send_date= new DatePicker("send_date");
		$this->send_date->setClass("form-control");

		/******* title *******/
		$this->title= new textbox("title");
		$this->title->setClass("form-control");

		/******* messagetext *******/
		$this->messagetext= new textbox("messagetext");
		$this->messagetext->setClass("form-control");

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
	private $sender_role_systemuser_fid;
	/**
	 * @return combobox
	 */
	public function getSender_role_systemuser_fid()
	{
		return $this->sender_role_systemuser_fid;
	}
	/** @var combobox */
	private $receiver_role_systemuser_fid;
	/**
	 * @return combobox
	 */
	public function getReceiver_role_systemuser_fid()
	{
		return $this->receiver_role_systemuser_fid;
	}
	/** @var DatePicker */
	private $send_date;
	/**
	 * @return DatePicker
	 */
	public function getSend_date()
	{
		return $this->send_date;
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
	private $messagetext;
	/**
	 * @return textbox
	 */
	public function getMessagetext()
	{
		return $this->messagetext;
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