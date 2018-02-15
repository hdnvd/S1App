<?php
namespace Modules\shift\Forms;
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
        $divcount = new Div();
        $divcount2 = new Div();
        $divcount3 = new Div();
        $divcount4 = new Div();
        $divcount5 = new Div();


		$la=new Lable($this->Data[1]);
        $divcount->addElement($la);
        $divcount->setClass('count');
        $la2=new Lable($this->Data[2]);
        $divcount2->addElement($la2);
        $divcount2->setClass('count2');
        $la3=new Lable($this->Data[3]);
        $divcount3->addElement($la3);
        $divcount3->setClass('count3');
        $la4=new Lable($this->Data[4]);
        $divcount4->addElement($la4);
        $divcount4->setClass('count4');
        $la5=new Lable($this->Data[5]);
        $divcount5->addElement($la5);
        $divcount5->setClass('count5');

        $divlabl = new Div();
        $divlabl2 = new Div();
        $divlabl3 = new Div();
        $divlabl4 = new Div();
        $divlabl5 = new Div();

        $l=new Lable('تعداد شیفت صبح: ');
        $divlabl->addElement($l);
        $divlabl->setClass('labl');
        $l2=new Lable('تعداد شیفت ظهر: ');
        $divlabl2->addElement($l2);
        $divlabl2->setClass('labl2');
        $l3=new Lable('تعداد شیفت شب: ');
        $divlabl3->addElement($l3);
        $divlabl3->setClass('labl3');
        $l4=new Lable('تعداد مرخصی: ');
        $divlabl4->addElement($l4);
        $divlabl4->setClass('labl4');
        $l5=new Lable('تعداد شیفت صبح: ');
        $divlabl5->addElement($l5);
        $divlabl5->setClass('labl5');


		$LTable1=new Div();
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		$form->setClass('form-horizontal');

        $Page->addElement($divlabl);
		$Page->addElement($divcount);
        $Page->addElement($divlabl2);
        $Page->addElement($divcount2);
        $Page->addElement($divlabl3);
        $Page->addElement($divcount3);
        $Page->addElement($divlabl4);
        $Page->addElement($divcount4);
        $Page->addElement($divlabl5);
        $Page->addElement($divcount5);



    



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