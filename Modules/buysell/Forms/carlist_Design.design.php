<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\html\Image;
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
use Modules\buysell\Entity\buysell_carEntity;
use Modules\buysell\PublicClasses\CarGroups;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-03-31 - 2017-06-21 02:02
*@lastUpdate 1396-03-31 - 2017-06-21 02:02
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class carlist_Design extends FormDesign {
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
		$Page->setId("buysell_carlist");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
        $PageTitlePart->addElement(new Lable("صفحه اصلی > فهرست خودرو ها"));
		$Page->addElement($PageTitlePart);
		$MessagePart=new Div();
		$MessagePart->setClass("sweet_messagepart");
		$MessagePart->addElement(new Lable($this->getMessage()));
		$Page->addElement($MessagePart);
		if(count($this->Data['data'])==0)
		{
			if(isset($_GET['action']) && $_GET['action']=="btnSearch_Click")
				$PageTitlePart->addElement(new Lable("هیچ خودرویی با مشخصات وارد شده پیدا نشد."));
			else
				$PageTitlePart->addElement(new Lable("هیچ خودرویی برای نمایش وجود ندارد."));
		}
		$Div1=new Div();
		$Div1->setClass("list");
		for($i=0;$i<count($this->Data['data']);$i++){

		$innerDiv[$i]=new Div();
		$innerDiv[$i]->setClass("listitem");
			$url=new AppRooter($groupName,'car');
			$url->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
            $Price=$this->Data['data'][$i]->getPrice();
            $Title=$this->Data['cardata'][$i]['brand']->getTitle() . " " . $this->Data['cardata'][$i]['model']->getTitle();
//            $n=new buysell_carEntity();
//            $n->getWheretodate()
            $WheretoDate="محل ملاقات " . $this->Data['data'][$i]->getWheretodate();
            $Year="مدل " . $this->Data['data'][$i]->getMakedate();
            $BodyStatus=$this->Data['cardata'][$i]['bodystatus']->getTitle();
            $City=$this->Data['cardata'][$i]['city']->getTitle();
            //$="مدل " . $this->Data['data'][$i]->getMakedate();
            if($Price!="")
                $Price.=" ریال";
//			if($this->Data['data'][$i]->getDetails()=="")
//				$Title='******************';
            if($this->Data['cardata'][$i]['photos']!=null){
                $img[$i]=new Image(DEFAULT_PUBLICURL . $this->Data['cardata'][$i]['photos'][0]->getImg_flu());
            }
            else
            {
                $img[$i]=new Image(DEFAULT_PUBLICURL . "content/files/img/noimage.png");
            }
            $innerDiv[$i]->addElement($img[$i]);
			$lbTit[$i]=new Lable($Title);
			$liTit[$i]=new link($url->getAbsoluteURL(),$lbTit[$i]);
			$innerDiv[$i]->addElement($liTit[$i]);
            $lblYear[$i]=new Lable($Year);
            $innerDiv[$i]->addElement($lblYear[$i]);
            $lblBodyStatus[$i]=new Lable($BodyStatus);
            $innerDiv[$i]->addElement($lblBodyStatus[$i]);
            $lblCity[$i]=new Lable($City);
            $innerDiv[$i]->addElement($lblCity[$i]);
            $lblWheretoDate[$i]=new Lable($WheretoDate);
            $innerDiv[$i]->addElement($lblWheretoDate[$i]);
            $lbPrc[$i]=new Lable($Price);
            $lbPrc[$i]->setClass('carlistprice');
            $innerDiv[$i]->addElement($lbPrc[$i]);
			$Div1->addElement($innerDiv[$i]);
		}
		$Page->addElement($Div1);
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
				$RTR=new AppRooter($groupName,"carlist");
			else
			{
				$RTR=new AppRooter($groupName,"carlist");
				//$RTR->addParameter(new UrlParameter("g",$this->Data['groupid']));
			}
			$RTR->addParameter(new UrlParameter("pn",$i));
			$RTR->setAppendToCurrentParams(false);
			$lbl=new Lable($i);
			$lnk=new link($RTR->getAbsoluteURL(),$lbl);
			$div->addElement($lnk);
		}
		return $div;
	}

    public function getJSON()
    {
        $result=array();
            foreach ($this->Data['carmodel_fid'] as $item)
                array_push($result,["id"=>$item->getID(),"title"=>$item->getTitle()]);

        return json_encode($result);
    }
}
?>