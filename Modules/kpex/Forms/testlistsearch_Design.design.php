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
*@creationDate 1397-03-24 - 2018-06-14 03:29
*@lastUpdate 1397-03-24 - 2018-06-14 03:29
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class testlistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
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
	private $method_fid;
	/**
	 * @return combobox
	 */
	public function getMethod_fid()
	{
		return $this->method_fid;
	}
	/** @var combobox */
	private $sortby;
	/**
	 * @return combobox
	 */
	public function getSortby()
	{
		return $this->sortby;
	}
	/** @var combobox */
	private $isdesc;
	/**
	 * @return combobox
	 */
	public function getIsdesc()
	{
		return $this->isdesc;
	}
	/** @var SweetButton */
	private $search;
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
		$this->words= new textbox("words");
		$this->words->setClass("form-control");

		/******* is_postaged *******/
		$this->is_postaged= new combobox("is_postaged");
		$this->is_postaged->setClass("form-control selectpicker");

		/******* method_fid *******/
		$this->method_fid= new combobox("method_fid");
		$this->method_fid->setClass("form-control selectpicker");
		$this->method_fid->SetAttribute("data-live-search",true);

		/******* sortby *******/
		$this->sortby= new combobox("sortby");
		$this->sortby->setClass("form-control selectpicker");

		/******* isdesc *******/
		$this->isdesc= new combobox("isdesc");
		$this->isdesc->setClass("form-control selectpicker");

		/******* search *******/
		$this->search= new SweetButton(true,"جستجو");
		$this->search->setAction("search");
		$this->search->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
		$this->search->setClass("btn btn-primary");
	}
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("kpex_testlist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['test']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->nouninfluence,$this->getFieldCaption('nouninfluence'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->nounoutinfluence,$this->getFieldCaption('nounoutinfluence'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->adjectiveinfluence,$this->getFieldCaption('adjectiveinfluence'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->adjectiveoutinfluence,$this->getFieldCaption('adjectiveoutinfluence'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->resultcount,$this->getFieldCaption('resultcount'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->context_fid,$this->getFieldCaption('context_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->description,$this->getFieldCaption('description'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->words,$this->getFieldCaption('words'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->is_postaged,$this->getFieldCaption('is_postaged'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->method_fid,$this->getFieldCaption('method_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->sortby,$this->getFieldCaption('sortby'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->isdesc,$this->getFieldCaption('isdesc'),null,'',null));
		$LTable1->addElement($this->getSingleFieldRowCode($this->search));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "GET", $Page);
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
	public function FillItems()
	{
			$this->context_fid->addOption("", "مهم نیست");
		foreach ($this->Data['context_fid'] as $item)
			$this->context_fid->addOption($item->getID(), $item->getTitleField());
			$this->is_postaged->addOption("", "مهم نیست");
			$this->is_postaged->addOption(1,'بله');
			$this->is_postaged->addOption(0,'خیر');
			$this->method_fid->addOption("", "مهم نیست");
		foreach ($this->Data['method_fid'] as $item)
			$this->method_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("test", $this->Data)){

			/******** nouninfluence ********/
			$this->nouninfluence->setValue($this->Data['test']->getNouninfluence());
			$this->setFieldCaption('nouninfluence',$this->Data['test']->getFieldInfo('nouninfluence')->getTitle());

			/******** nounoutinfluence ********/
			$this->nounoutinfluence->setValue($this->Data['test']->getNounoutinfluence());
			$this->setFieldCaption('nounoutinfluence',$this->Data['test']->getFieldInfo('nounoutinfluence')->getTitle());

			/******** adjectiveinfluence ********/
			$this->adjectiveinfluence->setValue($this->Data['test']->getAdjectiveinfluence());
			$this->setFieldCaption('adjectiveinfluence',$this->Data['test']->getFieldInfo('adjectiveinfluence')->getTitle());

			/******** adjectiveoutinfluence ********/
			$this->adjectiveoutinfluence->setValue($this->Data['test']->getAdjectiveoutinfluence());
			$this->setFieldCaption('adjectiveoutinfluence',$this->Data['test']->getFieldInfo('adjectiveoutinfluence')->getTitle());

			/******** resultcount ********/
			$this->resultcount->setValue($this->Data['test']->getResultcount());
			$this->setFieldCaption('resultcount',$this->Data['test']->getFieldInfo('resultcount')->getTitle());

			/******** context_fid ********/
			$this->context_fid->setSelectedValue($this->Data['test']->getContext_fid());
			$this->setFieldCaption('context_fid',$this->Data['test']->getFieldInfo('context_fid')->getTitle());

			/******** description ********/
			$this->description->setValue($this->Data['test']->getDescription());
			$this->setFieldCaption('description',$this->Data['test']->getFieldInfo('description')->getTitle());

			/******** words ********/
			$this->words->setValue($this->Data['test']->getWords());
			$this->setFieldCaption('words',$this->Data['test']->getFieldInfo('words')->getTitle());

			/******** is_postaged ********/
			$this->is_postaged->setSelectedValue($this->Data['test']->getIs_postaged());
			$this->setFieldCaption('is_postaged',$this->Data['test']->getFieldInfo('is_postaged')->getTitle());

			/******** method_fid ********/
			$this->method_fid->setSelectedValue($this->Data['test']->getMethod_fid());
			$this->setFieldCaption('method_fid',$this->Data['test']->getFieldInfo('method_fid')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** nouninfluence ********/
		$this->sortby->addOption($this->Data['test']->getTableFieldID('nouninfluence'),$this->getFieldCaption('nouninfluence'));
		if(isset($_GET['nouninfluence']))
			$this->nouninfluence->setValue($_GET['nouninfluence']);

		/******** nounoutinfluence ********/
		$this->sortby->addOption($this->Data['test']->getTableFieldID('nounoutinfluence'),$this->getFieldCaption('nounoutinfluence'));
		if(isset($_GET['nounoutinfluence']))
			$this->nounoutinfluence->setValue($_GET['nounoutinfluence']);

		/******** adjectiveinfluence ********/
		$this->sortby->addOption($this->Data['test']->getTableFieldID('adjectiveinfluence'),$this->getFieldCaption('adjectiveinfluence'));
		if(isset($_GET['adjectiveinfluence']))
			$this->adjectiveinfluence->setValue($_GET['adjectiveinfluence']);

		/******** adjectiveoutinfluence ********/
		$this->sortby->addOption($this->Data['test']->getTableFieldID('adjectiveoutinfluence'),$this->getFieldCaption('adjectiveoutinfluence'));
		if(isset($_GET['adjectiveoutinfluence']))
			$this->adjectiveoutinfluence->setValue($_GET['adjectiveoutinfluence']);

		/******** resultcount ********/
		$this->sortby->addOption($this->Data['test']->getTableFieldID('resultcount'),$this->getFieldCaption('resultcount'));
		if(isset($_GET['resultcount']))
			$this->resultcount->setValue($_GET['resultcount']);

		/******** context_fid ********/
		$this->sortby->addOption($this->Data['test']->getTableFieldID('context_fid'),$this->getFieldCaption('context_fid'));
		if(isset($_GET['context_fid']))
			$this->context_fid->setSelectedValue($_GET['context_fid']);

		/******** description ********/
		$this->sortby->addOption($this->Data['test']->getTableFieldID('description'),$this->getFieldCaption('description'));
		if(isset($_GET['description']))
			$this->description->setValue($_GET['description']);

		/******** words ********/
		$this->sortby->addOption($this->Data['test']->getTableFieldID('words'),$this->getFieldCaption('words'));
		if(isset($_GET['words']))
			$this->words->setValue($_GET['words']);

		/******** is_postaged ********/
		$this->sortby->addOption($this->Data['test']->getTableFieldID('is_postaged'),$this->getFieldCaption('is_postaged'));
		if(isset($_GET['is_postaged']))
			$this->is_postaged->setSelectedValue($_GET['is_postaged']);

		/******** method_fid ********/
		$this->sortby->addOption($this->Data['test']->getTableFieldID('method_fid'),$this->getFieldCaption('method_fid'));
		if(isset($_GET['method_fid']))
			$this->method_fid->setSelectedValue($_GET['method_fid']);

		/******** sortby ********/
		if(isset($_GET['sortby']))
			$this->sortby->setSelectedValue($_GET['sortby']);

		/******** isdesc ********/
		if(isset($_GET['isdesc']))
			$this->isdesc->setSelectedValue($_GET['isdesc']);

		/******** search ********/
	}
}
?>