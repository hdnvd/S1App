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
class managecar_Design extends FormDesign {
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
	/** @var SweetButton */
	private $btnSave;
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
		$this->btnSave= new SweetButton(true,"ذخیره");
		$this->btnSave->setAction("btnSave");
	}
	public function getBodyHTML($command=null)
	{
		if (key_exists("car", $this->Data))
			$this->details->setValue($this->Data['car']->getDetails());
		if (key_exists("car", $this->Data))
			$this->price->setValue($this->Data['car']->getPrice());
		if (key_exists("car", $this->Data))
			$this->adddate->setValue($this->Data['car']->getAdddate());
		foreach ($this->Data['body_carcolor_fid'] as $item)
			$this->body_carcolor_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("car", $this->Data))
			$this->body_carcolor_fid->setSelectedValue($this->Data['car']->getBody_carcolor_fid());
		foreach ($this->Data['inner_carcolor_fid'] as $item)
			$this->inner_carcolor_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("car", $this->Data))
			$this->inner_carcolor_fid->setSelectedValue($this->Data['car']->getInner_carcolor_fid());
		foreach ($this->Data['paytype_fid'] as $item)
			$this->paytype_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("car", $this->Data))
			$this->paytype_fid->setSelectedValue($this->Data['car']->getPaytype_fid());
		foreach ($this->Data['cartype_fid'] as $item)
			$this->cartype_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("car", $this->Data))
			$this->cartype_fid->setSelectedValue($this->Data['car']->getCartype_fid());
		if (key_exists("car", $this->Data))
			$this->usagecount->setValue($this->Data['car']->getUsagecount());
		if (key_exists("car", $this->Data))
			$this->wheretodate->setValue($this->Data['car']->getWheretodate());
		foreach ($this->Data['carbodystatus_fid'] as $item)
			$this->carbodystatus_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("car", $this->Data))
			$this->carbodystatus_fid->setSelectedValue($this->Data['car']->getCarbodystatus_fid());
		if (key_exists("car", $this->Data))
			$this->makedate->setValue($this->Data['car']->getMakedate());
		foreach ($this->Data['carstatus_fid'] as $item)
			$this->carstatus_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("car", $this->Data))
			$this->carstatus_fid->setSelectedValue($this->Data['car']->getCarstatus_fid());
		foreach ($this->Data['shasitype_fid'] as $item)
			$this->shasitype_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("car", $this->Data))
			$this->shasitype_fid->setSelectedValue($this->Data['car']->getShasitype_fid());
		$this->isautogearbox->addOption("isautogearbox","1");
		if (key_exists("car", $this->Data))
			$this->isautogearbox->addSelectedValue($this->Data['car']->getIsautogearbox());
		foreach ($this->Data['carmodel_fid'] as $item)
			$this->carmodel_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("car", $this->Data))
			$this->carmodel_fid->setSelectedValue($this->Data['car']->getCarmodel_fid());
		foreach ($this->Data['cartagtype_fid'] as $item)
			$this->cartagtype_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("car", $this->Data))
			$this->cartagtype_fid->setSelectedValue($this->Data['car']->getCartagtype_fid());
		foreach ($this->Data['carentitytype_fid'] as $item)
			$this->carentitytype_fid->addOption($item->getID(), $item->getTitle());
		if (key_exists("car", $this->Data))
			$this->carentitytype_fid->setSelectedValue($this->Data['car']->getCarentitytype_fid());
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("room_managecar");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
		$PageTitlePart->addElement(new Lable("managecar"));
		$Page->addElement($PageTitlePart);
		$MessagePart=new Div();
		$MessagePart->setClass("sweet_messagepart");
		$MessagePart->addElement(new Lable($this->getMessage()));
		$Page->addElement($MessagePart);
		$LTable1=new ListTable(2);
		$LTable1->setClass("formtable");
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
		$LTable1->addElement($this->btnSave,2);
		$LTable1->setLastElementClass('form_item_sweetbutton');
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>