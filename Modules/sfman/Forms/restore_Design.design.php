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
use core\CoreClasses\html\FileUploadBox;
use Modules\languages\PublicClasses\CurrentLanguageManager;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 1395/3/1 - 2016/05/21 21:19:45
 *@lastUpdate 1395/3/1 - 2016/05/21 21:19:45
 *@SweetFrameworkHelperVersion 1.112
 *@Fields flbackup f,btnrestoreapp sb,btnrestoreframework sb,btnrestoretheme sb,btnrestorefiles sb,btnrestoredb sb
*/


class restore_Design extends FormDesign {
	private $Message;

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
	 * @var FileUploadBox
	 */
	private $Flbackup;

	/**
	 * @var SweetButton
	 */
	private $Btnrestoreapp,$Btnrestoreframework,$Btnrestoretheme,$Btnrestorefiles,$Btnrestoredb;

	public function __construct()
	{
		$this->Flbackup=new FileUploadBox("flbackup");
		$this->Btnrestoreapp=new SweetButton(true,"بازنشانی پشتیبان نرم افزار");
		$this->Btnrestoreapp->setAction("Btnrestoreapp");
		$this->Btnrestoreframework=new SweetButton(true,"بازنشانی پشتیبان فریمورک");
		$this->Btnrestoreframework->setAction("Btnrestoreframework");
		$this->Btnrestoretheme=new SweetButton(true,"بازنشانی پشتیبان قالب");
		$this->Btnrestoretheme->setAction("Btnrestoretheme");
		$this->Btnrestorefiles=new SweetButton(true,"بازنشانی پشتیبان فایل ها");
		$this->Btnrestorefiles->setAction("Btnrestorefiles");
		$this->Btnrestoredb=new SweetButton(true,"بازنشانی پشتیبان پایگاه داده");
		$this->Btnrestoredb->setAction("Btnrestoredb");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setId("sfman_restore");
		$Page->addElement(new Lable(""));
		$Page->setClass("sweet_formtitle");
		$LTable1=new ListTable(2);
		$LTable1->addElement(new Lable($this->Message));
		$LTable1->addElement($this->Flbackup,2);
		$LTable1->addElement($this->Btnrestoreapp,2);
		$LTable1->addElement($this->Btnrestoreframework,2);
		$LTable1->addElement($this->Btnrestoretheme,2);
		$LTable1->addElement($this->Btnrestorefiles,2);
		$LTable1->addElement($this->Btnrestoredb,2);
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}

	public function getFlbackup()
	{
	    return $this->Flbackup;
	}

	public function setMessage($Message)
	{
	    $this->Message = $Message;
	}
}
?>
