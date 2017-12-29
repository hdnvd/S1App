<?php
namespace Modules\onlineclass\Forms;
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
*@creationDate 1396-07-25 - 2017-10-17 22:27
*@lastUpdate 1396-07-25 - 2017-10-17 22:27
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class userlist_Design extends FormDesign {
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
	private $fullname;
	/**
	 * @return textbox
	 */
	public function getFullname()
	{
		return $this->fullname;
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
	private $email;
	/**
	 * @return textbox
	 */
	public function getEmail()
	{
		return $this->email;
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
	/** @var DatePicker */
	private $registration_time_from;
	/**
	 * @return DatePicker
	 */
	public function getRegistration_time_from()
	{
		return $this->registration_time_from;
	}
	/** @var DatePicker */
	private $registration_time_to;
	/**
	 * @return DatePicker
	 */
	public function getRegistration_time_to()
	{
		return $this->registration_time_to;
	}
	/** @var textbox */
	private $devicecode;
	/**
	 * @return textbox
	 */
	public function getDevicecode()
	{
		return $this->devicecode;
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
		$Page->setId("onlineclass_userlist");
		$Page->addElement($this->getPageTitlePart("فهرست " . $this->Data['user']->getTableTitle() . " ها"));
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->fullname,$this->getFieldCaption('fullname'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->ismale,$this->getFieldCaption('ismale'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->email,$this->getFieldCaption('email'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->mobile,$this->getFieldCaption('mobile'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->registration_time_from,$this->getFieldCaption('registration_time_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->registration_time_to,$this->getFieldCaption('registration_time_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->devicecode,$this->getFieldCaption('devicecode'),null,'',null));
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
			$url=new AppRooter('onlineclass','user');
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
		$Page->addElement($this->getPaginationPart($this->Data['pagecount'],"onlineclass","userlist"));
		$PageLink=new AppRooter('onlineclass','userlist');
		$form=new SweetFrom($PageLink->getAbsoluteURL(), "GET", $Page);
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
	public function FillItems()
	{

			/******** fullname ********/
		if (key_exists("user", $this->Data)){
			$this->fullname->setValue($this->Data['user']->getFullname());
			$this->setFieldCaption('fullname',$this->Data['user']->getFieldInfo('fullname')->getTitle());
		}

			/******** ismale ********/
			$this->ismale->addOption("", "مهم نیست");
			$this->ismale->addOption(1,'مرد');
			$this->ismale->addOption(0,'زن');
		if (key_exists("user", $this->Data)){
			$this->ismale->setSelectedValue($this->Data['user']->getIsmale());
			$this->setFieldCaption('ismale',$this->Data['user']->getFieldInfo('ismale')->getTitle());
		}

			/******** email ********/
		if (key_exists("user", $this->Data)){
			$this->email->setValue($this->Data['user']->getEmail());
			$this->setFieldCaption('email',$this->Data['user']->getFieldInfo('email')->getTitle());
		}

			/******** mobile ********/
		if (key_exists("user", $this->Data)){
			$this->mobile->setValue($this->Data['user']->getMobile());
			$this->setFieldCaption('mobile',$this->Data['user']->getFieldInfo('mobile')->getTitle());
		}

			/******** registration_time_from ********/
		if (key_exists("user", $this->Data)){
			$this->registration_time_from->setTime($this->Data['user']->getRegistration_time_from());
			$this->setFieldCaption('registration_time_from',$this->Data['user']->getFieldInfo('registration_time_from')->getTitle());
		}

			/******** registration_time_to ********/
		if (key_exists("user", $this->Data)){
			$this->registration_time_to->setTime($this->Data['user']->getRegistration_time_to());
			$this->setFieldCaption('registration_time_to',$this->Data['user']->getFieldInfo('registration_time_to')->getTitle());
			$this->setFieldCaption('registration_time',$this->Data['user']->getFieldInfo('registration_time')->getTitle());
		}

			/******** devicecode ********/
		if (key_exists("user", $this->Data)){
			$this->devicecode->setValue($this->Data['user']->getDevicecode());
			$this->setFieldCaption('devicecode',$this->Data['user']->getFieldInfo('devicecode')->getTitle());
		}

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** fullname ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('fullname'),$this->getFieldCaption('fullname'));
		if(isset($_GET['fullname']))
			$this->fullname->setValue($_GET['fullname']);

		/******** ismale ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('ismale'),$this->getFieldCaption('ismale'));
		if(isset($_GET['ismale']))
			$this->ismale->setSelectedValue($_GET['ismale']);

		/******** email ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('email'),$this->getFieldCaption('email'));
		if(isset($_GET['email']))
			$this->email->setValue($_GET['email']);

		/******** mobile ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('mobile'),$this->getFieldCaption('mobile'));
		if(isset($_GET['mobile']))
			$this->mobile->setValue($_GET['mobile']);

		/******** registration_time_from ********/

		/******** registration_time_to ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('registration_time'),$this->getFieldCaption('registration_time'));

		/******** devicecode ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('devicecode'),$this->getFieldCaption('devicecode'));
		if(isset($_GET['devicecode']))
			$this->devicecode->setValue($_GET['devicecode']);

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

		/******* fullname *******/
		$this->fullname= new textbox("fullname");
		$this->fullname->setClass("form-control");

		/******* ismale *******/
		$this->ismale= new combobox("ismale");
		$this->ismale->setClass("form-control");

		/******* email *******/
		$this->email= new textbox("email");
		$this->email->setClass("form-control");

		/******* mobile *******/
		$this->mobile= new textbox("mobile");
		$this->mobile->setClass("form-control");

		/******* registration_time_from *******/
		$this->registration_time_from= new DatePicker("registration_time_from");
		$this->registration_time_from->setClass("form-control");

		/******* registration_time_to *******/
		$this->registration_time_to= new DatePicker("registration_time_to");
		$this->registration_time_to->setClass("form-control");

		/******* devicecode *******/
		$this->devicecode= new textbox("devicecode");
		$this->devicecode->setClass("form-control");

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
	public function getJSON()
    {
        parent::getJSON();
//        echo "Status";
        if($this->Data['service']=="getuserstatus")
        {
            $status=$this->Data['status'];
            if($status!=1)
                return json_encode(['status'=>$status]);
            else
                return json_encode(['userid'=>$this->Data['data']->getRole_systemuser_fid(),'status'=>$status]);
        }
        elseif($this->Data['service']=="getusercourses")
        {
            if(key_exists('courses',$this->Data))
            {
                $courses=$this->Data['courses'];
                $coursetutors=$this->Data['coursetutors'];
                $result=array();
                $AllCount1 = count($courses);
                for ($i = 0; $i < $AllCount1; $i++) {
                    $crs=$courses[$i];
                    $result[$i]['title']=$crs->getTitle();
                    $result[$i]['price']=$crs->getPrice();
                    $startdate=new SweetDate();
                    $startdate=$startdate->date("y/n/d",$crs->getStart_date());
                    $result[$i]['startdate']=$startdate;
                    $result[$i]['description']=$crs->getDescription();
                    $result[$i]['tutor']=$coursetutors[$i]->getName() . " " . $coursetutors[$i]->getFamily();
                    $result[$i]['id']=$crs->getID();
                }
            }
            else
            {
                $result=array();
            }

            return json_encode($result);
        }
        elseif($this->Data['service']=="getnotbuyedcourses")
        {
            $courses=$this->Data['courses'];
            $coursetutors=$this->Data['coursetutors'];
            $result=array();
            $AllCount1 = count($courses);
            for ($i = 0; $i < $AllCount1; $i++) {
                $crs=$courses[$i];
                $result[$i]['title']=$crs->getTitle();
                $result[$i]['price']=$crs->getPrice();
                $startdate=new SweetDate();
                $startdate=$startdate->date("y/n/d",$crs->getStart_date());
                $result[$i]['startdate']=$startdate;
                $result[$i]['description']=$crs->getDescription();
                $result[$i]['tutor']=$coursetutors[$i]->getName() . " " . $coursetutors[$i]->getFamily();
                $result[$i]['id']=$crs->getID();
            }
            return json_encode($result);
        }
        elseif($this->Data['service']=="getcoursevideos")
        {
            $videos=$this->Data['videos'];
            $result=array();
            $AllCount1 = count($videos);
            for ($i = 0; $i < $AllCount1; $i++) {
                $crs=$videos[$i];
                $result[$i]['title']=$crs->getTitle();
                $result[$i]['hold_date']=$crs->getHold_date();
                $result[$i]['hdvideo_flu']=DEFAULT_PUBLICURL . $crs->getHdvideo_flu();
                $result[$i]['sdvideo_flu']=DEFAULT_PUBLICURL . $crs->getSdvideo_flu();
                $result[$i]['voice_flu']=DEFAULT_PUBLICURL . $crs->getVoice_flu();
                $result[$i]['id']=$crs->getID();
            }
            return json_encode($result);
        }
    }
}
?>