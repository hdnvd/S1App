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
use core\CoreClasses\SweetDate;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
use Modules\finance\Entity\finance_bankpaymentinfoEntity;
use Modules\finance\Entity\finance_transactionEntity;

/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-15 - 2017-09-06 14:09
*@lastUpdate 1396-06-15 - 2017-09-06 14:09
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class usertransactionlist_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var textbox */
	private $amount;
	/**
	 * @return textbox
	 */
	public function getAmount()
	{
		return $this->amount;
	}
	/** @var textbox */
	private $description;
	/**
	 * @return textbox
	 */
	public function getDescription()
	{
		return $this->description;
	}
	/** @var textbox */
	private $add_time;
	/**
	 * @return textbox
	 */
	public function getAdd_time()
	{
		return $this->add_time;
	}
	/** @var textbox */
	private $commit_time;
	/**
	 * @return textbox
	 */
	public function getCommit_time()
	{
		return $this->commit_time;
	}
	/** @var CheckBox */
	private $issuccessful;
	/**
	 * @return CheckBox
	 */
	public function getIssuccessful()
	{
		return $this->issuccessful;
	}
	/** @var combobox */
	private $chapter_fid;
	/**
	 * @return combobox
	 */
	public function getChapter_fid()
	{
		return $this->chapter_fid;
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
		$this->amount= new textbox("amount");
		$this->description= new textbox("description");
		$this->add_time= new textbox("add_time");
		$this->commit_time= new textbox("commit_time");
		$this->issuccessful= new CheckBox("issuccessful");
		$this->chapter_fid= new combobox("chapter_fid");
		$this->sortby= new combobox("sortby");
		$this->isdesc= new combobox("isdesc");
		$this->search= new SweetButton(true,"جستجو");
		$this->search->setAction("search");
	}
	public function getBodyHTML($command=null)
	{
		if (key_exists("transaction", $this->Data))
			$this->amount->setValue($this->Data['transaction']->getAmount());
		if (key_exists("transaction", $this->Data))
			$this->description->setValue($this->Data['transaction']->getDescription());
		if (key_exists("transaction", $this->Data))
			$this->add_time->setValue($this->Data['transaction']->getAdd_time());
		if (key_exists("transaction", $this->Data))
			$this->commit_time->setValue($this->Data['transaction']->getCommit_time());
		$this->issuccessful->addOption("issuccessful","1");
		if (key_exists("transaction", $this->Data))
			$this->issuccessful->addSelectedValue($this->Data['transaction']->getIssuccessful());
			$this->chapter_fid->addOption("", "مهم نیست");

		if (key_exists("transaction", $this->Data))
			$this->chapter_fid->setSelectedValue($this->Data['transaction']->getChapter_fid());
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("finance_transactionlist");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
		$PageTitlePart->addElement(new Lable("فهرست تراکنش های کاربر"));
		$Page->addElement($PageTitlePart);
		$MessagePart=new Div();
		$MessagePart->setClass("sweet_messagepart");
		$MessagePart->addElement(new Lable($this->getMessage()));
		$Page->addElement($MessagePart);
		$Div1=new Div();
		$Div1->setClass("list");
		if(key_exists("data",$this->Data) && count($this->Data['data'])==0)
		{
			if(isset($_GET['action']) && $_GET['action']=="search_Click")
				$Div1->addElement(new Lable("هیچ تراکنشی با مشخصات وارد شده پیدا نشد."));
			else
				$Div1->addElement(new Lable("هیچ تراکنشی برای نمایش وجود ندارد."));
		}
		$Balance=new Div();
		$Balance->addElement(new Lable("موجودی حساب: " . $this->Data['balance'] . " ریال"));
		$Page->addElement($Balance);
        $LTable1=new ListTable(6);
        $LTable1->setClass("managelist");
        $LTable1->addElement(new Lable('#'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('مبلغ'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('تاریخ ثبت'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('توضیحات'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('شماره تراکنش'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('وضعیت'));
        $LTable1->setLastElementClass("listtitle");
        if(key_exists("data",$this->Data))
        for($i=0;$i<count($this->Data['data']);$i++){
            $LTable1->addElement(new Lable($i+1));
            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement(new Lable($this->Data['data'][$i]->getAmount() . " ریال"));
            $LTable1->setLastElementClass("listcontent");
            $t1=$this->Data['data'][$i]->getAdd_time();
            $dt1=new SweetDate($t1);
            $LTable1->addElement(new Lable($dt1->date("H:i Y-m-d")));
            $LTable1->setLastElementClass("listcontent");
//            $d->getFactorserial()
            $sts[$i]="نا موفق";
            if($this->Data['data'][$i]->getIssuccessful()==1)
                $sts[$i]="موفق";

            $LTable1->addElement(new Lable($this->Data['data'][$i]->getDescription()));
            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement(new Lable($this->Data['bankpayment'][$i]->getBanktransactionid()));
            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement(new Lable($sts[$i]));
            $LTable1->setLastElementClass("listcontent");
        }
        $Page->addElement($Div1);
        $Page->addElement($LTable1);
        if(key_exists("data",$this->Data))
		$Page->addElement($this->getPaginationPart($this->Data['pagecount']));
		$form=new SweetFrom("", "GET", $Page);
		return $form->getHTML();
	}
	private function getPaginationPart($PageCount)
	{
		$div=new Div();
		for($i=1;$i<=$PageCount;$i++)
		{
			$RTR=null;
			if(isset($_GET['action']) && $_GET['action']=="search_Click")
				$RTR=new AppRooter("finance","transactionlist");
			else
			{
				$RTR=new AppRooter("finance","transactionlist");
				//$RTR->addParameter(new UrlParameter("g",$this->Data['groupid']));
			}
			$RTR->addParameter(new UrlParameter("pn",$i));
			$RTR->setAppendToCurrentParams(false);
			$lbl=new Lable($i);
			$lnk=new link($RTR->getAbsoluteURL(),$lbl);
			$div->addElement($lnk);
		}
		return $div;
	}
}
?>