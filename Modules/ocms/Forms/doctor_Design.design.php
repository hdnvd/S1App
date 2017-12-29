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
*@creationDate 1396-10-08 - 2017-12-29 12:54
*@lastUpdate 1396-10-08 - 2017-12-29 12:54
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class doctor_Design extends FormDesign {
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
	private $nezam_code;
	/** @var lable */
	private $mellicode;
	/** @var lable */
	private $mobile;
	/** @var lable */
	private $email;
	/** @var lable */
	private $tel;
	/** @var lable */
	private $ismale;
	/** @var lable */
	private $speciality_fid;
	/** @var lable */
	private $education;
	/** @var lable */
	private $matabtel;
	/** @var lable */
	private $matabaddress;
	/** @var lable */
	private $longitude;
	/** @var lable */
	private $latitude;
	/** @var lable */
	private $common_city_fid;
	/** @var lable */
	private $isactiveonphone;
	/** @var lable */
	private $isactiveonplace;
	/** @var lable */
	private $isactiveonhome;
	/** @var lable */
	private $photo_flu;
	public function __construct()
	{

		/******* name *******/
		$this->name= new lable("name");

		/******* family *******/
		$this->family= new lable("family");

		/******* nezam_code *******/
		$this->nezam_code= new lable("nezam_code");

		/******* mellicode *******/
		$this->mellicode= new lable("mellicode");

		/******* mobile *******/
		$this->mobile= new lable("mobile");

		/******* email *******/
		$this->email= new lable("email");

		/******* tel *******/
		$this->tel= new lable("tel");

		/******* ismale *******/
		$this->ismale= new lable("ismale");

		/******* speciality_fid *******/
		$this->speciality_fid= new lable("speciality_fid");

		/******* education *******/
		$this->education= new lable("education");

		/******* matabtel *******/
		$this->matabtel= new lable("matabtel");

		/******* matabaddress *******/
		$this->matabaddress= new lable("matabaddress");

		/******* longitude *******/
		$this->longitude= new lable("longitude");

		/******* latitude *******/
		$this->latitude= new lable("latitude");

		/******* common_city_fid *******/
		$this->common_city_fid= new lable("common_city_fid");

		/******* isactiveonphone *******/
		$this->isactiveonphone= new lable("isactiveonphone");

		/******* isactiveonplace *******/
		$this->isactiveonplace= new lable("isactiveonplace");

		/******* isactiveonhome *******/
		$this->isactiveonhome= new lable("isactiveonhome");

		/******* photo_flu *******/
		$this->photo_flu= new lable("photo_flu");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("ocms_doctor");
		$Page->addElement($this->getPageTitlePart("اطلاعات " . $this->Data['doctor']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		if (key_exists("doctor", $this->Data)){
			$this->setFieldCaption('name',$this->Data['doctor']->getFieldInfo('name')->getTitle());
			$this->name->setText($this->Data['doctor']->getName());
			$this->setFieldCaption('family',$this->Data['doctor']->getFieldInfo('family')->getTitle());
			$this->family->setText($this->Data['doctor']->getFamily());
			$this->setFieldCaption('nezam_code',$this->Data['doctor']->getFieldInfo('nezam_code')->getTitle());
			$this->nezam_code->setText($this->Data['doctor']->getNezam_code());
			$this->setFieldCaption('mellicode',$this->Data['doctor']->getFieldInfo('mellicode')->getTitle());
			$this->mellicode->setText($this->Data['doctor']->getMellicode());
			$this->setFieldCaption('mobile',$this->Data['doctor']->getFieldInfo('mobile')->getTitle());
			$this->mobile->setText($this->Data['doctor']->getMobile());
			$this->setFieldCaption('email',$this->Data['doctor']->getFieldInfo('email')->getTitle());
			$this->email->setText($this->Data['doctor']->getEmail());
			$this->setFieldCaption('tel',$this->Data['doctor']->getFieldInfo('tel')->getTitle());
			$this->tel->setText($this->Data['doctor']->getTel());
			$this->setFieldCaption('ismale',$this->Data['doctor']->getFieldInfo('ismale')->getTitle());
			$ismaleTitle='No';
			if($this->Data['doctor']->getIsmale()==1)
				$ismaleTitle='Yes';
			$this->ismale->setText($ismaleTitle);
			$this->setFieldCaption('speciality_fid',$this->Data['doctor']->getFieldInfo('speciality_fid')->getTitle());
			$this->speciality_fid->setText($this->Data['speciality_fid']->getID());
			$this->setFieldCaption('education',$this->Data['doctor']->getFieldInfo('education')->getTitle());
			$this->education->setText($this->Data['doctor']->getEducation());
			$this->setFieldCaption('matabtel',$this->Data['doctor']->getFieldInfo('matabtel')->getTitle());
			$this->matabtel->setText($this->Data['doctor']->getMatabtel());
			$this->setFieldCaption('matabaddress',$this->Data['doctor']->getFieldInfo('matabaddress')->getTitle());
			$this->matabaddress->setText($this->Data['doctor']->getMatabaddress());
			$this->setFieldCaption('longitude',$this->Data['doctor']->getFieldInfo('longitude')->getTitle());
			$this->longitude->setText($this->Data['doctor']->getLongitude());
			$this->setFieldCaption('latitude',$this->Data['doctor']->getFieldInfo('latitude')->getTitle());
			$this->latitude->setText($this->Data['doctor']->getLatitude());
			$this->setFieldCaption('common_city_fid',$this->Data['doctor']->getFieldInfo('common_city_fid')->getTitle());
			$this->common_city_fid->setText($this->Data['common_city_fid']->getID());
			$this->setFieldCaption('isactiveonphone',$this->Data['doctor']->getFieldInfo('isactiveonphone')->getTitle());
			$isactiveonphoneTitle='No';
			if($this->Data['doctor']->getIsactiveonphone()==1)
				$isactiveonphoneTitle='Yes';
			$this->isactiveonphone->setText($isactiveonphoneTitle);
			$this->setFieldCaption('isactiveonplace',$this->Data['doctor']->getFieldInfo('isactiveonplace')->getTitle());
			$isactiveonplaceTitle='No';
			if($this->Data['doctor']->getIsactiveonplace()==1)
				$isactiveonplaceTitle='Yes';
			$this->isactiveonplace->setText($isactiveonplaceTitle);
			$this->setFieldCaption('isactiveonhome',$this->Data['doctor']->getFieldInfo('isactiveonhome')->getTitle());
			$isactiveonhomeTitle='No';
			if($this->Data['doctor']->getIsactiveonhome()==1)
				$isactiveonhomeTitle='Yes';
			$this->isactiveonhome->setText($isactiveonhomeTitle);
			$this->setFieldCaption('photo_flu',$this->Data['doctor']->getFieldInfo('photo_flu')->getTitle());
			$this->photo_flu->setText($this->Data['doctor']->getPhoto_flu());
		}
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getInfoRowCode($this->name,$this->getFieldCaption('name')));
		$LTable1->addElement($this->getInfoRowCode($this->family,$this->getFieldCaption('family')));
		$LTable1->addElement($this->getInfoRowCode($this->nezam_code,$this->getFieldCaption('nezam_code')));
		$LTable1->addElement($this->getInfoRowCode($this->mellicode,$this->getFieldCaption('mellicode')));
		$LTable1->addElement($this->getInfoRowCode($this->mobile,$this->getFieldCaption('mobile')));
		$LTable1->addElement($this->getInfoRowCode($this->email,$this->getFieldCaption('email')));
		$LTable1->addElement($this->getInfoRowCode($this->tel,$this->getFieldCaption('tel')));
		$LTable1->addElement($this->getInfoRowCode($this->ismale,$this->getFieldCaption('ismale')));
		$LTable1->addElement($this->getInfoRowCode($this->speciality_fid,$this->getFieldCaption('speciality_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->education,$this->getFieldCaption('education')));
		$LTable1->addElement($this->getInfoRowCode($this->matabtel,$this->getFieldCaption('matabtel')));
		$LTable1->addElement($this->getInfoRowCode($this->matabaddress,$this->getFieldCaption('matabaddress')));
		$LTable1->addElement($this->getInfoRowCode($this->longitude,$this->getFieldCaption('longitude')));
		$LTable1->addElement($this->getInfoRowCode($this->latitude,$this->getFieldCaption('latitude')));
		$LTable1->addElement($this->getInfoRowCode($this->common_city_fid,$this->getFieldCaption('common_city_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->isactiveonphone,$this->getFieldCaption('isactiveonphone')));
		$LTable1->addElement($this->getInfoRowCode($this->isactiveonplace,$this->getFieldCaption('isactiveonplace')));
		$LTable1->addElement($this->getInfoRowCode($this->isactiveonhome,$this->getFieldCaption('isactiveonhome')));
		$LTable1->addElement($this->getInfoRowCode($this->photo_flu,$this->getFieldCaption('photo_flu')));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	public function getJSON()
	{
		parent::getJSON();
		if (key_exists("doctor", $this->Data)){
			$Result=$this->Data['doctor']->GetArray();
			return json_encode($Result);
		}
		return json_encode(array());
	}
}
?>