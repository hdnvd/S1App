<?php

namespace Modules\appman\Forms;
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
 *@creationDate 1395/3/29 - 2016/06/18 16:23:34
 *@lastUpdate 1395/3/29 - 2016/06/18 16:23:34
 *@SweetFrameworkHelperVersion 1.112
 *@Fields txtf1 t,txtf2 t,txtf3 t,txtf4 t,txtf5 t,txtf6 t,txtf7 t,txtf8 t,btnsave sb
*/


class ustat_Design extends FormDesign {
	

	/**
	 * @var TextBox
	 */
	private $Txtf1,$Txtf2,$Txtf3,$Txtf4,$Txtf5,$Txtf6,$Txtf7,$Txtf8;

	/**
	 * @var DataComboBox
	 */
	

	/**
	 * @var ComboBox
	 */
	

	/**
	 * @var FileUploadBox
	 */
	

	/**
	 * @var SweetButton
	 */
	private $Btnsave;

	public function __construct()
	{
		$this->Txtf1=new TextBox("txtf1");
		$this->Txtf2=new TextBox("txtf2");
		$this->Txtf3=new TextBox("txtf3");
		$this->Txtf4=new TextBox("txtf4");
		$this->Txtf5=new TextBox("txtf5");
		$this->Txtf6=new TextBox("txtf6");
		$this->Txtf7=new TextBox("txtf7");
		$this->Txtf8=new TextBox("txtf8");
		$this->Btnsave=new SweetButton(true,"btnsave");
		$this->Btnsave->setAction("Btnsave");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setId("appman_ustat");
		$Page->addElement(new Lable("ustat"));
		$Page->setClass("sweet_formtitle");
		$LTable1=new ListTable(2);
		$LTable1->addElement(new Lable("txtf1"));
		$LTable1->addElement($this->Txtf1);
		$LTable1->addElement(new Lable("txtf2"));
		$LTable1->addElement($this->Txtf2);
		$LTable1->addElement(new Lable("txtf3"));
		$LTable1->addElement($this->Txtf3);
		$LTable1->addElement(new Lable("txtf4"));
		$LTable1->addElement($this->Txtf4);
		$LTable1->addElement(new Lable("txtf5"));
		$LTable1->addElement($this->Txtf5);
		$LTable1->addElement(new Lable("txtf6"));
		$LTable1->addElement($this->Txtf6);
		$LTable1->addElement(new Lable("txtf7"));
		$LTable1->addElement($this->Txtf7);
		$LTable1->addElement(new Lable("txtf8"));
		$LTable1->addElement($this->Txtf8);
		$LTable1->addElement($this->Btnsave,2);
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}

	public function getTxtf1()
	{
	    return $this->Txtf1;
	}

	public function getTxtf2()
	{
	    return $this->Txtf2;
	}

	public function getTxtf3()
	{
	    return $this->Txtf3;
	}

	public function getTxtf4()
	{
	    return $this->Txtf4;
	}

	public function getTxtf5()
	{
	    return $this->Txtf5;
	}

	public function getTxtf6()
	{
	    return $this->Txtf6;
	}

	public function getTxtf7()
	{
	    return $this->Txtf7;
	}

	public function getTxtf8()
	{
	    return $this->Txtf8;
	}
}
?>
