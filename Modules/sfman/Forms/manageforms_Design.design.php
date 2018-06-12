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
 *@creationDate 1395/10/9 - 2016/12/29 02:42:14
 *@lastUpdate 1395/10/9 - 2016/12/29 02:42:14
 *@SweetFrameworkHelperVersion 1.112
 *@Fields  t
*/


class manageforms_Design extends FormDesign {
	private $data;

	/**
	 * @param mixed $data
	 */
	public function setData($data)
	{
		$this->data = $data;
	}

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
	

	/**
	 * @var SweetButton
	 */
	

	public function __construct()
	{
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setId("sfman_manageforms");
		$Page->addElement(new Lable("manageforms"));
		$Page->setClass("sweet_formtitle");
		$LTable1=new ListTable(6);
		$LTable1->setClass('sfman_datatable');
		$LTable1->addElement(new Lable("#"));
		$LTable1->setLastElementClass('sfman_listtitle');
		$LTable1->addElement(new Lable("ماژول"));
		$LTable1->setLastElementClass('sfman_listtitle');
		$LTable1->addElement(new Lable("عنوان"));
		$LTable1->setLastElementClass('sfman_listtitle');
		$LTable1->addElement(new Lable("نام لاتین"));
		$LTable1->setLastElementClass('sfman_listtitle');
		$LTable1->addElement(new Lable("-"));
		$LTable1->setLastElementClass('sfman_listtitle');
		$LTable1->addElement(new Lable("-"));
		$LTable1->setLastElementClass('sfman_listtitle');
		$Index=1;
		for ($i=0;$i<count($this->data['modules']);$i++)
		{
			$module=$this->data['modules'][$i]['caption'];
			for ($j=0;$j<count($this->data['modules'][$i]['forms']);$j++)
			{
				$LTable1->addElement(new Lable($Index));
				$LTable1->addElement(new Lable($module));
				$LTable1->addElement(new Lable($this->data['modules'][$i]['forms'][$j]['caption']));
				$LTable1->addElement(new Lable($this->data['modules'][$i]['forms'][$j]['name']));
				$AppR=new AppRooter('sfman','manageform');
				$AppR->addParameter(new UrlParameter("id",$this->data['modules'][$i]['forms'][$j]['id']));
				$LTable1->addElement(new link($AppR->getAbsoluteURL(),new Lable("ویرایش")));
				$LTable1->addElement(new Lable("حذف"));
				$Index++;
			}
		}
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>
