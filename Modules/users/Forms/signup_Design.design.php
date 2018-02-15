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
use core\CoreClasses\html\DataComboBox;
class signup_Design extends FormDesign
{
    private $NameTitle,$FamilyTitle,$SexTitle,$MobTitle,$UsernameTitle,$Pass1Title,$Pass2Title,$SignupButtonTitle,$MaleTitle,$FemaleTitle,$MailTitle,$userphotoTitle;
	private $AdditionalFields;
	private $ShowRoles;
	private $roles;
	public function getBodyHTML($command="load")
	{
	
			$table=new ListTable(2);
			$txtName=new TextBox("name");
			$txtfamily=new TextBox("family");
			$txtmob=new TextBox("usermob");
			$txtmail=new TextBox("useremail");
			$txtusername=new TextBox("username");
			$txtpass1=new PasswordBox("password");
			$txtpass2=new PasswordBox("password2");
			$btnSignup=new SweetButton("true",$this->SignupButtonTitle);
			$btnSignup->setAction("signup");
			
			$comboLevel=new DataComboBox($this->Levels,'level');
			$selectSex2=new ComboBox("ismale");
			$selectSex2->addOption("1", $this->MaleTitle);
			$selectSex2->addOption("0", $this->FemaleTitle);
			
			$filePhoto=new FileUploadBox("profilepicture");
			
			
			$table->addElement(new Lable($this->NameTitle));
			$table->addElement($txtName);
			$table->addElement(new Lable($this->FamilyTitle));
			$table->addElement($txtfamily);
			$table->addElement(new Lable($this->SexTitle));
			$table->addElement($selectSex2);
			$table->addElement(new Lable($this->MobTitle));
			$table->addElement($txtmob);
 			
			$table->addElement(new Lable($this->MailTitle));
			$table->addElement($txtmail);
			$table->addElement(new Lable($this->UsernameTitle));
			$table->addElement($txtusername);
			$table->addElement(new Lable($this->Pass1Title));
			$table->addElement($txtpass1);
			$table->addElement(new Lable($this->Pass2Title));
			$table->addElement($txtpass2);
			$table->addElement(new Lable($this->userphotoTitle));
			$table->addElement($filePhoto);
//			$listRoles=new DataComboBox($this->roles,"roleid");
			if($this->ShowRoles)
			{
//			 $table->addElement(new Lable("سمت:"));
//			 $table->addElement($listRoles);
			}
			for($i=0;$i<count($this->AdditionalFields);$i++)
			{
			    $textboxName="txt" . $this->AdditionalFields[$i]->getUserinfo_field();
			    $labelName="lbl" . $this->AdditionalFields[$i]->getUserinfo_field();
			    $$textboxName=new TextBox($textboxName);
			    $$labelName=new Lable($this->AdditionalFields[$i]->getUserinfo_fieldcaption());

			    $table->addElement($$labelName);
			    $table->addElement($$textboxName);
			    
			}
			$table->addElement($btnSignup,2);
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

		public function setMobTitle($MobTitle)
		{
		    $this->MobTitle = $MobTitle;
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



	public function setRoles($roles)
	{
	    $this->roles = $roles;
	}

	public function setAdditionalFields($Fields)
	{
	    $this->AdditionalFields = $Fields;
	}

	public function getShowRoles()
	{
	    return $this->ShowRoles;
	}

	public function setShowRoles($ShowRoles)
	{
	    $this->ShowRoles = $ShowRoles;
	}
}
?>

