<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\html\GRecaptcha;
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
*@creationDate 1395-11-26 - 2017-02-14 14:56
*@lastUpdate 1395-11-26 - 2017-02-14 14:56
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class managecomponent_Design extends FormDesign {
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
	private $cmbComponentGroup;
	/**
	 * @return combobox
	 */
	public function getCmbComponentGroup()
	{
		return $this->cmbComponentGroup;
	}
	/** @var textbox */
	private $txtprice;
	/**
	 * @return textbox
	 */
	public function getTxtprice()
	{
		return $this->txtprice;
	}
	/** @var combobox */
	private $cmbUseStatus;
	/**
	 * @return combobox
	 */
	public function getCmbUseStatus()
	{
		return $this->cmbUseStatus;
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
	private $cmbCarModel;
	/**
	 * @return combobox
	 */
	public function getCmbCarModel()
	{
		return $this->cmbCarModel;
	}
	/** @var textbox */
	private $txtDetails;
	/**
	 * @return textbox
	 */
	public function getTxtDetails()
	{
		return $this->txtDetails;
	}
	/** @var SweetButton */
	private $btnSave;
    /**
     * @var GRecaptcha
     */
    private $Recaptcha;

    /**
     * @return GRecaptcha
     */
    public function getRecaptcha()
    {
        return $this->Recaptcha;
    }
	public function __construct()
	{
		$this->txtTitle= new textbox("txtTitle");
		$this->cmbComponentGroup= new combobox("cmbComponentGroup");
		$this->txtprice= new textbox("txtprice");
		$this->cmbUseStatus= new combobox("cmbUseStatus");
		$this->cmbCountry= new combobox("cmbCountry");
		$this->cmbCarModel= new combobox("cmbCarModel");
		$this->txtDetails= new textbox("txtDetails");
		$this->btnSave= new SweetButton(true,"ذخیره");
		$this->btnSave->setAction("btnSave");
        $this->Recaptcha=new GRecaptcha();
	}
	public function getBodyHTML($command=null)
	{
//	    $cl=$this->Data['cols'];
//	    for($i=0;$i<count($cl);$i++)
//        {
//            $c=$cl[$i];
////            $c=new buysell_carcolor2Entity(null);
//            echo $c->getID();
//            echo $c->getLatintitle();
//            echo $c->getTitle();
//        }
		$Page=new Div();
        for ($i=0;$i<count($this->Data['countries']);$i++)
            $this->cmbCountry->addOption($this->Data['countries'][$i]['id'],$this->Data['countries'][$i]['name']);
        for ($i=0;$i<count($this->Data['carmodels']);$i++)
            $this->cmbCarModel->addOption($this->Data['carmodels'][$i]['id'],$this->Data['carmodels'][$i]['carmakertitle'] . " " . $this->Data['carmodels'][$i]['title']);
        for ($i=0;$i<count($this->Data['componentgroups']);$i++)
            $this->cmbComponentGroup->addOption($this->Data['componentgroups'][$i]['id'],$this->Data['componentgroups'][$i]['title']);
        $this->cmbUseStatus->addOption(1,"نو");
        $this->cmbUseStatus->addOption(2,"کارکرده");
        $this->cmbUseStatus->addOption(3,"اسقاطی");
        if(key_exists('component',$this->Data))
        {
            $this->txtTitle->setValue($this->Data['component'][0]['title']);
            $this->txtprice->setValue($this->Data['component'][0]['price']);
            $this->txtDetails->setValue($this->Data['component'][0]['details']);
            $this->cmbComponentGroup->setSelectedValue($this->Data['component'][0]['componentgroup_fid']);
            $this->cmbCarModel->setSelectedValue($this->Data['component'][0]['carmodels'][0]['carmodel_fid']);
            $this->cmbCountry->setSelectedValue($this->Data['component'][0]['country_fid']);
            $this->cmbUseStatus->setSelectedValue($this->Data['component'][0]['usestatus']);
        }
		$Page->setClass("sweet_formtitle");
		$Page->setId("buysell_managecomponent");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
		$PageTitlePart->addElement(new Lable("مدیریت قطعه"));
		$Page->addElement($PageTitlePart);
		$MessagePart=new Div();
		$MessagePart->setClass("sweet_messagepart");
		$MessagePart->addElement(new Lable($this->getMessage()));
		$Page->addElement($MessagePart);
		$LTable1=new ListTable(2);
		$LTable1->addElement(new Lable("عنوان"));
		$LTable1->addElement($this->txtTitle);
		$LTable1->addElement(new Lable("گروه"));
		$LTable1->addElement($this->cmbComponentGroup);
		$LTable1->addElement(new Lable("قیمت"));
		$LTable1->addElement($this->txtprice);
		$LTable1->addElement(new Lable("وضعیت"));
		$LTable1->addElement($this->cmbUseStatus);
		$LTable1->addElement(new Lable("کشور سازنده"));
		$LTable1->addElement($this->cmbCountry);
		$LTable1->addElement(new Lable("مدل خودرو"));
		$LTable1->addElement($this->cmbCarModel);
		$LTable1->addElement(new Lable("توضیحات"));
		$LTable1->addElement($this->txtDetails);
        $LTable1->addElement($this->Recaptcha,2);
		$LTable1->addElement($this->btnSave,2);
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>