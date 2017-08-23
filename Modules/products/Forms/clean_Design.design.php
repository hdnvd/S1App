<?php

namespace Modules\products\Forms;
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
 *@creationDate 2015/07/06 11:26:45
 *@lastUpdate 2015/07/06 11:26:45
 *@SweetFrameworkHelperVersion 1.106
 *@Fields btnclean sb
*/


class clean_Design extends FormDesign {
	

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
	private $Btnclean;

	public function __construct()
	{
		$this->Btnclean=new SweetButton(true,"btnclean");
		$this->Btnclean->setAction("Btnclean");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setId("products_clean");
		$Page->addElement(new Lable("clean"));
		$Page->setClass("sweet_formtitle");
		$LTable1=new ListTable(2);
		$LTable1->addElement($this->Btnclean,2);
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>
