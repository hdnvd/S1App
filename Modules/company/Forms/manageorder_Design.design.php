<?php
namespace Modules\company\Forms;
use core\CoreClasses\html\TextArea;
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
class manageorder_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}    
private $adminMode=true;

    /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
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
	/** @var SweetButton */
	private $btnSave;
	public function __construct()
	{
		$this->descriptions= new TextArea("descriptions");
		$this->similarproducts= new TextArea("similarproducts");
		$this->email= new textbox("email");
		$this->orderdate= new textbox("orderdate");
		$this->mobile= new textbox("mobile");
		$this->name= new textbox("name");
		$this->family= new textbox("family");
		$this->paydate= new textbox("paydate");
		$this->package_fid= new combobox("package_fid");
		$this->btnSave= new SweetButton(true,"ثبت سفارش");
		$this->btnSave->setAction("btnSave");
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
		foreach ($this->Data['package_fid'] as $item)
			$this->package_fid->addOption($item->getID(), $item->getTitle());
		if (isset($_GET['package']))
			$this->package_fid->setSelectedValue($_GET['package']);

		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("company_manageorder");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
		$PageTitlePart->addElement(new Lable("سفارش نرم افزار"));
		$Page->addElement($PageTitlePart);
		$MessagePart=new Div();
		$MessagePart->setClass("sweet_messagepart");
		$MessagePart->addElement(new Lable($this->getMessage()));
		$Page->addElement($MessagePart);
		$LTable1=new ListTable(2);
		$LTable1->setClass("formtable");

        $LTable1->addElement(new Lable("بسته آماده انتخابی"));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->package_fid);
        $LTable1->setLastElementClass('form_item_field');


        $LTable1->addElement(new Lable("نام"));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->name);
        $LTable1->setLastElementClass('form_item_field');
        $LTable1->addElement(new Lable("نام خانوادگی"));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->family);
        $LTable1->setLastElementClass('form_item_field');

        $LTable1->addElement(new Lable("شماره موبایل(برای تماس و تحویل)"));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->mobile);
        $LTable1->setLastElementClass('form_item_field');

		$LTable1->addElement(new Lable("آدرس ایمیل"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->email);
		$LTable1->setLastElementClass('form_item_field');

        $LTable1->addElement(new Lable("مشخصات نرم افزار درخواستی"),2);
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->descriptions,2);
        $LTable1->setLastElementClass('form_item_field');
        $LTable1->addElement(new Lable("در صورت نیاز می توانید نمونه های مشابه محصول مورد نیازتان را وارد کنید:"),2);
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->similarproducts,2);
        $LTable1->setLastElementClass('form_item_field');

		$LTable1->addElement($this->btnSave,2);
		$LTable1->setLastElementClass('form_item_sweetbutton');
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>