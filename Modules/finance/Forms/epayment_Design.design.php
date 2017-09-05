<?php
namespace Modules\finance\Forms;
use core\CoreClasses\db\dbaccess;
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
use Modules\finance\Entity\finance_bankpaymentinfoEntity;
use Modules\finance\Entity\finance_transactionEntity;

/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-13 - 2017-09-04 20:51
*@lastUpdate 1396-06-13 - 2017-09-04 20:51
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class epayment_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
    /** @var ComboBox */
    private $cmbPortal;
    /** @var SweetButton */
    private $btnPay;
    public function __construct()
    {
        $this->btnPay= new SweetButton(true,"پرداخت");
        $this->btnPay->setAction("btnPay");
        $this->cmbPortal=new ComboBox("portal");
        $this->cmbPortal->addOption("1","درگاه Pay.ir");
    }
	public function getBodyHTML($command=null)
	{
	    $t=$this->Data['transaction'];
        $p=$this->Data['paymentinfo'];
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("finance_epayment");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
		$PageTitlePart->addElement(new Lable("پرداخت های الکترونیکی"));
		$Page->addElement($PageTitlePart);
		$MessagePart=new Div();
		$MessagePart->setClass("sweet_messagepart");
		$MessagePart->addElement(new Lable($this->getMessage()));
		$Page->addElement($MessagePart);
		$LTable1=new ListTable(2);
		$LTable1->addElement(new Lable("مبلغ تراکنش"));
        $LTable1->addElement(new Lable($t->getAmount()));
        $LTable1->addElement(new Lable("شماره فاکتور"));
        $LTable1->addElement(new Lable($p->getFactorserial()));
        $LTable1->addElement(new Lable("توضیحات"));
        $LTable1->addElement(new Lable($t->getDescription()));
        $LTable1->addElement(new Lable("درگاه پرداخت"));
        $LTable1->addElement($this->cmbPortal);
        $LTable1->addElement($this->btnPay,2);
		$LTable1->setClass("formtable");
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}

    /**
     * @return ComboBox
     */
    public function getCmbPortal()
    {
        return $this->cmbPortal;
    }
}
?>