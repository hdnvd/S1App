<?php

namespace Modules\files\Forms;
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


class listfiles_Design extends FormDesign {
	private $lblfilenames,$lblfiletitles,$viewlinks,$viewTitle;
	private $lblfilename,$lblfiletitle,$lblviewlinks,$lblIndexTitle;
	public function getBodyHTML($command=null)
	{
		$Page=new ListTable(4);

		$lblIndex=new Lable($this->lblIndexTitle);
		$Page->addElement($lblIndex);

		$lblfilename=new Lable($this->lblfilename);
		$Page->addElement($lblfilename);

		$lblfiletitle=new Lable($this->lblfiletitle);
		$Page->addElement($lblfiletitle);

		$lblviewlink=new Lable($this->lblviewlinks);
		$Page->addElement($lblviewlink);

		for($i=0;$i<count($this->lblfilenames);$i++)
		{
			$lblIndex=new Lable($i+1);
			$Page->addElement($lblIndex);

			$lblfilename=new Lable($this->lblfilenames[$i]);
			$lblfilename->setClass("files_filename");
			$lblfilename->SetAttribute("data-src",$this->viewlinks[$i]);
			$Page->addElement($lblfilename);

			$lblfiletitle=new Lable($this->lblfiletitles[$i]);
			$Page->addElement($lblfiletitle);

			$viewlink=new link($this->viewlinks[$i],$this->viewTitle);
			$Page->addElement($viewlink);
		}
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}

	public function setLblfilenames($lblfilenames)
	{
	    $this->lblfilenames = $lblfilenames;
	}

	public function setLblfiletitles($lblfiletitles)
	{
	    $this->lblfiletitles = $lblfiletitles;
	}

	public function setViewlinks($viewlinks)
	{
	    $this->viewlinks = $viewlinks;
	}

	public function setViewTitle($viewTitle)
	{
	    $this->viewTitle = $viewTitle;
	}

	public function setLblfilename($lblfilename)
	{
	    $this->lblfilename = $lblfilename;
	}

	public function setLblfiletitle($lblfiletitle)
	{
	    $this->lblfiletitle = $lblfiletitle;
	}

	public function setLblviewlinks($lblviewlinks)
	{
	    $this->lblviewlinks = $lblviewlinks;
	}

	public function setLblIndexTitle($lblIndexTitle)
	{
	    $this->lblIndexTitle = $lblIndexTitle;
	}
}
?>
