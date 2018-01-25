<?php
namespace Modules\iribfinance\Forms;
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
*@creationDate 1396-11-05 - 2018-01-25 18:27
*@lastUpdate 1396-11-05 - 2018-01-25 18:27
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class programestimation_Design extends FormDesign {
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
	private $department_fid;
	/** @var lable */
	private $class_fid;
	/** @var lable */
	private $programmaketype_fid;
	/** @var lable */
	private $totalprogramcount;
	/** @var lable */
	private $timeperprogram;
	/** @var lable */
	private $is_haslegalproblem;
	/** @var lable */
	private $approval_date;
	/** @var lable */
	private $end_date;
	/** @var lable */
	private $add_date;
	/** @var lable */
	private $producer_employee_fid;
	/** @var lable */
	private $executor_employee_fid;
	/** @var lable */
	private $paycenter_fid;
	/** @var lable */
	private $makergroup_paycenter_fid;
	public function __construct()
	{

		/******* title *******/
		$this->title= new lable("title");

		/******* department_fid *******/
		$this->department_fid= new lable("department_fid");

		/******* class_fid *******/
		$this->class_fid= new lable("class_fid");

		/******* programmaketype_fid *******/
		$this->programmaketype_fid= new lable("programmaketype_fid");

		/******* totalprogramcount *******/
		$this->totalprogramcount= new lable("totalprogramcount");

		/******* timeperprogram *******/
		$this->timeperprogram= new lable("timeperprogram");

		/******* is_haslegalproblem *******/
		$this->is_haslegalproblem= new lable("is_haslegalproblem");

		/******* approval_date *******/
		$this->approval_date= new lable("approval_date");

		/******* end_date *******/
		$this->end_date= new lable("end_date");

		/******* add_date *******/
		$this->add_date= new lable("add_date");

		/******* producer_employee_fid *******/
		$this->producer_employee_fid= new lable("producer_employee_fid");

		/******* executor_employee_fid *******/
		$this->executor_employee_fid= new lable("executor_employee_fid");

		/******* paycenter_fid *******/
		$this->paycenter_fid= new lable("paycenter_fid");

		/******* makergroup_paycenter_fid *******/
		$this->makergroup_paycenter_fid= new lable("makergroup_paycenter_fid");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("iribfinance_programestimation");
		$Page->addElement($this->getPageTitlePart("اطلاعات " . $this->Data['programestimation']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		if (key_exists("programestimation", $this->Data)){
			$this->setFieldCaption('title',$this->Data['programestimation']->getFieldInfo('title')->getTitle());
			$this->title->setText($this->Data['programestimation']->getTitle());
			$this->setFieldCaption('department_fid',$this->Data['programestimation']->getFieldInfo('department_fid')->getTitle());
			$this->department_fid->setText($this->Data['department_fid']->getID());
			$this->setFieldCaption('class_fid',$this->Data['programestimation']->getFieldInfo('class_fid')->getTitle());
			$this->class_fid->setText($this->Data['class_fid']->getID());
			$this->setFieldCaption('programmaketype_fid',$this->Data['programestimation']->getFieldInfo('programmaketype_fid')->getTitle());
			$this->programmaketype_fid->setText($this->Data['programmaketype_fid']->getID());
			$this->setFieldCaption('totalprogramcount',$this->Data['programestimation']->getFieldInfo('totalprogramcount')->getTitle());
			$this->totalprogramcount->setText($this->Data['programestimation']->getTotalprogramcount());
			$this->setFieldCaption('timeperprogram',$this->Data['programestimation']->getFieldInfo('timeperprogram')->getTitle());
			$this->timeperprogram->setText($this->Data['programestimation']->getTimeperprogram());
			$this->setFieldCaption('is_haslegalproblem',$this->Data['programestimation']->getFieldInfo('is_haslegalproblem')->getTitle());
			$is_haslegalproblemTitle='No';
			if($this->Data['programestimation']->getIs_haslegalproblem()==1)
				$is_haslegalproblemTitle='Yes';
			$this->is_haslegalproblem->setText($is_haslegalproblemTitle);
			$this->setFieldCaption('approval_date',$this->Data['programestimation']->getFieldInfo('approval_date')->getTitle());
			$approval_date_SD=new SweetDate(true, true, 'Asia/Tehran');
			$approval_date_Text=$approval_date_SD->date("l d F Y",$this->Data['programestimation']->getApproval_date());
			$this->approval_date->setText($approval_date_Text);
			$this->setFieldCaption('end_date',$this->Data['programestimation']->getFieldInfo('end_date')->getTitle());
			$end_date_SD=new SweetDate(true, true, 'Asia/Tehran');
			$end_date_Text=$end_date_SD->date("l d F Y",$this->Data['programestimation']->getEnd_date());
			$this->end_date->setText($end_date_Text);
			$this->setFieldCaption('add_date',$this->Data['programestimation']->getFieldInfo('add_date')->getTitle());
			$add_date_SD=new SweetDate(true, true, 'Asia/Tehran');
			$add_date_Text=$add_date_SD->date("l d F Y",$this->Data['programestimation']->getAdd_date());
			$this->add_date->setText($add_date_Text);
			$this->setFieldCaption('producer_employee_fid',$this->Data['programestimation']->getFieldInfo('producer_employee_fid')->getTitle());
			$this->producer_employee_fid->setText($this->Data['producer_employee_fid']->getID());
			$this->setFieldCaption('executor_employee_fid',$this->Data['programestimation']->getFieldInfo('executor_employee_fid')->getTitle());
			$this->executor_employee_fid->setText($this->Data['executor_employee_fid']->getID());
			$this->setFieldCaption('paycenter_fid',$this->Data['programestimation']->getFieldInfo('paycenter_fid')->getTitle());
			$this->paycenter_fid->setText($this->Data['paycenter_fid']->getID());
			$this->setFieldCaption('makergroup_paycenter_fid',$this->Data['programestimation']->getFieldInfo('makergroup_paycenter_fid')->getTitle());
			$this->makergroup_paycenter_fid->setText($this->Data['makergroup_paycenter_fid']->getID());
		}
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getInfoRowCode($this->title,$this->getFieldCaption('title')));
		$LTable1->addElement($this->getInfoRowCode($this->department_fid,$this->getFieldCaption('department_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->class_fid,$this->getFieldCaption('class_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->programmaketype_fid,$this->getFieldCaption('programmaketype_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->totalprogramcount,$this->getFieldCaption('totalprogramcount')));
		$LTable1->addElement($this->getInfoRowCode($this->timeperprogram,$this->getFieldCaption('timeperprogram')));
		$LTable1->addElement($this->getInfoRowCode($this->is_haslegalproblem,$this->getFieldCaption('is_haslegalproblem')));
		$LTable1->addElement($this->getInfoRowCode($this->approval_date,$this->getFieldCaption('approval_date')));
		$LTable1->addElement($this->getInfoRowCode($this->end_date,$this->getFieldCaption('end_date')));
		$LTable1->addElement($this->getInfoRowCode($this->add_date,$this->getFieldCaption('add_date')));
		$LTable1->addElement($this->getInfoRowCode($this->producer_employee_fid,$this->getFieldCaption('producer_employee_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->executor_employee_fid,$this->getFieldCaption('executor_employee_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->paycenter_fid,$this->getFieldCaption('paycenter_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->makergroup_paycenter_fid,$this->getFieldCaption('makergroup_paycenter_fid')));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	public function getJSON()
	{
		parent::getJSON();
		if (key_exists("programestimation", $this->Data)){
			$Result=$this->Data['programestimation']->GetArray();
			return json_encode($Result);
		}
		return json_encode(array());
	}
}
?>