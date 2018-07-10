<?php

namespace Modules\gallery\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\SweetFrom;
use Modules\languages\PublicClasses\CurrentLanguageManager;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2014/12/20 21:57:52
 *@lastupdate 2014/12/20 21:57:52
*/


class managealbum_Design extends FormDesign {
	/**
	 * @var TextBox
	 */
	private $txtTitle,$txtLatinTitle,$txtHidID;
	/**
	 * @var DataComboBox
	 */
	private $cmbMotherAlbum;
	/**
	 * @var SweetButton
	 */
	private $btnSave;
	public function __construct()
	{
		$this->txtTitle=new TextBox("title");
		$this->txtLatinTitle=new TextBox("latintitle");
		$this->txtHidID=new TextBox("hidid");
		$this->txtHidID->setVisible(false);
		$this->cmbMotherAlbum=new DataComboBox(array());
		$this->btnSave=new SweetButton();
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setId("gallery_managealbum");
		$Page->addElement(new Lable("مدیریت آلبوم"));
		$LTable1=new ListTable(2);
		$LTable1->addElement($this->txtHidID,2);
		$LTable1->addElement(new Lable("عنوان آلبوم"));
		$LTable1->addElement($this->txtTitle);
		$LTable1->addElement(new Lable("عنوان لاتین"));
		$LTable1->addElement($this->txtLatinTitle);
		$LTable1->addElement(new Lable("آلبوم مادر"));
		$LTable1->addElement($this->cmbMotherAlbum);
		$LTable1->addElement($this->btnSave);
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}


	public function getTxtTitle()
	{
	    return $this->txtTitle;
	}

	public function getTxtLatinTitle()
	{
	    return $this->txtLatinTitle;
	}

	public function getCmbMotherAlbum()
	{
	    return $this->cmbMotherAlbum;
	}

	public function getBtnSave()
	{
	    return $this->btnSave;
	}

	public function getTxtHidID()
	{
	    return $this->txtHidID;
	}
}
?>
