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
class bankpaymentinfolist_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var textbox */
	private $amount;
	/**
	 * @return textbox
	 */
	public function getAmount()
	{
		return $this->amount;
	}
	/** @var textbox */
	private $payedamount;
	/**
	 * @return textbox
	 */
	public function getPayedamount()
	{
		return $this->payedamount;
	}
	/** @var textbox */
	private $cardnumber;
	/**
	 * @return textbox
	 */
	public function getCardnumber()
	{
		return $this->cardnumber;
	}
	/** @var textbox */
	private $factorserial;
	/**
	 * @return textbox
	 */
	public function getFactorserial()
	{
		return $this->factorserial;
	}
	/** @var combobox */
	private $transaction_fid;
	/**
	 * @return combobox
	 */
	public function getTransaction_fid()
	{
		return $this->transaction_fid;
	}
	/** @var combobox */
	private $status_fid;
	/**
	 * @return combobox
	 */
	public function getStatus_fid()
	{
		return $this->status_fid;
	}
	/** @var textbox */
	private $start_time;
	/**
	 * @return textbox
	 */
	public function getStart_time()
	{
		return $this->start_time;
	}
	/** @var textbox */
	private $commit_time;
	/**
	 * @return textbox
	 */
	public function getCommit_time()
	{
		return $this->commit_time;
	}
	/** @var combobox */
	private $portal_fid;
	/**
	 * @return combobox
	 */
	public function getPortal_fid()
	{
		return $this->portal_fid;
	}
	/** @var textbox */
	private $name;
	/**
	 * @return textbox
	 */
	public function getName()
	{
		return $this->name;
	}
	/** @var textbox */
	private $family;
	/**
	 * @return textbox
	 */
	public function getFamily()
	{
		return $this->family;
	}
	/** @var combobox */
	private $systemuser_fid;
	/**
	 * @return combobox
	 */
	public function getSystemuser_fid()
	{
		return $this->systemuser_fid;
	}
	/** @var textbox */
	private $phonenumber;
	/**
	 * @return textbox
	 */
	public function getPhonenumber()
	{
		return $this->phonenumber;
	}
	/** @var combobox */
	private $sortby;
	/**
	 * @return combobox
	 */
	public function getSortby()
	{
		return $this->sortby;
	}
	/** @var combobox */
	private $isdesc;
	/**
	 * @return combobox
	 */
	public function getIsdesc()
	{
		return $this->isdesc;
	}
	/** @var SweetButton */
	private $search;
	public function __construct()
	{
		$this->amount= new textbox("amount");
		$this->payedamount= new textbox("payedamount");
		$this->cardnumber= new textbox("cardnumber");
		$this->factorserial= new textbox("factorserial");
		$this->transaction_fid= new combobox("transaction_fid");
		$this->status_fid= new combobox("status_fid");
		$this->start_time= new textbox("start_time");
		$this->commit_time= new textbox("commit_time");
		$this->portal_fid= new combobox("portal_fid");
		$this->name= new textbox("name");
		$this->family= new textbox("family");
		$this->systemuser_fid= new combobox("systemuser_fid");
		$this->phonenumber= new textbox("phonenumber");
		$this->sortby= new combobox("sortby");
		$this->isdesc= new combobox("isdesc");
		$this->search= new SweetButton(true,"جستجو");
		$this->search->setAction("search");
	}
	public function getBodyHTML($command=null)
	{
		if (key_exists("bankpaymentinfo", $this->Data))
			$this->amount->setValue($this->Data['bankpaymentinfo']->getAmount());
		if (key_exists("bankpaymentinfo", $this->Data))
			$this->payedamount->setValue($this->Data['bankpaymentinfo']->getPayedamount());
		if (key_exists("bankpaymentinfo", $this->Data))
			$this->cardnumber->setValue($this->Data['bankpaymentinfo']->getCardnumber());
		if (key_exists("bankpaymentinfo", $this->Data))
			$this->factorserial->setValue($this->Data['bankpaymentinfo']->getFactorserial());
			$this->transaction_fid->addOption("", "مهم نیست");
		foreach ($this->Data['transaction_fid'] as $item)
			$this->transaction_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("bankpaymentinfo", $this->Data))
			$this->transaction_fid->setSelectedValue($this->Data['bankpaymentinfo']->getTransaction_fid());
			$this->status_fid->addOption("", "مهم نیست");
		foreach ($this->Data['status_fid'] as $item)
			$this->status_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("bankpaymentinfo", $this->Data))
			$this->status_fid->setSelectedValue($this->Data['bankpaymentinfo']->getStatus_fid());
		if (key_exists("bankpaymentinfo", $this->Data))
			$this->start_time->setValue($this->Data['bankpaymentinfo']->getStart_time());
		if (key_exists("bankpaymentinfo", $this->Data))
			$this->commit_time->setValue($this->Data['bankpaymentinfo']->getCommit_time());
			$this->portal_fid->addOption("", "مهم نیست");
		foreach ($this->Data['portal_fid'] as $item)
			$this->portal_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("bankpaymentinfo", $this->Data))
			$this->portal_fid->setSelectedValue($this->Data['bankpaymentinfo']->getPortal_fid());
		if (key_exists("bankpaymentinfo", $this->Data))
			$this->name->setValue($this->Data['bankpaymentinfo']->getName());
		if (key_exists("bankpaymentinfo", $this->Data))
			$this->family->setValue($this->Data['bankpaymentinfo']->getFamily());
			$this->systemuser_fid->addOption("", "مهم نیست");
		foreach ($this->Data['systemuser_fid'] as $item)
			$this->systemuser_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("bankpaymentinfo", $this->Data))
			$this->systemuser_fid->setSelectedValue($this->Data['bankpaymentinfo']->getSystemuser_fid());
		if (key_exists("bankpaymentinfo", $this->Data))
			$this->phonenumber->setValue($this->Data['bankpaymentinfo']->getPhonenumber());
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("finance_bankpaymentinfolist");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
		$PageTitlePart->addElement(new Lable("bankpaymentinfolist"));
		$Page->addElement($PageTitlePart);
		$MessagePart=new Div();
		$MessagePart->setClass("sweet_messagepart");
		$MessagePart->addElement(new Lable($this->getMessage()));
		$Page->addElement($MessagePart);
		$LTable1=new ListTable(4);
		$LTable1->setClass("searchtable");
		$LTable1->addElement(new Lable("amount"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->amount);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("payedamount"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->payedamount);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("cardnumber"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->cardnumber);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("factorserial"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->factorserial);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("transaction_fid"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->transaction_fid);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("status_fid"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->status_fid);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("start_time"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->start_time);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("commit_time"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->commit_time);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("portal_fid"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->portal_fid);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("name"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->name);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("family"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->family);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("systemuser_fid"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->systemuser_fid);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("phonenumber"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->phonenumber);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("مرتب سازی بر اساس"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->sortby);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("نوع مرتب سازی"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->isdesc);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement($this->search,2);
		$LTable1->setLastElementClass('form_item_sweetbutton');
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');
			$this->sortby->addOption('amount','amount');
		if(isset($_GET['amount']))
			$this->amount->setValue($_GET['amount']);
			$this->sortby->addOption('payedamount','payedamount');
		if(isset($_GET['payedamount']))
			$this->payedamount->setValue($_GET['payedamount']);
			$this->sortby->addOption('cardnumber','cardnumber');
		if(isset($_GET['cardnumber']))
			$this->cardnumber->setValue($_GET['cardnumber']);
			$this->sortby->addOption('factorserial','factorserial');
		if(isset($_GET['factorserial']))
			$this->factorserial->setValue($_GET['factorserial']);
			$this->sortby->addOption('transaction_fid','transaction_fid');
		if(isset($_GET['transaction_fid']))
			$this->transaction_fid->setSelectedValue($_GET['transaction_fid']);
			$this->sortby->addOption('status_fid','status_fid');
		if(isset($_GET['status_fid']))
			$this->status_fid->setSelectedValue($_GET['status_fid']);
			$this->sortby->addOption('start_time','start_time');
		if(isset($_GET['start_time']))
			$this->start_time->setValue($_GET['start_time']);
			$this->sortby->addOption('commit_time','commit_time');
		if(isset($_GET['commit_time']))
			$this->commit_time->setValue($_GET['commit_time']);
			$this->sortby->addOption('portal_fid','portal_fid');
		if(isset($_GET['portal_fid']))
			$this->portal_fid->setSelectedValue($_GET['portal_fid']);
			$this->sortby->addOption('name','name');
		if(isset($_GET['name']))
			$this->name->setValue($_GET['name']);
			$this->sortby->addOption('family','family');
		if(isset($_GET['family']))
			$this->family->setValue($_GET['family']);
			$this->sortby->addOption('systemuser_fid','systemuser_fid');
		if(isset($_GET['systemuser_fid']))
			$this->systemuser_fid->setSelectedValue($_GET['systemuser_fid']);
			$this->sortby->addOption('phonenumber','phonenumber');
		if(isset($_GET['phonenumber']))
			$this->phonenumber->setValue($_GET['phonenumber']);
			$this->sortby->addOption('sortby','sortby');
		if(isset($_GET['sortby']))
			$this->sortby->setSelectedValue($_GET['sortby']);
			$this->sortby->addOption('isdesc','isdesc');
		if(isset($_GET['isdesc']))
			$this->isdesc->setSelectedValue($_GET['isdesc']);
			$this->sortby->addOption('search','search');
		$Page->addElement($LTable1);
		$Div1=new Div();
		$Div1->setClass("list");
		if(count($this->Data['data'])==0)
		{
			if(isset($_GET['action']) && $_GET['action']=="search_Click")
				$Div1->addElement(new Lable("هیچ آیتمی با مشخصات وارد شده پیدا نشد."));
			else
				$Div1->addElement(new Lable("هیچ آیتمی برای نمایش وجود ندارد."));
		}
		for($i=0;$i<count($this->Data['data']);$i++){
		$innerDiv[$i]=new Div();
		$innerDiv[$i]->setClass("listitem");
			$url=new AppRooter('finance','bankpaymentinfo');
			$url->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
				$Title=$this->Data['data'][$i]->getDeletetime();
			if($this->Data['data'][$i]->getDeletetime()=="")
				$Title='----------';
			$lbTit[$i]=new Lable($Title);
			$liTit[$i]=new link($url->getAbsoluteURL(),$lbTit[$i]);
			$innerDiv[$i]->addElement($liTit[$i]);
			$Div1->addElement($innerDiv[$i]);
		}
		$Page->addElement($Div1);
		$Page->addElement($this->getPaginationPart($this->Data['pagecount']));
		$form=new SweetFrom("", "GET", $Page);
		return $form->getHTML();
	}
	private function getPaginationPart($PageCount)
	{
		$div=new Div();
		for($i=1;$i<=$PageCount;$i++)
		{
			$RTR=null;
			if(isset($_GET['action']) && $_GET['action']=="search_Click")
				$RTR=new AppRooter("finance","bankpaymentinfolist");
			else
			{
				$RTR=new AppRooter("finance","bankpaymentinfolist");
				//$RTR->addParameter(new UrlParameter("g",$this->Data['groupid']));
			}
			$RTR->addParameter(new UrlParameter("pn",$i));
			$RTR->setAppendToCurrentParams(false);
			$lbl=new Lable($i);
			$lnk=new link($RTR->getAbsoluteURL(),$lbl);
			$div->addElement($lnk);
		}
		return $div;
	}
}
?>