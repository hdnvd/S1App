<?php
namespace Modules\itsap\Forms;
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
*@creationDate 1397-01-13 - 2018-04-02 02:09
*@lastUpdate 1397-01-13 - 2018-04-02 02:09
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class devicecomponentlistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var combobox */
	private $devicetype_fid;
	/**
	 * @return combobox
	 */
	public function getDevicetype_fid()
	{
		return $this->devicetype_fid;
	}
	/** @var textbox */
	private $title;
	/**
	 * @return textbox
	 */
	public function getTitle()
	{
		return $this->title;
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

		/******* devicetype_fid *******/
		$this->devicetype_fid= new combobox("devicetype_fid");
		$this->devicetype_fid->setClass("form-control");

		/******* title *******/
		$this->title= new textbox("title");
		$this->title->setClass("form-control");

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
		$Page->setId("itsap_devicecomponentlist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['devicecomponent']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->devicetype_fid,$this->getFieldCaption('devicetype_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'',null));
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
			$this->devicetype_fid->addOption("", "مهم نیست");
		foreach ($this->Data['devicetype_fid'] as $item)
			$this->devicetype_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("devicecomponent", $this->Data)){

			/******** devicetype_fid ********/
			$this->devicetype_fid->setSelectedValue($this->Data['devicecomponent']->getDevicetype_fid());
			$this->setFieldCaption('devicetype_fid',$this->Data['devicecomponent']->getFieldInfo('devicetype_fid')->getTitle());

			/******** title ********/
			$this->title->setValue($this->Data['devicecomponent']->getTitle());
			$this->setFieldCaption('title',$this->Data['devicecomponent']->getFieldInfo('title')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** devicetype_fid ********/
		$this->sortby->addOption($this->Data['devicecomponent']->getTableFieldID('devicetype_fid'),$this->getFieldCaption('devicetype_fid'));
		if(isset($_GET['devicetype_fid']))
			$this->devicetype_fid->setSelectedValue($_GET['devicetype_fid']);

		/******** title ********/
		$this->sortby->addOption($this->Data['devicecomponent']->getTableFieldID('title'),$this->getFieldCaption('title'));
		if(isset($_GET['title']))
			$this->title->setValue($_GET['title']);

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