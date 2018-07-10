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
*@creationDate 1396-11-05 - 2018-01-25 18:01
*@lastUpdate 1396-11-05 - 2018-01-25 18:01
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class programestimationemployee_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var lable */
	private $employee_fid;
	/** @var lable */
	private $programestimation_fid;
	/** @var lable */
	private $employmenttype_fid;
	/** @var lable */
	private $totalwork;
	/** @var lable */
	private $workunit_fid;
	public function __construct()
	{

		/******* employee_fid *******/
		$this->employee_fid= new lable("employee_fid");

		/******* programestimation_fid *******/
		$this->programestimation_fid= new lable("programestimation_fid");

		/******* employmenttype_fid *******/
		$this->employmenttype_fid= new lable("employmenttype_fid");

		/******* totalwork *******/
		$this->totalwork= new lable("totalwork");

		/******* workunit_fid *******/
		$this->workunit_fid= new lable("workunit_fid");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("iribfinance_programestimationemployee");
		$Page->addElement($this->getPageTitlePart("اطلاعات " . $this->Data['programestimationemployee']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		if (key_exists("programestimationemployee", $this->Data)){
			$this->setFieldCaption('employee_fid',$this->Data['programestimationemployee']->getFieldInfo('employee_fid')->getTitle());
			$this->employee_fid->setText($this->Data['employee_fid']->getID());
			$this->setFieldCaption('programestimation_fid',$this->Data['programestimationemployee']->getFieldInfo('programestimation_fid')->getTitle());
			$this->programestimation_fid->setText($this->Data['programestimation_fid']->getID());
			$this->setFieldCaption('employmenttype_fid',$this->Data['programestimationemployee']->getFieldInfo('employmenttype_fid')->getTitle());
			$this->employmenttype_fid->setText($this->Data['employmenttype_fid']->getID());
			$this->setFieldCaption('totalwork',$this->Data['programestimationemployee']->getFieldInfo('totalwork')->getTitle());
			$this->totalwork->setText($this->Data['programestimationemployee']->getTotalwork());
			$this->setFieldCaption('workunit_fid',$this->Data['programestimationemployee']->getFieldInfo('workunit_fid')->getTitle());
			$this->workunit_fid->setText($this->Data['workunit_fid']->getID());
		}
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getInfoRowCode($this->employee_fid,$this->getFieldCaption('employee_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->programestimation_fid,$this->getFieldCaption('programestimation_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->employmenttype_fid,$this->getFieldCaption('employmenttype_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->totalwork,$this->getFieldCaption('totalwork')));
		$LTable1->addElement($this->getInfoRowCode($this->workunit_fid,$this->getFieldCaption('workunit_fid')));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	public function getJSON()
	{
		parent::getJSON();
		if (key_exists("programestimationemployee", $this->Data)){
			$Result=$this->Data['programestimationemployee']->GetArray();
			return json_encode($Result);
		}
		return json_encode(array());
	}
}
?>