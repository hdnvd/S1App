<?php
namespace Modules\finance\Forms;
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
*@creationDate 1396-11-09 - 2018-01-29 11:26
*@lastUpdate 1396-11-09 - 2018-01-29 11:26
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class transactionlist_Design extends FormDesign {
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
	/** @var DatePicker */
	private $add_time_from;
	/**
	 * @return DatePicker
	 */
	public function getAdd_time_from()
	{
		return $this->add_time_from;
	}
	/** @var DatePicker */
	private $add_time_to;
	/**
	 * @return DatePicker
	 */
	public function getAdd_time_to()
	{
		return $this->add_time_to;
	}
	/** @var DatePicker */
	private $commit_time_from;
	/**
	 * @return DatePicker
	 */
	public function getCommit_time_from()
	{
		return $this->commit_time_from;
	}
	/** @var DatePicker */
	private $commit_time_to;
	/**
	 * @return DatePicker
	 */
	public function getCommit_time_to()
	{
		return $this->commit_time_to;
	}
	/** @var combobox */
	private $issuccessful;
	/**
	 * @return combobox
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
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("finance_transactionlist");
		$Page->addElement($this->getPageTitlePart("فهرست " . $this->Data['transaction']->getTableTitle() . " ها"));
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->amount,$this->getFieldCaption('amount'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->description,$this->getFieldCaption('description'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->add_time_from,$this->getFieldCaption('add_time_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->add_time_to,$this->getFieldCaption('add_time_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->commit_time_from,$this->getFieldCaption('commit_time_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->commit_time_to,$this->getFieldCaption('commit_time_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->issuccessful,$this->getFieldCaption('issuccessful'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->chapter_fid,$this->getFieldCaption('chapter_fid'),null,'',null));
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
			$url=new AppRooter('finance','transaction');
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
		$Page->addElement($this->getPaginationPart($this->Data['pagecount'],"finance","transactionlist"));
		$PageLink=new AppRooter('finance','transactionlist');
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
                $Result[$i]=$this->Data['data'][$i];
            }
            return json_encode($Result);
        }
        return json_encode(array());
    }
	public function FillItems()
	{
			$this->issuccessful->addOption("", "مهم نیست");
			$this->issuccessful->addOption(1,'بله');
			$this->issuccessful->addOption(0,'خیر');
			$this->chapter_fid->addOption("", "مهم نیست");
		foreach ($this->Data['chapter_fid'] as $item)
			$this->chapter_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("transaction", $this->Data)){

			/******** amount ********/
			$this->amount->setValue($this->Data['transaction']->getAmount());
			$this->setFieldCaption('amount',$this->Data['transaction']->getFieldInfo('amount')->getTitle());

			/******** description ********/
			$this->description->setValue($this->Data['transaction']->getDescription());
			$this->setFieldCaption('description',$this->Data['transaction']->getFieldInfo('description')->getTitle());

			/******** add_time_from ********/
			$this->add_time_from->setTime($this->Data['transaction']->getAdd_time_from());
			$this->setFieldCaption('add_time_from',$this->Data['transaction']->getFieldInfo('add_time_from')->getTitle());

			/******** add_time_to ********/
			$this->add_time_to->setTime($this->Data['transaction']->getAdd_time_to());
			$this->setFieldCaption('add_time_to',$this->Data['transaction']->getFieldInfo('add_time_to')->getTitle());
			$this->setFieldCaption('add_time',$this->Data['transaction']->getFieldInfo('add_time')->getTitle());

			/******** commit_time_from ********/
			$this->commit_time_from->setTime($this->Data['transaction']->getCommit_time_from());
			$this->setFieldCaption('commit_time_from',$this->Data['transaction']->getFieldInfo('commit_time_from')->getTitle());

			/******** commit_time_to ********/
			$this->commit_time_to->setTime($this->Data['transaction']->getCommit_time_to());
			$this->setFieldCaption('commit_time_to',$this->Data['transaction']->getFieldInfo('commit_time_to')->getTitle());
			$this->setFieldCaption('commit_time',$this->Data['transaction']->getFieldInfo('commit_time')->getTitle());

			/******** issuccessful ********/
			$this->issuccessful->setSelectedValue($this->Data['transaction']->getIssuccessful());
			$this->setFieldCaption('issuccessful',$this->Data['transaction']->getFieldInfo('issuccessful')->getTitle());

			/******** chapter_fid ********/
			$this->chapter_fid->setSelectedValue($this->Data['transaction']->getChapter_fid());
			$this->setFieldCaption('chapter_fid',$this->Data['transaction']->getFieldInfo('chapter_fid')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** amount ********/
		$this->sortby->addOption($this->Data['transaction']->getTableFieldID('amount'),$this->getFieldCaption('amount'));
		if(isset($_GET['amount']))
			$this->amount->setValue($_GET['amount']);

		/******** description ********/
		$this->sortby->addOption($this->Data['transaction']->getTableFieldID('description'),$this->getFieldCaption('description'));
		if(isset($_GET['description']))
			$this->description->setValue($_GET['description']);

		/******** add_time_from ********/

		/******** add_time_to ********/
		$this->sortby->addOption($this->Data['transaction']->getTableFieldID('add_time'),$this->getFieldCaption('add_time'));

		/******** commit_time_from ********/

		/******** commit_time_to ********/
		$this->sortby->addOption($this->Data['transaction']->getTableFieldID('commit_time'),$this->getFieldCaption('commit_time'));

		/******** issuccessful ********/
		$this->sortby->addOption($this->Data['transaction']->getTableFieldID('issuccessful'),$this->getFieldCaption('issuccessful'));
		if(isset($_GET['issuccessful']))
			$this->issuccessful->setSelectedValue($_GET['issuccessful']);

		/******** chapter_fid ********/
		$this->sortby->addOption($this->Data['transaction']->getTableFieldID('chapter_fid'),$this->getFieldCaption('chapter_fid'));
		if(isset($_GET['chapter_fid']))
			$this->chapter_fid->setSelectedValue($_GET['chapter_fid']);

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

		/******* amount *******/
		$this->amount= new textbox("amount");
		$this->amount->setClass("form-control");

		/******* description *******/
		$this->description= new textbox("description");
		$this->description->setClass("form-control");

		/******* add_time_from *******/
		$this->add_time_from= new DatePicker("add_time_from");
		$this->add_time_from->setClass("form-control");

		/******* add_time_to *******/
		$this->add_time_to= new DatePicker("add_time_to");
		$this->add_time_to->setClass("form-control");

		/******* commit_time_from *******/
		$this->commit_time_from= new DatePicker("commit_time_from");
		$this->commit_time_from->setClass("form-control");

		/******* commit_time_to *******/
		$this->commit_time_to= new DatePicker("commit_time_to");
		$this->commit_time_to->setClass("form-control");

		/******* issuccessful *******/
		$this->issuccessful= new combobox("issuccessful");
		$this->issuccessful->setClass("form-control");

		/******* chapter_fid *******/
		$this->chapter_fid= new combobox("chapter_fid");
		$this->chapter_fid->setClass("form-control");

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