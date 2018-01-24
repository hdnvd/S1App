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
*@creationDate 1396-10-27 - 2018-01-17 00:25
*@lastUpdate 1396-10-27 - 2018-01-17 00:25
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class shiftlist_Design extends FormDesign {
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
	private $shifttype;
	/**
	 * @return textbox
	 */
	public function getShifttype()
	{
		return $this->shifttype;
	}
	/** @var DatePicker */
	private $due_date_from;
	/**
	 * @return DatePicker
	 */
	public function getDue_date_from()
	{
		return $this->due_date_from;
	}
	/** @var DatePicker */
	private $due_date_to;
	/**
	 * @return DatePicker
	 */
	public function getDue_date_to()
	{
		return $this->due_date_to;
	}
	/** @var DatePicker */
	private $register_date_from;
	/**
	 * @return DatePicker
	 */
	public function getRegister_date_from()
	{
		return $this->register_date_from;
	}
	/** @var DatePicker */
	private $register_date_to;
	/**
	 * @return DatePicker
	 */
	public function getRegister_date_to()
	{
		return $this->register_date_to;
	}
	/** @var combobox */
	private $person_fid;
	/**
	 * @return combobox
	 */
	public function getPerson_fid()
	{
		return $this->person_fid;
	}
	/** @var combobox */
	private $inputfile_fid;
	/**
	 * @return combobox
	 */
	public function getInputfile_fid()
	{
		return $this->inputfile_fid;
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
		$Page->setId("shift_shiftlist");
		$Page->addElement($this->getPageTitlePart("فهرست " . $this->Data['shift']->getTableTitle() . " ها"));
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->shifttype,$this->getFieldCaption('shifttype'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->due_date_from,$this->getFieldCaption('due_date_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->due_date_to,$this->getFieldCaption('due_date_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->register_date_from,$this->getFieldCaption('register_date_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->register_date_to,$this->getFieldCaption('register_date_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->person_fid,$this->getFieldCaption('person_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->inputfile_fid,$this->getFieldCaption('inputfile_fid'),null,'',null));
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
			$url=new AppRooter('shift','shift');
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
		$Page->addElement($this->getPaginationPart($this->Data['pagecount'],"shift","shiftlist"));
		$PageLink=new AppRooter('shift','shiftlist');
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
			$this->person_fid->addOption("", "مهم نیست");
		foreach ($this->Data['person_fid'] as $item)
			$this->person_fid->addOption($item->getID(), $item->getTitleField());
			$this->inputfile_fid->addOption("", "مهم نیست");
		foreach ($this->Data['inputfile_fid'] as $item)
			$this->inputfile_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("shift", $this->Data)){

			/******** shifttype ********/
			$this->shifttype->setValue($this->Data['shift']->getShifttype());
			$this->setFieldCaption('shifttype',$this->Data['shift']->getFieldInfo('shifttype')->getTitle());

			/******** due_date_from ********/
			$this->due_date_from->setTime($this->Data['shift']->getDue_date_from());
			$this->setFieldCaption('due_date_from',$this->Data['shift']->getFieldInfo('due_date_from')->getTitle());

			/******** due_date_to ********/
			$this->due_date_to->setTime($this->Data['shift']->getDue_date_to());
			$this->setFieldCaption('due_date_to',$this->Data['shift']->getFieldInfo('due_date_to')->getTitle());
			$this->setFieldCaption('due_date',$this->Data['shift']->getFieldInfo('due_date')->getTitle());

			/******** register_date_from ********/
			$this->register_date_from->setTime($this->Data['shift']->getRegister_date_from());
			$this->setFieldCaption('register_date_from',$this->Data['shift']->getFieldInfo('register_date_from')->getTitle());

			/******** register_date_to ********/
			$this->register_date_to->setTime($this->Data['shift']->getRegister_date_to());
			$this->setFieldCaption('register_date_to',$this->Data['shift']->getFieldInfo('register_date_to')->getTitle());
			$this->setFieldCaption('register_date',$this->Data['shift']->getFieldInfo('register_date')->getTitle());

			/******** person_fid ********/
			$this->person_fid->setSelectedValue($this->Data['shift']->getPerson_fid());
			$this->setFieldCaption('person_fid',$this->Data['shift']->getFieldInfo('person_fid')->getTitle());

			/******** inputfile_fid ********/
			$this->inputfile_fid->setSelectedValue($this->Data['shift']->getInputfile_fid());
			$this->setFieldCaption('inputfile_fid',$this->Data['shift']->getFieldInfo('inputfile_fid')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** shifttype ********/
		$this->sortby->addOption($this->Data['shift']->getTableFieldID('shifttype'),$this->getFieldCaption('shifttype'));
		if(isset($_GET['shifttype']))
			$this->shifttype->setValue($_GET['shifttype']);

		/******** due_date_from ********/

		/******** due_date_to ********/
		$this->sortby->addOption($this->Data['shift']->getTableFieldID('due_date'),$this->getFieldCaption('due_date'));

		/******** register_date_from ********/

		/******** register_date_to ********/
		$this->sortby->addOption($this->Data['shift']->getTableFieldID('register_date'),$this->getFieldCaption('register_date'));

		/******** person_fid ********/
		$this->sortby->addOption($this->Data['shift']->getTableFieldID('person_fid'),$this->getFieldCaption('person_fid'));
		if(isset($_GET['person_fid']))
			$this->person_fid->setSelectedValue($_GET['person_fid']);

		/******** inputfile_fid ********/
		$this->sortby->addOption($this->Data['shift']->getTableFieldID('inputfile_fid'),$this->getFieldCaption('inputfile_fid'));
		if(isset($_GET['inputfile_fid']))
			$this->inputfile_fid->setSelectedValue($_GET['inputfile_fid']);

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

		/******* shifttype *******/
		$this->shifttype= new textbox("shifttype");
		$this->shifttype->setClass("form-control");

		/******* due_date_from *******/
		$this->due_date_from= new DatePicker("due_date_from");
		$this->due_date_from->setClass("form-control");

		/******* due_date_to *******/
		$this->due_date_to= new DatePicker("due_date_to");
		$this->due_date_to->setClass("form-control");

		/******* register_date_from *******/
		$this->register_date_from= new DatePicker("register_date_from");
		$this->register_date_from->setClass("form-control");

		/******* register_date_to *******/
		$this->register_date_to= new DatePicker("register_date_to");
		$this->register_date_to->setClass("form-control");

		/******* person_fid *******/
		$this->person_fid= new combobox("person_fid");
		$this->person_fid->setClass("form-control");

		/******* inputfile_fid *******/
		$this->inputfile_fid= new combobox("inputfile_fid");
		$this->inputfile_fid->setClass("form-control");

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