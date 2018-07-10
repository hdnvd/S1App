<?php
namespace Modules\shift\Forms;
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
*@creationDate 1396-10-27 - 2018-01-17 00:24
*@lastUpdate 1396-10-27 - 2018-01-17 00:24
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class datelistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var DatePicker */
	private $day_date_from;
	/**
	 * @return DatePicker
	 */
	public function getDay_date_from()
	{
		return $this->day_date_from;
	}
	/** @var DatePicker */
	private $day_date_to;
	/**
	 * @return DatePicker
	 */
	public function getDay_date_to()
	{
		return $this->day_date_to;
	}
	/** @var textbox */
	private $score;
	/**
	 * @return textbox
	 */
	public function getScore()
	{
		return $this->score;
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

		/******* day_date_from *******/
		$this->day_date_from= new DatePicker("day_date_from");
		$this->day_date_from->setClass("form-control");

		/******* day_date_to *******/
		$this->day_date_to= new DatePicker("day_date_to");
		$this->day_date_to->setClass("form-control");

		/******* score *******/
		$this->score= new textbox("score");
		$this->score->setClass("form-control");

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
		$Page->setId("shift_datelist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['date']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->day_date_from,$this->getFieldCaption('day_date_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->day_date_to,$this->getFieldCaption('day_date_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->score,$this->getFieldCaption('score'),null,'',null));
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
		if (key_exists("date", $this->Data)){

			/******** day_date_from ********/
			$this->day_date_from->setTime($this->Data['date']->getDay_date_from());
			$this->setFieldCaption('day_date_from',$this->Data['date']->getFieldInfo('day_date_from')->getTitle());

			/******** day_date_to ********/
			$this->day_date_to->setTime($this->Data['date']->getDay_date_to());
			$this->setFieldCaption('day_date_to',$this->Data['date']->getFieldInfo('day_date_to')->getTitle());
			$this->setFieldCaption('day_date',$this->Data['date']->getFieldInfo('day_date')->getTitle());

			/******** score ********/
			$this->score->setValue($this->Data['date']->getScore());
			$this->setFieldCaption('score',$this->Data['date']->getFieldInfo('score')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** day_date_from ********/

		/******** day_date_to ********/
		$this->sortby->addOption($this->Data['date']->getTableFieldID('day_date'),$this->getFieldCaption('day_date'));

		/******** score ********/
		$this->sortby->addOption($this->Data['date']->getTableFieldID('score'),$this->getFieldCaption('score'));
		if(isset($_GET['score']))
			$this->score->setValue($_GET['score']);

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