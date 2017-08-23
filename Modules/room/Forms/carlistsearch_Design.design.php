<?php
namespace Modules\room\Forms;
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
	private $price;
	/**
	 * @return textbox
	 */
	public function getPrice()
	{
		return $this->price;
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
	private $usagecount;
	/**
	 * @return textbox
	 */
	public function getUsagecount()
	{
		return $this->usagecount;
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
	private $makedate;
	/**
	 * @return textbox
	 */
	public function getMakedate()
	{
		return $this->makedate;
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
		$this->price= new textbox("price");
		$this->adddate= new textbox("adddate");
		$this->body_carcolor_fid= new combobox("body_carcolor_fid");
		$this->inner_carcolor_fid= new combobox("inner_carcolor_fid");
		$this->paytype_fid= new combobox("paytype_fid");
		$this->cartype_fid= new combobox("cartype_fid");
		$this->usagecount= new textbox("usagecount");
		$this->wheretodate= new textbox("wheretodate");
		$this->carbodystatus_fid= new combobox("carbodystatus_fid");
		$this->makedate= new textbox("makedate");
		$this->carstatus_fid= new combobox("carstatus_fid");
		$this->shasitype_fid= new combobox("shasitype_fid");
		$this->isautogearbox= new CheckBox("isautogearbox");
		$this->carmodel_fid= new combobox("carmodel_fid");
		$this->cartagtype_fid= new combobox("cartagtype_fid");
		$this->carentitytype_fid= new combobox("carentitytype_fid");
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
			$this->price->setValue($this->Data['car']->getPrice());
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
			$this->usagecount->setValue($this->Data['car']->getUsagecount());
		if (key_exists("car", $this->Data))
			$this->wheretodate->setValue($this->Data['car']->getWheretodate());
			$this->carbodystatus_fid->addOption("", "مهم نیست");
		foreach ($this->Data['carbodystatus_fid'] as $item)
			$this->carbodystatus_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("car", $this->Data))
			$this->carbodystatus_fid->setSelectedValue($this->Data['car']->getCarbodystatus_fid());
		if (key_exists("car", $this->Data))
			$this->makedate->setValue($this->Data['car']->getMakedate());
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
			$this->carmodel_fid->addOption("", "مهم نیست");
		foreach ($this->Data['carmodel_fid'] as $item)
			$this->carmodel_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("car", $this->Data))
			$this->carmodel_fid->setSelectedValue($this->Data['car']->getCarmodel_fid());
			$this->cartagtype_fid->addOption("", "مهم نیست");
		foreach ($this->Data['cartagtype_fid'] as $item)
			$this->cartagtype_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("car", $this->Data))
			$this->cartagtype_fid->setSelectedValue($this->Data['car']->getCartagtype_fid());
			$this->carentitytype_fid->addOption("", "مهم نیست");
		foreach ($this->Data['carentitytype_fid'] as $item)
			$this->carentitytype_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("car", $this->Data))
			$this->carentitytype_fid->setSelectedValue($this->Data['car']->getCarentitytype_fid());
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("room_carlist");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
		$PageTitlePart->addElement(new Lable("carlist"));
		$Page->addElement($PageTitlePart);
		$MessagePart=new Div();
		$MessagePart->setClass("sweet_messagepart");
		$MessagePart->addElement(new Lable($this->getMessage()));
		$Page->addElement($MessagePart);
		$LTable1=new ListTable(4);
		$LTable1->setClass("searchtable");
		$LTable1->addElement(new Lable("details"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->details);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("price"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->price);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("adddate"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->adddate);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("body_carcolor_fid"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->body_carcolor_fid);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("inner_carcolor_fid"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->inner_carcolor_fid);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("paytype_fid"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->paytype_fid);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("cartype_fid"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->cartype_fid);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("usagecount"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->usagecount);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("wheretodate"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->wheretodate);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("carbodystatus_fid"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->carbodystatus_fid);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("makedate"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->makedate);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("carstatus_fid"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->carstatus_fid);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("shasitype_fid"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->shasitype_fid);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement($this->isautogearbox,2);
		$LTable1->setLastElementClass('form_item_checkbox');
		$LTable1->addElement(new Lable("carmodel_fid"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->carmodel_fid);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("cartagtype_fid"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->cartagtype_fid);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement(new Lable("carentitytype_fid"));
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
			$this->sortby->addOption('details','details');
		if(isset($_GET['details']))
			$this->details->setValue($_GET['details']);
			$this->sortby->addOption('price','price');
		if(isset($_GET['price']))
			$this->price->setValue($_GET['price']);
			$this->sortby->addOption('adddate','adddate');
		if(isset($_GET['adddate']))
			$this->adddate->setValue($_GET['adddate']);
			$this->sortby->addOption('body_carcolor_fid','body_carcolor_fid');
		if(isset($_GET['body_carcolor_fid']))
			$this->body_carcolor_fid->setSelectedValue($_GET['body_carcolor_fid']);
			$this->sortby->addOption('inner_carcolor_fid','inner_carcolor_fid');
		if(isset($_GET['inner_carcolor_fid']))
			$this->inner_carcolor_fid->setSelectedValue($_GET['inner_carcolor_fid']);
			$this->sortby->addOption('paytype_fid','paytype_fid');
		if(isset($_GET['paytype_fid']))
			$this->paytype_fid->setSelectedValue($_GET['paytype_fid']);
			$this->sortby->addOption('cartype_fid','cartype_fid');
		if(isset($_GET['cartype_fid']))
			$this->cartype_fid->setSelectedValue($_GET['cartype_fid']);
			$this->sortby->addOption('usagecount','usagecount');
		if(isset($_GET['usagecount']))
			$this->usagecount->setValue($_GET['usagecount']);
			$this->sortby->addOption('wheretodate','wheretodate');
		if(isset($_GET['wheretodate']))
			$this->wheretodate->setValue($_GET['wheretodate']);
			$this->sortby->addOption('carbodystatus_fid','carbodystatus_fid');
		if(isset($_GET['carbodystatus_fid']))
			$this->carbodystatus_fid->setSelectedValue($_GET['carbodystatus_fid']);
			$this->sortby->addOption('makedate','makedate');
		if(isset($_GET['makedate']))
			$this->makedate->setValue($_GET['makedate']);
			$this->sortby->addOption('carstatus_fid','carstatus_fid');
		if(isset($_GET['carstatus_fid']))
			$this->carstatus_fid->setSelectedValue($_GET['carstatus_fid']);
			$this->sortby->addOption('shasitype_fid','shasitype_fid');
		if(isset($_GET['shasitype_fid']))
			$this->shasitype_fid->setSelectedValue($_GET['shasitype_fid']);
			$this->sortby->addOption('isautogearbox','isautogearbox');
		if(isset($_GET['isautogearbox']))
			$this->isautogearbox->addSelectedValue($_GET['isautogearbox']);
			$this->sortby->addOption('carmodel_fid','carmodel_fid');
		if(isset($_GET['carmodel_fid']))
			$this->carmodel_fid->setSelectedValue($_GET['carmodel_fid']);
			$this->sortby->addOption('cartagtype_fid','cartagtype_fid');
		if(isset($_GET['cartagtype_fid']))
			$this->cartagtype_fid->setSelectedValue($_GET['cartagtype_fid']);
			$this->sortby->addOption('carentitytype_fid','carentitytype_fid');
		if(isset($_GET['carentitytype_fid']))
			$this->carentitytype_fid->setSelectedValue($_GET['carentitytype_fid']);
			$this->sortby->addOption('sortby','sortby');
		if(isset($_GET['sortby']))
			$this->sortby->setSelectedValue($_GET['sortby']);
			$this->sortby->addOption('isdesc','isdesc');
		if(isset($_GET['isdesc']))
			$this->isdesc->setSelectedValue($_GET['isdesc']);
			$this->sortby->addOption('search','search');
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "GET", $Page);
		return $form->getHTML();
	}
}
?>