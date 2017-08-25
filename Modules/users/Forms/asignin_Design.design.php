<?php
namespace Modules\users\Forms;
use core\CoreClasses\html\GRecaptcha;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\PasswordBox;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\FieldSet;
use core\CoreClasses\html\link;
use core\CoreClasses\html\Div;

class asignin_Design extends FormDesign
	{
	
		private $message,$lbl1,$lbl2,$btn,$lbl3,$showSignupLink,$SignupLink;
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
		public function setMessage($message)
		{
			$this->message=$message;
		}
		public function setShowSignupLink($showSignupLink)
		{
			$this->showSignupLink=$showSignupLink;
		}
		public function setSignupLink($SignupLink)
		{
			$this->SignupLink=$SignupLink;
		}
		public function __construct()
        {

            $this->Recaptcha=new GRecaptcha();
        }

    public function getBodyHTML($command="load")
		{

			$usernameField=new TextBox("username");
            $usernameField->setClass("form-control usernamefield");
			$passwordField=new PasswordBox("password");
            $passwordField->setClass("form-control passwordfield");
			$lbl1=new Lable($this->lbl1);
			$lbl2=new Lable($this->lbl2);
			$table=new ListTable(2);
			$table->setClass("logintable");
			$table->addElement($lbl1);
			$table->addElement($usernameField);
			$table->addElement($lbl2);
			$table->addElement($passwordField);
            $table->addElement($this->Recaptcha,2);
			$btn=new SweetButton(true,$this->btn);
			$btn->setAction("login");
			$div=new Div();
		    	$div->addElement($btn);
			if($this->showSignupLink)
			{
			    $LinkTitle=new link($this->SignupLink, "عضویت");
			    $LinkTitle->setClass("users_signuplink");
			    $div->addElement($LinkTitle);
			}
			    $table->addElement($div,2);
			$form=new SweetFrom("", "POST", $table);
			return $form;
		}
		
	
			public function setLbl1($lbl1)
			{
			    $this->lbl1 = $lbl1;
			}

			public function setLbl2($lbl2)
			{
			    $this->lbl2 = $lbl2;
			}

			public function setBtn($btn)
			{
			    $this->btn = $btn;
			}

		public function setLbl3($lbl3)
		{
		    $this->lbl3 = $lbl3;
		}
}
?>

