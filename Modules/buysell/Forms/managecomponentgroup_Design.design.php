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
*@creationDate 1395-11-26 - 2017-02-14 08:32
*@lastUpdate 1395-11-26 - 2017-02-14 08:32
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class managecomponentgroup_Design extends FormDesign {
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
	private $cmbMotherGroup;
	/**
	 * @return combobox
	 */
	public function getCmbMotherGroup()
	{
		return $this->cmbMotherGroup;
	}
	/** @var SweetButton */
	private $btnSave;
	public function __construct()
	{
		$this->txtLatinTitle= new textbox("txtLatinTitle");
		$this->txtTitle= new textbox("txtTitle");
		$this->cmbMotherGroup= new combobox("cmbMotherGroup");
		$this->btnSave= new SweetButton(true,"ذخیره");
		$this->btnSave->setAction("btnSave");
	}
	public function getBodyHTML($command=null)
	{
        $this->cmbMotherGroup->addOption(-1,"بدون گروه مادر");
	    for ($i=0;$i<count($this->Data['components']);$i++)
        {
            $curC=$this->Data['components'][$i];
            $this->cmbMotherGroup->addOption($curC['id'],$curC['title']);
        }
        $this->txtLatinTitle->setValue($this->Data['component']['latintitle']);
        $this->txtTitle->setValue($this->Data['component']['title']);
        $this->cmbMotherGroup->setSelectedValue($this->Data['component']['mother_fid']);
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("buysell_managecomponent");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
		$PageTitlePart->addElement(new Lable("مدیریت گروه قطعه"));
		$Page->addElement($PageTitlePart);
		$MessagePart=new Div();
		$MessagePart->setClass("sweet_messagepart");
		$MessagePart->addElement(new Lable($this->getMessage()));
		$Page->addElement($MessagePart);
		$LTable1=new ListTable(2);
		$LTable1->addElement(new Lable("عنوان لاتین"));
		$LTable1->addElement($this->txtLatinTitle);
		$LTable1->addElement(new Lable("عنوان"));
		$LTable1->addElement($this->txtTitle);
		$LTable1->addElement(new Lable("گروه مادر"));
		$LTable1->addElement($this->cmbMotherGroup);
		$LTable1->addElement($this->btnSave,2);
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>