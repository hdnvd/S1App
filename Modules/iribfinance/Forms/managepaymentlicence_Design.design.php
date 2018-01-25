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
*@creationDate 1396-11-05 - 2018-01-25 18:15
*@lastUpdate 1396-11-05 - 2018-01-25 18:15
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managepaymentlicence_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("iribfinance_managepaymentlicence");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['paymentlicence']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->programestimationemployee_fid,$this->getFieldCaption('programestimationemployee_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->month,$this->getFieldCaption('month'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->pay_date,$this->getFieldCaption('pay_date'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->work,$this->getFieldCaption('work'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->decrementtime,$this->getFieldCaption('decrementtime'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->workfactor,$this->getFieldCaption('workfactor'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
		foreach ($this->Data['programestimationemployee_fid'] as $item)
			$this->programestimationemployee_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("paymentlicence", $this->Data)){

			/******** programestimationemployee_fid ********/
			$this->programestimationemployee_fid->setSelectedValue($this->Data['paymentlicence']->getProgramestimationemployee_fid());
			$this->setFieldCaption('programestimationemployee_fid',$this->Data['paymentlicence']->getFieldInfo('programestimationemployee_fid')->getTitle());

			/******** month ********/
			$this->month->setValue($this->Data['paymentlicence']->getMonth());
			$this->setFieldCaption('month',$this->Data['paymentlicence']->getFieldInfo('month')->getTitle());
			$this->month->setFieldInfo($this->Data['paymentlicence']->getFieldInfo('month'));

			/******** pay_date ********/
			$this->pay_date->setTime($this->Data['paymentlicence']->getPay_date());
			$this->setFieldCaption('pay_date',$this->Data['paymentlicence']->getFieldInfo('pay_date')->getTitle());
			$this->pay_date->setFieldInfo($this->Data['paymentlicence']->getFieldInfo('pay_date'));

			/******** work ********/
			$this->work->setValue($this->Data['paymentlicence']->getWork());
			$this->setFieldCaption('work',$this->Data['paymentlicence']->getFieldInfo('work')->getTitle());
			$this->work->setFieldInfo($this->Data['paymentlicence']->getFieldInfo('work'));

			/******** decrementtime ********/
			$this->decrementtime->setValue($this->Data['paymentlicence']->getDecrementtime());
			$this->setFieldCaption('decrementtime',$this->Data['paymentlicence']->getFieldInfo('decrementtime')->getTitle());
			$this->decrementtime->setFieldInfo($this->Data['paymentlicence']->getFieldInfo('decrementtime'));

			/******** workfactor ********/
			$this->workfactor->setValue($this->Data['paymentlicence']->getWorkfactor());
			$this->setFieldCaption('workfactor',$this->Data['paymentlicence']->getFieldInfo('workfactor')->getTitle());
			$this->workfactor->setFieldInfo($this->Data['paymentlicence']->getFieldInfo('workfactor'));

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* programestimationemployee_fid *******/
		$this->programestimationemployee_fid= new combobox("programestimationemployee_fid");
		$this->programestimationemployee_fid->setClass("form-control");

		/******* month *******/
		$this->month= new textbox("month");
		$this->month->setClass("form-control");

		/******* pay_date *******/
		$this->pay_date= new DatePicker("pay_date");
		$this->pay_date->setClass("form-control");

		/******* work *******/
		$this->work= new textbox("work");
		$this->work->setClass("form-control");

		/******* decrementtime *******/
		$this->decrementtime= new textbox("decrementtime");
		$this->decrementtime->setClass("form-control");

		/******* workfactor *******/
		$this->workfactor= new textbox("workfactor");
		$this->workfactor->setClass("form-control");

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
	private $programestimationemployee_fid;
	/**
	 * @return combobox
	 */
	public function getProgramestimationemployee_fid()
	{
		return $this->programestimationemployee_fid;
	}
	/** @var textbox */
	private $month;
	/**
	 * @return textbox
	 */
	public function getMonth()
	{
		return $this->month;
	}
	/** @var DatePicker */
	private $pay_date;
	/**
	 * @return DatePicker
	 */
	public function getPay_date()
	{
		return $this->pay_date;
	}
	/** @var textbox */
	private $work;
	/**
	 * @return textbox
	 */
	public function getWork()
	{
		return $this->work;
	}
	/** @var textbox */
	private $decrementtime;
	/**
	 * @return textbox
	 */
	public function getDecrementtime()
	{
		return $this->decrementtime;
	}
	/** @var textbox */
	private $workfactor;
	/**
	 * @return textbox
	 */
	public function getWorkfactor()
	{
		return $this->workfactor;
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