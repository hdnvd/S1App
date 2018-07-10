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
class manageproduct_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("eshop_manageproduct");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['product']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->latintitle,$this->getFieldCaption('latintitle'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->description,$this->getFieldCaption('description'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->pic1_flu,$this->getFieldCaption('pic1_flu'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->pic2_flu,$this->getFieldCaption('pic2_flu'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->pic3_flu,$this->getFieldCaption('pic3_flu'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->pic4_flu,$this->getFieldCaption('pic4_flu'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->price,$this->getFieldCaption('price'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->code,$this->getFieldCaption('code'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->adddate,$this->getFieldCaption('adddate'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->visitcount,$this->getFieldCaption('visitcount'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->is_exists,$this->getFieldCaption('is_exists'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getSingleFieldRowCode($this->btnSave));
		$LTable1->addElement($this->getFieldRowCode($this->Colors,$this->getFieldCaption('Colors'),null,'',null));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		$form->SetAttribute("novalidate","novalidate");
		$form->SetAttribute("data-toggle","validator");
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
	public function FillItems()
	{
			$this->is_exists->addOption(1,'بله');
			$this->is_exists->addOption(0,'خیر');
		if (key_exists("product", $this->Data)){

			/******** title ********/
			$this->title->setValue($this->Data['product']->getTitle());
			$this->setFieldCaption('title',$this->Data['product']->getFieldInfo('title')->getTitle());
			$this->title->setFieldInfo($this->Data['product']->getFieldInfo('title'));

			/******** latintitle ********/
			$this->latintitle->setValue($this->Data['product']->getLatintitle());
			$this->setFieldCaption('latintitle',$this->Data['product']->getFieldInfo('latintitle')->getTitle());
			$this->latintitle->setFieldInfo($this->Data['product']->getFieldInfo('latintitle'));

			/******** description ********/
			$this->description->setValue($this->Data['product']->getDescription());
			$this->setFieldCaption('description',$this->Data['product']->getFieldInfo('description')->getTitle());
			$this->description->setFieldInfo($this->Data['product']->getFieldInfo('description'));

			/******** pic1_flu ********/
			$this->setFieldCaption('pic1_flu',$this->Data['product']->getFieldInfo('pic1_flu')->getTitle());

			/******** pic2_flu ********/
			$this->setFieldCaption('pic2_flu',$this->Data['product']->getFieldInfo('pic2_flu')->getTitle());

			/******** pic3_flu ********/
			$this->setFieldCaption('pic3_flu',$this->Data['product']->getFieldInfo('pic3_flu')->getTitle());

			/******** pic4_flu ********/
			$this->setFieldCaption('pic4_flu',$this->Data['product']->getFieldInfo('pic4_flu')->getTitle());

			/******** price ********/
			$this->price->setValue($this->Data['product']->getPrice());
			$this->setFieldCaption('price',$this->Data['product']->getFieldInfo('price')->getTitle());
			$this->price->setFieldInfo($this->Data['product']->getFieldInfo('price'));

			/******** code ********/
			$this->code->setValue($this->Data['product']->getCode());
			$this->setFieldCaption('code',$this->Data['product']->getFieldInfo('code')->getTitle());
			$this->code->setFieldInfo($this->Data['product']->getFieldInfo('code'));

			/******** adddate ********/
			$this->adddate->setValue($this->Data['product']->getAdddate());
			$this->setFieldCaption('adddate',$this->Data['product']->getFieldInfo('adddate')->getTitle());
			$this->adddate->setFieldInfo($this->Data['product']->getFieldInfo('adddate'));

			/******** visitcount ********/
			$this->visitcount->setValue($this->Data['product']->getVisitcount());
			$this->setFieldCaption('visitcount',$this->Data['product']->getFieldInfo('visitcount')->getTitle());
			$this->visitcount->setFieldInfo($this->Data['product']->getFieldInfo('visitcount'));

			/******** is_exists ********/
			$this->is_exists->setSelectedValue($this->Data['product']->getIs_exists());
			$this->setFieldCaption('is_exists',$this->Data['product']->getFieldInfo('is_exists')->getTitle());

			/******** btnSave ********/
		}
		if (key_exists("colors", $this->Data)) {
		$AllColorCount = count($this->Data['colors']);
		for ($i = 0; $i < $AllColorCount; $i++) {
			$this->Colors->addOption($this->Data['colors'][$i]->getTitleField(), $this->Data['colors'][$i]->getId());
		}
	}
		if (key_exists("productcolors", $this->Data)) {
		$AllColorCount = count($this->Data['productcolors']);
		for ($i = 0; $i < $AllColorCount; $i++) {
			$this->Colors->addSelectedValue($this->Data['productcolors'][$i]->getColor_fid());
		}
	}
	}
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

		/******* pic1_flu *******/
		$this->pic1_flu= new FileUploadBox("pic1_flu");
		$this->pic1_flu->setClass("form-control-file");

		/******* pic2_flu *******/
		$this->pic2_flu= new FileUploadBox("pic2_flu");
		$this->pic2_flu->setClass("form-control-file");

		/******* pic3_flu *******/
		$this->pic3_flu= new FileUploadBox("pic3_flu");
		$this->pic3_flu->setClass("form-control-file");

		/******* pic4_flu *******/
		$this->pic4_flu= new FileUploadBox("pic4_flu");
		$this->pic4_flu->setClass("form-control-file");

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

		/******* btnSave *******/
		$this->btnSave= new SweetButton(true,"ذخیره");
		$this->btnSave->setAction("btnSave");
		$this->btnSave->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
		$this->btnSave->setClass("btn btn-primary");

		/******* Color *******/
		$this->Colors= new  CheckBox('color[]');
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
	/** @var FileUploadBox */
	private $pic1_flu;
	/**
	 * @return FileUploadBox
	 */
	public function getPic1_flu()
	{
		return $this->pic1_flu;
	}
	/** @var FileUploadBox */
	private $pic2_flu;
	/**
	 * @return FileUploadBox
	 */
	public function getPic2_flu()
	{
		return $this->pic2_flu;
	}
	/** @var FileUploadBox */
	private $pic3_flu;
	/**
	 * @return FileUploadBox
	 */
	public function getPic3_flu()
	{
		return $this->pic3_flu;
	}
	/** @var FileUploadBox */
	private $pic4_flu;
	/**
	 * @return FileUploadBox
	 */
	public function getPic4_flu()
	{
		return $this->pic4_flu;
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
	/** @var SweetButton */
	private $btnSave;
	/** @var CheckBox */
	private $Colors;
	/**
	 * @return CheckBox
	 */
	public function getColors()
	{
		return $this->Colors;
	}
    public function getJSON()
    {
       parent::getJSON();
       $Result=['message'=>$this->getMessage(),'messagetype'=>$this->getMessageType()];
       return json_encode($Result);
    }
}
?>