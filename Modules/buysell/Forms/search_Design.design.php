<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\CheckBox;
use core\CoreClasses\html\RadioBox;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\ComboBox;
use core\CoreClasses\html\FileUploadBox;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-02-19 - 2017-05-09 17:42
*@lastUpdate 1396-02-19 - 2017-05-09 17:42
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class search_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var textbox */
	private $txtTitle;
	/**
	 * @return textbox
	 */
	public function getTxtTitle()
	{
		return $this->txtTitle;
	}
    /** @var combobox */
    private $cmbProvince;
    /**
     * @return combobox
     */
    public function getCmbProvince()
    {
        return $this->cmbProvince;
    }

	/** @var combobox */
    private $cmbGroup;
    /**
     * @return combobox
     */
    public function getCmbGroup()
    {
        return $this->cmbGroup;
    }
	/** @var textbox */
	private $txtPriceLB;
	/**
	 * @return textbox
	 */
	public function getTxtPriceLB()
	{
		return $this->txtPriceLB;
	}
	/** @var textbox */
	private $txtPriceUB;
	/**
	 * @return textbox
	 */
	public function getTxtPriceUB()
	{
		return $this->txtPriceUB;
	}
	/** @var combobox */
	private $cmbCountry;
	/**
	 * @return combobox
	 */
	public function getCmbCountry()
	{
		return $this->cmbCountry;
	}
	/** @var combobox */
	private $cmbStatus;
	/**
	 * @return combobox
	 */
	public function getCmbStatus()
	{
		return $this->cmbStatus;
	}
	/** @var combobox */
	private $cmbCarModel;
	/**
	 * @return combobox
	 */
	public function getCmbCarModel()
	{
		return $this->cmbCarModel;
	}
	/** @var combobox */
	private $cmbSortBY;
	/**
	 * @return combobox
	 */
	public function getCmbSortBY()
	{
		return $this->cmbSortBY;
	}/** @var combobox */
    private $cmbSortBYOrder;
    /**
     * @return combobox
     */
    public function getCmbSortBYOrder()
    {
        return $this->cmbSortBYOrder;
    }
	/** @var SweetButton */
	private $btnSearch;
	public function __construct()
	{
		$this->txtTitle= new textbox("txtTitle");
        $this->txtTitle->setClass("form-control");
		$this->cmbGroup= new combobox("cmbGroup");
        $this->cmbGroup->setClass("form-control");
		$this->txtPriceLB= new textbox("txtPriceLB");
        $this->txtPriceLB->setClass("form-control");
		$this->txtPriceUB= new textbox("txtPriceUB");
        $this->txtPriceUB->setClass("form-control");
		$this->cmbCountry= new combobox("cmbCountry");
        $this->cmbCountry->setClass("form-control");
		$this->cmbStatus= new combobox("cmbStatus");
        $this->cmbStatus->setClass("form-control");
        $this->cmbStatus->addOption(-1,"مهم نیست");
        $this->cmbStatus->addOption(1,"نو");
        $this->cmbStatus->addOption(2,"کارکرده");
        $this->cmbStatus->addOption(3,"اسقاطی");
		$this->cmbCarModel= new combobox("cmbCarModel");
        $this->cmbCarModel->setClass("form-control");
        $this->cmbProvince= new combobox("cmbProvince");
        $this->cmbProvince->setClass("form-control");
        $this->cmbSortBY= new combobox("cmbSortBY");
        $this->cmbSortBY->setClass("form-control");
        $this->cmbSortBYOrder= new combobox("cmbSortBYOrder");
        $this->cmbSortBYOrder->setClass("form-control");
		$this->btnSearch= new SweetButton(true,"جستجو");
		$this->btnSearch->setAction("btnSearch");
        $this->btnSearch->setClass("form-control");
	}
	public function getBodyHTML($command=null)
	{
        $this->cmbCountry->addOption(-1,"مهم نیست");
        $this->cmbCarModel->addOption(-1,"مهم نیست");
        $this->cmbProvince->addOption(-1,"مهم نیست");
        $this->cmbGroup->addOption(-1,"مهم نیست");
        for ($i=0;$i<count($this->Data['countries']);$i++)
            $this->cmbCountry->addOption($this->Data['countries'][$i]['id'],$this->Data['countries'][$i]['name']);
        for ($i=0;$i<count($this->Data['carmodels']);$i++)
            $this->cmbCarModel->addOption($this->Data['carmodels'][$i]['id'],$this->Data['carmodels'][$i]['carmakertitle'] . " " . $this->Data['carmodels'][$i]['title']);
        for ($i=0;$i<count($this->Data['componentgroups']);$i++)
            $this->cmbGroup->addOption($this->Data['componentgroups'][$i]['id'],$this->Data['componentgroups'][$i]['title']);
        for ($i=0;$i<count($this->Data['provinces']);$i++)
            $this->cmbProvince->addOption($this->Data['provinces'][$i]['id'],$this->Data['provinces'][$i]['title']);

        $this->cmbSortBY->addOption(1,"عنوان");
        $this->cmbSortBY->addOption(2,"قیمت");
        $this->cmbSortBY->addOption(3,"گروه");
        $this->cmbSortBY->addOption(4,"مدل خودرو");
        $this->cmbSortBY->addOption(5,"کشور سازنده");
        $this->cmbSortBYOrder->addOption(0,"صعودی ");
        $this->cmbSortBYOrder->addOption(1,"نزولی");
        $Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("buysell_search");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
		$PageTitlePart->addElement(new Lable("جستجو"));
		$Page->addElement($PageTitlePart);
		$MessagePart=new Div();
		$MessagePart->setClass("sweet_messagepart");
		$MessagePart->addElement(new Lable($this->getMessage()));
		$Page->addElement($MessagePart);
		$LTable1=new ListTable(3);
		$LTable1->addElement(new Lable("عنوان"));
		$LTable1->addElement($this->txtTitle,2);
		$LTable1->addElement(new Lable("گروه"));
		$LTable1->addElement($this->cmbGroup,2);
		$LTable1->addElement(new Lable("قیمت از"));
		$LTable1->addElement($this->txtPriceLB,2);
		$LTable1->addElement(new Lable("تا"));
		$LTable1->addElement($this->txtPriceUB,2);
		$LTable1->addElement(new Lable("کشور سازنده"));
		$LTable1->addElement($this->cmbCountry,2);
		$LTable1->addElement(new Lable("وضعیت"));
		$LTable1->addElement($this->cmbStatus,2);
		$LTable1->addElement(new Lable("مدل خودرو"));
		$LTable1->addElement($this->cmbCarModel,2);
        $LTable1->addElement(new Lable("استان"));
        $LTable1->addElement($this->cmbProvince,2);
		$LTable1->addElement(new Lable("مرتب سازی بر اساس"));
		$LTable1->addElement($this->cmbSortBY);
        $LTable1->addElement($this->cmbSortBYOrder);
		$LTable1->addElement($this->btnSearch,2);
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "GET", $Page);
		return $form->getHTML();
	}
}
?>