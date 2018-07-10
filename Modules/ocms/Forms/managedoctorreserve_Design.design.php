<?php
namespace Modules\ocms\Forms;
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
*@creationDate 1396-09-23 - 2017-12-14 01:18
*@lastUpdate 1396-09-23 - 2017-12-14 01:18
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managedoctorreserve_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("ocms_managedoctorreserve");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['doctorreserve']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->doctorplan_fid,$this->getFieldCaption('doctorplan_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->financial_transaction_fid,$this->getFieldCaption('financial_transaction_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->presencetype_fid,$this->getFieldCaption('presencetype_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->reserve_date,$this->getFieldCaption('reserve_date'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
		foreach ($this->Data['doctorplan_fid'] as $item)
			$this->doctorplan_fid->addOption($item->getID(), $item->getTitleField());
		foreach ($this->Data['financial_transaction_fid'] as $item)
			$this->financial_transaction_fid->addOption($item->getID(), $item->getTitleField());
		foreach ($this->Data['presencetype_fid'] as $item)
			$this->presencetype_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("doctorreserve", $this->Data)){

			/******** doctorplan_fid ********/
			$this->doctorplan_fid->setSelectedValue($this->Data['doctorreserve']->getDoctorplan_fid());
			$this->setFieldCaption('doctorplan_fid',$this->Data['doctorreserve']->getFieldInfo('doctorplan_fid')->getTitle());

			/******** financial_transaction_fid ********/
			$this->financial_transaction_fid->setSelectedValue($this->Data['doctorreserve']->getFinancial_transaction_fid());
			$this->setFieldCaption('financial_transaction_fid',$this->Data['doctorreserve']->getFieldInfo('financial_transaction_fid')->getTitle());

			/******** presencetype_fid ********/
			$this->presencetype_fid->setSelectedValue($this->Data['doctorreserve']->getPresencetype_fid());
			$this->setFieldCaption('presencetype_fid',$this->Data['doctorreserve']->getFieldInfo('presencetype_fid')->getTitle());

			/******** reserve_date ********/
			$this->reserve_date->setTime($this->Data['doctorreserve']->getReserve_date());
			$this->setFieldCaption('reserve_date',$this->Data['doctorreserve']->getFieldInfo('reserve_date')->getTitle());
			$this->reserve_date->setFieldInfo($this->Data['doctorreserve']->getFieldInfo('reserve_date'));

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* doctorplan_fid *******/
		$this->doctorplan_fid= new combobox("doctorplan_fid");
		$this->doctorplan_fid->setClass("form-control");

		/******* financial_transaction_fid *******/
		$this->financial_transaction_fid= new combobox("financial_transaction_fid");
		$this->financial_transaction_fid->setClass("form-control");

		/******* presencetype_fid *******/
		$this->presencetype_fid= new combobox("presencetype_fid");
		$this->presencetype_fid->setClass("form-control");

		/******* reserve_date *******/
		$this->reserve_date= new DatePicker("reserve_date");
		$this->reserve_date->setClass("form-control");

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
	private $doctorplan_fid;
	/**
	 * @return combobox
	 */
	public function getDoctorplan_fid()
	{
		return $this->doctorplan_fid;
	}
	/** @var combobox */
	private $financial_transaction_fid;
	/**
	 * @return combobox
	 */
	public function getFinancial_transaction_fid()
	{
		return $this->financial_transaction_fid;
	}
	/** @var combobox */
	private $presencetype_fid;
	/**
	 * @return combobox
	 */
	public function getPresencetype_fid()
	{
		return $this->presencetype_fid;
	}
	/** @var DatePicker */
	private $reserve_date;
	/**
	 * @return DatePicker
	 */
	public function getReserve_date()
	{
		return $this->reserve_date;
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