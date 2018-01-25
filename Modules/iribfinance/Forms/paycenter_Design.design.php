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
class paycenter_Design extends FormDesign {
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
	private $chapter;
	/** @var lable */
	private $accountingcode;
	public function __construct()
	{

		/******* title *******/
		$this->title= new lable("title");

		/******* chapter *******/
		$this->chapter= new lable("chapter");

		/******* accountingcode *******/
		$this->accountingcode= new lable("accountingcode");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("iribfinance_paycenter");
		$Page->addElement($this->getPageTitlePart("اطلاعات " . $this->Data['paycenter']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		if (key_exists("paycenter", $this->Data)){
			$this->setFieldCaption('title',$this->Data['paycenter']->getFieldInfo('title')->getTitle());
			$this->title->setText($this->Data['paycenter']->getTitle());
			$this->setFieldCaption('chapter',$this->Data['paycenter']->getFieldInfo('chapter')->getTitle());
			$this->chapter->setText($this->Data['paycenter']->getChapter());
			$this->setFieldCaption('accountingcode',$this->Data['paycenter']->getFieldInfo('accountingcode')->getTitle());
			$this->accountingcode->setText($this->Data['paycenter']->getAccountingcode());
		}
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getInfoRowCode($this->title,$this->getFieldCaption('title')));
		$LTable1->addElement($this->getInfoRowCode($this->chapter,$this->getFieldCaption('chapter')));
		$LTable1->addElement($this->getInfoRowCode($this->accountingcode,$this->getFieldCaption('accountingcode')));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	public function getJSON()
	{
		parent::getJSON();
		if (key_exists("paycenter", $this->Data)){
			$Result=$this->Data['paycenter']->GetArray();
			return json_encode($Result);
		}
		return json_encode(array());
	}
}
?>