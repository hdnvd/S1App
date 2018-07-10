<?php

namespace Modules\finance\Forms;
use core\CoreClasses\html\link;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\services\MessageType;
use Modules\languages\PublicClasses\CurrentLanguageManager;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/02/20 10:40:48
 *@lastUpdate 2015/02/20 10:40:48
 *@SweetFrameworkHelperVersion 1.102
 */


class lowbalance_Design extends FormDesign {
    /**
     * @var TextBox
     */

    /**
     * @var DataComboBox
     */

    /**
     * @var SweetButton
     */

    public function __construct()
    {
    }
    public function getBodyHTML($command=null)
    {
        $Page=new Div();
        $Page->setClass("sweet_formtitle");
        $Page->setClass("finance_message_form");
        if($this->getMessage()!=""){
            $MessagePart=new Div();
            $MessagePart->setClass("finance_message");
            $MessagePart->addElement(new Lable($this->getMessage()));
            $lblPay=new Lable('افزایش موجودی حساب');
            $lnkPay=new link('/fa/finance/userpayment.jsp',$lblPay);
            $lnkPay->setClass('linkbutton');
            $Page->addElement($MessagePart);
            $Page->addElement($lnkPay);
        }
        $form=new SweetFrom("", "POST", $Page);
        return $form->getHTML();
    }

    public function getJSON()
    {
        parent::getJSON();

        $Result['message']=$this->getMessage();
        $Result['messagetype']=$this->getMessageType();
        return json_encode($Result);
    }
}
?>