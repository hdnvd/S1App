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
class managepaycenter_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("iribfinance_managepaycenter");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['paycenter']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->chapter,$this->getFieldCaption('chapter'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->accountingcode,$this->getFieldCaption('accountingcode'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
		if (key_exists("paycenter", $this->Data)){

			/******** title ********/
			$this->title->setValue($this->Data['paycenter']->getTitle());
			$this->setFieldCaption('title',$this->Data['paycenter']->getFieldInfo('title')->getTitle());
			$this->title->setFieldInfo($this->Data['paycenter']->getFieldInfo('title'));

			/******** chapter ********/
			$this->chapter->setValue($this->Data['paycenter']->getChapter());
			$this->setFieldCaption('chapter',$this->Data['paycenter']->getFieldInfo('chapter')->getTitle());
			$this->chapter->setFieldInfo($this->Data['paycenter']->getFieldInfo('chapter'));

			/******** accountingcode ********/
			$this->accountingcode->setValue($this->Data['paycenter']->getAccountingcode());
			$this->setFieldCaption('accountingcode',$this->Data['paycenter']->getFieldInfo('accountingcode')->getTitle());
			$this->accountingcode->setFieldInfo($this->Data['paycenter']->getFieldInfo('accountingcode'));

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* title *******/
		$this->title= new textbox("title");
		$this->title->setClass("form-control");

		/******* chapter *******/
		$this->chapter= new textbox("chapter");
		$this->chapter->setClass("form-control");

		/******* accountingcode *******/
		$this->accountingcode= new textbox("accountingcode");
		$this->accountingcode->setClass("form-control");

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
	/** @var textbox */
	private $title;
	/**
	 * @return textbox
	 */
	public function getTitle()
	{
		return $this->title;
	}
	/** @var textbox */
	private $chapter;
	/**
	 * @return textbox
	 */
	public function getChapter()
	{
		return $this->chapter;
	}
	/** @var textbox */
	private $accountingcode;
	/**
	 * @return textbox
	 */
	public function getAccountingcode()
	{
		return $this->accountingcode;
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