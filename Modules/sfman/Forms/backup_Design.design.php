<?php

namespace Modules\sfman\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\ComboBox;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\html\htmlcode;
use Modules\common\PublicClasses\AppRooter;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2016/05/18 19:52:46
 *@lastUpdate 2016/05/18 19:52:46
 *@SweetFrameworkHelperVersion 1.110
 *@Fields btnappbackup sb,btnframeworkbackup sb,btndbbackup sb,btnthemebackup sb
*/


class backup_Design extends FormDesign {
	private $link;

	/**
	 * @var TextBox
	 */
	

	/**
	 * @var DataComboBox
	 */
	

	/**
	 * @var ComboBox
	 */
	

	/**
	 * @var SweetButton
	 */
	private $Btnappbackup,$Btnframeworkbackup,$Btndbbackup,$Btnthemebackup,$Btnfilesbackup;

	public function __construct()
	{
		$this->Btnappbackup=new SweetButton(true,"ساخت پشتیبان نرم افزار");
		$this->Btnappbackup->setAction("Btnappbackup");
		$this->Btnframeworkbackup=new SweetButton(true,"ساخت پشتیبان فریمورک");
		$this->Btnframeworkbackup->setAction("Btnframeworkbackup");
		$this->Btndbbackup=new SweetButton(true,"ساخت پشتیبان پایگاه داده");
		$this->Btndbbackup->setAction("Btndbbackup");
		$this->Btnthemebackup=new SweetButton(true,"ساخت پشتیبان قالب");
		$this->Btnthemebackup->setAction("Btnthemebackup");
		$this->Btnfilesbackup=new SweetButton(true,"ساخت پشتیبان فایل ها");
		$this->Btnfilesbackup->setAction("Btnfilesbackup");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setId("sfman_backup");
		$Page->addElement(new Lable(""));
		$Page->setClass("sweet_formtitle");
		if($this->link!=null)
		    AppRooter::redirect($this->link,"0");
		$LTable1=new ListTable(2);
		$LTable1->addElement($this->Btnappbackup,2);
		$LTable1->addElement($this->Btnframeworkbackup,2);
		$LTable1->addElement($this->Btnfilesbackup,2);
		$LTable1->addElement($this->Btndbbackup,2);
		$LTable1->addElement($this->Btnthemebackup,2);
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}

	public function getLink()
	{
	    return $this->link;
	}

	public function setLink($link)
	{
	    $this->link = $link;
	}
}
?>
