<?php

namespace Modules\users\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Label;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\SweetFrom;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\Lable;
use Modules\common\PublicClasses\AppRooter;


class accessdenied_Design extends FormDesign {
	private $Message;
	public function getBodyHTML($command=null)
	{
		$page=new ListTable(1);
		$Label=new Lable($this->Message);
		$page->addElement($Label);
		$appRooter=new AppRooter("users", "asignin");
		$appRooter->redirect($appRooter->getAbsoluteURL(),"0");
		$form=new SweetFrom("", "POST", $page);
		return $form->getHTML();
	}

	public function setMessage($Message)
	{
	    $this->Message = $Message;
	}
}
?>
