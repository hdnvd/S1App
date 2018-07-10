<?php

namespace Modules\buysell\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\ComboBox;
use core\CoreClasses\html\FileUploadBox;
use Modules\languages\PublicClasses\CurrentLanguageManager;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 1395/10/6 - 2016/12/26 02:02:59
 *@lastUpdate 1395/10/6 - 2016/12/26 02:02:59
 *@SweetFrameworkHelperVersion 1.112
 *@Fields txtname t,txtfamily t,txtmail t,txtmobile t,txttel t,cmbsex c,cmbprovince dc,cmbcity dc,txtaddress t,txtpostalcode t,txtbirthyear t,txtbirthmonth t,txtbirthday t,chkshowcontactinfo c,txtcardnumber t,txtcardbank t,txtcardowner t,cmbcarmaker dc,cmbcarmodel dc,btnsave sb
*/


class edituserinfo_Design extends FormDesign {
	

	/**
	 * @var TextBox
	 */
	private $Txtname,$Txtfamily,$Txtmail,$Txtmobile,$Txttel,$Txtaddress,$Txtpostalcode,$Txtbirthyear,$Txtbirthmonth,$Txtbirthday,$Txtcardnumber,$Txtcardbank,$Txtcardowner;

	/**
	 * @var DataComboBox
	 */
	private $Cmbprovince,$Cmbcity,$Cmbcarmaker,$Cmbcarmodel;

	/**
	 * @var ComboBox
	 */
	private $Cmbsex,$Chkshowcontactinfo;

	/**
	 * @var FileUploadBox
	 */
	

	/**
	 * @var SweetButton
	 */
	private $Btnsave;

	public function __construct()
	{
		$this->Cmbsex=new ComboBox("cmbsex");
		$this->Chkshowcontactinfo=new ComboBox("chkshowcontactinfo");
		$this->Txtname=new TextBox("txtname");
		$this->Txtfamily=new TextBox("txtfamily");
		$this->Txtmail=new TextBox("txtmail");
		$this->Txtmobile=new TextBox("txtmobile");
		$this->Txttel=new TextBox("txttel");
		$this->Txtaddress=new TextBox("txtaddress");
		$this->Txtpostalcode=new TextBox("txtpostalcode");
		$this->Txtbirthyear=new TextBox("txtbirthyear");
		$this->Txtbirthmonth=new TextBox("txtbirthmonth");
		$this->Txtbirthday=new TextBox("txtbirthday");
		$this->Txtcardnumber=new TextBox("txtcardnumber");
		$this->Txtcardbank=new TextBox("txtcardbank");
		$this->Txtcardowner=new TextBox("txtcardowner");
		$this->Btnsave=new SweetButton(true,"btnsave");
		$this->Btnsave->setAction("Btnsave");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setId("buysell_edituserinfo");
		$Page->addElement(new Lable("edituserinfo"));
		$Page->setClass("sweet_formtitle");
		$LTable1=new ListTable(2);
		$LTable1->addElement(new Lable("txtname"));
		$LTable1->addElement($this->Txtname);
		$LTable1->addElement(new Lable("txtfamily"));
		$LTable1->addElement($this->Txtfamily);
		$LTable1->addElement(new Lable("txtmail"));
		$LTable1->addElement($this->Txtmail);
		$LTable1->addElement(new Lable("txtmobile"));
		$LTable1->addElement($this->Txtmobile);
		$LTable1->addElement(new Lable("txttel"));
		$LTable1->addElement($this->Txttel);
		$LTable1->addElement(new Lable("txtaddress"));
		$LTable1->addElement($this->Txtaddress);
		$LTable1->addElement(new Lable("txtpostalcode"));
		$LTable1->addElement($this->Txtpostalcode);
		$LTable1->addElement(new Lable("txtbirthyear"));
		$LTable1->addElement($this->Txtbirthyear);
		$LTable1->addElement(new Lable("txtbirthmonth"));
		$LTable1->addElement($this->Txtbirthmonth);
		$LTable1->addElement(new Lable("txtbirthday"));
		$LTable1->addElement($this->Txtbirthday);
		$LTable1->addElement(new Lable("txtcardnumber"));
		$LTable1->addElement($this->Txtcardnumber);
		$LTable1->addElement(new Lable("txtcardbank"));
		$LTable1->addElement($this->Txtcardbank);
		$LTable1->addElement(new Lable("txtcardowner"));
		$LTable1->addElement($this->Txtcardowner);
		$LTable1->addElement(new Lable("cmbprovince"));
		$LTable1->addElement($this->Cmbprovince);
		$LTable1->addElement(new Lable("cmbcity"));
		$LTable1->addElement($this->Cmbcity);
		$LTable1->addElement(new Lable("cmbcarmaker"));
		$LTable1->addElement($this->Cmbcarmaker);
		$LTable1->addElement(new Lable("cmbcarmodel"));
		$LTable1->addElement($this->Cmbcarmodel);
		$LTable1->addElement(new Lable("cmbsex"));
		$LTable1->addElement($this->Cmbsex);
		$LTable1->addElement(new Lable("chkshowcontactinfo"));
		$LTable1->addElement($this->Chkshowcontactinfo);
		$LTable1->addElement($this->Btnsave,2);
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>
