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
*@creationDate 1396-07-26 - 2017-10-18 16:38
*@lastUpdate 1396-07-26 - 2017-10-18 16:38
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class manageusercourse_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("onlineclass_manageusercourse");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['usercourse']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->user_fid,$this->getFieldCaption('user_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->course_fid,$this->getFieldCaption('course_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->add_time,$this->getFieldCaption('add_time'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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

			/******** user_fid ********/
		foreach ($this->Data['user_fid'] as $item)
			$this->user_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("usercourse", $this->Data)){
			$this->user_fid->setSelectedValue($this->Data['usercourse']->getUser_fid());
			$this->setFieldCaption('user_fid',$this->Data['usercourse']->getFieldInfo('user_fid')->getTitle());
		}

			/******** course_fid ********/
		foreach ($this->Data['course_fid'] as $item)
			$this->course_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("usercourse", $this->Data)){
			$this->course_fid->setSelectedValue($this->Data['usercourse']->getCourse_fid());
			$this->setFieldCaption('course_fid',$this->Data['usercourse']->getFieldInfo('course_fid')->getTitle());
		}

			/******** add_time ********/
		if (key_exists("usercourse", $this->Data)){
			$this->add_time->setTime($this->Data['usercourse']->getAdd_time());
			$this->setFieldCaption('add_time',$this->Data['usercourse']->getFieldInfo('add_time')->getTitle());
			$this->add_time->setFieldInfo($this->Data['usercourse']->getFieldInfo('add_time'));
		}

			/******** btnSave ********/
	}
	public function __construct()
	{
		parent::__construct();

		/******* user_fid *******/
		$this->user_fid= new combobox("user_fid");
		$this->user_fid->setClass("form-control");

		/******* course_fid *******/
		$this->course_fid= new combobox("course_fid");
		$this->course_fid->setClass("form-control");

		/******* add_time *******/
		$this->add_time= new DatePicker("add_time");
		$this->add_time->setClass("form-control");

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
	/** @var combobox */
	private $user_fid;
	/**
	 * @return combobox
	 */
	public function getUser_fid()
	{
		return $this->user_fid;
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
	/** @var DatePicker */
	private $add_time;
	/**
	 * @return DatePicker
	 */
	public function getAdd_time()
	{
		return $this->add_time;
	}
	/** @var SweetButton */
	private $btnSave;
}
?>