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
class servicerequestchecking_Design extends servicerequest_Design {
    /** @var TextArea */
    private $TxtStatusMessage;

    /**
     * @return TextArea
     */
    public function getTxtStatusMessage()
    {
        return $this->TxtStatusMessage;
    }

    /** @var SweetButton */
    private $btnAccept;
    /** @var SweetButton */
    private $btnReject;

	public function __construct()
	{

		parent::__construct();

        $this->btnAccept=new SweetButton(true,"تایید");
        $this->btnAccept->setAction("btnAccept");
        $this->btnAccept->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
        $this->btnAccept->setClass("btn btn-primary");
//        $this->btnAccept->setClass("form-control");


        $this->btnReject=new SweetButton(true,"رد");
        $this->btnReject->setAction("btnReject");
        $this->btnReject->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
        $this->btnReject->setClass("btn btn-danger");
//        $this->btnReject->setClass("form-control");

        $this->TxtStatusMessage=new TextArea('TxtStatusMessage');
        $this->TxtStatusMessage->setClass("form-control");
	}

    public function getBodyHTML($command=null)
    {


        $Page=$this->getInfoPart();

        $ChangeStatus=new Div();
        $ChangeStatus->setClass("formtable smallform");
        $lblStateTitle=new Lable("اعلام نظر");
        $lblStateTitle->setClass('smallformtitle');
        $ChangeStatus->addElement($lblStateTitle);
        $ChangeStatus->addElement($this->getFieldRowCode($this->TxtStatusMessage,"پیام","پیام"));
        $ChangeStatus->addElement($this->btnAccept);
        $ChangeStatus->addElement($this->btnReject);
        $Page->addElement($ChangeStatus);


        $form=new SweetFrom("", "POST", $Page);
        return $form->getHTML();
    }
}
?>