<?php
namespace Modules\eshop\Forms;
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
*@creationDate 1396-08-28 - 2017-11-19 00:39
*@lastUpdate 1396-08-28 - 2017-11-19 00:39
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class productlistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
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
	private $latintitle;
	/**
	 * @return textbox
	 */
	public function getLatintitle()
	{
		return $this->latintitle;
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
	private $price;
	/**
	 * @return textbox
	 */
	public function getPrice()
	{
		return $this->price;
	}
	/** @var textbox */
	private $code;
	/**
	 * @return textbox
	 */
	public function getCode()
	{
		return $this->code;
	}
	/** @var textbox */
	private $adddate;
	/**
	 * @return textbox
	 */
	public function getAdddate()
	{
		return $this->adddate;
	}
	/** @var textbox */
	private $visitcount;
	/**
	 * @return textbox
	 */
	public function getVisitcount()
	{
		return $this->visitcount;
	}
	/** @var combobox */
	private $is_exists;
	/**
	 * @return combobox
	 */
	public function getIs_exists()
	{
		return $this->is_exists;
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

		/******* title *******/
		$this->title= new textbox("title");
		$this->title->setClass("form-control");

		/******* latintitle *******/
		$this->latintitle= new textbox("latintitle");
		$this->latintitle->setClass("form-control");

		/******* description *******/
		$this->description= new textbox("description");
		$this->description->setClass("form-control");

		/******* price *******/
		$this->price= new textbox("price");
		$this->price->setClass("form-control");

		/******* code *******/
		$this->code= new textbox("code");
		$this->code->setClass("form-control");

		/******* adddate *******/
		$this->adddate= new textbox("adddate");
		$this->adddate->setClass("form-control");

		/******* visitcount *******/
		$this->visitcount= new textbox("visitcount");
		$this->visitcount->setClass("form-control");

		/******* is_exists *******/
		$this->is_exists= new combobox("is_exists");
		$this->is_exists->setClass("form-control");

		/******* sortby *******/
		$this->sortby= new combobox("sortby");
		$this->sortby->setClass("form-control");

		/******* isdesc *******/
		$this->isdesc= new combobox("isdesc");
		$this->isdesc->setClass("form-control");

		/******* search *******/
		$this->search= new SweetButton(true,"جستجو");
		$this->search->setAction("search");
		$this->search->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
		$this->search->setClass("btn btn-primary");

		/******* Color *******/
		$this->Colors= new  CheckBox('color[]');
	}
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("eshop_productlist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['product']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->latintitle,$this->getFieldCaption('latintitle'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->description,$this->getFieldCaption('description'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->price,$this->getFieldCaption('price'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->code,$this->getFieldCaption('code'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->adddate,$this->getFieldCaption('adddate'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->visitcount,$this->getFieldCaption('visitcount'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->is_exists,$this->getFieldCaption('is_exists'),null,'',null));
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
			$this->is_exists->addOption("", "مهم نیست");
			$this->is_exists->addOption(1,'بله');
			$this->is_exists->addOption(0,'خیر');
		if (key_exists("product", $this->Data)){

			/******** title ********/
			$this->title->setValue($this->Data['product']->getTitle());
			$this->setFieldCaption('title',$this->Data['product']->getFieldInfo('title')->getTitle());

			/******** latintitle ********/
			$this->latintitle->setValue($this->Data['product']->getLatintitle());
			$this->setFieldCaption('latintitle',$this->Data['product']->getFieldInfo('latintitle')->getTitle());

			/******** description ********/
			$this->description->setValue($this->Data['product']->getDescription());
			$this->setFieldCaption('description',$this->Data['product']->getFieldInfo('description')->getTitle());

			/******** price ********/
			$this->price->setValue($this->Data['product']->getPrice());
			$this->setFieldCaption('price',$this->Data['product']->getFieldInfo('price')->getTitle());

			/******** code ********/
			$this->code->setValue($this->Data['product']->getCode());
			$this->setFieldCaption('code',$this->Data['product']->getFieldInfo('code')->getTitle());

			/******** adddate ********/
			$this->adddate->setValue($this->Data['product']->getAdddate());
			$this->setFieldCaption('adddate',$this->Data['product']->getFieldInfo('adddate')->getTitle());

			/******** visitcount ********/
			$this->visitcount->setValue($this->Data['product']->getVisitcount());
			$this->setFieldCaption('visitcount',$this->Data['product']->getFieldInfo('visitcount')->getTitle());

			/******** is_exists ********/
			$this->is_exists->setSelectedValue($this->Data['product']->getIs_exists());
			$this->setFieldCaption('is_exists',$this->Data['product']->getFieldInfo('is_exists')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** title ********/
		$this->sortby->addOption($this->Data['product']->getTableFieldID('title'),$this->getFieldCaption('title'));
		if(isset($_GET['title']))
			$this->title->setValue($_GET['title']);

		/******** latintitle ********/
		$this->sortby->addOption($this->Data['product']->getTableFieldID('latintitle'),$this->getFieldCaption('latintitle'));
		if(isset($_GET['latintitle']))
			$this->latintitle->setValue($_GET['latintitle']);

		/******** description ********/
		$this->sortby->addOption($this->Data['product']->getTableFieldID('description'),$this->getFieldCaption('description'));
		if(isset($_GET['description']))
			$this->description->setValue($_GET['description']);

		/******** price ********/
		$this->sortby->addOption($this->Data['product']->getTableFieldID('price'),$this->getFieldCaption('price'));
		if(isset($_GET['price']))
			$this->price->setValue($_GET['price']);

		/******** code ********/
		$this->sortby->addOption($this->Data['product']->getTableFieldID('code'),$this->getFieldCaption('code'));
		if(isset($_GET['code']))
			$this->code->setValue($_GET['code']);

		/******** adddate ********/
		$this->sortby->addOption($this->Data['product']->getTableFieldID('adddate'),$this->getFieldCaption('adddate'));
		if(isset($_GET['adddate']))
			$this->adddate->setValue($_GET['adddate']);

		/******** visitcount ********/
		$this->sortby->addOption($this->Data['product']->getTableFieldID('visitcount'),$this->getFieldCaption('visitcount'));
		if(isset($_GET['visitcount']))
			$this->visitcount->setValue($_GET['visitcount']);

		/******** is_exists ********/
		$this->sortby->addOption($this->Data['product']->getTableFieldID('is_exists'),$this->getFieldCaption('is_exists'));
		if(isset($_GET['is_exists']))
			$this->is_exists->setSelectedValue($_GET['is_exists']);

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