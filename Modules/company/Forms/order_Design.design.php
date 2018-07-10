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
use core\CoreClasses\SweetDate;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-28 - 2017-09-19 16:32
*@lastUpdate 1396-06-28 - 2017-09-19 16:32
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class order_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
    /** @var lable */
    private $OrderStatus;
    /** @var lable */
    private $OrderSerial;
    /** @var lable */
    private $OrderSerialInfo;
	/** @var lable */
	private $descriptions;
	/** @var lable */
	private $similarproducts;
	/** @var lable */
	private $email;
	/** @var lable */
	private $orderdate;
	/** @var lable */
	private $mobile;
	/** @var lable */
	private $name;
	/** @var lable */
	private $family;
	/** @var lable */
	private $paydate;
	/** @var lable */
	private $package_fid;
	/** @var lable */
	private $finance_transaction_fid;
    /** @var lable */
    private $prepayment_amount;
    /** @var lable */
    private $payment_amount;
	/** @var lable */
	private $prepayment_finance_transaction_fid;
    /** @var SweetButton */
    private $btnPayPreOrder;
    /** @var SweetButton */
    private $btnPay;
    /** @var lable */
    private $message;
    /** @var lable */
    private $status;
	public function __construct()
	{
		$this->descriptions= new lable("descriptions");
		$this->similarproducts= new lable("similarproducts");
		$this->email= new lable("email");
		$this->orderdate= new lable("orderdate");
		$this->mobile= new lable("mobile");
		$this->name= new lable("name");
		$this->family= new lable("family");
		$this->paydate= new lable("paydate");
		$this->package_fid= new lable("package_fid");
		$this->finance_transaction_fid= new lable("finance_transaction_fid");
        $this->prepayment_amount= new lable("prepayment_amount");
        $this->payment_amount= new lable("payment_amount");
		$this->prepayment_finance_transaction_fid= new lable("prepayment_finance_transaction_fid");
        $this->message= new lable("کد سفارش");
        $this->status= new lable("وضعیت سفارش");
        $this->OrderSerial= new lable("شماره سفارش ");
        $this->OrderStatus= new lable("وضعیت سفارش : ");
        $this->status= new lable("وضعیت سفارش");
        $this->btnPayPreOrder= new SweetButton(true,"پرداخت پیش پرداخت");
        $this->btnPayPreOrder->setAction("btnPayPreOrder");
        $this->btnPay= new SweetButton(true,"پرداخت وجه نهایی");
        $this->btnPay->setAction("btnPay");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("company_order");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
		$PageTitlePart->addElement(new Lable("مشخصات سفارش"));
		$Page->addElement($PageTitlePart);
		$MessagePart=new Div();
		$MessagePart->setClass("sweet_messagepart");
		$MessagePart->addElement(new Lable($this->getMessage()));
		$Page->addElement($MessagePart);
        if (key_exists("package_fid", $this->Data)){
            $this->prepayment_amount->setText(number_format($this->Data['package_fid']->getPrepayment()) . " ریال");
        }
        if (key_exists("package_fid", $this->Data)){
            $this->payment_amount->setText(number_format($this->Data['package_fid']->getPrice()) . " ریال");
        }
		if (key_exists("order", $this->Data)){
			$this->descriptions->setText($this->Data['order']->getDescriptions());
		}
		if (key_exists("order", $this->Data)){
			$this->similarproducts->setText($this->Data['order']->getSimilarproducts());
		}
		if (key_exists("order", $this->Data)){
			$this->email->setText($this->Data['order']->getEmail());
		}
		if (key_exists("order", $this->Data)){
            $odate=$this->Data['order']->getOrderdate();
            $date = new SweetDate(true, true, 'Asia/Tehran');
            $theDate=$date->date("Y/m/d H:i",$odate,false);
			$this->orderdate->setText($theDate);
		}
		if (key_exists("order", $this->Data)){
			$this->mobile->setText($this->Data['order']->getMobile());
		}
		if (key_exists("order", $this->Data)){
			$this->name->setText($this->Data['order']->getName());
		}
		if (key_exists("order", $this->Data)){
			$this->family->setText($this->Data['order']->getFamily());
		}
		if (key_exists("order", $this->Data)){
			$this->paydate->setText($this->Data['order']->getPaydate());
		}
        if (key_exists("order", $this->Data)){
            $this->OrderSerial->setText($this->Data['order']->getOrderserial());
        }
        $this->OrderStatus->setText("مبلغ پیش پرداخت ، پرداخت نشده است.");
		if (key_exists("package_fid", $this->Data)){
			$this->package_fid->setText($this->Data['package_fid']->getTitle());
		}
		if (key_exists("finance_transaction_fid", $this->Data)){
			$this->finance_transaction_fid->setText($this->Data['finance_transaction_fid']->getID());
		}
        $PrePayStatus=new Div();
        $PrePayStatuslbl=new Lable("پرداختی انجام نگرفته است.برای شروع پروژه لطفا مبلغ پیش پرداخت را پرداخت نمایید.");
        $PrePayStatus->addElement($PrePayStatuslbl);
        $PrePayStatus->addElement($this->btnPayPreOrder);
		if (key_exists("prepayment_finance_transaction_fid", $this->Data) && $this->Data['prepayment_finance_transaction_fid']->getID()>0){

                $prepayDate=$this->Data['prepayment_finance_transaction_fid']->getCommit_time();
            $Success=$this->Data['prepayment_finance_transaction_fid']->getIssuccessful();
                if($prepayDate>0 && $Success)
                {
                    $date = new SweetDate(true, true, 'Asia/Tehran');
                    $theDate=$date->date("Y/m/d H:i",$prepayDate,false);
                    $PrePayStatus=new Lable($theDate);
                    $this->OrderStatus->setText("پروژه در حال تولید می باشد.");
                }
		}
        $PayStatus=new Div();
        $PayStatuslbl=new Lable("پرداختی انجام نگرفته است.");
        $PayStatus->addElement($PayStatuslbl);
        $PayStatus->addElement($this->btnPay);
        if (key_exists("finance_transaction_fid", $this->Data) && $this->Data['finance_transaction_fid']->getID()>0){

                $payDate=$this->Data['finance_transaction_fid']->getCommit_time();
            $Success=$this->Data['finance_transaction_fid']->getIssuccessful();
            if($payDate>0 && $Success)
            {
                $date = new SweetDate(true, true, 'Asia/Tehran');
                $theDate=$date->date("Y/m/d H:i",$payDate,false);
                $PayStatus=new Lable($theDate);
                $this->OrderStatus->setText("پروژه تحویل داده شده است.");
            }
        }

		$LTable1=new ListTable(2);
		$LTable1->setClass("formtable");

        $LTable1->addElement(new Lable("شماره سفارش"),2);
        $LTable1->setLastElementClass('form_item_titlelabel');
        $LTable1->addElement($this->OrderSerial,2);
        $LTable1->setLastElementClass('form_item_datalabel');
        $LTable1->addElement(new Lable("لطفا شماره سفارش را برای پیگیری پروژه به خاطر داشته باشید."),2);
        $LTable1->setLastElementClass('form_item_datalabel');

        $LTable1->addElement(new Lable("وضعیت سفارش"));
        $LTable1->setLastElementClass('form_item_titlelabel');
        $LTable1->addElement($this->OrderStatus);
        $LTable1->setLastElementClass('form_item_datalabel');

        $LTable1->addElement(new Lable("بسته"));
        $LTable1->setLastElementClass('form_item_titlelabel');
        $LTable1->addElement($this->package_fid);
        $LTable1->setLastElementClass('form_item_datalabel');

        $LTable1->addElement(new Lable("نام"));
        $LTable1->setLastElementClass('form_item_titlelabel');
        $LTable1->addElement($this->name);
        $LTable1->setLastElementClass('form_item_datalabel');
        $LTable1->addElement(new Lable("نام خانوادگی"));
        $LTable1->setLastElementClass('form_item_titlelabel');
        $LTable1->addElement($this->family);
        $LTable1->setLastElementClass('form_item_datalabel');

        $LTable1->setLastElementClass('form_item_datalabel');
        $LTable1->addElement(new Lable("شماره موبایل"));
        $LTable1->setLastElementClass('form_item_titlelabel');
        $LTable1->addElement($this->mobile);
        $LTable1->setLastElementClass('form_item_datalabel');

		$LTable1->addElement(new Lable("ایمیل"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->email);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("تاریخ سفارش"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->orderdate);
        $LTable1->setLastElementClass('form_item_datalabel');

        $LTable1->addElement(new Lable("توضیحات"),2);
        $LTable1->setLastElementClass('form_item_titlelabel');
        $LTable1->addElement($this->descriptions,2);
        $LTable1->setLastElementClass('form_item_datalabel');
        $LTable1->addElement(new Lable("نرم افزارهای مشابه"),2);
        $LTable1->setLastElementClass('form_item_titlelabel');
        $LTable1->addElement($this->similarproducts,2);
        $LTable1->setLastElementClass('form_item_datalabel');

        $LTable1->addElement(new Lable("مبلغ پیش پرداخت"));
        $LTable1->setLastElementClass('form_item_titlelabel');
        $LTable1->addElement($this->prepayment_amount);
        $LTable1->setLastElementClass('form_item_datalabel');

        $LTable1->addElement(new Lable("مبلغ نهایی پروژه"));
        $LTable1->setLastElementClass('form_item_titlelabel');
        $LTable1->addElement($this->payment_amount);
        $LTable1->setLastElementClass('form_item_datalabel');

		$LTable1->addElement(new Lable("تاریخ پرداخت وجه پیش پرداخت"),2);
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($PrePayStatus,2);
		$LTable1->setLastElementClass('form_item_datalabel');

        $LTable1->setLastElementClass('form_item_datalabel');
        $LTable1->addElement(new Lable("تاریخ پرداخت مبلغ کامل"),2);
        $LTable1->setLastElementClass('form_item_titlelabel');
        $LTable1->addElement($PayStatus,2);
        $LTable1->setLastElementClass('form_item_datalabel');
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>