<?php
namespace Modules\ocms\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\UList;
use core\CoreClasses\html\FormLabel;
use core\CoreClasses\html\UListElement;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\link;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DatePicker;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\Button;
use core\CoreClasses\html\CheckBox;
use core\CoreClasses\html\RadioBox;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\ComboBox;
use core\CoreClasses\html\FileUploadBox;
use Modules\common\PublicClasses\AppRooter;
use core\CoreClasses\SweetDate;
use Modules\common\PublicClasses\UrlParameter;

/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-03 - 2018-01-23 00:07
*@lastUpdate 1396-11-03 - 2018-01-23 00:07
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class doctorreservelist_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	private $adminMode=true;
    public function getAdminMode()
    {
        return $this->adminMode;
    }
        /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
    }
	/** @var combobox */
	private $doctorplan_fid;
	/**
	 * @return combobox
	 */
	public function getDoctorplan_fid()
	{
		return $this->doctorplan_fid;
	}
	/** @var combobox */
	private $financial_transaction_fid;
	/**
	 * @return combobox
	 */
	public function getFinancial_transaction_fid()
	{
		return $this->financial_transaction_fid;
	}
	/** @var combobox */
	private $financial_canceltransaction_fid;
	/**
	 * @return combobox
	 */
	public function getFinancial_canceltransaction_fid()
	{
		return $this->financial_canceltransaction_fid;
	}
	/** @var combobox */
	private $presencetype_fid;
	/**
	 * @return combobox
	 */
	public function getPresencetype_fid()
	{
		return $this->presencetype_fid;
	}
	/** @var DatePicker */
	private $reserve_date_from;
	/**
	 * @return DatePicker
	 */
	public function getReserve_date_from()
	{
		return $this->reserve_date_from;
	}
	/** @var DatePicker */
	private $reserve_date_to;
	/**
	 * @return DatePicker
	 */
	public function getReserve_date_to()
	{
		return $this->reserve_date_to;
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
	public function getBodyHTML($command=null)
	{
		$u=new UrlParameter("MNa","");
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("ocms_doctorreservelist");
		$Page->addElement($this->getPageTitlePart("فهرست رزرو ها"));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$Div1=new Div();
		$Div1->setClass("list");
//		print_r($this->Data);
        $TableDiv=new Div();
        $TableDiv->setClass('table-responsive');
        $LTable1=new ListTable(3);
        $LTable1->setHeaderRowCount(1);
        $LTable1->setClass("table-striped table-hover managelist");
        $LTable1->addElement(new Lable('ساعت'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('رزرو کننده'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('تلفن تماس'));
        $LTable1->setLastElementClass("listtitle");
		for($i=0;$i<count($this->Data['data']);$i++){
			$Title=$this->Data['data'][$i]['family'];
            $Mobile=$this->Data['data'][$i]['mobile'];
            $StartTime=$this->Data['data'][$i]['start_time'];
            date_default_timezone_set("Asia/Tehran");
            $sweetDate = new SweetDate(false, true, 'Asia/Tehran');
            $dt = $sweetDate->date("Y/m/d H:n", $StartTime);
			if($Title=="")
				$Title='-- بدون عنوان --';
			$lbTit[$i]=new Lable($Title);
            $lbMob[$i]=new Lable($Mobile);
            $lbDate[$i]=new Lable($dt);
            $LTable1->addElement($lbDate[$i]);
            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement($lbTit[$i]);
            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement($lbMob[$i]);
            $LTable1->setLastElementClass("listcontent");
		}
		$Page->addElement($LTable1);
		$Page->addElement($this->getPaginationPart($this->Data['pagecount'],"ocms","doctorreservelist",[new UrlParameter('username',$_GET['username']),new UrlParameter('password',$_GET['password'])]));
		$PageLink=new AppRooter('ocms','doctorreservelist');
		$form=new SweetFrom($PageLink->getAbsoluteURL(), "GET", $Page);
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
	public function getJSON()
	{
		parent::getJSON();
		if (key_exists("data", $this->Data)){
			$AllCount1 = count($this->Data['data']);
			$Result=array();
			for($i=0;$i<$AllCount1;$i++){
				$Result[$i]=$this->Data['data'][$i]->GetArray();
			}
			return json_encode($Result);
		}
		return json_encode(array());
	}
	public function FillItems()
	{
	}
	public function __construct()
	{
		parent::__construct();

		/******* doctorplan_fid *******/
		$this->doctorplan_fid= new combobox("doctorplan_fid");
		$this->doctorplan_fid->setClass("form-control");

		/******* financial_transaction_fid *******/
		$this->financial_transaction_fid= new combobox("financial_transaction_fid");
		$this->financial_transaction_fid->setClass("form-control");

		/******* financial_canceltransaction_fid *******/
		$this->financial_canceltransaction_fid= new combobox("financial_canceltransaction_fid");
		$this->financial_canceltransaction_fid->setClass("form-control");

		/******* presencetype_fid *******/
		$this->presencetype_fid= new combobox("presencetype_fid");
		$this->presencetype_fid->setClass("form-control");

		/******* reserve_date_from *******/
		$this->reserve_date_from= new DatePicker("reserve_date_from");
		$this->reserve_date_from->setClass("form-control");

		/******* reserve_date_to *******/
		$this->reserve_date_to= new DatePicker("reserve_date_to");
		$this->reserve_date_to->setClass("form-control");

		/******* sortby *******/
		$this->sortby= new combobox("sortby");
		$this->sortby->setClass("form-control");

		/******* isdesc *******/
		$this->isdesc= new combobox("isdesc");
		$this->isdesc->setClass("form-control");

		/******* search *******/
		$this->search= new SweetButton(true,"جستجو");
		$this->search->setAction("search");
		$this->search->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
		$this->search->setClass("btn btn-primary");
	}
}
?>