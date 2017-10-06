<?php
namespace Modules\oras\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\services\baseHTMLElement;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\UList;
use core\CoreClasses\html\FormLabel;
use core\CoreClasses\html\UListElement;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\link;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DatePicker;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\Button;
use core\CoreClasses\html\CheckBox;
use core\CoreClasses\html\RadioBox;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\ComboBox;
use core\CoreClasses\html\FileUploadBox;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
use core\CoreClasses\SweetDate;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-12 - 2017-10-04 18:38
*@lastUpdate 1396-07-12 - 2017-10-04 18:38
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class manageemployees_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	private $adminMode=true;
    public function getAdminMode()
    {
        return $this->adminMode;
    }
        private $listPage;
    private $itemPage;
    /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
        if($adminMode==true)
        {
            $this->itemPage = 'manageemployee';
            $this->listPage = 'manageemployees';
        }
        else
        {
            $this->itemPage = 'manageuseremployee';
            $this->listPage = 'manageuseremployees';
        }
    }
	public function __construct()
	{
		parent::__construct();
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("oras_manageemployees");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['employee']->getTableTitle() . " ها"));
		$addUrl=new AppRooter('oras',$this->itemPage);
		$LblAdd=new Lable('افزودن کارمند جدید');
		$lnkAdd=new link($addUrl->getAbsoluteURL(),$LblAdd);
		$lnkAdd->setClass('linkbutton btn btn-primary');
		$lnkAdd->setGlyphiconClass('glyphicon glyphicon-plus');
		$lnkAdd->setId('addemployeelink');
		$Page->addElement($lnkAdd);
		$SearchUrl=new AppRooter('oras',$this->listPage);
		$SearchUrl->addParameter(new URLParameter('search',null));
		$LblSearch=new Lable('جستجو');
		$lnkSearch=new link($SearchUrl->getAbsoluteURL(),$LblSearch);
		$lnkSearch->setClass('linkbutton btn btn-primary');
		$lnkSearch->setGlyphiconClass('glyphicon glyphicon-search');
		$lnkSearch->setId('searchemployeelink');
		$Page->addElement($lnkSearch);
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$TableDiv=new Div();
		$TableDiv->setClass('table-responsive');
		$LTable1=new ListTable(8);
		$LTable1->setHeaderRowCount(1);
		$LTable1->setClass("table-striped managelist");
		$LTable1->addElement(new Lable('#'));
		$LTable1->setLastElementClass("listtitle");
		$LTable1->addElement(new Lable('نام'));
		$LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('نام خانوادگی'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('جنسیت'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('کد ملی'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('سمت فعلی'));
        $LTable1->setLastElementClass("listtitle");
        $LTable1->addElement(new Lable('بخش فعلی'));
        $LTable1->setLastElementClass("listtitle");
		$LTable1->addElement(new Lable('عملیات'));
		$LTable1->setLastElementClass("listtitle");
		for($i=0;$i<count($this->Data['data']);$i++){
			$url=new AppRooter('oras',$this->itemPage);
			$url->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));


			$Name=$this->Data['data'][$i]->getName();
			if($Name=="")
				$Name='- بدون نام -';
			$lbName[$i]=new Lable($Name);
			$liName[$i]=new link($url->getAbsoluteURL(),$lbName[$i]);


            $MelliCode=$this->Data['data'][$i]->getMellicode();
            if($MelliCode=="")
                $MelliCode='- بدون نام -';
            $lbMelliCode[$i]=new Lable($MelliCode);
            $liMelliCode[$i]=new link($url->getAbsoluteURL(),$lbMelliCode[$i]);

            $Family=$this->Data['data'][$i]->getFamily();
            if($Family=="")
                $Family='- بدون نام خانوادگی -';
            $lbFamily[$i]=new Lable($Family);
            $liFamily[$i]=new link($url->getAbsoluteURL(),$lbFamily[$i]);


            $Sex=$this->Data['data'][$i]->getIsmale();
            if($Sex=="1")
                $Sex='مرد';
            else
                $Sex='زن';
            $lbSex[$i]=new Lable($Sex);
            $liSex[$i]=new link($url->getAbsoluteURL(),$lbSex[$i]);

            $Place="";
            if(key_exists('place',$this->Data) && key_exists($i,$this->Data['place']))
                $Place=$this->Data['place'][$i]->getTitle();
            if($Place=="")
                $Place='- بدون بخش -';
            $lbEmployeePlace[$i]=new Lable($Place);
            $liEmployeePlace[$i]=new link($url->getAbsoluteURL(),$lbEmployeePlace[$i]);

            $Role="";
            if(key_exists('role',$this->Data) && key_exists($i,$this->Data['role']))
                $Role=$this->Data['role'][$i]->getTitle();
            if($Role=="")
                $Role='- بدون سمت -';
            $lbEmployeeRole[$i]=new Lable($Role);
            $liEmployeeRole[$i]=new link($url->getAbsoluteURL(),$lbEmployeeRole[$i]);

            $delurl=new AppRooter('oras',$this->listPage);
            $delurl->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
            $delurl->addParameter(new UrlParameter('delete',1));
			$lbDel[$i]=new Lable('حذف');
			$liDel[$i]=new link($delurl->getAbsoluteURL(),$lbDel[$i]);
			$liDel[$i]->setGlyphiconClass('glyphicon glyphicon-remove');
			$liDel[$i]->setClass('btn btn-danger');


            $Roleurl=new AppRooter('oras','manageemployeeroles');
            $Roleurl->addParameter(new UrlParameter('employeeid',$this->Data['data'][$i]->getID()));
            $lbRole[$i]=new Lable('پست ها');
            $liRole[$i]=new link($Roleurl->getAbsoluteURL(),$lbRole[$i]);
            $liRole[$i]->setGlyphiconClass('glyphicon glyphicon-briefcase');
            $liRole[$i]->setClass('btn btn-primary');

            $Recordurl=new AppRooter('oras','managerecords');
            $Recordurl->addParameter(new UrlParameter('employeeid',$this->Data['data'][$i]->getID()));
            $lbRecord[$i]=new Lable('گزارش ها');
            $liRecord[$i]=new link($Recordurl->getAbsoluteURL(),$lbRecord[$i]);
            $liRecord[$i]->setGlyphiconClass('glyphicon glyphicon-duplicate');
            $liRecord[$i]->setClass('btn btn-primary');

            $ViewURL=new AppRooter('oras','employee');
            $ViewURL->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
            $lbView[$i]=new Lable('مشاهده');
            $liView[$i]=new link($ViewURL->getAbsoluteURL(),$lbView[$i]);
            $liView[$i]->setGlyphiconClass('glyphicon glyphicon-eye-open');
            $liView[$i]->setClass('btn btn-primary');

			$operationDiv[$i]=new Div();
			$operationDiv[$i]->setClass('operationspart');
            $operationDiv[$i]->addElement($liRole[$i]);
            $operationDiv[$i]->addElement($liRecord[$i]);
            $operationDiv[$i]->addElement($liView[$i]);
			$operationDiv[$i]->addElement($liDel[$i]);

			$LTable1->addElement(new Lable($i+1));
			$LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($liName[$i]);
			$LTable1->setLastElementClass("listcontent");
            $LTable1->addElement($liFamily[$i]);
            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement($liSex[$i]);
            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement($liMelliCode[$i]);
            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement($liEmployeeRole[$i]);
            $LTable1->setLastElementClass("listcontent");
            $LTable1->addElement($liEmployeePlace[$i]);
            $LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($operationDiv[$i]);
			$LTable1->setLastElementClass("listcontent");
		}
		$TableDiv->addElement($LTable1);
		$Page->addElement($TableDiv);
		$Page->addElement($this->getPaginationPart($this->Data['pagecount'],"oras",$this->listPage));
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>