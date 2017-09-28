<?php

namespace Modules\common\Forms;
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


class message_Design extends FormDesign {
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
        if($this->getMessage()!=""){
            $MessagePart=new Div();
            if($this->getMessageType()==MessageType::$ERROR)
                $MessagePart->setClass("sweet_messagepart alert alert-danger");
            else
                $MessagePart->setClass("sweet_messagepart alert alert-success");
            $MessagePart->addElement(new Lable($this->getMessage()));
            $Page->addElement($MessagePart);
        }
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>
