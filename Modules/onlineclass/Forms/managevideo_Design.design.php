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
*@creationDate 1396-08-01 - 2017-10-23 00:42
*@lastUpdate 1396-08-01 - 2017-10-23 00:42
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managevideo_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("onlineclass_managevideo");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['video']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->hold_date,$this->getFieldCaption('hold_date'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->course_fid,$this->getFieldCaption('course_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->hdvideo_flu,$this->getFieldCaption('hdvideo_flu'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
//		$LTable1->addElement($this->getFieldRowCode($this->sdvideo_flu,$this->getFieldCaption('sdvideo_flu'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->voice_flu,$this->getFieldCaption('voice_flu'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
		if (key_exists("video", $this->Data)){
			$this->title->setValue($this->Data['video']->getTitle());
			$this->setFieldCaption('title',$this->Data['video']->getFieldInfo('title')->getTitle());
			$this->title->setFieldInfo($this->Data['video']->getFieldInfo('title'));
		}

			/******** hold_date ********/
		if (key_exists("video", $this->Data)){
			$this->hold_date->setTime($this->Data['video']->getHold_date());
			$this->setFieldCaption('hold_date',$this->Data['video']->getFieldInfo('hold_date')->getTitle());
			$this->hold_date->setFieldInfo($this->Data['video']->getFieldInfo('hold_date'));
		}

			/******** course_fid ********/
		foreach ($this->Data['course_fid'] as $item)
			$this->course_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("video", $this->Data)){
			$this->course_fid->setSelectedValue($this->Data['video']->getCourse_fid());
			$this->setFieldCaption('course_fid',$this->Data['video']->getFieldInfo('course_fid')->getTitle());
		}

			/******** hdvideo_flu ********/
		if (key_exists("video", $this->Data)){
			$this->setFieldCaption('hdvideo_flu',$this->Data['video']->getFieldInfo('hdvideo_flu')->getTitle());
		}

			/******** sdvideo_flu ********/
//		if (key_exists("video", $this->Data)){
//			$this->setFieldCaption('sdvideo_flu',$this->Data['video']->getFieldInfo('sdvideo_flu')->getTitle());
//		}

			/******** voice_flu ********/
		if (key_exists("video", $this->Data)){
			$this->setFieldCaption('voice_flu',$this->Data['video']->getFieldInfo('voice_flu')->getTitle());
		}

			/******** btnSave ********/
	}
	public function __construct()
	{
		parent::__construct();

		/******* title *******/
		$this->title= new textbox("title");
		$this->title->setClass("form-control");

		/******* hold_date *******/
		$this->hold_date= new DatePicker("hold_date");
		$this->hold_date->setClass("form-control");

		/******* course_fid *******/
		$this->course_fid= new combobox("course_fid");
		$this->course_fid->setClass("form-control");

		/******* hdvideo_flu *******/
		$this->hdvideo_flu= new FileUploadBox("hdvideo_flu");
		$this->hdvideo_flu->setClass("form-control-file");

//		/******* sdvideo_flu *******/
//		$this->sdvideo_flu= new FileUploadBox("sdvideo_flu");
//		$this->sdvideo_flu->setClass("form-control-file");

		/******* voice_flu *******/
		$this->voice_flu= new FileUploadBox("voice_flu");
		$this->voice_flu->setClass("form-control-file");

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
	private $hold_date;
	/**
	 * @return DatePicker
	 */
	public function getHold_date()
	{
		return $this->hold_date;
	}
	/** @var combobox */
	private $course_fid;
	/**
	 * @return combobox
	 */
	public function getCourse_fid()
	{
		return $this->course_fid;
	}
	/** @var FileUploadBox */
	private $hdvideo_flu;
	/**
	 * @return FileUploadBox
	 */
	public function getHdvideo_flu()
	{
		return $this->hdvideo_flu;
	}
	/** @var FileUploadBox */
//	private $sdvideo_flu;
//	/**
//	 * @return FileUploadBox
//	 */
//	public function getSdvideo_flu()
//	{
//		return $this->sdvideo_flu;
//	}
	/** @var FileUploadBox */
	private $voice_flu;
	/**
	 * @return FileUploadBox
	 */
	public function getVoice_flu()
	{
		return $this->voice_flu;
	}
	/** @var SweetButton */
	private $btnSave;
}
?>