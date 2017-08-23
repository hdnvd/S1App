<?php

namespace Modules\sfman\Forms;
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
 *@creationDate 2016/05/14 16:05:05
 *@lastUpdate 2016/05/14 16:05:05
 *@SweetFrameworkHelperVersion 1.109
 *@Fields btnclearall sb
*/


class managecache_Design extends FormDesign {
	

    private $ResultText;
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
	private $Btnclearall;

	public function __construct()
	{
		$this->Btnclearall=new SweetButton(true,"پاکسازی Cache");
		$this->Btnclearall->setAction("Btnclearall");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setId("sftools_managecache");
		$Page->addElement(new Lable("مدیریت cache"));
		$Page->setClass("sweet_formtitle");
		$LTable1=new ListTable(2);
		$LTable1->addElement($this->Btnclearall,2);
		if($this->ResultText!="")
		    $LTable1->addElement(new Lable($this->ResultText));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}

    public function setResultText($ResultText)
    {
        $this->ResultText = $ResultText;
    }
}
?>
