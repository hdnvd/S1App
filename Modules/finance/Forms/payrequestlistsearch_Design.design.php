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
*@creationDate 1396-09-08 - 2017-11-29 15:33
*@lastUpdate 1396-09-08 - 2017-11-29 15:33
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class payrequestlistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var DatePicker */
	private $request_date_from;
	/**
	 * @return DatePicker
	 */
	public function getRequest_date_from()
	{
		return $this->request_date_from;
	}
	/** @var DatePicker */
	private $request_date_to;
	/**
	 * @return DatePicker
	 */
	public function getRequest_date_to()
	{
		return $this->request_date_to;
	}
	/** @var textbox */
	private $price;
	/**
	 * @return textbox
	 */
	public function getPrice()
	{
		return $this->price;
	}
	/** @var DatePicker */
	private $commit_date_from;
	/**
	 * @return DatePicker
	 */
	public function getCommit_date_from()
	{
		return $this->commit_date_from;
	}
	/** @var DatePicker */
	private $commit_date_to;
	/**
	 * @return DatePicker
	 */
	public function getCommit_date_to()
	{
		return $this->commit_date_to;
	}
	/** @var combobox */
	private $committype_fid;
	/**
	 * @return combobox
	 */
	public function getCommittype_fid()
	{
		return $this->committype_fid;
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
		parent::__construct();

		/******* request_date_from *******/
		$this->request_date_from= new DatePicker("request_date_from");
		$this->request_date_from->setClass("form-control");

		/******* request_date_to *******/
		$this->request_date_to= new DatePicker("request_date_to");
		$this->request_date_to->setClass("form-control");

		/******* price *******/
		$this->price= new textbox("price");
		$this->price->setClass("form-control");

		/******* commit_date_from *******/
		$this->commit_date_from= new DatePicker("commit_date_from");
		$this->commit_date_from->setClass("form-control");

		/******* commit_date_to *******/
		$this->commit_date_to= new DatePicker("commit_date_to");
		$this->commit_date_to->setClass("form-control");

		/******* committype_fid *******/
		$this->committype_fid= new combobox("committype_fid");
		$this->committype_fid->setClass("form-control");

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
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("finance_payrequestlist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['payrequest']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->request_date_from,$this->getFieldCaption('request_date_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->request_date_to,$this->getFieldCaption('request_date_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->price,$this->getFieldCaption('price'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->commit_date_from,$this->getFieldCaption('commit_date_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->commit_date_to,$this->getFieldCaption('commit_date_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->committype_fid,$this->getFieldCaption('committype_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->sortby,$this->getFieldCaption('sortby'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->isdesc,$this->getFieldCaption('isdesc'),null,'',null));
		$LTable1->addElement($this->getSingleFieldRowCode($this->search));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "GET", $Page);
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
	public function FillItems()
	{
			$this->committype_fid->addOption("", "مهم نیست");
		foreach ($this->Data['committype_fid'] as $item)
			$this->committype_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("payrequest", $this->Data)){

			/******** request_date_from ********/
			$this->request_date_from->setTime($this->Data['payrequest']->getRequest_date_from());
			$this->setFieldCaption('request_date_from',$this->Data['payrequest']->getFieldInfo('request_date_from')->getTitle());

			/******** request_date_to ********/
			$this->request_date_to->setTime($this->Data['payrequest']->getRequest_date_to());
			$this->setFieldCaption('request_date_to',$this->Data['payrequest']->getFieldInfo('request_date_to')->getTitle());
			$this->setFieldCaption('request_date',$this->Data['payrequest']->getFieldInfo('request_date')->getTitle());

			/******** price ********/
			$this->price->setValue($this->Data['payrequest']->getPrice());
			$this->setFieldCaption('price',$this->Data['payrequest']->getFieldInfo('price')->getTitle());

			/******** commit_date_from ********/
			$this->commit_date_from->setTime($this->Data['payrequest']->getCommit_date_from());
			$this->setFieldCaption('commit_date_from',$this->Data['payrequest']->getFieldInfo('commit_date_from')->getTitle());

			/******** commit_date_to ********/
			$this->commit_date_to->setTime($this->Data['payrequest']->getCommit_date_to());
			$this->setFieldCaption('commit_date_to',$this->Data['payrequest']->getFieldInfo('commit_date_to')->getTitle());
			$this->setFieldCaption('commit_date',$this->Data['payrequest']->getFieldInfo('commit_date')->getTitle());

			/******** committype_fid ********/
			$this->committype_fid->setSelectedValue($this->Data['payrequest']->getCommittype_fid());
			$this->setFieldCaption('committype_fid',$this->Data['payrequest']->getFieldInfo('committype_fid')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** request_date_from ********/

		/******** request_date_to ********/
		$this->sortby->addOption($this->Data['payrequest']->getTableFieldID('request_date'),$this->getFieldCaption('request_date'));

		/******** price ********/
		$this->sortby->addOption($this->Data['payrequest']->getTableFieldID('price'),$this->getFieldCaption('price'));
		if(isset($_GET['price']))
			$this->price->setValue($_GET['price']);

		/******** commit_date_from ********/

		/******** commit_date_to ********/
		$this->sortby->addOption($this->Data['payrequest']->getTableFieldID('commit_date'),$this->getFieldCaption('commit_date'));

		/******** committype_fid ********/
		$this->sortby->addOption($this->Data['payrequest']->getTableFieldID('committype_fid'),$this->getFieldCaption('committype_fid'));
		if(isset($_GET['committype_fid']))
			$this->committype_fid->setSelectedValue($_GET['committype_fid']);

		/******** sortby ********/
		if(isset($_GET['sortby']))
			$this->sortby->setSelectedValue($_GET['sortby']);

		/******** isdesc ********/
		if(isset($_GET['isdesc']))
			$this->isdesc->setSelectedValue($_GET['isdesc']);

		/******** search ********/
	}
}
?>