<?php

namespace Modules\appman\Forms;
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
 *@creationDate 2015/10/16 23:17:12
 *@lastUpdate 2015/10/16 23:17:12
 *@SweetFrameworkHelperVersion 1.107
 *@Fields lblkeycount l,txtkeycount t,btngenerate sb
*/


class generatekey_Design extends FormDesign {
	private $Keys;

	/**
	 * @var TextBox
	 */
	private $Txtkeycount;

	/**
	 * @var DataComboBox
	 */
	

	/**
	 * @var ComboBox
	 */
	

	/**
	 * @var SweetButton
	 */
	private $Btngenerate;

	public function __construct()
	{
		$this->Txtkeycount=new TextBox("txtkeycount");
		$this->Btngenerate=new SweetButton(true,"تولید");
		$this->Btngenerate->setAction("Btngenerate");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setId("appman_generatekey");
		$Page->addElement(new Lable("تولید کد جدید"));
		$Page->setClass("sweet_formtitle");
		$LTable1=new ListTable(2);
		$LTable1->addElement(new Lable("تعداد"));
		$LTable1->addElement($this->Txtkeycount);
		$LTable1->addElement($this->Btngenerate,2);
		$Page->addElement($LTable1);
		
		if($this->Keys!==null && is_array($this->Keys))
		{
		  $LTable2=new Div();
		  $LTable2->setId("appman_generatekey_keylist");
		  for($i=0;$i<count($this->Keys);$i++)
		  {
		      $divKey=new Div();
		      $divKey->setClass("appman_generatekey_key");
		      $LblKey=new Lable($this->Keys[$i]);
		      $divKey->addElement($LblKey);
		      $LTable2->addElement($divKey);
		  }
		  $Page->addElement($LTable2);
		}
		
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}

	public function getTxtkeycount()
	{
	    return $this->Txtkeycount;
	}

	public function getKeys()
	{
	    return $this->Keys;
	}

	public function setKeys($Keys)
	{
	    $this->Keys = $Keys;
	}
}
?>
