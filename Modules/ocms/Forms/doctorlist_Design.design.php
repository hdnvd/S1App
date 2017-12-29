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
class doctorlist_Design extends FormDesign {
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
		$Page->setId("ocms_doctorlist");
		$Page->addElement($this->getPageTitlePart("فهرست " . $this->Data['doctor']->getTableTitle() . " ها"));
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->name,$this->getFieldCaption('name'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->family,$this->getFieldCaption('family'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->nezam_code,$this->getFieldCaption('nezam_code'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->mellicode,$this->getFieldCaption('mellicode'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->mobile,$this->getFieldCaption('mobile'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->email,$this->getFieldCaption('email'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->tel,$this->getFieldCaption('tel'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->ismale,$this->getFieldCaption('ismale'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->speciality_fid,$this->getFieldCaption('speciality_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->education,$this->getFieldCaption('education'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->matabtel,$this->getFieldCaption('matabtel'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->matabaddress,$this->getFieldCaption('matabaddress'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->longitude,$this->getFieldCaption('longitude'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->latitude,$this->getFieldCaption('latitude'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->common_city_fid,$this->getFieldCaption('common_city_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->isactiveonphone,$this->getFieldCaption('isactiveonphone'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->isactiveonplace,$this->getFieldCaption('isactiveonplace'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->isactiveonhome,$this->getFieldCaption('isactiveonhome'),null,'',null));
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
			$url=new AppRooter('ocms','doctor');
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
		$Page->addElement($this->getPaginationPart($this->Data['pagecount'],"ocms","doctorlist"));
		$PageLink=new AppRooter('ocms','doctorlist');
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
				$Result[$i]=$this->Data['data'][$i]->GetArray();
			}
			return json_encode($Result);
		}
		return json_encode(array());
	}
	public function FillItems()
	{
			$this->ismale->addOption("", "مهم نیست");
			$this->ismale->addOption(1,'مرد');
			$this->ismale->addOption(0,'زن');
			$this->speciality_fid->addOption("", "مهم نیست");
		foreach ($this->Data['speciality_fid'] as $item)
			$this->speciality_fid->addOption($item->getID(), $item->getTitleField());
			$this->common_city_fid->addOption("", "مهم نیست");
		foreach ($this->Data['common_city_fid'] as $item)
			$this->common_city_fid->addOption($item->getID(), $item->getTitleField());
			$this->isactiveonphone->addOption("", "مهم نیست");
			$this->isactiveonphone->addOption(1,'بله');
			$this->isactiveonphone->addOption(0,'خیر');
			$this->isactiveonplace->addOption("", "مهم نیست");
			$this->isactiveonplace->addOption(1,'بله');
			$this->isactiveonplace->addOption(0,'خیر');
			$this->isactiveonhome->addOption("", "مهم نیست");
			$this->isactiveonhome->addOption(1,'بله');
			$this->isactiveonhome->addOption(0,'خیر');
		if (key_exists("doctor", $this->Data)){

			/******** name ********/
			$this->name->setValue($this->Data['doctor']->getName());
			$this->setFieldCaption('name',$this->Data['doctor']->getFieldInfo('name')->getTitle());

			/******** family ********/
			$this->family->setValue($this->Data['doctor']->getFamily());
			$this->setFieldCaption('family',$this->Data['doctor']->getFieldInfo('family')->getTitle());

			/******** nezam_code ********/
			$this->nezam_code->setValue($this->Data['doctor']->getNezam_code());
			$this->setFieldCaption('nezam_code',$this->Data['doctor']->getFieldInfo('nezam_code')->getTitle());

			/******** mellicode ********/
			$this->mellicode->setValue($this->Data['doctor']->getMellicode());
			$this->setFieldCaption('mellicode',$this->Data['doctor']->getFieldInfo('mellicode')->getTitle());

			/******** mobile ********/
			$this->mobile->setValue($this->Data['doctor']->getMobile());
			$this->setFieldCaption('mobile',$this->Data['doctor']->getFieldInfo('mobile')->getTitle());

			/******** email ********/
			$this->email->setValue($this->Data['doctor']->getEmail());
			$this->setFieldCaption('email',$this->Data['doctor']->getFieldInfo('email')->getTitle());

			/******** tel ********/
			$this->tel->setValue($this->Data['doctor']->getTel());
			$this->setFieldCaption('tel',$this->Data['doctor']->getFieldInfo('tel')->getTitle());

			/******** ismale ********/
			$this->ismale->setSelectedValue($this->Data['doctor']->getIsmale());
			$this->setFieldCaption('ismale',$this->Data['doctor']->getFieldInfo('ismale')->getTitle());

			/******** speciality_fid ********/
			$this->speciality_fid->setSelectedValue($this->Data['doctor']->getSpeciality_fid());
			$this->setFieldCaption('speciality_fid',$this->Data['doctor']->getFieldInfo('speciality_fid')->getTitle());

			/******** education ********/
			$this->education->setValue($this->Data['doctor']->getEducation());
			$this->setFieldCaption('education',$this->Data['doctor']->getFieldInfo('education')->getTitle());

			/******** matabtel ********/
			$this->matabtel->setValue($this->Data['doctor']->getMatabtel());
			$this->setFieldCaption('matabtel',$this->Data['doctor']->getFieldInfo('matabtel')->getTitle());

			/******** matabaddress ********/
			$this->matabaddress->setValue($this->Data['doctor']->getMatabaddress());
			$this->setFieldCaption('matabaddress',$this->Data['doctor']->getFieldInfo('matabaddress')->getTitle());

			/******** longitude ********/
			$this->longitude->setValue($this->Data['doctor']->getLongitude());
			$this->setFieldCaption('longitude',$this->Data['doctor']->getFieldInfo('longitude')->getTitle());

			/******** latitude ********/
			$this->latitude->setValue($this->Data['doctor']->getLatitude());
			$this->setFieldCaption('latitude',$this->Data['doctor']->getFieldInfo('latitude')->getTitle());

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

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** name ********/
		$this->sortby->addOption($this->Data['doctor']->getTableFieldID('name'),$this->getFieldCaption('name'));
		if(isset($_GET['name']))
			$this->name->setValue($_GET['name']);

		/******** family ********/
		$this->sortby->addOption($this->Data['doctor']->getTableFieldID('family'),$this->getFieldCaption('family'));
		if(isset($_GET['family']))
			$this->family->setValue($_GET['family']);

		/******** nezam_code ********/
		$this->sortby->addOption($this->Data['doctor']->getTableFieldID('nezam_code'),$this->getFieldCaption('nezam_code'));
		if(isset($_GET['nezam_code']))
			$this->nezam_code->setValue($_GET['nezam_code']);

		/******** mellicode ********/
		$this->sortby->addOption($this->Data['doctor']->getTableFieldID('mellicode'),$this->getFieldCaption('mellicode'));
		if(isset($_GET['mellicode']))
			$this->mellicode->setValue($_GET['mellicode']);

		/******** mobile ********/
		$this->sortby->addOption($this->Data['doctor']->getTableFieldID('mobile'),$this->getFieldCaption('mobile'));
		if(isset($_GET['mobile']))
			$this->mobile->setValue($_GET['mobile']);

		/******** email ********/
		$this->sortby->addOption($this->Data['doctor']->getTableFieldID('email'),$this->getFieldCaption('email'));
		if(isset($_GET['email']))
			$this->email->setValue($_GET['email']);

		/******** tel ********/
		$this->sortby->addOption($this->Data['doctor']->getTableFieldID('tel'),$this->getFieldCaption('tel'));
		if(isset($_GET['tel']))
			$this->tel->setValue($_GET['tel']);

		/******** ismale ********/
		$this->sortby->addOption($this->Data['doctor']->getTableFieldID('ismale'),$this->getFieldCaption('ismale'));
		if(isset($_GET['ismale']))
			$this->ismale->setSelectedValue($_GET['ismale']);

		/******** speciality_fid ********/
		$this->sortby->addOption($this->Data['doctor']->getTableFieldID('speciality_fid'),$this->getFieldCaption('speciality_fid'));
		if(isset($_GET['speciality_fid']))
			$this->speciality_fid->setSelectedValue($_GET['speciality_fid']);

		/******** education ********/
		$this->sortby->addOption($this->Data['doctor']->getTableFieldID('education'),$this->getFieldCaption('education'));
		if(isset($_GET['education']))
			$this->education->setValue($_GET['education']);

		/******** matabtel ********/
		$this->sortby->addOption($this->Data['doctor']->getTableFieldID('matabtel'),$this->getFieldCaption('matabtel'));
		if(isset($_GET['matabtel']))
			$this->matabtel->setValue($_GET['matabtel']);

		/******** matabaddress ********/
		$this->sortby->addOption($this->Data['doctor']->getTableFieldID('matabaddress'),$this->getFieldCaption('matabaddress'));
		if(isset($_GET['matabaddress']))
			$this->matabaddress->setValue($_GET['matabaddress']);

		/******** longitude ********/
		$this->sortby->addOption($this->Data['doctor']->getTableFieldID('longitude'),$this->getFieldCaption('longitude'));
		if(isset($_GET['longitude']))
			$this->longitude->setValue($_GET['longitude']);

		/******** latitude ********/
		$this->sortby->addOption($this->Data['doctor']->getTableFieldID('latitude'),$this->getFieldCaption('latitude'));
		if(isset($_GET['latitude']))
			$this->latitude->setValue($_GET['latitude']);

		/******** common_city_fid ********/
		$this->sortby->addOption($this->Data['doctor']->getTableFieldID('common_city_fid'),$this->getFieldCaption('common_city_fid'));
		if(isset($_GET['common_city_fid']))
			$this->common_city_fid->setSelectedValue($_GET['common_city_fid']);

		/******** isactiveonphone ********/
		$this->sortby->addOption($this->Data['doctor']->getTableFieldID('isactiveonphone'),$this->getFieldCaption('isactiveonphone'));
		if(isset($_GET['isactiveonphone']))
			$this->isactiveonphone->setSelectedValue($_GET['isactiveonphone']);

		/******** isactiveonplace ********/
		$this->sortby->addOption($this->Data['doctor']->getTableFieldID('isactiveonplace'),$this->getFieldCaption('isactiveonplace'));
		if(isset($_GET['isactiveonplace']))
			$this->isactiveonplace->setSelectedValue($_GET['isactiveonplace']);

		/******** isactiveonhome ********/
		$this->sortby->addOption($this->Data['doctor']->getTableFieldID('isactiveonhome'),$this->getFieldCaption('isactiveonhome'));
		if(isset($_GET['isactiveonhome']))
			$this->isactiveonhome->setSelectedValue($_GET['isactiveonhome']);

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

		/******* name *******/
		$this->name= new textbox("name");
		$this->name->setClass("form-control");

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