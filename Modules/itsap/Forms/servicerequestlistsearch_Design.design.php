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
*@creationDate 1397-07-29 - 2018-10-21 15:46
*@lastUpdate 1397-07-29 - 2018-10-21 15:46
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class servicerequestlistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
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
	private $unit_fid;
	/**
	 * @return combobox
	 */
	public function getUnit_fid()
	{
		return $this->unit_fid;
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
	/** @var DatePicker */
	private $request_date_from;
	/**
	 * @return DatePicker
	 */
	public function getRequest_date_from()
	{
		return $this->request_date_from;
	}
	/** @var DatePicker */
	private $request_date_to;
	/**
	 * @return DatePicker
	 */
	public function getRequest_date_to()
	{
		return $this->request_date_to;
	}
	/** @var combobox */
	private $securityacceptor_role_systemuser_fid;
	/**
	 * @return combobox
	 */
	public function getSecurityacceptor_role_systemuser_fid()
	{
		return $this->securityacceptor_role_systemuser_fid;
	}
	/** @var combobox */
	private $is_securityaccepted;
	/**
	 * @return combobox
	 */
	public function getIs_securityaccepted()
	{
		return $this->is_securityaccepted;
	}
	/** @var textbox */
	private $securityacceptancemessage;
	/**
	 * @return textbox
	 */
	public function getSecurityacceptancemessage()
	{
		return $this->securityacceptancemessage;
	}
	/** @var DatePicker */
	private $securityacceptance_date_from;
	/**
	 * @return DatePicker
	 */
	public function getSecurityacceptance_date_from()
	{
		return $this->securityacceptance_date_from;
	}
	/** @var DatePicker */
	private $securityacceptance_date_to;
	/**
	 * @return DatePicker
	 */
	public function getSecurityacceptance_date_to()
	{
		return $this->securityacceptance_date_to;
	}
	/** @var textbox */
	private $letternumber;
	/**
	 * @return textbox
	 */
	public function getLetternumber()
	{
		return $this->letternumber;
	}
	/** @var DatePicker */
	private $letter_date_from;
	/**
	 * @return DatePicker
	 */
	public function getLetter_date_from()
	{
		return $this->letter_date_from;
	}
	/** @var DatePicker */
	private $letter_date_to;
	/**
	 * @return DatePicker
	 */
	public function getLetter_date_to()
	{
		return $this->letter_date_to;
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

		/******* title *******/
		$this->title= new textbox("title");
		$this->title->setClass("form-control");

		/******* unit_fid *******/
		$this->unit_fid= new combobox("unit_fid");
		$this->unit_fid->setClass("form-control selectpicker");
		$this->unit_fid->SetAttribute("data-live-search",true);

		/******* servicetype_fid *******/
		$this->servicetype_fid= new combobox("servicetype_fid");
		$this->servicetype_fid->setClass("form-control selectpicker");
		$this->servicetype_fid->SetAttribute("data-live-search",true);

		/******* description *******/
		$this->description= new textbox("description");
		$this->description->setClass("form-control");

		/******* priority *******/
		$this->priority= new textbox("priority");
		$this->priority->setClass("form-control");

		/******* request_date_from *******/
		$this->request_date_from= new DatePicker("request_date_from");
		$this->request_date_from->setClass("form-control");

		/******* request_date_to *******/
		$this->request_date_to= new DatePicker("request_date_to");
		$this->request_date_to->setClass("form-control");

		/******* securityacceptor_role_systemuser_fid *******/
		$this->securityacceptor_role_systemuser_fid= new combobox("securityacceptor_role_systemuser_fid");
		$this->securityacceptor_role_systemuser_fid->setClass("form-control selectpicker");
		$this->securityacceptor_role_systemuser_fid->SetAttribute("data-live-search",true);

		/******* is_securityaccepted *******/
		$this->is_securityaccepted= new combobox("is_securityaccepted");
		$this->is_securityaccepted->setClass("form-control selectpicker");

		/******* securityacceptancemessage *******/
		$this->securityacceptancemessage= new textbox("securityacceptancemessage");
		$this->securityacceptancemessage->setClass("form-control");

		/******* securityacceptance_date_from *******/
		$this->securityacceptance_date_from= new DatePicker("securityacceptance_date_from");
		$this->securityacceptance_date_from->setClass("form-control");

		/******* securityacceptance_date_to *******/
		$this->securityacceptance_date_to= new DatePicker("securityacceptance_date_to");
		$this->securityacceptance_date_to->setClass("form-control");

		/******* letternumber *******/
		$this->letternumber= new textbox("letternumber");
		$this->letternumber->setClass("form-control");

		/******* letter_date_from *******/
		$this->letter_date_from= new DatePicker("letter_date_from");
		$this->letter_date_from->setClass("form-control");

		/******* letter_date_to *******/
		$this->letter_date_to= new DatePicker("letter_date_to");
		$this->letter_date_to->setClass("form-control");

		/******* sortby *******/
		$this->sortby= new combobox("sortby");
		$this->sortby->setClass("form-control selectpicker");

		/******* isdesc *******/
		$this->isdesc= new combobox("isdesc");
		$this->isdesc->setClass("form-control selectpicker");

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
		$Page->setId("itsap_servicerequestlist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['servicerequest']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->unit_fid,$this->getFieldCaption('unit_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->servicetype_fid,$this->getFieldCaption('servicetype_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->description,$this->getFieldCaption('description'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->priority,$this->getFieldCaption('priority'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->request_date_from,$this->getFieldCaption('request_date_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->request_date_to,$this->getFieldCaption('request_date_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->securityacceptor_role_systemuser_fid,$this->getFieldCaption('securityacceptor_role_systemuser_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->is_securityaccepted,$this->getFieldCaption('is_securityaccepted'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->securityacceptancemessage,$this->getFieldCaption('securityacceptancemessage'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->securityacceptance_date_from,$this->getFieldCaption('securityacceptance_date_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->securityacceptance_date_to,$this->getFieldCaption('securityacceptance_date_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->letternumber,$this->getFieldCaption('letternumber'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->letter_date_from,$this->getFieldCaption('letter_date_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->letter_date_to,$this->getFieldCaption('letter_date_to'),null,'',null));
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
			$this->unit_fid->addOption("", "مهم نیست");
		foreach ($this->Data['unit_fid'] as $item)
			$this->unit_fid->addOption($item->getID(), $item->getTitleField());
			$this->servicetype_fid->addOption("", "مهم نیست");
		foreach ($this->Data['servicetype_fid'] as $item)
			$this->servicetype_fid->addOption($item->getID(), $item->getTitleField());
			$this->securityacceptor_role_systemuser_fid->addOption("", "مهم نیست");
		foreach ($this->Data['securityacceptor_role_systemuser_fid'] as $item)
			$this->securityacceptor_role_systemuser_fid->addOption($item->getID(), $item->getTitleField());
			$this->is_securityaccepted->addOption("", "مهم نیست");
			$this->is_securityaccepted->addOption(1,'بله');
			$this->is_securityaccepted->addOption(0,'خیر');
		if (key_exists("servicerequest", $this->Data)){

			/******** title ********/
			$this->title->setValue($this->Data['servicerequest']->getTitle());
			$this->setFieldCaption('title',$this->Data['servicerequest']->getFieldInfo('title')->getTitle());

			/******** unit_fid ********/
			$this->unit_fid->setSelectedValue($this->Data['servicerequest']->getUnit_fid());
			$this->setFieldCaption('unit_fid',$this->Data['servicerequest']->getFieldInfo('unit_fid')->getTitle());

			/******** servicetype_fid ********/
			$this->servicetype_fid->setSelectedValue($this->Data['servicerequest']->getServicetype_fid());
			$this->setFieldCaption('servicetype_fid',$this->Data['servicerequest']->getFieldInfo('servicetype_fid')->getTitle());

			/******** description ********/
			$this->description->setValue($this->Data['servicerequest']->getDescription());
			$this->setFieldCaption('description',$this->Data['servicerequest']->getFieldInfo('description')->getTitle());

			/******** priority ********/
			$this->priority->setValue($this->Data['servicerequest']->getPriority());
			$this->setFieldCaption('priority',$this->Data['servicerequest']->getFieldInfo('priority')->getTitle());

			/******** request_date_from ********/
			$this->request_date_from->setTime($this->Data['servicerequest']->getRequest_date_from());
			$this->setFieldCaption('request_date_from',$this->Data['servicerequest']->getFieldInfo('request_date_from')->getTitle());

			/******** request_date_to ********/
			$this->request_date_to->setTime($this->Data['servicerequest']->getRequest_date_to());
			$this->setFieldCaption('request_date_to',$this->Data['servicerequest']->getFieldInfo('request_date_to')->getTitle());
			$this->setFieldCaption('request_date',$this->Data['servicerequest']->getFieldInfo('request_date')->getTitle());

			/******** securityacceptor_role_systemuser_fid ********/
			$this->securityacceptor_role_systemuser_fid->setSelectedValue($this->Data['servicerequest']->getSecurityacceptor_role_systemuser_fid());
			$this->setFieldCaption('securityacceptor_role_systemuser_fid',$this->Data['servicerequest']->getFieldInfo('securityacceptor_role_systemuser_fid')->getTitle());

			/******** is_securityaccepted ********/
			$this->is_securityaccepted->setSelectedValue($this->Data['servicerequest']->getIs_securityaccepted());
			$this->setFieldCaption('is_securityaccepted',$this->Data['servicerequest']->getFieldInfo('is_securityaccepted')->getTitle());

			/******** securityacceptancemessage ********/
			$this->securityacceptancemessage->setValue($this->Data['servicerequest']->getSecurityacceptancemessage());
			$this->setFieldCaption('securityacceptancemessage',$this->Data['servicerequest']->getFieldInfo('securityacceptancemessage')->getTitle());

			/******** securityacceptance_date_from ********/
			$this->securityacceptance_date_from->setTime($this->Data['servicerequest']->getSecurityacceptance_date_from());
			$this->setFieldCaption('securityacceptance_date_from',$this->Data['servicerequest']->getFieldInfo('securityacceptance_date_from')->getTitle());

			/******** securityacceptance_date_to ********/
			$this->securityacceptance_date_to->setTime($this->Data['servicerequest']->getSecurityacceptance_date_to());
			$this->setFieldCaption('securityacceptance_date_to',$this->Data['servicerequest']->getFieldInfo('securityacceptance_date_to')->getTitle());
			$this->setFieldCaption('securityacceptance_date',$this->Data['servicerequest']->getFieldInfo('securityacceptance_date')->getTitle());

			/******** letternumber ********/
			$this->letternumber->setValue($this->Data['servicerequest']->getLetternumber());
			$this->setFieldCaption('letternumber',$this->Data['servicerequest']->getFieldInfo('letternumber')->getTitle());

			/******** letter_date_from ********/
			$this->letter_date_from->setTime($this->Data['servicerequest']->getLetter_date_from());
			$this->setFieldCaption('letter_date_from',$this->Data['servicerequest']->getFieldInfo('letter_date_from')->getTitle());

			/******** letter_date_to ********/
			$this->letter_date_to->setTime($this->Data['servicerequest']->getLetter_date_to());
			$this->setFieldCaption('letter_date_to',$this->Data['servicerequest']->getFieldInfo('letter_date_to')->getTitle());
			$this->setFieldCaption('letter_date',$this->Data['servicerequest']->getFieldInfo('letter_date')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** title ********/
		$this->sortby->addOption($this->Data['servicerequest']->getTableFieldID('title'),$this->getFieldCaption('title'));
		if(isset($_GET['title']))
			$this->title->setValue($_GET['title']);

		/******** unit_fid ********/
		$this->sortby->addOption($this->Data['servicerequest']->getTableFieldID('unit_fid'),$this->getFieldCaption('unit_fid'));
		if(isset($_GET['unit_fid']))
			$this->unit_fid->setSelectedValue($_GET['unit_fid']);

		/******** servicetype_fid ********/
		$this->sortby->addOption($this->Data['servicerequest']->getTableFieldID('servicetype_fid'),$this->getFieldCaption('servicetype_fid'));
		if(isset($_GET['servicetype_fid']))
			$this->servicetype_fid->setSelectedValue($_GET['servicetype_fid']);

		/******** description ********/
		$this->sortby->addOption($this->Data['servicerequest']->getTableFieldID('description'),$this->getFieldCaption('description'));
		if(isset($_GET['description']))
			$this->description->setValue($_GET['description']);

		/******** priority ********/
		$this->sortby->addOption($this->Data['servicerequest']->getTableFieldID('priority'),$this->getFieldCaption('priority'));
		if(isset($_GET['priority']))
			$this->priority->setValue($_GET['priority']);

		/******** request_date_from ********/

		/******** request_date_to ********/
		$this->sortby->addOption($this->Data['servicerequest']->getTableFieldID('request_date'),$this->getFieldCaption('request_date'));

		/******** securityacceptor_role_systemuser_fid ********/
		$this->sortby->addOption($this->Data['servicerequest']->getTableFieldID('securityacceptor_role_systemuser_fid'),$this->getFieldCaption('securityacceptor_role_systemuser_fid'));
		if(isset($_GET['securityacceptor_role_systemuser_fid']))
			$this->securityacceptor_role_systemuser_fid->setSelectedValue($_GET['securityacceptor_role_systemuser_fid']);

		/******** is_securityaccepted ********/
		$this->sortby->addOption($this->Data['servicerequest']->getTableFieldID('is_securityaccepted'),$this->getFieldCaption('is_securityaccepted'));
		if(isset($_GET['is_securityaccepted']))
			$this->is_securityaccepted->setSelectedValue($_GET['is_securityaccepted']);

		/******** securityacceptancemessage ********/
		$this->sortby->addOption($this->Data['servicerequest']->getTableFieldID('securityacceptancemessage'),$this->getFieldCaption('securityacceptancemessage'));
		if(isset($_GET['securityacceptancemessage']))
			$this->securityacceptancemessage->setValue($_GET['securityacceptancemessage']);

		/******** securityacceptance_date_from ********/

		/******** securityacceptance_date_to ********/
		$this->sortby->addOption($this->Data['servicerequest']->getTableFieldID('securityacceptance_date'),$this->getFieldCaption('securityacceptance_date'));

		/******** letternumber ********/
		$this->sortby->addOption($this->Data['servicerequest']->getTableFieldID('letternumber'),$this->getFieldCaption('letternumber'));
		if(isset($_GET['letternumber']))
			$this->letternumber->setValue($_GET['letternumber']);

		/******** letter_date_from ********/

		/******** letter_date_to ********/
		$this->sortby->addOption($this->Data['servicerequest']->getTableFieldID('letter_date'),$this->getFieldCaption('letter_date'));

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