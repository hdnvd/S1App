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
*@creationDate 1396-11-05 - 2018-01-25 19:04
*@lastUpdate 1396-11-05 - 2018-01-25 19:04
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageprosperityfund_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("iribfinance_manageprosperityfund");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['prosperityfund']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->employee_fid,$this->getFieldCaption('employee_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->totalamount,$this->getFieldCaption('totalamount'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->add_date,$this->getFieldCaption('add_date'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->monthcount,$this->getFieldCaption('monthcount'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->amountpermonth,$this->getFieldCaption('amountpermonth'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->isactive,$this->getFieldCaption('isactive'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
			$this->employee_fid->addOption($item->getID(), $item->getTitleField());
			$this->isactive->addOption(1,'بله');
			$this->isactive->addOption(0,'خیر');
		if (key_exists("prosperityfund", $this->Data)){

			/******** employee_fid ********/
			$this->employee_fid->setSelectedValue($this->Data['prosperityfund']->getEmployee_fid());
			$this->setFieldCaption('employee_fid',$this->Data['prosperityfund']->getFieldInfo('employee_fid')->getTitle());

			/******** totalamount ********/
			$this->totalamount->setValue($this->Data['prosperityfund']->getTotalamount());
			$this->setFieldCaption('totalamount',$this->Data['prosperityfund']->getFieldInfo('totalamount')->getTitle());
			$this->totalamount->setFieldInfo($this->Data['prosperityfund']->getFieldInfo('totalamount'));

			/******** add_date ********/
			$this->add_date->setTime($this->Data['prosperityfund']->getAdd_date());
			$this->setFieldCaption('add_date',$this->Data['prosperityfund']->getFieldInfo('add_date')->getTitle());
			$this->add_date->setFieldInfo($this->Data['prosperityfund']->getFieldInfo('add_date'));

			/******** monthcount ********/
			$this->monthcount->setValue($this->Data['prosperityfund']->getMonthcount());
			$this->setFieldCaption('monthcount',$this->Data['prosperityfund']->getFieldInfo('monthcount')->getTitle());
			$this->monthcount->setFieldInfo($this->Data['prosperityfund']->getFieldInfo('monthcount'));

			/******** amountpermonth ********/
			$this->amountpermonth->setValue($this->Data['prosperityfund']->getAmountpermonth());
			$this->setFieldCaption('amountpermonth',$this->Data['prosperityfund']->getFieldInfo('amountpermonth')->getTitle());
			$this->amountpermonth->setFieldInfo($this->Data['prosperityfund']->getFieldInfo('amountpermonth'));

			/******** isactive ********/
			$this->isactive->setSelectedValue($this->Data['prosperityfund']->getIsactive());
			$this->setFieldCaption('isactive',$this->Data['prosperityfund']->getFieldInfo('isactive')->getTitle());

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* employee_fid *******/
		$this->employee_fid= new combobox("employee_fid");
		$this->employee_fid->setClass("form-control");

		/******* totalamount *******/
		$this->totalamount= new textbox("totalamount");
		$this->totalamount->setClass("form-control");

		/******* add_date *******/
		$this->add_date= new DatePicker("add_date");
		$this->add_date->setClass("form-control");

		/******* monthcount *******/
		$this->monthcount= new textbox("monthcount");
		$this->monthcount->setClass("form-control");

		/******* amountpermonth *******/
		$this->amountpermonth= new textbox("amountpermonth");
		$this->amountpermonth->setClass("form-control");

		/******* isactive *******/
		$this->isactive= new combobox("isactive");
		$this->isactive->setClass("form-control");

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
	/** @var textbox */
	private $totalamount;
	/**
	 * @return textbox
	 */
	public function getTotalamount()
	{
		return $this->totalamount;
	}
	/** @var DatePicker */
	private $add_date;
	/**
	 * @return DatePicker
	 */
	public function getAdd_date()
	{
		return $this->add_date;
	}
	/** @var textbox */
	private $monthcount;
	/**
	 * @return textbox
	 */
	public function getMonthcount()
	{
		return $this->monthcount;
	}
	/** @var textbox */
	private $amountpermonth;
	/**
	 * @return textbox
	 */
	public function getAmountpermonth()
	{
		return $this->amountpermonth;
	}
	/** @var combobox */
	private $isactive;
	/**
	 * @return combobox
	 */
	public function getIsactive()
	{
		return $this->isactive;
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