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
use core\CoreClasses\html\FileUploadBox;
use core\CoreClasses\html\Lable;


class fileupload_Design extends FormDesign {
	private $Send;
	private $lblFileTitle,$txtFileTitle,$lblFile;
	public function getBodyHTML($command=null)
	{
		$page=new ListTable(2);
		$file=new FileUploadBox("file");
		$submit=new SweetButton(true,$this->Send);
		$submit->setAction("upload");
		$lblFileTitle=new Lable($this->lblFileTitle);
		$lblFile=new Lable($this->lblFile);
		$page->addElement($lblFileTitle);
		
		$txtFileTitle=new TextBox("txtFileTitle",$this->txtFileTitle);
		$page->addElement($txtFileTitle);
		$page->addElement($lblFile);
		$page->addElement($file);
		$page->addElement($submit);
		$form=new SweetFrom("", "POST", $page);
		return $form->getHTML();
	}

	public function setSend($Send)
	{
	    $this->Send = $Send;
	}
	

	public function setLblFileTitle($lblFileTitle)
	{
	    $this->lblFileTitle = $lblFileTitle;
	}

	public function setTxtFileTitle($txtFileTitle)
	{
	    $this->txtFileTitle = $txtFileTitle;
	}

	public function setLblFile($lblFile)
	{
	    $this->lblFile = $lblFile;
	}
}
?>
