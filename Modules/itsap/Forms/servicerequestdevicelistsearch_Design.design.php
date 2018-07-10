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
class servicerequestdevicelistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
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
		$Page->setId("itsap_servicerequestdevicelist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['servicerequestdevice']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->code,$this->getFieldCaption('code'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->devicetype_fid,$this->getFieldCaption('devicetype_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->servicerequest_fid,$this->getFieldCaption('servicerequest_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->description,$this->getFieldCaption('description'),null,'',null));
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
			$this->devicetype_fid->addOption("", "مهم نیست");
		foreach ($this->Data['devicetype_fid'] as $item)
			$this->devicetype_fid->addOption($item->getID(), $item->getTitleField());
			$this->servicerequest_fid->addOption("", "مهم نیست");
		foreach ($this->Data['servicerequest_fid'] as $item)
			$this->servicerequest_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("servicerequestdevice", $this->Data)){

			/******** code ********/
			$this->code->setValue($this->Data['servicerequestdevice']->getCode());
			$this->setFieldCaption('code',$this->Data['servicerequestdevice']->getFieldInfo('code')->getTitle());

			/******** devicetype_fid ********/
			$this->devicetype_fid->setSelectedValue($this->Data['servicerequestdevice']->getDevicetype_fid());
			$this->setFieldCaption('devicetype_fid',$this->Data['servicerequestdevice']->getFieldInfo('devicetype_fid')->getTitle());

			/******** servicerequest_fid ********/
			$this->servicerequest_fid->setSelectedValue($this->Data['servicerequestdevice']->getServicerequest_fid());
			$this->setFieldCaption('servicerequest_fid',$this->Data['servicerequestdevice']->getFieldInfo('servicerequest_fid')->getTitle());

			/******** description ********/
			$this->description->setValue($this->Data['servicerequestdevice']->getDescription());
			$this->setFieldCaption('description',$this->Data['servicerequestdevice']->getFieldInfo('description')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** code ********/
		$this->sortby->addOption($this->Data['servicerequestdevice']->getTableFieldID('code'),$this->getFieldCaption('code'));
		if(isset($_GET['code']))
			$this->code->setValue($_GET['code']);

		/******** devicetype_fid ********/
		$this->sortby->addOption($this->Data['servicerequestdevice']->getTableFieldID('devicetype_fid'),$this->getFieldCaption('devicetype_fid'));
		if(isset($_GET['devicetype_fid']))
			$this->devicetype_fid->setSelectedValue($_GET['devicetype_fid']);

		/******** servicerequest_fid ********/
		$this->sortby->addOption($this->Data['servicerequestdevice']->getTableFieldID('servicerequest_fid'),$this->getFieldCaption('servicerequest_fid'));
		if(isset($_GET['servicerequest_fid']))
			$this->servicerequest_fid->setSelectedValue($_GET['servicerequest_fid']);

		/******** description ********/
		$this->sortby->addOption($this->Data['servicerequestdevice']->getTableFieldID('description'),$this->getFieldCaption('description'));
		if(isset($_GET['description']))
			$this->description->setValue($_GET['description']);

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