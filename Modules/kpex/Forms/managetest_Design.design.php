<?php
namespace Modules\kpex\Forms;
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
*@creationDate 1397-06-17 - 2018-09-08 05:13
*@lastUpdate 1397-06-17 - 2018-09-08 05:13
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
		$LTable1->addElement($this->getFieldRowCode($this->similarity_threshold,$this->getFieldCaption('similarity_threshold'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->similarity_influence,$this->getFieldCaption('similarity_influence'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->resultcount,$this->getFieldCaption('resultcount'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->context_fid,$this->getFieldCaption('context_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->description,$this->getFieldCaption('description'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->words,$this->getFieldCaption('words'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->is_postaged,$this->getFieldCaption('is_postaged'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->is_similarityedgeweighed,$this->getFieldCaption('is_similarityedgeweighed'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->method_fid,$this->getFieldCaption('method_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->apprate,$this->getFieldCaption('apprate'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->precisionrate,$this->getFieldCaption('precisionrate'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->recall,$this->getFieldCaption('recall'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->fscore,$this->getFieldCaption('fscore'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
		foreach ($this->Data['context_fid'] as $item)
			$this->context_fid->addOption($item->getID(), $item->getTitleField());
			$this->is_postaged->addOption(1,'بله');
			$this->is_postaged->addOption(0,'خیر');
			$this->is_similarityedgeweighed->addOption(1,'بله');
			$this->is_similarityedgeweighed->addOption(0,'خیر');
		foreach ($this->Data['method_fid'] as $item)
			$this->method_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("test", $this->Data)){

			/******** nouninfluence ********/
			$this->nouninfluence->setValue($this->Data['test']->getNouninfluence());
			$this->setFieldCaption('nouninfluence',$this->Data['test']->getFieldInfo('nouninfluence')->getTitle());
			$this->nouninfluence->setFieldInfo($this->Data['test']->getFieldInfo('nouninfluence'));

			/******** nounoutinfluence ********/
			$this->nounoutinfluence->setValue($this->Data['test']->getNounoutinfluence());
			$this->setFieldCaption('nounoutinfluence',$this->Data['test']->getFieldInfo('nounoutinfluence')->getTitle());
			$this->nounoutinfluence->setFieldInfo($this->Data['test']->getFieldInfo('nounoutinfluence'));

			/******** adjectiveinfluence ********/
			$this->adjectiveinfluence->setValue($this->Data['test']->getAdjectiveinfluence());
			$this->setFieldCaption('adjectiveinfluence',$this->Data['test']->getFieldInfo('adjectiveinfluence')->getTitle());
			$this->adjectiveinfluence->setFieldInfo($this->Data['test']->getFieldInfo('adjectiveinfluence'));

			/******** adjectiveoutinfluence ********/
			$this->adjectiveoutinfluence->setValue($this->Data['test']->getAdjectiveoutinfluence());
			$this->setFieldCaption('adjectiveoutinfluence',$this->Data['test']->getFieldInfo('adjectiveoutinfluence')->getTitle());
			$this->adjectiveoutinfluence->setFieldInfo($this->Data['test']->getFieldInfo('adjectiveoutinfluence'));

			/******** similarity_threshold ********/
			$this->similarity_threshold->setValue($this->Data['test']->getSimilarity_threshold());
			$this->setFieldCaption('similarity_threshold',$this->Data['test']->getFieldInfo('similarity_threshold')->getTitle());
			$this->similarity_threshold->setFieldInfo($this->Data['test']->getFieldInfo('similarity_threshold'));

			/******** similarity_influence ********/
			$this->similarity_influence->setValue($this->Data['test']->getSimilarity_influence());
			$this->setFieldCaption('similarity_influence',$this->Data['test']->getFieldInfo('similarity_influence')->getTitle());
			$this->similarity_influence->setFieldInfo($this->Data['test']->getFieldInfo('similarity_influence'));

			/******** resultcount ********/
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
			$this->words->setFieldInfo($this->Data['test']->getFieldInfo('words'));

			/******** is_postaged ********/
			$this->is_postaged->setSelectedValue($this->Data['test']->getIs_postaged());
			$this->setFieldCaption('is_postaged',$this->Data['test']->getFieldInfo('is_postaged')->getTitle());

			/******** is_similarityedgeweighed ********/
			$this->is_similarityedgeweighed->setSelectedValue($this->Data['test']->getIs_similarityedgeweighed());
			$this->setFieldCaption('is_similarityedgeweighed',$this->Data['test']->getFieldInfo('is_similarityedgeweighed')->getTitle());

			/******** method_fid ********/
			$this->method_fid->setSelectedValue($this->Data['test']->getMethod_fid());
			$this->setFieldCaption('method_fid',$this->Data['test']->getFieldInfo('method_fid')->getTitle());

			/******** apprate ********/
			$this->apprate->setValue($this->Data['test']->getApprate());
			$this->setFieldCaption('apprate',$this->Data['test']->getFieldInfo('apprate')->getTitle());
			$this->apprate->setFieldInfo($this->Data['test']->getFieldInfo('apprate'));

			/******** precisionrate ********/
			$this->precisionrate->setValue($this->Data['test']->getPrecisionrate());
			$this->setFieldCaption('precisionrate',$this->Data['test']->getFieldInfo('precisionrate')->getTitle());
			$this->precisionrate->setFieldInfo($this->Data['test']->getFieldInfo('precisionrate'));

			/******** recall ********/
			$this->recall->setValue($this->Data['test']->getRecall());
			$this->setFieldCaption('recall',$this->Data['test']->getFieldInfo('recall')->getTitle());
			$this->recall->setFieldInfo($this->Data['test']->getFieldInfo('recall'));

			/******** fscore ********/
			$this->fscore->setValue($this->Data['test']->getFscore());
			$this->setFieldCaption('fscore',$this->Data['test']->getFieldInfo('fscore')->getTitle());
			$this->fscore->setFieldInfo($this->Data['test']->getFieldInfo('fscore'));

			/******** btnSave ********/
		}

        if($this->Data['test']->getNouninfluence()=="")
        {

            $this->nouninfluence->setValue("1");
            $this->nounoutinfluence->setValue("1");
            $this->adjectiveinfluence->setValue("1");
            $this->adjectiveoutinfluence->setValue("1");
            $this->similarity_threshold->setValue("1000");
            $this->similarity_influence->setValue("0");
            $this->resultcount->setValue("10");
            $this->apprate->setValue("0");
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

		/******* similarity_threshold *******/
		$this->similarity_threshold= new textbox("similarity_threshold");
		$this->similarity_threshold->setClass("form-control");

		/******* similarity_influence *******/
		$this->similarity_influence= new textbox("similarity_influence");
		$this->similarity_influence->setClass("form-control");

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
		$this->words= new textbox("words");
		$this->words->setClass("form-control");

		/******* is_postaged *******/
		$this->is_postaged= new combobox("is_postaged");
		$this->is_postaged->setClass("form-control selectpicker");

		/******* is_similarityedgeweighed *******/
		$this->is_similarityedgeweighed= new combobox("is_similarityedgeweighed");
		$this->is_similarityedgeweighed->setClass("form-control selectpicker");

		/******* method_fid *******/
		$this->method_fid= new combobox("method_fid");
		$this->method_fid->setClass("form-control selectpicker");
		$this->method_fid->SetAttribute("data-live-search",true);

		/******* apprate *******/
		$this->apprate= new textbox("apprate");
		$this->apprate->setClass("form-control");

		/******* precisionrate *******/
		$this->precisionrate= new textbox("precisionrate");
		$this->precisionrate->setClass("form-control");

		/******* recall *******/
		$this->recall= new textbox("recall");
		$this->recall->setClass("form-control");

		/******* fscore *******/
		$this->fscore= new textbox("fscore");
		$this->fscore->setClass("form-control");

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
	private $similarity_threshold;
	/**
	 * @return textbox
	 */
	public function getSimilarity_threshold()
	{
		return $this->similarity_threshold;
	}
	/** @var textbox */
	private $similarity_influence;
	/**
	 * @return textbox
	 */
	public function getSimilarity_influence()
	{
		return $this->similarity_influence;
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
	/** @var textbox */
	private $words;
	/**
	 * @return textbox
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
	private $is_similarityedgeweighed;
	/**
	 * @return combobox
	 */
	public function getIs_similarityedgeweighed()
	{
		return $this->is_similarityedgeweighed;
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
	/** @var textbox */
	private $apprate;
	/**
	 * @return textbox
	 */
	public function getApprate()
	{
		return $this->apprate;
	}
	/** @var textbox */
	private $precisionrate;
	/**
	 * @return textbox
	 */
	public function getPrecisionrate()
	{
		return $this->precisionrate;
	}
	/** @var textbox */
	private $recall;
	/**
	 * @return textbox
	 */
	public function getRecall()
	{
		return $this->recall;
	}
	/** @var textbox */
	private $fscore;
	/**
	 * @return textbox
	 */
	public function getFscore()
	{
		return $this->fscore;
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