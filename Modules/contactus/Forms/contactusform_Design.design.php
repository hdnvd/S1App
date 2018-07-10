<?php

namespace Modules\contactus\Forms;

use core\CoreClasses\html\GRecaptcha;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\TextArea;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\Div;

/**
 *
 * @author Hadi Nahavandi
 *        
 */
class contactusform_Design extends FormDesign {
	private $LBLName,$LBLFamily,$LBLTel,$LBLMob,$LBLMail,$LBLText,$BtnSave;
	private $ContactInfos;

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
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\services\FormDesign::getBodyHTML()
	 *
	 */
    public function __construct()
    {
        $this->Recaptcha=new GRecaptcha();
    }
	public function getBodyHTML($command = "load") {
		
		$LBLname=new Lable($this->LBLName);
		$LBLFamily=new Lable($this->LBLFamily);
		$LBLTel=new Lable($this->LBLTel);
		$LBLMob=new Lable($this->LBLMob);
		$LBLMail=new Lable($this->LBLMail);
		$LBLText=new Lable($this->LBLText);
		$table=new ListTable(2);
		$table->setId("contactus_form");
		$table->addElement($LBLname);
		$txtName=new TextBox("txtname");
        $txtName->setClass("form-control");
		$table->addElement($txtName);
		$table->addElement($LBLFamily);
        $txtfamily=new TextBox("txtfamily");
        $txtfamily->setClass("form-control");
        $table->addElement($txtfamily);
		$table->addElement($LBLMail);
		$txtMail=new TextBox("txtmail");
        $txtMail->setClass("form-control");
		$txtMail->SetAttribute("type", "email");
		$table->addElement($txtMail);
		$table->addElement($LBLMob);
        $txtMob=new TextBox("txtmob");
        $txtMob->setClass("form-control");
		$table->addElement($txtMob);
		$table->addElement($LBLTel);
        $txttel=new TextBox("txttel");
        $txttel->setClass("form-control");
        $table->addElement($txttel);
		$table->addElement($LBLText);
        $txttext=new TextArea("txttext");
        $txttext->setClass("form-control");
        $txttext->SetAttribute("rows",7);
        $table->addElement($txttext);

        $table->addElement($this->Recaptcha,2);
		$btnsave=new SweetButton(true,$this->BtnSave);
		$btnsave->setAction("send");
		$table->addElement($btnsave,2);

		for($i=0;$i<count($this->ContactInfos);$i++)
		{
		  $tmpTitle=new Lable($this->ContactInfos[$i]['title']);
		  $tmpTitleDiv=new Div();
		  $tmpTitleDiv->setClass("contactus_contactinfotitle");
		  $tmpTitleDiv->addElement($tmpTitle);
		  $tmpInfo=new Lable($this->ContactInfos[$i]['info']);
		  $tmpInfo->setHtmlContent(false);
		  $tmpInfoDiv=new Div();
		  $tmpInfoDiv->setClass("contactus_contactinfo");
		  $tmpInfoDiv->addElement($tmpInfo);
		  $table->addElement($tmpTitleDiv,2);
		  $table->addElement($tmpInfoDiv,2);
		}
		$form=new SweetFrom("", "POST", $table);
		return $form->getHTML();
	}

	/**
	 * 
	 * @param $LBLName
	 */
	public function setLBLName($LBLName)
	{
	    $this->LBLName = $LBLName;
	}

	/**
	 * 
	 * @param $LBLFamily
	 */
	public function setLBLFamily($LBLFamily)
	{
	    $this->LBLFamily = $LBLFamily;
	}

	/**
	 * 
	 * @param $LBLTel
	 */
	public function setLBLTel($LBLTel)
	{
	    $this->LBLTel = $LBLTel;
	}

	/**
	 * 
	 * @param $LBLMob
	 */
	public function setLBLMob($LBLMob)
	{
	    $this->LBLMob = $LBLMob;
	}

	/**
	 * 
	 * @param $LBLMail
	 */
	public function setLBLMail($LBLMail)
	{
	    $this->LBLMail = $LBLMail;
	}

	/**
	 * 
	 * @param $LBLText
	 */
	public function setLBLText($LBLText)
	{
	    $this->LBLText = $LBLText;
	}

	public function setBtnSave($BtnSave)
	{
	    $this->BtnSave = $BtnSave;
	}

	public function setContactInfos($ContactInfos)
	{
	    $this->ContactInfos = $ContactInfos;
	}
}

?>