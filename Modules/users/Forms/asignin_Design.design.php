<?php
namespace Modules\users\Forms;
use core\CoreClasses\html\FormLabel;
use core\CoreClasses\html\GRecaptcha;
use core\CoreClasses\html\htmlcode;
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
            $usernameField->setClass("usernamefield input input100");
            $usernameField->SetAttribute('placeholder','نام کاربری');
			$passwordField=new PasswordBox("password");
            $passwordField->setClass("passwordfield input input100");
            $passwordField->SetAttribute('placeholder','رمز عبور');
			$lbl1=new FormLabel($this->lbl1);
            $lbl1->setClass('label');
			$lbl1->SetAttribute("for",$usernameField);
			$lbl2=new FormLabel($this->lbl2);
			$lbl2->setClass('label');
            $lbl2->SetAttribute("for",$passwordField);
            $UserRow=new Div();
            $UserRow->setClass('group wrap-input100 validate-input');
            $UserRow->addElement($lbl1);
            $UserRow->addElement($usernameField);
            $lable=new Lable('');
            $lable->setClass('focus-input100');
            $span2=new htmlcode("<span class=\"symbol-input100\">
							<i class=\"fa fa-envelope\" aria-hidden=\"true\"></i>
						</span>");
            $UserRow->addElement($lable);
            $UserRow->addElement($span2);

            $PassRow=new Div();
            $PassRow->setClass('group wrap-input100 validate-input');
            $PassRow->addElement($lbl2);
            $PassRow->addElement($passwordField);

            $span3=new htmlcode("<span class=\"symbol-input100\">
							<i class=\"fa fa-lock\" aria-hidden=\"true\"></i>
						</span>");
            $PassRow->addElement($lable);
            $PassRow->addElement($span3);


            $RecaptchaRow=new Div();
            $RecaptchaRow->setClass('group');
            $RecaptchaRow->addElement($this->Recaptcha);


			$table=new ListTable(2);
			$table->setClass("logintable");
			$table->addElement($UserRow,2);
            $table->addElement($PassRow,2);
            $table->addElement($RecaptchaRow,2);
			$btn=new SweetButton(true,$this->btn);
			$btn->setClass('login100-form-btn');
			$btn->setAction("login");

            $ButtonRow=new Div();
            $ButtonRow->setClass('group');
            $ButtonRow->addElement($btn);



			$div=new Div();
		    $div->addElement($ButtonRow);
			if($this->showSignupLink)
			{
			    $LinkTitle=new link($this->SignupLink, "عضویت");
                $regDiv=new Div();
                $regDiv->setClass('users_signuplink');
                $regDiv->addElement($LinkTitle);

                $RegisterRow=new Div();
                $RegisterRow->setClass('group');
                $RegisterRow->addElement($regDiv);
                $div->addElement($RegisterRow);
			}
			    $table->addElement($div,2);
			$form=new SweetFrom(DEFAULT_PUBLICURL . "fa/users/asignin.jsp", "POST", $table);
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

