<?php
namespace Modules\iribfinance\Forms;
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
*@creationDate 1396-11-05 - 2018-01-25 18:27
*@lastUpdate 1396-11-05 - 2018-01-25 18:27
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class programestimationlist_Design extends FormDesign {
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
	private $department_fid;
	/**
	 * @return combobox
	 */
	public function getDepartment_fid()
	{
		return $this->department_fid;
	}
	/** @var combobox */
	private $class_fid;
	/**
	 * @return combobox
	 */
	public function getClass_fid()
	{
		return $this->class_fid;
	}
	/** @var combobox */
	private $programmaketype_fid;
	/**
	 * @return combobox
	 */
	public function getProgrammaketype_fid()
	{
		return $this->programmaketype_fid;
	}
	/** @var textbox */
	private $totalprogramcount;
	/**
	 * @return textbox
	 */
	public function getTotalprogramcount()
	{
		return $this->totalprogramcount;
	}
	/** @var textbox */
	private $timeperprogram;
	/**
	 * @return textbox
	 */
	public function getTimeperprogram()
	{
		return $this->timeperprogram;
	}
	/** @var combobox */
	private $is_haslegalproblem;
	/**
	 * @return combobox
	 */
	public function getIs_haslegalproblem()
	{
		return $this->is_haslegalproblem;
	}
	/** @var DatePicker */
	private $approval_date_from;
	/**
	 * @return DatePicker
	 */
	public function getApproval_date_from()
	{
		return $this->approval_date_from;
	}
	/** @var DatePicker */
	private $approval_date_to;
	/**
	 * @return DatePicker
	 */
	public function getApproval_date_to()
	{
		return $this->approval_date_to;
	}
	/** @var DatePicker */
	private $end_date_from;
	/**
	 * @return DatePicker
	 */
	public function getEnd_date_from()
	{
		return $this->end_date_from;
	}
	/** @var DatePicker */
	private $end_date_to;
	/**
	 * @return DatePicker
	 */
	public function getEnd_date_to()
	{
		return $this->end_date_to;
	}
	/** @var DatePicker */
	private $add_date_from;
	/**
	 * @return DatePicker
	 */
	public function getAdd_date_from()
	{
		return $this->add_date_from;
	}
	/** @var DatePicker */
	private $add_date_to;
	/**
	 * @return DatePicker
	 */
	public function getAdd_date_to()
	{
		return $this->add_date_to;
	}
	/** @var combobox */
	private $producer_employee_fid;
	/**
	 * @return combobox
	 */
	public function getProducer_employee_fid()
	{
		return $this->producer_employee_fid;
	}
	/** @var combobox */
	private $executor_employee_fid;
	/**
	 * @return combobox
	 */
	public function getExecutor_employee_fid()
	{
		return $this->executor_employee_fid;
	}
	/** @var combobox */
	private $paycenter_fid;
	/**
	 * @return combobox
	 */
	public function getPaycenter_fid()
	{
		return $this->paycenter_fid;
	}
	/** @var combobox */
	private $makergroup_paycenter_fid;
	/**
	 * @return combobox
	 */
	public function getMakergroup_paycenter_fid()
	{
		return $this->makergroup_paycenter_fid;
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
		$Page->setId("iribfinance_programestimationlist");
		$Page->addElement($this->getPageTitlePart("فهرست " . $this->Data['programestimation']->getTableTitle() . " ها"));
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->department_fid,$this->getFieldCaption('department_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->class_fid,$this->getFieldCaption('class_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->programmaketype_fid,$this->getFieldCaption('programmaketype_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->totalprogramcount,$this->getFieldCaption('totalprogramcount'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->timeperprogram,$this->getFieldCaption('timeperprogram'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->is_haslegalproblem,$this->getFieldCaption('is_haslegalproblem'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->approval_date_from,$this->getFieldCaption('approval_date_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->approval_date_to,$this->getFieldCaption('approval_date_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->end_date_from,$this->getFieldCaption('end_date_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->end_date_to,$this->getFieldCaption('end_date_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->add_date_from,$this->getFieldCaption('add_date_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->add_date_to,$this->getFieldCaption('add_date_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->producer_employee_fid,$this->getFieldCaption('producer_employee_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->executor_employee_fid,$this->getFieldCaption('executor_employee_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->paycenter_fid,$this->getFieldCaption('paycenter_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->makergroup_paycenter_fid,$this->getFieldCaption('makergroup_paycenter_fid'),null,'',null));
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
			$url=new AppRooter('iribfinance','programestimation');
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
		$Page->addElement($this->getPaginationPart($this->Data['pagecount'],"iribfinance","programestimationlist"));
		$PageLink=new AppRooter('iribfinance','programestimationlist');
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
			$this->department_fid->addOption("", "مهم نیست");
		foreach ($this->Data['department_fid'] as $item)
			$this->department_fid->addOption($item->getID(), $item->getTitleField());
			$this->class_fid->addOption("", "مهم نیست");
		foreach ($this->Data['class_fid'] as $item)
			$this->class_fid->addOption($item->getID(), $item->getTitleField());
			$this->programmaketype_fid->addOption("", "مهم نیست");
		foreach ($this->Data['programmaketype_fid'] as $item)
			$this->programmaketype_fid->addOption($item->getID(), $item->getTitleField());
			$this->is_haslegalproblem->addOption("", "مهم نیست");
			$this->is_haslegalproblem->addOption(1,'بله');
			$this->is_haslegalproblem->addOption(0,'خیر');
			$this->producer_employee_fid->addOption("", "مهم نیست");
		foreach ($this->Data['producer_employee_fid'] as $item)
			$this->producer_employee_fid->addOption($item->getID(), $item->getTitleField());
			$this->executor_employee_fid->addOption("", "مهم نیست");
		foreach ($this->Data['executor_employee_fid'] as $item)
			$this->executor_employee_fid->addOption($item->getID(), $item->getTitleField());
			$this->paycenter_fid->addOption("", "مهم نیست");
		foreach ($this->Data['paycenter_fid'] as $item)
			$this->paycenter_fid->addOption($item->getID(), $item->getTitleField());
			$this->makergroup_paycenter_fid->addOption("", "مهم نیست");
		foreach ($this->Data['makergroup_paycenter_fid'] as $item)
			$this->makergroup_paycenter_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("programestimation", $this->Data)){

			/******** title ********/
			$this->title->setValue($this->Data['programestimation']->getTitle());
			$this->setFieldCaption('title',$this->Data['programestimation']->getFieldInfo('title')->getTitle());

			/******** department_fid ********/
			$this->department_fid->setSelectedValue($this->Data['programestimation']->getDepartment_fid());
			$this->setFieldCaption('department_fid',$this->Data['programestimation']->getFieldInfo('department_fid')->getTitle());

			/******** class_fid ********/
			$this->class_fid->setSelectedValue($this->Data['programestimation']->getClass_fid());
			$this->setFieldCaption('class_fid',$this->Data['programestimation']->getFieldInfo('class_fid')->getTitle());

			/******** programmaketype_fid ********/
			$this->programmaketype_fid->setSelectedValue($this->Data['programestimation']->getProgrammaketype_fid());
			$this->setFieldCaption('programmaketype_fid',$this->Data['programestimation']->getFieldInfo('programmaketype_fid')->getTitle());

			/******** totalprogramcount ********/
			$this->totalprogramcount->setValue($this->Data['programestimation']->getTotalprogramcount());
			$this->setFieldCaption('totalprogramcount',$this->Data['programestimation']->getFieldInfo('totalprogramcount')->getTitle());

			/******** timeperprogram ********/
			$this->timeperprogram->setValue($this->Data['programestimation']->getTimeperprogram());
			$this->setFieldCaption('timeperprogram',$this->Data['programestimation']->getFieldInfo('timeperprogram')->getTitle());

			/******** is_haslegalproblem ********/
			$this->is_haslegalproblem->setSelectedValue($this->Data['programestimation']->getIs_haslegalproblem());
			$this->setFieldCaption('is_haslegalproblem',$this->Data['programestimation']->getFieldInfo('is_haslegalproblem')->getTitle());

			/******** approval_date_from ********/
			$this->approval_date_from->setTime($this->Data['programestimation']->getApproval_date_from());
			$this->setFieldCaption('approval_date_from',$this->Data['programestimation']->getFieldInfo('approval_date_from')->getTitle());

			/******** approval_date_to ********/
			$this->approval_date_to->setTime($this->Data['programestimation']->getApproval_date_to());
			$this->setFieldCaption('approval_date_to',$this->Data['programestimation']->getFieldInfo('approval_date_to')->getTitle());
			$this->setFieldCaption('approval_date',$this->Data['programestimation']->getFieldInfo('approval_date')->getTitle());

			/******** end_date_from ********/
			$this->end_date_from->setTime($this->Data['programestimation']->getEnd_date_from());
			$this->setFieldCaption('end_date_from',$this->Data['programestimation']->getFieldInfo('end_date_from')->getTitle());

			/******** end_date_to ********/
			$this->end_date_to->setTime($this->Data['programestimation']->getEnd_date_to());
			$this->setFieldCaption('end_date_to',$this->Data['programestimation']->getFieldInfo('end_date_to')->getTitle());
			$this->setFieldCaption('end_date',$this->Data['programestimation']->getFieldInfo('end_date')->getTitle());

			/******** add_date_from ********/
			$this->add_date_from->setTime($this->Data['programestimation']->getAdd_date_from());
			$this->setFieldCaption('add_date_from',$this->Data['programestimation']->getFieldInfo('add_date_from')->getTitle());

			/******** add_date_to ********/
			$this->add_date_to->setTime($this->Data['programestimation']->getAdd_date_to());
			$this->setFieldCaption('add_date_to',$this->Data['programestimation']->getFieldInfo('add_date_to')->getTitle());
			$this->setFieldCaption('add_date',$this->Data['programestimation']->getFieldInfo('add_date')->getTitle());

			/******** producer_employee_fid ********/
			$this->producer_employee_fid->setSelectedValue($this->Data['programestimation']->getProducer_employee_fid());
			$this->setFieldCaption('producer_employee_fid',$this->Data['programestimation']->getFieldInfo('producer_employee_fid')->getTitle());

			/******** executor_employee_fid ********/
			$this->executor_employee_fid->setSelectedValue($this->Data['programestimation']->getExecutor_employee_fid());
			$this->setFieldCaption('executor_employee_fid',$this->Data['programestimation']->getFieldInfo('executor_employee_fid')->getTitle());

			/******** paycenter_fid ********/
			$this->paycenter_fid->setSelectedValue($this->Data['programestimation']->getPaycenter_fid());
			$this->setFieldCaption('paycenter_fid',$this->Data['programestimation']->getFieldInfo('paycenter_fid')->getTitle());

			/******** makergroup_paycenter_fid ********/
			$this->makergroup_paycenter_fid->setSelectedValue($this->Data['programestimation']->getMakergroup_paycenter_fid());
			$this->setFieldCaption('makergroup_paycenter_fid',$this->Data['programestimation']->getFieldInfo('makergroup_paycenter_fid')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** title ********/
		$this->sortby->addOption($this->Data['programestimation']->getTableFieldID('title'),$this->getFieldCaption('title'));
		if(isset($_GET['title']))
			$this->title->setValue($_GET['title']);

		/******** department_fid ********/
		$this->sortby->addOption($this->Data['programestimation']->getTableFieldID('department_fid'),$this->getFieldCaption('department_fid'));
		if(isset($_GET['department_fid']))
			$this->department_fid->setSelectedValue($_GET['department_fid']);

		/******** class_fid ********/
		$this->sortby->addOption($this->Data['programestimation']->getTableFieldID('class_fid'),$this->getFieldCaption('class_fid'));
		if(isset($_GET['class_fid']))
			$this->class_fid->setSelectedValue($_GET['class_fid']);

		/******** programmaketype_fid ********/
		$this->sortby->addOption($this->Data['programestimation']->getTableFieldID('programmaketype_fid'),$this->getFieldCaption('programmaketype_fid'));
		if(isset($_GET['programmaketype_fid']))
			$this->programmaketype_fid->setSelectedValue($_GET['programmaketype_fid']);

		/******** totalprogramcount ********/
		$this->sortby->addOption($this->Data['programestimation']->getTableFieldID('totalprogramcount'),$this->getFieldCaption('totalprogramcount'));
		if(isset($_GET['totalprogramcount']))
			$this->totalprogramcount->setValue($_GET['totalprogramcount']);

		/******** timeperprogram ********/
		$this->sortby->addOption($this->Data['programestimation']->getTableFieldID('timeperprogram'),$this->getFieldCaption('timeperprogram'));
		if(isset($_GET['timeperprogram']))
			$this->timeperprogram->setValue($_GET['timeperprogram']);

		/******** is_haslegalproblem ********/
		$this->sortby->addOption($this->Data['programestimation']->getTableFieldID('is_haslegalproblem'),$this->getFieldCaption('is_haslegalproblem'));
		if(isset($_GET['is_haslegalproblem']))
			$this->is_haslegalproblem->setSelectedValue($_GET['is_haslegalproblem']);

		/******** approval_date_from ********/

		/******** approval_date_to ********/
		$this->sortby->addOption($this->Data['programestimation']->getTableFieldID('approval_date'),$this->getFieldCaption('approval_date'));

		/******** end_date_from ********/

		/******** end_date_to ********/
		$this->sortby->addOption($this->Data['programestimation']->getTableFieldID('end_date'),$this->getFieldCaption('end_date'));

		/******** add_date_from ********/

		/******** add_date_to ********/
		$this->sortby->addOption($this->Data['programestimation']->getTableFieldID('add_date'),$this->getFieldCaption('add_date'));

		/******** producer_employee_fid ********/
		$this->sortby->addOption($this->Data['programestimation']->getTableFieldID('producer_employee_fid'),$this->getFieldCaption('producer_employee_fid'));
		if(isset($_GET['producer_employee_fid']))
			$this->producer_employee_fid->setSelectedValue($_GET['producer_employee_fid']);

		/******** executor_employee_fid ********/
		$this->sortby->addOption($this->Data['programestimation']->getTableFieldID('executor_employee_fid'),$this->getFieldCaption('executor_employee_fid'));
		if(isset($_GET['executor_employee_fid']))
			$this->executor_employee_fid->setSelectedValue($_GET['executor_employee_fid']);

		/******** paycenter_fid ********/
		$this->sortby->addOption($this->Data['programestimation']->getTableFieldID('paycenter_fid'),$this->getFieldCaption('paycenter_fid'));
		if(isset($_GET['paycenter_fid']))
			$this->paycenter_fid->setSelectedValue($_GET['paycenter_fid']);

		/******** makergroup_paycenter_fid ********/
		$this->sortby->addOption($this->Data['programestimation']->getTableFieldID('makergroup_paycenter_fid'),$this->getFieldCaption('makergroup_paycenter_fid'));
		if(isset($_GET['makergroup_paycenter_fid']))
			$this->makergroup_paycenter_fid->setSelectedValue($_GET['makergroup_paycenter_fid']);

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

		/******* department_fid *******/
		$this->department_fid= new combobox("department_fid");
		$this->department_fid->setClass("form-control");

		/******* class_fid *******/
		$this->class_fid= new combobox("class_fid");
		$this->class_fid->setClass("form-control");

		/******* programmaketype_fid *******/
		$this->programmaketype_fid= new combobox("programmaketype_fid");
		$this->programmaketype_fid->setClass("form-control");

		/******* totalprogramcount *******/
		$this->totalprogramcount= new textbox("totalprogramcount");
		$this->totalprogramcount->setClass("form-control");

		/******* timeperprogram *******/
		$this->timeperprogram= new textbox("timeperprogram");
		$this->timeperprogram->setClass("form-control");

		/******* is_haslegalproblem *******/
		$this->is_haslegalproblem= new combobox("is_haslegalproblem");
		$this->is_haslegalproblem->setClass("form-control");

		/******* approval_date_from *******/
		$this->approval_date_from= new DatePicker("approval_date_from");
		$this->approval_date_from->setClass("form-control");

		/******* approval_date_to *******/
		$this->approval_date_to= new DatePicker("approval_date_to");
		$this->approval_date_to->setClass("form-control");

		/******* end_date_from *******/
		$this->end_date_from= new DatePicker("end_date_from");
		$this->end_date_from->setClass("form-control");

		/******* end_date_to *******/
		$this->end_date_to= new DatePicker("end_date_to");
		$this->end_date_to->setClass("form-control");

		/******* add_date_from *******/
		$this->add_date_from= new DatePicker("add_date_from");
		$this->add_date_from->setClass("form-control");

		/******* add_date_to *******/
		$this->add_date_to= new DatePicker("add_date_to");
		$this->add_date_to->setClass("form-control");

		/******* producer_employee_fid *******/
		$this->producer_employee_fid= new combobox("producer_employee_fid");
		$this->producer_employee_fid->setClass("form-control");

		/******* executor_employee_fid *******/
		$this->executor_employee_fid= new combobox("executor_employee_fid");
		$this->executor_employee_fid->setClass("form-control");

		/******* paycenter_fid *******/
		$this->paycenter_fid= new combobox("paycenter_fid");
		$this->paycenter_fid->setClass("form-control");

		/******* makergroup_paycenter_fid *******/
		$this->makergroup_paycenter_fid= new combobox("makergroup_paycenter_fid");
		$this->makergroup_paycenter_fid->setClass("form-control");

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