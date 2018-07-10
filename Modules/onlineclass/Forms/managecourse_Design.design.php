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
class managecourse_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("onlineclass_managecourse");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['course']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->start_date,$this->getFieldCaption('start_date'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->end_date,$this->getFieldCaption('end_date'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->tutor_fid,$this->getFieldCaption('tutor_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->price,$this->getFieldCaption('price'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->description,$this->getFieldCaption('description'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->level_fid,$this->getFieldCaption('level_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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

			/******** title ********/
		if (key_exists("course", $this->Data)){
			$this->title->setValue($this->Data['course']->getTitle());
			$this->setFieldCaption('title',$this->Data['course']->getFieldInfo('title')->getTitle());
			$this->title->setFieldInfo($this->Data['course']->getFieldInfo('title'));
		}

			/******** start_date ********/
		if (key_exists("course", $this->Data)){
			$this->start_date->setTime($this->Data['course']->getStart_date());
			$this->setFieldCaption('start_date',$this->Data['course']->getFieldInfo('start_date')->getTitle());
			$this->start_date->setFieldInfo($this->Data['course']->getFieldInfo('start_date'));
		}

			/******** end_date ********/
		if (key_exists("course", $this->Data)){
			$this->end_date->setTime($this->Data['course']->getEnd_date());
			$this->setFieldCaption('end_date',$this->Data['course']->getFieldInfo('end_date')->getTitle());
			$this->end_date->setFieldInfo($this->Data['course']->getFieldInfo('end_date'));
		}

			/******** tutor_fid ********/
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
			$this->price->setFieldInfo($this->Data['course']->getFieldInfo('price'));
		}

			/******** description ********/
		if (key_exists("course", $this->Data)){
			$this->description->setValue($this->Data['course']->getDescription());
			$this->setFieldCaption('description',$this->Data['course']->getFieldInfo('description')->getTitle());
			$this->description->setFieldInfo($this->Data['course']->getFieldInfo('description'));
		}

			/******** level_fid ********/
		foreach ($this->Data['level_fid'] as $item)
			$this->level_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("course", $this->Data)){
			$this->level_fid->setSelectedValue($this->Data['course']->getLevel_fid());
			$this->setFieldCaption('level_fid',$this->Data['course']->getFieldInfo('level_fid')->getTitle());
		}

			/******** btnSave ********/
	}
	public function __construct()
	{
		parent::__construct();

		/******* title *******/
		$this->title= new textbox("title");
		$this->title->setClass("form-control");

		/******* start_date *******/
		$this->start_date= new DatePicker("start_date");
		$this->start_date->setClass("form-control");

		/******* end_date *******/
		$this->end_date= new DatePicker("end_date");
		$this->end_date->setClass("form-control");

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
	/** @var DatePicker */
	private $start_date;
	/**
	 * @return DatePicker
	 */
	public function getStart_date()
	{
		return $this->start_date;
	}
	/** @var DatePicker */
	private $end_date;
	/**
	 * @return DatePicker
	 */
	public function getEnd_date()
	{
		return $this->end_date;
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
	/** @var SweetButton */
	private $btnSave;
}
?>