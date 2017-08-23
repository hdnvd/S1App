<?php

namespace Modules\mail\Forms;
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


class showbox_Design extends FormDesign {
	private $subjects,$texts,$MailLinks;
	public function getBodyHTML($command=null)
	{
		$Page=new ListTable(3);
		for($i=0;$i<count($this->MailLinks);$i++)
		{
			$index=new Lable($i+1);
			$Page->addElement($index);
		
			$lblSubject=new Lable($this->subjects[$i]);
			$Page->addElement($lblSubject);
		
			$lblText=new link($this->MailLinks[$i],$this->texts[$i]);
			$Page->addElement($lblText);
		}
		
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}

	public function setMailLinks($MailLinks)
	{
	    $this->MailLinks = $MailLinks;
	}

	public function setSubjects($subjects)
	{
	    $this->subjects = $subjects;
	}

	public function setTexts($texts)
	{
	    $this->texts = $texts;
	}
}
?>
