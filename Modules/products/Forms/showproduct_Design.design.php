<?php

namespace Modules\products\Forms;

use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\DataTable;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\Image;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\paragraph;
use core\CoreClasses\html\elementGroup;
use core\CoreClasses\html\EmptyElement;
use core\CoreClasses\html\Div;
use Modules\common\PublicClasses\AppJSLink;
use core\CoreClasses\html\JavascriptLink;
use core\CoreClasses\html\link;

/**
 *
 * @author Hadi Nahavandi
 *        
 */
class showproduct_Design extends FormDesign {
	private $product;
	private $lblTitle,$lblGroupLang,$lblTitleText,$lblGroupLangText,$lblMainPhoto,$imgMainPhoto,$lblDesc,$lblDescText;
	private $AdditionalInfos,$additionalInfosTitle,$photos,$lblVisitsTitle,$visits;
	private $lblIsExistsTitle,$IsExists;
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\services\FormDesign::getBodyHTML()
	 *
	 *---------------------------------------
	 *-						-				-
	 *-						-				-
	 *-						-				-
	 *-						-				-
	 *-	  $PropertiesTable	-	$ImgPhotod	-
	 *-						-				-
	 *-						-				-
	 *-						-				-
	 *-						-				-
	 *---------------------------------------
	 *					$PhotosDiv			-
	 *---------------------------------------
	 */
	public function getBodyHTML($command = "load") {
		$PropertiesTable=new ListTable(2);
		$FullPage=new ListTable(2);
		$FullPage->setClass("producttable");
		$FullPage->SetAttribute("itemscope", "");
		$FullPage->SetAttribute("itemtype", "http://data-vocabulary.org/Product");
		$PhotosDiv=new Div();
		$PhotosDiv->setId("products_productadditionalphotos");
		$PropertiesTable->setId("producttable");
		$product=$this->lblTitle;
		if(!is_null($product))
		{
			$lblTitle=new paragraph($this->lblTitle);
			$lblDesc=new paragraph($this->lblDesc);
			$lblGroupLang=new paragraph($this->lblGroupLang);
			$lblTitleText=new Lable($this->lblTitleText);
			$lblDescText=new Div();
            $Desc=new Lable($this->lblDescText);
            $Desc->setHtmlContent(false);
			$lblDescText->addElement($Desc);
			$lblTitleText->SetAttribute("itemprop", "name");
			$lblDescText->SetAttribute("itemprop", "description");
			$lblGroupLangText=new Lable($this->lblGroupLangText);
			$lblGroupLangText->SetAttribute("itemprop", " category");
			$lblGroupLangText->setStyle("width:0px;height:0px;overflow:hidden");
			$lblMainPhoto=new Lable($this->lblMainPhoto);
		    $lblIsExistsTitle=new Lable($this->lblIsExistsTitle);
		    $lblIsExists=new Lable($this->IsExists);
			$imgMainPhoto=new Image(DEFAULT_PUBLICURL . $this->imgMainPhoto);
			$imgMainPhoto->SetAttribute("itemprop", "image");
			$imgMainPhotod=new Div();
			$imgMainPhotod->addElement($imgMainPhoto);
			$imgMainPhotod->setId("products_mainphoto");
// 			$imgMainPhotod->addElement($lblGroupLangText);
			$lblvisitsTitle=new Lable($this->lblVisitsTitle);
			$lblvisits=new Lable($this->visits);
			$lblAddition=array();
			$txtAddition=array();
			
			for($i=0;$i<count($this->additionalInfosTitle);$i++)
			{
				$lblAddition[$i]=new Lable($this->additionalInfosTitle[$i]);
				$lblAdditionVal[$i]=new Lable($this->AdditionalInfos["info" . ($i+1)]);
				$lblAdditionVal[$i]->setHtmlContent(true);
				$PropertiesTable->addElement($lblAddition[$i]);
				$PropertiesTable->addElement($lblAdditionVal[$i]);
			}
			$PropertiesTable->addElement($lblTitle);
			$PropertiesTable->addElement($lblTitleText);
			$PropertiesTable->addElement($lblDesc);
			$PropertiesTable->addElement($lblDescText);
			$PropertiesTable->setLastElementClass("desc");
			$PropertiesTable->addElement($lblIsExistsTitle);
			$PropertiesTable->addElement($lblIsExists);
			$shift=0;
			$imgPhoto=null;
			for($i=0;$i<count($this->photos);$i++)
			{
				if(!is_null($this->photos[$i]['url']) && $this->photos[$i]['url']!="")
				{
					if((int)$this->photos[$i]['productphotonum']==(int)($i+$shift))
					{
						$imageURL=DEFAULT_PUBLICURL . $this->photos[$i]['url'];
						$tmpimgPhoto=new Image($imageURL);

						$tmpimgPhoto->SetAttribute("data-zoom-image",$imageURL );
						$imgPhoto[$i]=$tmpimgPhoto;
					}
					else 
					{
						$tmpimgPhoto=new EmptyElement();
 						$shift++;
 						$i--;
						
					}
					$tmpdiv=new Div();
					$tmpdiv->addElement($tmpimgPhoto);
					$tmpdiv->setID("products_photo" . ($i+$shift));
					$PhotosDiv->addElement($tmpdiv);
				}
			}
			$PropertiesTable->addElement($lblvisitsTitle);
			$PropertiesTable->addElement($lblvisits);
			$lblID=new Lable($this->product[0]['id']);
			$lblID->SetAttribute("itemprop", "identifier");
			$lblID->setStyle("display:none;");
			$PropertiesTable->addElement($lblID,2);
			$FullPage->setLastElementStyle("vertical-align:top;");
			$FullPage->addElement($PropertiesTable);
			$FullPage->setLastElementStyle("vertical-align:top;");
			$FullPage->addElement($imgMainPhotod);
			$FullPage->setLastElementStyle("vertical-align:top;");
			$FullPage->addElement($PhotosDiv,2);

			$applicationhid=new Div();
			$CloseLink=new Image(DEFAULT_PUBLICURL . "content/files/img/close.png");
			$CloseLink->setId("products_closelink");
			$applicationhid->addElement($CloseLink);
			if($imgPhoto!==null  && is_array($imgPhoto) && key_exists("1", $imgPhoto))
			{
				$applicationhid->setId("products_applicationhid");
				$applicationhid->addElement($imgPhoto[1]);
			}
			$zoomJs=new AppJSLink("products", "zoom");
			$FullPage->addElement(new JavascriptLink($zoomJs->getAbsoluteURL()));
			
			
		}
		
		return $FullPage->getHTML() . $applicationhid->getHTML();
	}

