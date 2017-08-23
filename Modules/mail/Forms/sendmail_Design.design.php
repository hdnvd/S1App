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
use core\CoreClasses\html\FileUploadBox;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\ComboBox;


class sendmail_Design extends FormDesign {
	private $recieverID,$lblSubject,$txtSubject,$lblMailText,$txtMailText;
	private $lblMailFile1,$lblMailFile2,$lblMailFile3,$btnSend,$btnSendAction;
	private $recieverIDs,$recieverNames,$lblReciever;
	public function getBodyHTML($command=null)
	{
		$Page=new ListTable(2);
		$lblReciever=new Lable($this->lblReciever);
		$Page->addElement($lblReciever);
		$recieverID=new ComboBox("recieverID");
		for($i=0;$i<count($this->recieverIDs);$i++)
			$recieverID->addOption($this->recieverIDs[$i], $this->recieverNames[$i]);
		$Page->addElement($recieverID,1);

		$lblSubject=new Lable($this->lblSubject);
		$Page->addElement($lblSubject);

		$txtSubject=new TextBox("txtSubject",$this->txtSubject);
		$Page->addElement($txtSubject);

		$lblMailText=new Lable($this->lblMailText);
		$Page->addElement($lblMailText);

		$txtMailText=new TextBox("txtMailText",$this->txtMailText);
		$Page->addElement($txtMailText);

		
		
		$lblMailFile1=new Lable($this->lblMailFile1);
		$Page->addElement($lblMailFile1);
		
		$file1=new FileUploadBox("file1");
		$Page->addElement($file1);
		
		$lblMailFile2=new Lable($this->lblMailFile2);
		$Page->addElement($lblMailFile2);
		
		$file2=new FileUploadBox("file2");
		$Page->addElement($file2);
		
		$lblMailFile3=new Lable($this->lblMailFile3);
		$Page->addElement($lblMailFile3);
		
		$file3=new FileUploadBox("file3");
		$Page->addElement($file3);
		
		$btnSend=new SweetButton(true,$this->btnSend);
		$btnSend->setAction($this->btnSendAction);
		$Page->addElement($btnSend);
		
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}

	public function setRecieverID($recieverID)
	{
	    $this->recieverID = $recieverID;
	}

	public function setLblSubject($lblSubject)
	{
	    $this->lblSubject = $lblSubject;
	}

	public function setTxtSubject($txtSubject)
	{
	    $this->txtSubject = $txtSubject;
	}

	public function setLblMailText($lblMailText)
	{
	    $this->lblMailText = $lblMailText;
	}

	public function setTxtMailText($txtMailText)
	{
	    $this->txtMailText = $txtMailText;
	}

	public function setLblMailFile1($lblMailFile1)
	{
	    $this->lblMailFile1 = $lblMailFile1;
	}

	public function setLblMailFile2($lblMailFile2)
	{
	    $this->lblMailFile2 = $lblMailFile2;
	}

	public function setLblMailFile3($lblMailFile3)
	{
	    $this->lblMailFile3 = $lblMailFile3;
	}

	public function setBtnSend($btnSend)
	{
	    $this->btnSend = $btnSend;
	}

	public function setBtnSendAction($btnSendAction)
	{
	    $this->btnSendAction = $btnSendAction;
	}

	public function setRecieverIDs($recieverIDs)
	{
	    $this->recieverIDs = $recieverIDs;
	}

	public function setRecieverNames($recieverNames)
	{
	    $this->recieverNames = $recieverNames;
	}

	public function setLblReciever($lblReciever)
	{
	    $this->lblReciever = $lblReciever;
	}
}
?>
