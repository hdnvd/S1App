<?php

namespace Modules\gallery\Forms;

use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\gallery\Entity\galleryphotoEntity;
use Modules\gallery\Controllers\photoListController;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;

/**
 *
 * @author hadi
 *        
 */
class photolist_Code extends FormCode {
    private $Result;
    private $ContentLoaded;
	public function __construct($namespace=null)
	{
	    $this->ContentLoaded=false;
	    $this->LoadContent();
		parent::__construct($namespace);
		
	}
	public function getTitle()
	{
	    $this->LoadContent();
	    if(isset($_GET['album']))
	        $this->setTitle($this->Result['data'][0]['albuminfo']['title']);
	    else 
	        $this->setTitle("گالری تصاویر"); 
	    return parent::getTitle();
	}
    private function LoadContent()
    {
        if(!$this->ContentLoaded)
        {
            $langID=CurrentLanguageManager::getCurrentLanguageID();
            $controller=new photoListController();
            $albumid=null;
            if(isset($_GET['album']))
                $albumid=$_GET['album'];
            $minID=-1;
            if(isset($_GET['lastid']))
                $minID=$_GET['lastid'];
            $this->Result=$controller->load($albumid,$minID);
	        $this->ContentLoaded=true;
        }
    }
	public function getCanonicalURL()
	{
	    $link=new AppRooter("gallery","");
	    $link->setFileFormat("");
	    $this->setCanonicalURL($link->getAbsoluteURL());
	    return parent::getCanonicalURL();
	}
	public function load()
	{
	    $this->LoadContent();
		$design=new photolist_Design();
		$design->setData($this->Result['data']);
		$design->setColumns($this->Result['columns']);
		$design->setPageSize($this->Result['pagesize']);
		$design->setHighQualityThumbs($this->Result['gallery_highqualitythumbs']);
		if(isset($_GET['pn']))
		    $design->setPageNumber($_GET['pn']);
		else 
		    $design->setPageNumber(1);
		return $design->getResponse();
	}
}

?>