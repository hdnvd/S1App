<?php

namespace Modules\gallery\Forms;

use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\Image;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\Lable;

/**
 *
 * @author nahavandi
 *        
 */
class showphoto_Design extends FormDesign {
	private $photo;
	private $showTitle;
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\services\FormDesign::getBodyHTML()
	 *
	 */
	public function getBodyHTML($command = "load") {
		
	    if(!is_null($this->photo) && count($this->photo)>0)
	    {
	        $photo=new Image(DEFAULT_PUBLICURL  . $this->photo[0]['url']);
	        $photo->SetAttribute("alt", $this->photo[0]['title']);
	        $photo->setId("gallery_photo");
    	    if($this->showTitle!=null && $this->showTitle=="1")
    	    {
    		  $ImageContainer=new Div();
    		  $ImageContainer->setId("gallery_photocontainer");
    		  $Title=new Lable($this->photo['0']['title']);
    		  $Title->setId("gallery_phototitle");
    		  $Desc=new Lable($this->photo['0']['description']);
    		  $Desc->setId("gallery_photodescription");
    		  $ImageContainer->addElement($Title);
    		  $ImageContainer->addElement($photo);
    		  $ImageContainer->addElement($Desc);
    		  return $ImageContainer;
    	    }
    	    else
    			return $photo;
	    }
	        
	}

	public function setPhoto($photo)
	{
	    $this->photo = $photo;
	}

	public function setShowTitle($showTitle)
	{
	    $this->showTitle = $showTitle;
	}
}

?>