<?php

namespace Modules\employment\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\ComboBox;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\SweetDate;
use core\CoreClasses\html\PHPFile;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/06/28 11:26:00
 *@lastUpdate 2015/06/28 11:26:00
 *@SweetFrameworkHelperVersion 1.105
 *@Fields name t,family t,mobile t,email t,website t,degree c,sciencefield t,sex c,ismarried c,birthyear c,soldierstatus c,province c,city c,unitype c,uniname t,mellicode t,foreignlanguage t,foreignlanguagerank c,register sb
*/


class registeremployee_Design extends FormDesign {
	private $Provinces;

	/**
	 * @var TextBox
	 */
	private $Name,$Family,$Mobile,$Email,$Website,$Sciencefield,$Uniname,$Mellicode,$Foreignlanguage;

	/**
	 * @var DataComboBox
	 */
	

	/**
	 * @var ComboBox
	 */
	private $Degree,$Sex,$Ismarried,$Birthyear,$Soldierstatus,$Province,$City,$Unitype,$Foreignlanguagerank;

	/**
	 * @var SweetButton
	 */
	private $Register;

	public function __construct()
	{
		$this->Degree=new ComboBox("degree");
		$this->Degree->addOption("0", "زیر دیپلم");
		$this->Degree->addOption("1", "دیپلم");
		$this->Degree->addOption("2", "کاردانی");
		$this->Degree->addOption("3", "کارشناسی");
		$this->Degree->addOption("4", "کارشناسی اشد");
		$this->Degree->addOption("5", "دکترا");
		$this->Degree->addOption("6", "فوق دکترا");
		$this->Degree->setSelectedID("3");
		
		$this->Sex=new ComboBox("sex");
		$this->Sex->addOption("0", "زن");
		$this->Sex->addOption("1", "مرد");
		$this->Ismarried=new ComboBox("ismarried");
		$this->Ismarried->addOption("0", "مجرد");
		$this->Ismarried->addOption("1", "متاهل");
		$this->Birthyear=new ComboBox("birthyear");
		$date = new SweetDate(true, true, 'Asia/Tehran');
		$year=$date->date("Y",false,false);
		for($i=$year;$i>$year-40;$i--)
		    $this->Birthyear->addOption($i, $i);
		$this->Soldierstatus=new ComboBox("soldierstatus");
		$this->Soldierstatus->addOption("0", "دارای پایان خدمت");
		$this->Soldierstatus->addOption("1", "سرباز");
		$this->Soldierstatus->addOption("2", "معافیت تحصیلی");
		
		$this->Province=new ComboBox("province");
		$this->City=new ComboBox("city");
		
		$this->Unitype=new ComboBox("unitype");
		$this->Unitype->addOption("0", "دولتی");
		$this->Unitype->addOption("1", "آزاد");
		$this->Unitype->addOption("2", "پیام نور");
		$this->Unitype->addOption("3", "غیر انتفاعی");
		$this->Unitype->addOption("4", "خارج از کشور");
		$this->Unitype->addOption("5", "سایر");
		
		$this->Foreignlanguagerank=new ComboBox("foreignlanguagerank");
		$this->Foreignlanguagerank->addOption("0", "ضعیف");
		$this->Foreignlanguagerank->addOption("1", "متوسط");
		$this->Foreignlanguagerank->addOption("2", "خوب");
		$this->Foreignlanguagerank->addOption("3", "عالی");
		
		$this->Name=new TextBox("name");
		$this->Family=new TextBox("family");
		$this->Mobile=new TextBox("mobile");
		$this->Email=new TextBox("email");
		$this->Website=new TextBox("website");
		$this->Sciencefield=new TextBox("sciencefield");
		$this->Uniname=new TextBox("uniname");
		$this->Mellicode=new TextBox("mellicode");
		$this->Foreignlanguage=new TextBox("foreignlanguage");
		$this->Register=new SweetButton(true,"ثبت نام");
		$this->Register->setAction("Register");
	}
	public function getBodyHTML($command=null)
	{
	    $getProv=new PHPFile("employment", "getprovincecities");
	    $getProv->addParameter("provinces", $this->Provinces);
	    $this->Province=new DataComboBox($this->Provinces);
	    $this->Province->setId("provinces");
	    $this->Province->setIDField("id");
	    $this->Province->setTextField("title");
	    $this->Province->setSelectedID($this->Provinces[0]['id']);
	     
	    $this->City=new DataComboBox($this->Provinces[0]['cities']);
	    $this->City->setId("cities");
	    $this->City->setIDField("id");
	    $this->City->setTextField("title");
	    
		$Page=new Div();
		$Page->addElement($getProv);
		$Page->setId("employment_registeremployee");
		$Page->addElement(new Lable("ثبت نام کارجو"));
		$Page->setClass("sweet_formtitle");
		$LTable1=new ListTable(2);
		$LTable1->addElement(new Lable("نام"));
		$LTable1->addElement($this->Name);
		$LTable1->addElement(new Lable("نام خانوادگی"));
		$LTable1->addElement($this->Family);
		$LTable1->addElement(new Lable("تلفن همراه"));
		$LTable1->addElement($this->Mobile);
		$LTable1->addElement(new Lable("ایمیل"));
		$LTable1->addElement($this->Email);
		$LTable1->addElement(new Lable("وب سایت"));
		$LTable1->addElement($this->Website);
		$LTable1->addElement(new Lable("رشته تحصیلی"));
		$LTable1->addElement($this->Sciencefield);
		$LTable1->addElement(new Lable("عنوان محل تحصیل"));
		$LTable1->addElement($this->Uniname);
		$LTable1->addElement(new Lable("کد ملی"));
		$LTable1->addElement($this->Mellicode);
		$LTable1->addElement(new Lable("زبان خارجی"));
		$LTable1->addElement($this->Foreignlanguage);
		$LTable1->addElement(new Lable("سطح تحصیلات"));
		$LTable1->addElement($this->Degree);
		$LTable1->addElement(new Lable("جنسیت"));
		$LTable1->addElement($this->Sex);
		$LTable1->addElement(new Lable("وضعیت تاهل"));
		$LTable1->addElement($this->Ismarried);
		$LTable1->addElement(new Lable("سال تولد"));
		$LTable1->addElement($this->Birthyear);
		$LTable1->addElement(new Lable("وضعیت خدمت"));
		$LTable1->addElement($this->Soldierstatus);
		$LTable1->addElement(new Lable("استان"));
		$LTable1->addElement($this->Province);
		$LTable1->addElement(new Lable("شهر"));
		$LTable1->addElement($this->City);
		$LTable1->addElement(new Lable("نوع دانشگاه"));
		$LTable1->addElement($this->Unitype);
		$LTable1->addElement(new Lable("مهارت در زبان خارجی"));
		$LTable1->addElement($this->Foreignlanguagerank);
		$LTable1->addElement($this->Register,2);
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}

