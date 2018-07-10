<?php
namespace Modules\onlineclass\Forms;
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
*@creationDate 1396-07-25 - 2017-10-17 21:18
*@lastUpdate 1396-07-25 - 2017-10-17 21:18
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class course_Design extends FormDesign {
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
	private $start_date;
	/** @var lable */
	private $end_date;
	/** @var lable */
	private $tutor_fid;
	/** @var lable */
	private $price;
	/** @var lable */
	private $description;
	/** @var lable */
	private $level_fid;
	public function __construct()
	{

		/******* title *******/
		$this->title= new lable("title");

		/******* start_date *******/
		$this->start_date= new lable("start_date");

		/******* end_date *******/
		$this->end_date= new lable("end_date");

		/******* tutor_fid *******/
		$this->tutor_fid= new lable("tutor_fid");

		/******* price *******/
		$this->price= new lable("price");

		/******* description *******/
		$this->description= new lable("description");

		/******* level_fid *******/
		$this->level_fid= new lable("level_fid");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("onlineclass_course");
		$Page->addElement($this->getPageTitlePart("اطلاعات " . $this->Data['course']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		if (key_exists("course", $this->Data)){
			$this->setFieldCaption('title',$this->Data['course']->getFieldInfo('title')->getTitle());
			$this->title->setText($this->Data['course']->getTitle());
		}
		if (key_exists("course", $this->Data)){
			$this->setFieldCaption('start_date',$this->Data['course']->getFieldInfo('start_date')->getTitle());
			$start_date_SD=new SweetDate(true, true, 'Asia/Tehran');
			$start_date_Text=$start_date_SD->date("l d F Y",$this->Data['course']->getStart_date());
			$this->start_date->setText($start_date_Text);
		}
		if (key_exists("course", $this->Data)){
			$this->setFieldCaption('end_date',$this->Data['course']->getFieldInfo('end_date')->getTitle());
			$end_date_SD=new SweetDate(true, true, 'Asia/Tehran');
			$end_date_Text=$end_date_SD->date("l d F Y",$this->Data['course']->getEnd_date());
			$this->end_date->setText($end_date_Text);
		}
		if (key_exists("tutor_fid", $this->Data)){
			$this->setFieldCaption('tutor_fid',$this->Data['course']->getFieldInfo('tutor_fid')->getTitle());
			$this->tutor_fid->setText($this->Data['tutor_fid']->getID());
		}
		if (key_exists("course", $this->Data)){
			$this->setFieldCaption('price',$this->Data['course']->getFieldInfo('price')->getTitle());
			$this->price->setText($this->Data['course']->getPrice());
		}
		if (key_exists("course", $this->Data)){
			$this->setFieldCaption('description',$this->Data['course']->getFieldInfo('description')->getTitle());
			$this->description->setText($this->Data['course']->getDescription());
		}
		if (key_exists("level_fid", $this->Data)){
			$this->setFieldCaption('level_fid',$this->Data['course']->getFieldInfo('level_fid')->getTitle());
			$this->level_fid->setText($this->Data['level_fid']->getID());
		}
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getInfoRowCode($this->title,$this->getFieldCaption('title')));
		$LTable1->addElement($this->getInfoRowCode($this->start_date,$this->getFieldCaption('start_date')));
		$LTable1->addElement($this->getInfoRowCode($this->end_date,$this->getFieldCaption('end_date')));
		$LTable1->addElement($this->getInfoRowCode($this->tutor_fid,$this->getFieldCaption('tutor_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->price,$this->getFieldCaption('price')));
		$LTable1->addElement($this->getInfoRowCode($this->description,$this->getFieldCaption('description')));
		$LTable1->addElement($this->getInfoRowCode($this->level_fid,$this->getFieldCaption('level_fid')));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>