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


class showmail_Design extends FormDesign {
	private $lblTitle,$lblFrom,$txtFrom,$lblText,$links;
	public function getBodyHTML($command=null)
	{
		$Page=new ListTable(2);
		$lblTitle=new Lable($this->lblTitle);
		$Page->addElement($lblTitle,2);
		
		$lblFrom=new Lable($this->lblFrom);
		$Page->addElement($lblFrom);
		
		$txtFrom=new TextBox("txtFrom",$this->txtFrom);
		$Page->addElement($txtFrom);
		
		$lblText=new Lable($this->lblText);
		$Page->addElement($lblText,2);
		for($i=0;$i<count($this->links);$i++)
		{
			$linkAttachment=new link($this->links[$i], "Download");
			$Page->addElement($linkAttachment,2);
		}
		
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}

	public function setLblTitle($lblTitle)
	{
	    $this->lblTitle = $lblTitle;
	}

	public function setLblFrom($lblFrom)
	{
	    $this->lblFrom = $lblFrom;
	}

	public function setTxtFrom($txtFrom)
	{
	    $this->txtFrom = $txtFrom;
	}

	public function setLblText($lblText)
	{
	    $this->lblText = $lblText;
	}

	public function setLinks($links)
	{
	    $this->links = $links;
	}
}
?>
