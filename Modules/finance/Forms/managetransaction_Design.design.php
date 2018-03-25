<?php
namespace Modules\finance\Forms;
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
*@creationDate 1396-11-09 - 2018-01-29 11:26
*@lastUpdate 1396-11-09 - 2018-01-29 11:26
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managetransaction_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("finance_managetransaction");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['transaction']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->amount,$this->getFieldCaption('amount'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->description,$this->getFieldCaption('description'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->add_time,$this->getFieldCaption('add_time'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->commit_time,$this->getFieldCaption('commit_time'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->issuccessful,$this->getFieldCaption('issuccessful'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->chapter_fid,$this->getFieldCaption('chapter_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
			$this->issuccessful->addOption(1,'بله');
			$this->issuccessful->addOption(0,'خیر');
		foreach ($this->Data['chapter_fid'] as $item)
			$this->chapter_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("transaction", $this->Data)){

			/******** amount ********/
			$this->amount->setValue($this->Data['transaction']->getAmount());
			$this->setFieldCaption('amount',$this->Data['transaction']->getFieldInfo('amount')->getTitle());
			$this->amount->setFieldInfo($this->Data['transaction']->getFieldInfo('amount'));

			/******** description ********/
			$this->description->setValue($this->Data['transaction']->getDescription());
			$this->setFieldCaption('description',$this->Data['transaction']->getFieldInfo('description')->getTitle());
			$this->description->setFieldInfo($this->Data['transaction']->getFieldInfo('description'));

			/******** add_time ********/
			$this->add_time->setTime($this->Data['transaction']->getAdd_time());
			$this->setFieldCaption('add_time',$this->Data['transaction']->getFieldInfo('add_time')->getTitle());
			$this->add_time->setFieldInfo($this->Data['transaction']->getFieldInfo('add_time'));

			/******** commit_time ********/
			$this->commit_time->setTime($this->Data['transaction']->getCommit_time());
			$this->setFieldCaption('commit_time',$this->Data['transaction']->getFieldInfo('commit_time')->getTitle());
			$this->commit_time->setFieldInfo($this->Data['transaction']->getFieldInfo('commit_time'));

			/******** issuccessful ********/
			$this->issuccessful->setSelectedValue($this->Data['transaction']->getIssuccessful());
			$this->setFieldCaption('issuccessful',$this->Data['transaction']->getFieldInfo('issuccessful')->getTitle());

			/******** chapter_fid ********/
			$this->chapter_fid->setSelectedValue($this->Data['transaction']->getChapter_fid());
			$this->setFieldCaption('chapter_fid',$this->Data['transaction']->getFieldInfo('chapter_fid')->getTitle());

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* amount *******/
		$this->amount= new textbox("amount");
		$this->amount->setClass("form-control");

		/******* description *******/
		$this->description= new textbox("description");
		$this->description->setClass("form-control");

		/******* add_time *******/
		$this->add_time= new DatePicker("add_time");
		$this->add_time->setClass("form-control");

		/******* commit_time *******/
		$this->commit_time= new DatePicker("commit_time");
		$this->commit_time->setClass("form-control");

		/******* issuccessful *******/
		$this->issuccessful= new combobox("issuccessful");
		$this->issuccessful->setClass("form-control");

		/******* chapter_fid *******/
		$this->chapter_fid= new combobox("chapter_fid");
		$this->chapter_fid->setClass("form-control");

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
	private $amount;
	/**
	 * @return textbox
	 */
	public function getAmount()
	{
		return $this->amount;
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
	/** @var DatePicker */
	private $add_time;
	/**
	 * @return DatePicker
	 */
	public function getAdd_time()
	{
		return $this->add_time;
	}
	/** @var DatePicker */
	private $commit_time;
	/**
	 * @return DatePicker
	 */
	public function getCommit_time()
	{
		return $this->commit_time;
	}
	/** @var combobox */
	private $issuccessful;
	/**
	 * @return combobox
	 */
	public function getIssuccessful()
	{
		return $this->issuccessful;
	}
	/** @var combobox */
	private $chapter_fid;
	/**
	 * @return combobox
	 */
	public function getChapter_fid()
	{
		return $this->chapter_fid;
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