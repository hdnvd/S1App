<?php
namespace Modules\company\Forms;
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
*@creationDate 1396-06-28 - 2017-09-19 16:32
*@lastUpdate 1396-06-28 - 2017-09-19 16:32
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class orderlist_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var textbox */
	private $descriptions;
	/**
	 * @return textbox
	 */
	public function getDescriptions()
	{
		return $this->descriptions;
	}
	/** @var textbox */
	private $similarproducts;
	/**
	 * @return textbox
	 */
	public function getSimilarproducts()
	{
		return $this->similarproducts;
	}
	/** @var textbox */
	private $email;
	/**
	 * @return textbox
	 */
	public function getEmail()
	{
		return $this->email;
	}
	/** @var textbox */
	private $orderdate;
	/**
	 * @return textbox
	 */
	public function getOrderdate()
	{
		return $this->orderdate;
	}
	/** @var textbox */
	private $mobile;
	/**
	 * @return textbox
	 */
	public function getMobile()
	{
		return $this->mobile;
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
	/** @var textbox */
	private $paydate;
	/**
	 * @return textbox
	 */
	public function getPaydate()
	{
		return $this->paydate;
	}
	/** @var combobox */
	private $package_fid;
	/**
	 * @return combobox
	 */
	public function getPackage_fid()
	{
		return $this->package_fid;
	}
	/** @var combobox */
	private $finance_transaction_fid;
	/**
	 * @return combobox
	 */
	public function getFinance_transaction_fid()
	{
		return $this->finance_transaction_fid;
	}
	/** @var combobox */
	private $prepayment_finance_transaction_fid;
	/**
	 * @return combobox
	 */
	public function getPrepayment_finance_transaction_fid()
	{
		return $this->prepayment_finance_transaction_fid;
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
		$this->descriptions= new textbox("descriptions");
		$this->similarproducts= new textbox("similarproducts");
		$this->email= new textbox("email");
		$this->orderdate= new textbox("orderdate");
		$this->mobile= new textbox("mobile");
		$this->name= new textbox("name");
		$this->family= new textbox("family");
		$this->paydate= new textbox("paydate");
		$this->package_fid= new combobox("package_fid");
		$this->finance_transaction_fid= new combobox("finance_transaction_fid");
		$this->prepayment_finance_transaction_fid= new combobox("prepayment_finance_transaction_fid");
		$this->sortby= new combobox("sortby");
		$this->isdesc= new combobox("isdesc");
		$this->search= new SweetButton(true,"جستجو");
		$this->search->setAction("search");
	}
	public function getBodyHTML($command=null)
	{
		if (key_exists("order", $this->Data))
			$this->descriptions->setValue($this->Data['order']->getDescriptions());
		if (key_exists("order", $this->Data))
			$this->similarproducts->setValue($this->Data['order']->getSimilarproducts());
		if (key_exists("order", $this->Data))
			$this->email->setValue($this->Data['order']->getEmail());
		if (key_exists("order", $this->Data))
			$this->orderdate->setValue($this->Data['order']->getOrderdate());
		if (key_exists("order", $this->Data))
			$this->mobile->setValue($this->Data['order']->getMobile());
		if (key_exists("order", $this->Data))
			$this->name->setValue($this->Data['order']->getName());
		if (key_exists("order", $this->Data))
			$this->family->setValue($this->Data['order']->getFamily());
		if (key_exists("order", $this->Data))
			$this->paydate->setValue($this->Data['order']->getPaydate());
			$this->package_fid->addOption("", "مهم نیست");
		foreach ($this->Data['package_fid'] as $item)
			$this->package_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("order", $this->Data))
			$this->package_fid->setSelectedValue($this->Data['order']->getPackage_fid());
			$this->finance_transaction_fid->addOption("", "مهم نیست");
		foreach ($this->Data['finance_transaction_fid'] as $item)
			$this->finance_transaction_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("order", $this->Data))
			$this->finance_transaction_fid->setSelectedValue($this->Data['order']->getFinance_transaction_fid());
			$this->prepayment_finance_transaction_fid->addOption("", "مهم نیست");
		foreach ($this->Data['prepayment_finance_transaction_fid'] as $item)
			$this->prepayment_finance_transaction_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("order", $this->Data))
			$this->prepayment_finance_transaction_fid->setSelectedValue($this->Data['order']->getPrepayment_finance_transaction_fid());
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("company_orderlist");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
		$PageTitlePart->addElement(new Lable("orderlist"));
		$Page->addElement($PageTitlePart);
		$MessagePart=new Div();
		$MessagePart->setClass("sweet_messagepart");
		$MessagePart->addElement(new Lable($this->getMessage()));
		$Page->addElement($MessagePart);
		$LTable1=new ListTable(4);
		$LTable1->setClass("searchtable");
		$LTable1->addElement(new Lable("descriptions"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->descriptions);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("similarproducts"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->similarproducts);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("email"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->email);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("orderdate"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->orderdate);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("mobile"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->mobile);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("name"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->name);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("family"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->family);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("paydate"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->paydate);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("package_fid"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->package_fid);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("finance_transaction_fid"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->finance_transaction_fid);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("prepayment_finance_transaction_fid"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->prepayment_finance_transaction_fid);
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
			$this->sortby->addOption('descriptions','descriptions');
		if(isset($_GET['descriptions']))
			$this->descriptions->setValue($_GET['descriptions']);
			$this->sortby->addOption('similarproducts','similarproducts');
		if(isset($_GET['similarproducts']))
			$this->similarproducts->setValue($_GET['similarproducts']);
			$this->sortby->addOption('email','email');
		if(isset($_GET['email']))
			$this->email->setValue($_GET['email']);
			$this->sortby->addOption('orderdate','orderdate');
		if(isset($_GET['orderdate']))
			$this->orderdate->setValue($_GET['orderdate']);
			$this->sortby->addOption('mobile','mobile');
		if(isset($_GET['mobile']))
			$this->mobile->setValue($_GET['mobile']);
			$this->sortby->addOption('name','name');
		if(isset($_GET['name']))
			$this->name->setValue($_GET['name']);
			$this->sortby->addOption('family','family');
		if(isset($_GET['family']))
			$this->family->setValue($_GET['family']);
			$this->sortby->addOption('paydate','paydate');
		if(isset($_GET['paydate']))
			$this->paydate->setValue($_GET['paydate']);
			$this->sortby->addOption('package_fid','package_fid');
		if(isset($_GET['package_fid']))
			$this->package_fid->setSelectedValue($_GET['package_fid']);
			$this->sortby->addOption('finance_transaction_fid','finance_transaction_fid');
		if(isset($_GET['finance_transaction_fid']))
			$this->finance_transaction_fid->setSelectedValue($_GET['finance_transaction_fid']);
			$this->sortby->addOption('prepayment_finance_transaction_fid','prepayment_finance_transaction_fid');
		if(isset($_GET['prepayment_finance_transaction_fid']))
			$this->prepayment_finance_transaction_fid->setSelectedValue($_GET['prepayment_finance_transaction_fid']);
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
			$url=new AppRooter('company','order');
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
	protected function getPaginationPart($PageCount)
	{
		$div=new Div();
		for($i=1;$i<=$PageCount;$i++)
		{
			$RTR=null;
			if(isset($_GET['action']) && $_GET['action']=="search_Click")
				$RTR=new AppRooter("company","orderlist");
			else
			{
				$RTR=new AppRooter("company","orderlist");
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