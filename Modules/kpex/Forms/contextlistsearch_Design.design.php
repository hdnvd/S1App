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
class contextlistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var textbox */
	private $url;
	/**
	 * @return textbox
	 */
	public function getUrl()
	{
		return $this->url;
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
	private $content;
	/**
	 * @return textbox
	 */
	public function getContent()
	{
		return $this->content;
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

		/******* url *******/
		$this->url= new textbox("url");
		$this->url->setClass("form-control");

		/******* title *******/
		$this->title= new textbox("title");
		$this->title->setClass("form-control");

		/******* content *******/
		$this->content= new textbox("content");
		$this->content->setClass("form-control");

		/******* words *******/
		$this->words= new textbox("words");
		$this->words->setClass("form-control");

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
		$Page->setId("kpex_contextlist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['context']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->url,$this->getFieldCaption('url'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->content,$this->getFieldCaption('content'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->words,$this->getFieldCaption('words'),null,'',null));
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
		if (key_exists("context", $this->Data)){

			/******** url ********/
			$this->url->setValue($this->Data['context']->getUrl());
			$this->setFieldCaption('url',$this->Data['context']->getFieldInfo('url')->getTitle());

			/******** title ********/
			$this->title->setValue($this->Data['context']->getTitle());
			$this->setFieldCaption('title',$this->Data['context']->getFieldInfo('title')->getTitle());

			/******** content ********/
			$this->content->setValue($this->Data['context']->getContent());
			$this->setFieldCaption('content',$this->Data['context']->getFieldInfo('content')->getTitle());

			/******** words ********/
			$this->words->setValue($this->Data['context']->getWords());
			$this->setFieldCaption('words',$this->Data['context']->getFieldInfo('words')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** url ********/
		$this->sortby->addOption($this->Data['context']->getTableFieldID('url'),$this->getFieldCaption('url'));
		if(isset($_GET['url']))
			$this->url->setValue($_GET['url']);

		/******** title ********/
		$this->sortby->addOption($this->Data['context']->getTableFieldID('title'),$this->getFieldCaption('title'));
		if(isset($_GET['title']))
			$this->title->setValue($_GET['title']);

		/******** content ********/
		$this->sortby->addOption($this->Data['context']->getTableFieldID('content'),$this->getFieldCaption('content'));
		if(isset($_GET['content']))
			$this->content->setValue($_GET['content']);

		/******** words ********/
		$this->sortby->addOption($this->Data['context']->getTableFieldID('words'),$this->getFieldCaption('words'));
		if(isset($_GET['words']))
			$this->words->setValue($_GET['words']);

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