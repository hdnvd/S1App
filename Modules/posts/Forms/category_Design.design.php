<?php

namespace Modules\posts\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Label;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\SweetFrom;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\ComboBox;


class category_Design extends FormDesign {
	
	public function getBodyHTML($command=null)
	{
		$Page=new ListTable(1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}

	
}
?>
