<?php

namespace Modules\posts\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\posts\Controllers\postmanageController;
use Modules\posts\Exceptions\PostExistsException;
use Modules\parameters\PublicClasses\ParameterManager;

class postmanage_Code extends FormCode {
	public function __construct($namespace=null)
	{
		parent::__construct($namespace);
		$this->setTitle("مدیریت مطالب");
		$this->setThemePage("admin.php");
	}
	public function load()
	{
		
		if(isset($_GET['publish']))
			return $this->changePublish($_GET['publish']);
		elseif(isset($_GET['delete']))
			return $this->delete();
		else 
			$design=new postmanage_Design();
			$this->setContent($design);
			$this->setLables($design);
			return $design->getBodyHTML();
	}
	private function setContent(postmanage_Design $design)
	{
		$postmanageController=new postmanageController();

		$Fields=array();
		if(!isset($_GET['id']))
			$Fields=$postmanageController->load();
		else
		    $Fields=$postmanageController->load($_GET['id']);
		$design->setAllCats($Fields['cats']);
		if(array_key_exists("post", $Fields))
		{
			$design->setTxtTitle($Fields['post'][0]['title']);
			$design->setTxtSummary($Fields['post'][0]['summary']);
			$design->setTxtContent($Fields['post'][0]['content']);
			$design->setTxtExternalLink($Fields['post'][0]['externallink']);
			$design->setTxtVisits($Fields['post'][0]['visits']);
			$design->setHidID($Fields['post'][0]['id']);
			$design->setTxtLinkTitle($Fields['post'][0]['linktitle']);
			$design->setTxtDescription($Fields['post'][0]['description']);
			$design->setBtnSaveAction("Edit");
			$design->getTxtTags()->setValue($Fields['posttags']);
			$design->getTxtKeywords()->setValue($Fields['post'][0]['keywords']);
			$design->getTxtCanonicalURL()->setValue($Fields['post'][0]['canonicalurl']);
			$design->setPostCats($Fields['postcats']);	
			$param=new ParameterManager();
			if($param->getParameter("posts_showcanonicalurl")=="1")
			    $design->setFlgShowCanonicalURL(true);
			   
		}
		else 
		{
		    $param=new ParameterManager();
			if($param->getParameter("posts_showcanonicalurl")=="1")
			    $design->setFlgShowCanonicalURL(true);
			$design->setBtnSaveAction("Add");
		}
		
	}
	private function setLables(postmanage_Design $design)
	{
		$translator=new ModuleTranslator("posts");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design->setLblLinkTitle($translator->getWordTranslation("lbllinktitle"));
		$design->setLblTitle($translator->getWordTranslation("lbltitle"));
		$design->setLblSummary($translator->getWordTranslation("lblsummary"));
		$design->setLblContent($translator->getWordTranslation("lblcontent"));
		$design->setLblExternalLink($translator->getWordTranslation("lblexternallink"));
		$design->setLblVisits($translator->getWordTranslation("lblvisits"));
		$design->setLblCat($translator->getWordTranslation("lblcat"));
		$design->setLblDescriptionTitle($translator->getWordTranslation("lbldescription"));
		$design->setBtnSave($translator->getWordTranslation("btnsave"));
	}
	public function Add_Click()
	{
		$translator=new ModuleTranslator("posts");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new message_Design();
		$page=new postmanage_Design();
		$postmanageController=new postmanageController();
		try {

		    $tags=str_ireplace("-", "_", $page->getTxtTags()->getValue());
		    $keywords=str_ireplace("-", ",", $page->getTxtKeywords()->getValue());
		    $keywords=str_ireplace("،", ",", $keywords);
		    
		$postmanageController->Add($_POST['txtTitle'],$_POST['txtTitle'], $_POST['txtSummary'], $_POST['txtContent'],$_POST['txtExternalLink'] , "Not Implemented","0",$_POST['txtVisits'] ,"1" , $_POST['cats'],$_POST['txtLinkTitle'],$_POST['txtDescription'],$tags,$keywords,$page->getTxtCanonicalURL()->getValue());
		$design->setMessage($translator->getWordTranslation("postadded"));
		}
		catch (PostExistsException $Ex)
		{
			$design->setMessage($translator->getWordTranslation("postexists"));
		}
		return $design->getBodyHTML();
	}
	public function Edit_Click()
	{

	    $page=new postmanage_Design();
		$postmanageController=new postmanageController();
		$tags=str_ireplace("-", "_", $page->getTxtTags()->getValue());
		$keywords=str_ireplace("-", ",", $page->getTxtKeywords()->getValue());
		$keywords=str_ireplace("،", ",", $keywords);
		$postmanageController->Edit($_POST['hidid'],$_POST['txtTitle'], $_POST['txtSummary'], $_POST['txtContent'],$_POST['txtExternalLink'] , "Not Implemented","0",$_POST['txtVisits'] ,null , $_POST['cats'],$_POST['txtLinkTitle'],$_POST['txtDescription'],$tags,$keywords,$page->getTxtCanonicalURL()->getValue());
		$translator=new ModuleTranslator("posts");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new message_Design();
		$design->setMessage($translator->getWordTranslation("postedited"));
		return $design->getBodyHTML();
	}
	private function delete()
	{
		$postmanageController=new postmanageController();
		$postmanageController->delete($_GET['id']);
		
		$translator=new ModuleTranslator("posts");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new message_Design();
		$design->setMessage($translator->getWordTranslation("postdeleted"));
		return $design->getBodyHTML();
	}
	private function changePublish($Publish)
	{
		$postmanageController=new postmanageController();
		$postmanageController->Edit($_GET['id'], null, null, null, null, null, null, null, $Publish, null, null,null,null);
	
		$translator=new ModuleTranslator("posts");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new message_Design();
		if($Publish=="1")
			$design->setMessage($translator->getWordTranslation("postpublished"));
		else
			$design->setMessage($translator->getWordTranslation("postunpublished"));
		return $design->getBodyHTML();
	}
}
?>
