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
use core\CoreClasses\html\ColumnTable;
use core\CoreClasses\html\link;


class catsmanage_Design extends FormDesign {
	private $CategoryTitles,$EditLinks,$DeleteLinks,$DeleteCaption;
	public function getBodyHTML($command=null)
	{
		$Page=new ListTable(2);
		for($i=0;$i<count($this->CategoryTitles);$i++)
		{
			$Page->addElement(new link($this->EditLinks[$i], $this->CategoryTitles[$i]));
			$Page->addElement(new link($this->DeleteLinks[$i], $this->DeleteCaption));
		}
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}

	public function setCategoryTitles($CategoryTitles)
	{
	    $this->CategoryTitles = $CategoryTitles;
	}

	public function setEditLinks($EditLinks)
	{
	    $this->EditLinks = $EditLinks;
	}

	public function setDeleteLinks($DeleteLinks)
	{
	    $this->DeleteLinks = $DeleteLinks;
	}

	public function setDeleteCaption($DeleteCaption)
	{
	    $this->DeleteCaption = $DeleteCaption;
	}
}
?>
