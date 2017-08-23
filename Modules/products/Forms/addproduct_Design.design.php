<?php

namespace Modules\products\Forms;

use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\elementGroup;
use core\CoreClasses\html\TextArea;
use core\CoreClasses\html\paragraph;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\FileUploadBox;
use core\CoreClasses\html\EmptyElement;
use core\CoreClasses\html\CheckBox;
use core\CoreClasses\html\CheckListBox;
use core\CoreClasses\html\Div;

/**
 *
 * @author Hadi Nahavandi
 *        
 */
class addproduct_Design extends FormDesign {
	private $grouplangs,$btnsave,$lblphoto,$lblMainPhoto,$additionalInfosTitle,$additionalInfos;
	private $txtTitle,$txtLatinName,$groupid,$Txtdesc,$id;
	/**
	 * @var TextBox
	 */
	private $txtVisits;
	/**
	 * @var CheckBox
	 */
	private $chkIsNew,$chkIsExists;
	private $Message,$lblThumbPhoto,$lblMakeThumb;
	public function __construct()
	{
		$this->txtVisits=new TextBox("visits");
		$this->chkIsNew=new CheckBox("isnew");
		$this->chkIsNew->addOption("محصول جدید", "1");
		$this->chkIsExists=new CheckBox("isexists");
		$this->chkIsExists->addOption("موجود", "1");
	}

	public function getBodyHTML($command = "load") {
		if($this->Message===null)
			$this->Message="";
		$EG=new elementGroup();
		$Txtdesc=new TextArea("txtdesc",$this->Txtdesc);
		$LblDesc=new paragraph($this->lbldesc);
		$lblTitle=new paragraph($this->lbltitle);
		$txtTitle=new TextBox("txttitle",$this->txtTitle);
		$txtLatinName=new TextBox("latinname",$this->txtLatinName);
		$lblLatinName=new paragraph($this->lbllatinname);
		$lblGroupLang=new paragraph($this->lblgrouplang);
		$selProductGroupLang=new DataComboBox($this->grouplangs,"grouplang");
		$selProductGroupLang->setTextField("title");
		$selProductGroupLang->setSelectedID($this->groupid);
 		$lblMainPhoto=new Lable($this->lblMainPhoto);
		$fileMainPhoto=new FileUploadBox("mainphoto");
		$lblMakeThumb=new Lable($this->lblMakeThumb);
		$chkMakeThumb=new CheckBox("makethumb");
		$chkMakeThumb->addOption("", "1");
		$lblThumbPhoto=new Lable($this->lblThumbPhoto);
		$fileThumbPhoto=new FileUploadBox("thumbnail");
		$txtHidId=new TextBox("id",$this->id,false);
		$subbtn=new SweetButton(true,$this->btnsave);
		$subbtn->setAction("save");
		$EG->addElement($LblDesc);
		$table=new ListTable(2);
		$table->addElement(new Lable($this->Message),2);
		$table->addElement($lblLatinName);
		$table->addElement($txtLatinName);
		$table->addElement($lblTitle);
		$table->addElement($txtTitle);
		$lblAddition=array();
		$txtAddition=array();
		for($i=0;$i<count($this->additionalInfosTitle);$i++)
		{
			$lblAddition[$i]=new Lable($this->additionalInfosTitle[$i]);
			$Info="";
			if (is_array($this->additionalInfos) && key_exists("0", $this->additionalInfos)) {
				$Info=$this->additionalInfos[0]["info" . ($i+1)];
			}
			$txtAddition[$i]=new TextBox("info" . $i,$Info);
			$table->addElement($lblAddition[$i]);
			$table->addElement($txtAddition[$i]);
		}
		$table->addElement($LblDesc);
		$table->addElement($Txtdesc);
		$table->addElement($lblGroupLang);
		$table->addElement($selProductGroupLang);
		
		$table->addElement($lblMainPhoto);
		$table->addElement($fileMainPhoto);
		$table->addElement($lblMakeThumb);
		$table->addElement($chkMakeThumb);
		$table->addElement($lblThumbPhoto);
		$table->addElement($fileThumbPhoto);
		for($i=0;$i<count($this->lblphoto);$i++)
		{
			$lblphoto=new Lable($this->lblphoto[$i]);
			$table->addElement($lblphoto);
			$filephoto=new FileUploadBox("photo[]");
			$chkDelete[$i]=new CheckBox("delete$i");
			$chkDelete[$i]->addOption("حذف", "1");
			$div[$i]=new Div();
			$div[$i]->setClass("products_addproduct_photouploaddiv");
			$div[$i]->addElement($filephoto);
			$div[$i]->addElement($chkDelete[$i]);
			$table->addElement($div[$i]);
		}
		$table->addElement(new Lable("بازدیدها:"));
		$table->addElement($this->txtVisits);
		$table->addElement($this->chkIsNew,2);
		$table->addElement($this->chkIsExists,2);
		$table->addElement($txtHidId,2);
		$table->addElement($subbtn,2);
		
		$form=new SweetFrom("", "post", $table);
		return $form->getHTML();
	}

	public function setGrouplangs($grouplangs)
	{
	    $this->grouplangs = $grouplangs;
	}

	public function setBtnsave($btnsave)
	{
	    $this->btnsave = $btnsave;
	}

	public function setLblphoto($lblphoto)
	{
	    $this->lblphoto = $lblphoto;
	}

	public function setLblMainPhoto($lblMainPhoto)
	{
	    $this->lblMainPhoto = $lblMainPhoto;
	}

		public function setAdditionalInfosTitle($additionalInfosTitle)
		{
		    $this->additionalInfosTitle = $additionalInfosTitle;
		}

		public function setAdditionalInfos($additionalInfos)
		{
		    $this->additionalInfos = $additionalInfos;
		}

	public function setTxtTitle($txtTitle)
	{
	    $this->txtTitle = $txtTitle;
	}

	public function setTxtLatinName($txtLatinName)
	{
	    $this->txtLatinName = $txtLatinName;
	}

	public function setGroupid($groupid)
	{
	    $this->groupid = $groupid;
	}

	public function setTxtdesc($Txtdesc)
	{
	    $this->Txtdesc = $Txtdesc;
	}

	public function setId($id)
	{
	    $this->id = $id;
	}

	public function setMessage($Message)
	{
	    $this->Message = $Message;
	}

	public function setLblThumbPhoto($lblThumbPhoto)
	{
	    $this->lblThumbPhoto = $lblThumbPhoto;
	}

	public function setLblMakeThumb($lblMakeThumb)
	{
	    $this->lblMakeThumb = $lblMakeThumb;
	}

	public function getTxtVisits()
	{
	    return $this->txtVisits;
	}

	public function getChkIsNew()
	{
	    return $this->chkIsNew;
	}

	public function getChkIsExists()
	{
	    return $this->chkIsExists;
	}
}

?>