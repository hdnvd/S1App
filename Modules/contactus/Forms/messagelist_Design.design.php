<?php

namespace Modules\contactus\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\SweetFrom;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
use core\CoreClasses\html\link;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/06/04 19:12:41
 *@lastUpdate 2015/06/04 19:12:41
 *@SweetFrameworkHelperVersion 1.102
*/


class messagelist_Design extends FormDesign {
	private $Messages;
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
		$Page->setId("contactus_messagelist");
		$Page->addElement(new Lable("فهرست پیام های دریافتی"));
		$Page->setClass("sweet_formtitle");
		$LTable1=new ListTable(1);
		for($i=0;$i<count($this->Messages);$i++)
		{
		    $MessageTitleLable=new Lable($this->Messages[$i]['message']);
		    $MessageURL=new AppRooter("contactus", "message");
		    $MessageURL->addParameter(new UrlParameter("id", $this->Messages[$i]['id']));
		    $MessageLink[$i]=new link($MessageURL->getAbsoluteURL(), $MessageTitleLable);
		    $LTable1->addElement($MessageLink[$i]);
		}
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}

	public function setMessages($Messages)
	{
	    $this->Messages = $Messages;
	}
}
?>
