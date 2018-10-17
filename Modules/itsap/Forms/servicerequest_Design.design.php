<?php
namespace Modules\itsap\Forms;
use core\CoreClasses\html\Image;
use core\CoreClasses\html\TextArea;
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
*@creationDate 1397-01-15 - 2018-04-04 20:34
*@lastUpdate 1397-01-15 - 2018-04-04 20:34
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class servicerequest_Design extends FormDesign {
	protected $Data;
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
	private $unit_fid;
	/** @var lable */
	private $servicetype_fid;
	/** @var lable */
	private $description;
	/** @var lable */
	private $priority;
    /** @var Div */
    private $priorityImages;
	/** @var Image */
	private $file1_flu;
	/** @var lable */
	private $request_date;
	/** @var lable */
	private $devicetype_fid;
	/** @var Image */
	private $letterfile_flu;
	/** @var lable */
	private $securityacceptor_role_systemuser_fid;
	/** @var lable */
	private $letternumber;
	/** @var lable */
	private $letter_date;
    /** @var TextArea */
    private $TxtStatusMessage;

    /**
     * @return TextArea
     */
    public function getTxtStatusMessage()
    {
        return $this->TxtStatusMessage;
    }

    /**
     * @return TextArea
     */
    public function getTxtReferMessage()
    {
        return $this->TxtReferMessage;
    }

    /**
     * @return TextArea
     */
    public function getTxtAssignMessage()
    {
        return $this->TxtAssignMessage;
    }

    /**
     * @return ComboBox
     */
    public function getCmbState()
    {
        return $this->CmbState;
    }

    /**
     * @return ComboBox
     */
    public function getCMBTopUnits()
    {
        return $this->CMBTopUnits;
    }
    /** @var TextArea */
    private $TxtReferMessage;
    /** @var TextArea */
    private $TxtAssignMessage;
    /** @var ComboBox */
    private $CmbState;
    /** @var ComboBox */
    private $CMBTopUnits;

    /** @var ComboBox */
    private $CMBUnitEmployees;

    /** @var ComboBox */
    private $CMBPriorities;

    /**
     * @return ComboBox
     */
    public function getCMBPriorities()
    {
        return $this->CMBPriorities;
    }
    /** @var SweetButton */
    private $btnChangeState;

    /** @var SweetButton */
    private $btnChangePriority;
    /** @var SweetButton */
    private $btnRefer;
    /** @var SweetButton */
    private $btnAssign;

    /**
     * @return ComboBox
     */
    public function getCMBUnitEmployees()
    {
        return $this->CMBUnitEmployees;
    }

    /**
     * @return SweetButton
     */
    public function getBtnChangeState()
    {
        return $this->btnChangeState;
    }

    /**
     * @return SweetButton
     */
    public function getBtnRefer()
    {
        return $this->btnRefer;
    }

    /**
     * @return SweetButton
     */
    public function getBtnAssign()
    {
        return $this->btnAssign;
    }
	public function __construct()
	{

		/******* title *******/
		$this->title= new lable("title");

		/******* unit_fid *******/
		$this->unit_fid= new lable("unit_fid");

		/******* servicetype_fid *******/
		$this->servicetype_fid= new lable("servicetype_fid");

		/******* description *******/
		$this->description= new lable("description");

		/******* priority *******/
		$this->priority= new lable("priority");

		/******* file1_flu *******/
		$this->file1_flu= new Image("");

		/******* request_date *******/
		$this->request_date= new lable("request_date");

		/******* devicetype_fid *******/
		$this->devicetype_fid= new lable("devicetype_fid");

		/******* letterfile_flu *******/
		$this->letterfile_flu= new Image("");
		$this->letterfile_flu->setClass('letterimage');

		/******* securityacceptor_role_systemuser_fid *******/
		$this->securityacceptor_role_systemuser_fid= new lable("securityacceptor_role_systemuser_fid");

		/******* letternumber *******/
		$this->letternumber= new lable("letternumber");

		/******* letter_date *******/
		$this->letter_date= new lable("letter_date");

        $this->priorityImages=new Div();
        $this->priorityImages->setClass('priorityimagesbox');

        $this->CMBPriorities=new ComboBox("cmbpriorities");
        $this->btnChangePriority=new SweetButton(true,"تغییر اولویت");
        $this->btnChangePriority->setAction("btnChangePriority");
        $this->btnChangePriority->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
        $this->btnChangePriority->setClass("btn btn-primary");
        $this->CMBPriorities->setClass("form-control");


        $this->CmbState=new ComboBox("cmbstate");
        $this->btnChangeState=new SweetButton(true,"تغییر وضعیت");
        $this->btnChangeState->setAction("btnChangeState");
        $this->btnChangeState->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
        $this->btnChangeState->setClass("btn btn-primary");
        $this->CmbState->setClass("form-control");

        $this->CMBTopUnits=new ComboBox("cmbtopunits");
        $this->btnRefer=new SweetButton(true,"ارجاع");
        $this->btnRefer->setAction("btnRefer");
        $this->btnRefer->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
        $this->btnRefer->setClass("btn btn-primary");
        $this->CMBTopUnits->setClass("form-control");

        $this->CMBUnitEmployees=new ComboBox("CMBUnitEmployees");
        $this->btnAssign=new SweetButton(true,"تخصیص");
        $this->btnAssign->setAction("btnAssign");
        $this->btnAssign->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
        $this->btnAssign->setClass("btn btn-primary");
        $this->CMBUnitEmployees->setClass("form-control");

        $this->TxtStatusMessage=new TextArea('TxtStatusMessage');
        $this->TxtStatusMessage->setClass("form-control");
        $this->TxtReferMessage=new TextArea('txtrefermessage');
        $this->TxtReferMessage->setClass("form-control");
        $this->TxtAssignMessage=new TextArea('TxtAssignMessage');
        $this->TxtAssignMessage->setClass("form-control");


	}
	protected function getInfoPart()
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
            for($starindex=0;$starindex<$this->Data['servicerequest']->getPriority();$starindex++)
            {
                $img=new Image(DEFAULT_PUBLICURL . "content/files/img/star.png");
                $this->priorityImages->addElement($img);
            }
            $this->setFieldCaption('file1_flu',$this->Data['servicerequest']->getFieldInfo('file1_flu')->getTitle());
            $this->file1_flu->setUrl(DEFAULT_PUBLICURL . "content/files/img/folder.png");
            $this->file1_flu->setClass('datarowimage');
            $FileURL=$this->Data['servicerequest']->getFile1_flu();
            $this->setFieldCaption('request_date',$this->Data['servicerequest']->getFieldInfo('request_date')->getTitle());
            $request_date_SD=new SweetDate(true, true, 'Asia/Tehran');
            $request_date_Text=$request_date_SD->date("l d F Y",$this->Data['servicerequest']->getRequest_date());
            $this->request_date->setText($request_date_Text);
            $this->setFieldCaption('devicetype_fid',$this->Data['servicerequest']->getFieldInfo('devicetype_fid')->getTitle());
            $this->devicetype_fid->setText($this->Data['devicetype_fid']->getTitle());
            $this->setFieldCaption('letterfile_flu',$this->Data['servicerequest']->getFieldInfo('letterfile_flu')->getTitle());
            $this->letterfile_flu->setUrl(DEFAULT_PUBLICURL . $this->Data['servicerequest']->getLetterfile_flu());
            $this->setFieldCaption('letternumber',$this->Data['servicerequest']->getFieldInfo('letternumber')->getTitle());
            $this->letternumber->setText($this->Data['servicerequest']->getLetternumber());
            $this->setFieldCaption('letter_date',$this->Data['servicerequest']->getFieldInfo('letter_date')->getTitle());
            $letter_date_SD=new SweetDate(true, true, 'Asia/Tehran');
            $letter_date_Text=$letter_date_SD->date("l d F Y",$this->Data['servicerequest']->getLetter_date());
            $this->letter_date->setText($letter_date_Text);

        }
        $fileLink=new link(DEFAULT_PUBLICURL . $FileURL,$this->file1_flu);

        $LTable1=new Div();
        $LTable1->setClass("formtable");
        $LTable1->addElement($this->getInfoRowCode($this->title,$this->getFieldCaption('title')));
