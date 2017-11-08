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
class wclistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
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
	private $register_time_from;
	/**
	 * @return DatePicker
	 */
	public function getRegister_time_from()
	{
		return $this->register_time_from;
	}
	/** @var DatePicker */
	private $register_time_to;
	/**
	 * @return DatePicker
	 */
	public function getRegister_time_to()
	{
		return $this->register_time_to;
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

		/******* register_time_from *******/
		$this->register_time_from= new DatePicker("register_time_from");
		$this->register_time_from->setClass("form-control");

		/******* register_time_to *******/
		$this->register_time_to= new DatePicker("register_time_to");
		$this->register_time_to->setClass("form-control");

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
		$Page->setId("wc_wclist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['wc']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->latitude,$this->getFieldCaption('latitude'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->longitude,$this->getFieldCaption('longitude'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->common_city_fid,$this->getFieldCaption('common_city_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->isfarangi,$this->getFieldCaption('isfarangi'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->isnormal,$this->getFieldCaption('isnormal'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->register_time_from,$this->getFieldCaption('register_time_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->register_time_to,$this->getFieldCaption('register_time_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->ispublished,$this->getFieldCaption('ispublished'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->opentimes,$this->getFieldCaption('opentimes'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->placetitle,$this->getFieldCaption('placetitle'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->isfree,$this->getFieldCaption('isfree'),null,'',null));
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

			/******** latitude ********/
		if (key_exists("wc", $this->Data)){
			$this->latitude->setValue($this->Data['wc']->getLatitude());
			$this->setFieldCaption('latitude',$this->Data['wc']->getFieldInfo('latitude')->getTitle());
		}

			/******** longitude ********/
		if (key_exists("wc", $this->Data)){
			$this->longitude->setValue($this->Data['wc']->getLongitude());
			$this->setFieldCaption('longitude',$this->Data['wc']->getFieldInfo('longitude')->getTitle());
		}

			/******** common_city_fid ********/
			$this->common_city_fid->addOption("", "مهم نیست");
		foreach ($this->Data['common_city_fid'] as $item)
			$this->common_city_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("wc", $this->Data)){
			$this->common_city_fid->setSelectedValue($this->Data['wc']->getCommon_city_fid());
			$this->setFieldCaption('common_city_fid',$this->Data['wc']->getFieldInfo('common_city_fid')->getTitle());
		}

			/******** isfarangi ********/
			$this->isfarangi->addOption("", "مهم نیست");
			$this->isfarangi->addOption(1,'بله');
			$this->isfarangi->addOption(0,'خیر');
		if (key_exists("wc", $this->Data)){
			$this->isfarangi->setSelectedValue($this->Data['wc']->getIsfarangi());
			$this->setFieldCaption('isfarangi',$this->Data['wc']->getFieldInfo('isfarangi')->getTitle());
		}

			/******** isnormal ********/
			$this->isnormal->addOption("", "مهم نیست");
			$this->isnormal->addOption(1,'بله');
			$this->isnormal->addOption(0,'خیر');
		if (key_exists("wc", $this->Data)){
			$this->isnormal->setSelectedValue($this->Data['wc']->getIsnormal());
			$this->setFieldCaption('isnormal',$this->Data['wc']->getFieldInfo('isnormal')->getTitle());
		}

			/******** register_time_from ********/
		if (key_exists("wc", $this->Data)){
			$this->register_time_from->setTime($this->Data['wc']->getRegister_time_from());
			$this->setFieldCaption('register_time_from',$this->Data['wc']->getFieldInfo('register_time_from')->getTitle());
		}

			/******** register_time_to ********/
		if (key_exists("wc", $this->Data)){
			$this->register_time_to->setTime($this->Data['wc']->getRegister_time_to());
			$this->setFieldCaption('register_time_to',$this->Data['wc']->getFieldInfo('register_time_to')->getTitle());
			$this->setFieldCaption('register_time',$this->Data['wc']->getFieldInfo('register_time')->getTitle());
		}

			/******** ispublished ********/
			$this->ispublished->addOption("", "مهم نیست");
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
		}

			/******** placetitle ********/
		if (key_exists("wc", $this->Data)){
			$this->placetitle->setValue($this->Data['wc']->getPlacetitle());
			$this->setFieldCaption('placetitle',$this->Data['wc']->getFieldInfo('placetitle')->getTitle());
		}

			/******** isfree ********/
			$this->isfree->addOption("", "مهم نیست");
			$this->isfree->addOption(1,'بله');
			$this->isfree->addOption(0,'خیر');
		if (key_exists("wc", $this->Data)){
			$this->isfree->setSelectedValue($this->Data['wc']->getIsfree());
			$this->setFieldCaption('isfree',$this->Data['wc']->getFieldInfo('isfree')->getTitle());
		}

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** latitude ********/
		$this->sortby->addOption($this->Data['wc']->getTableFieldID('latitude'),$this->getFieldCaption('latitude'));
		if(isset($_GET['latitude']))
			$this->latitude->setValue($_GET['latitude']);

		/******** longitude ********/
		$this->sortby->addOption($this->Data['wc']->getTableFieldID('longitude'),$this->getFieldCaption('longitude'));
		if(isset($_GET['longitude']))
			$this->longitude->setValue($_GET['longitude']);

		/******** common_city_fid ********/
		$this->sortby->addOption($this->Data['wc']->getTableFieldID('common_city_fid'),$this->getFieldCaption('common_city_fid'));
		if(isset($_GET['common_city_fid']))
			$this->common_city_fid->setSelectedValue($_GET['common_city_fid']);

		/******** isfarangi ********/
		$this->sortby->addOption($this->Data['wc']->getTableFieldID('isfarangi'),$this->getFieldCaption('isfarangi'));
		if(isset($_GET['isfarangi']))
			$this->isfarangi->setSelectedValue($_GET['isfarangi']);

		/******** isnormal ********/
		$this->sortby->addOption($this->Data['wc']->getTableFieldID('isnormal'),$this->getFieldCaption('isnormal'));
		if(isset($_GET['isnormal']))
			$this->isnormal->setSelectedValue($_GET['isnormal']);

		/******** register_time_from ********/

		/******** register_time_to ********/
		$this->sortby->addOption($this->Data['wc']->getTableFieldID('register_time'),$this->getFieldCaption('register_time'));

		/******** ispublished ********/
		$this->sortby->addOption($this->Data['wc']->getTableFieldID('ispublished'),$this->getFieldCaption('ispublished'));
		if(isset($_GET['ispublished']))
			$this->ispublished->setSelectedValue($_GET['ispublished']);

		/******** opentimes ********/
		$this->sortby->addOption($this->Data['wc']->getTableFieldID('opentimes'),$this->getFieldCaption('opentimes'));
		if(isset($_GET['opentimes']))
			$this->opentimes->setValue($_GET['opentimes']);

		/******** placetitle ********/
		$this->sortby->addOption($this->Data['wc']->getTableFieldID('placetitle'),$this->getFieldCaption('placetitle'));
		if(isset($_GET['placetitle']))
			$this->placetitle->setValue($_GET['placetitle']);

		/******** isfree ********/
		$this->sortby->addOption($this->Data['wc']->getTableFieldID('isfree'),$this->getFieldCaption('isfree'));
		if(isset($_GET['isfree']))
			$this->isfree->setSelectedValue($_GET['isfree']);

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