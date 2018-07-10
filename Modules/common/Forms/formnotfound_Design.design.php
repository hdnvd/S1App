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
use core\CoreClasses\html\ComboBox;
use Modules\languages\PublicClasses\CurrentLanguageManager;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2016/05/15 22:53:17
 *@lastUpdate 2016/05/15 22:53:17
 *@SweetFrameworkHelperVersion 1.109
 *@Fields  t
*/


class formnotfound_Design extends FormDesign {
	

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
	 * @var SweetButton
	 */
	

	public function __construct()
	{
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setId("common_formnotfound");
		$Page->addElement(new Lable(""));
		$Page->setClass("sweet_formtitle");
		$LTable1=new ListTable(2);
		$lblMessage=new Lable("صفحه ای که به دنبال آن هستید وجود ندارد");
		$LTable1->addElement($lblMessage);
		$Page->addElement($LTable1);
//		echo $_SERVER['REQUEST_URI'];
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}

    public function getJSON()
    {
        parent::getJSON();

        $Result=['message'=>'pagenotfound','error'=>404,'URL'=>$_SERVER['REQUEST_URI']];
        return json_encode($Result);
    }
}
?>
