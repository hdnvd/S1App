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
*@creationDate 1396-10-28 - 2018-01-18 17:32
*@lastUpdate 1396-10-28 - 2018-01-18 17:32
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managepersonel_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("shift_managepersonel");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['personel']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->childcount,$this->getFieldCaption('childcount'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->address,$this->getFieldCaption('address'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->fathername,$this->getFieldCaption('fathername'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->priority,$this->getFieldCaption('priority'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->employment_date,$this->getFieldCaption('employment_date'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->personelcode,$this->getFieldCaption('personelcode'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->sanavat,$this->getFieldCaption('sanavat'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->shhesab,$this->getFieldCaption('shhesab'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->bakhsh_fid,$this->getFieldCaption('bakhsh_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->madrak_fid,$this->getFieldCaption('madrak_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->name,$this->getFieldCaption('name'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->family,$this->getFieldCaption('family'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->tel,$this->getFieldCaption('tel'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->born_date,$this->getFieldCaption('born_date'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->is_male,$this->getFieldCaption('is_male'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->extrasanavat,$this->getFieldCaption('extrasanavat'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->monthsanavat,$this->getFieldCaption('monthsanavat'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->eshteghal_fid,$this->getFieldCaption('eshteghal_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->zarib,$this->getFieldCaption('zarib'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->role_fid,$this->getFieldCaption('role_fid'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->shsh,$this->getFieldCaption('shsh'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->computercode,$this->getFieldCaption('computercode'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->mellicode,$this->getFieldCaption('mellicode'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->is_married,$this->getFieldCaption('is_married'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
		foreach ($this->Data['bakhsh_fid'] as $item)
			$this->bakhsh_fid->addOption($item->getID(), $item->getTitleField());
		foreach ($this->Data['madrak_fid'] as $item)
			$this->madrak_fid->addOption($item->getID(), $item->getTitleField());
			$this->is_male->addOption(1,'بله');
			$this->is_male->addOption(0,'خیر');
		foreach ($this->Data['eshteghal_fid'] as $item)
			$this->eshteghal_fid->addOption($item->getID(), $item->getTitleField());
		foreach ($this->Data['role_fid'] as $item)
			$this->role_fid->addOption($item->getID(), $item->getTitleField());
			$this->is_married->addOption(1,'بله');
			$this->is_married->addOption(0,'خیر');
		if (key_exists("personel", $this->Data)){

			/******** childcount ********/
			$this->childcount->setValue($this->Data['personel']->getChildcount());
			$this->setFieldCaption('childcount',$this->Data['personel']->getFieldInfo('childcount')->getTitle());
			$this->childcount->setFieldInfo($this->Data['personel']->getFieldInfo('childcount'));

			/******** address ********/
			$this->address->setValue($this->Data['personel']->getAddress());
			$this->setFieldCaption('address',$this->Data['personel']->getFieldInfo('address')->getTitle());
			$this->address->setFieldInfo($this->Data['personel']->getFieldInfo('address'));

			/******** fathername ********/
			$this->fathername->setValue($this->Data['personel']->getFathername());
			$this->setFieldCaption('fathername',$this->Data['personel']->getFieldInfo('fathername')->getTitle());
			$this->fathername->setFieldInfo($this->Data['personel']->getFieldInfo('fathername'));

			/******** priority ********/
			$this->priority->setValue($this->Data['personel']->getPriority());
			$this->setFieldCaption('priority',$this->Data['personel']->getFieldInfo('priority')->getTitle());
			$this->priority->setFieldInfo($this->Data['personel']->getFieldInfo('priority'));

			/******** employment_date ********/
			$this->employment_date->setTime($this->Data['personel']->getEmployment_date());
			$this->setFieldCaption('employment_date',$this->Data['personel']->getFieldInfo('employment_date')->getTitle());
			$this->employment_date->setFieldInfo($this->Data['personel']->getFieldInfo('employment_date'));

			/******** personelcode ********/
			$this->personelcode->setValue($this->Data['personel']->getPersonelcode());
			$this->setFieldCaption('personelcode',$this->Data['personel']->getFieldInfo('personelcode')->getTitle());
			$this->personelcode->setFieldInfo($this->Data['personel']->getFieldInfo('personelcode'));

			/******** sanavat ********/
			$this->sanavat->setValue($this->Data['personel']->getSanavat());
			$this->setFieldCaption('sanavat',$this->Data['personel']->getFieldInfo('sanavat')->getTitle());
			$this->sanavat->setFieldInfo($this->Data['personel']->getFieldInfo('sanavat'));

			/******** shhesab ********/
			$this->shhesab->setValue($this->Data['personel']->getShhesab());
			$this->setFieldCaption('shhesab',$this->Data['personel']->getFieldInfo('shhesab')->getTitle());
			$this->shhesab->setFieldInfo($this->Data['personel']->getFieldInfo('shhesab'));

			/******** bakhsh_fid ********/
			$this->bakhsh_fid->setSelectedValue($this->Data['personel']->getBakhsh_fid());
			$this->setFieldCaption('bakhsh_fid',$this->Data['personel']->getFieldInfo('bakhsh_fid')->getTitle());

			/******** madrak_fid ********/
			$this->madrak_fid->setSelectedValue($this->Data['personel']->getMadrak_fid());
			$this->setFieldCaption('madrak_fid',$this->Data['personel']->getFieldInfo('madrak_fid')->getTitle());

			/******** name ********/
			$this->name->setValue($this->Data['personel']->getName());
			$this->setFieldCaption('name',$this->Data['personel']->getFieldInfo('name')->getTitle());
			$this->name->setFieldInfo($this->Data['personel']->getFieldInfo('name'));

			/******** family ********/
			$this->family->setValue($this->Data['personel']->getFamily());
			$this->setFieldCaption('family',$this->Data['personel']->getFieldInfo('family')->getTitle());
			$this->family->setFieldInfo($this->Data['personel']->getFieldInfo('family'));

			/******** tel ********/
			$this->tel->setValue($this->Data['personel']->getTel());
			$this->setFieldCaption('tel',$this->Data['personel']->getFieldInfo('tel')->getTitle());
			$this->tel->setFieldInfo($this->Data['personel']->getFieldInfo('tel'));

			/******** born_date ********/
			$this->born_date->setTime($this->Data['personel']->getBorn_date());
			$this->setFieldCaption('born_date',$this->Data['personel']->getFieldInfo('born_date')->getTitle());
			$this->born_date->setFieldInfo($this->Data['personel']->getFieldInfo('born_date'));

			/******** is_male ********/
			$this->is_male->setSelectedValue($this->Data['personel']->getIs_male());
			$this->setFieldCaption('is_male',$this->Data['personel']->getFieldInfo('is_male')->getTitle());

			/******** extrasanavat ********/
			$this->extrasanavat->setValue($this->Data['personel']->getExtrasanavat());
			$this->setFieldCaption('extrasanavat',$this->Data['personel']->getFieldInfo('extrasanavat')->getTitle());
			$this->extrasanavat->setFieldInfo($this->Data['personel']->getFieldInfo('extrasanavat'));

			/******** monthsanavat ********/
			$this->monthsanavat->setValue($this->Data['personel']->getMonthsanavat());
			$this->setFieldCaption('monthsanavat',$this->Data['personel']->getFieldInfo('monthsanavat')->getTitle());
			$this->monthsanavat->setFieldInfo($this->Data['personel']->getFieldInfo('monthsanavat'));

			/******** eshteghal_fid ********/
			$this->eshteghal_fid->setSelectedValue($this->Data['personel']->getEshteghal_fid());
			$this->setFieldCaption('eshteghal_fid',$this->Data['personel']->getFieldInfo('eshteghal_fid')->getTitle());

			/******** zarib ********/
			$this->zarib->setValue($this->Data['personel']->getZarib());
			$this->setFieldCaption('zarib',$this->Data['personel']->getFieldInfo('zarib')->getTitle());
			$this->zarib->setFieldInfo($this->Data['personel']->getFieldInfo('zarib'));

			/******** role_fid ********/
			$this->role_fid->setSelectedValue($this->Data['personel']->getRole_fid());
			$this->setFieldCaption('role_fid',$this->Data['personel']->getFieldInfo('role_fid')->getTitle());

			/******** shsh ********/
			$this->shsh->setValue($this->Data['personel']->getShsh());
			$this->setFieldCaption('shsh',$this->Data['personel']->getFieldInfo('shsh')->getTitle());
			$this->shsh->setFieldInfo($this->Data['personel']->getFieldInfo('shsh'));

			/******** computercode ********/
			$this->computercode->setValue($this->Data['personel']->getComputercode());
			$this->setFieldCaption('computercode',$this->Data['personel']->getFieldInfo('computercode')->getTitle());
			$this->computercode->setFieldInfo($this->Data['personel']->getFieldInfo('computercode'));

			/******** mellicode ********/
			$this->mellicode->setValue($this->Data['personel']->getMellicode());
			$this->setFieldCaption('mellicode',$this->Data['personel']->getFieldInfo('mellicode')->getTitle());
			$this->mellicode->setFieldInfo($this->Data['personel']->getFieldInfo('mellicode'));

			/******** is_married ********/
			$this->is_married->setSelectedValue($this->Data['personel']->getIs_married());
			$this->setFieldCaption('is_married',$this->Data['personel']->getFieldInfo('is_married')->getTitle());

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* childcount *******/
		$this->childcount= new textbox("childcount");
		$this->childcount->setClass("form-control");

		/******* address *******/
		$this->address= new textbox("address");
		$this->address->setClass("form-control");

		/******* fathername *******/
		$this->fathername= new textbox("fathername");
		$this->fathername->setClass("form-control");

		/******* priority *******/
		$this->priority= new textbox("priority");
		$this->priority->setClass("form-control");

		/******* employment_date *******/
		$this->employment_date= new DatePicker("employment_date");
		$this->employment_date->setClass("form-control");

		/******* personelcode *******/
		$this->personelcode= new textbox("personelcode");
		$this->personelcode->setClass("form-control");

		/******* sanavat *******/
		$this->sanavat= new textbox("sanavat");
		$this->sanavat->setClass("form-control");

		/******* shhesab *******/
		$this->shhesab= new textbox("shhesab");
		$this->shhesab->setClass("form-control");

		/******* bakhsh_fid *******/
		$this->bakhsh_fid= new combobox("bakhsh_fid");
		$this->bakhsh_fid->setClass("form-control");

		/******* madrak_fid *******/
		$this->madrak_fid= new combobox("madrak_fid");
		$this->madrak_fid->setClass("form-control");

		/******* name *******/
		$this->name= new textbox("name");
		$this->name->setClass("form-control");

		/******* family *******/
		$this->family= new textbox("family");
		$this->family->setClass("form-control");

		/******* tel *******/
		$this->tel= new textbox("tel");
		$this->tel->setClass("form-control");

		/******* born_date *******/
		$this->born_date= new DatePicker("born_date");
		$this->born_date->setClass("form-control");

		/******* is_male *******/
		$this->is_male= new combobox("is_male");
		$this->is_male->setClass("form-control");

		/******* extrasanavat *******/
		$this->extrasanavat= new textbox("extrasanavat");
		$this->extrasanavat->setClass("form-control");

		/******* monthsanavat *******/
		$this->monthsanavat= new textbox("monthsanavat");
		$this->monthsanavat->setClass("form-control");

		/******* eshteghal_fid *******/
		$this->eshteghal_fid= new combobox("eshteghal_fid");
		$this->eshteghal_fid->setClass("form-control");

		/******* zarib *******/
		$this->zarib= new textbox("zarib");
		$this->zarib->setClass("form-control");

		/******* role_fid *******/
		$this->role_fid= new combobox("role_fid");
		$this->role_fid->setClass("form-control");

		/******* shsh *******/
		$this->shsh= new textbox("shsh");
		$this->shsh->setClass("form-control");

		/******* computercode *******/
		$this->computercode= new textbox("computercode");
		$this->computercode->setClass("form-control");

		/******* mellicode *******/
		$this->mellicode= new textbox("mellicode");
		$this->mellicode->setClass("form-control");

		/******* is_married *******/
		$this->is_married= new combobox("is_married");
		$this->is_married->setClass("form-control");

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
	private $childcount;
	/**
	 * @return textbox
	 */
	public function getChildcount()
	{
		return $this->childcount;
	}
	/** @var textbox */
	private $address;
	/**
	 * @return textbox
	 */
	public function getAddress()
	{
		return $this->address;
	}
	/** @var textbox */
	private $fathername;
	/**
	 * @return textbox
	 */
	public function getFathername()
	{
		return $this->fathername;
	}
	/** @var textbox */
	private $priority;
	/**
	 * @return textbox
	 */
	public function getPriority()
	{
		return $this->priority;
	}
	/** @var DatePicker */
	private $employment_date;
	/**
	 * @return DatePicker
	 */
	public function getEmployment_date()
	{
		return $this->employment_date;
	}
	/** @var textbox */
	private $personelcode;
	/**
	 * @return textbox
	 */
	public function getPersonelcode()
	{
		return $this->personelcode;
	}
	/** @var textbox */
	private $sanavat;
	/**
	 * @return textbox
	 */
	public function getSanavat()
	{
		return $this->sanavat;
	}
	/** @var textbox */
	private $shhesab;
	/**
	 * @return textbox
	 */
	public function getShhesab()
	{
		return $this->shhesab;
	}
	/** @var combobox */
	private $bakhsh_fid;
	/**
	 * @return combobox
	 */
	public function getBakhsh_fid()
	{
		return $this->bakhsh_fid;
	}
	/** @var combobox */
	private $madrak_fid;
	/**
	 * @return combobox
	 */
	public function getMadrak_fid()
	{
		return $this->madrak_fid;
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
	/** @var textbox */
	private $tel;
	/**
	 * @return textbox
	 */
	public function getTel()
	{
		return $this->tel;
	}
	/** @var DatePicker */
	private $born_date;
	/**
	 * @return DatePicker
	 */
	public function getBorn_date()
	{
		return $this->born_date;
	}
	/** @var combobox */
	private $is_male;
	/**
	 * @return combobox
	 */
	public function getIs_male()
	{
		return $this->is_male;
	}
	/** @var textbox */
	private $extrasanavat;
	/**
	 * @return textbox
	 */
	public function getExtrasanavat()
	{
		return $this->extrasanavat;
	}
	/** @var textbox */
	private $monthsanavat;
	/**
	 * @return textbox
	 */
	public function getMonthsanavat()
	{
		return $this->monthsanavat;
	}
	/** @var combobox */
	private $eshteghal_fid;
	/**
	 * @return combobox
	 */
	public function getEshteghal_fid()
	{
		return $this->eshteghal_fid;
	}
	/** @var textbox */
	private $zarib;
	/**
	 * @return textbox
	 */
	public function getZarib()
	{
		return $this->zarib;
	}
	/** @var combobox */
	private $role_fid;
	/**
	 * @return combobox
	 */
	public function getRole_fid()
	{
		return $this->role_fid;
	}
	/** @var textbox */
	private $shsh;
	/**
	 * @return textbox
	 */
	public function getShsh()
	{
		return $this->shsh;
	}
	/** @var textbox */
	private $computercode;
	/**
	 * @return textbox
	 */
	public function getComputercode()
	{
		return $this->computercode;
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
	/** @var combobox */
	private $is_married;
	/**
	 * @return combobox
	 */
	public function getIs_married()
	{
		return $this->is_married;
	}
	/** @var SweetButton */
	private $btnSave;
    public function getJSON()
    {
       parent::getJSON();
       $Result=['message'=>$this->getMessage(),'messagetype'=>$this->getMessageType()];
       return json_encode($Result);
    }
}
?>