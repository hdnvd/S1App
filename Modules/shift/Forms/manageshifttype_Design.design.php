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
*@creationDate 1397-01-17 - 2018-04-06 21:17
*@lastUpdate 1397-01-17 - 2018-04-06 21:17
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageshifttype_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("shift_manageshifttype");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['shifttype']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->valueinminutes,$this->getFieldCaption('valueinminutes'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->abbreviation,$this->getFieldCaption('abbreviation'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->latinabbreviation,$this->getFieldCaption('latinabbreviation'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->isvisible,$this->getFieldCaption('isvisible'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->holidayfactor,$this->getFieldCaption('holidayfactor'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
			$this->isvisible->addOption(1,'بله');
			$this->isvisible->addOption(0,'خیر');
		if (key_exists("shifttype", $this->Data)){

			/******** title ********/
			$this->title->setValue($this->Data['shifttype']->getTitle());
			$this->setFieldCaption('title',$this->Data['shifttype']->getFieldInfo('title')->getTitle());
			$this->title->setFieldInfo($this->Data['shifttype']->getFieldInfo('title'));

			/******** valueinminutes ********/
			$this->valueinminutes->setValue($this->Data['shifttype']->getValueinminutes());
			$this->setFieldCaption('valueinminutes',$this->Data['shifttype']->getFieldInfo('valueinminutes')->getTitle());
			$this->valueinminutes->setFieldInfo($this->Data['shifttype']->getFieldInfo('valueinminutes'));

			/******** abbreviation ********/
			$this->abbreviation->setValue($this->Data['shifttype']->getAbbreviation());
			$this->setFieldCaption('abbreviation',$this->Data['shifttype']->getFieldInfo('abbreviation')->getTitle());
			$this->abbreviation->setFieldInfo($this->Data['shifttype']->getFieldInfo('abbreviation'));

			/******** latinabbreviation ********/
			$this->latinabbreviation->setValue($this->Data['shifttype']->getLatinabbreviation());
			$this->setFieldCaption('latinabbreviation',$this->Data['shifttype']->getFieldInfo('latinabbreviation')->getTitle());
			$this->latinabbreviation->setFieldInfo($this->Data['shifttype']->getFieldInfo('latinabbreviation'));

			/******** isvisible ********/
			$this->isvisible->setSelectedValue($this->Data['shifttype']->getIsvisible());
			$this->setFieldCaption('isvisible',$this->Data['shifttype']->getFieldInfo('isvisible')->getTitle());

			/******** holidayfactor ********/
			$this->holidayfactor->setValue($this->Data['shifttype']->getHolidayfactor());
			$this->setFieldCaption('holidayfactor',$this->Data['shifttype']->getFieldInfo('holidayfactor')->getTitle());
			$this->holidayfactor->setFieldInfo($this->Data['shifttype']->getFieldInfo('holidayfactor'));

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* title *******/
		$this->title= new textbox("title");
		$this->title->setClass("form-control");

		/******* valueinminutes *******/
		$this->valueinminutes= new textbox("valueinminutes");
		$this->valueinminutes->setClass("form-control");

		/******* abbreviation *******/
		$this->abbreviation= new textbox("abbreviation");
		$this->abbreviation->setClass("form-control");

		/******* latinabbreviation *******/
		$this->latinabbreviation= new textbox("latinabbreviation");
		$this->latinabbreviation->setClass("form-control");

		/******* isvisible *******/
		$this->isvisible= new combobox("isvisible");
		$this->isvisible->setClass("form-control");

		/******* holidayfactor *******/
		$this->holidayfactor= new textbox("holidayfactor");
		$this->holidayfactor->setClass("form-control");

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
	private $valueinminutes;
	/**
	 * @return textbox
	 */
	public function getValueinminutes()
	{
		return $this->valueinminutes;
	}
	/** @var textbox */
	private $abbreviation;
	/**
	 * @return textbox
	 */
	public function getAbbreviation()
	{
		return $this->abbreviation;
	}
	/** @var textbox */
	private $latinabbreviation;
	/**
	 * @return textbox
	 */
	public function getLatinabbreviation()
	{
		return $this->latinabbreviation;
	}
	/** @var combobox */
	private $isvisible;
	/**
	 * @return combobox
	 */
	public function getIsvisible()
	{
		return $this->isvisible;
	}
	/** @var textbox */
	private $holidayfactor;
	/**
	 * @return textbox
	 */
	public function getHolidayfactor()
	{
		return $this->holidayfactor;
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