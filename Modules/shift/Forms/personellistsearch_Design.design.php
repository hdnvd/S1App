<?php
namespace Modules\shift\Forms;
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
*@creationDate 1396-10-28 - 2018-01-18 17:32
*@lastUpdate 1396-10-28 - 2018-01-18 17:32
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class personellistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var textbox */
	private $childcount;
	/**
	 * @return textbox
	 */
	public function getChildcount()
	{
		return $this->childcount;
	}
	/** @var textbox */
	private $address;
	/**
	 * @return textbox
	 */
	public function getAddress()
	{
		return $this->address;
	}
	/** @var textbox */
	private $fathername;
	/**
	 * @return textbox
	 */
	public function getFathername()
	{
		return $this->fathername;
	}
	/** @var textbox */
	private $priority;
	/**
	 * @return textbox
	 */
	public function getPriority()
	{
		return $this->priority;
	}
	/** @var DatePicker */
	private $employment_date_from;
	/**
	 * @return DatePicker
	 */
	public function getEmployment_date_from()
	{
		return $this->employment_date_from;
	}
	/** @var DatePicker */
	private $employment_date_to;
	/**
	 * @return DatePicker
	 */
	public function getEmployment_date_to()
	{
		return $this->employment_date_to;
	}
	/** @var textbox */
	private $personelcode;
	/**
	 * @return textbox
	 */
	public function getPersonelcode()
	{
		return $this->personelcode;
	}
	/** @var textbox */
	private $sanavat;
	/**
	 * @return textbox
	 */
	public function getSanavat()
	{
		return $this->sanavat;
	}
	/** @var textbox */
	private $shhesab;
	/**
	 * @return textbox
	 */
	public function getShhesab()
	{
		return $this->shhesab;
	}
	/** @var combobox */
	private $bakhsh_fid;
	/**
	 * @return combobox
	 */
	public function getBakhsh_fid()
	{
		return $this->bakhsh_fid;
	}
	/** @var combobox */
	private $madrak_fid;
	/**
	 * @return combobox
	 */
	public function getMadrak_fid()
	{
		return $this->madrak_fid;
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
	private $tel;
	/**
	 * @return textbox
	 */
	public function getTel()
	{
		return $this->tel;
	}
	/** @var DatePicker */
	private $born_date_from;
	/**
	 * @return DatePicker
	 */
	public function getBorn_date_from()
	{
		return $this->born_date_from;
	}
	/** @var DatePicker */
	private $born_date_to;
	/**
	 * @return DatePicker
	 */
	public function getBorn_date_to()
	{
		return $this->born_date_to;
	}
	/** @var combobox */
	private $is_male;
	/**
	 * @return combobox
	 */
	public function getIs_male()
	{
		return $this->is_male;
	}
	/** @var textbox */
	private $extrasanavat;
	/**
	 * @return textbox
	 */
	public function getExtrasanavat()
	{
		return $this->extrasanavat;
	}
	/** @var textbox */
	private $monthsanavat;
	/**
	 * @return textbox
	 */
	public function getMonthsanavat()
	{
		return $this->monthsanavat;
	}
	/** @var combobox */
	private $eshteghal_fid;
	/**
	 * @return combobox
	 */
	public function getEshteghal_fid()
	{
		return $this->eshteghal_fid;
	}
	/** @var textbox */
	private $zarib;
	/**
	 * @return textbox
	 */
	public function getZarib()
	{
		return $this->zarib;
	}
	/** @var combobox */
	private $role_fid;
	/**
	 * @return combobox
	 */
	public function getRole_fid()
	{
		return $this->role_fid;
	}
	/** @var textbox */
	private $shsh;
	/**
	 * @return textbox
	 */
	public function getShsh()
	{
		return $this->shsh;
	}
	/** @var textbox */
	private $computercode;
	/**
	 * @return textbox
	 */
	public function getComputercode()
	{
		return $this->computercode;
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
	/** @var combobox */
	private $is_married;
	/**
	 * @return combobox
	 */
	public function getIs_married()
	{
		return $this->is_married;
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

		/******* childcount *******/
		$this->childcount= new textbox("childcount");
		$this->childcount->setClass("form-control");

		/******* address *******/
		$this->address= new textbox("address");
		$this->address->setClass("form-control");

		/******* fathername *******/
		$this->fathername= new textbox("fathername");
		$this->fathername->setClass("form-control");

		/******* priority *******/
		$this->priority= new textbox("priority");
		$this->priority->setClass("form-control");

		/******* employment_date_from *******/
		$this->employment_date_from= new DatePicker("employment_date_from");
		$this->employment_date_from->setClass("form-control");

		/******* employment_date_to *******/
		$this->employment_date_to= new DatePicker("employment_date_to");
		$this->employment_date_to->setClass("form-control");

		/******* personelcode *******/
		$this->personelcode= new textbox("personelcode");
		$this->personelcode->setClass("form-control");

		/******* sanavat *******/
		$this->sanavat= new textbox("sanavat");
		$this->sanavat->setClass("form-control");

		/******* shhesab *******/
		$this->shhesab= new textbox("shhesab");
		$this->shhesab->setClass("form-control");

		/******* bakhsh_fid *******/
		$this->bakhsh_fid= new combobox("bakhsh_fid");
		$this->bakhsh_fid->setClass("form-control");

		/******* madrak_fid *******/
		$this->madrak_fid= new combobox("madrak_fid");
		$this->madrak_fid->setClass("form-control");

		/******* name *******/
		$this->name= new textbox("name");
		$this->name->setClass("form-control");

		/******* family *******/
		$this->family= new textbox("family");
		$this->family->setClass("form-control");

		/******* tel *******/
		$this->tel= new textbox("tel");
		$this->tel->setClass("form-control");

		/******* born_date_from *******/
		$this->born_date_from= new DatePicker("born_date_from");
		$this->born_date_from->setClass("form-control");

		/******* born_date_to *******/
		$this->born_date_to= new DatePicker("born_date_to");
		$this->born_date_to->setClass("form-control");

		/******* is_male *******/
		$this->is_male= new combobox("is_male");
		$this->is_male->setClass("form-control");

		/******* extrasanavat *******/
		$this->extrasanavat= new textbox("extrasanavat");
		$this->extrasanavat->setClass("form-control");

		/******* monthsanavat *******/
		$this->monthsanavat= new textbox("monthsanavat");
		$this->monthsanavat->setClass("form-control");

		/******* eshteghal_fid *******/
		$this->eshteghal_fid= new combobox("eshteghal_fid");
		$this->eshteghal_fid->setClass("form-control");

		/******* zarib *******/
		$this->zarib= new textbox("zarib");
		$this->zarib->setClass("form-control");

		/******* role_fid *******/
		$this->role_fid= new combobox("role_fid");
		$this->role_fid->setClass("form-control");

		/******* shsh *******/
		$this->shsh= new textbox("shsh");
		$this->shsh->setClass("form-control");

		/******* computercode *******/
		$this->computercode= new textbox("computercode");
		$this->computercode->setClass("form-control");

		/******* mellicode *******/
		$this->mellicode= new textbox("mellicode");
		$this->mellicode->setClass("form-control");

		/******* is_married *******/
		$this->is_married= new combobox("is_married");
		$this->is_married->setClass("form-control");

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
		$Page->setId("shift_personellist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['personel']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->childcount,$this->getFieldCaption('childcount'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->address,$this->getFieldCaption('address'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->fathername,$this->getFieldCaption('fathername'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->priority,$this->getFieldCaption('priority'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->employment_date_from,$this->getFieldCaption('employment_date_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->employment_date_to,$this->getFieldCaption('employment_date_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->personelcode,$this->getFieldCaption('personelcode'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->sanavat,$this->getFieldCaption('sanavat'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->shhesab,$this->getFieldCaption('shhesab'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->bakhsh_fid,$this->getFieldCaption('bakhsh_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->madrak_fid,$this->getFieldCaption('madrak_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->name,$this->getFieldCaption('name'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->family,$this->getFieldCaption('family'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->tel,$this->getFieldCaption('tel'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->born_date_from,$this->getFieldCaption('born_date_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->born_date_to,$this->getFieldCaption('born_date_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->is_male,$this->getFieldCaption('is_male'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->extrasanavat,$this->getFieldCaption('extrasanavat'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->monthsanavat,$this->getFieldCaption('monthsanavat'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->eshteghal_fid,$this->getFieldCaption('eshteghal_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->zarib,$this->getFieldCaption('zarib'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->role_fid,$this->getFieldCaption('role_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->shsh,$this->getFieldCaption('shsh'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->computercode,$this->getFieldCaption('computercode'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->mellicode,$this->getFieldCaption('mellicode'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->is_married,$this->getFieldCaption('is_married'),null,'',null));
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
			$this->bakhsh_fid->addOption("", "مهم نیست");
		foreach ($this->Data['bakhsh_fid'] as $item)
			$this->bakhsh_fid->addOption($item->getID(), $item->getTitleField());
			$this->madrak_fid->addOption("", "مهم نیست");
		foreach ($this->Data['madrak_fid'] as $item)
			$this->madrak_fid->addOption($item->getID(), $item->getTitleField());
			$this->is_male->addOption("", "مهم نیست");
			$this->is_male->addOption(1,'بله');
			$this->is_male->addOption(0,'خیر');
			$this->eshteghal_fid->addOption("", "مهم نیست");
		foreach ($this->Data['eshteghal_fid'] as $item)
			$this->eshteghal_fid->addOption($item->getID(), $item->getTitleField());
			$this->role_fid->addOption("", "مهم نیست");
		foreach ($this->Data['role_fid'] as $item)
			$this->role_fid->addOption($item->getID(), $item->getTitleField());
			$this->is_married->addOption("", "مهم نیست");
			$this->is_married->addOption(1,'بله');
			$this->is_married->addOption(0,'خیر');
		if (key_exists("personel", $this->Data)){

			/******** childcount ********/
			$this->childcount->setValue($this->Data['personel']->getChildcount());
			$this->setFieldCaption('childcount',$this->Data['personel']->getFieldInfo('childcount')->getTitle());

			/******** address ********/
			$this->address->setValue($this->Data['personel']->getAddress());
			$this->setFieldCaption('address',$this->Data['personel']->getFieldInfo('address')->getTitle());

			/******** fathername ********/
			$this->fathername->setValue($this->Data['personel']->getFathername());
			$this->setFieldCaption('fathername',$this->Data['personel']->getFieldInfo('fathername')->getTitle());

			/******** priority ********/
			$this->priority->setValue($this->Data['personel']->getPriority());
			$this->setFieldCaption('priority',$this->Data['personel']->getFieldInfo('priority')->getTitle());

			/******** employment_date_from ********/
			$this->employment_date_from->setTime("-142659000");
			$this->setFieldCaption('employment_date_from',$this->Data['personel']->getFieldInfo('employment_date_from')->getTitle());

			/******** employment_date_to ********/
			$this->employment_date_to->setTime($this->Data['personel']->getEmployment_date_to());
			$this->setFieldCaption('employment_date_to',$this->Data['personel']->getFieldInfo('employment_date_to')->getTitle());
			$this->setFieldCaption('employment_date',$this->Data['personel']->getFieldInfo('employment_date')->getTitle());

			/******** personelcode ********/
			$this->personelcode->setValue($this->Data['personel']->getPersonelcode());
			$this->setFieldCaption('personelcode',$this->Data['personel']->getFieldInfo('personelcode')->getTitle());

			/******** sanavat ********/
			$this->sanavat->setValue($this->Data['personel']->getSanavat());
			$this->setFieldCaption('sanavat',$this->Data['personel']->getFieldInfo('sanavat')->getTitle());

			/******** shhesab ********/
			$this->shhesab->setValue($this->Data['personel']->getShhesab());
			$this->setFieldCaption('shhesab',$this->Data['personel']->getFieldInfo('shhesab')->getTitle());

			/******** bakhsh_fid ********/
			$this->bakhsh_fid->setSelectedValue($this->Data['personel']->getBakhsh_fid());
			$this->setFieldCaption('bakhsh_fid',$this->Data['personel']->getFieldInfo('bakhsh_fid')->getTitle());

			/******** madrak_fid ********/
			$this->madrak_fid->setSelectedValue($this->Data['personel']->getMadrak_fid());
			$this->setFieldCaption('madrak_fid',$this->Data['personel']->getFieldInfo('madrak_fid')->getTitle());

			/******** name ********/
			$this->name->setValue($this->Data['personel']->getName());
			$this->setFieldCaption('name',$this->Data['personel']->getFieldInfo('name')->getTitle());

			/******** family ********/
			$this->family->setValue($this->Data['personel']->getFamily());
			$this->setFieldCaption('family',$this->Data['personel']->getFieldInfo('family')->getTitle());

			/******** tel ********/
			$this->tel->setValue($this->Data['personel']->getTel());
			$this->setFieldCaption('tel',$this->Data['personel']->getFieldInfo('tel')->getTitle());

			/******** born_date_from ********/
			$this->born_date_from->setTime("-1404962744");
			$this->setFieldCaption('born_date_from',$this->Data['personel']->getFieldInfo('born_date_from')->getTitle());

			/******** born_date_to ********/
			$this->born_date_to->setTime($this->Data['personel']->getBorn_date_to());
			$this->setFieldCaption('born_date_to',$this->Data['personel']->getFieldInfo('born_date_to')->getTitle());
			$this->setFieldCaption('born_date',$this->Data['personel']->getFieldInfo('born_date')->getTitle());

			/******** is_male ********/
			$this->is_male->setSelectedValue($this->Data['personel']->getIs_male());
			$this->setFieldCaption('is_male',$this->Data['personel']->getFieldInfo('is_male')->getTitle());

			/******** extrasanavat ********/
			$this->extrasanavat->setValue($this->Data['personel']->getExtrasanavat());
			$this->setFieldCaption('extrasanavat',$this->Data['personel']->getFieldInfo('extrasanavat')->getTitle());

			/******** monthsanavat ********/
			$this->monthsanavat->setValue($this->Data['personel']->getMonthsanavat());
			$this->setFieldCaption('monthsanavat',$this->Data['personel']->getFieldInfo('monthsanavat')->getTitle());

			/******** eshteghal_fid ********/
			$this->eshteghal_fid->setSelectedValue($this->Data['personel']->getEshteghal_fid());
			$this->setFieldCaption('eshteghal_fid',$this->Data['personel']->getFieldInfo('eshteghal_fid')->getTitle());

			/******** zarib ********/
			$this->zarib->setValue($this->Data['personel']->getZarib());
			$this->setFieldCaption('zarib',$this->Data['personel']->getFieldInfo('zarib')->getTitle());

			/******** role_fid ********/
			$this->role_fid->setSelectedValue($this->Data['personel']->getRole_fid());
			$this->setFieldCaption('role_fid',$this->Data['personel']->getFieldInfo('role_fid')->getTitle());

			/******** shsh ********/
			$this->shsh->setValue($this->Data['personel']->getShsh());
			$this->setFieldCaption('shsh',$this->Data['personel']->getFieldInfo('shsh')->getTitle());

			/******** computercode ********/
			$this->computercode->setValue($this->Data['personel']->getComputercode());
			$this->setFieldCaption('computercode',$this->Data['personel']->getFieldInfo('computercode')->getTitle());

			/******** mellicode ********/
			$this->mellicode->setValue($this->Data['personel']->getMellicode());
			$this->setFieldCaption('mellicode',$this->Data['personel']->getFieldInfo('mellicode')->getTitle());

			/******** is_married ********/
			$this->is_married->setSelectedValue($this->Data['personel']->getIs_married());
			$this->setFieldCaption('is_married',$this->Data['personel']->getFieldInfo('is_married')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** childcount ********/
		$this->sortby->addOption($this->Data['personel']->getTableFieldID('childcount'),$this->getFieldCaption('childcount'));
		if(isset($_GET['childcount']))
			$this->childcount->setValue($_GET['childcount']);

		/******** address ********/
		$this->sortby->addOption($this->Data['personel']->getTableFieldID('address'),$this->getFieldCaption('address'));
		if(isset($_GET['address']))
			$this->address->setValue($_GET['address']);

		/******** fathername ********/
		$this->sortby->addOption($this->Data['personel']->getTableFieldID('fathername'),$this->getFieldCaption('fathername'));
		if(isset($_GET['fathername']))
			$this->fathername->setValue($_GET['fathername']);

		/******** priority ********/
		$this->sortby->addOption($this->Data['personel']->getTableFieldID('priority'),$this->getFieldCaption('priority'));
		if(isset($_GET['priority']))
			$this->priority->setValue($_GET['priority']);

		/******** employment_date_from ********/

		/******** employment_date_to ********/
		$this->sortby->addOption($this->Data['personel']->getTableFieldID('employment_date'),$this->getFieldCaption('employment_date'));

		/******** personelcode ********/
		$this->sortby->addOption($this->Data['personel']->getTableFieldID('personelcode'),$this->getFieldCaption('personelcode'));
		if(isset($_GET['personelcode']))
			$this->personelcode->setValue($_GET['personelcode']);

		/******** sanavat ********/
		$this->sortby->addOption($this->Data['personel']->getTableFieldID('sanavat'),$this->getFieldCaption('sanavat'));
		if(isset($_GET['sanavat']))
			$this->sanavat->setValue($_GET['sanavat']);

		/******** shhesab ********/
		$this->sortby->addOption($this->Data['personel']->getTableFieldID('shhesab'),$this->getFieldCaption('shhesab'));
		if(isset($_GET['shhesab']))
			$this->shhesab->setValue($_GET['shhesab']);

		/******** bakhsh_fid ********/
		$this->sortby->addOption($this->Data['personel']->getTableFieldID('bakhsh_fid'),$this->getFieldCaption('bakhsh_fid'));
		if(isset($_GET['bakhsh_fid']))
			$this->bakhsh_fid->setSelectedValue($_GET['bakhsh_fid']);

		/******** madrak_fid ********/
		$this->sortby->addOption($this->Data['personel']->getTableFieldID('madrak_fid'),$this->getFieldCaption('madrak_fid'));
		if(isset($_GET['madrak_fid']))
			$this->madrak_fid->setSelectedValue($_GET['madrak_fid']);

		/******** name ********/
		$this->sortby->addOption($this->Data['personel']->getTableFieldID('name'),$this->getFieldCaption('name'));
		if(isset($_GET['name']))
			$this->name->setValue($_GET['name']);

		/******** family ********/
		$this->sortby->addOption($this->Data['personel']->getTableFieldID('family'),$this->getFieldCaption('family'));
		if(isset($_GET['family']))
			$this->family->setValue($_GET['family']);

		/******** tel ********/
		$this->sortby->addOption($this->Data['personel']->getTableFieldID('tel'),$this->getFieldCaption('tel'));
		if(isset($_GET['tel']))
			$this->tel->setValue($_GET['tel']);

		/******** born_date_from ********/

		/******** born_date_to ********/
		$this->sortby->addOption($this->Data['personel']->getTableFieldID('born_date'),$this->getFieldCaption('born_date'));

		/******** is_male ********/
		$this->sortby->addOption($this->Data['personel']->getTableFieldID('is_male'),$this->getFieldCaption('is_male'));
		if(isset($_GET['is_male']))
			$this->is_male->setSelectedValue($_GET['is_male']);

		/******** extrasanavat ********/
		$this->sortby->addOption($this->Data['personel']->getTableFieldID('extrasanavat'),$this->getFieldCaption('extrasanavat'));
		if(isset($_GET['extrasanavat']))
			$this->extrasanavat->setValue($_GET['extrasanavat']);

		/******** monthsanavat ********/
		$this->sortby->addOption($this->Data['personel']->getTableFieldID('monthsanavat'),$this->getFieldCaption('monthsanavat'));
		if(isset($_GET['monthsanavat']))
			$this->monthsanavat->setValue($_GET['monthsanavat']);

		/******** eshteghal_fid ********/
		$this->sortby->addOption($this->Data['personel']->getTableFieldID('eshteghal_fid'),$this->getFieldCaption('eshteghal_fid'));
		if(isset($_GET['eshteghal_fid']))
			$this->eshteghal_fid->setSelectedValue($_GET['eshteghal_fid']);

		/******** zarib ********/
		$this->sortby->addOption($this->Data['personel']->getTableFieldID('zarib'),$this->getFieldCaption('zarib'));
		if(isset($_GET['zarib']))
			$this->zarib->setValue($_GET['zarib']);

		/******** role_fid ********/
		$this->sortby->addOption($this->Data['personel']->getTableFieldID('role_fid'),$this->getFieldCaption('role_fid'));
		if(isset($_GET['role_fid']))
			$this->role_fid->setSelectedValue($_GET['role_fid']);

		/******** shsh ********/
		$this->sortby->addOption($this->Data['personel']->getTableFieldID('shsh'),$this->getFieldCaption('shsh'));
		if(isset($_GET['shsh']))
			$this->shsh->setValue($_GET['shsh']);

		/******** computercode ********/
		$this->sortby->addOption($this->Data['personel']->getTableFieldID('computercode'),$this->getFieldCaption('computercode'));
		if(isset($_GET['computercode']))
			$this->computercode->setValue($_GET['computercode']);

		/******** mellicode ********/
		$this->sortby->addOption($this->Data['personel']->getTableFieldID('mellicode'),$this->getFieldCaption('mellicode'));
		if(isset($_GET['mellicode']))
			$this->mellicode->setValue($_GET['mellicode']);

		/******** is_married ********/
		$this->sortby->addOption($this->Data['personel']->getTableFieldID('is_married'),$this->getFieldCaption('is_married'));
		if(isset($_GET['is_married']))
			$this->is_married->setSelectedValue($_GET['is_married']);

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