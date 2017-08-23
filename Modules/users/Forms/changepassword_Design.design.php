<?php

namespace Modules\users\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\SweetFrom;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\common\PublicClasses\AppJSLink;
use core\CoreClasses\html\JavascriptLink;
use core\CoreClasses\html\PasswordBox;
use Modules\common\PublicClasses\AppRooter;
use core\CoreClasses\services\ResponseMode;


class changepassword_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setId("users_changepassword");
		$link=new AppJSLink("users", "changepassword");
		$Page->addElement(new JavascriptLink($link->getAbsoluteURL()));
		$LTable1=new ListTable(2);
		$LTable1->addElement(new Lable("کلمه عبور فعلی:"));
		$LTable1->addElement(new PasswordBox("CurrentPass"));
		$LTable1->addElement(new Lable("کلمه عبور جدید:"));
		$LTable1->addElement(new PasswordBox("NewPass"));
		$LTable1->addElement(new Lable("تکرار کلمه عبور جدید:"));
		$LTable1->addElement(new PasswordBox("NewPass2"));
		$btn=new SweetButton(true,"تغییر رمز");
		$btn->setAction("change");
		$LTable1->addElement($btn,2);
		$Page->addElement($LTable1);
		$changer=new AppRooter("users", "changepassword");
		$changer->setResponseMode(ResponseMode::AJAX);
		$form=new SweetFrom($changer->getAbsoluteURL(), "POST", $Page);
		$form->setId("changepassform");
		return $form->getHTML();
	}
	public function getCurrentPass()
	{
		return $_POST['CurrentPass'];
	}
	public function getNewPass()
	{
		return $_POST['NewPass'];
	}
}
?>
