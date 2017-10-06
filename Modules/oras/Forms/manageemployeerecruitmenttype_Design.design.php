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
*@creationDate 1396-07-10 - 2017-10-02 23:05
*@lastUpdate 1396-07-10 - 2017-10-02 23:05
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class manageemployeerecruitmenttype_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("oras_manageemployeerecruitmenttype");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['employeerecruitmenttype']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
        $LTable1->addElement($this->getFieldRowCode($this->EmployeeName,"کارمند",'',null,null));
		$LTable1->addElement($this->getFieldRowCode($this->recruitmenttype_fid,$this->getFieldCaption('recruitmenttype_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->start_date,$this->getFieldCaption('start_date'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->end_date,$this->getFieldCaption('end_date'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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

			/******** recruitmenttype_fid ********/
		foreach ($this->Data['recruitmenttype_fid'] as $item)
			$this->recruitmenttype_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("employeerecruitmenttype", $this->Data)){
			$this->recruitmenttype_fid->setSelectedValue($this->Data['employeerecruitmenttype']->getRecruitmenttype_fid());
			$this->setFieldCaption('recruitmenttype_fid',$this->Data['employeerecruitmenttype']->getFieldInfo('recruitmenttype_fid')->getTitle());
		}

			/******** start_date ********/
		if (key_exists("employeerecruitmenttype", $this->Data)){
			$this->start_date->setTime($this->Data['employeerecruitmenttype']->getStart_date());
			$this->setFieldCaption('start_date',$this->Data['employeerecruitmenttype']->getFieldInfo('start_date')->getTitle());
			$this->start_date->setFieldInfo($this->Data['employeerecruitmenttype']->getFieldInfo('start_date'));
		}

			/******** end_date ********/
		if (key_exists("employeerecruitmenttype", $this->Data)){
			$this->end_date->setTime($this->Data['employeerecruitmenttype']->getEnd_date());
			$this->setFieldCaption('end_date',$this->Data['employeerecruitmenttype']->getFieldInfo('end_date')->getTitle());
			$this->end_date->setFieldInfo($this->Data['employeerecruitmenttype']->getFieldInfo('end_date'));
		}

        /******* EmployeeName *******/
        if (key_exists("employee", $this->Data)){
            $this->EmployeeName->setValue($this->Data['employee']->getName() ." " .$this->Data['employee']->getFamily());
            $this->setFieldCaption('employee',"نام و نام خانوادگی");
        }


			/******** btnSave ********/
	}
	public function __construct()
	{
		parent::__construct();


        /******* EmployeeName *******/
        $this->EmployeeName= new TextBox("");
        $this->EmployeeName->setReadonly(true);

		/******* recruitmenttype_fid *******/
		$this->recruitmenttype_fid= new combobox("recruitmenttype_fid");
		$this->recruitmenttype_fid->setClass("form-control");

		/******* start_date *******/
		$this->start_date= new DatePicker("start_date");
		$this->start_date->setClass("form-control");

		/******* end_date *******/
		$this->end_date= new DatePicker("end_date");
		$this->end_date->setClass("form-control");

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

    /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
    }

    /** @var TextBox */
    private $EmployeeName;
	/** @var combobox */
	private $recruitmenttype_fid;
	/**
	 * @return combobox
	 */
	public function getRecruitmenttype_fid()
	{
		return $this->recruitmenttype_fid;
	}
	/** @var DatePicker */
	private $start_date;
	/**
	 * @return DatePicker
	 */
	public function getStart_date()
	{
		return $this->start_date;
	}
	/** @var DatePicker */
	private $end_date;
	/**
	 * @return DatePicker
	 */
	public function getEnd_date()
	{
		return $this->end_date;
	}
	/** @var SweetButton */
	private $btnSave;
}
?>