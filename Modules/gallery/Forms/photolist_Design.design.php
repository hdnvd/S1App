<?php

namespace Modules\gallery\Forms;

use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\Image;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\link;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\Lable;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;

/**
 *
 * @author hadi
 *        
 */
class photolist_Design extends FormDesign {
	private $Data;
	private $Columns;
	private $PageSize;
	private $PageNumber;
	private $HighQualityThumbs;
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\services\FormDesign::getBodyHTML()
	 *
	 */
	public function getBodyHTML($command = "load") {
		
		$table=new ListTable(1);
		$table->setId("gallery_photolistpage");
		//print_r($this->Data);
		//echo $this->Columns[0];
		for($gi=0;$gi<count($this->Data);$gi++)
		{
			$Title[$gi]=new Div();
			$Title[$gi]->setClass("gallery_albumtitle");
			$Title[$gi]->addElement(new Lable($this->Data[$gi]['albuminfo']['title']));
			$table->addElement($Title[$gi]);
			$AlbumPhotosDiv[$gi]=new ListTable($this->Columns);
			$AlbumPhotosDiv[$gi]->setClass("gallery_albumphotolist");
			$PhotoLink=array();
			for($gpi=($this->PageNumber-1)*$this->PageSize;$gpi<count($this->Data[$gi]['photos']) && $gpi<$this->PageNumber*$this->PageSize;$gpi++)
			{
				$tmpLink=new AppRooter("gallery", "showphoto");
				$tmpLink->addParameter(new UrlParameter("id", $this->Data[$gi]['photos'][$gpi]['photoid']));
				$tmpLink=$tmpLink->getAbsoluteURL();
				$PhotoDiv[$gi][$gpi]=new Div();
				if($this->HighQualityThumbs==1)
				    $Photo[$gi][$gpi]=new Image(DEFAULT_PUBLICURL . $this->Data[$gi]['photos'][$gpi]['photourl']);
				else 
				    $Photo[$gi][$gpi]=new Image(DEFAULT_PUBLICURL . $this->Data[$gi]['photos'][$gpi]['photothumburl']);
				$Photo[$gi][$gpi]->SetAttribute("alt", $this->Data[$gi]['photos'][$gpi]['phototitle']);
				$PhotoLink[$gi][$gpi]=new link($tmpLink,$Photo[$gi][$gpi]);
				$PhotoDiv[$gi][$gpi]->addElement($PhotoLink[$gi][$gpi]);
				$PhotoTitleDiv[$gi][$gpi]=new Div();
				
				$TitleLink[$gi][$gpi]=new link($tmpLink, new Lable($this->Data[$gi]['photos'][$gpi]['phototitle']));
				
				$PhotoTitleDiv[$gi][$gpi]->addElement($TitleLink[$gi][$gpi]);
				$PhotoDiv[$gi][$gpi]->addElement($PhotoTitleDiv[$gi][$gpi]);
				
				
				$PhotoDiv[$gi][$gpi]->setClass("gallery_photolistphoto");
				$AlbumPhotosDiv[$gi]->addElement($PhotoDiv[$gi][$gpi]);
			}
			$table->addElement($AlbumPhotosDiv[$gi]);
			if($this->PageSize<count($this->Data[$gi]['photos']))
			{
			    $Pagination=new Div();
			    $Pagination->setId("gallery_pagination");
			    
			    $PagesCount=count($this->Data[$gi]['photos'])/$this->PageSize;
			    if(count($this->Data[$gi]['photos'])%$this->PageSize>0)
			        $PagesCount++;
			    for($PageNumber=1;$PageNumber<$PagesCount;$PageNumber++)
			    {
			        $link[$PageNumber]=new AppRooter("gallery", "photolist");
			        $link[$PageNumber]->addParameter(new UrlParameter("pn", $PageNumber));
			        $PageLink[$PageNumber]=new link($link[$PageNumber]->getAbsoluteURL(), new Lable($PageNumber));
			        $Pagination->addElement($PageLink[$PageNumber]);
			    }
			    $table->addElement($Pagination);
			}
			
		}
		return $table;
	}
	/*public function getXML(){
		$Page=new \SimpleXMLElement("<photos></photos>");
		for($i=0;$i<count($this->photos['id']);$i++)
		{
			$Page2=$Page->addChild("photo");
			$Page2->addChild("id",$this->photos['id'][$i]);
			$Page2->addChild("title",htmlspecialchars(str_replace('"',"'",$this->photos['title'][$i]), ENT_QUOTES));
			$Page2->addChild("thumb",htmlspecialchars(str_replace('"',"'",$this->photos['thumburl'][$i]), ENT_QUOTES));
			$Page2->addChild("url",htmlspecialchars(str_replace('"',"'",$this->photos['url'][$i]), ENT_QUOTES));
		}
		return $Page;
	}*/
	public function getJSON()
	{
	   $ReturnData=array();
	   $gi=0;
	   for($gpi=0;$gpi<count($this->Data[$gi]['photos']);$gpi++)
	   {  
    	   $ReturnData[$gpi]['id']=$this->Data[$gi]['photos'][$gpi]['photoid'];
    	   $ReturnData[$gpi]['phototitle']=$this->Data[$gi]['photos'][$gpi]['phototitle'];
    	   $ReturnData[$gpi]['description']=$this->Data[$gi]['photos'][$gpi]['photodescription'];
    	   $ReturnData[$gpi]['thumbnailurl']=DEFAULT_PUBLICURL . $this->Data[$gi]['photos'][$gpi]['photothumburl'];
    	   $ReturnData[$gpi]['photourl']=DEFAULT_PUBLICURL . $this->Data[$gi]['photos'][$gpi]['photourl'];
	   }
	   $fullReturnData=array("photos"=>$ReturnData);
	   $result=str_replace("&lt;","<",json_encode($fullReturnData));
	   $result=str_replace("&gt;", ">", $result);
	   return $result;
	}

	public function setData($Data)
	{
	    $this->Data = $Data;
	}

	public function setColumns($Columns)
	{
	    $this->Columns = $Columns;
	}

	public function setPageSize($PageSize)
	{
	    $this->PageSize = $PageSize;
	}

	public function setPageNumber($PageNumber)
	{
	    $this->PageNumber = $PageNumber;
	}

	public function setHighQualityThumbs($HighQualityThumbs)
	{
	    $this->HighQualityThumbs = $HighQualityThumbs;
	}
}

?>