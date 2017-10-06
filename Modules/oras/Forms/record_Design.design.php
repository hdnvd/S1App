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
*@creationDate 1396-07-12 - 2017-10-04 03:03
*@lastUpdate 1396-07-12 - 2017-10-04 03:03
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class record_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var lable */
	private $title;
	/** @var lable */
	private $occurance_date;
	/** @var lable */
	private $description;
	/** @var lable */
	private $shifttype_fid;
	/** @var lable */
	private $recordtype_fid;
	/** @var lable */
	private $employee_fid;
	/** @var lable */
	private $place_fid;
	/** @var lable */
	private $registration_time;
	private $Files;
	/** @var lable */
	private $file1_flu;
	/** @var lable */
	private $file2_flu;
	/** @var lable */
	private $file3_flu;
	/** @var lable */
	private $file4_flu;
	public function __construct()
	{
        $this->Files=array();
		/******* title *******/
		$this->title= new lable("title");

		/******* occurance_date *******/
		$this->occurance_date= new lable("occurance_date");

		/******* description *******/
		$this->description= new lable("description");

		/******* shifttype_fid *******/
		$this->shifttype_fid= new lable("shifttype_fid");

		/******* recordtype_fid *******/
		$this->recordtype_fid= new lable("recordtype_fid");

		/******* employee_fid *******/
		$this->employee_fid= new lable("employee_fid");

		/******* place_fid *******/
		$this->place_fid= new lable("place_fid");

		/******* registration_time *******/
		$this->registration_time= new lable("registration_time");

		/******* file1_flu *******/
		$this->file1_flu= new lable("file1_flu");

		/******* file2_flu *******/
		$this->file2_flu= new lable("file2_flu");

		/******* file3_flu *******/
		$this->file3_flu= new lable("file3_flu");

		/******* file4_flu *******/
		$this->file4_flu= new lable("file4_flu");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("oras_record");
		$Page->addElement($this->getPageTitlePart("اطلاعات " . $this->Data['record']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		if (key_exists("record", $this->Data)){
			$this->setFieldCaption('title',$this->Data['record']->getFieldInfo('title')->getTitle());
			$this->title->setText($this->Data['record']->getTitle());
		}
		if (key_exists("record", $this->Data)){
			$this->setFieldCaption('occurance_date',$this->Data['record']->getFieldInfo('occurance_date')->getTitle());
			$occurance_date_SD=new SweetDate();
			$occurance_date_Text=$occurance_date_SD->date("l d F Y",$this->Data['record']->getOccurance_date());
			$this->occurance_date->setText($occurance_date_Text);
		}
		if (key_exists("record", $this->Data)){
			$this->setFieldCaption('description',$this->Data['record']->getFieldInfo('description')->getTitle());
			$this->description->setText($this->Data['record']->getDescription());
		}
		if (key_exists("shifttype_fid", $this->Data)){
			$this->setFieldCaption('shifttype_fid',$this->Data['record']->getFieldInfo('shifttype_fid')->getTitle());
			$this->shifttype_fid->setText($this->Data['shifttype_fid']->getTitle());
		}
		if (key_exists("recordtype_fid", $this->Data)){
			$this->setFieldCaption('recordtype_fid',$this->Data['record']->getFieldInfo('recordtype_fid')->getTitle());
			$this->recordtype_fid->setText($this->Data['recordtype_fid']->getTitle());
		}
		if (key_exists("employee_fid", $this->Data)){
			$this->setFieldCaption('employee_fid',$this->Data['record']->getFieldInfo('employee_fid')->getTitle());
            $SexStart="آقای";
            if($this->Data['employee_fid']->getIsmale()=="0")
                $SexStart="خانم";
			$this->employee_fid->setText($SexStart . " " .$this->Data['employee_fid']->getName()  ." ". $this->Data['employee_fid']->getFamily() . " به شماره ملی " . $this->Data['employee_fid']->getMellicode());
		}
		if (key_exists("place_fid", $this->Data)){
			$this->setFieldCaption('place_fid',$this->Data['record']->getFieldInfo('place_fid')->getTitle());
			$this->place_fid->setText($this->Data['place_fid']->getTitle());
		}
		if (key_exists("record", $this->Data)){
			$this->setFieldCaption('registration_time',$this->Data['record']->getFieldInfo('registration_time')->getTitle());

            date_default_timezone_set("UTC");
			$registration_time_SD=new SweetDate(true, true, 'Asia/Tehran');
			$registration_time_Text=$registration_time_SD->date("H:i l d F Y ",$this->Data['record']->getRegistration_time());
			$this->registration_time->setText($registration_time_Text);
		}
		if (key_exists("record", $this->Data)){
			$fl=$this->Data['record']->getFile1_flu();
			if($fl!="")
                array_push($this->Files,['url'=>DEFAULT_PUBLICURL . $fl]);

            $fl2=$this->Data['record']->getFile2_flu();
            if($fl2!="")
                array_push($this->Files,['url'=>DEFAULT_PUBLICURL . $fl2]);


            $fl3=$this->Data['record']->getFile3_flu();
            if($fl3!="")
                array_push($this->Files,['url'=>DEFAULT_PUBLICURL . $fl3]);


            $fl4=$this->Data['record']->getFile4_flu();
            if($fl4!="")
                array_push($this->Files,['url'=>DEFAULT_PUBLICURL . $fl4]);

		}

		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getInfoRowCode($this->title,$this->getFieldCaption('title')));
		$LTable1->addElement($this->getInfoRowCode($this->occurance_date,$this->getFieldCaption('occurance_date')));
		$LTable1->addElement($this->getInfoRowCode($this->description,$this->getFieldCaption('description')));
		$LTable1->addElement($this->getInfoRowCode($this->shifttype_fid,$this->getFieldCaption('shifttype_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->recordtype_fid,$this->getFieldCaption('recordtype_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->employee_fid,$this->getFieldCaption('employee_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->place_fid,$this->getFieldCaption('place_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->registration_time,$this->getFieldCaption('registration_time')));
		$FilesDiv=new Div();
		$FilesDiv->setId('filespart');
        for ($i = 0; $i < count($this->Files); $i++) {
            $img[$i]=new Image(DEFAULT_PUBLICURL."content/files/oras/file.png");
            $imgLink[$i]=new link($this->Files[$i]['url'],$img[$i]);
            $FilesDiv->addElement($imgLink[$i]);
        }
        $LTable1->addElement($this->getInfoRowCode($FilesDiv,"فایل ها"));
        $Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>