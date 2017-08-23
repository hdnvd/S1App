<?php

namespace Modules\posts\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\posts\Controllers\updateserviceController;
use Modules\posts\Exceptions\PostExistsException;
use Modules\posts\PublicClasses\asriranDastanCrawler;
use Modules\posts\PublicClasses\Crawler;
use Modules\posts\PublicClasses\dastanakCrawler;
use Modules\posts\PublicClasses\asriranHealthCrawler;
use Modules\posts\PublicClasses\irnaMaraghehCrawler;
use Modules\posts\PublicClasses\farsnewsMaraghehCrawler;
use Modules\posts\PublicClasses\maraghehErshadCrawler;
use Modules\posts\PublicClasses\maraghehMehrCrawler;


class updateservice_Code extends FormCode {
	public function load()
	{
		$updateserviceController=new updateserviceController();
		$translator=new ModuleTranslator("posts");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Msg="";
		$result=$updateserviceController->load();
		$MaxPosts=$result['maxposts'];
		$PostService="DefaultService";
		if(isset($_GET['postservice']))
			$PostService=$_GET['postservice'];
		
		if($PostService=="asrirandastan")
		{
			$Msg.="<p><b>Asriran</b></p>";
			$asriran=new asriranDastanCrawler();
			$Msg.=$this->Add($asriran);
		}

		if($PostService=="dastanak")
		{
			$Msg.="<p><b>Dastanak</b></p>";
			$dastanak=new dastanakCrawler($MaxPosts);
			$Msg.=$this->Add($dastanak);
		}
		if($PostService=="asriranhealth")
		{
			$Msg.="<p><b>Asriran&nbsp;Health</b></p>";
			$dastanak=new asriranHealthCrawler($MaxPosts);
			$Msg.=$this->Add($dastanak);
		}
		if($PostService=="irnamaragheh")
		{
		    $Msg.="<p><b>Irna&nbsp;Maragheh</b></p>";
		    $dastanak=new irnaMaraghehCrawler($MaxPosts);
		    $Msg.=$this->Add($dastanak);
		}
		if($PostService=="farsnewsmaragheh")
		{
		    $Msg.="<p><b>FarsNews&nbsp;Maragheh</b></p>";
		    $dastanak=new farsnewsMaraghehCrawler($MaxPosts);
		    $Msg.=$this->Add($dastanak);
		}
		if($PostService=="maraghehershad")
		{
		    $Msg.="<p><b>Ershad&nbsp;Maragheh</b></p>";
		    $dastanak=new maraghehErshadCrawler($MaxPosts);
		    $Msg.=$this->Add($dastanak);
		}

		if($PostService=="maraghehmehr")
		{
		    $Msg.="<p><b>Mehr&nbsp;Maragheh</b></p>";
		    $dastanak=new maraghehMehrCrawler($MaxPosts);
		    $Msg.=$this->Add($dastanak);
		}
		if($Msg!="")
			return $Msg;
		$design=new updateservice_Design();
		return $design->getBodyHTML();
	}
	private function Add(Crawler $theCrawler)
	{
		$updateserviceController=new updateserviceController();
		$Msg="";
// 		echo "Adding:";
		$result=$updateserviceController->load();
		$IsPublished=$result['publish'];
		$Posts=$theCrawler->getPostsArray();
		//print_r($Posts['thumbnails']);
		for($i=count($Posts['titles'])-1;$i>=0;$i--)
		{
			try
			{
			
			    if(trim($Posts['titles'][$i])!="")
			    {
			    $thumb="";
			    if(key_exists('thumbnails',$Posts))
			    	$thumb=$Posts['thumbnails'][$i];
			    	//echo $thumb;
				    $updateserviceController->Add($Posts['titles'][$i], $Posts['summary'][$i], $Posts['contents'][$i], $Posts['links'][$i], $thumb, "0", "0", $IsPublished, "1",$Posts['titles'][$i], $Posts['description'][$i]);
				    $Msg.= "Post " . ($i+1) . " Inserted!<br/>";
			    }
			    else
			        $Msg.= "Post " . ($i+1) . " Have No Title!<br/>";
			}
			catch (PostExistsException $e)
			{
				$Msg.= "Post " . ($i+1) . " already exists!<br/>";
			}
		}
		return $Msg;		
	}
	
}
?>
