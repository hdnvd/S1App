<?php
namespace Modules\test2\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\CheckBox;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\ComboBox;
use core\CoreClasses\html\FileUploadBox;
/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-07 - 2017-01-26 19:26
*@lastUpdate 1395-11-07 - 2017-01-26 19:26
*@SweetFrameworkHelperVersion 2.000
*@SweetFrameworkVersion 1.017
*/
class t2_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var lable */
	private $name;
	/** @var lable */
	private $txtName;
	/** @var textbox */
	private $txtfamily;
	/**
	 * @return textbox
	 */
	public function getTxtfamily()
	{
		return $this->txtfamily;
	}
	/** @var lable */
	private $btnSave;
	/** @var lable */
	private $dtNames;
	/** @var combobox */
	private $cmbName;
	/**
	 * @return combobox
	 */
	public function getCmbName()
	{
		return $this->cmbName;
	}
	public function __construct()
	{
		$this->name= new lable("متن بلند");
		$this->txtName= new lable("نام");
		$this->txtfamily= new textbox("txtfamily");
		$this->btnSave= new lable("ذخیره");
		$this->dtNames= new lable("اسامی");
		$this->cmbName= new combobox("cmbName");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setId("test2_t2");
		$Page->addElement(new Lable("ذخیره اسم"));
		$Page->setClass("sweet_formtitle");
		$LTable1=new ListTable(2);
		$LTable1->addElement($this->name,2);
		$LTable1->addElement($this->txtName,2);
		$LTable1->addElement(new Lable("نام خانوادگی"));
		$LTable1->addElement($this->txtfamily);
		$LTable1->addElement($this->btnSave,2);
		$LTable1->addElement($this->dtNames,2);
		$LTable1->addElement(new Lable("لیست اسامی"));
		$LTable1->addElement($this->cmbName);
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>