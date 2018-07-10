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
class servicerequestservicestatuslistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
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
	private $start_date_from;
	/**
	 * @return DatePicker
	 */
	public function getStart_date_from()
	{
		return $this->start_date_from;
	}
	/** @var DatePicker */
	private $start_date_to;
	/**
	 * @return DatePicker
	 */
	public function getStart_date_to()
	{
		return $this->start_date_to;
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

		/******* servicestatus_fid *******/
		$this->servicestatus_fid= new combobox("servicestatus_fid");
		$this->servicestatus_fid->setClass("form-control");

		/******* servicerequest_fid *******/
		$this->servicerequest_fid= new combobox("servicerequest_fid");
		$this->servicerequest_fid->setClass("form-control");

		/******* start_date_from *******/
		$this->start_date_from= new DatePicker("start_date_from");
		$this->start_date_from->setClass("form-control");

		/******* start_date_to *******/
		$this->start_date_to= new DatePicker("start_date_to");
		$this->start_date_to->setClass("form-control");

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
		$Page->setId("itsap_servicerequestservicestatuslist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['servicerequestservicestatus']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->servicestatus_fid,$this->getFieldCaption('servicestatus_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->servicerequest_fid,$this->getFieldCaption('servicerequest_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->start_date_from,$this->getFieldCaption('start_date_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->start_date_to,$this->getFieldCaption('start_date_to'),null,'',null));
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
			$this->servicestatus_fid->addOption("", "مهم نیست");
		foreach ($this->Data['servicestatus_fid'] as $item)
			$this->servicestatus_fid->addOption($item->getID(), $item->getTitleField());
			$this->servicerequest_fid->addOption("", "مهم نیست");
		foreach ($this->Data['servicerequest_fid'] as $item)
			$this->servicerequest_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("servicerequestservicestatus", $this->Data)){

			/******** servicestatus_fid ********/
			$this->servicestatus_fid->setSelectedValue($this->Data['servicerequestservicestatus']->getServicestatus_fid());
			$this->setFieldCaption('servicestatus_fid',$this->Data['servicerequestservicestatus']->getFieldInfo('servicestatus_fid')->getTitle());

			/******** servicerequest_fid ********/
			$this->servicerequest_fid->setSelectedValue($this->Data['servicerequestservicestatus']->getServicerequest_fid());
			$this->setFieldCaption('servicerequest_fid',$this->Data['servicerequestservicestatus']->getFieldInfo('servicerequest_fid')->getTitle());

			/******** start_date_from ********/
			$this->start_date_from->setTime($this->Data['servicerequestservicestatus']->getStart_date_from());
			$this->setFieldCaption('start_date_from',$this->Data['servicerequestservicestatus']->getFieldInfo('start_date_from')->getTitle());

			/******** start_date_to ********/
			$this->start_date_to->setTime($this->Data['servicerequestservicestatus']->getStart_date_to());
			$this->setFieldCaption('start_date_to',$this->Data['servicerequestservicestatus']->getFieldInfo('start_date_to')->getTitle());
			$this->setFieldCaption('start_date',$this->Data['servicerequestservicestatus']->getFieldInfo('start_date')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** servicestatus_fid ********/
		$this->sortby->addOption($this->Data['servicerequestservicestatus']->getTableFieldID('servicestatus_fid'),$this->getFieldCaption('servicestatus_fid'));
		if(isset($_GET['servicestatus_fid']))
			$this->servicestatus_fid->setSelectedValue($_GET['servicestatus_fid']);

		/******** servicerequest_fid ********/
		$this->sortby->addOption($this->Data['servicerequestservicestatus']->getTableFieldID('servicerequest_fid'),$this->getFieldCaption('servicerequest_fid'));
		if(isset($_GET['servicerequest_fid']))
			$this->servicerequest_fid->setSelectedValue($_GET['servicerequest_fid']);

		/******** start_date_from ********/

		/******** start_date_to ********/
		$this->sortby->addOption($this->Data['servicerequestservicestatus']->getTableFieldID('start_date'),$this->getFieldCaption('start_date'));

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