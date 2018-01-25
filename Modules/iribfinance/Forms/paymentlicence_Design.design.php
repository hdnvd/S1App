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
class paymentlicence_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var lable */
	private $programestimationemployee_fid;
	/** @var lable */
	private $month;
	/** @var lable */
	private $pay_date;
	/** @var lable */
	private $work;
	/** @var lable */
	private $decrementtime;
	/** @var lable */
	private $workfactor;
	public function __construct()
	{

		/******* programestimationemployee_fid *******/
		$this->programestimationemployee_fid= new lable("programestimationemployee_fid");

		/******* month *******/
		$this->month= new lable("month");

		/******* pay_date *******/
		$this->pay_date= new lable("pay_date");

		/******* work *******/
		$this->work= new lable("work");

		/******* decrementtime *******/
		$this->decrementtime= new lable("decrementtime");

		/******* workfactor *******/
		$this->workfactor= new lable("workfactor");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("iribfinance_paymentlicence");
		$Page->addElement($this->getPageTitlePart("اطلاعات " . $this->Data['paymentlicence']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		if (key_exists("paymentlicence", $this->Data)){
			$this->setFieldCaption('programestimationemployee_fid',$this->Data['paymentlicence']->getFieldInfo('programestimationemployee_fid')->getTitle());
			$this->programestimationemployee_fid->setText($this->Data['programestimationemployee_fid']->getID());
			$this->setFieldCaption('month',$this->Data['paymentlicence']->getFieldInfo('month')->getTitle());
			$this->month->setText($this->Data['paymentlicence']->getMonth());
			$this->setFieldCaption('pay_date',$this->Data['paymentlicence']->getFieldInfo('pay_date')->getTitle());
			$pay_date_SD=new SweetDate(true, true, 'Asia/Tehran');
			$pay_date_Text=$pay_date_SD->date("l d F Y",$this->Data['paymentlicence']->getPay_date());
			$this->pay_date->setText($pay_date_Text);
			$this->setFieldCaption('work',$this->Data['paymentlicence']->getFieldInfo('work')->getTitle());
			$this->work->setText($this->Data['paymentlicence']->getWork());
			$this->setFieldCaption('decrementtime',$this->Data['paymentlicence']->getFieldInfo('decrementtime')->getTitle());
			$this->decrementtime->setText($this->Data['paymentlicence']->getDecrementtime());
			$this->setFieldCaption('workfactor',$this->Data['paymentlicence']->getFieldInfo('workfactor')->getTitle());
			$this->workfactor->setText($this->Data['paymentlicence']->getWorkfactor());
		}
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getInfoRowCode($this->programestimationemployee_fid,$this->getFieldCaption('programestimationemployee_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->month,$this->getFieldCaption('month')));
		$LTable1->addElement($this->getInfoRowCode($this->pay_date,$this->getFieldCaption('pay_date')));
		$LTable1->addElement($this->getInfoRowCode($this->work,$this->getFieldCaption('work')));
		$LTable1->addElement($this->getInfoRowCode($this->decrementtime,$this->getFieldCaption('decrementtime')));
		$LTable1->addElement($this->getInfoRowCode($this->workfactor,$this->getFieldCaption('workfactor')));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	public function getJSON()
	{
		parent::getJSON();
		if (key_exists("paymentlicence", $this->Data)){
			$Result=$this->Data['paymentlicence']->GetArray();
			return json_encode($Result);
		}
		return json_encode(array());
	}
}
?>