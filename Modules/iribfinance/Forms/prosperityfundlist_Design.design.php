<?php
namespace Modules\iribfinance\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\services\baseHTMLElement;
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
use Modules\common\PublicClasses\UrlParameter;
use core\CoreClasses\SweetDate;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-27 - 2018-02-16 01:43
*@lastUpdate 1396-11-27 - 2018-02-16 01:43
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class prosperityfundlist_Design extends FormDesign {
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
	private $employee_fid;
	/**
	 * @return combobox
	 */
	public function getEmployee_fid()
	{
		return $this->employee_fid;
	}
	/** @var textbox */
	private $totalamount;
	/**
	 * @return textbox
	 */
	public function getTotalamount()
	{
		return $this->totalamount;
	}
	/** @var DatePicker */
	private $add_date_from;
	/**
	 * @return DatePicker
	 */
	public function getAdd_date_from()
	{
		return $this->add_date_from;
	}
	/** @var DatePicker */
	private $add_date_to;
	/**
	 * @return DatePicker
	 */
	public function getAdd_date_to()
	{
		return $this->add_date_to;
	}
	/** @var textbox */
	private $monthcount;
	/**
	 * @return textbox
	 */
	public function getMonthcount()
	{
		return $this->monthcount;
	}
	/** @var textbox */
	private $amountpermonth;
	/**
	 * @return textbox
	 */
	public function getAmountpermonth()
	{
		return $this->amountpermonth;
	}
	/** @var combobox */
	private $isactive;
	/**
	 * @return combobox
	 */
	public function getIsactive()
	{
		return $this->isactive;
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
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("iribfinance_prosperityfundlist");
		$Page->addElement($this->getPageTitlePart("فهرست " . $this->Data['prosperityfund']->getTableTitle() . " ها"));
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->employee_fid,$this->getFieldCaption('employee_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->totalamount,$this->getFieldCaption('totalamount'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->add_date_from,$this->getFieldCaption('add_date_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->add_date_to,$this->getFieldCaption('add_date_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->monthcount,$this->getFieldCaption('monthcount'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->amountpermonth,$this->getFieldCaption('amountpermonth'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->isactive,$this->getFieldCaption('isactive'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->sortby,$this->getFieldCaption('sortby'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->isdesc,$this->getFieldCaption('isdesc'),null,'',null));
		$LTable1->addElement($this->getSingleFieldRowCode($this->search));
		$Page->addElement($LTable1);
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$Div1=new Div();
		$Div1->setClass("list");
		for($i=0;$i<count($this->Data['data']);$i++){
		$innerDiv[$i]=new Div();
		$innerDiv[$i]->setClass("listitem");
			$url=new AppRooter('iribfinance','prosperityfund');
			$url->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
			$Title=$this->Data['data'][$i]->getTitleField();
			if($this->Data['data'][$i]->getTitleField()=="")
				$Title='-- بدون عنوان --';
			$lbTit[$i]=new Lable($Title);
			$liTit[$i]=new link($url->getAbsoluteURL(),$lbTit[$i]);
			$innerDiv[$i]->addElement($liTit[$i]);
			$Div1->addElement($innerDiv[$i]);
		}
		$Page->addElement($Div1);
		$Page->addElement($this->getPaginationPart($this->Data['pagecount'],"iribfinance","prosperityfundlist"));
		$PageLink=new AppRooter('iribfinance','prosperityfundlist');
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
			$this->employee_fid->addOption("", "مهم نیست");
		foreach ($this->Data['employee_fid'] as $item)
			$this->employee_fid->addOption($item->getID(), $item->getTitleField());
			$this->isactive->addOption("", "مهم نیست");
			$this->isactive->addOption(1,'بله');
			$this->isactive->addOption(0,'خیر');
		if (key_exists("prosperityfund", $this->Data)){

			/******** employee_fid ********/
			$this->employee_fid->setSelectedValue($this->Data['prosperityfund']->getEmployee_fid());
			$this->setFieldCaption('employee_fid',$this->Data['prosperityfund']->getFieldInfo('employee_fid')->getTitle());

			/******** totalamount ********/
			$this->totalamount->setValue($this->Data['prosperityfund']->getTotalamount());
			$this->setFieldCaption('totalamount',$this->Data['prosperityfund']->getFieldInfo('totalamount')->getTitle());

			/******** add_date_from ********/
			$this->add_date_from->setTime($this->Data['prosperityfund']->getAdd_date_from());
			$this->setFieldCaption('add_date_from',$this->Data['prosperityfund']->getFieldInfo('add_date_from')->getTitle());

			/******** add_date_to ********/
			$this->add_date_to->setTime($this->Data['prosperityfund']->getAdd_date_to());
			$this->setFieldCaption('add_date_to',$this->Data['prosperityfund']->getFieldInfo('add_date_to')->getTitle());
			$this->setFieldCaption('add_date',$this->Data['prosperityfund']->getFieldInfo('add_date')->getTitle());

			/******** monthcount ********/
			$this->monthcount->setValue($this->Data['prosperityfund']->getMonthcount());
			$this->setFieldCaption('monthcount',$this->Data['prosperityfund']->getFieldInfo('monthcount')->getTitle());

			/******** amountpermonth ********/
			$this->amountpermonth->setValue($this->Data['prosperityfund']->getAmountpermonth());
			$this->setFieldCaption('amountpermonth',$this->Data['prosperityfund']->getFieldInfo('amountpermonth')->getTitle());

			/******** isactive ********/
			$this->isactive->setSelectedValue($this->Data['prosperityfund']->getIsactive());
			$this->setFieldCaption('isactive',$this->Data['prosperityfund']->getFieldInfo('isactive')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** employee_fid ********/
		$this->sortby->addOption($this->Data['prosperityfund']->getTableFieldID('employee_fid'),$this->getFieldCaption('employee_fid'));
		if(isset($_GET['employee_fid']))
			$this->employee_fid->setSelectedValue($_GET['employee_fid']);

		/******** totalamount ********/
		$this->sortby->addOption($this->Data['prosperityfund']->getTableFieldID('totalamount'),$this->getFieldCaption('totalamount'));
		if(isset($_GET['totalamount']))
			$this->totalamount->setValue($_GET['totalamount']);

		/******** add_date_from ********/

		/******** add_date_to ********/
		$this->sortby->addOption($this->Data['prosperityfund']->getTableFieldID('add_date'),$this->getFieldCaption('add_date'));

		/******** monthcount ********/
		$this->sortby->addOption($this->Data['prosperityfund']->getTableFieldID('monthcount'),$this->getFieldCaption('monthcount'));
		if(isset($_GET['monthcount']))
			$this->monthcount->setValue($_GET['monthcount']);

		/******** amountpermonth ********/
		$this->sortby->addOption($this->Data['prosperityfund']->getTableFieldID('amountpermonth'),$this->getFieldCaption('amountpermonth'));
		if(isset($_GET['amountpermonth']))
			$this->amountpermonth->setValue($_GET['amountpermonth']);

		/******** isactive ********/
		$this->sortby->addOption($this->Data['prosperityfund']->getTableFieldID('isactive'),$this->getFieldCaption('isactive'));
		if(isset($_GET['isactive']))
			$this->isactive->setSelectedValue($_GET['isactive']);

		/******** sortby ********/
		if(isset($_GET['sortby']))
			$this->sortby->setSelectedValue($_GET['sortby']);

		/******** isdesc ********/
		if(isset($_GET['isdesc']))
			$this->isdesc->setSelectedValue($_GET['isdesc']);

		/******** search ********/
	}
	public function __construct()
	{
		parent::__construct();

		/******* employee_fid *******/
		$this->employee_fid= new combobox("employee_fid");
		$this->employee_fid->setClass("form-control");

		/******* totalamount *******/
		$this->totalamount= new textbox("totalamount");
		$this->totalamount->setClass("form-control");

		/******* add_date_from *******/
		$this->add_date_from= new DatePicker("add_date_from");
		$this->add_date_from->setClass("form-control");

		/******* add_date_to *******/
		$this->add_date_to= new DatePicker("add_date_to");
		$this->add_date_to->setClass("form-control");

		/******* monthcount *******/
		$this->monthcount= new textbox("monthcount");
		$this->monthcount->setClass("form-control");

		/******* amountpermonth *******/
		$this->amountpermonth= new textbox("amountpermonth");
		$this->amountpermonth->setClass("form-control");

		/******* isactive *******/
		$this->isactive= new combobox("isactive");
		$this->isactive->setClass("form-control");

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