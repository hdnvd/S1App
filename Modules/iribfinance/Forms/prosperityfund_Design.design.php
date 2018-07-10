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
class prosperityfund_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var lable */
	private $totalamount;
	/** @var lable */
	private $add_date;
	/** @var lable */
	private $monthcount;
	/** @var lable */
	private $amountpermonth;
	/** @var lable */
	private $isactive;
	public function __construct()
	{

		/******* totalamount *******/
		$this->totalamount= new lable("totalamount");

		/******* add_date *******/
		$this->add_date= new lable("add_date");

		/******* monthcount *******/
		$this->monthcount= new lable("monthcount");

		/******* amountpermonth *******/
		$this->amountpermonth= new lable("amountpermonth");

		/******* isactive *******/
		$this->isactive= new lable("isactive");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("iribfinance_prosperityfund");
		$Page->addElement($this->getPageTitlePart("اطلاعات " . $this->Data['prosperityfund']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		if (key_exists("prosperityfund", $this->Data)){
			$this->setFieldCaption('totalamount',$this->Data['prosperityfund']->getFieldInfo('totalamount')->getTitle());
			$this->totalamount->setText($this->Data['prosperityfund']->getTotalamount());
			$this->setFieldCaption('add_date',$this->Data['prosperityfund']->getFieldInfo('add_date')->getTitle());
			$add_date_SD=new SweetDate(true, true, 'Asia/Tehran');
			$add_date_Text=$add_date_SD->date("l d F Y",$this->Data['prosperityfund']->getAdd_date());
			$this->add_date->setText($add_date_Text);
			$this->setFieldCaption('monthcount',$this->Data['prosperityfund']->getFieldInfo('monthcount')->getTitle());
			$this->monthcount->setText($this->Data['prosperityfund']->getMonthcount());
			$this->setFieldCaption('amountpermonth',$this->Data['prosperityfund']->getFieldInfo('amountpermonth')->getTitle());
			$this->amountpermonth->setText($this->Data['prosperityfund']->getAmountpermonth());
			$this->setFieldCaption('isactive',$this->Data['prosperityfund']->getFieldInfo('isactive')->getTitle());
			$isactiveTitle='No';
			if($this->Data['prosperityfund']->getIsactive()==1)
				$isactiveTitle='Yes';
			$this->isactive->setText($isactiveTitle);
		}
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getInfoRowCode($this->totalamount,$this->getFieldCaption('totalamount')));
		$LTable1->addElement($this->getInfoRowCode($this->add_date,$this->getFieldCaption('add_date')));
		$LTable1->addElement($this->getInfoRowCode($this->monthcount,$this->getFieldCaption('monthcount')));
		$LTable1->addElement($this->getInfoRowCode($this->amountpermonth,$this->getFieldCaption('amountpermonth')));
		$LTable1->addElement($this->getInfoRowCode($this->isactive,$this->getFieldCaption('isactive')));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	public function getJSON()
	{
		parent::getJSON();
		if (key_exists("prosperityfund", $this->Data)){
			$Result=$this->Data['prosperityfund']->GetArray();
			return json_encode($Result);
		}
		return json_encode(array());
	}
}
?>