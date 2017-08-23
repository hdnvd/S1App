<?php

namespace Modules\users\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\ComboBox;
use core\CoreClasses\html\FileUploadBox;
use Modules\languages\PublicClasses\CurrentLanguageManager;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 1395/3/1 - 2016/05/21 20:35:08
 *@lastUpdate 1395/3/1 - 2016/05/21 20:35:08
 *@SweetFrameworkHelperVersion 1.112
 *@Fields  t
*/


class manageuser_Design extends FormDesign {
	
    private $user;
    private $EnabledFields;
	/**
	 * @var TextBox
	 */
	

	/**
	 * @var DataComboBox
	 */
	

	/**
	 * @var ComboBox
	 */
	

	/**
	 * @var FileUploadBox
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
		$Page->setId("users_manageuser");
		$Page->addElement(new Lable(""));
		$Page->setClass("sweet_formtitle");
		$LTable1=new ListTable(2);
		$LTable1->addElement(new Lable("نام"));
		$LTable1->addElement(new Lable($this->user['name']));
		$LTable1->addElement(new Lable("نام خانوادگی"));
		$LTable1->addElement(new Lable($this->user['family']));
		$LTable1->addElement(new Lable("ایمیل"));
		$LTable1->addElement(new Lable($this->user['mail']));
		$LTable1->addElement(new Lable(" موبایل"));
		$LTable1->addElement(new Lable($this->user['mobile']));
		for($i=0;$i<count($this->EnabledFields);$i++)
		{
		    $LTable1->addElement(new Lable($this->EnabledFields[$i]['userinfo_fieldcaption']));
		    $LTable1->addElement(new Lable($this->user[$this->EnabledFields[$i]['userinfo_field']]));
		}
		$LTable1->addElement(new Lable(" تاریخ عضویت"));
		$LTable1->addElement(new Lable($this->user['signuptime']));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function setEnabledFields($EnabledFields)
    {
        $this->EnabledFields = $EnabledFields;
    }
}
?>
