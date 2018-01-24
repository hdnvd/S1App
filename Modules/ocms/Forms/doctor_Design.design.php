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
//		$Page->addElement($this->getPageTitlePart("اطلاعات " . $this->Data['doctor']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());

		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$img=new Image(DEFAULT_PUBLICURL . $this->Data['doctor']->getPhoto_flu());
        $name= new Lable($this->Data['doctor']->getName() . " " . $this->Data['doctor']->getFamily());
        $Speciality= new Lable("تخصص : " . $this->Data['speciality_fid']->getTitle());
        $MatabAddress= new Lable("آدرس : " . $this->Data['doctor']->getMatabAddress());
        $MatabTel= new Lable("تلفن : " . $this->Data['doctor']->getMatabTel());

        $LTable1->addElement($img);
        $LTable1->addElement($name);
        $LTable1->addElement($Speciality);
        $LTable1->addElement($MatabAddress);
        $LTable1->addElement($MatabTel);
        $Page->addElement($LTable1);

        $freeplans=$this->Data['freeplans'];
        $AllCount1 = count($freeplans);
        $LTable2=new Div();
        $LTable2->setClass("doctor_planlist");
        $TitleDiv=new Div();
        $TitleDiv->setClass("doctor_planlisttitle");
        $TitleDiv->addElement(new Lable('وقت های رزرو نشده'));
        $LTable2->addElement($TitleDiv);
        for ($i = 0; $i < $AllCount1; $i++) {
            $item=new Div();
            $item->setClass("doctor_planlistitem");
            $time=$freeplans[$i]->getStart_time();
            date_default_timezone_set("UTC");
            $date = new SweetDate(true, true, 'Asia/Tehran');
            $time= $date->date("Y-m-d H:i",$time);
            $title=new Lable($time);
            $hidId=new TextBox('txtplanid',$freeplans[$i]->getId(),false);
            $btnReserve=new SweetButton(true,'رزرو');
            $btnReserve->setAction('btnReserve');
            $item->addElement($hidId);
            $item->addElement($title);
            $item->addElement($btnReserve);
            $itemForm=new SweetFrom("", "POST", $item);
            $LTable2->addElement($itemForm);
        }
        $Page->addElement($LTable2);
//		$form=new SweetFrom("", "POST", $Page);
		return $Page->getHTML();
	}
	public function getJSON()
	{
		parent::getJSON();
        $Result=[];
		if (key_exists("doctor", $this->Data)){
			$Result=$this->Data['doctor']->GetArray();
		}
        $Result['speciality']=$this->Data['speciality_fid']->getTitle();
        return json_encode($Result);
	}
}
?>