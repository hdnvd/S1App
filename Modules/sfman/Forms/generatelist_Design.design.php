<?php

namespace Modules\sfman\Forms;
use core\CoreClasses\html\link;
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
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
use Modules\languages\PublicClasses\CurrentLanguageManager;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 1395/10/9 - 2016/12/29 19:45:05
 *@lastUpdate 1395/10/9 - 2016/12/29 19:45:05
 *@SweetFrameworkHelperVersion 1.112
 *@Fields txtModule t,txtForm t,txtElementName t,txtElementTitle t,cmbElementType cb,btnAddElement sb,btnSave sb
*/


class generatelist_Design extends FormDesign {
	
	public static $ACTION_EDIT=1;
	private $Data;

	/**
	 * @param array $data
	 */
	public function setData($data)
	{
		$this->Data = $data;
	}
	/**
	 * @var TextBox
	 */
	private $TxtModule,$TxtForm,$TxtTableName;

	/**
	 * @var DataComboBox
	 */
	

	/**
	 * @var ComboBox
	 */
	private $cmbElementType;

	/**
	 * @var FileUploadBox
	 */
	

	/**
	 * @var SweetButton
	 */
	private $BtnGenerateList,$BtnSave;

	public function __construct()
	{
		$this->TxtModule=new TextBox("txtModule");
		$this->TxtModule->setReadonly(true);
        $this->TxtForm=new TextBox("txtForm");
        $this->TxtForm->setReadonly(true);
        $this->TxtTableName=new TextBox("txtTableName");
		$this->BtnSave=new SweetButton(true,"ذخیره");
		$this->BtnSave->setAction("BtnSave");
        $this->BtnGenerateList=new SweetButton(true,"تولید کد لیست");
        $this->BtnGenerateList->setAction("BtnGenerateList");
		$this->cmbElementType=new ComboBox("cmbElementType");
	}
	public function getBodyHTML($command=null)
	{
		$Page = new Div();
		$Page->setId("sfman_manageform");
		$Page->addElement(new Lable("مدیریت فرم"));
		$Page->setClass("sweet_formtitle");
		$LTable1 = new ListTable(4);
		$LTable1->setClass('sfman_listform');
		$LTable1->addElement(new Lable("ماژول"));
		$LTable1->addElement($this->TxtModule);
		$LTable1->addElement(new Lable("فرم"));
		$LTable1->addElement($this->TxtForm);
        $LTable1->addElement(new Lable("نام جدول"));
        $LTable1->setLastElementClass('sfman_listform_title');
        $LTable1->addElement($this->TxtTableName);
        $LTable1->addElement($this->BtnGenerateList);
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}

	/**
	 * @return TextBox
	 */
	public function getTxtModule()
	{
		return $this->TxtModule;
	}

    /**
     * @return TextBox
     */
    public function getTxtTableName()
    {
        return $this->TxtTableName;
    }

	/**
	 * @return TextBox
	 */
	public function getTxtForm()
	{
		return $this->TxtForm;
	}

}
?>
