<?php
namespace Modules\fileshop\Forms;
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
*@creationDate 1396-09-09 - 2017-11-30 16:35
*@lastUpdate 1396-09-09 - 2017-11-30 16:35
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managefiletransaction_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("fileshop_managefiletransaction");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['filetransaction']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->file_fid,$this->getFieldCaption('file_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->finance_bankpaymentinfo_fid,$this->getFieldCaption('finance_bankpaymentinfo_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
		foreach ($this->Data['file_fid'] as $item)
			$this->file_fid->addOption($item->getID(), $item->getTitleField());
		foreach ($this->Data['finance_bankpaymentinfo_fid'] as $item)
			$this->finance_bankpaymentinfo_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("filetransaction", $this->Data)){

			/******** file_fid ********/
			$this->file_fid->setSelectedValue($this->Data['filetransaction']->getFile_fid());
			$this->setFieldCaption('file_fid',$this->Data['filetransaction']->getFieldInfo('file_fid')->getTitle());

			/******** finance_bankpaymentinfo_fid ********/
			$this->finance_bankpaymentinfo_fid->setSelectedValue($this->Data['filetransaction']->getFinance_bankpaymentinfo_fid());
			$this->setFieldCaption('finance_bankpaymentinfo_fid',$this->Data['filetransaction']->getFieldInfo('finance_bankpaymentinfo_fid')->getTitle());

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* file_fid *******/
		$this->file_fid= new combobox("file_fid");
		$this->file_fid->setClass("form-control");

		/******* finance_bankpaymentinfo_fid *******/
		$this->finance_bankpaymentinfo_fid= new combobox("finance_bankpaymentinfo_fid");
		$this->finance_bankpaymentinfo_fid->setClass("form-control");

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
	private $file_fid;
	/**
	 * @return combobox
	 */
	public function getFile_fid()
	{
		return $this->file_fid;
	}
	/** @var combobox */
	private $finance_bankpaymentinfo_fid;
	/**
	 * @return combobox
	 */
	public function getFinance_bankpaymentinfo_fid()
	{
		return $this->finance_bankpaymentinfo_fid;
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