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
*@creationDate 1396-06-15 - 2017-09-06 16:47
*@lastUpdate 1396-06-15 - 2017-09-06 16:47
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class manualpayment_Design extends FormDesign {
	private $Data;
	private $PageTitle="پرداخت الکترونیکی";

    /**
     * @param string $PageTitle
     */
    public function setPageTitle($PageTitle)
    {
        $this->PageTitle = $PageTitle;
    }

    /**
     * @param bool $DisplayManualInfo
     */
    public function setDisplayManualInfo($DisplayManualInfo)
    {
        $this->DisplayManualInfo = $DisplayManualInfo;
    }
    private $DisplayManualInfo=true;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var textbox */
	private $txtName;
	/**
	 * @return textbox
	 */
	public function getTxtName()
	{
		return $this->txtName;
	}
	/** @var textbox */
	private $txtFamily;
	/**
	 * @return textbox
	 */
	public function getTxtFamily()
	{
		return $this->txtFamily;
	}
	/** @var textbox */
	private $txtTel;
	/**
	 * @return textbox
	 */
	public function getTxtTel()
	{
		return $this->txtTel;
	}
	/** @var textbox */
	private $txtDescription;
	/**
	 * @return textbox
	 */
	public function getTxtDescription()
	{
		return $this->txtDescription;
	}
	/** @var textbox */
	private $txtAmount;
	/**
	 * @return textbox
	 */
	public function getTxtAmount()
	{
		return $this->txtAmount;
	}
	/** @var SweetButton */
	private $txtPay;
	public function __construct()
	{
		$this->txtName= new textbox("txtName");
		$this->txtFamily= new textbox("txtFamily");
		$this->txtTel= new textbox("txtTel");
		$this->txtDescription= new textbox("txtDescription");
		$this->txtAmount= new textbox("txtAmount");
		$this->txtPay= new SweetButton(true,"انتقال به صفحه پرداخت");
		$this->txtPay->setAction("txtPay");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("finance_manualpayment");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
		$PageTitlePart->addElement(new Lable($this->PageTitle));
		$Page->addElement($PageTitlePart);
		$MessagePart=new Div();
		$MessagePart->setClass("sweet_messagepart");
		$MessagePart->addElement(new Lable($this->getMessage()));
		$Page->addElement($MessagePart);
		$LTable1=new ListTable(2);
		$LTable1->setClass("formtable");
if($this->DisplayManualInfo)
{
    $LTable1->addElement(new Lable("نام"));
    $LTable1->setLastElementClass('form_item_caption');
    $LTable1->addElement($this->txtName);
    $LTable1->setLastElementClass('form_item_field');
    $LTable1->addElement(new Lable("نام خانوادگی"));
    $LTable1->setLastElementClass('form_item_caption');
    $LTable1->addElement($this->txtFamily);
    $LTable1->setLastElementClass('form_item_field');
    $LTable1->addElement(new Lable("تلفن تماس"));
    $LTable1->setLastElementClass('form_item_caption');
    $LTable1->addElement($this->txtTel);
    $LTable1->setLastElementClass('form_item_field');
    $LTable1->addElement(new Lable("توضیحات"));
    $LTable1->setLastElementClass('form_item_caption');
    $LTable1->addElement($this->txtDescription);
    $LTable1->setLastElementClass('form_item_field');
}

		$LTable1->addElement(new Lable("مبلغ(تومان)"));
		$LTable1->setLastElementClass('form_item_caption');
		$LTable1->addElement($this->txtAmount);
		$LTable1->setLastElementClass('form_item_field');
		$LTable1->addElement($this->txtPay,2);
		$LTable1->setLastElementClass('form_item_sweetbutton');
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>