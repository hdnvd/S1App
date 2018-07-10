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
*@creationDate 1396-07-12 - 2017-10-04 16:08
*@lastUpdate 1396-07-12 - 2017-10-04 16:08
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class manageemployee_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("oras_manageemployee");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['employee']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->mellicode,$this->getFieldCaption('mellicode'),null,'لطفا شماره ملی 10 رقمی را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->name,$this->getFieldCaption('name'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->family,$this->getFieldCaption('family'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->ismale,$this->getFieldCaption('ismale'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->phonenumber,$this->getFieldCaption('phonenumber'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->photo_flu,$this->getFieldCaption('photo_flu'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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

			/******** mellicode ********/
		if (key_exists("employee", $this->Data)){
			$this->mellicode->setValue($this->Data['employee']->getMellicode());
			$this->setFieldCaption('mellicode',$this->Data['employee']->getFieldInfo('mellicode')->getTitle());
			$this->mellicode->setFieldInfo($this->Data['employee']->getFieldInfo('mellicode'));
		}

			/******** name ********/
		if (key_exists("employee", $this->Data)){
			$this->name->setValue($this->Data['employee']->getName());
			$this->setFieldCaption('name',$this->Data['employee']->getFieldInfo('name')->getTitle());
			$this->name->setFieldInfo($this->Data['employee']->getFieldInfo('name'));
		}

			/******** family ********/
		if (key_exists("employee", $this->Data)){
			$this->family->setValue($this->Data['employee']->getFamily());
			$this->setFieldCaption('family',$this->Data['employee']->getFieldInfo('family')->getTitle());
			$this->family->setFieldInfo($this->Data['employee']->getFieldInfo('family'));
		}

			/******** ismale ********/
			$this->ismale->addOption(1,'مرد');
			$this->ismale->addOption(0,'زن');
		if (key_exists("employee", $this->Data)){
			$this->ismale->setSelectedValue($this->Data['employee']->getIsmale());
			$this->setFieldCaption('ismale',$this->Data['employee']->getFieldInfo('ismale')->getTitle());
		}

			/******** phonenumber ********/
		if (key_exists("employee", $this->Data)){
			$this->phonenumber->setValue($this->Data['employee']->getPhonenumber());
			$this->setFieldCaption('phonenumber',$this->Data['employee']->getFieldInfo('phonenumber')->getTitle());
			$this->phonenumber->setFieldInfo($this->Data['employee']->getFieldInfo('phonenumber'));
		}

			/******** photo_flu ********/
		if (key_exists("employee", $this->Data)){
			$this->setFieldCaption('photo_flu',$this->Data['employee']->getFieldInfo('photo_flu')->getTitle());
		}

			/******** btnSave ********/
	}
	public function __construct()
	{
		parent::__construct();

		/******* mellicode *******/
		$this->mellicode= new textbox("mellicode");
		$this->mellicode->setClass("form-control");

		/******* name *******/
		$this->name= new textbox("name");
		$this->name->setClass("form-control");

		/******* family *******/
		$this->family= new textbox("family");
		$this->family->setClass("form-control");

		/******* ismale *******/
		$this->ismale= new combobox("ismale");
		$this->ismale->setClass("form-control");

		/******* phonenumber *******/
		$this->phonenumber= new textbox("phonenumber");
		$this->phonenumber->setClass("form-control");

		/******* photo_flu *******/
		$this->photo_flu= new FileUploadBox("photo_flu");
		$this->photo_flu->setClass("form-control-file");

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
	private $mellicode;
	/**
	 * @return textbox
	 */
	public function getMellicode()
	{
		return $this->mellicode;
	}
	/** @var textbox */
	private $name;
	/**
	 * @return textbox
	 */
	public function getName()
	{
		return $this->name;
	}
	/** @var textbox */
	private $family;
	/**
	 * @return textbox
	 */
	public function getFamily()
	{
		return $this->family;
	}
	/** @var combobox */
	private $ismale;
	/**
	 * @return combobox
	 */
	public function getIsmale()
	{
		return $this->ismale;
	}
	/** @var textbox */
	private $phonenumber;
	/**
	 * @return textbox
	 */
	public function getPhonenumber()
	{
		return $this->phonenumber;
	}
	/** @var FileUploadBox */
	private $photo_flu;
	/**
	 * @return FileUploadBox
	 */
	public function getPhoto_flu()
	{
		return $this->photo_flu;
	}
	/** @var SweetButton */
	private $btnSave;
}
?>