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
 *@creationDate 1395/10/9 - 2016/12/29 02:25:33
 *@lastUpdate 1395/10/9 - 2016/12/29 02:25:33
 *@SweetFrameworkHelperVersion 1.112
 *@Fields cmbModule dc,txtFormName t,txtFormTitle t,btnGenerate sb
*/


class generateform_Design extends FormDesign {
	

	/**
	 * @var TextBox
	 */
	private $TxtFormName,$TxtFormTitle;

	/**
	 * @var DataComboBox
	 */
	private $CmbModule;

	/**
	 * @var ComboBox
	 */
	

	/**
	 * @var FileUploadBox
	 */
	

	/**
	 * @var SweetButton
	 */
	private $BtnGenerate;

	public function __construct()
	{
		$this->TxtFormName=new TextBox("txtFormName");
		$this->TxtFormTitle=new TextBox("txtFormTitle");
		$this->BtnGenerate=new SweetButton(true,"ذخیره");
		$this->BtnGenerate->setAction("BtnGenerate");
		$this->CmbModule=new DataComboBox();
	}

	/**
	 * @return TextBox
	 */
	public function getTxtFormName()
	{
		return $this->TxtFormName;
	}

	/**
	 * @return TextBox
	 */
	public function getTxtFormTitle()
	{
		return $this->TxtFormTitle;
	}

	/**
	 * @return DataComboBox
	 */
	public function getCmbModule()
	{
		return $this->CmbModule;
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setId("sfman_generateform");
		$Page->addElement(new Lable("ساخت فرم"));
		$Page->setClass("sweet_formtitle");
		$LTable1=new ListTable(2);
		$LTable1->addElement(new Lable("نام لاتین"));
		$LTable1->addElement($this->TxtFormName);
		$LTable1->addElement(new Lable("عنوان"));
		$LTable1->addElement($this->TxtFormTitle);
		$LTable1->addElement(new Lable("ماژول"));
		$LTable1->addElement($this->CmbModule);
		$LTable1->addElement($this->BtnGenerate,2);
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>
