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


class manageform_Design extends FormDesign {
	
	public static $ACTION_EDIT=1;
	public static $ACTION_DELETEELEMENT=2;
	public static $ACTION_MOVEUP=3;
	public static $ACTION_MOVEDOWN=4;
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
	private $TxtModule,$TxtForm,$TxtElementName,$TxtElementTitle;

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
	private $BtnAddElement,$BtnSave;

	public function __construct()
	{
		$this->TxtModule=new TextBox("txtModule");
		$this->TxtModule->setReadonly(true);
		$this->TxtForm=new TextBox("txtForm");
		$this->TxtForm->setReadonly(true);
		$this->TxtElementName=new TextBox("txtElementName");
		$this->TxtElementTitle=new TextBox("txtElementTitle");
		$this->BtnAddElement=new SweetButton(true,"افزودن آیتم");
		$this->BtnAddElement->setAction("BtnAddElement");
		$this->BtnSave=new SweetButton(true,"ذخیره");
		$this->BtnSave->setAction("BtnSave");
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

		if ($this->Data['element'] != null)
		{
			$this->cmbElementType->setSelectedValue($this->Data['element']['type_fid']);
			$this->TxtElementName->setValue($this->Data['element']['name']);
			$this->TxtElementTitle->setValue($this->Data['element']['caption']);
			$this->BtnAddElement->setAction("BtnUpdateElement");
		}
		$LTable4=new ListTable(2);
		$LTable4->setClass('sfman_listform');
		$LTable4->addElement(new Lable("نوع آیتم"));
		$LTable4->setLastElementClass('sfman_listform_title');
		$LTable4->addElement($this->cmbElementType);
		$LTable4->addElement(new Lable("نام آیتم"));
		$LTable4->setLastElementClass('sfman_listform_title');
		$LTable4->addElement($this->TxtElementName);
		$LTable4->addElement(new Lable("عنوان آیتم"));
		$LTable4->setLastElementClass('sfman_listform_title');
		$LTable4->addElement($this->TxtElementTitle);
		$LTable4->addElement($this->BtnAddElement,2);


		$LTable2=new ListTable(8);
		$LTable2->setClass('sfman_datatable');
		$LTable2->addElement(new Lable("#"));
		$LTable2->setLastElementClass('sfman_listtitle');
		$LTable2->addElement(new Lable("نام"));
		$LTable2->setLastElementClass('sfman_listtitle');
		$LTable2->addElement(new Lable("عنوان"));
		$LTable2->setLastElementClass('sfman_listtitle');
		$LTable2->addElement(new Lable("نوع"));
		$LTable2->setLastElementClass('sfman_listtitle');
		$LTable2->addElement(new Lable("عملیات"),4);
		$LTable2->setLastElementClass('sfman_listtitle');
		for ($i=0;$i<count($this->Data['elements']);$i++)
		{
			$element=$this->Data['elements'][$i];
			$LTable2->addElement(new Lable($i+1));
			$LTable2->addElement(new Lable($element['name']));
			$LTable2->addElement(new Lable($element['caption']));
			$LTable2->addElement(new Lable($this->getTypeTitle($element['type_fid'])));
			$lbl2=new Lable("ویرایش");
			$rooter2=new AppRooter('sfman','manageform');
			$rooter2->addParameter(new UrlParameter('id',$this->Data['form']['id']));
			$rooter2->addParameter(new UrlParameter('elementid',$element['id']));
			$rooter2->addParameter(new UrlParameter('act',manageform_Design::$ACTION_EDIT));
			$lnk2=new link($rooter2->getAbsoluteURL(),$lbl2);
			$LTable2->addElement($lnk2);
			$lbl=new Lable("حذف");
			$rooter=new AppRooter('sfman','manageform');
			$rooter->addParameter(new UrlParameter('id',$this->Data['form']['id']));
			$rooter->addParameter(new UrlParameter('elementid',$element['id']));
			$rooter->addParameter(new UrlParameter('act',manageform_Design::$ACTION_DELETEELEMENT));
			$lnk=new link($rooter->getAbsoluteURL(),$lbl);
			$LTable2->addElement($lnk);

			$lbl3=new Lable("▲");
			$rooter3=new AppRooter('sfman','manageform');
			$rooter3->addParameter(new UrlParameter('id',$this->Data['form']['id']));
			$rooter3->addParameter(new UrlParameter('elementid',$element['id']));
			$rooter3->addParameter(new UrlParameter('act',manageform_Design::$ACTION_MOVEUP));
			$lnk3=new link($rooter3->getAbsoluteURL(),$lbl3);
			$LTable2->addElement($lnk3);

			$lbl4=new Lable("▼");
			$rooter4=new AppRooter('sfman','manageform');
			$rooter4->addParameter(new UrlParameter('id',$this->Data['form']['id']));
			$rooter4->addParameter(new UrlParameter('elementid',$element['id']));
			$rooter4->addParameter(new UrlParameter('act',manageform_Design::$ACTION_MOVEDOWN));
			$lnk4=new link($rooter4->getAbsoluteURL(),$lbl4);
			$LTable2->addElement($lnk4);

		}
		$LTable3=new ListTable(2);
		$LTable3->setId("sfman_manageform_form");
		$LTable3->addElement($LTable1,2);
		$LTable3->addElement($LTable4);
		$LTable3->addElement($LTable2);
		$LTable3->addElement($this->BtnSave);
		$Page->addElement($LTable3);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}

	private function getTypeTitle($ID)
	{
		for($i=0;$i<count($this->Data['elementtypes']);$i++)
			if($this->Data['elementtypes'][$i]['id']==$ID)
				return $this->Data['elementtypes'][$i]['title'];
		return "Unknown Type";
	}
	/**
	 * @return ComboBox
	 */
	public function getCmbElementType()
	{
		return $this->cmbElementType;
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
	public function getTxtForm()
	{
		return $this->TxtForm;
	}

	/**
	 * @return TextBox
	 */
	public function getTxtElementName()
	{
		return $this->TxtElementName;
	}

	/**
	 * @return TextBox
	 */
	public function getTxtElementTitle()
	{
		return $this->TxtElementTitle;
	}
}
?>
