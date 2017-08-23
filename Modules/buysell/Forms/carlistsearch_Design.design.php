<?php
namespace Modules\buysell\Forms;
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
*@creationDate 1396-05-25 - 2017-08-16 01:15
*@lastUpdate 1396-05-25 - 2017-08-16 01:15
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class carlistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var textbox */
	private $details;
	/**
	 * @return textbox
	 */
	public function getDetails()
	{
		return $this->details;
	}
	/** @var textbox */
	private $priceMin;
	/**
	 * @return textbox
	 */
	public function getPriceMin()
	{
		return $this->priceMin;
	}
    /** @var textbox */
    private $priceMax;
    /**
     * @return textbox
     */
    public function getPriceMax()
    {
        return $this->priceMax;
    }
	/** @var textbox */
	private $adddate;
	/**
	 * @return textbox
	 */
	public function getAdddate()
	{
		return $this->adddate;
	}
	/** @var combobox */
	private $body_carcolor_fid;
	/**
	 * @return combobox
	 */
	public function getBody_carcolor_fid()
	{
		return $this->body_carcolor_fid;
	}
	/** @var combobox */
	private $inner_carcolor_fid;
	/**
	 * @return combobox
	 */
	public function getInner_carcolor_fid()
	{
		return $this->inner_carcolor_fid;
	}
	/** @var combobox */
	private $paytype_fid;
	/**
	 * @return combobox
	 */
	public function getPaytype_fid()
	{
		return $this->paytype_fid;
	}
	/** @var combobox */
	private $cartype_fid;
	/**
	 * @return combobox
	 */
	public function getCartype_fid()
	{
		return $this->cartype_fid;
	}
	/** @var textbox */
	private $usagecountMax;
	/**
	 * @return textbox
	 */
	public function getUsagecountMax()
	{
		return $this->usagecountMax;
	}
    /** @var textbox */
    private $usagecountMin;
    /**
     * @return textbox
     */
    public function getUsagecountMin()
    {
        return $this->usagecountMin;
    }
	/** @var textbox */
	private $wheretodate;
	/**
	 * @return textbox
	 */
	public function getWheretodate()
	{
		return $this->wheretodate;
	}
	/** @var combobox */
	private $carbodystatus_fid;
	/**
	 * @return combobox
	 */
	public function getCarbodystatus_fid()
	{
		return $this->carbodystatus_fid;
	}
	/** @var textbox */
	private $makedateMax,$makedateMin;
	/**
	 * @return textbox
	 */
	public function getMakedateMax()
	{
		return $this->makedateMax;
	}
    /**
     * @return textbox
     */
    public function getMakedateMin()
    {
        return $this->makedateMin;
    }
	/** @var combobox */
	private $carstatus_fid;
	/**
	 * @return combobox
	 */
	public function getCarstatus_fid()
	{
		return $this->carstatus_fid;
	}

    /** @var combobox */
    private $carmaker_fid;
	/** @var combobox */
	private $shasitype_fid;
	/**
	 * @return combobox
	 */
	public function getShasitype_fid()
	{
		return $this->shasitype_fid;
	}
	/** @var CheckBox */
	private $isautogearbox;
	/**
	 * @return CheckBox
	 */
	public function getIsautogearbox()
	{
		return $this->isautogearbox;
	}
	/** @var combobox */
	private $carmodel_fid;
	/**
	 * @return combobox
	 */
	public function getCarmodel_fid()
	{
		return $this->carmodel_fid;
	}
	/** @var combobox */
	private $cartagtype_fid;
	/**
	 * @return combobox
	 */
	public function getCartagtype_fid()
	{
		return $this->cartagtype_fid;
	}
	/** @var combobox */
	private $carentitytype_fid;
	/**
	 * @return combobox
	 */
	public function getCarentitytype_fid()
	{
		return $this->carentitytype_fid;
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
		$this->details= new textbox("details");
		$this->priceMin= new textbox("pricemin");
        $this->priceMax= new textbox("pricemax");
		$this->adddate= new textbox("adddate");
		$this->body_carcolor_fid= new combobox("body_carcolor_fid");
		$this->inner_carcolor_fid= new combobox("inner_carcolor_fid");
		$this->paytype_fid= new combobox("paytype_fid");
		$this->cartype_fid= new combobox("cartype_fid");
		$this->usagecountMin= new textbox("usagecountmin");
        $this->usagecountMax= new textbox("usagecountmax");
		$this->wheretodate= new textbox("wheretodate");
		$this->carbodystatus_fid= new combobox("carbodystatus_fid");
		$this->makedateMax= new textbox("makedatemax");
        $this->makedateMin= new textbox("makedatemin");
		$this->carstatus_fid= new combobox("carstatus_fid");
		$this->shasitype_fid= new combobox("shasitype_fid");
		$this->isautogearbox= new CheckBox("isautogearbox");
		$this->carmodel_fid= new combobox("carmodel_fid");
		$this->cartagtype_fid= new combobox("cartagtype_fid");
		$this->carentitytype_fid= new combobox("carentitytype_fid");
        $this->carmaker_fid= new combobox("carmaker_fid");
		$this->sortby= new combobox("sortby");
		$this->isdesc= new combobox("isdesc");
		$this->search= new SweetButton(true,"جستجو");
		$this->search->setAction("search");
	}
	public function getBodyHTML($command=null)
	{
		if (key_exists("car", $this->Data))
			$this->details->setValue($this->Data['car']->getDetails());
		if (key_exists("car", $this->Data))
			$this->adddate->setValue($this->Data['car']->getAdddate());
			$this->body_carcolor_fid->addOption("", "مهم نیست");
		foreach ($this->Data['body_carcolor_fid'] as $item)
			$this->body_carcolor_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("car", $this->Data))
			$this->body_carcolor_fid->setSelectedValue($this->Data['car']->getBody_carcolor_fid());
			$this->inner_carcolor_fid->addOption("", "مهم نیست");
		foreach ($this->Data['inner_carcolor_fid'] as $item)
			$this->inner_carcolor_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("car", $this->Data))
			$this->inner_carcolor_fid->setSelectedValue($this->Data['car']->getInner_carcolor_fid());
			$this->paytype_fid->addOption("", "مهم نیست");
		foreach ($this->Data['paytype_fid'] as $item)
			$this->paytype_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("car", $this->Data))
			$this->paytype_fid->setSelectedValue($this->Data['car']->getPaytype_fid());
			$this->cartype_fid->addOption("", "مهم نیست");
		foreach ($this->Data['cartype_fid'] as $item)
			$this->cartype_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("car", $this->Data))
			$this->cartype_fid->setSelectedValue($this->Data['car']->getCartype_fid());

		if (key_exists("car", $this->Data))
			$this->wheretodate->setValue($this->Data['car']->getWheretodate());
			$this->carbodystatus_fid->addOption("", "مهم نیست");
		foreach ($this->Data['carbodystatus_fid'] as $item)
			$this->carbodystatus_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("car", $this->Data))
			$this->carbodystatus_fid->setSelectedValue($this->Data['car']->getCarbodystatus_fid());
			$this->carstatus_fid->addOption("", "مهم نیست");
		foreach ($this->Data['carstatus_fid'] as $item)
			$this->carstatus_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("car", $this->Data))
			$this->carstatus_fid->setSelectedValue($this->Data['car']->getCarstatus_fid());
			$this->shasitype_fid->addOption("", "مهم نیست");
		foreach ($this->Data['shasitype_fid'] as $item)
			$this->shasitype_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("car", $this->Data))
			$this->shasitype_fid->setSelectedValue($this->Data['car']->getShasitype_fid());
		$this->isautogearbox->addOption("isautogearbox","1");
		if (key_exists("car", $this->Data))
			$this->isautogearbox->addSelectedValue($this->Data['car']->getIsautogearbox());

        foreach ($this->Data['carmaker_fid'] as $item)
            $this->carmaker_fid->addOption($item->getID(), $item->getTitle());
			$this->carmodel_fid->addOption("", "مهم نیست");
		foreach ($this->Data['carmodel_fid'] as $item)
            $this->carmodel_fid->addGroupedOption($item->getCarmaker_fid(),$item->getID(), $item->getTitle());
        $this->carmodel_fid->setMotherComboboxName($this->carmaker_fid->getName());
		if (key_exists("car", $this->Data))
			$this->carmodel_fid->setSelectedValue($this->Data['car']->getCarmodel_fid());
			$this->cartagtype_fid->addOption("", "مهم نیست");
		foreach ($this->Data['cartagtype_fid'] as $item)
			$this->cartagtype_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("car", $this->Data))
			$this->cartagtype_fid->setSelectedValue($this->Data['car']->getCartagtype_fid());
			$this->carentitytype_fid->addOption("", "مهم نیست");

		if (key_exists("car", $this->Data))
			$this->carentitytype_fid->setSelectedValue($this->Data['car']->getCarentitytype_fid());
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("buysell_carlist");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
        $PageTitlePart->addElement(new Lable("صفحه اصلی > جستجوی‌ خودرو ها"));
		$Page->addElement($PageTitlePart);
		$MessagePart=new Div();
		$MessagePart->setClass("sweet_messagepart");
		$MessagePart->addElement(new Lable($this->getMessage()));
		$Page->addElement($MessagePart);
		$LTable1=new ListTable(4);
		$LTable1->setClass("form");

        $LTable1->addElement(new Lable("برند"));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->carmaker_fid);
        $LTable1->setLastElementClass('form_item_field');
        $LTable1->addElement(new Lable("مدل"));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->carmodel_fid);
        $LTable1->setLastElementClass('form_item_field');
        $LTable1->addElement(new Lable("قیمت از "));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->priceMin);
        $LTable1->setLastElementClass('form_item_field');
        $LTable1->addElement(new Lable("ریال تا "));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->priceMax);
        $LTable1->setLastElementClass('form_item_field');
        $LTable1->addElement(new Lable("رنگ بدنه"));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->body_carcolor_fid);
        $LTable1->setLastElementClass('form_item_field');
        $LTable1->addElement(new Lable("رنگ داخل"));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->inner_carcolor_fid);
        $LTable1->setLastElementClass('form_item_field');
        $LTable1->addElement(new Lable("روش پرداخت"));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->paytype_fid);
        $LTable1->setLastElementClass('form_item_field');
        $LTable1->addElement(new Lable("سوخت"));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->cartype_fid);
        $LTable1->setLastElementClass('form_item_field');
        $LTable1->addElement(new Lable("کارکرد از "));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->usagecountMin);
        $LTable1->setLastElementClass('form_item_field');
        $LTable1->addElement(new Lable("کیلومتر تا "));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->usagecountMax);
        $LTable1->setLastElementClass('form_item_field');
        $LTable1->addElement(new Lable("وضعیت بدنه"));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->carbodystatus_fid);
        $LTable1->setLastElementClass('form_item_field');
