<?php

namespace Modules\posts\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\SweetFrom;
use Modules\languages\PublicClasses\CurrentLanguageManager;


class updateservice_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setId("posts_updateservice");
		$Page->addElement(new Lable("updateservice"));
		$LTable1=new ListTable(1);
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>
