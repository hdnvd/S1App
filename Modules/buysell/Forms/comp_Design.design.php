<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\html\Image;
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
/**
*@author Hadi AmirNahavandi
*@creationDate 1395-12-07 - 2017-02-25 18:45
*@lastUpdate 1395-12-07 - 2017-02-25 18:45
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class comp_Design extends FormDesign {
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
		$Page->setId("buysell_comp");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
		$PageTitlePart->addElement(new Lable("مشخصات کالا"));
		$Page->addElement($PageTitlePart);
		$MessagePart=new Div();
		$MessagePart->setClass("sweet_messagepart");
		$MessagePart->addElement(new Lable($this->getMessage()));
		$Page->addElement($MessagePart);
		$CompDet=new Div();
        $CompDet->setId("compphotobox");

        $comp=$this->Data['component'];
        $lblCity=new Lable($comp['city']);
        $lblTit=new Lable($comp['title']);
        $lblTit->setId("comptitle");
//        $CompDet->addElement($lblTit);

        $lblCarModel=new Lable($comp['carmodels'][0]['title']);
        $lblDetails=new Lable($comp['details']);
        $lblprice=new Lable($comp['price'] . " ریال");
        $lblprice->setId("compprice");
//        $CompDet->addElement($lblprice);



        $ustat="";
        switch ($comp['usestatus'])
        {
            case 0:
                $ustat="کارکرده";
                break;
            case 2:
                $ustat="اسقاطی";
                break;
            default :
                $ustat="نو";
        }
        $lblUseStatus=new Lable($ustat);
        $lblUseStatus->setId("compusestatus");
        $lblCountry=new Lable($comp['country']['name']);
        $lblCountry->setId("compcountry");
        $lblUser=new Lable($comp['user']->getName());
        $tels="";
        $user=$comp['user'];
        if($user->getTel()!="")
            $tels=$user->getTel();
        if($user->getMob()!=""){
            if($tels!="")
                $tels.=" - ";
            $tels.=$user->getMob();
        }
        $lblTel=new Lable($tels);
        $LTable1=new ListTable(2);
        $LTable1->addElement(new Lable("قیمت"));
        $LTable1->setLastElementClass("comp_prop_title");
        $LTable1->addElement($lblprice);
        $LTable1->setLastElementClass("comp_prop_value");
        $LTable1->addElement(new Lable("وضعیت"));
        $LTable1->setLastElementClass("comp_prop_title");
        $LTable1->addElement($lblUseStatus);
        $LTable1->setLastElementClass("comp_prop_value");
        $LTable1->addElement(new Lable("کشور سازنده"));
        $LTable1->setLastElementClass("comp_prop_title");
        $LTable1->addElement($lblCountry);
        $LTable1->setLastElementClass("comp_prop_value");
        $LTable1->addElement(new Lable("شهر"));
        $LTable1->setLastElementClass("comp_prop_title");
        $LTable1->addElement($lblCity);
        $LTable1->setLastElementClass("comp_prop_value");
        $LTable1->addElement(new Lable("مدل خودرو"));
        $LTable1->setLastElementClass("comp_prop_title");
        $LTable1->addElement($lblCarModel);
        $LTable1->setLastElementClass("comp_prop_value");
        $LTable1->addElement(new Lable("توضیحات"));
        $LTable1->setLastElementClass("comp_prop_title");
        $LTable1->setLastElementID("comp_details_title");
        $LTable1->addElement($lblDetails);
        $LTable1->setLastElementID("comp_details_value");
        $LTable1->setLastElementClass("comp_prop_value");
        $LTable1->addElement(new Lable("توسط"));
        $LTable1->setLastElementClass("comp_prop_title");
        $LTable1->addElement($lblUser);
        $LTable1->setLastElementClass("comp_prop_value");
        $LTable1->addElement(new Lable("تلفن"));
        $LTable1->setLastElementClass("comp_prop_title");
        $LTable1->addElement($lblTel);
        $LTable1->setLastElementClass("comp_prop_value");

        $Page->addElement($LTable1);
        for($i=0;$i<count($comp['photos']);$i++)
        {
            $pt=$comp['photos'][$i];
            $img=new Image(DEFAULT_PUBLICURL . $pt['url']);
            $CompDet->addElement($img);
        }
		$Page->addElement($CompDet);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>