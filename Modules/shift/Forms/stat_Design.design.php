<?php
namespace Modules\shift\Forms;
use core\CoreClasses\html\htmlcode;
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
*@creationDate 1396-10-27 - 2018-01-17 16:12
*@lastUpdate 1396-10-27 - 2018-01-17 16:12
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class stat_Design extends FormDesign {
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
    /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
    }
	public function __construct()
	{
	    parent::__construct();
	}

	public function getBodyHTML($command=null)
	{

		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("shift_importshiftdata");
		$Page->addElement($this->getPageTitlePart("خروجی آمار"));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
        $Colors=["'rgba(237,12,111,1)'","'rgba(100, 173, 60, 0.99)'","'rgba(251, 173, 41, 0.99)'","'rgba(251, 42, 255, 0.63)'","'rgba(13, 0, 255, 0.63)'","'rgba(0, 144, 255, 0.63)'","'rgba(0, 102, 84, 0.74)'","'rgba(95, 32, 0, 0.74)'","'rgba(92, 9, 66, 0.87)'","'rgba(240, 66, 0, 1)'","'rgba(0, 0, 0, 1)'","'rgba(0, 0, 80, 0.74)'","'rgba(47, 0, 56, 0.57)'","'rgba(237,12,111,1)'","'rgba(237,12,111,1)'","'rgba(237,12,111,1)'","'rgba(237,12,111,1)'","'rgba(237,12,111,1)'","'rgba(237,12,111,1)'","'rgba(237,12,111,1)'","'rgba(237,12,111,1)'"];

        $ChartHTML="<canvas id=\"myChart\" width=\"400\" height=\"400\" style='max-with:200px;'></canvas>
        <script lang=\"javascript\">var data = {
                datasets: [{";
        $AllCount1 = count($this->Data['shifttypes']);
                        $data="";
                        $Labels="";
                        $FillColors="";
                        for ($i = 0; $i < $AllCount1; $i++) {
                            $item=$this->Data['shifttypes'][$i];
                            if($data!="")
                                $data.=",";
                            $data.=$this->Data['counts'][$item->getId()];
                            if($Labels!="")
                                $Labels.=",";
                            $Labels.="'" . $item->getTitle() . "'";
                            if($FillColors!="")
                                $FillColors.=",";
//                            $FillColors.="'rgba(153, 102, 255, 0.2)'";
                            $FillColors.=$Colors[$i];

                        }
        $ChartHTML.="
                    data: [$data],
                    backgroundColor: [$FillColors],
                    }],";
        $ChartHTML.="labels: [ $Labels ],";
        $ChartHTML.="};
        var options={
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }};
            var ctx = document.getElementById(\"myChart\").getContext('2d');
            new Chart(ctx, {
                data: data,
                type: 'doughnut',
                options: options
            });</script>";
        $div=new Div();
        $div->setStyle('width:80%');
        $htmlElement=new htmlcode($ChartHTML);
        $div->addElement($htmlElement);
        $Page->addElement($div);
        $form=new SweetFrom("", "GET", $Page);
        $form->setClass('form-horizontal');
        return $form->getHTML();
	}

    /**
     * @return ComboBox
     */
    public function getDataType()
    {
        return $this->DataType;
    }
}
?>