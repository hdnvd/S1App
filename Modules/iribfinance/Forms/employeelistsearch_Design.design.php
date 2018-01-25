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
*@creationDate 1396-11-05 - 2018-01-25 18:15
*@lastUpdate 1396-11-05 - 2018-01-25 18:15
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
	private $fathername;
	/**
	 * @return textbox
	 */
	public function getFathername()
	{
		return $this->fathername;
	}
	/** @var combobox */
	private $ismale;
	/**
	 * @return combobox
	 */
	public function getIsmale()
	{
		return $this->ismale;
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
	private $shsh;
	/**
	 * @return textbox
	 */
	public function getShsh()
	{
		return $this->shsh;
	}
	/** @var textbox */
	private $shshserial;
	/**
	 * @return textbox
	 */
	public function getShshserial()
	{
		return $this->shshserial;
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
	private $employmentcode;
	/**
	 * @return textbox
	 */
	public function getEmploymentcode()
	{
		return $this->employmentcode;
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
	/** @var combobox */
	private $nationality_fid;
	/**
	 * @return combobox
	 */
	public function getNationality_fid()
	{
		return $this->nationality_fid;
	}
	/** @var combobox */
	private $paycenter_fid;
	/**
	 * @return combobox
	 */
	public function getPaycenter_fid()
	{
		return $this->paycenter_fid;
	}
	/** @var combobox */
	private $employmenttype_fid;
	/**
	 * @return combobox
	 */
	public function getEmploymenttype_fid()
	{
		return $this->employmenttype_fid;
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
	/** @var textbox */
	private $childcount;
	/**
	 * @return textbox
	 */
	public function getChildcount()
	{
		return $this->childcount;
	}
	/** @var combobox */
	private $ismarried;
	/**
	 * @return combobox
	 */
	public function getIsmarried()
	{
		return $this->ismarried;
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
	/** @var textbox */
	private $tel;
	/**
	 * @return textbox
	 */
	public function getTel()
	{
		return $this->tel;
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
	private $zipcode;
	/**
	 * @return textbox
	 */
	public function getZipcode()
	{
		return $this->zipcode;
	}
	/** @var combobox */
	private $common_city_fid;
	/**
	 * @return combobox
	 */
	public function getCommon_city_fid()
	{
		return $this->common_city_fid;
	}
	/** @var textbox */
	private $accountnumber;
	/**
	 * @return textbox
	 */
	public function getAccountnumber()
	{
		return $this->accountnumber;
	}
	/** @var textbox */
	private $cardnumber;
	/**
	 * @return textbox
	 */
	public function getCardnumber()
	{
		return $this->cardnumber;
	}
	/** @var combobox */
	private $bank_fid;
	/**
	 * @return combobox
	 */
	public function getBank_fid()
	{
		return $this->bank_fid;
	}
	/** @var combobox */
	private $is_neededinsurance;
	/**
	 * @return combobox
	 */
	public function getIs_neededinsurance()
	{
		return $this->is_neededinsurance;
	}
	/** @var combobox */
	private $is_payabale;
	/**
	 * @return combobox
	 */
	public function getIs_payabale()
	{
		return $this->is_payabale;
	}
	/** @var textbox */
	private $passportnumber;
	/**
	 * @return textbox
	 */
	public function getPassportnumber()
	{
		return $this->passportnumber;
	}
	/** @var textbox */
	private $passportserial;
	/**
	 * @return textbox
	 */
	public function getPassportserial()
	{
		return $this->passportserial;
	}
	/** @var textbox */
	private $education;
	/**
	 * @return textbox
	 */
	public function getEducation()
	{
		return $this->education;
	}
	/** @var DatePicker */
	private $entrance_date_from;
	/**
	 * @return DatePicker
	 */
	public function getEntrance_date_from()
	{
		return $this->entrance_date_from;
	}
	/** @var DatePicker */
	private $entrance_date_to;
	/**
	 * @return DatePicker
	 */
	public function getEntrance_date_to()
	{
		return $this->entrance_date_to;
	}
	/** @var combobox */
	private $visatype_fid;
	/**
	 * @return combobox
	 */
	public function getVisatype_fid()
	{
		return $this->visatype_fid;
	}
	/** @var DatePicker */
	private $visaexpire_date_from;
	/**
	 * @return DatePicker
	 */
	public function getVisaexpire_date_from()
	{
		return $this->visaexpire_date_from;
	}
	/** @var DatePicker */
	private $visaexpire_date_to;
	/**
	 * @return DatePicker
	 */
	public function getVisaexpire_date_to()
	{
		return $this->visaexpire_date_to;
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

		/******* name *******/
		$this->name= new textbox("name");
		$this->name->setClass("form-control");

		/******* family *******/
		$this->family= new textbox("family");
		$this->family->setClass("form-control");

		/******* fathername *******/
		$this->fathername= new textbox("fathername");
		$this->fathername->setClass("form-control");

		/******* ismale *******/
		$this->ismale= new combobox("ismale");
		$this->ismale->setClass("form-control");

		/******* mellicode *******/
		$this->mellicode= new textbox("mellicode");
		$this->mellicode->setClass("form-control");

		/******* shsh *******/
		$this->shsh= new textbox("shsh");
		$this->shsh->setClass("form-control");

		/******* shshserial *******/
		$this->shshserial= new textbox("shshserial");
		$this->shshserial->setClass("form-control");

		/******* personelcode *******/
		$this->personelcode= new textbox("personelcode");
		$this->personelcode->setClass("form-control");

		/******* employmentcode *******/
		$this->employmentcode= new textbox("employmentcode");
		$this->employmentcode->setClass("form-control");

		/******* role_fid *******/
		$this->role_fid= new combobox("role_fid");
		$this->role_fid->setClass("form-control");

		/******* nationality_fid *******/
		$this->nationality_fid= new combobox("nationality_fid");
		$this->nationality_fid->setClass("form-control");

		/******* paycenter_fid *******/
		$this->paycenter_fid= new combobox("paycenter_fid");
		$this->paycenter_fid->setClass("form-control");

		/******* employmenttype_fid *******/
		$this->employmenttype_fid= new combobox("employmenttype_fid");
		$this->employmenttype_fid->setClass("form-control");

		/******* born_date_from *******/
		$this->born_date_from= new DatePicker("born_date_from");
		$this->born_date_from->setClass("form-control");

		/******* born_date_to *******/
		$this->born_date_to= new DatePicker("born_date_to");
		$this->born_date_to->setClass("form-control");

		/******* childcount *******/
		$this->childcount= new textbox("childcount");
		$this->childcount->setClass("form-control");

		/******* ismarried *******/
		$this->ismarried= new combobox("ismarried");
		$this->ismarried->setClass("form-control");

		/******* mobile *******/
		$this->mobile= new textbox("mobile");
		$this->mobile->setClass("form-control");

		/******* tel *******/
		$this->tel= new textbox("tel");
		$this->tel->setClass("form-control");

		/******* address *******/
		$this->address= new textbox("address");
		$this->address->setClass("form-control");

		/******* zipcode *******/
		$this->zipcode= new textbox("zipcode");
		$this->zipcode->setClass("form-control");

		/******* common_city_fid *******/
		$this->common_city_fid= new combobox("common_city_fid");
		$this->common_city_fid->setClass("form-control");

		/******* accountnumber *******/
		$this->accountnumber= new textbox("accountnumber");
		$this->accountnumber->setClass("form-control");

		/******* cardnumber *******/
		$this->cardnumber= new textbox("cardnumber");
		$this->cardnumber->setClass("form-control");

		/******* bank_fid *******/
		$this->bank_fid= new combobox("bank_fid");
		$this->bank_fid->setClass("form-control");

		/******* is_neededinsurance *******/
		$this->is_neededinsurance= new combobox("is_neededinsurance");
		$this->is_neededinsurance->setClass("form-control");

		/******* is_payabale *******/
		$this->is_payabale= new combobox("is_payabale");
		$this->is_payabale->setClass("form-control");

		/******* passportnumber *******/
		$this->passportnumber= new textbox("passportnumber");
		$this->passportnumber->setClass("form-control");

		/******* passportserial *******/
		$this->passportserial= new textbox("passportserial");
		$this->passportserial->setClass("form-control");

		/******* education *******/
		$this->education= new textbox("education");
		$this->education->setClass("form-control");

		/******* entrance_date_from *******/
		$this->entrance_date_from= new DatePicker("entrance_date_from");
		$this->entrance_date_from->setClass("form-control");

		/******* entrance_date_to *******/
		$this->entrance_date_to= new DatePicker("entrance_date_to");
		$this->entrance_date_to->setClass("form-control");

		/******* visatype_fid *******/
		$this->visatype_fid= new combobox("visatype_fid");
		$this->visatype_fid->setClass("form-control");

		/******* visaexpire_date_from *******/
		$this->visaexpire_date_from= new DatePicker("visaexpire_date_from");
		$this->visaexpire_date_from->setClass("form-control");

		/******* visaexpire_date_to *******/
		$this->visaexpire_date_to= new DatePicker("visaexpire_date_to");
		$this->visaexpire_date_to->setClass("form-control");

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
		$Page->setId("iribfinance_employeelist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['employee']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->name,$this->getFieldCaption('name'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->family,$this->getFieldCaption('family'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->fathername,$this->getFieldCaption('fathername'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->ismale,$this->getFieldCaption('ismale'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->mellicode,$this->getFieldCaption('mellicode'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->shsh,$this->getFieldCaption('shsh'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->shshserial,$this->getFieldCaption('shshserial'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->personelcode,$this->getFieldCaption('personelcode'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->employmentcode,$this->getFieldCaption('employmentcode'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->role_fid,$this->getFieldCaption('role_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->nationality_fid,$this->getFieldCaption('nationality_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->paycenter_fid,$this->getFieldCaption('paycenter_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->employmenttype_fid,$this->getFieldCaption('employmenttype_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->born_date_from,$this->getFieldCaption('born_date_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->born_date_to,$this->getFieldCaption('born_date_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->childcount,$this->getFieldCaption('childcount'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->ismarried,$this->getFieldCaption('ismarried'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->mobile,$this->getFieldCaption('mobile'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->tel,$this->getFieldCaption('tel'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->address,$this->getFieldCaption('address'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->zipcode,$this->getFieldCaption('zipcode'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->common_city_fid,$this->getFieldCaption('common_city_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->accountnumber,$this->getFieldCaption('accountnumber'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->cardnumber,$this->getFieldCaption('cardnumber'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->bank_fid,$this->getFieldCaption('bank_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->is_neededinsurance,$this->getFieldCaption('is_neededinsurance'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->is_payabale,$this->getFieldCaption('is_payabale'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->passportnumber,$this->getFieldCaption('passportnumber'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->passportserial,$this->getFieldCaption('passportserial'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->education,$this->getFieldCaption('education'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->entrance_date_from,$this->getFieldCaption('entrance_date_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->entrance_date_to,$this->getFieldCaption('entrance_date_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->visatype_fid,$this->getFieldCaption('visatype_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->visaexpire_date_from,$this->getFieldCaption('visaexpire_date_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->visaexpire_date_to,$this->getFieldCaption('visaexpire_date_to'),null,'',null));
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
			$this->ismale->addOption("", "مهم نیست");
			$this->ismale->addOption(1,'مرد');
			$this->ismale->addOption(0,'زن');
			$this->role_fid->addOption("", "مهم نیست");
		foreach ($this->Data['role_fid'] as $item)
			$this->role_fid->addOption($item->getID(), $item->getTitleField());
			$this->nationality_fid->addOption("", "مهم نیست");
		foreach ($this->Data['nationality_fid'] as $item)
			$this->nationality_fid->addOption($item->getID(), $item->getTitleField());
			$this->paycenter_fid->addOption("", "مهم نیست");
		foreach ($this->Data['paycenter_fid'] as $item)
			$this->paycenter_fid->addOption($item->getID(), $item->getTitleField());
			$this->employmenttype_fid->addOption("", "مهم نیست");
		foreach ($this->Data['employmenttype_fid'] as $item)
			$this->employmenttype_fid->addOption($item->getID(), $item->getTitleField());
			$this->ismarried->addOption("", "مهم نیست");
			$this->ismarried->addOption(1,'متاهل');
			$this->ismarried->addOption(0,'مجرد');
			$this->common_city_fid->addOption("", "مهم نیست");
		foreach ($this->Data['common_city_fid'] as $item)
			$this->common_city_fid->addOption($item->getID(), $item->getTitleField());
			$this->bank_fid->addOption("", "مهم نیست");
		foreach ($this->Data['bank_fid'] as $item)
			$this->bank_fid->addOption($item->getID(), $item->getTitleField());
			$this->is_neededinsurance->addOption("", "مهم نیست");
			$this->is_neededinsurance->addOption(1,'بله');
			$this->is_neededinsurance->addOption(0,'خیر');
			$this->is_payabale->addOption("", "مهم نیست");
			$this->is_payabale->addOption(1,'بله');
			$this->is_payabale->addOption(0,'خیر');
			$this->visatype_fid->addOption("", "مهم نیست");
		foreach ($this->Data['visatype_fid'] as $item)
			$this->visatype_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("employee", $this->Data)){

			/******** name ********/
			$this->name->setValue($this->Data['employee']->getName());
			$this->setFieldCaption('name',$this->Data['employee']->getFieldInfo('name')->getTitle());

			/******** family ********/
			$this->family->setValue($this->Data['employee']->getFamily());
			$this->setFieldCaption('family',$this->Data['employee']->getFieldInfo('family')->getTitle());

			/******** fathername ********/
			$this->fathername->setValue($this->Data['employee']->getFathername());
			$this->setFieldCaption('fathername',$this->Data['employee']->getFieldInfo('fathername')->getTitle());

			/******** ismale ********/
			$this->ismale->setSelectedValue($this->Data['employee']->getIsmale());
			$this->setFieldCaption('ismale',$this->Data['employee']->getFieldInfo('ismale')->getTitle());

			/******** mellicode ********/
			$this->mellicode->setValue($this->Data['employee']->getMellicode());
			$this->setFieldCaption('mellicode',$this->Data['employee']->getFieldInfo('mellicode')->getTitle());

			/******** shsh ********/
			$this->shsh->setValue($this->Data['employee']->getShsh());
			$this->setFieldCaption('shsh',$this->Data['employee']->getFieldInfo('shsh')->getTitle());

			/******** shshserial ********/
			$this->shshserial->setValue($this->Data['employee']->getShshserial());
			$this->setFieldCaption('shshserial',$this->Data['employee']->getFieldInfo('shshserial')->getTitle());

			/******** personelcode ********/
			$this->personelcode->setValue($this->Data['employee']->getPersonelcode());
			$this->setFieldCaption('personelcode',$this->Data['employee']->getFieldInfo('personelcode')->getTitle());

			/******** employmentcode ********/
			$this->employmentcode->setValue($this->Data['employee']->getEmploymentcode());
			$this->setFieldCaption('employmentcode',$this->Data['employee']->getFieldInfo('employmentcode')->getTitle());

			/******** role_fid ********/
			$this->role_fid->setSelectedValue($this->Data['employee']->getRole_fid());
			$this->setFieldCaption('role_fid',$this->Data['employee']->getFieldInfo('role_fid')->getTitle());

			/******** nationality_fid ********/
			$this->nationality_fid->setSelectedValue($this->Data['employee']->getNationality_fid());
			$this->setFieldCaption('nationality_fid',$this->Data['employee']->getFieldInfo('nationality_fid')->getTitle());

			/******** paycenter_fid ********/
			$this->paycenter_fid->setSelectedValue($this->Data['employee']->getPaycenter_fid());
			$this->setFieldCaption('paycenter_fid',$this->Data['employee']->getFieldInfo('paycenter_fid')->getTitle());

			/******** employmenttype_fid ********/
			$this->employmenttype_fid->setSelectedValue($this->Data['employee']->getEmploymenttype_fid());
			$this->setFieldCaption('employmenttype_fid',$this->Data['employee']->getFieldInfo('employmenttype_fid')->getTitle());

			/******** born_date_from ********/
			$this->born_date_from->setTime($this->Data['employee']->getBorn_date_from());
			$this->setFieldCaption('born_date_from',$this->Data['employee']->getFieldInfo('born_date_from')->getTitle());

			/******** born_date_to ********/
			$this->born_date_to->setTime($this->Data['employee']->getBorn_date_to());
			$this->setFieldCaption('born_date_to',$this->Data['employee']->getFieldInfo('born_date_to')->getTitle());
			$this->setFieldCaption('born_date',$this->Data['employee']->getFieldInfo('born_date')->getTitle());

			/******** childcount ********/
			$this->childcount->setValue($this->Data['employee']->getChildcount());
			$this->setFieldCaption('childcount',$this->Data['employee']->getFieldInfo('childcount')->getTitle());

			/******** ismarried ********/
			$this->ismarried->setSelectedValue($this->Data['employee']->getIsmarried());
			$this->setFieldCaption('ismarried',$this->Data['employee']->getFieldInfo('ismarried')->getTitle());

			/******** mobile ********/
			$this->mobile->setValue($this->Data['employee']->getMobile());
			$this->setFieldCaption('mobile',$this->Data['employee']->getFieldInfo('mobile')->getTitle());

			/******** tel ********/
			$this->tel->setValue($this->Data['employee']->getTel());
			$this->setFieldCaption('tel',$this->Data['employee']->getFieldInfo('tel')->getTitle());

			/******** address ********/
			$this->address->setValue($this->Data['employee']->getAddress());
			$this->setFieldCaption('address',$this->Data['employee']->getFieldInfo('address')->getTitle());

			/******** zipcode ********/
			$this->zipcode->setValue($this->Data['employee']->getZipcode());
			$this->setFieldCaption('zipcode',$this->Data['employee']->getFieldInfo('zipcode')->getTitle());

			/******** common_city_fid ********/
			$this->common_city_fid->setSelectedValue($this->Data['employee']->getCommon_city_fid());
			$this->setFieldCaption('common_city_fid',$this->Data['employee']->getFieldInfo('common_city_fid')->getTitle());

			/******** accountnumber ********/
			$this->accountnumber->setValue($this->Data['employee']->getAccountnumber());
			$this->setFieldCaption('accountnumber',$this->Data['employee']->getFieldInfo('accountnumber')->getTitle());

			/******** cardnumber ********/
			$this->cardnumber->setValue($this->Data['employee']->getCardnumber());
			$this->setFieldCaption('cardnumber',$this->Data['employee']->getFieldInfo('cardnumber')->getTitle());

			/******** bank_fid ********/
			$this->bank_fid->setSelectedValue($this->Data['employee']->getBank_fid());
			$this->setFieldCaption('bank_fid',$this->Data['employee']->getFieldInfo('bank_fid')->getTitle());

			/******** is_neededinsurance ********/
			$this->is_neededinsurance->setSelectedValue($this->Data['employee']->getIs_neededinsurance());
			$this->setFieldCaption('is_neededinsurance',$this->Data['employee']->getFieldInfo('is_neededinsurance')->getTitle());

			/******** is_payabale ********/
			$this->is_payabale->setSelectedValue($this->Data['employee']->getIs_payabale());
			$this->setFieldCaption('is_payabale',$this->Data['employee']->getFieldInfo('is_payabale')->getTitle());

			/******** passportnumber ********/
			$this->passportnumber->setValue($this->Data['employee']->getPassportnumber());
			$this->setFieldCaption('passportnumber',$this->Data['employee']->getFieldInfo('passportnumber')->getTitle());

			/******** passportserial ********/
			$this->passportserial->setValue($this->Data['employee']->getPassportserial());
			$this->setFieldCaption('passportserial',$this->Data['employee']->getFieldInfo('passportserial')->getTitle());

			/******** education ********/
			$this->education->setValue($this->Data['employee']->getEducation());
			$this->setFieldCaption('education',$this->Data['employee']->getFieldInfo('education')->getTitle());

			/******** entrance_date_from ********/
			$this->entrance_date_from->setTime($this->Data['employee']->getEntrance_date_from());
			$this->setFieldCaption('entrance_date_from',$this->Data['employee']->getFieldInfo('entrance_date_from')->getTitle());

			/******** entrance_date_to ********/
			$this->entrance_date_to->setTime($this->Data['employee']->getEntrance_date_to());
			$this->setFieldCaption('entrance_date_to',$this->Data['employee']->getFieldInfo('entrance_date_to')->getTitle());
			$this->setFieldCaption('entrance_date',$this->Data['employee']->getFieldInfo('entrance_date')->getTitle());

			/******** visatype_fid ********/
			$this->visatype_fid->setSelectedValue($this->Data['employee']->getVisatype_fid());
			$this->setFieldCaption('visatype_fid',$this->Data['employee']->getFieldInfo('visatype_fid')->getTitle());

			/******** visaexpire_date_from ********/
			$this->visaexpire_date_from->setTime($this->Data['employee']->getVisaexpire_date_from());
			$this->setFieldCaption('visaexpire_date_from',$this->Data['employee']->getFieldInfo('visaexpire_date_from')->getTitle());

			/******** visaexpire_date_to ********/
			$this->visaexpire_date_to->setTime($this->Data['employee']->getVisaexpire_date_to());
			$this->setFieldCaption('visaexpire_date_to',$this->Data['employee']->getFieldInfo('visaexpire_date_to')->getTitle());
			$this->setFieldCaption('visaexpire_date',$this->Data['employee']->getFieldInfo('visaexpire_date')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** name ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('name'),$this->getFieldCaption('name'));
		if(isset($_GET['name']))
			$this->name->setValue($_GET['name']);

		/******** family ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('family'),$this->getFieldCaption('family'));
		if(isset($_GET['family']))
			$this->family->setValue($_GET['family']);

		/******** fathername ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('fathername'),$this->getFieldCaption('fathername'));
		if(isset($_GET['fathername']))
			$this->fathername->setValue($_GET['fathername']);

		/******** ismale ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('ismale'),$this->getFieldCaption('ismale'));
		if(isset($_GET['ismale']))
			$this->ismale->setSelectedValue($_GET['ismale']);

		/******** mellicode ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('mellicode'),$this->getFieldCaption('mellicode'));
		if(isset($_GET['mellicode']))
			$this->mellicode->setValue($_GET['mellicode']);

		/******** shsh ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('shsh'),$this->getFieldCaption('shsh'));
		if(isset($_GET['shsh']))
			$this->shsh->setValue($_GET['shsh']);

		/******** shshserial ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('shshserial'),$this->getFieldCaption('shshserial'));
		if(isset($_GET['shshserial']))
			$this->shshserial->setValue($_GET['shshserial']);

		/******** personelcode ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('personelcode'),$this->getFieldCaption('personelcode'));
		if(isset($_GET['personelcode']))
			$this->personelcode->setValue($_GET['personelcode']);

		/******** employmentcode ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('employmentcode'),$this->getFieldCaption('employmentcode'));
		if(isset($_GET['employmentcode']))
			$this->employmentcode->setValue($_GET['employmentcode']);

		/******** role_fid ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('role_fid'),$this->getFieldCaption('role_fid'));
		if(isset($_GET['role_fid']))
			$this->role_fid->setSelectedValue($_GET['role_fid']);

		/******** nationality_fid ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('nationality_fid'),$this->getFieldCaption('nationality_fid'));
		if(isset($_GET['nationality_fid']))
			$this->nationality_fid->setSelectedValue($_GET['nationality_fid']);

		/******** paycenter_fid ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('paycenter_fid'),$this->getFieldCaption('paycenter_fid'));
		if(isset($_GET['paycenter_fid']))
			$this->paycenter_fid->setSelectedValue($_GET['paycenter_fid']);

		/******** employmenttype_fid ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('employmenttype_fid'),$this->getFieldCaption('employmenttype_fid'));
		if(isset($_GET['employmenttype_fid']))
			$this->employmenttype_fid->setSelectedValue($_GET['employmenttype_fid']);

		/******** born_date_from ********/

		/******** born_date_to ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('born_date'),$this->getFieldCaption('born_date'));

		/******** childcount ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('childcount'),$this->getFieldCaption('childcount'));
		if(isset($_GET['childcount']))
			$this->childcount->setValue($_GET['childcount']);

		/******** ismarried ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('ismarried'),$this->getFieldCaption('ismarried'));
		if(isset($_GET['ismarried']))
			$this->ismarried->setSelectedValue($_GET['ismarried']);

		/******** mobile ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('mobile'),$this->getFieldCaption('mobile'));
		if(isset($_GET['mobile']))
			$this->mobile->setValue($_GET['mobile']);

		/******** tel ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('tel'),$this->getFieldCaption('tel'));
		if(isset($_GET['tel']))
			$this->tel->setValue($_GET['tel']);

		/******** address ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('address'),$this->getFieldCaption('address'));
		if(isset($_GET['address']))
			$this->address->setValue($_GET['address']);

		/******** zipcode ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('zipcode'),$this->getFieldCaption('zipcode'));
		if(isset($_GET['zipcode']))
			$this->zipcode->setValue($_GET['zipcode']);

		/******** common_city_fid ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('common_city_fid'),$this->getFieldCaption('common_city_fid'));
		if(isset($_GET['common_city_fid']))
			$this->common_city_fid->setSelectedValue($_GET['common_city_fid']);

		/******** accountnumber ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('accountnumber'),$this->getFieldCaption('accountnumber'));
		if(isset($_GET['accountnumber']))
			$this->accountnumber->setValue($_GET['accountnumber']);

		/******** cardnumber ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('cardnumber'),$this->getFieldCaption('cardnumber'));
		if(isset($_GET['cardnumber']))
			$this->cardnumber->setValue($_GET['cardnumber']);

		/******** bank_fid ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('bank_fid'),$this->getFieldCaption('bank_fid'));
		if(isset($_GET['bank_fid']))
			$this->bank_fid->setSelectedValue($_GET['bank_fid']);

		/******** is_neededinsurance ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('is_neededinsurance'),$this->getFieldCaption('is_neededinsurance'));
		if(isset($_GET['is_neededinsurance']))
			$this->is_neededinsurance->setSelectedValue($_GET['is_neededinsurance']);

		/******** is_payabale ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('is_payabale'),$this->getFieldCaption('is_payabale'));
		if(isset($_GET['is_payabale']))
			$this->is_payabale->setSelectedValue($_GET['is_payabale']);

		/******** passportnumber ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('passportnumber'),$this->getFieldCaption('passportnumber'));
		if(isset($_GET['passportnumber']))
			$this->passportnumber->setValue($_GET['passportnumber']);

		/******** passportserial ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('passportserial'),$this->getFieldCaption('passportserial'));
		if(isset($_GET['passportserial']))
			$this->passportserial->setValue($_GET['passportserial']);

		/******** education ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('education'),$this->getFieldCaption('education'));
		if(isset($_GET['education']))
			$this->education->setValue($_GET['education']);

		/******** entrance_date_from ********/

		/******** entrance_date_to ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('entrance_date'),$this->getFieldCaption('entrance_date'));

		/******** visatype_fid ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('visatype_fid'),$this->getFieldCaption('visatype_fid'));
		if(isset($_GET['visatype_fid']))
			$this->visatype_fid->setSelectedValue($_GET['visatype_fid']);

		/******** visaexpire_date_from ********/

		/******** visaexpire_date_to ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('visaexpire_date'),$this->getFieldCaption('visaexpire_date'));

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