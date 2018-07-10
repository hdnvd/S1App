<?php
namespace Modules\itsap\Forms;
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
*@creationDate 1396-09-17 - 2017-12-08 11:51
*@lastUpdate 1396-09-17 - 2017-12-08 11:51
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class employeelistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var combobox */
	private $unit_fid;
	/**
	 * @return combobox
	 */
	public function getUnit_fid()
	{
		return $this->unit_fid;
	}
	/** @var textbox */
	private $emp_code;
	/**
	 * @return textbox
	 */
	public function getEmp_code()
	{
		return $this->emp_code;
	}
	/** @var textbox */
	private $mellicode;
	/**
	 * @return textbox
	 */
	public function getMellicode()
	{
		return $this->mellicode;
	}
	/** @var textbox */
	private $name;
	/**
	 * @return textbox
	 */
	public function getName()
	{
		return $this->name;
	}
	/** @var textbox */
	private $family;
	/**
	 * @return textbox
	 */
	public function getFamily()
	{
		return $this->family;
	}
	/** @var textbox */
	private $mobile;
	/**
	 * @return textbox
	 */
	public function getMobile()
	{
		return $this->mobile;
	}
	/** @var combobox */
	private $degree_fid;
	/**
	 * @return combobox
	 */
	public function getDegree_fid()
	{
		return $this->degree_fid;
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

		/******* unit_fid *******/
		$this->unit_fid= new combobox("unit_fid");
		$this->unit_fid->setClass("form-control");

		/******* emp_code *******/
		$this->emp_code= new textbox("emp_code");
		$this->emp_code->setClass("form-control");

		/******* mellicode *******/
		$this->mellicode= new textbox("mellicode");
		$this->mellicode->setClass("form-control");

		/******* name *******/
		$this->name= new textbox("name");
		$this->name->setClass("form-control");

		/******* family *******/
		$this->family= new textbox("family");
		$this->family->setClass("form-control");

		/******* mobile *******/
		$this->mobile= new textbox("mobile");
		$this->mobile->setClass("form-control");

		/******* degree_fid *******/
		$this->degree_fid= new combobox("degree_fid");
		$this->degree_fid->setClass("form-control");

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
		$Page->setId("itsap_employeelist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['employee']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->unit_fid,$this->getFieldCaption('unit_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->emp_code,$this->getFieldCaption('emp_code'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->mellicode,$this->getFieldCaption('mellicode'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->name,$this->getFieldCaption('name'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->family,$this->getFieldCaption('family'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->mobile,$this->getFieldCaption('mobile'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->degree_fid,$this->getFieldCaption('degree_fid'),null,'',null));
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
			$this->unit_fid->addOption("", "مهم نیست");
		foreach ($this->Data['unit_fid'] as $item)
			$this->unit_fid->addOption($item->getID(), $item->getTitleField());
			$this->degree_fid->addOption("", "مهم نیست");
		foreach ($this->Data['degree_fid'] as $item)
			$this->degree_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("employee", $this->Data)){

			/******** unit_fid ********/
			$this->unit_fid->setSelectedValue($this->Data['employee']->getUnit_fid());
			$this->setFieldCaption('unit_fid',$this->Data['employee']->getFieldInfo('unit_fid')->getTitle());

			/******** emp_code ********/
			$this->emp_code->setValue($this->Data['employee']->getEmp_code());
			$this->setFieldCaption('emp_code',$this->Data['employee']->getFieldInfo('emp_code')->getTitle());

			/******** mellicode ********/
			$this->mellicode->setValue($this->Data['employee']->getMellicode());
			$this->setFieldCaption('mellicode',$this->Data['employee']->getFieldInfo('mellicode')->getTitle());

			/******** name ********/
			$this->name->setValue($this->Data['employee']->getName());
			$this->setFieldCaption('name',$this->Data['employee']->getFieldInfo('name')->getTitle());

			/******** family ********/
			$this->family->setValue($this->Data['employee']->getFamily());
			$this->setFieldCaption('family',$this->Data['employee']->getFieldInfo('family')->getTitle());

			/******** mobile ********/
			$this->mobile->setValue($this->Data['employee']->getMobile());
			$this->setFieldCaption('mobile',$this->Data['employee']->getFieldInfo('mobile')->getTitle());

			/******** degree_fid ********/
			$this->degree_fid->setSelectedValue($this->Data['employee']->getDegree_fid());
			$this->setFieldCaption('degree_fid',$this->Data['employee']->getFieldInfo('degree_fid')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** unit_fid ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('unit_fid'),$this->getFieldCaption('unit_fid'));
		if(isset($_GET['unit_fid']))
			$this->unit_fid->setSelectedValue($_GET['unit_fid']);

		/******** emp_code ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('emp_code'),$this->getFieldCaption('emp_code'));
		if(isset($_GET['emp_code']))
			$this->emp_code->setValue($_GET['emp_code']);

		/******** mellicode ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('mellicode'),$this->getFieldCaption('mellicode'));
		if(isset($_GET['mellicode']))
			$this->mellicode->setValue($_GET['mellicode']);

		/******** name ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('name'),$this->getFieldCaption('name'));
		if(isset($_GET['name']))
			$this->name->setValue($_GET['name']);

		/******** family ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('family'),$this->getFieldCaption('family'));
		if(isset($_GET['family']))
			$this->family->setValue($_GET['family']);

		/******** mobile ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('mobile'),$this->getFieldCaption('mobile'));
		if(isset($_GET['mobile']))
			$this->mobile->setValue($_GET['mobile']);

		/******** degree_fid ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('degree_fid'),$this->getFieldCaption('degree_fid'));
		if(isset($_GET['degree_fid']))
			$this->degree_fid->setSelectedValue($_GET['degree_fid']);

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