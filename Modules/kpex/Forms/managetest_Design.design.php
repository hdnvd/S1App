<?php
namespace Modules\kpex\Forms;
use core\CoreClasses\html\TextArea;
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
*@creationDate 1397-03-24 - 2018-06-14 03:29
*@lastUpdate 1397-03-24 - 2018-06-14 03:29
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managetest_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("kpex_managetest");
		$Page->addElement($this->getPageTitlePart("تعریف " . $this->Data['test']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->nouninfluence,$this->getFieldCaption('nouninfluence'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->nounoutinfluence,$this->getFieldCaption('nounoutinfluence'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->adjectiveinfluence,$this->getFieldCaption('adjectiveinfluence'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->adjectiveoutinfluence,$this->getFieldCaption('adjectiveoutinfluence'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->resultcount,$this->getFieldCaption('resultcount'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->context_fid,$this->getFieldCaption('context_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->description,$this->getFieldCaption('description'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->words,$this->getFieldCaption('words'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->is_postaged,$this->getFieldCaption('is_postaged'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->method_fid,$this->getFieldCaption('method_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
        $this->nouninfluence->setValue("1");
        $this->nounoutinfluence->setValue(0.8);
        $this->adjectiveinfluence->setValue(1);
        $this->adjectiveoutinfluence->setValue(0.9);
        $this->resultcount->setValue(50);




        foreach ($this->Data['context_fid'] as $item)
			$this->context_fid->addOption($item->getID(), $item->getTitleField());
			$this->is_postaged->addOption(1,'بله');
			$this->is_postaged->addOption(0,'خیر');
		foreach ($this->Data['method_fid'] as $item)
			$this->method_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("test", $this->Data)){
			/******** nouninfluence ********/
			if($this->Data['test']->getNouninfluence()!="")
			$this->nouninfluence->setValue($this->Data['test']->getNouninfluence());
			$this->setFieldCaption('nouninfluence',$this->Data['test']->getFieldInfo('nouninfluence')->getTitle());
			$this->nouninfluence->setFieldInfo($this->Data['test']->getFieldInfo('nouninfluence'));

			/******** nounoutinfluence ********/
            if($this->Data['test']->getNounoutinfluence()!="")
			$this->nounoutinfluence->setValue($this->Data['test']->getNounoutinfluence());
			$this->setFieldCaption('nounoutinfluence',$this->Data['test']->getFieldInfo('nounoutinfluence')->getTitle());
			$this->nounoutinfluence->setFieldInfo($this->Data['test']->getFieldInfo('nounoutinfluence'));

			/******** adjectiveinfluence ********/
            if($this->Data['test']->getAdjectiveinfluence()!="")
			$this->adjectiveinfluence->setValue($this->Data['test']->getAdjectiveinfluence());
			$this->setFieldCaption('adjectiveinfluence',$this->Data['test']->getFieldInfo('adjectiveinfluence')->getTitle());
			$this->adjectiveinfluence->setFieldInfo($this->Data['test']->getFieldInfo('adjectiveinfluence'));

			/******** adjectiveoutinfluence ********/
            if($this->Data['test']->getAdjectiveoutinfluence()!="")
			$this->adjectiveoutinfluence->setValue($this->Data['test']->getAdjectiveoutinfluence());
			$this->setFieldCaption('adjectiveoutinfluence',$this->Data['test']->getFieldInfo('adjectiveoutinfluence')->getTitle());
			$this->adjectiveoutinfluence->setFieldInfo($this->Data['test']->getFieldInfo('adjectiveoutinfluence'));

			/******** resultcount ********/
            if($this->Data['test']->getResultcount()!="")
			$this->resultcount->setValue($this->Data['test']->getResultcount());
			$this->setFieldCaption('resultcount',$this->Data['test']->getFieldInfo('resultcount')->getTitle());
			$this->resultcount->setFieldInfo($this->Data['test']->getFieldInfo('resultcount'));

			/******** context_fid ********/
			$this->context_fid->setSelectedValue($this->Data['test']->getContext_fid());
			$this->setFieldCaption('context_fid',$this->Data['test']->getFieldInfo('context_fid')->getTitle());

			/******** description ********/
			$this->description->setValue($this->Data['test']->getDescription());
			$this->setFieldCaption('description',$this->Data['test']->getFieldInfo('description')->getTitle());
			$this->description->setFieldInfo($this->Data['test']->getFieldInfo('description'));

			/******** words ********/
			$this->words->setValue($this->Data['test']->getWords());
			$this->setFieldCaption('words',$this->Data['test']->getFieldInfo('words')->getTitle());
//			$this->words->setFieldInfo($this->Data['test']->getFieldInfo('words'));

			/******** is_postaged ********/
			$this->is_postaged->setSelectedValue($this->Data['test']->getIs_postaged());
			$this->setFieldCaption('is_postaged',$this->Data['test']->getFieldInfo('is_postaged')->getTitle());

			/******** method_fid ********/
			$this->method_fid->setSelectedValue($this->Data['test']->getMethod_fid());
			$this->setFieldCaption('method_fid',$this->Data['test']->getFieldInfo('method_fid')->getTitle());

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* nouninfluence *******/
		$this->nouninfluence= new textbox("nouninfluence");
		$this->nouninfluence->setClass("form-control");

		/******* nounoutinfluence *******/
		$this->nounoutinfluence= new textbox("nounoutinfluence");
		$this->nounoutinfluence->setClass("form-control");

		/******* adjectiveinfluence *******/
		$this->adjectiveinfluence= new textbox("adjectiveinfluence");
		$this->adjectiveinfluence->setClass("form-control");

		/******* adjectiveoutinfluence *******/
		$this->adjectiveoutinfluence= new textbox("adjectiveoutinfluence");
		$this->adjectiveoutinfluence->setClass("form-control");

		/******* resultcount *******/
		$this->resultcount= new textbox("resultcount");
		$this->resultcount->setClass("form-control");

		/******* context_fid *******/
		$this->context_fid= new combobox("context_fid");
		$this->context_fid->setClass("form-control selectpicker");
		$this->context_fid->SetAttribute("data-live-search",true);

		/******* description *******/
		$this->description= new textbox("description");
		$this->description->setClass("form-control");

		/******* words *******/
		$this->words= new TextArea("words");
		$this->words->setClass("form-control");

		/******* is_postaged *******/
		$this->is_postaged= new combobox("is_postaged");
		$this->is_postaged->setClass("form-control selectpicker");

		/******* method_fid *******/
		$this->method_fid= new combobox("method_fid");
		$this->method_fid->setClass("form-control selectpicker");
		$this->method_fid->SetAttribute("data-live-search",true);

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
	private $nouninfluence;
	/**
	 * @return textbox
	 */
	public function getNouninfluence()
	{
		return $this->nouninfluence;
	}
	/** @var textbox */
	private $nounoutinfluence;
	/**
	 * @return textbox
	 */
	public function getNounoutinfluence()
	{
		return $this->nounoutinfluence;
	}
	/** @var textbox */
	private $adjectiveinfluence;
	/**
	 * @return textbox
	 */
	public function getAdjectiveinfluence()
	{
		return $this->adjectiveinfluence;
	}
	/** @var textbox */
	private $adjectiveoutinfluence;
	/**
	 * @return textbox
	 */
	public function getAdjectiveoutinfluence()
	{
		return $this->adjectiveoutinfluence;
	}
	/** @var textbox */
	private $resultcount;
	/**
	 * @return textbox
	 */
	public function getResultcount()
	{
		return $this->resultcount;
	}
	/** @var combobox */
	private $context_fid;
	/**
	 * @return combobox
	 */
	public function getContext_fid()
	{
		return $this->context_fid;
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
	/** @var TextArea */
	private $words;
	/**
	 * @return TextArea
	 */
	public function getWords()
	{
		return $this->words;
	}
	/** @var combobox */
	private $is_postaged;
	/**
	 * @return combobox
	 */
	public function getIs_postaged()
	{
		return $this->is_postaged;
	}
	/** @var combobox */
	private $method_fid;
	/**
	 * @return combobox
	 */
	public function getMethod_fid()
	{
		return $this->method_fid;
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