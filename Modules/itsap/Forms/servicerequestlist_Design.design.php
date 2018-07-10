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
class servicerequestlist_Design extends FormDesign {
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
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("itsap_servicerequestlist");
		$Page->addElement($this->getPageTitlePart("فهرست " . $this->Data['servicerequest']->getTableTitle() . " ها"));
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->servicetype_fid,$this->getFieldCaption('servicetype_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->description,$this->getFieldCaption('description'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->priority,$this->getFieldCaption('priority'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->request_date_from,$this->getFieldCaption('request_date_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->request_date_to,$this->getFieldCaption('request_date_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->sortby,$this->getFieldCaption('sortby'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->isdesc,$this->getFieldCaption('isdesc'),null,'',null));
		$LTable1->addElement($this->getSingleFieldRowCode($this->search));
		$Page->addElement($LTable1);
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$Div1=new Div();
		$Div1->setClass("list");
		for($i=0;$i<count($this->Data['data']);$i++){
		$innerDiv[$i]=new Div();
		$innerDiv[$i]->setClass("listitem");
			$url=new AppRooter('itsap','servicerequest');
			$url->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
			$Title=$this->Data['data'][$i]->getTitleField();
			if($this->Data['data'][$i]->getTitleField()=="")
				$Title='-- بدون عنوان --';
			$lbTit[$i]=new Lable($Title);
			$liTit[$i]=new link($url->getAbsoluteURL(),$lbTit[$i]);
			$innerDiv[$i]->addElement($liTit[$i]);
			$Div1->addElement($innerDiv[$i]);
		}
		$Page->addElement($Div1);
		$Page->addElement($this->getPaginationPart($this->Data['pagecount'],"itsap","servicerequestlist"));
		$PageLink=new AppRooter('itsap','servicerequestlist');
		$form=new SweetFrom($PageLink->getAbsoluteURL(), "GET", $Page);
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
	public function getJSON()
	{
		parent::getJSON();
		if (key_exists("data", $this->Data)){
			$AllCount1 = count($this->Data['data']);
			$Result=array();
			for($i=0;$i<$AllCount1;$i++){
				$Result[$i]=$this->Data['data'][$i]->GetArray();
			}
			return json_encode($Result);
		}
		return json_encode(array());
	}
	public function FillItems()
	{
			$this->servicetype_fid->addOption("", "مهم نیست");
		foreach ($this->Data['servicetype_fid'] as $item)
			$this->servicetype_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("servicerequest", $this->Data)){

			/******** title ********/
			$this->title->setValue($this->Data['servicerequest']->getTitle());
			$this->setFieldCaption('title',$this->Data['servicerequest']->getFieldInfo('title')->getTitle());

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

		/******** sortby ********/
		if(isset($_GET['sortby']))
			$this->sortby->setSelectedValue($_GET['sortby']);

		/******** isdesc ********/
		if(isset($_GET['isdesc']))
			$this->isdesc->setSelectedValue($_GET['isdesc']);

		/******** search ********/
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

		/******* request_date_from *******/
		$this->request_date_from= new DatePicker("request_date_from");
		$this->request_date_from->setClass("form-control");

		/******* request_date_to *******/
		$this->request_date_to= new DatePicker("request_date_to");
		$this->request_date_to->setClass("form-control");

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
}
?>