//		$LTable1->addElement($this->getInfoRowCode($this->unit_fid,$this->getFieldCaption('unit_fid')));
        $LTable1->addElement($this->getInfoRowCode($this->servicetype_fid,$this->getFieldCaption('servicetype_fid')));
        $LTable1->addElement($this->getInfoRowCode($this->description,$this->getFieldCaption('description')));
        $LTable1->addElement($this->getInfoRowCode($this->priorityImages,$this->getFieldCaption('priority')));
        $LTable1->addElement($this->getInfoRowCode($fileLink,$this->getFieldCaption('فایل ضمیمه شده')));
        $LTable1->addElement($this->getInfoRowCode($this->request_date,$this->getFieldCaption('request_date')));
        if(trim($this->devicetype_fid->getText())!="")
            $LTable1->addElement($this->getInfoRowCode($this->devicetype_fid,$this->getFieldCaption('devicetype_fid')));
        $LTable1->addElement($this->getInfoRowCode($this->letterfile_flu,$this->getFieldCaption('letterfile_flu')));
//		$LTable1->addElement($this->getInfoRowCode($this->securityacceptor_role_systemuser_fid,$this->getFieldCaption('securityacceptor_role_systemuser_fid')));
        $LTable1->addElement($this->getInfoRowCode($this->letternumber,$this->getFieldCaption('letternumber')));
        $LTable1->addElement($this->getInfoRowCode($this->letter_date,$this->getFieldCaption('letter_date')));
        $Page->addElement($LTable1);

        $Page->addElement($this->getStatusBox('ثبت درخواست',$this->Data['servicerequest']->getRequest_date(),$this->Data['requesteremployee']->getName()." ".$this->Data['requesteremployee']->getFamily()));

        for($statIndex=1;$statIndex<count($this->Data['allstatusesinfo']);$statIndex++)
        {
            $Page->addElement($this->getStatusBox('تغییر وضعیت به '.$this->Data['allstatusesinfo'][$statIndex]->getTitle(),$this->Data['allstatuses'][$statIndex]->getStart_date(),$this->Data['allstatusesemployee'][$statIndex]->getName()." ".$this->Data['allstatusesemployee'][$statIndex]->getFamily()));
        }
        return $Page;
    }
	public function getBodyHTML($command=null)
	{


	    $Page=$this->getInfoPart();
        $form=new SweetFrom("", "POST", $Page);
        return $form->getHTML();
	}
	private function getStatusBox($Title,$Date,$Person)
    {

        $DateSD=new SweetDate(true, true, 'Asia/Tehran');
        $Date=$DateSD->date("H:i l d F Y ",$Date);

        $Box=new Div();
        $Box->setClass('servicerequeststatusbox');
        $lblTitle=new Lable($Title);
        $lblTitle->setClass('servicerequeststatustitle');
        $lblDate=new Lable($Date);
        $lblDate->setClass('servicerequeststatusdate');
        $lblPerson=new Lable($Person);
        $lblPerson->setClass('servicerequeststatusperson');
        $Box->addElement($lblDate);
        $Box->addElement($lblTitle);
        $Box->addElement($lblPerson);
        return $Box;
    }
}
?>