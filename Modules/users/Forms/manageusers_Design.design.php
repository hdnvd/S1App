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
use core\CoreClasses\html\link;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 1395/3/1 - 2016/05/21 20:34:37
 *@lastUpdate 1395/3/1 - 2016/05/21 20:34:37
 *@SweetFrameworkHelperVersion 1.112
 *@Fields  t
*/


class manageusers_Design extends FormDesign {
	
    private $Users;
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
		$Page->setId("users_manageusers");
		$Page->addElement(new Lable(""));
		$Page->setClass("sweet_formtitle");
		$LTable1=new ListTable(4);
		$LTable1->setId("list");
		$UserCount=count($this->Users);
		$LTable1->addElement(new Lable("ردیف"));
		$LTable1->setLastElementClass("title");
		$LTable1->addElement(new Lable("نام"));
		$LTable1->setLastElementClass("title");
		$LTable1->addElement(new Lable("ایمیل"));
		$LTable1->setLastElementClass("title");
		$LTable1->addElement(new Lable("عملیات"));
		$LTable1->setLastElementClass("title");
		for($t=0;$t<$UserCount;$t++)
		{
		    $i=($UserCount-$t)-1;
		    if($this->Users[$i]['name']=="noname") $this->Users[$i]['name']="";
		    if($this->Users[$i]['family']=="nofamily") $this->Users[$i]['family']="";
		    $name[$i]=new Lable($this->Users[$i]['name'] . " " . $this->Users[$i]['family']);
		    $mail[$i]=new Lable($this->Users[$i]['mail']);
		    $editLink[$i]=new AppRooter("users", "manageuser");
		    $editLink[$i]->addParameter(new UrlParameter("id", $this->Users[$i]['id']));
		    $TitleLink[$i]=new link($editLink[$i]->getAbsoluteURL(), "مشاهده");
		    $LTable1->addElement(new Lable($i+1));
		    $LTable1->setLastElementClass("index");
		    $LTable1->addElement($name[$i]);
		    $LTable1->setLastElementClass("name");
		    $LTable1->addElement($mail[$i]);
		    $LTable1->setLastElementClass("mail");
		    $LTable1->addElement($TitleLink[$i]);
		    $LTable1->setLastElementClass("operation");
		}
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}

    public function setUsers($Users)
    {
        $this->Users = $Users;
    }
}
?>
