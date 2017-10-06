<?php
namespace Modules\oras\Forms;
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
*@creationDate 1396-07-12 - 2017-10-04 03:02
*@lastUpdate 1396-07-12 - 2017-10-04 03:02
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class recordtypelistsearch_Design extends FormDesign {
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
	private $points;
	/**
	 * @return textbox
	 */
	public function getPoints()
	{
		return $this->points;
	}
	/** @var combobox */
	private $isbad;
	/**
	 * @return combobox
	 */
	public function getIsbad()
	{
		return $this->isbad;
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

		/******* points *******/
		$this->points= new textbox("points");
		$this->points->setClass("form-control");

		/******* isbad *******/
		$this->isbad= new combobox("isbad");
		$this->isbad->setClass("form-control");

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
	}
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("oras_recordtypelist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['recordtype']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->points,$this->getFieldCaption('points'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->isbad,$this->getFieldCaption('isbad'),null,'',null));
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

			/******** title ********/
		if (key_exists("recordtype", $this->Data)){
			$this->title->setValue($this->Data['recordtype']->getTitle());
			$this->setFieldCaption('title',$this->Data['recordtype']->getFieldInfo('title')->getTitle());
		}

			/******** points ********/
		if (key_exists("recordtype", $this->Data)){
			$this->points->setValue($this->Data['recordtype']->getPoints());
			$this->setFieldCaption('points',$this->Data['recordtype']->getFieldInfo('points')->getTitle());
		}

			/******** isbad ********/
			$this->isbad->addOption("", "مهم نیست");
			$this->isbad->addOption(1,'بله');
			$this->isbad->addOption(0,'خیر');
		if (key_exists("recordtype", $this->Data)){
			$this->isbad->setSelectedValue($this->Data['recordtype']->getIsbad());
			$this->setFieldCaption('isbad',$this->Data['recordtype']->getFieldInfo('isbad')->getTitle());
		}

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** title ********/
		$this->sortby->addOption($this->Data['recordtype']->getTableFieldID('title'),$this->getFieldCaption('title'));
		if(isset($_GET['title']))
			$this->title->setValue($_GET['title']);

		/******** points ********/
		$this->sortby->addOption($this->Data['recordtype']->getTableFieldID('points'),$this->getFieldCaption('points'));
		if(isset($_GET['points']))
			$this->points->setValue($_GET['points']);

		/******** isbad ********/
		$this->sortby->addOption($this->Data['recordtype']->getTableFieldID('isbad'),$this->getFieldCaption('isbad'));
		if(isset($_GET['isbad']))
			$this->isbad->setSelectedValue($_GET['isbad']);

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