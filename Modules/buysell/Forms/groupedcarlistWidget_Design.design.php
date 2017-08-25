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
class groupedcarlistWidget_Design extends WidgetDesign {
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
		$Page->setId("buysell_groupedcomplistWidget");
		$LTable1=new Div();
        for ($i=0;$i<count($this->Data['data']);$i++)
        {
            $tmb=null;
            if($this->Data['cardata'][$i]['photos']==null || $this->Data['cardata'][$i]['photos'][0]->getThumburl()=="")
            {

                $tmb=THEMEURL . "images/car.jpg";
            }
            else
            {
                $tmb=$this->Data['cardata'][$i]['photos'][0]->getThumburl();

            }
			$Item=new Div();
            $img=new Image($tmb);
            $Title=$this->Data['cardata'][$i]['brand']->getTitle() . " " . $this->Data['cardata'][$i]['model']->getTitle() . " مدل " . $this->Data['data'][$i]->getMakedate();
//
            $lbl=new Lable($Title);
            $ar=new AppRooter($groupName,'car');
            $ar->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
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