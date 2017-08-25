<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\html\GRecaptcha;
use core\CoreClasses\html\TextArea;
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
    private $carmaker_fid;
    /** @var combobox */
    private $carmodel_fid;
    /**
     * @return combobox
     */
    public function getCarmodel_fid()
    {
        return $this->carmodel_fid;
    }
	/** @var TextArea */
	private $txtDetails;
	/**
	 * @return TextArea
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
        $this->txtTitle->setClass("form-control");
		$this->cmbComponentGroup= new combobox("cmbComponentGroup");
        $this->cmbComponentGroup->setClass("form-control");
		$this->txtprice= new textbox("txtprice");
        $this->txtprice->setClass("form-control");
		$this->cmbUseStatus= new combobox("cmbUseStatus");
        $this->cmbUseStatus->setClass("form-control");
		$this->cmbCountry= new combobox("cmbCountry");
        $this->cmbCountry->setClass("form-control");
        $this->carmodel_fid= new combobox("carmodel_fid");
        $this->carmodel_fid->setClass("form-control");
        $this->carmaker_fid= new combobox("carmaker_fid");
        $this->carmaker_fid->setClass("form-control");
		$this->txtDetails= new TextArea("txtDetails");
		$this->txtDetails->SetAttribute("rows",5);
        $this->txtDetails->setClass("form-control");
		$this->btnSave= new SweetButton(true,"ذخیره");
		$this->btnSave->setAction("btnSave");
        $this->btnSave->setClass("form-control");
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

        $this->carmaker_fid->addOption(-1, "انتخاب کنید...");
        foreach ($this->Data['carmaker_fid'] as $item)
            $this->carmaker_fid->addOption($item->getID(), $item->getTitle());
        if(isset($this->Data['selectedcarmaker_fid']))
        {
            $this->carmaker_fid->setSelectedValue($this->Data['selectedcarmaker_fid']);
        }
        $this->carmodel_fid->addOption(-1, "انتخاب کنید...");
        if(isset($this->Data['carmodel_fid']))
            foreach ($this->Data['carmodel_fid'] as $item)
                $this->carmodel_fid->addOption($item->getID(), $item->getTitle());
        $this->carmodel_fid->setMotherComboboxName($this->carmaker_fid->getName());
        $this->carmodel_fid->setMotherComboboxAutoLoadMode(ComboBox::$AUTOLOADMODE_AJAX);
        $this->carmodel_fid->setDataLoadJSONURL(DEFAULT_APPURL . "json/fa/buysell/carlist.jsp?");
        if (key_exists("car", $this->Data))
            $this->carmodel_fid->setSelectedValue($this->Data['car']->getCarmodel_fid());

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
            $this->carmodel_fid->setSelectedValue($this->Data['component'][0]['carmodels'][0]['carmodel_fid']);
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

        $LTable1->addElement(new Lable("برند خودرو"));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->carmaker_fid);
        $LTable1->setLastElementClass('form_item_field');
        $LTable1->addElement(new Lable(" مدل خودرو"));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->carmodel_fid);
        $LTable1->setLastElementClass('form_item_field');
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