//		$LTable1->addElement(new Lable("وضعیت"));
//		$LTable1->setLastElementClass('form_item_caption');
//		$LTable1->addElement($this->carstatus_fid);
//		$LTable1->setLastElementClass('form_item_field');
        $LTable1->addElement(new Lable("نوع شاسی"));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->shasitype_fid);
        $LTable1->setLastElementClass('form_item_field');
        $LTable1->addElement(new Lable("از سال "));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->makedateMin);
        $LTable1->setLastElementClass('form_item_field');
        $LTable1->addElement(new Lable("تا سال "));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->makedateMax);
        $LTable1->setLastElementClass('form_item_field');
        $LTable1->addElement(new Lable("نوع پلاک"));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->cartagtype_fid);
        $LTable1->setLastElementClass('form_item_field');
        $LTable1->addElement(new Lable("روش تحویل"));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->carentitytype_fid);
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
			$this->sortby->addOption('price','قیمت');
		if(isset($_GET['price']))
			$this->price->setValue($_GET['price']);
			$this->sortby->addOption('adddate','تاریخ افزودن آگهی');
		if(isset($_GET['adddate']))
			$this->adddate->setValue($_GET['adddate']);
			$this->sortby->addOption('usagecount','کارکرد');
		if(isset($_GET['usagecount']))
			$this->usagecount->setValue($_GET['usagecount']);
			$this->sortby->addOption('makedate','سال ساخت');
		if(isset($_GET['makedate']))
			$this->makedate->setValue($_GET['makedate']);
		    $this->sortby->addOption('carmodel_fid','مدل ماشین');
		if(isset($_GET['carmodel_fid']))
			$this->carmodel_fid->setSelectedValue($_GET['carmodel_fid']);
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "GET", $Page);
		return $form->getHTML();
	}
}
?>