<?php
namespace Modules\ocms\Forms;
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
*@creationDate 1396-09-23 - 2017-12-14 01:18
*@lastUpdate 1396-09-23 - 2017-12-14 01:18
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class doctorreservelistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
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
	public function __construct()
	{
		parent::__construct();

		/******* doctorplan_fid *******/
		$this->doctorplan_fid= new combobox("doctorplan_fid");
		$this->doctorplan_fid->setClass("form-control");

		/******* financial_transaction_fid *******/
		$this->financial_transaction_fid= new combobox("financial_transaction_fid");
		$this->financial_transaction_fid->setClass("form-control");

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
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("ocms_doctorreservelist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['doctorreserve']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->doctorplan_fid,$this->getFieldCaption('doctorplan_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->financial_transaction_fid,$this->getFieldCaption('financial_transaction_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->presencetype_fid,$this->getFieldCaption('presencetype_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->reserve_date_from,$this->getFieldCaption('reserve_date_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->reserve_date_to,$this->getFieldCaption('reserve_date_to'),null,'',null));
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
			$this->doctorplan_fid->addOption("", "مهم نیست");
		foreach ($this->Data['doctorplan_fid'] as $item)
			$this->doctorplan_fid->addOption($item->getID(), $item->getTitleField());
			$this->financial_transaction_fid->addOption("", "مهم نیست");
		foreach ($this->Data['financial_transaction_fid'] as $item)
			$this->financial_transaction_fid->addOption($item->getID(), $item->getTitleField());
			$this->presencetype_fid->addOption("", "مهم نیست");
		foreach ($this->Data['presencetype_fid'] as $item)
			$this->presencetype_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("doctorreserve", $this->Data)){

			/******** doctorplan_fid ********/
			$this->doctorplan_fid->setSelectedValue($this->Data['doctorreserve']->getDoctorplan_fid());
			$this->setFieldCaption('doctorplan_fid',$this->Data['doctorreserve']->getFieldInfo('doctorplan_fid')->getTitle());

			/******** financial_transaction_fid ********/
			$this->financial_transaction_fid->setSelectedValue($this->Data['doctorreserve']->getFinancial_transaction_fid());
			$this->setFieldCaption('financial_transaction_fid',$this->Data['doctorreserve']->getFieldInfo('financial_transaction_fid')->getTitle());

			/******** presencetype_fid ********/
			$this->presencetype_fid->setSelectedValue($this->Data['doctorreserve']->getPresencetype_fid());
			$this->setFieldCaption('presencetype_fid',$this->Data['doctorreserve']->getFieldInfo('presencetype_fid')->getTitle());

			/******** reserve_date_from ********/
			$this->reserve_date_from->setTime($this->Data['doctorreserve']->getReserve_date_from());
			$this->setFieldCaption('reserve_date_from',$this->Data['doctorreserve']->getFieldInfo('reserve_date_from')->getTitle());

			/******** reserve_date_to ********/
			$this->reserve_date_to->setTime($this->Data['doctorreserve']->getReserve_date_to());
			$this->setFieldCaption('reserve_date_to',$this->Data['doctorreserve']->getFieldInfo('reserve_date_to')->getTitle());
			$this->setFieldCaption('reserve_date',$this->Data['doctorreserve']->getFieldInfo('reserve_date')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** doctorplan_fid ********/
		$this->sortby->addOption($this->Data['doctorreserve']->getTableFieldID('doctorplan_fid'),$this->getFieldCaption('doctorplan_fid'));
		if(isset($_GET['doctorplan_fid']))
			$this->doctorplan_fid->setSelectedValue($_GET['doctorplan_fid']);

		/******** financial_transaction_fid ********/
		$this->sortby->addOption($this->Data['doctorreserve']->getTableFieldID('financial_transaction_fid'),$this->getFieldCaption('financial_transaction_fid'));
		if(isset($_GET['financial_transaction_fid']))
			$this->financial_transaction_fid->setSelectedValue($_GET['financial_transaction_fid']);

		/******** presencetype_fid ********/
		$this->sortby->addOption($this->Data['doctorreserve']->getTableFieldID('presencetype_fid'),$this->getFieldCaption('presencetype_fid'));
		if(isset($_GET['presencetype_fid']))
			$this->presencetype_fid->setSelectedValue($_GET['presencetype_fid']);

		/******** reserve_date_from ********/

		/******** reserve_date_to ********/
		$this->sortby->addOption($this->Data['doctorreserve']->getTableFieldID('reserve_date'),$this->getFieldCaption('reserve_date'));

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