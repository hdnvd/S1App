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
use core\CoreClasses\html\ComboBox;
use Modules\languages\PublicClasses\CurrentLanguageManager;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/08/13 18:48:28
 *@lastUpdate 2015/08/13 18:48:28
 *@SweetFrameworkHelperVersion 1.107
 *@Fields width t,height t,os t,devicemodel t,platform t,accounts t,systeminfo t,exceptionid t,excpetionmessage t,usermessage t,appversion t,syslog t,appid t,send sb
*/


class crashreport_Design extends FormDesign {
	

	/**
	 * @var TextBox
	 */
	private $Width,$Height,$Os,$Devicemodel,$Platform,$Accounts,$Systeminfo,$Exceptionid,$Excpetionmessage,$Usermessage,$Appversion,$Syslog,$Appid;

	/**
	 * @var DataComboBox
	 */
	

	/**
	 * @var ComboBox
	 */
	

	/**
	 * @var SweetButton
	 */
	private $Send;

	public function __construct()
	{
		$this->Width=new TextBox("width");
		$this->Height=new TextBox("height");
		$this->Os=new TextBox("os");
		$this->Devicemodel=new TextBox("devicemodel");
		$this->Platform=new TextBox("platform");
		$this->Accounts=new TextBox("accounts");
		$this->Systeminfo=new TextBox("systeminfo");
		$this->Exceptionid=new TextBox("exceptionid");
		$this->Excpetionmessage=new TextBox("excpetionmessage");
		$this->Usermessage=new TextBox("usermessage");
		$this->Appversion=new TextBox("appversion");
		$this->Syslog=new TextBox("syslog");
		$this->Appid=new TextBox("appid");
		$this->Send=new SweetButton(true,"send");
		$this->Send->setAction("Send");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setId("contactus_crashreport");
		$Page->addElement(new Lable("crashreport"));
		$Page->setClass("sweet_formtitle");
		$LTable1=new ListTable(2);
		$LTable1->addElement(new Lable("width"));
		$LTable1->addElement($this->Width);
		$LTable1->addElement(new Lable("height"));
		$LTable1->addElement($this->Height);
		$LTable1->addElement(new Lable("os"));
		$LTable1->addElement($this->Os);
		$LTable1->addElement(new Lable("devicemodel"));
		$LTable1->addElement($this->Devicemodel);
		$LTable1->addElement(new Lable("platform"));
		$LTable1->addElement($this->Platform);
		$LTable1->addElement(new Lable("accounts"));
		$LTable1->addElement($this->Accounts);
		$LTable1->addElement(new Lable("systeminfo"));
		$LTable1->addElement($this->Systeminfo);
		$LTable1->addElement(new Lable("exceptionid"));
		$LTable1->addElement($this->Exceptionid);
		$LTable1->addElement(new Lable("excpetionmessage"));
		$LTable1->addElement($this->Excpetionmessage);
		$LTable1->addElement(new Lable("usermessage"));
		$LTable1->addElement($this->Usermessage);
		$LTable1->addElement(new Lable("appversion"));
		$LTable1->addElement($this->Appversion);
		$LTable1->addElement(new Lable("syslog"));
		$LTable1->addElement($this->Syslog);
		$LTable1->addElement(new Lable("appid"));
		$LTable1->addElement($this->Appid);
		$LTable1->addElement($this->Send,2);
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}

	public function getWidth()
	{
	    return $this->Width;
	}

	public function getHeight()
	{
	    return $this->Height;
	}

	public function getOs()
	{
	    return $this->Os;
	}

	public function getDevicemodel()
	{
	    return $this->Devicemodel;
	}

	public function getPlatform()
	{
	    return $this->Platform;
	}

	public function getAccounts()
	{
	    return $this->Accounts;
	}

	public function getSysteminfo()
	{
	    return $this->Systeminfo;
	}

	public function getExceptionid()
	{
	    return $this->Exceptionid;
	}

	public function getExcpetionmessage()
	{
	    return $this->Excpetionmessage;
	}

	public function getUsermessage()
	{
	    return $this->Usermessage;
	}

	public function getAppversion()
	{
	    return $this->Appversion;
	}

	public function getSyslog()
	{
	    return $this->Syslog;
	}

	public function getAppid()
	{
	    return $this->Appid;
	}
}
?>
