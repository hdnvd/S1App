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
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\html\htmlcode;
use core\CoreClasses\html\JavascriptLink;
use core\CoreClasses\html\PHPFile;
use core\CoreClasses\html\ComboBox;
use core\CoreClasses\html\PasswordBox;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/06/26 18:03:08
 *@lastUpdate 2015/06/26 18:03:08
 *@SweetFrameworkHelperVersion 1.104
 *@Fields title t,mob t,province t,city t,finance_type t,distance t,mail t,pass t,pass2 t,register sb
*/


class employer_Design extends FormDesign {
	private $Provinces;
	/**
	 * @var TextBox
	 */
	private $Title,$Mob,$Distance,$Mail,$Pass,$Pass2;
	
	/**
	 * @var DataComboBox
	 */
	private $Province,$City;
	
	/**
	 * @var SweetButton
	 */
	private $Register;
	
	/**
	 * @var ComboBox
	 */
	private $Finance_type;
	
	public function __construct()
	{
		$this->Title=new TextBox("title");
		$this->Mob=new TextBox("mob");
		$this->Finance_type=new ComboBox("finance_type");
		$this->Finance_type->addOption("0", "دولتی");
		$this->Finance_type->addOption("1", "خصوصی");
		$this->Distance=new TextBox("distance");
		$this->Mail=new TextBox("mail");
		$this->Pass=new PasswordBox("pass");
		$this->Pass2=new PasswordBox("pass2");
		$this->Register=new SweetButton(true,"ثبت");
		$this->Register->setAction("Register");
		$this->City=new DataComboBox(array());
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
	    
	    $this->City->setDataArray($this->Provinces[0]['cities']);
	    $this->City->setId("cities");
	    $this->City->setIDField("id");
	    $this->City->setTextField("title");
	    
		$Page=new Div();
		$Page->addElement($getProv);
		$Page->setId("employment_employer");
		$Page->addElement(new Lable("ثبت کارآفرین جدید"));
		$Page->setClass("sweet_formtitle");
		$LTable1=new ListTable(2);
		$LTable1->addElement(new Lable("استان"));
		$LTable1->addElement($this->Province);
		$LTable1->addElement(new Lable("شهر"));
		$LTable1->addElement($this->City);
		$LTable1->addElement(new Lable("مالکیت"));
		$LTable1->addElement($this->Finance_type);
		$LTable1->addElement(new Lable("عنوان کسب و کار"));
		$LTable1->addElement($this->Title);
		$LTable1->addElement(new Lable("تلفن همراه"));
		$LTable1->addElement($this->Mob);
		$LTable1->addElement(new Lable("فاصله از شهر(کیلومتر)"));
		$LTable1->addElement($this->Distance);
		$LTable1->addElement(new Lable("ایمیل"));
		$LTable1->addElement($this->Mail);
		$LTable1->addElement(new Lable("رمز عبور"));
		$LTable1->addElement($this->Pass);
		$LTable1->addElement(new Lable("تکرار رمز عبور"));
		$LTable1->addElement($this->Pass2);
		$LTable1->addElement($this->Register,2);
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}

	public function getTitle()
	{
	    return $this->Title;
	}

	public function getMob()
	{
	    return $this->Mob;
	}

	public function getProvince()
	{
	    return $this->Province;
	}

	public function getCity()
	{
	    return $this->City;
	}

	public function getFinance_type()
	{
	    return $this->Finance_type;
	}

	public function getDistance()
	{
	    return $this->Distance;
	}

	public function getMail()
	{
	    return $this->Mail;
	}

	public function getPass()
	{
	    return $this->Pass;
	}

	public function getPass2()
	{
	    return $this->Pass2;
	}

	public function getRegister()
	{
	    return $this->Register;
	}

	public function setProvinces($Provinces)
	{
	    $this->Provinces = $Provinces;
	}
}
?>
