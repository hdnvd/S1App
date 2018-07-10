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
use core\CoreClasses\services\WidgetDesign;
use core\CoreClasses\html\UList;
use core\CoreClasses\html\UListElement;


class usermenuWidget_Design extends WidgetDesign {
	private $Links,$Texts;
	public function getBodyHTML($command=null)
	{
		$page=new UList();
		$page->setId("adminmenu");
		$page->setClass("nav main-menu nav-list");
		for($i=0;$i<count($this->Links);$i++)
		{
			$l=new link($this->Links[$i], $this->Texts[$i]);
            $l->setClass($l->getClass() . " ");
			$ll=new UListElement($l);
			$page->addElement($ll);
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
