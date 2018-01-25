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
*@creationDate 1396-11-05 - 2018-01-25 18:01
*@lastUpdate 1396-11-05 - 2018-01-25 18:01
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class employee_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var lable */
	private $name;
	/** @var lable */
	private $family;
	/** @var lable */
	private $fathername;
	/** @var lable */
	private $ismale;
	/** @var lable */
	private $mellicode;
	/** @var lable */
	private $shsh;
	/** @var lable */
	private $shshserial;
	/** @var lable */
	private $personelcode;
	/** @var lable */
	private $employmentcode;
	/** @var lable */
	private $role_fid;
	/** @var lable */
	private $nationality_fid;
	/** @var lable */
	private $paycenter_fid;
	/** @var lable */
	private $employmenttype_fid;
	/** @var lable */
	private $born_date;
	/** @var lable */
	private $childcount;
	/** @var lable */
	private $ismarried;
	/** @var lable */
	private $mobile;
	/** @var lable */
	private $tel;
	/** @var lable */
	private $address;
	/** @var lable */
	private $zipcode;
	/** @var lable */
	private $common_city_fid;
	/** @var lable */
	private $accountnumber;
	/** @var lable */
	private $cardnumber;
	/** @var lable */
	private $bank_fid;
	/** @var lable */
	private $is_neededinsurance;
	/** @var lable */
	private $is_payabale;
	/** @var lable */
	private $passportnumber;
	/** @var lable */
	private $passportserial;
	/** @var lable */
	private $education;
	/** @var lable */
	private $entrance_date;
	/** @var lable */
	private $visatype_fid;
	/** @var lable */
	private $visaexpire_date;
	public function __construct()
	{

		/******* name *******/
		$this->name= new lable("name");

		/******* family *******/
		$this->family= new lable("family");

		/******* fathername *******/
		$this->fathername= new lable("fathername");

		/******* ismale *******/
		$this->ismale= new lable("ismale");

		/******* mellicode *******/
		$this->mellicode= new lable("mellicode");

		/******* shsh *******/
		$this->shsh= new lable("shsh");

		/******* shshserial *******/
		$this->shshserial= new lable("shshserial");

		/******* personelcode *******/
		$this->personelcode= new lable("personelcode");

		/******* employmentcode *******/
		$this->employmentcode= new lable("employmentcode");

		/******* role_fid *******/
		$this->role_fid= new lable("role_fid");

		/******* nationality_fid *******/
		$this->nationality_fid= new lable("nationality_fid");

		/******* paycenter_fid *******/
		$this->paycenter_fid= new lable("paycenter_fid");

		/******* employmenttype_fid *******/
		$this->employmenttype_fid= new lable("employmenttype_fid");

		/******* born_date *******/
		$this->born_date= new lable("born_date");

		/******* childcount *******/
		$this->childcount= new lable("childcount");

		/******* ismarried *******/
		$this->ismarried= new lable("ismarried");

		/******* mobile *******/
		$this->mobile= new lable("mobile");

		/******* tel *******/
		$this->tel= new lable("tel");

		/******* address *******/
		$this->address= new lable("address");

		/******* zipcode *******/
		$this->zipcode= new lable("zipcode");

		/******* common_city_fid *******/
		$this->common_city_fid= new lable("common_city_fid");

		/******* accountnumber *******/
		$this->accountnumber= new lable("accountnumber");

		/******* cardnumber *******/
		$this->cardnumber= new lable("cardnumber");

		/******* bank_fid *******/
		$this->bank_fid= new lable("bank_fid");

		/******* is_neededinsurance *******/
		$this->is_neededinsurance= new lable("is_neededinsurance");

		/******* is_payabale *******/
		$this->is_payabale= new lable("is_payabale");

		/******* passportnumber *******/
		$this->passportnumber= new lable("passportnumber");

		/******* passportserial *******/
		$this->passportserial= new lable("passportserial");

		/******* education *******/
		$this->education= new lable("education");

		/******* entrance_date *******/
		$this->entrance_date= new lable("entrance_date");

		/******* visatype_fid *******/
		$this->visatype_fid= new lable("visatype_fid");

		/******* visaexpire_date *******/
		$this->visaexpire_date= new lable("visaexpire_date");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("iribfinance_employee");
		$Page->addElement($this->getPageTitlePart("اطلاعات " . $this->Data['employee']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		if (key_exists("employee", $this->Data)){
			$this->setFieldCaption('name',$this->Data['employee']->getFieldInfo('name')->getTitle());
			$this->name->setText($this->Data['employee']->getName());
			$this->setFieldCaption('family',$this->Data['employee']->getFieldInfo('family')->getTitle());
			$this->family->setText($this->Data['employee']->getFamily());
			$this->setFieldCaption('fathername',$this->Data['employee']->getFieldInfo('fathername')->getTitle());
			$this->fathername->setText($this->Data['employee']->getFathername());
			$this->setFieldCaption('ismale',$this->Data['employee']->getFieldInfo('ismale')->getTitle());
			$ismaleTitle='No';
			if($this->Data['employee']->getIsmale()==1)
				$ismaleTitle='Yes';
			$this->ismale->setText($ismaleTitle);
			$this->setFieldCaption('mellicode',$this->Data['employee']->getFieldInfo('mellicode')->getTitle());
			$this->mellicode->setText($this->Data['employee']->getMellicode());
			$this->setFieldCaption('shsh',$this->Data['employee']->getFieldInfo('shsh')->getTitle());
			$this->shsh->setText($this->Data['employee']->getShsh());
			$this->setFieldCaption('shshserial',$this->Data['employee']->getFieldInfo('shshserial')->getTitle());
			$this->shshserial->setText($this->Data['employee']->getShshserial());
			$this->setFieldCaption('personelcode',$this->Data['employee']->getFieldInfo('personelcode')->getTitle());
			$this->personelcode->setText($this->Data['employee']->getPersonelcode());
			$this->setFieldCaption('employmentcode',$this->Data['employee']->getFieldInfo('employmentcode')->getTitle());
			$this->employmentcode->setText($this->Data['employee']->getEmploymentcode());
			$this->setFieldCaption('role_fid',$this->Data['employee']->getFieldInfo('role_fid')->getTitle());
			$this->role_fid->setText($this->Data['role_fid']->getID());
			$this->setFieldCaption('nationality_fid',$this->Data['employee']->getFieldInfo('nationality_fid')->getTitle());
			$this->nationality_fid->setText($this->Data['nationality_fid']->getID());
			$this->setFieldCaption('paycenter_fid',$this->Data['employee']->getFieldInfo('paycenter_fid')->getTitle());
			$this->paycenter_fid->setText($this->Data['paycenter_fid']->getID());
			$this->setFieldCaption('employmenttype_fid',$this->Data['employee']->getFieldInfo('employmenttype_fid')->getTitle());
			$this->employmenttype_fid->setText($this->Data['employmenttype_fid']->getID());
			$this->setFieldCaption('born_date',$this->Data['employee']->getFieldInfo('born_date')->getTitle());
			$born_date_SD=new SweetDate(true, true, 'Asia/Tehran');
			$born_date_Text=$born_date_SD->date("l d F Y",$this->Data['employee']->getBorn_date());
			$this->born_date->setText($born_date_Text);
			$this->setFieldCaption('childcount',$this->Data['employee']->getFieldInfo('childcount')->getTitle());
			$this->childcount->setText($this->Data['employee']->getChildcount());
			$this->setFieldCaption('ismarried',$this->Data['employee']->getFieldInfo('ismarried')->getTitle());
			$ismarriedTitle='No';
			if($this->Data['employee']->getIsmarried()==1)
				$ismarriedTitle='Yes';
			$this->ismarried->setText($ismarriedTitle);
			$this->setFieldCaption('mobile',$this->Data['employee']->getFieldInfo('mobile')->getTitle());
			$this->mobile->setText($this->Data['employee']->getMobile());
			$this->setFieldCaption('tel',$this->Data['employee']->getFieldInfo('tel')->getTitle());
			$this->tel->setText($this->Data['employee']->getTel());
			$this->setFieldCaption('address',$this->Data['employee']->getFieldInfo('address')->getTitle());
			$this->address->setText($this->Data['employee']->getAddress());
			$this->setFieldCaption('zipcode',$this->Data['employee']->getFieldInfo('zipcode')->getTitle());
			$this->zipcode->setText($this->Data['employee']->getZipcode());
			$this->setFieldCaption('common_city_fid',$this->Data['employee']->getFieldInfo('common_city_fid')->getTitle());
			$this->common_city_fid->setText($this->Data['common_city_fid']->getID());
			$this->setFieldCaption('accountnumber',$this->Data['employee']->getFieldInfo('accountnumber')->getTitle());
			$this->accountnumber->setText($this->Data['employee']->getAccountnumber());
			$this->setFieldCaption('cardnumber',$this->Data['employee']->getFieldInfo('cardnumber')->getTitle());
			$this->cardnumber->setText($this->Data['employee']->getCardnumber());
			$this->setFieldCaption('bank_fid',$this->Data['employee']->getFieldInfo('bank_fid')->getTitle());
			$this->bank_fid->setText($this->Data['bank_fid']->getID());
			$this->setFieldCaption('is_neededinsurance',$this->Data['employee']->getFieldInfo('is_neededinsurance')->getTitle());
			$is_neededinsuranceTitle='No';
			if($this->Data['employee']->getIs_neededinsurance()==1)
				$is_neededinsuranceTitle='Yes';
			$this->is_neededinsurance->setText($is_neededinsuranceTitle);
			$this->setFieldCaption('is_payabale',$this->Data['employee']->getFieldInfo('is_payabale')->getTitle());
			$is_payabaleTitle='No';
			if($this->Data['employee']->getIs_payabale()==1)
				$is_payabaleTitle='Yes';
			$this->is_payabale->setText($is_payabaleTitle);
			$this->setFieldCaption('passportnumber',$this->Data['employee']->getFieldInfo('passportnumber')->getTitle());
			$this->passportnumber->setText($this->Data['employee']->getPassportnumber());
			$this->setFieldCaption('passportserial',$this->Data['employee']->getFieldInfo('passportserial')->getTitle());
			$this->passportserial->setText($this->Data['employee']->getPassportserial());
			$this->setFieldCaption('education',$this->Data['employee']->getFieldInfo('education')->getTitle());
			$this->education->setText($this->Data['employee']->getEducation());
			$this->setFieldCaption('entrance_date',$this->Data['employee']->getFieldInfo('entrance_date')->getTitle());
			$entrance_date_SD=new SweetDate(true, true, 'Asia/Tehran');
			$entrance_date_Text=$entrance_date_SD->date("l d F Y",$this->Data['employee']->getEntrance_date());
			$this->entrance_date->setText($entrance_date_Text);
			$this->setFieldCaption('visatype_fid',$this->Data['employee']->getFieldInfo('visatype_fid')->getTitle());
			$this->visatype_fid->setText($this->Data['visatype_fid']->getID());
			$this->setFieldCaption('visaexpire_date',$this->Data['employee']->getFieldInfo('visaexpire_date')->getTitle());
			$visaexpire_date_SD=new SweetDate(true, true, 'Asia/Tehran');
			$visaexpire_date_Text=$visaexpire_date_SD->date("l d F Y",$this->Data['employee']->getVisaexpire_date());
			$this->visaexpire_date->setText($visaexpire_date_Text);
		}
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getInfoRowCode($this->name,$this->getFieldCaption('name')));
		$LTable1->addElement($this->getInfoRowCode($this->family,$this->getFieldCaption('family')));
		$LTable1->addElement($this->getInfoRowCode($this->fathername,$this->getFieldCaption('fathername')));
		$LTable1->addElement($this->getInfoRowCode($this->ismale,$this->getFieldCaption('ismale')));
		$LTable1->addElement($this->getInfoRowCode($this->mellicode,$this->getFieldCaption('mellicode')));
		$LTable1->addElement($this->getInfoRowCode($this->shsh,$this->getFieldCaption('shsh')));
		$LTable1->addElement($this->getInfoRowCode($this->shshserial,$this->getFieldCaption('shshserial')));
		$LTable1->addElement($this->getInfoRowCode($this->personelcode,$this->getFieldCaption('personelcode')));
		$LTable1->addElement($this->getInfoRowCode($this->employmentcode,$this->getFieldCaption('employmentcode')));
		$LTable1->addElement($this->getInfoRowCode($this->role_fid,$this->getFieldCaption('role_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->nationality_fid,$this->getFieldCaption('nationality_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->paycenter_fid,$this->getFieldCaption('paycenter_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->employmenttype_fid,$this->getFieldCaption('employmenttype_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->born_date,$this->getFieldCaption('born_date')));
		$LTable1->addElement($this->getInfoRowCode($this->childcount,$this->getFieldCaption('childcount')));
		$LTable1->addElement($this->getInfoRowCode($this->ismarried,$this->getFieldCaption('ismarried')));
		$LTable1->addElement($this->getInfoRowCode($this->mobile,$this->getFieldCaption('mobile')));
		$LTable1->addElement($this->getInfoRowCode($this->tel,$this->getFieldCaption('tel')));
		$LTable1->addElement($this->getInfoRowCode($this->address,$this->getFieldCaption('address')));
		$LTable1->addElement($this->getInfoRowCode($this->zipcode,$this->getFieldCaption('zipcode')));
		$LTable1->addElement($this->getInfoRowCode($this->common_city_fid,$this->getFieldCaption('common_city_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->accountnumber,$this->getFieldCaption('accountnumber')));
		$LTable1->addElement($this->getInfoRowCode($this->cardnumber,$this->getFieldCaption('cardnumber')));
		$LTable1->addElement($this->getInfoRowCode($this->bank_fid,$this->getFieldCaption('bank_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->is_neededinsurance,$this->getFieldCaption('is_neededinsurance')));
		$LTable1->addElement($this->getInfoRowCode($this->is_payabale,$this->getFieldCaption('is_payabale')));
		$LTable1->addElement($this->getInfoRowCode($this->passportnumber,$this->getFieldCaption('passportnumber')));
		$LTable1->addElement($this->getInfoRowCode($this->passportserial,$this->getFieldCaption('passportserial')));
		$LTable1->addElement($this->getInfoRowCode($this->education,$this->getFieldCaption('education')));
		$LTable1->addElement($this->getInfoRowCode($this->entrance_date,$this->getFieldCaption('entrance_date')));
		$LTable1->addElement($this->getInfoRowCode($this->visatype_fid,$this->getFieldCaption('visatype_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->visaexpire_date,$this->getFieldCaption('visaexpire_date')));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	public function getJSON()
	{
		parent::getJSON();
		if (key_exists("employee", $this->Data)){
			$Result=$this->Data['employee']->GetArray();
			return json_encode($Result);
		}
		return json_encode(array());
	}
}
?>