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
*@creationDate 1396-09-09 - 2017-11-30 16:35
*@lastUpdate 1396-09-09 - 2017-11-30 16:35
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class filetransaction_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var lable */
	private $file_fid;
	/** @var lable */
	private $finance_bankpaymentinfo_fid;
	public function __construct()
	{

		/******* file_fid *******/
		$this->file_fid= new lable("file_fid");

		/******* finance_bankpaymentinfo_fid *******/
		$this->finance_bankpaymentinfo_fid= new lable("finance_bankpaymentinfo_fid");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("fileshop_filetransaction");
		$Page->addElement($this->getPageTitlePart("اطلاعات " . $this->Data['filetransaction']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		if (key_exists("filetransaction", $this->Data)){
			$this->setFieldCaption('file_fid',$this->Data['filetransaction']->getFieldInfo('file_fid')->getTitle());
			$this->file_fid->setText($this->Data['file_fid']->getID());
			$this->setFieldCaption('finance_bankpaymentinfo_fid',$this->Data['filetransaction']->getFieldInfo('finance_bankpaymentinfo_fid')->getTitle());
			$this->finance_bankpaymentinfo_fid->setText($this->Data['finance_bankpaymentinfo_fid']->getID());
		}
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getInfoRowCode($this->file_fid,$this->getFieldCaption('file_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->finance_bankpaymentinfo_fid,$this->getFieldCaption('finance_bankpaymentinfo_fid')));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	public function getJSON()
	{
		parent::getJSON();
		if (key_exists("filetransaction", $this->Data)){
			$Result=$this->Data['filetransaction']->GetArray();
			return json_encode($Result);
		}
		return json_encode(array());
	}
}
?>