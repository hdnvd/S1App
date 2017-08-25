<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\html\link;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\CheckBox;
use core\CoreClasses\html\RadioBox;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\ComboBox;
use core\CoreClasses\html\FileUploadBox;
use core\CoreClasses\services\WidgetDesign;
use Modules\buysell\PublicClasses\CarGroups;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;

/**
*@author Hadi AmirNahavandi
*@creationDate 1395-12-20 - 2017-03-10 15:04
*@lastUpdate 1395-12-20 - 2017-03-10 15:04
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class compgroupWidget_Design extends WidgetDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	public function __construct()
	{
	}
	public function getBodyHTML($command=null)
	{

        $cg=new CarGroups();
        $groupName=$cg->getGroupName($this->Data['group']['id']);
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("buysell_compgroupWidget");
		$LTable1=new ListTable(1);
        for ($i=0;$i<count($this->Data['groups']);$i++)
        {
            $lbl=new Lable($this->Data['groups'][$i]['title']);
            $ar=new AppRooter($groupName,'complist');
            $ar->addParameter(new UrlParameter('g',$this->Data['groups'][$i]['id']));
            $lnk=new link($ar->getAbsoluteURL(),$lbl);
            $LTable1->addElement($lnk);
        }
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>