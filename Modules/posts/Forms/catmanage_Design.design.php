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


class catmanage_Design extends FormDesign {
	private $LatinTitle,$txtLatinTitle,$Title,$txtTitle,$Mother,$cmbMotherID,$btnSave,$btnSaveAction,$HidID;
	public function getBodyHTML($command=null)
	{
		$Page=new ListTable(2);
		$hidid=new TextBox("hidid",$this->HidID,false);
	
		$LatinTitle=new Lable($this->LatinTitle);
		$Page->addElement($LatinTitle);
		
		$txtLatinTitle=new TextBox("txtLatinTitle",$this->txtLatinTitle);
		$Page->addElement($txtLatinTitle);
		
		$Title=new Lable($this->Title);
		$Page->addElement($Title);
		
		$txtTitle=new TextBox("txtTitle",$this->txtTitle);
		$Page->addElement($txtTitle);
		
		$Mother=new Lable($this->Mother);
		$Page->addElement($Mother);
		
		$cmbMotherID=new ComboBox("cmbMotherID");
		$cmbMotherID->addOption("-1","بدون مادر");
		for($i=0;$i<count($this->cmbMotherID);$i++)
		{
		    $cmbMotherID->addOption($this->cmbMotherID[$i]['id'], $this->cmbMotherID[$i]['title']);
		}
		$Page->addElement($cmbMotherID);
		
		$btnSave=new SweetButton(true,$this->btnSave);
		$btnSave->setAction($this->btnSaveAction);
		$Page->addElement($btnSave,2);
		$Page->addElement($hidid,2);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	public function setLatinTitle($LatinTitle)
	{
		$this->LatinTitle = $LatinTitle;
	}
	
	public function setTxtLatinTitle($txtLatinTitle)
	{
		$this->txtLatinTitle = $txtLatinTitle;
	}
	
	public function setTitle($Title)
	{
		$this->Title = $Title;
	}
	
	public function setTxtTitle($txtTitle)
	{
		$this->txtTitle = $txtTitle;
	}
	
	public function setMother($Mother)
	{
		$this->Mother = $Mother;
	}
	
	public function setCmbMotherID($cmbMotherID)
	{
		$this->cmbMotherID = $cmbMotherID;
	}
	
	public function setBtnSave($btnSave)
	{
		$this->btnSave = $btnSave;
	}

	public function setBtnSaveAction($btnSaveAction)
	{
	    $this->btnSaveAction = $btnSaveAction;
	}

	public function setHidID($HidID)
	{
	    $this->HidID = $HidID;
	}
}
?>
