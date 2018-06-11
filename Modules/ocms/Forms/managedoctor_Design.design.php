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
class managedoctor_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("ocms_managedoctor");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['doctor']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->name,$this->getFieldCaption('name'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->family,$this->getFieldCaption('family'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
//		$LTable1->addElement($this->getFieldRowCode($this->nezam_code,$this->getFieldCaption('nezam_code'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
//		$LTable1->addElement($this->getFieldRowCode($this->mellicode,$this->getFieldCaption('mellicode'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->mobile,$this->getFieldCaption('mobile'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->email,$this->getFieldCaption('email'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->tel,$this->getFieldCaption('tel'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->ismale,$this->getFieldCaption('ismale'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		if($this->getAdminMode())
		$LTable1->addElement($this->getFieldRowCode($this->speciality_fid,$this->getFieldCaption('speciality_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
//		$LTable1->addElement($this->getFieldRowCode($this->education,$this->getFieldCaption('education'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->matabtel,$this->getFieldCaption('matabtel'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
        $LTable1->addElement($this->getFieldRowCode($this->matabaddress,$this->getFieldCaption('matabaddress'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
        $LTable1->addElement($this->getFieldRowCode($this->price,$this->getFieldCaption('price'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
//		$LTable1->addElement($this->getFieldRowCode($this->longitude,$this->getFieldCaption('longitude'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
//		$LTable1->addElement($this->getFieldRowCode($this->latitude,$this->getFieldCaption('latitude'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
//		$LTable1->addElement($this->getFieldRowCode($this->common_city_fid,$this->getFieldCaption('common_city_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
//		$LTable1->addElement($this->getFieldRowCode($this->isactiveonphone,$this->getFieldCaption('isactiveonphone'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
//		$LTable1->addElement($this->getFieldRowCode($this->isactiveonplace,$this->getFieldCaption('isactiveonplace'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
//		$LTable1->addElement($this->getFieldRowCode($this->isactiveonhome,$this->getFieldCaption('isactiveonhome'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->photo_flu,$this->getFieldCaption('photo_flu'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->attachment_flu,'فایل ضمیمه',null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
        if($this->getAdminMode())
        {
            $LTable1->addElement($this->getFieldRowCode($this->username,'نام کاربری',null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
            $LTable1->addElement($this->getFieldRowCode($this->password,'کلمه عبور',null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
        }
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
		foreach ($this->Data['speciality_fid'] as $item)
			$this->speciality_fid->addOption($item->getID(), $item->getTitleField());
		foreach ($this->Data['common_city_fid'] as $item)
			$this->common_city_fid->addOption($item->getID(), $item->getTitleField());
			$this->isactiveonphone->addOption(1,'بله');
			$this->isactiveonphone->addOption(0,'خیر');
			$this->isactiveonplace->addOption(1,'بله');
			$this->isactiveonplace->addOption(0,'خیر');
			$this->isactiveonhome->addOption(1,'بله');
			$this->isactiveonhome->addOption(0,'خیر');
		if (key_exists("doctor", $this->Data)){

			/******** name ********/
			$this->name->setValue($this->Data['doctor']->getName());
			$this->setFieldCaption('name',$this->Data['doctor']->getFieldInfo('name')->getTitle());
			$this->name->setFieldInfo($this->Data['doctor']->getFieldInfo('name'));

			/********* price **********/
            $this->price->setValue($this->Data['doctor']->getPrice());
            $this->setFieldCaption('price',$this->Data['doctor']->getFieldInfo('price')->getTitle());
            $this->price->setFieldInfo($this->Data['doctor']->getFieldInfo('price'));

			/******** family ********/
			$this->family->setValue($this->Data['doctor']->getFamily());
			$this->setFieldCaption('family',$this->Data['doctor']->getFieldInfo('family')->getTitle());
			$this->family->setFieldInfo($this->Data['doctor']->getFieldInfo('family'));

			/******** nezam_code ********/
			$this->nezam_code->setValue($this->Data['doctor']->getNezam_code());
			$this->setFieldCaption('nezam_code',$this->Data['doctor']->getFieldInfo('nezam_code')->getTitle());
			$this->nezam_code->setFieldInfo($this->Data['doctor']->getFieldInfo('nezam_code'));

			/******** mellicode ********/
			$this->mellicode->setValue($this->Data['doctor']->getMellicode());
			$this->setFieldCaption('mellicode',$this->Data['doctor']->getFieldInfo('mellicode')->getTitle());
			$this->mellicode->setFieldInfo($this->Data['doctor']->getFieldInfo('mellicode'));

			/******** mobile ********/
			$this->mobile->setValue($this->Data['doctor']->getMobile());
			$this->setFieldCaption('mobile',$this->Data['doctor']->getFieldInfo('mobile')->getTitle());
			$this->mobile->setFieldInfo($this->Data['doctor']->getFieldInfo('mobile'));

			/******** email ********/
			$this->email->setValue($this->Data['doctor']->getEmail());
			$this->setFieldCaption('email',$this->Data['doctor']->getFieldInfo('email')->getTitle());
			$this->email->setFieldInfo($this->Data['doctor']->getFieldInfo('email'));

			/******** tel ********/
			$this->tel->setValue($this->Data['doctor']->getTel());
			$this->setFieldCaption('tel',$this->Data['doctor']->getFieldInfo('tel')->getTitle());
			$this->tel->setFieldInfo($this->Data['doctor']->getFieldInfo('tel'));

			/******** ismale ********/
			$this->ismale->setSelectedValue($this->Data['doctor']->getIsmale());
			$this->setFieldCaption('ismale',$this->Data['doctor']->getFieldInfo('ismale')->getTitle());

			/******** speciality_fid ********/
			$this->speciality_fid->setSelectedValue($this->Data['doctor']->getSpeciality_fid());
			$this->setFieldCaption('speciality_fid',$this->Data['doctor']->getFieldInfo('speciality_fid')->getTitle());

			/******** education ********/
			$this->education->setValue($this->Data['doctor']->getEducation());
			$this->setFieldCaption('education',$this->Data['doctor']->getFieldInfo('education')->getTitle());
			$this->education->setFieldInfo($this->Data['doctor']->getFieldInfo('education'));

			/******** matabtel ********/
			$this->matabtel->setValue($this->Data['doctor']->getMatabtel());
			$this->setFieldCaption('matabtel',$this->Data['doctor']->getFieldInfo('matabtel')->getTitle());
			$this->matabtel->setFieldInfo($this->Data['doctor']->getFieldInfo('matabtel'));

			/******** matabaddress ********/
			$this->matabaddress->setValue($this->Data['doctor']->getMatabaddress());
			$this->setFieldCaption('matabaddress',$this->Data['doctor']->getFieldInfo('matabaddress')->getTitle());
			$this->matabaddress->setFieldInfo($this->Data['doctor']->getFieldInfo('matabaddress'));

			/******** longitude ********/
			$this->longitude->setValue($this->Data['doctor']->getLongitude());
			$this->setFieldCaption('longitude',$this->Data['doctor']->getFieldInfo('longitude')->getTitle());
			$this->longitude->setFieldInfo($this->Data['doctor']->getFieldInfo('longitude'));

			/******** latitude ********/
			$this->latitude->setValue($this->Data['doctor']->getLatitude());
			$this->setFieldCaption('latitude',$this->Data['doctor']->getFieldInfo('latitude')->getTitle());
			$this->latitude->setFieldInfo($this->Data['doctor']->getFieldInfo('latitude'));

			/******** common_city_fid ********/
			$this->common_city_fid->setSelectedValue($this->Data['doctor']->getCommon_city_fid());
			$this->setFieldCaption('common_city_fid',$this->Data['doctor']->getFieldInfo('common_city_fid')->getTitle());

			/******** isactiveonphone ********/
			$this->isactiveonphone->setSelectedValue($this->Data['doctor']->getIsactiveonphone());
			$this->setFieldCaption('isactiveonphone',$this->Data['doctor']->getFieldInfo('isactiveonphone')->getTitle());

			/******** isactiveonplace ********/
			$this->isactiveonplace->setSelectedValue($this->Data['doctor']->getIsactiveonplace());
			$this->setFieldCaption('isactiveonplace',$this->Data['doctor']->getFieldInfo('isactiveonplace')->getTitle());

			/******** isactiveonhome ********/
			$this->isactiveonhome->setSelectedValue($this->Data['doctor']->getIsactiveonhome());
			$this->setFieldCaption('isactiveonhome',$this->Data['doctor']->getFieldInfo('isactiveonhome')->getTitle());

			/******** photo_flu ********/
			$this->setFieldCaption('photo_flu',$this->Data['doctor']->getFieldInfo('photo_flu')->getTitle());

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* name *******/
		$this->name= new textbox("name");
		$this->name->setClass("form-control");

        /******* price *******/
        $this->price= new textbox("price");
        $this->price->setClass("form-control");


		/******* family *******/
		$this->family= new textbox("family");
		$this->family->setClass("form-control");

		/******* nezam_code *******/
		$this->nezam_code= new textbox("nezam_code");
		$this->nezam_code->setClass("form-control");

		/******* mellicode *******/
		$this->mellicode= new textbox("mellicode");
		$this->mellicode->setClass("form-control");

		/******* mobile *******/
		$this->mobile= new textbox("mobile");
		$this->mobile->setClass("form-control");

		/******* email *******/
		$this->email= new textbox("email");
		$this->email->setClass("form-control");

		/******* tel *******/
		$this->tel= new textbox("tel");
		$this->tel->setClass("form-control");

		/******* ismale *******/
		$this->ismale= new combobox("ismale");
		$this->ismale->setClass("form-control");

		/******* speciality_fid *******/
		$this->speciality_fid= new combobox("speciality_fid");
		$this->speciality_fid->setClass("form-control");

		/******* education *******/
		$this->education= new textbox("education");
		$this->education->setClass("form-control");

		/******* matabtel *******/
		$this->matabtel= new textbox("matabtel");
		$this->matabtel->setClass("form-control");

        $this->username= new textbox("username");
        $this->username->setClass("form-control");
        $this->password= new textbox("password");
        $this->password->setClass("form-control");

		/******* matabaddress *******/
		$this->matabaddress= new textbox("matabaddress");
		$this->matabaddress->setClass("form-control");

		/******* longitude *******/
		$this->longitude= new textbox("longitude");
		$this->longitude->setClass("form-control");

		/******* latitude *******/
		$this->latitude= new textbox("latitude");
		$this->latitude->setClass("form-control");

		/******* common_city_fid *******/
		$this->common_city_fid= new combobox("common_city_fid");
		$this->common_city_fid->setClass("form-control");

		/******* isactiveonphone *******/
		$this->isactiveonphone= new combobox("isactiveonphone");
		$this->isactiveonphone->setClass("form-control");

		/******* isactiveonplace *******/
		$this->isactiveonplace= new combobox("isactiveonplace");
		$this->isactiveonplace->setClass("form-control");

		/******* isactiveonhome *******/
		$this->isactiveonhome= new combobox("isactiveonhome");
		$this->isactiveonhome->setClass("form-control");

		/******* photo_flu *******/
		$this->photo_flu= new FileUploadBox("photo_flu");
		$this->photo_flu->setClass("form-control-file");

        /******* attachment_flu *******/
        $this->attachment_flu= new FileUploadBox("attachment_flu");
        $this->attachment_flu->setClass("form-control-file");

		/******* btnSave *******/
		$this->btnSave= new SweetButton(true,"ذخیره");
		$this->btnSave->setAction("btnSave");
		$this->btnSave->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
		$this->btnSave->setClass("btn btn-primary");
	}

    /**
     * @return TextBox
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return TextBox
     */
    public function getPassword()
    {
        return $this->password;
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
    private $username;

    /** @var textbox */
    private $password;


    /** @var textbox */
    private $name;

	/** @var textbox */
	private $price;

    /**
     * @return TextBox
     */
    public function getPrice()
    {
        return $this->price;
    }

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
	private $nezam_code;
	/**
	 * @return textbox
	 */
	public function getNezam_code()
	{
		return $this->nezam_code;
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
	private $mobile;
	/**
	 * @return textbox
	 */
	public function getMobile()
	{
		return $this->mobile;
	}
	/** @var textbox */
	private $email;
	/**
	 * @return textbox
	 */
	public function getEmail()
	{
		return $this->email;
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
	/** @var combobox */
	private $ismale;
	/**
	 * @return combobox
	 */
	public function getIsmale()
	{
		return $this->ismale;
	}
	/** @var combobox */
	private $speciality_fid;
	/**
	 * @return combobox
	 */
	public function getSpeciality_fid()
	{
		return $this->speciality_fid;
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
	/** @var textbox */
	private $matabtel;
	/**
	 * @return textbox
	 */
	public function getMatabtel()
	{
		return $this->matabtel;
	}
	/** @var textbox */
	private $matabaddress;
	/**
	 * @return textbox
	 */
	public function getMatabaddress()
	{
		return $this->matabaddress;
	}
	/** @var textbox */
	private $longitude;
	/**
	 * @return textbox
	 */
	public function getLongitude()
	{
		return $this->longitude;
	}
	/** @var textbox */
	private $latitude;
	/**
	 * @return textbox
	 */
	public function getLatitude()
	{
		return $this->latitude;
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
	/** @var combobox */
	private $isactiveonphone;
	/**
	 * @return combobox
	 */
	public function getIsactiveonphone()
	{
		return $this->isactiveonphone;
	}
	/** @var combobox */
	private $isactiveonplace;
	/**
	 * @return combobox
	 */
	public function getIsactiveonplace()
	{
		return $this->isactiveonplace;
	}
	/** @var combobox */
	private $isactiveonhome;
	/**
	 * @return combobox
	 */
	public function getIsactiveonhome()
	{
		return $this->isactiveonhome;
	}
	/** @var FileUploadBox */
	private $photo_flu;
	/**
	 * @return FileUploadBox
	 */
	public function getPhoto_flu()
	{
		return $this->photo_flu;
	}
    /** @var FileUploadBox */
    private $attachment_flu;
    /**
     * @return FileUploadBox
     */
    public function getAttachment_flu()
    {
        return $this->attachment_flu;
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