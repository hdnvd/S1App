<?php
namespace Modules\fileshop\Forms;
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
*@creationDate 1396-09-09 - 2017-11-30 16:33
*@lastUpdate 1396-09-09 - 2017-11-30 16:33
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managefile_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("fileshop_managefile");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['file']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->file_flu,$this->getFieldCaption('file_flu'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->thumbnail_flu,$this->getFieldCaption('thumbnail_flu'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->add_date,$this->getFieldCaption('add_date'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->description,$this->getFieldCaption('description'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->price,$this->getFieldCaption('price'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->filecount,$this->getFieldCaption('filecount'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->Categorys,$this->getFieldCaption('موضوعات'),null,'',null));
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
		if (key_exists("file", $this->Data)){

			/******** file_flu ********/
			$this->setFieldCaption('file_flu',$this->Data['file']->getFieldInfo('file_flu')->getTitle());

			/******** title ********/
			$this->title->setValue($this->Data['file']->getTitle());
			$this->setFieldCaption('title',$this->Data['file']->getFieldInfo('title')->getTitle());
			$this->title->setFieldInfo($this->Data['file']->getFieldInfo('title'));

			/******** thumbnail_flu ********/
			$this->setFieldCaption('thumbnail_flu',$this->Data['file']->getFieldInfo('thumbnail_flu')->getTitle());

			/******** add_date ********/
			$this->add_date->setTime($this->Data['file']->getAdd_date());
			$this->setFieldCaption('add_date',$this->Data['file']->getFieldInfo('add_date')->getTitle());
			$this->add_date->setFieldInfo($this->Data['file']->getFieldInfo('add_date'));

			/******** description ********/
			$this->description->setValue($this->Data['file']->getDescription());
			$this->setFieldCaption('description',$this->Data['file']->getFieldInfo('description')->getTitle());
			$this->description->setFieldInfo($this->Data['file']->getFieldInfo('description'));

			/******** price ********/
			$this->price->setValue($this->Data['file']->getPrice());
			$this->setFieldCaption('price',$this->Data['file']->getFieldInfo('price')->getTitle());
			$this->price->setFieldInfo($this->Data['file']->getFieldInfo('price'));

			/******** filecount ********/
			$this->filecount->setValue($this->Data['file']->getFilecount());
			$this->setFieldCaption('filecount',$this->Data['file']->getFieldInfo('filecount')->getTitle());
			$this->filecount->setFieldInfo($this->Data['file']->getFieldInfo('filecount'));

			/******** btnSave ********/
		}
		if (key_exists("categorys", $this->Data)) {
		$AllCategoryCount = count($this->Data['categorys']);
		for ($i = 0; $i < $AllCategoryCount; $i++) {
			$this->Categorys->addOption($this->Data['categorys'][$i]->getTitleField(), $this->Data['categorys'][$i]->getId());
		}
	}
		if (key_exists("filecategorys", $this->Data)) {
		$AllCategoryCount = count($this->Data['filecategorys']);
		for ($i = 0; $i < $AllCategoryCount; $i++) {
			$this->Categorys->addSelectedValue($this->Data['filecategorys'][$i]->getCommon_category_fid());
		}
	}
	}
	public function __construct()
	{
		parent::__construct();

		/******* file_flu *******/
		$this->file_flu= new FileUploadBox("file_flu");
		$this->file_flu->setClass("form-control-file");

		/******* title *******/
		$this->title= new textbox("title");
		$this->title->setClass("form-control");

		/******* thumbnail_flu *******/
		$this->thumbnail_flu= new FileUploadBox("thumbnail_flu");
		$this->thumbnail_flu->setClass("form-control-file");

		/******* add_date *******/
		$this->add_date= new DatePicker("add_date");
		$this->add_date->setClass("form-control");

		/******* description *******/
		$this->description= new textbox("description");
		$this->description->setClass("form-control");

		/******* price *******/
		$this->price= new textbox("price");
		$this->price->setClass("form-control");

		/******* filecount *******/
		$this->filecount= new textbox("filecount");
		$this->filecount->setClass("form-control");

		/******* btnSave *******/
		$this->btnSave= new SweetButton(true,"ذخیره");
		$this->btnSave->setAction("btnSave");
		$this->btnSave->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
		$this->btnSave->setClass("btn btn-primary");

		/******* Category *******/
		$this->Categorys= new  CheckBox('category[]');
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
	/** @var FileUploadBox */
	private $file_flu;
	/**
	 * @return FileUploadBox
	 */
	public function getFile_flu()
	{
		return $this->file_flu;
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
	/** @var FileUploadBox */
	private $thumbnail_flu;
	/**
	 * @return FileUploadBox
	 */
	public function getThumbnail_flu()
	{
		return $this->thumbnail_flu;
	}
	/** @var DatePicker */
	private $add_date;
	/**
	 * @return DatePicker
	 */
	public function getAdd_date()
	{
		return $this->add_date;
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
	private $filecount;
	/**
	 * @return textbox
	 */
	public function getFilecount()
	{
		return $this->filecount;
	}
	/** @var SweetButton */
	private $btnSave;
	/** @var CheckBox */
	private $Categorys;
	/**
	 * @return CheckBox
	 */
	public function getCategorys()
	{
		return $this->Categorys;
	}
    public function getJSON()
    {
       parent::getJSON();
       $Result=['message'=>$this->getMessage(),'messagetype'=>$this->getMessageType()];
       return json_encode($Result);
    }
}
?>