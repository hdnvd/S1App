<?php
namespace Modules\sfman\Forms;
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
*@creationDate 1396-08-17 - 2017-11-08 14:11
*@lastUpdate 1396-08-17 - 2017-11-08 14:11
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managetable_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	private $FieldCaptions;
	/** @var textbox */
	private $txtFields;
	/**
	 * @return textbox
	 */
	public function getTxtFields()
	{
		return $this->txtFields;
	}
	/** @var textbox */
	private $txtTableName;
	/**
	 * @return textbox
	 */
	public function getTxtTableName()
	{
		return $this->txtTableName;
	}
	/** @var SweetButton */
	private $btnGenerateSQL;
	public function __construct()
	{
		$this->FieldCaptions=array();

		/******* txtFields *******/
		$this->txtFields= new textbox("txtFields");
		$this->txtFields->setClass("form-control");

		/******* txtTableName *******/
		$this->txtTableName= new textbox("txtTableName");
		$this->txtTableName->setClass("form-control");

		/******* btnGenerateSQL *******/
		$this->btnGenerateSQL= new SweetButton(true,"ساخت کد SQL");
		$this->btnGenerateSQL->setAction("btnGenerateSQL");
		$this->btnGenerateSQL->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
		$this->btnGenerateSQL->setClass("btn btn-primary");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("sfman_managetable");
		$Page->addElement($this->getPageTitlePart("مدیریت جدول"));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->txtFields,$this->getFieldCaption('txtFields'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->txtTableName,$this->getFieldCaption('txtTableName'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getSingleFieldRowCode($this->btnGenerateSQL));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
}
?>