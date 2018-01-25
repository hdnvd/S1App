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
class manageemployee_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("iribfinance_manageemployee");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['employee']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->name,$this->getFieldCaption('name'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->family,$this->getFieldCaption('family'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->fathername,$this->getFieldCaption('fathername'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->ismale,$this->getFieldCaption('ismale'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->mellicode,$this->getFieldCaption('mellicode'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->shsh,$this->getFieldCaption('shsh'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->shshserial,$this->getFieldCaption('shshserial'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->personelcode,$this->getFieldCaption('personelcode'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->employmentcode,$this->getFieldCaption('employmentcode'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->role_fid,$this->getFieldCaption('role_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->nationality_fid,$this->getFieldCaption('nationality_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->paycenter_fid,$this->getFieldCaption('paycenter_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->employmenttype_fid,$this->getFieldCaption('employmenttype_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->born_date,$this->getFieldCaption('born_date'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->childcount,$this->getFieldCaption('childcount'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->ismarried,$this->getFieldCaption('ismarried'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->mobile,$this->getFieldCaption('mobile'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->tel,$this->getFieldCaption('tel'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->address,$this->getFieldCaption('address'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->zipcode,$this->getFieldCaption('zipcode'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->common_city_fid,$this->getFieldCaption('common_city_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->accountnumber,$this->getFieldCaption('accountnumber'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->cardnumber,$this->getFieldCaption('cardnumber'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->bank_fid,$this->getFieldCaption('bank_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->is_neededinsurance,$this->getFieldCaption('is_neededinsurance'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->is_payabale,$this->getFieldCaption('is_payabale'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->passportnumber,$this->getFieldCaption('passportnumber'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->passportserial,$this->getFieldCaption('passportserial'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->education,$this->getFieldCaption('education'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->entrance_date,$this->getFieldCaption('entrance_date'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->visatype_fid,$this->getFieldCaption('visatype_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->visaexpire_date,$this->getFieldCaption('visaexpire_date'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getSingleFieldRowCode($this->btnSave));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		$form->SetAttribute("novalidate","novalidate");
		$form->SetAttribute("data-toggle","validator");
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
	public function FillItems()
	{
			$this->ismale->addOption(1,'مرد');
			$this->ismale->addOption(0,'زن');
		foreach ($this->Data['role_fid'] as $item)
			$this->role_fid->addOption($item->getID(), $item->getTitleField());
		foreach ($this->Data['nationality_fid'] as $item)
			$this->nationality_fid->addOption($item->getID(), $item->getTitleField());
		foreach ($this->Data['paycenter_fid'] as $item)
			$this->paycenter_fid->addOption($item->getID(), $item->getTitleField());
		foreach ($this->Data['employmenttype_fid'] as $item)
			$this->employmenttype_fid->addOption($item->getID(), $item->getTitleField());
			$this->ismarried->addOption(1,'متاهل');
			$this->ismarried->addOption(0,'مجرد');
		foreach ($this->Data['common_city_fid'] as $item)
			$this->common_city_fid->addOption($item->getID(), $item->getTitle());
		foreach ($this->Data['bank_fid'] as $item)
			$this->bank_fid->addOption($item->getID(), $item->getTitleField());
			$this->is_neededinsurance->addOption(1,'بله');
			$this->is_neededinsurance->addOption(0,'خیر');
			$this->is_payabale->addOption(1,'بله');
			$this->is_payabale->addOption(0,'خیر');
		foreach ($this->Data['visatype_fid'] as $item)
			$this->visatype_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("employee", $this->Data)){

			/******** name ********/
			$this->name->setValue($this->Data['employee']->getName());
			$this->setFieldCaption('name',$this->Data['employee']->getFieldInfo('name')->getTitle());
			$this->name->setFieldInfo($this->Data['employee']->getFieldInfo('name'));

			/******** family ********/
			$this->family->setValue($this->Data['employee']->getFamily());
			$this->setFieldCaption('family',$this->Data['employee']->getFieldInfo('family')->getTitle());
			$this->family->setFieldInfo($this->Data['employee']->getFieldInfo('family'));

			/******** fathername ********/
			$this->fathername->setValue($this->Data['employee']->getFathername());
			$this->setFieldCaption('fathername',$this->Data['employee']->getFieldInfo('fathername')->getTitle());
			$this->fathername->setFieldInfo($this->Data['employee']->getFieldInfo('fathername'));

			/******** ismale ********/
			$this->ismale->setSelectedValue($this->Data['employee']->getIsmale());
			$this->setFieldCaption('ismale',$this->Data['employee']->getFieldInfo('ismale')->getTitle());

			/******** mellicode ********/
			$this->mellicode->setValue($this->Data['employee']->getMellicode());
			$this->setFieldCaption('mellicode',$this->Data['employee']->getFieldInfo('mellicode')->getTitle());
			$this->mellicode->setFieldInfo($this->Data['employee']->getFieldInfo('mellicode'));

			/******** shsh ********/
			$this->shsh->setValue($this->Data['employee']->getShsh());
			$this->setFieldCaption('shsh',$this->Data['employee']->getFieldInfo('shsh')->getTitle());
			$this->shsh->setFieldInfo($this->Data['employee']->getFieldInfo('shsh'));

			/******** shshserial ********/
			$this->shshserial->setValue($this->Data['employee']->getShshserial());
			$this->setFieldCaption('shshserial',$this->Data['employee']->getFieldInfo('shshserial')->getTitle());
			$this->shshserial->setFieldInfo($this->Data['employee']->getFieldInfo('shshserial'));

			/******** personelcode ********/
			$this->personelcode->setValue($this->Data['employee']->getPersonelcode());
			$this->setFieldCaption('personelcode',$this->Data['employee']->getFieldInfo('personelcode')->getTitle());
			$this->personelcode->setFieldInfo($this->Data['employee']->getFieldInfo('personelcode'));

			/******** employmentcode ********/
			$this->employmentcode->setValue($this->Data['employee']->getEmploymentcode());
			$this->setFieldCaption('employmentcode',$this->Data['employee']->getFieldInfo('employmentcode')->getTitle());
			$this->employmentcode->setFieldInfo($this->Data['employee']->getFieldInfo('employmentcode'));

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

			/******** born_date ********/
			$this->born_date->setTime($this->Data['employee']->getBorn_date());
			$this->setFieldCaption('born_date',$this->Data['employee']->getFieldInfo('born_date')->getTitle());
			$this->born_date->setFieldInfo($this->Data['employee']->getFieldInfo('born_date'));

			/******** childcount ********/
			$this->childcount->setValue($this->Data['employee']->getChildcount());
			$this->setFieldCaption('childcount',$this->Data['employee']->getFieldInfo('childcount')->getTitle());
			$this->childcount->setFieldInfo($this->Data['employee']->getFieldInfo('childcount'));

			/******** ismarried ********/
			$this->ismarried->setSelectedValue($this->Data['employee']->getIsmarried());
			$this->setFieldCaption('ismarried',$this->Data['employee']->getFieldInfo('ismarried')->getTitle());

			/******** mobile ********/
			$this->mobile->setValue($this->Data['employee']->getMobile());
			$this->setFieldCaption('mobile',$this->Data['employee']->getFieldInfo('mobile')->getTitle());
			$this->mobile->setFieldInfo($this->Data['employee']->getFieldInfo('mobile'));

			/******** tel ********/
			$this->tel->setValue($this->Data['employee']->getTel());
			$this->setFieldCaption('tel',$this->Data['employee']->getFieldInfo('tel')->getTitle());
			$this->tel->setFieldInfo($this->Data['employee']->getFieldInfo('tel'));

			/******** address ********/
			$this->address->setValue($this->Data['employee']->getAddress());
			$this->setFieldCaption('address',$this->Data['employee']->getFieldInfo('address')->getTitle());
			$this->address->setFieldInfo($this->Data['employee']->getFieldInfo('address'));

			/******** zipcode ********/
			$this->zipcode->setValue($this->Data['employee']->getZipcode());
			$this->setFieldCaption('zipcode',$this->Data['employee']->getFieldInfo('zipcode')->getTitle());
			$this->zipcode->setFieldInfo($this->Data['employee']->getFieldInfo('zipcode'));

			/******** common_city_fid ********/
			$this->common_city_fid->setSelectedValue($this->Data['employee']->getCommon_city_fid());
			$this->setFieldCaption('common_city_fid',$this->Data['employee']->getFieldInfo('common_city_fid')->getTitle());

			/******** accountnumber ********/
			$this->accountnumber->setValue($this->Data['employee']->getAccountnumber());
			$this->setFieldCaption('accountnumber',$this->Data['employee']->getFieldInfo('accountnumber')->getTitle());
			$this->accountnumber->setFieldInfo($this->Data['employee']->getFieldInfo('accountnumber'));

			/******** cardnumber ********/
			$this->cardnumber->setValue($this->Data['employee']->getCardnumber());
			$this->setFieldCaption('cardnumber',$this->Data['employee']->getFieldInfo('cardnumber')->getTitle());
			$this->cardnumber->setFieldInfo($this->Data['employee']->getFieldInfo('cardnumber'));

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
			$this->passportnumber->setFieldInfo($this->Data['employee']->getFieldInfo('passportnumber'));

			/******** passportserial ********/
			$this->passportserial->setValue($this->Data['employee']->getPassportserial());
			$this->setFieldCaption('passportserial',$this->Data['employee']->getFieldInfo('passportserial')->getTitle());
			$this->passportserial->setFieldInfo($this->Data['employee']->getFieldInfo('passportserial'));

			/******** education ********/
			$this->education->setValue($this->Data['employee']->getEducation());
			$this->setFieldCaption('education',$this->Data['employee']->getFieldInfo('education')->getTitle());
			$this->education->setFieldInfo($this->Data['employee']->getFieldInfo('education'));

			/******** entrance_date ********/
			$this->entrance_date->setTime($this->Data['employee']->getEntrance_date());
			$this->setFieldCaption('entrance_date',$this->Data['employee']->getFieldInfo('entrance_date')->getTitle());
			$this->entrance_date->setFieldInfo($this->Data['employee']->getFieldInfo('entrance_date'));

			/******** visatype_fid ********/
			$this->visatype_fid->setSelectedValue($this->Data['employee']->getVisatype_fid());
			$this->setFieldCaption('visatype_fid',$this->Data['employee']->getFieldInfo('visatype_fid')->getTitle());

			/******** visaexpire_date ********/
			$this->visaexpire_date->setTime($this->Data['employee']->getVisaexpire_date());
			$this->setFieldCaption('visaexpire_date',$this->Data['employee']->getFieldInfo('visaexpire_date')->getTitle());
			$this->visaexpire_date->setFieldInfo($this->Data['employee']->getFieldInfo('visaexpire_date'));

			/******** btnSave ********/
		}
	}
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

		/******* born_date *******/
		$this->born_date= new DatePicker("born_date");
		$this->born_date->setClass("form-control");

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

		/******* entrance_date *******/
		$this->entrance_date= new DatePicker("entrance_date");
		$this->entrance_date->setClass("form-control");

		/******* visatype_fid *******/
		$this->visatype_fid= new combobox("visatype_fid");
		$this->visatype_fid->setClass("form-control");

		/******* visaexpire_date *******/
		$this->visaexpire_date= new DatePicker("visaexpire_date");
		$this->visaexpire_date->setClass("form-control");

		/******* btnSave *******/
		$this->btnSave= new SweetButton(true,"ذخیره");
		$this->btnSave->setAction("btnSave");
		$this->btnSave->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
		$this->btnSave->setClass("btn btn-primary");
	}
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
	private $born_date;
	/**
	 * @return DatePicker
	 */
	public function getBorn_date()
	{
		return $this->born_date;
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
	private $entrance_date;
	/**
	 * @return DatePicker
	 */
	public function getEntrance_date()
	{
		return $this->entrance_date;
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
	private $visaexpire_date;
	/**
	 * @return DatePicker
	 */
	public function getVisaexpire_date()
	{
		return $this->visaexpire_date;
	}
	/** @var SweetButton */
	private $btnSave;
    public function getJSON()
    {
       parent::getJSON();
       $Result=['message'=>$this->getMessage(),'messagetype'=>$this->getMessageType()];
       return json_encode($Result);
    }
}
?>