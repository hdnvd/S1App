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
class manageactivity_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("iribfinance_manageactivity");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['activity']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->paycenter_type,$this->getFieldCaption('paycenter_type'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->planingcode,$this->getFieldCaption('planingcode'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->taxtype_fid,$this->getFieldCaption('taxtype_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->alalhesab,$this->getFieldCaption('alalhesab'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
		foreach ($this->Data['taxtype_fid'] as $item)
			$this->taxtype_fid->addOption($item->getID(), $item->getTitleField());
			$this->isactive->addOption(1,'بله');
			$this->isactive->addOption(0,'خیر');
		if (key_exists("activity", $this->Data)){

			/******** title ********/
			$this->title->setValue($this->Data['activity']->getTitle());
			$this->setFieldCaption('title',$this->Data['activity']->getFieldInfo('title')->getTitle());
			$this->title->setFieldInfo($this->Data['activity']->getFieldInfo('title'));

			/******** paycenter_type ********/
			$this->paycenter_type->setValue($this->Data['activity']->getPaycenter_type());
			$this->setFieldCaption('paycenter_type',$this->Data['activity']->getFieldInfo('paycenter_type')->getTitle());
			$this->paycenter_type->setFieldInfo($this->Data['activity']->getFieldInfo('paycenter_type'));

			/******** planingcode ********/
			$this->planingcode->setValue($this->Data['activity']->getPlaningcode());
			$this->setFieldCaption('planingcode',$this->Data['activity']->getFieldInfo('planingcode')->getTitle());
			$this->planingcode->setFieldInfo($this->Data['activity']->getFieldInfo('planingcode'));

			/******** taxtype_fid ********/
			$this->taxtype_fid->setSelectedValue($this->Data['activity']->getTaxtype_fid());
			$this->setFieldCaption('taxtype_fid',$this->Data['activity']->getFieldInfo('taxtype_fid')->getTitle());

			/******** alalhesab ********/
			$this->alalhesab->setValue($this->Data['activity']->getAlalhesab());
			$this->setFieldCaption('alalhesab',$this->Data['activity']->getFieldInfo('alalhesab')->getTitle());
			$this->alalhesab->setFieldInfo($this->Data['activity']->getFieldInfo('alalhesab'));

			/******** isactive ********/
			$this->isactive->setSelectedValue($this->Data['activity']->getIsactive());
			$this->setFieldCaption('isactive',$this->Data['activity']->getFieldInfo('isactive')->getTitle());

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* title *******/
		$this->title= new textbox("title");
		$this->title->setClass("form-control");

		/******* paycenter_type *******/
		$this->paycenter_type= new textbox("paycenter_type");
		$this->paycenter_type->setClass("form-control");

		/******* planingcode *******/
		$this->planingcode= new textbox("planingcode");
		$this->planingcode->setClass("form-control");

		/******* taxtype_fid *******/
		$this->taxtype_fid= new combobox("taxtype_fid");
		$this->taxtype_fid->setClass("form-control");

		/******* alalhesab *******/
		$this->alalhesab= new textbox("alalhesab");
		$this->alalhesab->setClass("form-control");

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
	private $paycenter_type;
	/**
	 * @return textbox
	 */
	public function getPaycenter_type()
	{
		return $this->paycenter_type;
	}
	/** @var textbox */
	private $planingcode;
	/**
	 * @return textbox
	 */
	public function getPlaningcode()
	{
		return $this->planingcode;
	}
	/** @var combobox */
	private $taxtype_fid;
	/**
	 * @return combobox
	 */
	public function getTaxtype_fid()
	{
		return $this->taxtype_fid;
	}
	/** @var textbox */
	private $alalhesab;
	/**
	 * @return textbox
	 */
	public function getAlalhesab()
	{
		return $this->alalhesab;
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