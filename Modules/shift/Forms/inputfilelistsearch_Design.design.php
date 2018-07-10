<?php
namespace Modules\shift\Forms;
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
*@creationDate 1396-11-24 - 2018-02-13 10:17
*@lastUpdate 1396-11-24 - 2018-02-13 10:17
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class inputfilelistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var DatePicker */
	private $upload_time_from;
	/**
	 * @return DatePicker
	 */
	public function getUpload_time_from()
	{
		return $this->upload_time_from;
	}
	/** @var DatePicker */
	private $upload_time_to;
	/**
	 * @return DatePicker
	 */
	public function getUpload_time_to()
	{
		return $this->upload_time_to;
	}
	/** @var textbox */
	private $systemuser;
	/**
	 * @return textbox
	 */
	public function getSystemuser()
	{
		return $this->systemuser;
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

		/******* upload_time_from *******/
		$this->upload_time_from= new DatePicker("upload_time_from");
		$this->upload_time_from->setClass("form-control");

		/******* upload_time_to *******/
		$this->upload_time_to= new DatePicker("upload_time_to");
		$this->upload_time_to->setClass("form-control");

		/******* systemuser *******/
		$this->systemuser= new textbox("systemuser");
		$this->systemuser->setClass("form-control");

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
		$Page->setId("shift_inputfilelist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['inputfile']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->upload_time_from,$this->getFieldCaption('upload_time_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->upload_time_to,$this->getFieldCaption('upload_time_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->systemuser,$this->getFieldCaption('systemuser'),null,'',null));
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
		if (key_exists("inputfile", $this->Data)){

			/******** upload_time_from ********/
			$this->upload_time_from->setTime($this->Data['inputfile']->getUpload_time_from());
			$this->setFieldCaption('upload_time_from',$this->Data['inputfile']->getFieldInfo('upload_time_from')->getTitle());

			/******** upload_time_to ********/
			$this->upload_time_to->setTime($this->Data['inputfile']->getUpload_time_to());
			$this->setFieldCaption('upload_time_to',$this->Data['inputfile']->getFieldInfo('upload_time_to')->getTitle());
			$this->setFieldCaption('upload_time',$this->Data['inputfile']->getFieldInfo('upload_time')->getTitle());

			/******** systemuser ********/
			$this->systemuser->setValue($this->Data['inputfile']->getSystemuser());
			$this->setFieldCaption('systemuser',$this->Data['inputfile']->getFieldInfo('systemuser')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** upload_time_from ********/

		/******** upload_time_to ********/
		$this->sortby->addOption($this->Data['inputfile']->getTableFieldID('upload_time'),$this->getFieldCaption('upload_time'));

		/******** systemuser ********/
		$this->sortby->addOption($this->Data['inputfile']->getTableFieldID('systemuser'),$this->getFieldCaption('systemuser'));
		if(isset($_GET['systemuser']))
			$this->systemuser->setValue($_GET['systemuser']);

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