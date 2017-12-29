<?php
namespace Modules\itsap\Forms;
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
*@creationDate 1396-09-29 - 2017-12-20 15:49
*@lastUpdate 1396-09-29 - 2017-12-20 15:49
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class servicerequest_Design extends FormDesign {
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
	private $servicetype_fid;
	/** @var lable */
	private $description;
	/** @var lable */
	private $priority;
	/** @var lable */
	private $file1_flu;
    /** @var lable */
    private $request_date;
    /** @var ComboBox */
    private $CmbState;
    /** @var SweetButton */
    private $btnChangeState;
	public function __construct()
	{

		/******* title *******/
		$this->title= new lable("title");

		/******* servicetype_fid *******/
		$this->servicetype_fid= new lable("servicetype_fid");

		/******* description *******/
		$this->description= new lable("description");

		/******* priority *******/
		$this->priority= new lable("priority");

		/******* file1_flu *******/
		$this->file1_flu= new lable("file1_flu");

		/******* request_date *******/
		$this->request_date= new lable("request_date");

		$this->CmbState=new ComboBox("cmbstate");
		$this->btnChangeState=new SweetButton(true,"تغییر وضعیت");
		$this->btnChangeState->setAction("btnChangeState");

	}

    /**
     * @return ComboBox
     */
    public function getCmbState()
    {
        return $this->CmbState;
    }
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("itsap_servicerequest");
		$Page->addElement($this->getPageTitlePart("اطلاعات " . $this->Data['servicerequest']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		if (key_exists("servicerequest", $this->Data)){
			$this->setFieldCaption('title',$this->Data['servicerequest']->getFieldInfo('title')->getTitle());
			$this->title->setText($this->Data['servicerequest']->getTitle());
			$this->setFieldCaption('servicetype_fid',$this->Data['servicerequest']->getFieldInfo('servicetype_fid')->getTitle());
			$this->servicetype_fid->setText($this->Data['servicetype_fid']->getTitle());
			$this->setFieldCaption('description',$this->Data['servicerequest']->getFieldInfo('description')->getTitle());
			$this->description->setText($this->Data['servicerequest']->getDescription());
			$this->setFieldCaption('priority',$this->Data['servicerequest']->getFieldInfo('priority')->getTitle());
			$this->priority->setText($this->Data['servicerequest']->getPriority());
			$this->setFieldCaption('file1_flu',$this->Data['servicerequest']->getFieldInfo('file1_flu')->getTitle());
			$this->file1_flu->setText($this->Data['servicerequest']->getFile1_flu());
			$this->setFieldCaption('request_date',$this->Data['servicerequest']->getFieldInfo('request_date')->getTitle());
			$request_date_SD=new SweetDate(true, true, 'Asia/Tehran');
			$request_date_Text=$request_date_SD->date("l d F Y",$this->Data['servicerequest']->getRequest_date());
			$this->request_date->setText($request_date_Text);
            $AllCount1 = count($this->Data['allstatus']);
            $curStatus=null;
            for ($i = 0; $i < $AllCount1; $i++) {
                $item=$this->Data['allstatus'][$i];
                $this->CmbState->addOption($item->getID(),$item->getTitle());
                if($item->getID()==$this->Data['currentstatusinfo']->getServicestatus_fid())
                {
                    $this->CmbState->setSelectedValue($item->getID());
                    $curStatus=$item;
                }
            }
		}
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getInfoRowCode($this->title,$this->getFieldCaption('title')));
		$LTable1->addElement($this->getInfoRowCode($this->servicetype_fid,$this->getFieldCaption('servicetype_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->description,$this->getFieldCaption('description')));
		$LTable1->addElement($this->getInfoRowCode($this->priority,$this->getFieldCaption('priority')));
		$LTable1->addElement($this->getInfoRowCode($this->file1_flu,$this->getFieldCaption('file1_flu')));
		$LTable1->addElement($this->getInfoRowCode($this->request_date,$this->getFieldCaption('request_date')));
		$Page->addElement($LTable1);

		$ChangeStatus=new Div();

        $ChangeStatus->addElement($this->CmbState);
        $ChangeStatus->addElement($this->btnChangeState);
        $Page->addElement($ChangeStatus);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	public function getJSON()
	{
		parent::getJSON();
		if (key_exists("servicerequest", $this->Data)){
			$Result=$this->Data['servicerequest']->GetArray();
			return json_encode($Result);
		}
		return json_encode(array());
	}
}
?>