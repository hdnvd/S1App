<?php

namespace Modules\users\Forms;

use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\PasswordBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\ComboBox;
use core\CoreClasses\html\FileUploadBox;
use core\CoreClasses\html\Image;

/**
 *
 * @author nahavandi
 *        
 */
class profile_Design extends FormDesign {
		private $NameTitle,$FamilyTitle,$SexTitle,$TelTitle,$MobTitle,$FatherTitle,$ZipTitle,$UsernameTitle,$Pass1Title,$Pass2Title,$SignupButtonTitle,$MaleTitle,$FemaleTitle,$MailTitle,$userphotoTitle;
		private $TXTName,$TXTFamily,$TXTMob,$TXTMail,$TXTFather,$TXTZip,$TXTTel,$IMGProfilePicture;
		public function getBodyHTML($command="load")
		{
			
			$table=new ListTable(2);
			$txtName=new TextBox("name",$this->TXTName);
			$txtfamily=new TextBox("family",$this->TXTFamily);
			$txttel=new TextBox("usertel",$this->TXTTel);
			$txtmob=new TextBox("usermob",$this->TXTMob);
			$txtfather=new TextBox("father",$this->TXTFather);
			$txtzip=new TextBox("postalcode",$this->TXTZip);
			$txtmail=new TextBox("useremail",$this->TXTMail);
			$selectSex=new ComboBox("ismale");
			
			$selectSex->addOption("1", $this->MaleTitle);
			$selectSex->addOption("0", $this->FemaleTitle);
			
			
			$imgPhoto=new Image($this->IMGProfilePicture,$this->TXTName . " " . $this->TXTFamily,100,100);
			
			
			$table->addElement(new Lable($this->NameTitle));
			$table->addElement($txtName);
			$table->addElement(new Lable($this->FamilyTitle));
			$table->addElement($txtfamily);
// 			$table->addElement(new Lable($this->SexTitle));
// 			$table->addElement($selectSex);
			$table->addElement(new Lable($this->TelTitle));
			$table->addElement($txttel);
			$table->addElement(new Lable($this->MobTitle));
			$table->addElement($txtmob);
			$table->addElement(new Lable($this->FatherTitle));
			$table->addElement($txtfather);
			$table->addElement(new Lable($this->ZipTitle));
			$table->addElement($txtzip);
			$table->addElement(new Lable($this->MailTitle));
			$table->addElement($txtmail);
			$table->addElement(new Lable($this->userphotoTitle));
			$table->addElement($imgPhoto);
			$form=new SweetFrom("", "post", $table);
			return $form;
		}
	
		public function setNameTitle($NameTitle)
		{
		    $this->NameTitle = $NameTitle;
		}

		public function setFamilyTitle($FamilyTitle)
		{
		    $this->FamilyTitle = $FamilyTitle;
		}

		public function setSexTitle($SexTitle)
		{
		    $this->SexTitle = $SexTitle;
		}

		public function setTelTitle($TelTitle)
		{
		    $this->TelTitle = $TelTitle;
		}

		public function setMobTitle($MobTitle)
		{
		    $this->MobTitle = $MobTitle;
		}

		public function setFatherTitle($FatherTitle)
		{
		    $this->FatherTitle = $FatherTitle;
		}

		public function setZipTitle($ZipTitle)
		{
		    $this->ZipTitle = $ZipTitle;
		}

		public function setUsernameTitle($UsernameTitle)
		{
		    $this->UsernameTitle = $UsernameTitle;
		}

		public function setPass1Title($Pass1Title)
		{
		    $this->Pass1Title = $Pass1Title;
		}

		public function setPass2Title($Pass2Title)
		{
		    $this->Pass2Title = $Pass2Title;
		}

		public function setSignupButtonTitle($SignupButtonTitle)
		{
		    $this->SignupButtonTitle = $SignupButtonTitle;
		}

		public function setMaleTitle($MaleTitle)
		{
		    $this->MaleTitle = $MaleTitle;
		}
		public function setMailTitle($MailTitle)
		{
			$this->MailTitle = $MailTitle;
		}
		

		public function setFemaleTitle($FemaleTitle)
		{
		    $this->FemaleTitle = $FemaleTitle;
		}

		public function setUserphotoTitle($userphotoTitle)
		{
		    $this->userphotoTitle = $userphotoTitle;
		}

		public function setTXTName($TXTName)
		{
		    $this->TXTName = $TXTName;
		}

		public function setTXTFamily($TXTFamily)
		{
		    $this->TXTFamily = $TXTFamily;
		}

		public function setTXTMob($TXTMob)
		{
		    $this->TXTMob = $TXTMob;
		}

		public function setTXTMail($TXTMail)
		{
		    $this->TXTMail = $TXTMail;
		}

		public function setTXTFather($TXTFather)
		{
		    $this->TXTFather = $TXTFather;
		}

		public function setTXTZip($TXTZip)
		{
		    $this->TXTZip = $TXTZip;
		}

		public function setTXTTel($TXTTel)
		{
		    $this->TXTTel = $TXTTel;
		}

		public function setIMGProfilePicture($IMGProfilePicture)
		{
		    $this->IMGProfilePicture = $IMGProfilePicture;
		}
}
?>