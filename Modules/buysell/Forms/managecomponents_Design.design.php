<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\link;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\CheckBox;
use core\CoreClasses\html\RadioBox;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\ComboBox;
use core\CoreClasses\html\FileUploadBox;
use Modules\buysell\PublicClasses\CarGroups;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-02-23 - 2017-05-13 21:09
*@lastUpdate 1396-02-23 - 2017-05-13 21:09
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class managecomponents_Design extends FormDesign {
	private $Data;
    private $ListPage;
    private $ItemPage;
    private $adminMode=true;

    /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
        if($this->adminMode)
        {
            $this->ListPage="managecomponents";
            $this->ItemPage="managecomponent";
        }
        else
        {
            $this->ListPage="manageusercomponents";
            $this->ItemPage="manageusercomponent";
        }
    }
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
		$Page->setId("buysell_managecomponents");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
		$PageTitlePart->addElement(new Lable("مدیریت قطعات"));
		$Page->addElement($PageTitlePart);
		$MessagePart=new Div();
		$MessagePart->setClass("sweet_messagepart");
		$MessagePart->addElement(new Lable($this->getMessage()));
		$Page->addElement($MessagePart);
		$addUrl=new AppRooter($groupName,$this->ItemPage);
		$LblAdd=new Lable("افزودن آگهی جدید");
		$lnkAdd=new link($addUrl->getAbsoluteURL(),$LblAdd);
		$lnkAdd->setClass("linkbutton");
        $lnkAdd->setId("addcomponentlink");
		$Page->addElement($lnkAdd);
		$LTable1=new ListTable(3);
		$LTable1->setClass("componentlist");
		$LTable1->addElement(new Lable('#'));
		$LTable1->setLastElementClass("listtitle");
		$LTable1->addElement(new Lable('عنوان'));
        $LTable1->setLastElementClass("listtitle");
		$LTable1->addElement(new Lable('عملیات'));
        $LTable1->setLastElementClass("listtitle");
		for($i=0;$i<count($this->Data['data']);$i++){
			$url=new AppRooter($groupName,$this->ItemPage);
			$url->addParameter(new UrlParameter('id',$this->Data['data'][$i]['id']));
			$delurl=new AppRooter($groupName,$this->ListPage);
			$delurl->addParameter(new UrlParameter('id',$this->Data['data'][$i]['id']));
			$delurl->addParameter(new UrlParameter('delete',1));
			if($this->Data['data'][$i]['title']=="")
				$this->Data['data'][$i]['title']='******************';
			$lbTit[$i]=new Lable($this->Data['data'][$i]['title']);
			$liTit[$i]=new link($url->getAbsoluteURL(),$lbTit[$i]);
			$lbDel[$i]=new Lable('حذف');
			$liDel[$i]=new link($delurl->getAbsoluteURL(),$lbDel[$i]);
			$LTable1->addElement(new Lable($i+1));
            $LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($liTit[$i]);
            $LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($liDel[$i]);
            $LTable1->setLastElementClass("listcontent");
            $LTable1->setLastElementID("deletelink");
		}
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>