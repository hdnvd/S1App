<?php
namespace Modules\ocms\Forms;
use core\CoreClasses\html\Image;
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
		$Page->addElement($this->getPageTitlePart("فهرست پزشکان"));
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->name,$this->getFieldCaption('name'),null,'',null));
		$LTable1->addElement($this->getSingleFieldRowCode($this->search));
//		$Page->addElement($LTable1);
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$Div1=new Div();
		$Div1->setClass("list");
		for($i=0;$i<count($this->Data['data']);$i++){
		$innerDiv[$i]=new Div();
		$innerDiv[$i]->setClass("doctorlist_listitem");
			$url=new AppRooter('ocms','doctor');
			$url->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
            $url->addParameter(new UrlParameter('presencetypeid',$_GET['presencetypeid']));
			$Title=$this->Data['data'][$i]->getName() . " " . $this->Data['data'][$i]->getFamily();
			if($this->Data['data'][$i]->getTitleField()=="")
				$Title='-- بدون عنوان --';
			$lbTit[$i]=new Lable($Title);
			$liTit[$i]=new link($url->getAbsoluteURL(),$lbTit[$i]);
            $imgdiv[$i]=new Div();
            $imgdiv[$i]->setClass("doctorlist_doctorphoto");
			$img[$i]=new Image(DEFAULT_PUBLICURL . $this->Data['data'][$i]->getPhoto_flu());
            $imgdiv[$i]->addElement($img[$i]);
            $innerDiv[$i]->addElement($imgdiv[$i]);
			$innerDiv[$i]->addElement($liTit[$i]);
			$Div1->addElement($innerDiv[$i]);
		}
		$Page->addElement($Div1);
		$Page->addElement($this->getPaginationPart($this->Data['pagecount'],"ocms","doctorlist",[new UrlParameter('presencetypeid',$_GET['presencetypeid'])]));
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

		if (key_exists("doctor", $this->Data)){
			/******** name ********/
			$this->name->setValue($this->Data['doctor']->getName());
			$this->setFieldCaption('name',$this->Data['doctor']->getFieldInfo('name')->getTitle());
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* name *******/
		$this->name= new textbox("name");
		$this->name->setClass("form-control");

		/******* search *******/
		$this->search= new SweetButton(true,"جستجو");
		$this->search->setAction("search");
		$this->search->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
		$this->search->setClass("btn btn-primary");
	}
}
?>