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
class managerecordtype_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("oras_managerecordtype");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['recordtype']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->points,$this->getFieldCaption('points'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->isbad,$this->getFieldCaption('isbad'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
		if (key_exists("recordtype", $this->Data)){
			$this->title->setValue($this->Data['recordtype']->getTitle());
			$this->setFieldCaption('title',$this->Data['recordtype']->getFieldInfo('title')->getTitle());
			$this->title->setFieldInfo($this->Data['recordtype']->getFieldInfo('title'));
		}

			/******** points ********/
		if (key_exists("recordtype", $this->Data)){
			$this->points->setValue($this->Data['recordtype']->getPoints());
			$this->setFieldCaption('points',$this->Data['recordtype']->getFieldInfo('points')->getTitle());
			$this->points->setFieldInfo($this->Data['recordtype']->getFieldInfo('points'));
		}

			/******** isbad ********/
			$this->isbad->addOption(1,'کسور');
			$this->isbad->addOption(0,'تشویقی');
		if (key_exists("recordtype", $this->Data)){
			$this->isbad->setSelectedValue($this->Data['recordtype']->getIsbad());
			$this->setFieldCaption('isbad',$this->Data['recordtype']->getFieldInfo('isbad')->getTitle());
		}

			/******** btnSave ********/
	}
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
	/** @var SweetButton */
	private $btnSave;
}
?>