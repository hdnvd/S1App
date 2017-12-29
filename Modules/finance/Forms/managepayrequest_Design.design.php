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
*@creationDate 1396-09-08 - 2017-11-29 15:33
*@lastUpdate 1396-09-08 - 2017-11-29 15:33
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managepayrequest_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("finance_managepayrequest");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['payrequest']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->request_date,$this->getFieldCaption('request_date'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->price,$this->getFieldCaption('price'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->commit_date,$this->getFieldCaption('commit_date'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->committype_fid,$this->getFieldCaption('committype_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
		foreach ($this->Data['committype_fid'] as $item)
			$this->committype_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("payrequest", $this->Data)){

			/******** request_date ********/
			$this->request_date->setTime($this->Data['payrequest']->getRequest_date());
			$this->setFieldCaption('request_date',$this->Data['payrequest']->getFieldInfo('request_date')->getTitle());
			$this->request_date->setFieldInfo($this->Data['payrequest']->getFieldInfo('request_date'));

			/******** price ********/
			$this->price->setValue($this->Data['payrequest']->getPrice());
			$this->setFieldCaption('price',$this->Data['payrequest']->getFieldInfo('price')->getTitle());
			$this->price->setFieldInfo($this->Data['payrequest']->getFieldInfo('price'));

			/******** commit_date ********/
			$this->commit_date->setTime($this->Data['payrequest']->getCommit_date());
			$this->setFieldCaption('commit_date',$this->Data['payrequest']->getFieldInfo('commit_date')->getTitle());
			$this->commit_date->setFieldInfo($this->Data['payrequest']->getFieldInfo('commit_date'));

			/******** committype_fid ********/
			$this->committype_fid->setSelectedValue($this->Data['payrequest']->getCommittype_fid());
			$this->setFieldCaption('committype_fid',$this->Data['payrequest']->getFieldInfo('committype_fid')->getTitle());

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* request_date *******/
		$this->request_date= new DatePicker("request_date");
		$this->request_date->setClass("form-control");

		/******* price *******/
		$this->price= new textbox("price");
		$this->price->setClass("form-control");

		/******* commit_date *******/
		$this->commit_date= new DatePicker("commit_date");
		$this->commit_date->setClass("form-control");

		/******* committype_fid *******/
		$this->committype_fid= new combobox("committype_fid");
		$this->committype_fid->setClass("form-control");

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
	/** @var DatePicker */
	private $request_date;
	/**
	 * @return DatePicker
	 */
	public function getRequest_date()
	{
		return $this->request_date;
	}
	/** @var textbox */
	private $price;
	/**
	 * @return textbox
	 */
	public function getPrice()
	{
		return $this->price;
	}
	/** @var DatePicker */
	private $commit_date;
	/**
	 * @return DatePicker
	 */
	public function getCommit_date()
	{
		return $this->commit_date;
	}
	/** @var combobox */
	private $committype_fid;
	/**
	 * @return combobox
	 */
	public function getCommittype_fid()
	{
		return $this->committype_fid;
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