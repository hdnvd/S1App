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
use core\CoreClasses\html\Image;
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
class groupedcomplistWidget_Design extends WidgetDesign {
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
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("buysell_groupedcomplistWidget");
		$LTable1=new Div();
        for ($i=0;$i<count($this->Data['components']);$i++)
        {
            if($this->Data['components'][$i]['photos'][0]['url']=="")
            {

                $this->Data['components'][$i]['photos'][0]['url']=THEMEURL . "images/car.jpg";
            }
			$Item=new Div();
            $img=new Image($this->Data['components'][$i]['photos'][0]['url']);
            $lbl=new Lable($this->Data['components'][$i]['title']);

            $cg=new CarGroups();
            $groupName[$i]=$cg->getGroupName($this->Data['components'][$i]['carmodels'][0]['cargroup_fid']);
            $ar=new AppRooter($groupName[$i],'comp');
            $ar->addParameter(new UrlParameter('id',$this->Data['components'][$i]['id']));
            $lnk=new link($ar->getAbsoluteURL(),$img);
            $lnk2=new link($ar->getAbsoluteURL(),$lbl);
			$lnk2->setId("groupedcompslidetitle".$i);
			$lnk2->setClass("groupedcompslidetitle");
			$Item->setClass("groupedcompslide");
			$Item->setId("compslide".$i);
            $Item->addElement($lnk2);
            $Item->addElement($lnk);
            $LTable1->addElement($Item);
            //$LTable1->setLastElementClass("complist_widget_item");
        }
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>