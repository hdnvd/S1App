<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\html\Image;
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
use Modules\buysell\PublicClasses\CarGroups;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;

/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-27 - 2017-02-15 15:29
*@lastUpdate 1395-11-27 - 2017-02-15 15:29
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class complist_Design extends FormDesign {
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
		$Page->setId("buysell_complist");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
		if(count($this->Data['components'])==0)
        {
            if(isset($_GET['action']) && $_GET['action']=="btnSearch_Click")
                $PageTitlePart->addElement(new Lable("هیچ قطعه ای با مشخصات وارد شده پیدا نشد."));
            else
                $PageTitlePart->addElement(new Lable("هیچ قطعه ای برای نمایش وجود ندارد."));
        }
        else
        {
            $PageTitlePart->addElement(new Lable("فهرست قطعات"));
        }


		$Page->addElement($PageTitlePart);
		$MessagePart=new Div();
		$MessagePart->setClass("sweet_messagepart");
		$MessagePart->addElement(new Lable($this->getMessage()));
		$Page->addElement($MessagePart);
		$LTable1=new ListTable(1);
        $lst=new Div();
        for ($i=0;$i<count($this->Data['components']);$i++)
        {
            $com=$this->Data['components'][$i];
//            print_r($com);
            $item=new Div();
            $ar=new AppRooter($groupName,"comp");
            $ar->addParameter(new UrlParameter("id",$com['id']));
            if($com['photos'][0]['url']==null)
                $com['photos'][0]['url']="content/files/img/noimage.png";
            $img=new Image(DEFAULT_PUBLICURL . $com['photos'][0]['url']);
            $imglink=new link($ar->getAbsoluteURL(),$img);
            $lbltit=new Lable($com['title']);
            $lbltit->setClass('complisttitle');
            $dets="ساخت کشور " . $com['country']['name'];
            $lbldet=new Lable($dets);
            if($com['price']!="")
                $com['price'].=" ریال";
            $lblprc=new Lable($com['price']);
            $lblprc->setClass('complistprice');
            $item->addElement($imglink);
            $item->addElement($lbltit);
            $item->addElement($lbldet);
            $item->addElement($lblprc);

            $item->setClass('complistitem');
            $lst->addElement($item);
        }

        $Page->addElement($lst);
		$Page->addElement($this->getPaginationPart($this->Data['pagecount']));
        $form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	private function getPaginationPart($PageCount)
    {
        $cg=new CarGroups();
        $groupName=$cg->getGroupName($this->Data['group']['id']);
        $div=new Div();
        for($i=1;$i<=$PageCount;$i++)
        {
            $RTR=null;
            if(isset($_GET['action']) && $_GET['action']=="btnSearch_Click")
                $RTR=new AppRooter($groupName,"search");
            else
            {
                $RTR=new AppRooter($groupName,"complist");
                $RTR->addParameter(new UrlParameter("g",$this->Data['groupid']));
            }
            $RTR->addParameter(new UrlParameter("p",$i));
            $RTR->setAppendToCurrentParams(true);
            $lbl=new Lable($i);
            $lnk=new link($RTR->getAbsoluteURL(),$lbl);
            $div->addElement($lnk);
        }
        return $div;
    }
}
?>