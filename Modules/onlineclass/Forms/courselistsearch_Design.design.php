<?php
namespace Modules\onlineclass\Forms;
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
*@creationDate 1396-07-25 - 2017-10-17 21:18
*@lastUpdate 1396-07-25 - 2017-10-17 21:18
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class courselistsearch_Design extends FormDesign {
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
	/** @var DatePicker */
	private $start_date_from;
	/**
	 * @return DatePicker
	 */
	public function getStart_date_from()
	{
		return $this->start_date_from;
	}
	/** @var DatePicker */
	private $start_date_to;
	/**
	 * @return DatePicker
	 */
	public function getStart_date_to()
	{
		return $this->start_date_to;
	}
	/** @var DatePicker */
	private $end_date_from;
	/**
	 * @return DatePicker
	 */
	public function getEnd_date_from()
	{
		return $this->end_date_from;
	}
	/** @var DatePicker */
	private $end_date_to;
	/**
	 * @return DatePicker
	 */
	public function getEnd_date_to()
	{
		return $this->end_date_to;
	}
	/** @var combobox */
	private $tutor_fid;
	/**
	 * @return combobox
	 */
	public function getTutor_fid()
	{
		return $this->tutor_fid;
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
	private $description;
	/**
	 * @return textbox
	 */
	public function getDescription()
	{
		return $this->description;
	}
	/** @var combobox */
	private $level_fid;
	/**
	 * @return combobox
	 */
	public function getLevel_fid()
	{
		return $this->level_fid;
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

		/******* start_date_from *******/
		$this->start_date_from= new DatePicker("start_date_from");
		$this->start_date_from->setClass("form-control");

		/******* start_date_to *******/
		$this->start_date_to= new DatePicker("start_date_to");
		$this->start_date_to->setClass("form-control");

		/******* end_date_from *******/
		$this->end_date_from= new DatePicker("end_date_from");
		$this->end_date_from->setClass("form-control");

		/******* end_date_to *******/
		$this->end_date_to= new DatePicker("end_date_to");
		$this->end_date_to->setClass("form-control");

		/******* tutor_fid *******/
		$this->tutor_fid= new combobox("tutor_fid");
		$this->tutor_fid->setClass("form-control");

		/******* price *******/
		$this->price= new textbox("price");
		$this->price->setClass("form-control");

		/******* description *******/
		$this->description= new textbox("description");
		$this->description->setClass("form-control");

		/******* level_fid *******/
		$this->level_fid= new combobox("level_fid");
		$this->level_fid->setClass("form-control");

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
		$Page->setId("onlineclass_courselist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['course']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->start_date_from,$this->getFieldCaption('start_date_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->start_date_to,$this->getFieldCaption('start_date_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->end_date_from,$this->getFieldCaption('end_date_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->end_date_to,$this->getFieldCaption('end_date_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->tutor_fid,$this->getFieldCaption('tutor_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->price,$this->getFieldCaption('price'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->description,$this->getFieldCaption('description'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->level_fid,$this->getFieldCaption('level_fid'),null,'',null));
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
		if (key_exists("course", $this->Data)){
			$this->title->setValue($this->Data['course']->getTitle());
			$this->setFieldCaption('title',$this->Data['course']->getFieldInfo('title')->getTitle());
		}

			/******** start_date_from ********/
		if (key_exists("course", $this->Data)){
			$this->start_date_from->setTime($this->Data['course']->getStart_date_from());
			$this->setFieldCaption('start_date_from',$this->Data['course']->getFieldInfo('start_date_from')->getTitle());
		}

			/******** start_date_to ********/
		if (key_exists("course", $this->Data)){
			$this->start_date_to->setTime($this->Data['course']->getStart_date_to());
			$this->setFieldCaption('start_date_to',$this->Data['course']->getFieldInfo('start_date_to')->getTitle());
			$this->setFieldCaption('start_date',$this->Data['course']->getFieldInfo('start_date')->getTitle());
		}

			/******** end_date_from ********/
		if (key_exists("course", $this->Data)){
			$this->end_date_from->setTime($this->Data['course']->getEnd_date_from());
			$this->setFieldCaption('end_date_from',$this->Data['course']->getFieldInfo('end_date_from')->getTitle());
		}

			/******** end_date_to ********/
		if (key_exists("course", $this->Data)){
			$this->end_date_to->setTime($this->Data['course']->getEnd_date_to());
			$this->setFieldCaption('end_date_to',$this->Data['course']->getFieldInfo('end_date_to')->getTitle());
			$this->setFieldCaption('end_date',$this->Data['course']->getFieldInfo('end_date')->getTitle());
		}

			/******** tutor_fid ********/
			$this->tutor_fid->addOption("", "مهم نیست");
		foreach ($this->Data['tutor_fid'] as $item)
			$this->tutor_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("course", $this->Data)){
			$this->tutor_fid->setSelectedValue($this->Data['course']->getTutor_fid());
			$this->setFieldCaption('tutor_fid',$this->Data['course']->getFieldInfo('tutor_fid')->getTitle());
		}

			/******** price ********/
		if (key_exists("course", $this->Data)){
			$this->price->setValue($this->Data['course']->getPrice());
			$this->setFieldCaption('price',$this->Data['course']->getFieldInfo('price')->getTitle());
		}

			/******** description ********/
		if (key_exists("course", $this->Data)){
			$this->description->setValue($this->Data['course']->getDescription());
			$this->setFieldCaption('description',$this->Data['course']->getFieldInfo('description')->getTitle());
		}

			/******** level_fid ********/
			$this->level_fid->addOption("", "مهم نیست");
		foreach ($this->Data['level_fid'] as $item)
			$this->level_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("course", $this->Data)){
			$this->level_fid->setSelectedValue($this->Data['course']->getLevel_fid());
			$this->setFieldCaption('level_fid',$this->Data['course']->getFieldInfo('level_fid')->getTitle());
		}

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** title ********/
		$this->sortby->addOption($this->Data['course']->getTableFieldID('title'),$this->getFieldCaption('title'));
		if(isset($_GET['title']))
			$this->title->setValue($_GET['title']);

		/******** start_date_from ********/

		/******** start_date_to ********/
		$this->sortby->addOption($this->Data['course']->getTableFieldID('start_date'),$this->getFieldCaption('start_date'));

		/******** end_date_from ********/

		/******** end_date_to ********/
		$this->sortby->addOption($this->Data['course']->getTableFieldID('end_date'),$this->getFieldCaption('end_date'));

		/******** tutor_fid ********/
		$this->sortby->addOption($this->Data['course']->getTableFieldID('tutor_fid'),$this->getFieldCaption('tutor_fid'));
		if(isset($_GET['tutor_fid']))
			$this->tutor_fid->setSelectedValue($_GET['tutor_fid']);

		/******** price ********/
		$this->sortby->addOption($this->Data['course']->getTableFieldID('price'),$this->getFieldCaption('price'));
		if(isset($_GET['price']))
			$this->price->setValue($_GET['price']);

		/******** description ********/
		$this->sortby->addOption($this->Data['course']->getTableFieldID('description'),$this->getFieldCaption('description'));
		if(isset($_GET['description']))
			$this->description->setValue($_GET['description']);

		/******** level_fid ********/
		$this->sortby->addOption($this->Data['course']->getTableFieldID('level_fid'),$this->getFieldCaption('level_fid'));
		if(isset($_GET['level_fid']))
			$this->level_fid->setSelectedValue($_GET['level_fid']);

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