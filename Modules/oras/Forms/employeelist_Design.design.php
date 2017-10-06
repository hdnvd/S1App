<?php
namespace Modules\oras\Forms;
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
*@creationDate 1396-07-12 - 2017-10-04 16:08
*@lastUpdate 1396-07-12 - 2017-10-04 16:08
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class employeelist_Design extends FormDesign {
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
	private $mellicode;
	/**
	 * @return textbox
	 */
	public function getMellicode()
	{
		return $this->mellicode;
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
	private $phonenumber;
	/**
	 * @return textbox
	 */
	public function getPhonenumber()
	{
		return $this->phonenumber;
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
		$Page->setId("oras_employeelist");
		$Page->addElement($this->getPageTitlePart("فهرست " . $this->Data['employee']->getTableTitle() . " ها"));
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->mellicode,$this->getFieldCaption('mellicode'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->name,$this->getFieldCaption('name'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->family,$this->getFieldCaption('family'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->ismale,$this->getFieldCaption('ismale'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->phonenumber,$this->getFieldCaption('phonenumber'),null,'',null));
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
			$url=new AppRooter('oras','employee');
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
		$Page->addElement($this->getPaginationPart($this->Data['pagecount'],"oras","employeelist"));
		$PageLink=new AppRooter('oras','employeelist');
		$form=new SweetFrom($PageLink->getAbsoluteURL(), "GET", $Page);
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
	public function FillItems()
	{

			/******** mellicode ********/
		if (key_exists("employee", $this->Data)){
			$this->mellicode->setValue($this->Data['employee']->getMellicode());
			$this->setFieldCaption('mellicode',$this->Data['employee']->getFieldInfo('mellicode')->getTitle());
		}

			/******** name ********/
		if (key_exists("employee", $this->Data)){
			$this->name->setValue($this->Data['employee']->getName());
			$this->setFieldCaption('name',$this->Data['employee']->getFieldInfo('name')->getTitle());
		}

			/******** family ********/
		if (key_exists("employee", $this->Data)){
			$this->family->setValue($this->Data['employee']->getFamily());
			$this->setFieldCaption('family',$this->Data['employee']->getFieldInfo('family')->getTitle());
		}

			/******** ismale ********/
			$this->ismale->addOption("", "مهم نیست");
			$this->ismale->addOption(1,'مرد');
			$this->ismale->addOption(0,'زن');
		if (key_exists("employee", $this->Data)){
			$this->ismale->setSelectedValue($this->Data['employee']->getIsmale());
			$this->setFieldCaption('ismale',$this->Data['employee']->getFieldInfo('ismale')->getTitle());
		}

			/******** phonenumber ********/
		if (key_exists("employee", $this->Data)){
			$this->phonenumber->setValue($this->Data['employee']->getPhonenumber());
			$this->setFieldCaption('phonenumber',$this->Data['employee']->getFieldInfo('phonenumber')->getTitle());
		}

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** mellicode ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('mellicode'),$this->getFieldCaption('mellicode'));
		if(isset($_GET['mellicode']))
			$this->mellicode->setValue($_GET['mellicode']);

		/******** name ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('name'),$this->getFieldCaption('name'));
		if(isset($_GET['name']))
			$this->name->setValue($_GET['name']);

		/******** family ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('family'),$this->getFieldCaption('family'));
		if(isset($_GET['family']))
			$this->family->setValue($_GET['family']);

		/******** ismale ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('ismale'),$this->getFieldCaption('ismale'));
		if(isset($_GET['ismale']))
			$this->ismale->setSelectedValue($_GET['ismale']);

		/******** phonenumber ********/
		$this->sortby->addOption($this->Data['employee']->getTableFieldID('phonenumber'),$this->getFieldCaption('phonenumber'));
		if(isset($_GET['phonenumber']))
			$this->phonenumber->setValue($_GET['phonenumber']);

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

		/******* mellicode *******/
		$this->mellicode= new textbox("mellicode");
		$this->mellicode->setClass("form-control");

		/******* name *******/
		$this->name= new textbox("name");
		$this->name->setClass("form-control");

		/******* family *******/
		$this->family= new textbox("family");
		$this->family->setClass("form-control");

		/******* ismale *******/
		$this->ismale= new combobox("ismale");
		$this->ismale->setClass("form-control");

		/******* phonenumber *******/
		$this->phonenumber= new textbox("phonenumber");
		$this->phonenumber->setClass("form-control");

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