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
class messagelistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
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
	private $send_date_from;
	/**
	 * @return DatePicker
	 */
	public function getSend_date_from()
	{
		return $this->send_date_from;
	}
	/** @var DatePicker */
	private $send_date_to;
	/**
	 * @return DatePicker
	 */
	public function getSend_date_to()
	{
		return $this->send_date_to;
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
	/** @var combobox */
	private $sortby;
	/**
	 * @return combobox
	 */
	public function getSortby()
	{
		return $this->sortby;
	}
	/** @var combobox */
	private $isdesc;
	/**
	 * @return combobox
	 */
	public function getIsdesc()
	{
		return $this->isdesc;
	}
	/** @var SweetButton */
	private $search;
	public function __construct()
	{
		parent::__construct();

		/******* sender_role_systemuser_fid *******/
		$this->sender_role_systemuser_fid= new combobox("sender_role_systemuser_fid");
		$this->sender_role_systemuser_fid->setClass("form-control");

		/******* receiver_role_systemuser_fid *******/
		$this->receiver_role_systemuser_fid= new combobox("receiver_role_systemuser_fid");
		$this->receiver_role_systemuser_fid->setClass("form-control");

		/******* send_date_from *******/
		$this->send_date_from= new DatePicker("send_date_from");
		$this->send_date_from->setClass("form-control");

		/******* send_date_to *******/
		$this->send_date_to= new DatePicker("send_date_to");
		$this->send_date_to->setClass("form-control");

		/******* title *******/
		$this->title= new textbox("title");
		$this->title->setClass("form-control");

		/******* messagetext *******/
		$this->messagetext= new textbox("messagetext");
		$this->messagetext->setClass("form-control");

		/******* sortby *******/
		$this->sortby= new combobox("sortby");
		$this->sortby->setClass("form-control");

		/******* isdesc *******/
		$this->isdesc= new combobox("isdesc");
		$this->isdesc->setClass("form-control");

		/******* search *******/
		$this->search= new SweetButton(true,"جستجو");
		$this->search->setAction("search");
		$this->search->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
		$this->search->setClass("btn btn-primary");
	}
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("messaging_messagelist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['message']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->sender_role_systemuser_fid,$this->getFieldCaption('sender_role_systemuser_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->receiver_role_systemuser_fid,$this->getFieldCaption('receiver_role_systemuser_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->send_date_from,$this->getFieldCaption('send_date_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->send_date_to,$this->getFieldCaption('send_date_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->messagetext,$this->getFieldCaption('messagetext'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->sortby,$this->getFieldCaption('sortby'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->isdesc,$this->getFieldCaption('isdesc'),null,'',null));
		$LTable1->addElement($this->getSingleFieldRowCode($this->search));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "GET", $Page);
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
	public function FillItems()
	{
			$this->sender_role_systemuser_fid->addOption("", "مهم نیست");
		foreach ($this->Data['sender_role_systemuser_fid'] as $item)
			$this->sender_role_systemuser_fid->addOption($item->getID(), $item->getTitleField());
			$this->receiver_role_systemuser_fid->addOption("", "مهم نیست");
		foreach ($this->Data['receiver_role_systemuser_fid'] as $item)
			$this->receiver_role_systemuser_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("message", $this->Data)){

			/******** sender_role_systemuser_fid ********/
			$this->sender_role_systemuser_fid->setSelectedValue($this->Data['message']->getSender_role_systemuser_fid());
			$this->setFieldCaption('sender_role_systemuser_fid',$this->Data['message']->getFieldInfo('sender_role_systemuser_fid')->getTitle());

			/******** receiver_role_systemuser_fid ********/
			$this->receiver_role_systemuser_fid->setSelectedValue($this->Data['message']->getReceiver_role_systemuser_fid());
			$this->setFieldCaption('receiver_role_systemuser_fid',$this->Data['message']->getFieldInfo('receiver_role_systemuser_fid')->getTitle());

			/******** send_date_from ********/
			$this->send_date_from->setTime($this->Data['message']->getSend_date_from());
			$this->setFieldCaption('send_date_from',$this->Data['message']->getFieldInfo('send_date_from')->getTitle());

			/******** send_date_to ********/
			$this->send_date_to->setTime($this->Data['message']->getSend_date_to());
			$this->setFieldCaption('send_date_to',$this->Data['message']->getFieldInfo('send_date_to')->getTitle());
			$this->setFieldCaption('send_date',$this->Data['message']->getFieldInfo('send_date')->getTitle());

			/******** title ********/
			$this->title->setValue($this->Data['message']->getTitle());
			$this->setFieldCaption('title',$this->Data['message']->getFieldInfo('title')->getTitle());

			/******** messagetext ********/
			$this->messagetext->setValue($this->Data['message']->getMessagetext());
			$this->setFieldCaption('messagetext',$this->Data['message']->getFieldInfo('messagetext')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** sender_role_systemuser_fid ********/
		$this->sortby->addOption($this->Data['message']->getTableFieldID('sender_role_systemuser_fid'),$this->getFieldCaption('sender_role_systemuser_fid'));
		if(isset($_GET['sender_role_systemuser_fid']))
			$this->sender_role_systemuser_fid->setSelectedValue($_GET['sender_role_systemuser_fid']);

		/******** receiver_role_systemuser_fid ********/
		$this->sortby->addOption($this->Data['message']->getTableFieldID('receiver_role_systemuser_fid'),$this->getFieldCaption('receiver_role_systemuser_fid'));
		if(isset($_GET['receiver_role_systemuser_fid']))
			$this->receiver_role_systemuser_fid->setSelectedValue($_GET['receiver_role_systemuser_fid']);

		/******** send_date_from ********/

		/******** send_date_to ********/
		$this->sortby->addOption($this->Data['message']->getTableFieldID('send_date'),$this->getFieldCaption('send_date'));

		/******** title ********/
		$this->sortby->addOption($this->Data['message']->getTableFieldID('title'),$this->getFieldCaption('title'));
		if(isset($_GET['title']))
			$this->title->setValue($_GET['title']);

		/******** messagetext ********/
		$this->sortby->addOption($this->Data['message']->getTableFieldID('messagetext'),$this->getFieldCaption('messagetext'));
		if(isset($_GET['messagetext']))
			$this->messagetext->setValue($_GET['messagetext']);

		/******** sortby ********/
		if(isset($_GET['sortby']))
			$this->sortby->setSelectedValue($_GET['sortby']);

		/******** isdesc ********/
		if(isset($_GET['isdesc']))
			$this->isdesc->setSelectedValue($_GET['isdesc']);

		/******** search ********/
	}
}
?>