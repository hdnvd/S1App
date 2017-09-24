<?php

namespace Modules\posts\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Label;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\SweetFrom;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextArea;
use core\CoreClasses\html\JavascriptLink;
use Modules\common\PublicClasses\AppJSLink;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\CheckBox;


class postmanage_Design extends FormDesign {
	private $lblTitle,$txtTitle,$lblSummary,$txtSummary,$lblContent,$txtContent,$lblExternalLink,$txtExternalLink,$lblVisits,$txtVisits,$btnSave,$lblCat,$btnSaveAction;
	private $HidID;
	private $lblLinkTitle,$txtLinkTitle;
	private $lblDescriptionTitle,$txtDescription;
	private $flgShowCanonicalURL;
	private $AllCats,$PostCats;
	/**
	 * @var TextBox
	 */
	private $txtTags,$txtKeywords,$txtCanonicalURL;
	/**
	 * @var DataComboBox
	 */
	
	/**
	 * @var SweetButton
	 */
	
	public function __construct()
	{
	    $this->txtTags=new TextBox("txttags");
	    $this->txtKeywords=new TextBox("txtkeywords");
	    $this->txtCanonicalURL=new TextBox("txtcanonicalurl");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new ListTable(2);
		$lblLinkTitle=new Lable($this->lblLinkTitle);
		$Page->addElement($lblLinkTitle);
		$txtLinkTitle=new TextBox("txtLinkTitle",$this->txtLinkTitle);
		$txtLinkTitle->setClass("longtextbox");
		$Page->addElement($txtLinkTitle);
		
		$lblTitle=new Lable($this->lblTitle);
		$Page->addElement($lblTitle);
		$txtTitle=new TextBox("txtTitle",$this->txtTitle);
		$txtTitle->setClass("longtextbox");
		$Page->addElement($txtTitle);
	
		$lblDescriptionTitle=new Lable($this->lblDescriptionTitle);
		$Page->addElement($lblDescriptionTitle);
		$txtDescription=new TextBox("txtDescription",$this->txtDescription);
		$txtDescription->setClass("longtextbox");
		$Page->addElement($txtDescription);
		
		$lblSummary=new Lable($this->lblSummary);
		$Page->addElement($lblSummary);
	
		$txtSummary=new TextArea("txtSummary",htmlentities($this->txtSummary));
		$txtSummary->setClass("editablearea");
		$Page->addElement($txtSummary);
	
		$lblContent=new Lable($this->lblContent);
		$Page->addElement($lblContent);
	
		$txtContent=new TextArea("txtContent",htmlentities($this->txtContent));
		$txtContent->setClass("editablearea");
		$Page->addElement($txtContent);
	
		$lblExternalLink=new Lable($this->lblExternalLink);
		$Page->addElement($lblExternalLink);
	
		$txtExternalLink=new TextBox("txtExternalLink",$this->txtExternalLink);
		$txtExternalLink->setClass("longtextbox");
		$Page->addElement($txtExternalLink);
	
		$Page->addElement(new Lable("تگ ها"));
		$this->txtTags->setClass("longtextbox");
		$Page->addElement($this->txtTags);
		
		$Page->addElement(new Lable("کلمات کلیدی"));
		$this->txtKeywords->setClass("longtextbox");
		$Page->addElement($this->txtKeywords);
		
		if($this->flgShowCanonicalURL)
		{
		  $Page->addElement(new Lable("آدرس یکتا(بدون آدرس سایت)"));
		  $this->txtCanonicalURL->setClass("longtextbox");
		  $Page->addElement($this->txtCanonicalURL);
		}
		else 
		{
		    $this->txtCanonicalURL->setVisible(false);
		    $Page->addElement($this->txtCanonicalURL,2);
		}
		$lblVisits=new Lable($this->lblVisits);
		$Page->addElement($lblVisits);
	
		$txtVisits=new TextBox("txtVisits",$this->txtVisits);
		$txtVisits->setClass("longtextbox");
		$Page->addElement($txtVisits);
		
		
		
		$lblCat=new Lable($this->lblCat);
		$Page->addElement($lblCat);
		
		/*$cmbCatID=new DataComboBox($this->cmbCatID,"cmbCatID");
		$cmbCatID->setTextField("title");
		$Page->addElement($cmbCatID);
	       */
		$Cats=new CheckBox("cats[]");
		for($i=0;$i<count($this->AllCats);$i++)
		    $Cats->addOption($this->AllCats[$i]['title'], $this->AllCats[$i]['id']);
		for($i=0;$i<count($this->PostCats);$i++)
		    $Cats->addSelectedValue($this->PostCats[$i]['languagecategory_fid']);
		$Page->addElement($Cats);
		
		
		$btnSave=new SweetButton(true,$this->btnSave);
		$btnSave->setAction($this->btnSaveAction);
		$Page->addElement($btnSave);
		$hidid=new TextBox("hidid",$this->HidID,false);
		$Page->addElement($hidid,2);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	
	public function setLblTitle($lblTitle)
	{
		$this->lblTitle = $lblTitle;
	}
	
	public function setTxtTitle($txtTitle)
	{
		$this->txtTitle = $txtTitle;
	}
	
	public function setLblSummary($lblSummary)
	{
		$this->lblSummary = $lblSummary;
	}
	
	public function setTxtSummary($txtSummary)
	{
		$this->txtSummary = $txtSummary;
	}
	
	public function setLblContent($lblContent)
	{
		$this->lblContent = $lblContent;
	}
	
	public function setTxtContent($txtContent)
	{
		$this->txtContent = $txtContent;
	}
	
	public function setLblExternalLink($lblExternalLink)
	{
		$this->lblExternalLink = $lblExternalLink;
	}
	
	public function setTxtExternalLink($txtExternalLink)
	{
		$this->txtExternalLink = $txtExternalLink;
	}
	
	public function setLblVisits($lblVisits)
	{
		$this->lblVisits = $lblVisits;
	}
	
	public function setTxtVisits($txtVisits)
	{
		$this->txtVisits = $txtVisits;
	}
	
	public function setBtnSave($btnSave)
	{
		$this->btnSave = $btnSave;
	}

	public function setLblCat($lblCat)
	{
	    $this->lblCat = $lblCat;
	}

	public function setBtnSaveAction($btnSaveAction)
	{
	    $this->btnSaveAction = $btnSaveAction;
	}

	public function setHidID($HidID)
	{
	    $this->HidID = $HidID;
	}

	public function setLblLinkTitle($lblLinkTitle)
	{
	    $this->lblLinkTitle = $lblLinkTitle;
	}

	public function setTxtLinkTitle($txtLinkTitle)
	{
	    $this->txtLinkTitle = $txtLinkTitle;
	}

		public function setLblDescriptionTitle($lblDescriptionTitle)
		{
		    $this->lblDescriptionTitle = $lblDescriptionTitle;
		}


		public function setTxtDescription($txtDescription)
		{
		    $this->txtDescription = $txtDescription;
		}

	public function getTxtTags()
	{
	    return $this->txtTags;
	}

	public function getTxtKeywords()
	{
	    return $this->txtKeywords;
	}

	public function setFlgShowCanonicalURL($flgShowCanonicalURL)
	{
	    $this->flgShowCanonicalURL = $flgShowCanonicalURL;
	}

	public function getTxtCanonicalURL()
	{
	    return $this->txtCanonicalURL;
	}


	public function setAllCats($AllCats)
	{
	    $this->AllCats = $AllCats;
	}


	public function setPostCats($PostCats)
	{
	    $this->PostCats = $PostCats;
	}
}
?>
