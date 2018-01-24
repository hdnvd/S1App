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
*@creationDate 1396-10-27 - 2018-01-17 16:12
*@lastUpdate 1396-10-27 - 2018-01-17 16:12
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class importshiftdata_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	private $FieldCaptions;
	/** @var FileUploadBox */
	private $inputfile;
	/**
	 * @return FileUploadBox
	 */
	public function getInputfile()
	{
		return $this->inputfile;
	}
	/** @var SweetButton */
	private $btnsave;
	public function __construct()
	{
		$this->FieldCaptions=array();

		/******* inputfile *******/
		$this->inputfile= new FileUploadBox("inputfile");
		$this->inputfile->setClass("form-control-file");

		/******* btnsave *******/
		$this->btnsave= new SweetButton(true,"ذخیره");
		$this->btnsave->setAction("btnsave");
		$this->btnsave->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
		$this->btnsave->setClass("btn btn-primary");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("shift_importshiftdata");
		$Page->addElement($this->getPageTitlePart("وارد کردن اطلاعات شیفت"));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->inputfile,$this->getFieldCaption('inputfile'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getSingleFieldRowCode($this->btnsave));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
}
?>