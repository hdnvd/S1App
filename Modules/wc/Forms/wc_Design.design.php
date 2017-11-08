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
class wc_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var lable */
	private $latitude;
	/** @var lable */
	private $longitude;
	/** @var lable */
	private $common_city_fid;
	/** @var lable */
	private $isfarangi;
	/** @var lable */
	private $isnormal;
	/** @var lable */
	private $register_time;
	/** @var lable */
	private $ispublished;
	/** @var lable */
	private $opentimes;
	/** @var lable */
	private $placetitle;
	/** @var lable */
	private $isfree;
	public function __construct()
	{

		/******* latitude *******/
		$this->latitude= new lable("latitude");

		/******* longitude *******/
		$this->longitude= new lable("longitude");

		/******* common_city_fid *******/
		$this->common_city_fid= new lable("common_city_fid");

		/******* isfarangi *******/
		$this->isfarangi= new lable("isfarangi");

		/******* isnormal *******/
		$this->isnormal= new lable("isnormal");

		/******* register_time *******/
		$this->register_time= new lable("register_time");

		/******* ispublished *******/
		$this->ispublished= new lable("ispublished");

		/******* opentimes *******/
		$this->opentimes= new lable("opentimes");

		/******* placetitle *******/
		$this->placetitle= new lable("placetitle");

		/******* isfree *******/
		$this->isfree= new lable("isfree");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("wc_wc");
		$Page->addElement($this->getPageTitlePart("اطلاعات " . $this->Data['wc']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		if (key_exists("wc", $this->Data)){
			$this->setFieldCaption('latitude',$this->Data['wc']->getFieldInfo('latitude')->getTitle());
			$this->latitude->setText($this->Data['wc']->getLatitude());
		}
		if (key_exists("wc", $this->Data)){
			$this->setFieldCaption('longitude',$this->Data['wc']->getFieldInfo('longitude')->getTitle());
			$this->longitude->setText($this->Data['wc']->getLongitude());
		}
		if (key_exists("common_city_fid", $this->Data)){
			$this->setFieldCaption('common_city_fid',$this->Data['wc']->getFieldInfo('common_city_fid')->getTitle());
			$this->common_city_fid->setText($this->Data['common_city_fid']->getID());
		}
		if (key_exists("wc", $this->Data)){
			$this->setFieldCaption('isfarangi',$this->Data['wc']->getFieldInfo('isfarangi')->getTitle());
			$isfarangiTitle='No';
			if($this->Data['wc']->getIsfarangi()==1)
				$isfarangiTitle='Yes';
			$this->isfarangi->setText($isfarangiTitle);
		}
		if (key_exists("wc", $this->Data)){
			$this->setFieldCaption('isnormal',$this->Data['wc']->getFieldInfo('isnormal')->getTitle());
			$isnormalTitle='No';
			if($this->Data['wc']->getIsnormal()==1)
				$isnormalTitle='Yes';
			$this->isnormal->setText($isnormalTitle);
		}
		if (key_exists("wc", $this->Data)){
			$this->setFieldCaption('register_time',$this->Data['wc']->getFieldInfo('register_time')->getTitle());
			$register_time_SD=new SweetDate(true, true, 'Asia/Tehran');
			$register_time_Text=$register_time_SD->date("l d F Y",$this->Data['wc']->getRegister_time());
			$this->register_time->setText($register_time_Text);
		}
		if (key_exists("wc", $this->Data)){
			$this->setFieldCaption('ispublished',$this->Data['wc']->getFieldInfo('ispublished')->getTitle());
			$ispublishedTitle='No';
			if($this->Data['wc']->getIspublished()==1)
				$ispublishedTitle='Yes';
			$this->ispublished->setText($ispublishedTitle);
		}
		if (key_exists("wc", $this->Data)){
			$this->setFieldCaption('opentimes',$this->Data['wc']->getFieldInfo('opentimes')->getTitle());
			$this->opentimes->setText($this->Data['wc']->getOpentimes());
		}
		if (key_exists("wc", $this->Data)){
			$this->setFieldCaption('placetitle',$this->Data['wc']->getFieldInfo('placetitle')->getTitle());
			$this->placetitle->setText($this->Data['wc']->getPlacetitle());
		}
		if (key_exists("wc", $this->Data)){
			$this->setFieldCaption('isfree',$this->Data['wc']->getFieldInfo('isfree')->getTitle());
			$isfreeTitle='No';
			if($this->Data['wc']->getIsfree()==1)
				$isfreeTitle='Yes';
			$this->isfree->setText($isfreeTitle);
		}
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getInfoRowCode($this->latitude,$this->getFieldCaption('latitude')));
		$LTable1->addElement($this->getInfoRowCode($this->longitude,$this->getFieldCaption('longitude')));
		$LTable1->addElement($this->getInfoRowCode($this->common_city_fid,$this->getFieldCaption('common_city_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->isfarangi,$this->getFieldCaption('isfarangi')));
		$LTable1->addElement($this->getInfoRowCode($this->isnormal,$this->getFieldCaption('isnormal')));
		$LTable1->addElement($this->getInfoRowCode($this->register_time,$this->getFieldCaption('register_time')));
		$LTable1->addElement($this->getInfoRowCode($this->ispublished,$this->getFieldCaption('ispublished')));
		$LTable1->addElement($this->getInfoRowCode($this->opentimes,$this->getFieldCaption('opentimes')));
		$LTable1->addElement($this->getInfoRowCode($this->placetitle,$this->getFieldCaption('placetitle')));
		$LTable1->addElement($this->getInfoRowCode($this->isfree,$this->getFieldCaption('isfree')));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>