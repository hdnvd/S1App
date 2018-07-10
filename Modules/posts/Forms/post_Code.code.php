<?php

namespace Modules\posts\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\posts\Controllers\postController;
use Modules\common\PublicClasses\AppRooter;
use Modules\parameters\PublicClasses\ParameterManager;


class post_Code extends FormCode {
	private $Fields,$ContentLoaded;
	public function __construct($namespace=null)
	{
		parent::__construct($namespace);
		$this->ContentLoaded=false;
	}
	public function getTitle()
	{
		$this->LoadContent();
		$this->setTitle($this->Fields['post'][0]['title']);
		return parent::getTitle();
	}
	public function getDescription()
	{
		$this->LoadContent();
		$this->setDescription($this->Fields['post'][0]['description']);
		return parent::getDescription();
	}
	public function getKeywords()
	{
		$this->LoadContent();
		$this->setKeywords($this->Fields['post'][0]['keywords']);
		return parent::getKeywords();
	}
    public function getCanonicalURL()
    {
        $this->LoadContent();
        if($this->Fields['post'][0]['canonicalurl']!="")
            $this->setCanonicalURL(DEFAULT_APPURL . $this->Fields['post'][0]['canonicalurl']);
        else 
        {
            $LinkTitle="";
            if($this->Fields['post'][0]['linktitle']!==null && strlen($this->Fields['post'][0]['linktitle'])>0)
                $LinkTitle=$this->Fields['post'][0]['linktitle'];
            else
                $LinkTitle=$this->Fields['post'][0]['title'];
            $urlTitle=substr($LinkTitle,0,120);
            $urlTitle=str_ireplace(" ", "-", $urlTitle);
            $urlTitle=str_ireplace("/", "-", $urlTitle);
            $FirstCat=$this->Fields['postcats'][0][0]['latintitle'];
            $link=new AppRooter($FirstCat, $LinkTitle);
            $link->setFileFormat(".".$this->Fields['post'][0]['id'].".html");
            $link=$link->getAbsoluteURL();
            $this->setCanonicalURL($link);
        }
        return parent::getCanonicalURL();
        
    }
	private function LoadContent()
	{
		if(!$this->ContentLoaded)
		{
			$postController=new postController();
			$this->Fields=$postController->load($_GET['id']);
			$this->ContentLoaded=true;
		}
	}
	public function load()
	{
		$this->LoadContent();
		$translator=new ModuleTranslator("posts");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new post_Design();
		$design->setLblTitle($this->Fields['post'][0]['title']);
		$design->setLblLastUpdate($this->Fields['post'][0]['lastupdate']);
		$design->setLblContent($this->Fields['post'][0]['content']);
		$design->setLblLastUpdateTitle($translator->getWordTranslation("lbllastupdate"));
		$design->setLblVisitsTitle($translator->getWordTranslation("lblvisits"));
		$design->setLblVisits($this->Fields['post'][0]['visits']);
		$design->setLinkCategories($translator->getWordTranslation("linkcategories"));
		$LinkTitle="";
		if($this->Fields['post'][0]['linktitle']!==null && strlen($this->Fields['post'][0]['linktitle'])>0)
			$LinkTitle=$this->Fields['post'][0]['linktitle'];
		else 
			$LinkTitle=$this->Fields['post'][0]['title'][0];
		
		//$links[$i]->addParameter(new UrlParameter("id", $Fields['posts']['id'][$i]));
		if($this->Fields['post'][0]['canonicalurl']!="")
		    $design->setPostLink(DEFAULT_APPURL . $this->Fields['post'][0]['canonicalurl']);
		else
		{
		  $urlTitle=substr($LinkTitle,0,120);
		  $urlTitle=str_ireplace(" ", "-", $urlTitle);
		  $urlTitle=str_ireplace("/", "-", $urlTitle);
		  $FirstCat=$this->Fields['postcats'][0][0]['latintitle'];
		  $links=new AppRooter($FirstCat, $urlTitle);
		  $links->setFileFormat(".".$this->Fields['post'][0]['id'].".html");
		  $links=$links->getAbsoluteURL();
		  $design->setPostLink($links);
		}
		$design->setExternalLink($this->Fields['post'][0]['externallink']);
		$design->setShowExternalLinks($this->Fields['showexternallinks']);
		$design->setTags($this->Fields['posttags']);
		return $design->getResponse();
	}
}
?>
