<?php
namespace Modules\oras\Forms;
use core\CoreClasses\html\Image;
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
*@creationDate 1396-07-14 - 2017-10-06 01:14
*@lastUpdate 1396-07-14 - 2017-10-06 01:14
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class employee_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var lable */
	private $mellicode;
	/** @var lable */
	private $name;
	/** @var lable */
	private $family;
	/** @var lable */
	private $ismale;
	/** @var lable */
	private $phonenumber;
	/** @var Image */
	private $photo_flu;
    /** @var lable */
    private $points;
    /** @var lable */
    private $NegativePoints;
    /** @var lable */
    private $PositivePoints;
    /** @var lable */
    private $PostiveRecords;
    /** @var lable */
    private $NegativeRecords;
    /** @var lable */
    private $AllRecords;
	public function __construct()
	{

		/******* mellicode *******/
		$this->mellicode= new lable("mellicode");

		/******* name *******/
		$this->name= new lable("name");

		/******* family *******/
		$this->family= new lable("family");

		/******* ismale *******/
		$this->ismale= new lable("ismale");

		/******* phonenumber *******/
		$this->phonenumber= new lable("phonenumber");

        /******* points *******/
        $this->points= new lable("points");
        /******* points *******/
        $this->NegativePoints= new lable("NegativePoints");
        /******* points *******/
        $this->PositivePoints= new lable("PositivePoints");
        /******* points *******/
        $this->PostiveRecords= new lable("PostiveRecords");
        /******* points *******/
        $this->NegativeRecords= new lable("NegativeRecords");
        /******* points *******/
        $this->AllRecords= new lable("AllRecords");

		/******* photo_flu *******/
		$this->photo_flu= new Image('');
        $this->photo_flu->setId('profilepicture');
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("oras_employee");
		$Page->addElement($this->getPageTitlePart("اطلاعات " . $this->Data['employee']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		if (key_exists("employee", $this->Data)){
			$this->setFieldCaption('mellicode',$this->Data['employee']->getFieldInfo('mellicode')->getTitle());
			$this->mellicode->setText($this->Data['employee']->getMellicode());
		}
        if (key_exists("employee", $this->Data)){
            $this->setFieldCaption('points',"جمع امتیازات");
            $this->points->setText($this->Data['employeetotalpoints']);
            $this->setFieldCaption('NegativePoints'," جمع امتیازات منفی");
            $this->NegativePoints->setText($this->Data['employeetotalnegativepoints']);
            $this->setFieldCaption('PositivePoints'," جمع امتیازات مثبت");
            $this->PositivePoints->setText($this->Data['employeetotalpositivepoints']);
            $this->setFieldCaption('PostiveRecords',"تعداد گزارشات تشویقی");
            $this->PostiveRecords->setText($this->Data['employeetotalpositiverecords']);
            $this->setFieldCaption('NegativeRecords',"تعداد گزارشات تنبیهی");
            $this->NegativeRecords->setText($this->Data['employeetotalnegativerecords']);
            $this->setFieldCaption('AllRecords',"تعداد کل گزارشات");
            $this->AllRecords->setText($this->Data['employeetotalallrecords']);
        }
		if (key_exists("employee", $this->Data)){
			$this->setFieldCaption('name',$this->Data['employee']->getFieldInfo('name')->getTitle());
			$this->name->setText($this->Data['employee']->getName());
		}
		if (key_exists("employee", $this->Data)){
			$this->setFieldCaption('family',$this->Data['employee']->getFieldInfo('family')->getTitle());
			$this->family->setText($this->Data['employee']->getFamily());
		}
		if (key_exists("employee", $this->Data)){
			$this->setFieldCaption('ismale',$this->Data['employee']->getFieldInfo('ismale')->getTitle());
			$ismaleTitle='زن';
			if($this->Data['employee']->getIsmale()==1)
				$ismaleTitle='مرد';
			$this->ismale->setText($ismaleTitle);
		}
		if (key_exists("employee", $this->Data)){
			$this->setFieldCaption('phonenumber',$this->Data['employee']->getFieldInfo('phonenumber')->getTitle());
			$this->phonenumber->setText($this->Data['employee']->getPhonenumber());
		}
		if (key_exists("employee", $this->Data)){
			$this->setFieldCaption('photo_flu',$this->Data['employee']->getFieldInfo('photo_flu')->getTitle());
			if($this->Data['employee']->getPhoto_flu()!="")
			    $this->photo_flu->setUrl(DEFAULT_PUBLICURL . $this->Data['employee']->getPhoto_flu());
			else
                $this->photo_flu->setUrl(DEFAULT_PUBLICURL . "content/files/oras/profile.png");
		}
		$LTable1=new Div();
		$LTable1->setClass("formtable");
        $LTable1->addElement($this->getInfoRowCode($this->photo_flu,$this->getFieldCaption('photo_flu')));
		$LTable1->addElement($this->getInfoRowCode($this->name,$this->getFieldCaption('name')));
		$LTable1->addElement($this->getInfoRowCode($this->family,$this->getFieldCaption('family')));
		$LTable1->addElement($this->getInfoRowCode($this->ismale,$this->getFieldCaption('ismale')));
        $LTable1->addElement($this->getInfoRowCode($this->mellicode,$this->getFieldCaption('mellicode')));
		$LTable1->addElement($this->getInfoRowCode($this->phonenumber,$this->getFieldCaption('phonenumber')));
        $LTable1->addElement($this->getInfoRowCode($this->points,$this->getFieldCaption('points')));
        $LTable1->addElement($this->getInfoRowCode($this->NegativePoints,$this->getFieldCaption('NegativePoints')));
        $LTable1->addElement($this->getInfoRowCode($this->PositivePoints,$this->getFieldCaption('PositivePoints')));
        $LTable1->addElement($this->getInfoRowCode($this->PostiveRecords,$this->getFieldCaption('PostiveRecords')));
        $LTable1->addElement($this->getInfoRowCode($this->NegativeRecords,$this->getFieldCaption('NegativeRecords')));
        $LTable1->addElement($this->getInfoRowCode($this->AllRecords,$this->getFieldCaption('AllRecords')));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>