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
class userlistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
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
	/** @var DatePicker */
	private $born_date_from;
	/**
	 * @return DatePicker
	 */
	public function getBorn_date_from()
	{
		return $this->born_date_from;
	}
	/** @var DatePicker */
	private $born_date_to;
	/**
	 * @return DatePicker
	 */
	public function getBorn_date_to()
	{
		return $this->born_date_to;
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
	private $device_id;
	/**
	 * @return textbox
	 */
	public function getDevice_id()
	{
		return $this->device_id;
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

		/******* name *******/
		$this->name= new textbox("name");
		$this->name->setClass("form-control");

		/******* family *******/
		$this->family= new textbox("family");
		$this->family->setClass("form-control");

		/******* born_date_from *******/
		$this->born_date_from= new DatePicker("born_date_from");
		$this->born_date_from->setClass("form-control");

		/******* born_date_to *******/
		$this->born_date_to= new DatePicker("born_date_to");
		$this->born_date_to->setClass("form-control");

		/******* mobile *******/
		$this->mobile= new textbox("mobile");
		$this->mobile->setClass("form-control");

		/******* device_id *******/
		$this->device_id= new textbox("device_id");
		$this->device_id->setClass("form-control");

		/******* email *******/
		$this->email= new textbox("email");
		$this->email->setClass("form-control");

		/******* ismale *******/
		$this->ismale= new combobox("ismale");
		$this->ismale->setClass("form-control");

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
		$Page->setId("ocms_userlist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['user']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->name,$this->getFieldCaption('name'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->family,$this->getFieldCaption('family'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->born_date_from,$this->getFieldCaption('born_date_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->born_date_to,$this->getFieldCaption('born_date_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->mobile,$this->getFieldCaption('mobile'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->device_id,$this->getFieldCaption('device_id'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->email,$this->getFieldCaption('email'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->ismale,$this->getFieldCaption('ismale'),null,'',null));
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
			$this->ismale->addOption("", "مهم نیست");
			$this->ismale->addOption(1,'مرد');
			$this->ismale->addOption(0,'زن');
		if (key_exists("user", $this->Data)){

			/******** name ********/
			$this->name->setValue($this->Data['user']->getName());
			$this->setFieldCaption('name',$this->Data['user']->getFieldInfo('name')->getTitle());

			/******** family ********/
			$this->family->setValue($this->Data['user']->getFamily());
			$this->setFieldCaption('family',$this->Data['user']->getFieldInfo('family')->getTitle());

			/******** born_date_from ********/
			$this->born_date_from->setTime($this->Data['user']->getBorn_date_from());
			$this->setFieldCaption('born_date_from',$this->Data['user']->getFieldInfo('born_date_from')->getTitle());

			/******** born_date_to ********/
			$this->born_date_to->setTime($this->Data['user']->getBorn_date_to());
			$this->setFieldCaption('born_date_to',$this->Data['user']->getFieldInfo('born_date_to')->getTitle());
			$this->setFieldCaption('born_date',$this->Data['user']->getFieldInfo('born_date')->getTitle());

			/******** mobile ********/
			$this->mobile->setValue($this->Data['user']->getMobile());
			$this->setFieldCaption('mobile',$this->Data['user']->getFieldInfo('mobile')->getTitle());

			/******** device_id ********/
			$this->device_id->setValue($this->Data['user']->getDevice_id());
			$this->setFieldCaption('device_id',$this->Data['user']->getFieldInfo('device_id')->getTitle());

			/******** email ********/
			$this->email->setValue($this->Data['user']->getEmail());
			$this->setFieldCaption('email',$this->Data['user']->getFieldInfo('email')->getTitle());

			/******** ismale ********/
			$this->ismale->setSelectedValue($this->Data['user']->getIsmale());
			$this->setFieldCaption('ismale',$this->Data['user']->getFieldInfo('ismale')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** name ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('name'),$this->getFieldCaption('name'));
		if(isset($_GET['name']))
			$this->name->setValue($_GET['name']);

		/******** family ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('family'),$this->getFieldCaption('family'));
		if(isset($_GET['family']))
			$this->family->setValue($_GET['family']);

		/******** born_date_from ********/

		/******** born_date_to ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('born_date'),$this->getFieldCaption('born_date'));

		/******** mobile ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('mobile'),$this->getFieldCaption('mobile'));
		if(isset($_GET['mobile']))
			$this->mobile->setValue($_GET['mobile']);

		/******** device_id ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('device_id'),$this->getFieldCaption('device_id'));
		if(isset($_GET['device_id']))
			$this->device_id->setValue($_GET['device_id']);

		/******** email ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('email'),$this->getFieldCaption('email'));
		if(isset($_GET['email']))
			$this->email->setValue($_GET['email']);

		/******** ismale ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('ismale'),$this->getFieldCaption('ismale'));
		if(isset($_GET['ismale']))
			$this->ismale->setSelectedValue($_GET['ismale']);

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