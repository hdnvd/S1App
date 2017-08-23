<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\CheckBox;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\ComboBox;
use core\CoreClasses\html\FileUploadBox;
/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-21 - 2017-02-09 01:49
*@lastUpdate 1395-11-21 - 2017-02-09 01:49
*@SweetFrameworkHelperVersion 2.000
*@SweetFrameworkVersion 1.017
*/
class manageprofile_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var textbox */
	private $txtName;
	/**
	 * @return textbox
	 */
	public function getTxtName()
	{
		return $this->txtName;
	}
	/** @var textbox */
	private $txtFamily;
	/**
	 * @return textbox
	 */
	public function getTxtFamily()
	{
		return $this->txtFamily;
	}
	/** @var textbox */
	private $txtEmail;
	/**
	 * @return textbox
	 */
	public function getTxtEmail()
	{
		return $this->txtEmail;
	}
	/** @var textbox */
	private $txtMobile;
	/**
	 * @return textbox
	 */
	public function getTxtMobile()
	{
		return $this->txtMobile;
	}
	/** @var textbox */
	private $txtTel;
	/**
	 * @return textbox
	 */
	public function getTxtTel()
	{
		return $this->txtTel;
	}
	/** @var combobox */
	private $cmbIsmale;
	/**
	 * @return combobox
	 */
	public function getCmbIsmale()
	{
		return $this->cmbIsmale;
	}
	/** @var combobox */
	private $cmbCity;
	/**
	 * @return combobox
	 */
	public function getCmbCity()
	{
		return $this->cmbCity;
	}
	/** @var textbox */
	private $txtAddress;
	/**
	 * @return textbox
	 */
	public function getTxtAddress()
	{
		return $this->txtAddress;
	}
	/** @var textbox */
	private $txtPostalCode;
	/**
	 * @return textbox
	 */
	public function getTxtPostalCode()
	{
		return $this->txtPostalCode;
	}
	/** @var CheckBox */
	private $chkShowcontactInfo;
	/**
	 * @return CheckBox
	 */
	public function getChkShowcontactInfo()
	{
		return $this->chkShowcontactInfo;
	}
	/** @var lable */
	private $lblCardInfo;
	/** @var textbox */
	private $txtCardNumber;
	/**
	 * @return textbox
	 */
	public function getTxtCardNumber()
	{
		return $this->txtCardNumber;
	}
	/** @var textbox */
	private $txtCardOwner;
	/**
	 * @return textbox
	 */
	public function getTxtCardOwner()
	{
		return $this->txtCardOwner;
	}
	/** @var textbox */
	private $cmbBank;
	/**
	 * @return textbox
	 */
	public function getCmbBank()
	{
		return $this->cmbBank;
	}
	/** @var lable */
	private $lblCarInfo;
	/** @var combobox */
	private $cmbCarMaker;
	/**
	 * @return combobox
	 */
	public function getCmbCarMaker()
	{
		return $this->cmbCarMaker;
	}
	/** @var combobox */
	private $cmbCarModel;
	/**
	 * @return combobox
	 */
	public function getCmbCarModel()
	{
		return $this->cmbCarModel;
	}
	/** @var SweetButton */
	private $btnSave;
	public function __construct()
	{
		$this->txtName= new textbox("txtName");
		$this->txtFamily= new textbox("txtFamily");
		$this->txtEmail= new textbox("txtEmail");
		$this->txtMobile= new textbox("txtMobile");
		$this->txtTel= new textbox("txtTel");
		$this->cmbIsmale= new combobox("cmbIsmale");
		$this->cmbCity= new combobox("cmbCity");
		$this->txtAddress= new textbox("txtAddress");
		$this->txtPostalCode= new textbox("txtPostalCode");
		$this->chkShowcontactInfo= new CheckBox("chkShowcontactInfo");
		$this->lblCardInfo= new lable("اطلاعات حساب بانکی");
		$this->txtCardNumber= new textbox("txtCardNumber");
		$this->txtCardOwner= new textbox("txtCardOwner");
		$this->cmbBank= new textbox("cmbBank");
		$this->lblCarInfo= new lable("اطلاعات ماشین");
		$this->cmbCarMaker= new combobox("cmbCarMaker");
		$this->cmbCarModel= new combobox("cmbCarModel");
		$this->btnSave= new SweetButton(true,"ذخیره");
		$this->btnSave->setAction("btnSave");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setId("buysell_manageprofile");
		$Page->addElement(new Lable("ویرایش پروفایل"));
		$Page->setClass("sweet_formtitle");
		$LTable1=new ListTable(2);
		$LTable1->addElement(new Lable("نام"));
		$LTable1->addElement($this->txtName);
		$LTable1->addElement(new Lable("نام خانوادگی"));
		$LTable1->addElement($this->txtFamily);
		$LTable1->addElement(new Lable("ایمیل"));
		$LTable1->addElement($this->txtEmail);
		$LTable1->addElement(new Lable("موبایل"));
		$LTable1->addElement($this->txtMobile);
		$LTable1->addElement(new Lable("تلفن"));
		$LTable1->addElement($this->txtTel);
		$LTable1->addElement(new Lable("جنسیت"));
		$LTable1->addElement($this->cmbIsmale);
		$LTable1->addElement(new Lable("شهر"));
		$LTable1->addElement($this->cmbCity);
		$LTable1->addElement(new Lable("آدرس"));
		$LTable1->addElement($this->txtAddress);
		$LTable1->addElement(new Lable("کد پستی"));
		$LTable1->addElement($this->txtPostalCode);
		$LTable1->addElement($this->chkShowcontactInfo,2);
		$LTable1->addElement($this->lblCardInfo,2);
		$LTable1->addElement(new Lable("شماره کارت"));
		$LTable1->addElement($this->txtCardNumber);
		$LTable1->addElement(new Lable("به نام "));
		$LTable1->addElement($this->txtCardOwner);
		$LTable1->addElement(new Lable("بانک"));
		$LTable1->addElement($this->cmbBank);
		$LTable1->addElement($this->lblCarInfo,2);
		$LTable1->addElement(new Lable("سازنده"));
		$LTable1->addElement($this->cmbCarMaker);
		$LTable1->addElement(new Lable("مدل"));
		$LTable1->addElement($this->cmbCarModel);
		$LTable1->addElement($this->btnSave,2);
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>