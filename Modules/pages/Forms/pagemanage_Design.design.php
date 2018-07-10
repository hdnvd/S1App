<?php
namespace Modules\pages\Forms;
use \core\CoreClasses\services;
use \core\CoreClasses\services\FormDesign;
use \core\CoreClasses\html\elementGroup;
use \core\CoreClasses\html\paragraph;
use \core\CoreClasses\html\TextBox;
use \core\CoreClasses\html\DataComboBox;
use \core\CoreClasses\html\Button;
use \core\CoreClasses\html\form;
use \core\CoreClasses\html\TextArea;
use \core\CoreClasses\html\DataTable;
use \core\CoreClasses\html\Image;
use \core\CoreClasses\html\htmlcode;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\Lable;
	class pagemanage_Design extends FormDesign
	{
		private $lblname;
		private $txtname;
		private $lbltitle;
		private $txttitle;
		private $lblcontent;
		private $txtcontent;
		private $lbltags;
		private $txttags;
		private $btnsave;
		private $lbllanguage;
		private $sellanguage;
		private $Message;
		private $Action;
		private $PageID;
		public function getBodyHTML($command=null)
		{
			$listTable=new ListTable(2);
			$lblname=new paragraph($this->lblname,"lblname","lblname");
			$txtname=new TextBox("txtname",$this->txtname);
			$lbltitle=new paragraph($this->lbltitle,"lbltitle","lbltitle");
			$txttitle=new TextBox("txttitle",$this->txttitle);
			$lblcontent=new paragraph($this->lblcontent,"lblcontent","lblcontent");
			$txtcontent=new TextArea("txtcontent",$this->txtcontent);
			$txtcontent->setClass("editablearea");
			$lbltags=new paragraph($this->lbltags,"lbltags","lbltags");
			$txttags=new TextBox("txttags",$this->txttags);
			$lblThumb=new paragraph($this->lblthumb);
			$txtthumb=new TextBox("txtthumb",$this->txtthumb);
			$lbllanguage=new paragraph($this->lbllanguage,"lbllanguage","lbllanguage");
			$sellanguage=new DataComboBox($this->sellanguage,"sellanguage");
			$btnsave=new SweetButton(true,$this->btnsave);
			$btnsave->setAction($this->Action);
			$listTable->addElement(new TextBox("pageid",$this->PageID,false),2);
			$listTable->addElement($lblname);
			$listTable->addElement($txtname);
			$listTable->addElement($lbltitle);
			$listTable->addElement($txttitle);
			$listTable->addElement($lblcontent);
			$listTable->addElement($txtcontent);
			$listTable->addElement($lbltags);
			$listTable->addElement($txttags);
			$listTable->addElement($lblThumb);
			$listTable->addElement($txtthumb);
			$listTable->addElement($lbllanguage);
			$listTable->addElement($sellanguage);
			$listTable->addElement($btnsave,2);
			$listTable->addElement(new Lable($this->Message),2);
			$form=new SweetFrom("", "POST", $listTable);
			$PageContent=$form->getHTML();
			return $PageContent;
		}
	
			public function setMessage($Message)
			{
			    $this->Message = $Message;
			}
			public function setLblname($lblname)
			{
				$this->lblname=$lblname;
			}
			public function setTxtname($txtname)
			{
				$this->txtname=$txtname;
			}
			public function setLbltitle($lbltitle)
			{
				$this->lbltitle=$lbltitle;
			}
			public function setTxttitle($txttitle)
			{
				$this->txttitle=$txttitle;
			}
			public function setLblcontent($lblcontent)
			{
				$this->lblcontent=$lblcontent;
			}
			public function setTxtcontent($txtcontent)
			{
				$this->txtcontent=$txtcontent;
			}
			public function setLbltags($lbltags)
			{
				$this->lbltags=$lbltags;
			}
			public function setTxttags($txttags)
			{
				$this->txttags=$txttags;
			}
			public function setBtnsave($btnsave)
			{
				$this->btnsave=$btnsave;
			}
			public function setLbllanguage($lbllanguage)
			{
				$this->lbllanguage=$lbllanguage;
			}
			public function setSellanguage($sellanguage)
			{
				$this->sellanguage=$sellanguage;
			}
		public function setAction($Action)
		{
		    $this->Action = $Action;
		}

		public function setPageID($PageID)
		{
		    $this->PageID = $PageID;
		}
}
?>
 