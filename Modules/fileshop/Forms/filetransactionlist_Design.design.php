<?php
namespace Modules\fileshop\Forms;
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
*@creationDate 1396-09-09 - 2017-11-30 16:35
*@lastUpdate 1396-09-09 - 2017-11-30 16:35
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class filetransactionlist_Design extends FormDesign {
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
	private $file_fid;
	/**
	 * @return combobox
	 */
	public function getFile_fid()
	{
		return $this->file_fid;
	}
	/** @var combobox */
	private $finance_bankpaymentinfo_fid;
	/**
	 * @return combobox
	 */
	public function getFinance_bankpaymentinfo_fid()
	{
		return $this->finance_bankpaymentinfo_fid;
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
		$Page->setId("fileshop_filetransactionlist");
		$Page->addElement($this->getPageTitlePart("فهرست " . $this->Data['filetransaction']->getTableTitle() . " ها"));
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->file_fid,$this->getFieldCaption('file_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->finance_bankpaymentinfo_fid,$this->getFieldCaption('finance_bankpaymentinfo_fid'),null,'',null));
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
			$url=new AppRooter('fileshop','filetransaction');
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
		$Page->addElement($this->getPaginationPart($this->Data['pagecount'],"fileshop","filetransactionlist"));
		$PageLink=new AppRooter('fileshop','filetransactionlist');
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
			$this->file_fid->addOption("", "مهم نیست");
		foreach ($this->Data['file_fid'] as $item)
			$this->file_fid->addOption($item->getID(), $item->getTitleField());
			$this->finance_bankpaymentinfo_fid->addOption("", "مهم نیست");
		foreach ($this->Data['finance_bankpaymentinfo_fid'] as $item)
			$this->finance_bankpaymentinfo_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("filetransaction", $this->Data)){

			/******** file_fid ********/
			$this->file_fid->setSelectedValue($this->Data['filetransaction']->getFile_fid());
			$this->setFieldCaption('file_fid',$this->Data['filetransaction']->getFieldInfo('file_fid')->getTitle());

			/******** finance_bankpaymentinfo_fid ********/
			$this->finance_bankpaymentinfo_fid->setSelectedValue($this->Data['filetransaction']->getFinance_bankpaymentinfo_fid());
			$this->setFieldCaption('finance_bankpaymentinfo_fid',$this->Data['filetransaction']->getFieldInfo('finance_bankpaymentinfo_fid')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** file_fid ********/
		$this->sortby->addOption($this->Data['filetransaction']->getTableFieldID('file_fid'),$this->getFieldCaption('file_fid'));
		if(isset($_GET['file_fid']))
			$this->file_fid->setSelectedValue($_GET['file_fid']);

		/******** finance_bankpaymentinfo_fid ********/
		$this->sortby->addOption($this->Data['filetransaction']->getTableFieldID('finance_bankpaymentinfo_fid'),$this->getFieldCaption('finance_bankpaymentinfo_fid'));
		if(isset($_GET['finance_bankpaymentinfo_fid']))
			$this->finance_bankpaymentinfo_fid->setSelectedValue($_GET['finance_bankpaymentinfo_fid']);

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

		/******* file_fid *******/
		$this->file_fid= new combobox("file_fid");
		$this->file_fid->setClass("form-control");

		/******* finance_bankpaymentinfo_fid *******/
		$this->finance_bankpaymentinfo_fid= new combobox("finance_bankpaymentinfo_fid");
		$this->finance_bankpaymentinfo_fid->setClass("form-control");

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