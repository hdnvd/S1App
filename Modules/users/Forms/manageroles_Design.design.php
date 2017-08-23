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
use core\CoreClasses\html\CheckListBox;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\ComboBox;
use core\CoreClasses\html\CheckBox;
use core\CoreClasses\html\form;
use core\CoreClasses\html\Div;
use Modules\common\PublicClasses\AppJSLink;
use core\CoreClasses\html\JavascriptLink;


class manageroles_Design extends FormDesign {
	private $roles,$tasks;
	public function getBodyHTML($command=null)
	{
		$Page=new ListTable(3);
		$lnk=new AppJSLink("users", "roletasks");
		$Page->addElement(new JavascriptLink($lnk->getAbsoluteURL()));
		$rolePart=new ListTable(1);
		
		$txtNewRole=new TextBox("title","");
		$txtModule=new TextBox("defaultmodule","");
		$txtPage=new TextBox("defaultpage","");
		$rolePart->addElement(new Lable("عنوان سمت:"));
		$rolePart->addElement($txtNewRole);
		$rolePart->addElement(new Lable("ماژول پیشفرض:"));
		$rolePart->addElement($txtModule);
		$rolePart->addElement(new Lable("صفحه پیشفرض:"));
		$rolePart->addElement($txtPage);
		$btnAddnewRole=new SweetButton(true,"افزودن سمت جدید");
		$btnAddnewRole->setAction("addnewrole");
		$rolePart->addElement($btnAddnewRole);
		$form1=new SweetFrom("", "POST", $rolePart);
		$Page->addElement($form1);
		
		$taskPart=new ListTable(1);
		
		$listRoles=new DataComboBox($this->roles,"roleid");
		$taskPart->addElement($listRoles);
		$listTasks=new CheckBox("taskID[]");
		$listTasks->setId("taskID");
		for($i=0;$i<count($this->tasks);$i++)
			$listTasks->addOption($this->tasks[$i]['module'] . "." . $this->tasks[$i]['page'],$this->tasks[$i]['id'],true);
		$txtNewRole=new TextBox("title","");
		$txtModule=new TextBox("defaultmodule","");
		$txtPage=new TextBox("defaultpage","");
		$taskPart->addElement($listTasks);
		$btnSetPrevilage=new SweetButton(true,"اعطای دسترسی");
		$btnSetPrevilage->setAction("setprevilage");
		$taskPart->addElement($btnSetPrevilage);
		$Page->addElement($taskPart);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	public function getSelectedRole()
	{
		return $_POST['roleid'];
	}
	public function getTitle()
	{
		return $_POST['title'];
	}
	public function getDefaultModule()
	{
		return $_POST['defaultmodule'];
	}
	public function getDefaultPage()
	{
		return $_POST['defaultpage'];
	}
	public function setRoles($roles)
	{
	    $this->roles = $roles;
	}

	public function setTasks($tasks)
	{
	    $this->tasks = $tasks;
	}
	public function getPrevilages()
	{
		return $_POST['taskID'];
	}
}
?>
