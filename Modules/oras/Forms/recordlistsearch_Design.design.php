<?php
namespace Modules\oras\Forms;
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
*@creationDate 1396-07-12 - 2017-10-04 22:10
*@lastUpdate 1396-07-12 - 2017-10-04 22:10
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class recordlistsearch_Design extends FormDesign {
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
	/** @var DatePicker */
	private $occurance_date_from;
	/**
	 * @return DatePicker
	 */
	public function getOccurance_date_from()
	{
		return $this->occurance_date_from;
	}
	/** @var DatePicker */
	private $occurance_date_to;
	/**
	 * @return DatePicker
	 */
	public function getOccurance_date_to()
	{
		return $this->occurance_date_to;
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
	private $shifttype_fid;
	/**
	 * @return combobox
	 */
	public function getShifttype_fid()
	{
		return $this->shifttype_fid;
	}
	/** @var combobox */
	private $recordtype_fid;
	/**
	 * @return combobox
	 */
	public function getRecordtype_fid()
	{
		return $this->recordtype_fid;
	}
    /** @var combobox */
    private $recordtypeisbad;
    /**
     * @return combobox
     */
    public function getRecordtypeisbad()
    {
        return $this->recordtypeisbad;
    }
	/** @var TextBox */
	private $employeemellicode;
	/**
	 * @return TextBox
	 */
	public function getEmployeemellicode()
	{
		return $this->employeemellicode;
	}
	/** @var combobox */
	private $place_fid;
	/**
	 * @return combobox
	 */
	public function getPlace_fid()
	{
		return $this->place_fid;
	}
    /** @var combobox */
    private $role_fid;
    /**
     * @return combobox
     */
    public function role_fid()
    {
        return $this->role_fid;
    }

    /** @var combobox */
    private $ResultType;
    /**
     * @return combobox
     */
    public function getResultType()
    {
        return $this->ResultType;
    }

	/** @var DatePicker */
	private $registration_time_from;
	/**
	 * @return DatePicker
	 */
	public function getRegistration_time_from()
	{
		return $this->registration_time_from;
	}
	/** @var DatePicker */
	private $registration_time_to;
	/**
	 * @return DatePicker
	 */
	public function getRegistration_time_to()
	{
		return $this->registration_time_to;
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

		/******* occurance_date_from *******/
		$this->occurance_date_from= new DatePicker("occurance_date_from");
		$this->occurance_date_from->setClass("form-control");

		/******* occurance_date_to *******/
		$this->occurance_date_to= new DatePicker("occurance_date_to");
		$this->occurance_date_to->setClass("form-control");

		/******* description *******/
		$this->description= new textbox("description");
		$this->description->setClass("form-control");

		/******* shifttype_fid *******/
		$this->shifttype_fid= new combobox("shifttype_fid");
		$this->shifttype_fid->setClass("form-control");

        /******* ResultType *******/
        $this->ResultType= new ComboBox("resulttype");
        $this->ResultType->setClass("form-control");

		/******* recordtype_fid *******/
		$this->recordtype_fid= new combobox("recordtype_fid");
		$this->recordtype_fid->setClass("form-control");

        /******* recordtypeisbad *******/
        $this->recordtypeisbad= new combobox("recordtypeisbad");
        $this->recordtypeisbad->setClass("form-control");

		/******* employeemellicode *******/
		$this->employeemellicode= new TextBox("employeemellicode");
		$this->employeemellicode->setClass("form-control");

		/******* place_fid *******/
		$this->place_fid= new combobox("place_fid");
		$this->place_fid->setClass("form-control");

        /******* role_fid *******/
        $this->role_fid= new combobox("role_fid");
        $this->role_fid->setClass("form-control");

		/******* registration_time_from *******/
		$this->registration_time_from= new DatePicker("registration_time_from");
		$this->registration_time_from->setClass("form-control");

		/******* registration_time_to *******/
		$this->registration_time_to= new DatePicker("registration_time_to");
		$this->registration_time_to->setClass("form-control");

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
		$Page->setId("oras_recordlist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['record']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->occurance_date_from,$this->getFieldCaption('occurance_date_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->occurance_date_to,$this->getFieldCaption('occurance_date_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->description,$this->getFieldCaption('description'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->shifttype_fid,$this->getFieldCaption('shifttype_fid'),null,'',null));
        $LTable1->addElement($this->getFieldRowCode($this->recordtypeisbad,$this->getFieldCaption('recordtypeisbad'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->recordtype_fid,$this->getFieldCaption('recordtype_fid'),null,'',null));
		if(isset($_GET['employeemellicode']))
		    $LTable1->addElement($this->getFieldRowCode($this->employeemellicode,$this->getFieldCaption('employeemellicode'),null,'',null));
        if(isset($_GET['place_fid']))
            $LTable1->addElement($this->getFieldRowCode($this->place_fid,$this->getFieldCaption('place_fid'),null,'',null));
        $LTable1->addElement($this->getFieldRowCode($this->role_fid,$this->getFieldCaption('role_fid'),null,'',null));

        $LTable1->addElement($this->getFieldRowCode($this->registration_time_from,$this->getFieldCaption('registration_time_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->registration_time_to,$this->getFieldCaption('registration_time_to'),null,'',null));
        $LTable1->addElement($this->getFieldRowCode($this->ResultType,$this->getFieldCaption('resulttype'),null,'',null));
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

        /******** ResultType ********/
            $this->ResultType->addOption("0","همه");
        $this->ResultType->addOption("1","گزارشات مربوط به فرد");
        $this->ResultType->addOption("2","گزارشات مربوط به بخش");
        $this->ResultType->setSelectedValue("0");
            $this->setFieldCaption('resulttype',"نتایج");
        if(isset($_GET['employeemellicode']))
            $this->ResultType->SetAttribute("disabled","disabled");

			/******** title ********/
		if (key_exists("record", $this->Data)){
			$this->title->setValue($this->Data['record']->getTitle());
			$this->setFieldCaption('title',$this->Data['record']->getFieldInfo('title')->getTitle());
		}

			/******** occurance_date_from ********/
        $this->occurance_date_from->setTime(689400000);

        if (key_exists("record", $this->Data)){
//			$this->occurance_date_from->setTime($this->Data['record']->getOccurance_date_from());
			$this->setFieldCaption('occurance_date_from',$this->Data['record']->getFieldInfo('occurance_date_from')->getTitle());
		}

			/******** occurance_date_to ********/
        $this->occurance_date_to->setTime(time()+200000);

        if (key_exists("record", $this->Data)){
//			$this->occurance_date_to->setTime($this->Data['record']->getOccurance_date_to());
			$this->setFieldCaption('occurance_date_to',$this->Data['record']->getFieldInfo('occurance_date_to')->getTitle());
			$this->setFieldCaption('occurance_date',$this->Data['record']->getFieldInfo('occurance_date')->getTitle());
		}

			/******** description ********/
		if (key_exists("record", $this->Data)){
			$this->description->setValue($this->Data['record']->getDescription());
			$this->setFieldCaption('description',$this->Data['record']->getFieldInfo('description')->getTitle());
		}

			/******** shifttype_fid ********/
			$this->shifttype_fid->addOption("", "مهم نیست");
		foreach ($this->Data['shifttype_fid'] as $item)
			$this->shifttype_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("record", $this->Data)){
			$this->shifttype_fid->setSelectedValue($this->Data['record']->getShifttype_fid());
			$this->setFieldCaption('shifttype_fid',$this->Data['record']->getFieldInfo('shifttype_fid')->getTitle());
		}

        /******** recordtypeisbad ********/
        $this->recordtypeisbad->addOption(-1, "مهم نیست");
        $this->recordtypeisbad->addOption(2, "کسور");
        $this->recordtypeisbad->addOption(1, "تشویقی");
        $this->setFieldCaption('recordtypeisbad',"نوع گزارش");

			/******** recordtype_fid ********/
			$this->recordtype_fid->addOption(0, "مهم نیست");
		foreach ($this->Data['recordtype_fid'] as $item)
			$this->recordtype_fid->addGroupedOption($item->getIsbad()+1,$item->getID(), $item->getTitleField());
		$this->recordtype_fid->setDefaultOption("مهم نیست");
        $this->recordtype_fid->setMotherComboboxName($this->recordtypeisbad->getName());
        $this->recordtype_fid->setMotherComboboxAutoLoadMode(ComboBox::$AUTOLOADMODE_ONPAGE);
        $this->setFieldCaption('recordtype_fid',$this->Data['record']->getFieldInfo('recordtype_fid')->getTitle());




        /******** employeemellicode ********/
        $this->setFieldCaption('employeemellicode',"کد ملی کارمند");
		if (isset($_GET['employeemellicode'])){
			$this->employeemellicode->setValue($_GET['employeemellicode']);
		}

			/******** place_fid ********/
			$this->place_fid->addOption("", "مهم نیست");
		foreach ($this->Data['place_fid'] as $item)
			$this->place_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("record", $this->Data)){
			$this->place_fid->setSelectedValue($this->Data['record']->getPlace_fid());
			$this->setFieldCaption('place_fid',$this->Data['record']->getFieldInfo('place_fid')->getTitle());
		}

        /******** role_fid ********/
        $this->role_fid->addOption("", "مهم نیست");
        foreach ($this->Data['role_fid'] as $item)
            $this->role_fid->addOption($item->getID(), $item->getTitleField());
        if (key_exists("record", $this->Data)){
            $this->role_fid->setSelectedValue($this->Data['record']->getRole_fid());
            $this->setFieldCaption('role_fid',$this->Data['record']->getFieldInfo('role_fid')->getTitle());
        }

			/******** registration_time_from ********/
        $this->registration_time_from->setTime(689400000);

        if (key_exists("record", $this->Data)){
//			$this->registration_time_from->setTime($this->Data['record']->getRegistration_time_from());
			$this->setFieldCaption('registration_time_from',$this->Data['record']->getFieldInfo('registration_time_from')->getTitle());
		}

			/******** registration_time_to ********/
        $this->registration_time_to->setTime(time()+200000);

        if (key_exists("record", $this->Data)){
			$this->setFieldCaption('registration_time_to',$this->Data['record']->getFieldInfo('registration_time_to')->getTitle());
			$this->setFieldCaption('registration_time',$this->Data['record']->getFieldInfo('registration_time')->getTitle());
		}

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** title ********/
		$this->sortby->addOption($this->Data['record']->getTableFieldID('title'),$this->getFieldCaption('title'));
		if(isset($_GET['title']))
			$this->title->setValue($_GET['title']);

		/******** occurance_date_from ********/

		/******** occurance_date_to ********/
		$this->sortby->addOption($this->Data['record']->getTableFieldID('occurance_date'),$this->getFieldCaption('occurance_date'));

		/******** description ********/
		$this->sortby->addOption($this->Data['record']->getTableFieldID('description'),$this->getFieldCaption('description'));
		if(isset($_GET['description']))
			$this->description->setValue($_GET['description']);

		/******** shifttype_fid ********/
		$this->sortby->addOption($this->Data['record']->getTableFieldID('shifttype_fid'),$this->getFieldCaption('shifttype_fid'));
		if(isset($_GET['shifttype_fid']))
			$this->shifttype_fid->setSelectedValue($_GET['shifttype_fid']);

		/******** recordtype_fid ********/
		$this->sortby->addOption($this->Data['record']->getTableFieldID('recordtype_fid'),$this->getFieldCaption('recordtype_fid'));
		if(isset($_GET['recordtype_fid']))
			$this->recordtype_fid->setSelectedValue($_GET['recordtype_fid']);

		/******** employeemellicode ********/
        if(!isset($_GET['place_fid']))
		    $this->sortby->addOption($this->Data['record']->getTableFieldID('employeemellicode'),$this->getFieldCaption('employeemellicode'));
		if(isset($_GET['employeemellicode']))
			$this->employeemellicode->setValue($_GET['employeemellicode']);

		/******** place_fid ********/
        if(!isset($_GET['employeemellicode']))
            $this->sortby->addOption($this->Data['record']->getTableFieldID('place_fid'),$this->getFieldCaption('place_fid'));
		if(isset($_GET['place_fid']))
			$this->place_fid->setSelectedValue($_GET['place_fid']);

        /******** place_fid ********/
        if(!isset($_GET['employeemellicode']))
            $this->sortby->addOption($this->Data['record']->getTableFieldID('role_fid'),$this->getFieldCaption('role_fid'));
        if(isset($_GET['role_fid']))
            $this->role_fid->setSelectedValue($_GET['role_fid']);

		/******** registration_time_from ********/

		/******** registration_time_to ********/
		$this->sortby->addOption($this->Data['record']->getTableFieldID('registration_time'),$this->getFieldCaption('registration_time'));

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