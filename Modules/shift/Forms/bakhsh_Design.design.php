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
*@creationDate 1396-10-26 - 2018-01-16 19:13
*@lastUpdate 1396-10-26 - 2018-01-16 19:13
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class bakhsh_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var lable */
	private $title;
	/** @var lable */
	private $sakhtikar;
	public function __construct()
	{

		/******* title *******/
		$this->title= new lable("title");

		/******* sakhtikar *******/
		$this->sakhtikar= new lable("sakhtikar");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("shift_bakhsh");
		$Page->addElement($this->getPageTitlePart("اطلاعات " . $this->Data['bakhsh']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		if (key_exists("bakhsh", $this->Data)){
			$this->setFieldCaption('title',$this->Data['bakhsh']->getFieldInfo('title')->getTitle());
			$this->title->setText($this->Data['bakhsh']->getTitle());
			$this->setFieldCaption('sakhtikar',$this->Data['bakhsh']->getFieldInfo('sakhtikar')->getTitle());
			$this->sakhtikar->setText($this->Data['bakhsh']->getSakhtikar());
		}
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getInfoRowCode($this->title,$this->getFieldCaption('title')));
		$LTable1->addElement($this->getInfoRowCode($this->sakhtikar,$this->getFieldCaption('sakhtikar')));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	public function getJSON()
	{
		parent::getJSON();
		if (key_exists("bakhsh", $this->Data)){
			$Result=$this->Data['bakhsh']->GetArray();
			return json_encode($Result);
		}
		return json_encode(array());
	}
}
?>