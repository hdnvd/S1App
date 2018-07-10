<?php
namespace Modules\wc\Forms;
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
*@creationDate 1396-07-16 - 2017-10-08 14:43
*@lastUpdate 1396-07-16 - 2017-10-08 14:43
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managewc_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("wc_managewc");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['wc']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->latitude,$this->getFieldCaption('latitude'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->longitude,$this->getFieldCaption('longitude'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->common_city_fid,$this->getFieldCaption('common_city_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->isfarangi,$this->getFieldCaption('isfarangi'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->isnormal,$this->getFieldCaption('isnormal'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->register_time,$this->getFieldCaption('register_time'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->ispublished,$this->getFieldCaption('ispublished'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->opentimes,$this->getFieldCaption('opentimes'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->placetitle,$this->getFieldCaption('placetitle'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->isfree,$this->getFieldCaption('isfree'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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

			/******** latitude ********/
		if (key_exists("wc", $this->Data)){
			$this->latitude->setValue($this->Data['wc']->getLatitude());
			$this->setFieldCaption('latitude',$this->Data['wc']->getFieldInfo('latitude')->getTitle());
			$this->latitude->setFieldInfo($this->Data['wc']->getFieldInfo('latitude'));
		}

			/******** longitude ********/
		if (key_exists("wc", $this->Data)){
			$this->longitude->setValue($this->Data['wc']->getLongitude());
			$this->setFieldCaption('longitude',$this->Data['wc']->getFieldInfo('longitude')->getTitle());
			$this->longitude->setFieldInfo($this->Data['wc']->getFieldInfo('longitude'));
		}

			/******** common_city_fid ********/
		foreach ($this->Data['common_city_fid'] as $item)
			$this->common_city_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("wc", $this->Data)){
			$this->common_city_fid->setSelectedValue($this->Data['wc']->getCommon_city_fid());
			$this->setFieldCaption('common_city_fid',$this->Data['wc']->getFieldInfo('common_city_fid')->getTitle());
		}

			/******** isfarangi ********/
			$this->isfarangi->addOption(1,'بله');
			$this->isfarangi->addOption(0,'خیر');
		if (key_exists("wc", $this->Data)){
			$this->isfarangi->setSelectedValue($this->Data['wc']->getIsfarangi());
			$this->setFieldCaption('isfarangi',$this->Data['wc']->getFieldInfo('isfarangi')->getTitle());
		}

			/******** isnormal ********/
			$this->isnormal->addOption(1,'بله');
			$this->isnormal->addOption(0,'خیر');
		if (key_exists("wc", $this->Data)){
			$this->isnormal->setSelectedValue($this->Data['wc']->getIsnormal());
			$this->setFieldCaption('isnormal',$this->Data['wc']->getFieldInfo('isnormal')->getTitle());
		}

			/******** register_time ********/
		if (key_exists("wc", $this->Data)){
			$this->register_time->setTime($this->Data['wc']->getRegister_time());
			$this->setFieldCaption('register_time',$this->Data['wc']->getFieldInfo('register_time')->getTitle());
			$this->register_time->setFieldInfo($this->Data['wc']->getFieldInfo('register_time'));
		}

			/******** ispublished ********/
			$this->ispublished->addOption(1,'بله');
			$this->ispublished->addOption(0,'خیر');
		if (key_exists("wc", $this->Data)){
			$this->ispublished->setSelectedValue($this->Data['wc']->getIspublished());
			$this->setFieldCaption('ispublished',$this->Data['wc']->getFieldInfo('ispublished')->getTitle());
		}

			/******** opentimes ********/
		if (key_exists("wc", $this->Data)){
			$this->opentimes->setValue($this->Data['wc']->getOpentimes());
			$this->setFieldCaption('opentimes',$this->Data['wc']->getFieldInfo('opentimes')->getTitle());
			$this->opentimes->setFieldInfo($this->Data['wc']->getFieldInfo('opentimes'));
		}

			/******** placetitle ********/
		if (key_exists("wc", $this->Data)){
			$this->placetitle->setValue($this->Data['wc']->getPlacetitle());
			$this->setFieldCaption('placetitle',$this->Data['wc']->getFieldInfo('placetitle')->getTitle());
			$this->placetitle->setFieldInfo($this->Data['wc']->getFieldInfo('placetitle'));
		}

			/******** isfree ********/
			$this->isfree->addOption(1,'بله');
			$this->isfree->addOption(0,'خیر');
		if (key_exists("wc", $this->Data)){
			$this->isfree->setSelectedValue($this->Data['wc']->getIsfree());
			$this->setFieldCaption('isfree',$this->Data['wc']->getFieldInfo('isfree')->getTitle());
		}

			/******** btnSave ********/
	}
	public function __construct()
	{
		parent::__construct();

		/******* latitude *******/
		$this->latitude= new textbox("latitude");
		$this->latitude->setClass("form-control");

		/******* longitude *******/
		$this->longitude= new textbox("longitude");
		$this->longitude->setClass("form-control");

		/******* common_city_fid *******/
		$this->common_city_fid= new combobox("common_city_fid");
		$this->common_city_fid->setClass("form-control");

		/******* isfarangi *******/
		$this->isfarangi= new combobox("isfarangi");
		$this->isfarangi->setClass("form-control");

		/******* isnormal *******/
		$this->isnormal= new combobox("isnormal");
		$this->isnormal->setClass("form-control");

		/******* register_time *******/
		$this->register_time= new DatePicker("register_time");
		$this->register_time->setClass("form-control");

		/******* ispublished *******/
		$this->ispublished= new combobox("ispublished");
		$this->ispublished->setClass("form-control");

		/******* opentimes *******/
		$this->opentimes= new textbox("opentimes");
		$this->opentimes->setClass("form-control");

		/******* placetitle *******/
		$this->placetitle= new textbox("placetitle");
		$this->placetitle->setClass("form-control");

		/******* isfree *******/
		$this->isfree= new combobox("isfree");
		$this->isfree->setClass("form-control");

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
	private $latitude;
	/**
	 * @return textbox
	 */
	public function getLatitude()
	{
		return $this->latitude;
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
	private $isfarangi;
	/**
	 * @return combobox
	 */
	public function getIsfarangi()
	{
		return $this->isfarangi;
	}
	/** @var combobox */
	private $isnormal;
	/**
	 * @return combobox
	 */
	public function getIsnormal()
	{
		return $this->isnormal;
	}
	/** @var DatePicker */
	private $register_time;
	/**
	 * @return DatePicker
	 */
	public function getRegister_time()
	{
		return $this->register_time;
	}
	/** @var combobox */
	private $ispublished;
	/**
	 * @return combobox
	 */
	public function getIspublished()
	{
		return $this->ispublished;
	}
	/** @var textbox */
	private $opentimes;
	/**
	 * @return textbox
	 */
	public function getOpentimes()
	{
		return $this->opentimes;
	}
	/** @var textbox */
	private $placetitle;
	/**
	 * @return textbox
	 */
	public function getPlacetitle()
	{
		return $this->placetitle;
	}
	/** @var combobox */
	private $isfree;
	/**
	 * @return combobox
	 */
	public function getIsfree()
	{
		return $this->isfree;
	}
	/** @var SweetButton */
	private $btnSave;
}
?>