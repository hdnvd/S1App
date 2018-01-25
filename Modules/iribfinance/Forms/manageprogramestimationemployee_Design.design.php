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
*@creationDate 1396-11-05 - 2018-01-25 20:01
*@lastUpdate 1396-11-05 - 2018-01-25 20:01
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageprogramestimationemployee_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("iribfinance_manageprogramestimationemployee");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['programestimationemployee']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->employee_fid,$this->getFieldCaption('employee_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->activity_fid,$this->getFieldCaption('activity_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->programestimation_fid,$this->getFieldCaption('programestimation_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->employmenttype_fid,$this->getFieldCaption('employmenttype_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->totalwork,$this->getFieldCaption('totalwork'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->workunit_fid,$this->getFieldCaption('workunit_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
		foreach ($this->Data['employee_fid'] as $item)
			$this->employee_fid->addOption($item->getID(), $item->getName() . " " . $item->getFamily());
		foreach ($this->Data['activity_fid'] as $item)
			$this->activity_fid->addOption($item->getID(), $item->getTitleField());
		foreach ($this->Data['programestimation_fid'] as $item)
			$this->programestimation_fid->addOption($item->getID(), $item->getTitleField());
		$this->programestimation_fid->getSelectedID($_GET['estimationid']);

		foreach ($this->Data['employmenttype_fid'] as $item)
			$this->employmenttype_fid->addOption($item->getID(), $item->getTitleField());
		foreach ($this->Data['workunit_fid'] as $item)
			$this->workunit_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("programestimationemployee", $this->Data)){

			/******** employee_fid ********/
			$this->employee_fid->setSelectedValue($this->Data['programestimationemployee']->getEmployee_fid());
			$this->setFieldCaption('employee_fid',$this->Data['programestimationemployee']->getFieldInfo('employee_fid')->getTitle());

			/******** activity_fid ********/
			$this->activity_fid->setSelectedValue($this->Data['programestimationemployee']->getActivity_fid());
			$this->setFieldCaption('activity_fid',$this->Data['programestimationemployee']->getFieldInfo('activity_fid')->getTitle());

			/******** programestimation_fid ********/
			$this->programestimation_fid->setSelectedValue($this->Data['programestimationemployee']->getProgramestimation_fid());
			$this->setFieldCaption('programestimation_fid',$this->Data['programestimationemployee']->getFieldInfo('programestimation_fid')->getTitle());

			/******** employmenttype_fid ********/
			$this->employmenttype_fid->setSelectedValue($this->Data['programestimationemployee']->getEmploymenttype_fid());
			$this->setFieldCaption('employmenttype_fid',$this->Data['programestimationemployee']->getFieldInfo('employmenttype_fid')->getTitle());

			/******** totalwork ********/
			$this->totalwork->setValue($this->Data['programestimationemployee']->getTotalwork());
			$this->setFieldCaption('totalwork',$this->Data['programestimationemployee']->getFieldInfo('totalwork')->getTitle());
			$this->totalwork->setFieldInfo($this->Data['programestimationemployee']->getFieldInfo('totalwork'));

			/******** workunit_fid ********/
			$this->workunit_fid->setSelectedValue($this->Data['programestimationemployee']->getWorkunit_fid());
			$this->setFieldCaption('workunit_fid',$this->Data['programestimationemployee']->getFieldInfo('workunit_fid')->getTitle());

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* employee_fid *******/
		$this->employee_fid= new combobox("employee_fid");
		$this->employee_fid->setClass("form-control");

		/******* activity_fid *******/
		$this->activity_fid= new combobox("activity_fid");
		$this->activity_fid->setClass("form-control");

		/******* programestimation_fid *******/
		$this->programestimation_fid= new combobox("programestimation_fid");
		$this->programestimation_fid->setClass("form-control");

		/******* employmenttype_fid *******/
		$this->employmenttype_fid= new combobox("employmenttype_fid");
		$this->employmenttype_fid->setClass("form-control");

		/******* totalwork *******/
		$this->totalwork= new textbox("totalwork");
		$this->totalwork->setClass("form-control");

		/******* workunit_fid *******/
		$this->workunit_fid= new combobox("workunit_fid");
		$this->workunit_fid->setClass("form-control");

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
	private $employee_fid;
	/**
	 * @return combobox
	 */
	public function getEmployee_fid()
	{
		return $this->employee_fid;
	}
	/** @var combobox */
	private $activity_fid;
	/**
	 * @return combobox
	 */
	public function getActivity_fid()
	{
		return $this->activity_fid;
	}
	/** @var combobox */
	private $programestimation_fid;
	/**
	 * @return combobox
	 */
	public function getProgramestimation_fid()
	{
		return $this->programestimation_fid;
	}
	/** @var combobox */
	private $employmenttype_fid;
	/**
	 * @return combobox
	 */
	public function getEmploymenttype_fid()
	{
		return $this->employmenttype_fid;
	}
	/** @var textbox */
	private $totalwork;
	/**
	 * @return textbox
	 */
	public function getTotalwork()
	{
		return $this->totalwork;
	}
	/** @var combobox */
	private $workunit_fid;
	/**
	 * @return combobox
	 */
	public function getWorkunit_fid()
	{
		return $this->workunit_fid;
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