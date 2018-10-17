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
class servicerequestmanagement_Design extends servicerequest_Design {
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

		parent::__construct();

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

    public function getBodyHTML($command=null)
    {


        $Page=$this->getInfoPart();
        if (key_exists("servicerequest", $this->Data)){
            for ($i = 1; $i < 10; $i++) {
                $this->CMBPriorities->addOption($i,$i);
            }

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

            $topunits=$this->Data['topunits'];
            $AllCount2 = count($topunits);
            for ($i = 0; $i < $AllCount2; $i++) {
                $item=$topunits[$i];
                $this->CMBTopUnits->addOption($item->getID(),$item->getTitle());
            }


            $unitEmps=$this->Data['unitemployees'];
            $AllCount3 = count($unitEmps);
            for ($i = 0; $i < $AllCount3; $i++) {
                $item=$unitEmps[$i];
                $this->CMBUnitEmployees->addOption($item->getID(),$item->getName() . " " . $item->getFamily());

            }
        }
        $ChangePriority=new Div();
        $ChangePriority->setClass("formtable smallform");
        $lblPriorityTitle=new Lable("تغییر اولویت");
        $lblPriorityTitle->setClass('smallformtitle');
        $ChangePriority->addElement($lblPriorityTitle);
        $ChangePriority->addElement($this->getFieldRowCode($this->CMBPriorities,"اولویت","اولویت "));
        $ChangePriority->addElement($this->btnChangePriority);

        $ChangeStatus=new Div();
        $ChangeStatus->setClass("formtable smallform");
        $lblStateTitle=new Lable("تغییر وضعیت");
        $lblStateTitle->setClass('smallformtitle');
        $ChangeStatus->addElement($lblStateTitle);
        $ChangeStatus->addElement($this->getFieldRowCode($this->CmbState,"وضعیت","وضعیت "));
        $ChangeStatus->addElement($this->getFieldRowCode($this->TxtStatusMessage,"پیام","پیام"));
        $ChangeStatus->addElement($this->btnChangeState);
        $Page->addElement($ChangeStatus);


        $Refer=new Div();
        $Refer->setClass("formtable smallform");
        $lblReferTitle=new Lable("ارجاع به یگان دیگر");
        $lblReferTitle->setClass('smallformtitle');
        $Refer->addElement($lblReferTitle);
        $Refer->addElement($this->getFieldRowCode($this->CMBTopUnits,"یگان","یگان"));
        $Refer->addElement($this->getFieldRowCode($this->TxtReferMessage,"پیام","پیام"));
        $Refer->addElement($this->btnRefer);
        $Page->addElement($Refer);

        $Assign=new Div();
        $Assign->setClass("formtable smallform");
        $lblAssignTitle=new Lable("تخصیص به کارکنان");
        $lblAssignTitle->setClass('smallformtitle');
        $Assign->addElement($lblAssignTitle);
        $Assign->addElement($this->getFieldRowCode($this->CMBUnitEmployees,"تخصیص به ","تخصیص به "));
        $Assign->addElement($this->getFieldRowCode($this->TxtAssignMessage,"پیام","پیام"));
        $Assign->addElement($this->btnAssign);
        $Page->addElement($Assign);
        $Page->addElement($ChangePriority);
        $form=new SweetFrom("", "POST", $Page);
        return $form->getHTML();
    }
	protected function getStatusBox($Title,$Date,$Person)
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