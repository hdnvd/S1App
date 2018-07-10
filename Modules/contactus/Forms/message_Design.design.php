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


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/06/04 19:13:00
 *@lastUpdate 2015/06/04 19:13:00
 *@SweetFrameworkHelperVersion 1.102
*/


class message_Design extends FormDesign {
	private $Message;
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
		$Page->setId("contactus_message");
		$Page->addElement(new Lable("اطلاعات پیام"));
		$Page->setClass("sweet_formtitle");
		$LTable1=new ListTable(2);
		$LTable1->addElement(new Lable("نام"));
		$LTable1->addElement(new Lable($this->Message[0]['name']));

		$LTable1->addElement(new Lable("نام خانوادگی"));
		$LTable1->addElement(new Lable($this->Message[0]['family']));

		$LTable1->addElement(new Lable("تلفن"));
		$LTable1->addElement(new Lable($this->Message[0]['tel']));

		$LTable1->addElement(new Lable("ایمیل"));
		$LTable1->addElement(new Lable($this->Message[0]['mail']));

		$LTable1->addElement(new Lable("موبایل"));
		$LTable1->addElement(new Lable($this->Message[0]['mobile']));

		$LTable1->addElement(new Lable("پیام"));
		$LTable1->addElement(new Lable($this->Message[0]['message']));

		$LTable1->addElement(new Lable("IP"));
		$LTable1->addElement(new Lable($this->Message[0]['ip']));

		$LTable1->addElement(new Lable("تاریخ ارسال"));
		$LTable1->addElement(new Lable($this->Message[0]['date']));
		
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}

	public function setMessage($Message)
	{
	    $this->Message = $Message;
	}
}
?>
