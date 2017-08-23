<?php
namespace Modules\buysell\Forms;
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
*@creationDate 1395-11-21 - 2017-02-09 01:49
*@lastUpdate 1395-11-21 - 2017-02-09 01:49
*@SweetFrameworkHelperVersion 2.000
*@SweetFrameworkVersion 1.017
*/
class managecarmodel_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var textbox */
	private $txtLatinTitle;
	/**
	 * @return textbox
	 */
	public function getTxtLatinTitle()
	{
		return $this->txtLatinTitle;
	}
	/** @var textbox */
	private $txtTitle;
	/**
	 * @return textbox
	 */
	public function getTxtTitle()
	{
		return $this->txtTitle;
	}
	/** @var combobox */
	private $cmbMaker;
	/**
	 * @return combobox
	 */
	public function getCmbMaker()
	{
		return $this->cmbMaker;
	}
	/** @var SweetButton */
	private $btnSave;
	public function __construct()
	{
		$this->txtLatinTitle= new textbox("txtLatinTitle");
		$this->txtTitle= new textbox("txtTitle");
		$this->cmbMaker= new combobox("cmbMaker");
		$this->btnSave= new SweetButton(true,"ذخیره");
		$this->btnSave->setAction("btnSave");
	}
	public function getBodyHTML($command=null)
	{
	    for ($i=0;$i<count($this->Data['carmakers']);$i++)
	        $this->cmbMaker->addOption($this->Data['carmakers'][$i]['id'],$this->Data['carmakers'][$i]['title']);
        $this->txtTitle->setValue($this->Data['carmodel']['title']);
        $this->txtLatinTitle->setValue($this->Data['carmodel']['latintitle']);
        $this->cmbMaker->setSelectedValue($this->Data['carmodel']['carmaker_fid']);
		$Page=new Div();
		$Page->setId("buysell_managecarmodel");
		$Page->addElement(new Lable("مدیریت مدل اتوموبیل"));
		$Page->setClass("sweet_formtitle");
		$LTable1=new ListTable(2);
		$LTable1->addElement(new Lable("عنوان لاتین"));
		$LTable1->addElement($this->txtLatinTitle);
		$LTable1->addElement(new Lable("عنوان"));
		$LTable1->addElement($this->txtTitle);
		$LTable1->addElement(new Lable("سازنده"));
		$LTable1->addElement($this->cmbMaker);
		$LTable1->addElement($this->btnSave,2);
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>