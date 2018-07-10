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
*@creationDate 1396-11-23 - 2018-02-12 00:13
*@lastUpdate 1396-11-23 - 2018-02-12 00:13
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class makesampleinput_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	private $FieldCaptions;
	/** @var DatePicker */
	private $startdate;
	/** @var textbox */
	private $txtdaycount;
	/**
	 * @return textbox
	 */
	public function getTxtdaycount()
	{
		return $this->txtdaycount;
	}
	/** @var SweetButton */
	private $btnGenerate;
	public function __construct()
	{
		$this->FieldCaptions=array();

		/******* startdate *******/
		$this->startdate= new DatePicker("startdate");
		$this->startdate->setClass("form-control");

		/******* txtdaycount *******/
		$this->txtdaycount= new textbox("txtdaycount");
		$this->txtdaycount->setClass("form-control");
		$this->txtdaycount->setRequired(true);

		/******* btnGenerate *******/
		$this->btnGenerate= new SweetButton(true,"دریافت فایل نمونه");
		$this->btnGenerate->setAction("btnGenerate");
		$this->btnGenerate->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
		$this->btnGenerate->setClass("btn btn-primary");
	}

    /**
     * @return DatePicker
     */
    public function getStartdate()
    {
        return $this->startdate;
    }
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("shift_makesampleinput");
		$Page->addElement($this->getPageTitlePart("ساخت فایل ورودی نمونه"));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->startdate,"تاریخ شروع",null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->txtdaycount,"تعداد روزها",null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getSingleFieldRowCode($this->btnGenerate));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
}
?>