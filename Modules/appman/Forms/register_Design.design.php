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
 *@creationDate 2015/10/17 16:53:41
 *@lastUpdate 2015/10/17 16:53:41
 *@SweetFrameworkHelperVersion 1.108
 *@Fields txtproductkey t,txtdeviceid t,txtname t,txtmobile t,txtwidth t,txtheight t,txtappid t,txtos t,txtdevicename t,txtosversion t,txtaccounts t,txtcity t,btnregister sb,txtmail t,txtismale t
*/


class register_Design extends FormDesign {
	private $AppPassword,$Usermessage,$KeyStatus;

	/**
	 * @var TextBox
	 */
	private $Txtproductkey,$Txtdeviceid,$Txtname,$Txtmobile,$Txtwidth,$Txtheight,$Txtappid,$Txtos,$Txtdevicename,$Txtosversion,$Txtaccounts,$Txtcity,$Txtmail,$Txtismale;

	/**
	 * @var DataComboBox
	 */
	

	/**
	 * @var ComboBox
	 */
	

	/**
	 * @var SweetButton
	 */
	private $Btnregister;

	public function __construct()
	{
		$this->Txtproductkey=new TextBox("txtproductkey");
		$this->Txtdeviceid=new TextBox("txtdeviceid");
		$this->Txtname=new TextBox("txtname");
		$this->Txtmobile=new TextBox("txtmobile");
		$this->Txtwidth=new TextBox("txtwidth");
		$this->Txtheight=new TextBox("txtheight");
		$this->Txtappid=new TextBox("txtappid");
		$this->Txtos=new TextBox("txtos");
		$this->Txtdevicename=new TextBox("txtdevicename");
		$this->Txtosversion=new TextBox("txtosversion");
		$this->Txtaccounts=new TextBox("txtaccounts");
		$this->Txtcity=new TextBox("txtcity");
		$this->Txtismale=new TextBox("txtismale");
		$this->Txtmail=new TextBox("txtmail");
		$this->Btnregister=new SweetButton(true,"btnregister");
		$this->Btnregister->setAction("Btnregister");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setId("appman_register");
		$Page->addElement(new Lable("register"));
		$Page->setClass("sweet_formtitle");
		$LTable1=new ListTable(2);
		$LTable1->addElement(new Lable("txtproductkey"));
		$LTable1->addElement($this->Txtproductkey);
		$LTable1->addElement(new Lable("txtdeviceid"));
		$LTable1->addElement($this->Txtdeviceid);
		$LTable1->addElement(new Lable("txtname"));
		$LTable1->addElement($this->Txtname);
		$LTable1->addElement(new Lable("txtmobile"));
		$LTable1->addElement($this->Txtmobile);
		$LTable1->addElement(new Lable("txtwidth"));
		$LTable1->addElement($this->Txtwidth);
		$LTable1->addElement(new Lable("txtheight"));
		$LTable1->addElement($this->Txtheight);
		$LTable1->addElement(new Lable("txtappid"));
		$LTable1->addElement($this->Txtappid);
		$LTable1->addElement(new Lable("txtos"));
		$LTable1->addElement($this->Txtos);
		$LTable1->addElement(new Lable("txtdevicename"));
		$LTable1->addElement($this->Txtdevicename);
		$LTable1->addElement(new Lable("txtosversion"));
		$LTable1->addElement($this->Txtosversion);
		$LTable1->addElement(new Lable("txtaccounts"));
		$LTable1->addElement($this->Txtaccounts);
		$LTable1->addElement(new Lable("txtcity"));
		$LTable1->addElement($this->Txtcity);
		$LTable1->addElement(new Lable("Txtmail"));
		$LTable1->addElement($this->Txtmail);
		$LTable1->addElement(new Lable("Txtismale"));
		$LTable1->addElement($this->Txtismale);
		$LTable1->addElement($this->Btnregister,2);
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	public function getJSON()
	{
	    $result=array("password"=>$this->AppPassword,"keystatus"=>$this->KeyStatus,"message"=>$this->Usermessage);
		$fullPage=array("result"=>$result);
		$result=str_replace("&lt;","<",json_encode($fullPage));
		$result=str_replace("&gt;", ">", $result);
		return $result;
	}

	
	/**
	 * 
	 * @return 
	 */
	public function getTxtproductkey()
	{
	    return $this->Txtproductkey;
	}

	/**
	 * 
	 * @return 
	 */
	public function getTxtdeviceid()
	{
	    return $this->Txtdeviceid;
	}

	/**
	 * 
	 * @return 
	 */
	public function getTxtname()
	{
	    return $this->Txtname;
	}

	/**
	 * 
	 * @return 
	 */
	public function getTxtmobile()
	{
	    return $this->Txtmobile;
	}

	/**
	 * 
	 * @return 
	 */
	public function getTxtwidth()
	{
	    return $this->Txtwidth;
	}

	/**
	 * 
	 * @return 
	 */
	public function getTxtheight()
	{
	    return $this->Txtheight;
	}

	/**
	 * 
	 * @return 
	 */
	public function getTxtappid()
	{
	    return $this->Txtappid;
	}

	/**
	 * 
	 * @return 
	 */
	public function getTxtos()
	{
	    return $this->Txtos;
	}

	/**
	 * 
	 * @return 
	 */
	public function getTxtdevicename()
	{
	    return $this->Txtdevicename;
	}

	/**
	 * 
	 * @return 
	 */
	public function getTxtosversion()
	{
	    return $this->Txtosversion;
	}

	/**
	 * 
	 * @return 
	 */
	public function getTxtaccounts()
	{
	    return $this->Txtaccounts;
	}

	/**
	 * 
	 * @return 
	 */
	public function getTxtcity()
	{
	    return $this->Txtcity;
	}

	public function getTxtmail()
	{
	    return $this->Txtmail;
	}

	public function getTxtismale()
	{
	    return $this->Txtismale;
	}

	public function setAppPassword($AppPassword)
	{
	    $this->AppPassword = $AppPassword;
	}

	public function setUsermessage($Usermessage)
	{
	    $this->Usermessage = $Usermessage;
	}

	public function setKeyStatus($KeyStatus)
	{
	    $this->KeyStatus = $KeyStatus;
	}
}
?>
