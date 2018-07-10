<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\html\GRecaptcha;
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
*@creationDate 1395-11-20 - 2017-02-08 16:00
*@lastUpdate 1395-11-20 - 2017-02-08 16:00
*@SweetFrameworkHelperVersion 2.000
*@SweetFrameworkVersion 1.017
*/
class fastsignup_Design extends FormDesign {
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
	/** @var datacombobox */
	private $cmbCity;
	/**
	 * @return datacombobox
	 */
	public function getCmbCity()
	{
		return $this->cmbCity;
	}
	/** @var textbox */
	private $txtpassword;
	/**
	 * @return textbox
	 */
	public function getTxtpassword()
	{
		return $this->txtpassword;
	}
	/** @var textbox */
	private $txtpassword2;
	/**
	 * @return textbox
	 */
	public function getTxtpassword2()
	{
		return $this->txtpassword2;
	}
	/** @var SweetButton */
	private $btnSignup;

    /**
     * @var GRecaptcha
     */
    private $Recaptcha;

    /**
     * @return GRecaptcha
     */
    public function getRecaptcha()
    {
        return $this->Recaptcha;
    }
	public function __construct()
	{
		$this->txtName= new textbox("txtName");
		$this->txtEmail= new textbox("txtEmail");
		$this->txtMobile= new textbox("txtMobile");
		$this->cmbCity= new datacombobox($this->Data['cmbCity'],"cmbCity");
		$this->txtpassword= new textbox("txtpassword");
		$this->txtpassword2= new textbox("txtpassword2");
		$this->btnSignup= new SweetButton(true,"عضویت");
		$this->btnSignup->setAction("btnSignup");
        $this->Recaptcha=new GRecaptcha();
	}
	public function getBodyHTML($command=null)
	{
	    $this->cmbCity->setTextField('title');
        $this->cmbCity->setDataArray($this->Data['city']);
		$Page=new Div();
		$Page->setId("buysell_fastsignup");
		$Page->addElement(new Lable("عضویت سریع"));
		$Page->setClass("sweet_formtitle");
		$LTable1=new ListTable(2);
		$LTable1->addElement(new Lable("نام"));
		$LTable1->addElement($this->txtName);
		$LTable1->addElement(new Lable("ایمیل"));
		$LTable1->addElement($this->txtEmail);
		$LTable1->addElement(new Lable("موبایل"));
		$LTable1->addElement($this->txtMobile);
		$LTable1->addElement(new Lable("شهر"));
		$LTable1->addElement($this->cmbCity);
		$LTable1->addElement(new Lable("رمز عبور"));
		$LTable1->addElement($this->txtpassword);
		$LTable1->addElement(new Lable("تکرار رمز عبور"));
		$LTable1->addElement($this->txtpassword2);
        $LTable1->addElement($this->Recaptcha,2);
		$LTable1->addElement($this->btnSignup,2);
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>