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
*@creationDate 1396-11-05 - 2018-01-25 00:33
*@lastUpdate 1396-11-05 - 2018-01-25 00:33
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class shift_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var lable */
	private $shifttype_fid;
	/** @var lable */
	private $due_date;
	/** @var lable */
	private $register_date;
	/** @var lable */
	private $personel_fid;
	/** @var lable */
	private $bakhsh_fid;
	/** @var lable */
	private $role_fid;
	/** @var lable */
	private $inputfile_fid;
	public function __construct()
	{

		/******* shifttype_fid *******/
		$this->shifttype_fid= new lable("shifttype_fid");

		/******* due_date *******/
		$this->due_date= new lable("due_date");

		/******* register_date *******/
		$this->register_date= new lable("register_date");

		/******* personel_fid *******/
		$this->personel_fid= new lable("personel_fid");

		/******* bakhsh_fid *******/
		$this->bakhsh_fid= new lable("bakhsh_fid");

		/******* role_fid *******/
		$this->role_fid= new lable("role_fid");

		/******* inputfile_fid *******/
		$this->inputfile_fid= new lable("inputfile_fid");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("shift_shift");
		$Page->addElement($this->getPageTitlePart("اطلاعات " . $this->Data['shift']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		if (key_exists("shift", $this->Data)){
			$this->setFieldCaption('shifttype_fid',$this->Data['shift']->getFieldInfo('shifttype_fid')->getTitle());
			$this->shifttype_fid->setText($this->Data['shifttype_fid']->getID());
			$this->setFieldCaption('due_date',$this->Data['shift']->getFieldInfo('due_date')->getTitle());
			$due_date_SD=new SweetDate(true, true, 'Asia/Tehran');
			$due_date_Text=$due_date_SD->date("l d F Y",$this->Data['shift']->getDue_date());
			$this->due_date->setText($due_date_Text);
			$this->setFieldCaption('register_date',$this->Data['shift']->getFieldInfo('register_date')->getTitle());
			$register_date_SD=new SweetDate(true, true, 'Asia/Tehran');
			$register_date_Text=$register_date_SD->date("l d F Y",$this->Data['shift']->getRegister_date());
			$this->register_date->setText($register_date_Text);
			$this->setFieldCaption('personel_fid',$this->Data['shift']->getFieldInfo('personel_fid')->getTitle());
			$this->personel_fid->setText($this->Data['personel_fid']->getID());
			$this->setFieldCaption('bakhsh_fid',$this->Data['shift']->getFieldInfo('bakhsh_fid')->getTitle());
			$this->bakhsh_fid->setText($this->Data['bakhsh_fid']->getID());
			$this->setFieldCaption('role_fid',$this->Data['shift']->getFieldInfo('role_fid')->getTitle());
			$this->role_fid->setText($this->Data['role_fid']->getID());
			$this->setFieldCaption('inputfile_fid',$this->Data['shift']->getFieldInfo('inputfile_fid')->getTitle());
			$this->inputfile_fid->setText($this->Data['inputfile_fid']->getID());
		}
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getInfoRowCode($this->shifttype_fid,$this->getFieldCaption('shifttype_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->due_date,$this->getFieldCaption('due_date')));
		$LTable1->addElement($this->getInfoRowCode($this->register_date,$this->getFieldCaption('register_date')));
		$LTable1->addElement($this->getInfoRowCode($this->personel_fid,$this->getFieldCaption('personel_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->bakhsh_fid,$this->getFieldCaption('bakhsh_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->role_fid,$this->getFieldCaption('role_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->inputfile_fid,$this->getFieldCaption('inputfile_fid')));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	public function getJSON()
	{
		parent::getJSON();
		if (key_exists("shift", $this->Data)){
			$Result=$this->Data['shift']->GetArray();
			return json_encode($Result);
		}
		return json_encode(array());
	}
}
?>