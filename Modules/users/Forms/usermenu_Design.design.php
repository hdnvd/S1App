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
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\link;


class usermenu_Design extends FormDesign {
	private $Links,$Texts;
	public function getBodyHTML($command=null)
	{
		$page=new ListTable(4);
		$page->setId("adminmenu");
		for($i=0;$i<count($this->Links);$i++)
		{
			$l=new link($this->Links[$i], $this->Texts[$i]);
			$page->addElement($l);
		}
		
		$form=new SweetFrom("", "POST", $page);
		return $form->getHTML();
	}


	public function setLinks($Links)
	{
	    $this->Links = $Links;
	}

	public function setTexts($Texts)
	{
	    $this->Texts = $Texts;
	}
}
?>