	public function setProduct($product)
	{
	    $this->product = $product;
	}

	public function setLblTitle($lblTitle)
	{
	    $this->lblTitle = $lblTitle;
	}

	public function setLblGroupLang($lblGroupLang)
	{
	    $this->lblGroupLang = $lblGroupLang;
	}

	public function setLblTitleText($lblTitleText)
	{
	    $this->lblTitleText = $lblTitleText;
	}

	public function setLblGroupLangText($lblGroupLangText)
	{
	    $this->lblGroupLangText = $lblGroupLangText;
	}

	public function setLblMainPhoto($lblMainPhoto)
	{
	    $this->lblMainPhoto = $lblMainPhoto;
	}

	public function setImgMainPhoto($imgMainPhoto)
	{
	    $this->imgMainPhoto = $imgMainPhoto;
	}

	public function setLblDesc($lblDesc)
	{
	    $this->lblDesc = $lblDesc;
	}

	public function setLblDescText($lblDescText)
	{
		$lblDescText=str_ireplace("\n", "</p><p>", $lblDescText);
		$lblDescText="<p>" . $lblDescText . "</p>";
	    $this->lblDescText = $lblDescText;
	}

		public function setAdditionalInfos($AdditionalInfos)
		{
		    $this->AdditionalInfos = $AdditionalInfos;
		}

		public function setAdditionalInfosTitle($additionalInfosTitle)
		{
		    $this->additionalInfosTitle = $additionalInfosTitle;
		}

	public function setPhotos($photos)
	{
	    $this->photos = $photos;
	}

	public function setVisits($visits)
	{
	    $this->visits = $visits;
	}

	public function setLblVisitsTitle($lblVisitsTitle)
	{
	    $this->lblVisitsTitle = $lblVisitsTitle;
	}

	public function setLblIsExistsTitle($lblIsExistsTitle)
	{
	    $this->lblIsExistsTitle = $lblIsExistsTitle;
	}

	public function setIsExists($IsExists)
	{
	    $this->IsExists = $IsExists;
	}
}

?>