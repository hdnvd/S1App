<?php
namespace Modules\iribfinance\Forms;
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
*@creationDate 1396-11-05 - 2018-01-25 18:01
*@lastUpdate 1396-11-05 - 2018-01-25 18:01
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class employmenttype_Design extends FormDesign {
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
	private $taxfactor;
	public function __construct()
	{

		/******* title *******/
		$this->title= new lable("title");

		/******* taxfactor *******/
		$this->taxfactor= new lable("taxfactor");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("iribfinance_employmenttype");
		$Page->addElement($this->getPageTitlePart("اطلاعات " . $this->Data['employmenttype']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		if (key_exists("employmenttype", $this->Data)){
			$this->setFieldCaption('title',$this->Data['employmenttype']->getFieldInfo('title')->getTitle());
			$this->title->setText($this->Data['employmenttype']->getTitle());
			$this->setFieldCaption('taxfactor',$this->Data['employmenttype']->getFieldInfo('taxfactor')->getTitle());
			$this->taxfactor->setText($this->Data['employmenttype']->getTaxfactor());
		}
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getInfoRowCode($this->title,$this->getFieldCaption('title')));
		$LTable1->addElement($this->getInfoRowCode($this->taxfactor,$this->getFieldCaption('taxfactor')));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	public function getJSON()
	{
		parent::getJSON();
		if (key_exists("employmenttype", $this->Data)){
			$Result=$this->Data['employmenttype']->GetArray();
			return json_encode($Result);
		}
		return json_encode(array());
	}
}
?>