	public function setProvinces($Provinces)
	{
	    $this->Provinces = $Provinces;
	}

	public function getName()
	{
	    return $this->Name;
	}

	public function getFamily()
	{
	    return $this->Family;
	}

	public function getMobile()
	{
	    return $this->Mobile;
	}

	public function getEmail()
	{
	    return $this->Email;
	}

	public function getWebsite()
	{
	    return $this->Website;
	}

	public function getSciencefield()
	{
	    return $this->Sciencefield;
	}

	public function getUniname()
	{
	    return $this->Uniname;
	}

	public function getMellicode()
	{
	    return $this->Mellicode;
	}

	public function getForeignlanguage()
	{
	    return $this->Foreignlanguage;
	}

	public function getDegree()
	{
	    return $this->Degree;
	}

	public function getSex()
	{
	    return $this->Sex;
	}

	public function getIsmarried()
	{
	    return $this->Ismarried;
	}

	public function getBirthyear()
	{
	    return $this->Birthyear;
	}

	public function getSoldierstatus()
	{
	    return $this->Soldierstatus;
	}

	public function getProvince()
	{
	    return $this->Province;
	}

	public function getCity()
	{
	    return $this->City;
	}

	public function getUnitype()
	{
	    return $this->Unitype;
	}

	public function getForeignlanguagerank()
	{
	    return $this->Foreignlanguagerank;
	}

	public function getRegister()
	{
	    return $this->Register;
	}
}
?>
