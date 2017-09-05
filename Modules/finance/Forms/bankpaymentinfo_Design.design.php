<?php
namespace Modules\finance\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\link;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\CheckBox;
use core\CoreClasses\html\RadioBox;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\ComboBox;
use core\CoreClasses\html\FileUploadBox;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-13 - 2017-09-04 18:38
*@lastUpdate 1396-06-13 - 2017-09-04 18:38
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class bankpaymentinfo_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var lable */
	private $amount;
	/** @var lable */
	private $payedamount;
	/** @var lable */
	private $cardnumber;
	/** @var lable */
	private $factorserial;
	/** @var lable */
	private $transaction_fid;
	/** @var lable */
	private $status_fid;
	/** @var lable */
	private $start_time;
	/** @var lable */
	private $commit_time;
	/** @var lable */
	private $portal_fid;
	/** @var lable */
	private $name;
	/** @var lable */
	private $family;
	/** @var lable */
	private $systemuser_fid;
	/** @var lable */
	private $phonenumber;
	public function __construct()
	{
		$this->amount= new lable("amount");
		$this->payedamount= new lable("payedamount");
		$this->cardnumber= new lable("cardnumber");
		$this->factorserial= new lable("factorserial");
		$this->transaction_fid= new lable("transaction_fid");
		$this->status_fid= new lable("status_fid");
		$this->start_time= new lable("start_time");
		$this->commit_time= new lable("commit_time");
		$this->portal_fid= new lable("portal_fid");
		$this->name= new lable("name");
		$this->family= new lable("family");
		$this->systemuser_fid= new lable("systemuser_fid");
		$this->phonenumber= new lable("phonenumber");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("finance_bankpaymentinfo");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
		$PageTitlePart->addElement(new Lable("bankpaymentinfo"));
		$Page->addElement($PageTitlePart);
		$MessagePart=new Div();
		$MessagePart->setClass("sweet_messagepart");
		$MessagePart->addElement(new Lable($this->getMessage()));
		$Page->addElement($MessagePart);
		if (key_exists("bankpaymentinfo", $this->Data)){
			$this->amount->setText($this->Data['bankpaymentinfo']->getAmount());
		}
		if (key_exists("bankpaymentinfo", $this->Data)){
			$this->payedamount->setText($this->Data['bankpaymentinfo']->getPayedamount());
		}
		if (key_exists("bankpaymentinfo", $this->Data)){
			$this->cardnumber->setText($this->Data['bankpaymentinfo']->getCardnumber());
		}
		if (key_exists("bankpaymentinfo", $this->Data)){
			$this->factorserial->setText($this->Data['bankpaymentinfo']->getFactorserial());
		}
		if (key_exists("transaction_fid", $this->Data)){
			$this->transaction_fid->setText($this->Data['transaction_fid']->getID());
		}
		if (key_exists("status_fid", $this->Data)){
			$this->status_fid->setText($this->Data['status_fid']->getID());
		}
		if (key_exists("bankpaymentinfo", $this->Data)){
			$this->start_time->setText($this->Data['bankpaymentinfo']->getStart_time());
		}
		if (key_exists("bankpaymentinfo", $this->Data)){
			$this->commit_time->setText($this->Data['bankpaymentinfo']->getCommit_time());
		}
		if (key_exists("portal_fid", $this->Data)){
			$this->portal_fid->setText($this->Data['portal_fid']->getID());
		}
		if (key_exists("bankpaymentinfo", $this->Data)){
			$this->name->setText($this->Data['bankpaymentinfo']->getName());
		}
		if (key_exists("bankpaymentinfo", $this->Data)){
			$this->family->setText($this->Data['bankpaymentinfo']->getFamily());
		}
		if (key_exists("systemuser_fid", $this->Data)){
			$this->systemuser_fid->setText($this->Data['systemuser_fid']->getID());
		}
		if (key_exists("bankpaymentinfo", $this->Data)){
			$this->phonenumber->setText($this->Data['bankpaymentinfo']->getPhonenumber());
		}
		$LTable1=new ListTable(2);
		$LTable1->setClass("formtable");
		$LTable1->addElement(new Lable("amount"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->amount);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("payedamount"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->payedamount);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("cardnumber"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->cardnumber);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("factorserial"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->factorserial);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("transaction_fid"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->transaction_fid);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("status_fid"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->status_fid);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("start_time"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->start_time);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("commit_time"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->commit_time);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("portal_fid"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->portal_fid);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("name"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->name);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("family"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->family);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("systemuser_fid"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->systemuser_fid);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("phonenumber"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->phonenumber);
		$LTable1->setLastElementClass('form_item_datalabel');
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>