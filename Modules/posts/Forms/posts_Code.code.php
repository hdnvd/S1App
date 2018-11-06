<?php

namespace Modules\posts\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\posts\Controllers\postsController;
use core\CoreClasses\Sweet2DArray;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
use core\CoreClasses\services\ResponseMode;
use Modules\parameters\PublicClasses\ParameterManager;


class posts_Code extends FormCode {
	protected function LoadPosts()
	{
		$postsController=new postsController();
		$translator=new ModuleTranslator("posts");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());

		$CatLatinTitle="articles";
		//******************Pagination Variables******************//
		$PageSize=ParameterManager::getParameter("posts_pagesize");
		$PageNumber=1;
		if(isset($_GET['pn']))
			$PageNumber=$_GET['pn'];
		//******************Pagination******************//
		
		
		//******************Limits For JSON Exports******************//
		$MaxDaysToShow=null;
		if(CURRENT_RESPONSEMODE==ResponseMode::JSON)//If Is JSON
		{
			if(isset($_GET['maxupdatedays']))
				$MaxDaysToShow=$_GET['maxupdatedays'];
			
			$UpdateCount=10;
			if(isset($_GET['updatecount']))
				$UpdateCount=$_GET['updatecount'];
		
			$MaxPosts=-1;
			if(isset($_GET['maxposts']))
				$MaxPosts=$_GET['maxposts'];
		
			$PostCount=0;
			if(isset($_GET['postcount']))
				$PostCount=$_GET['postcount'];
			if($MaxPosts!=-1)
				$ResultCount=min(array($UpdateCount,($MaxPosts-$PostCount)));
			else
				$ResultCount=$UpdateCount;
		}
		else 
			$ResultCount=$PageSize;
		//******************Limits For JSON Exports******************//
		
		$Limit=(($PageNumber-1)*$ResultCount) . ",$ResultCount";
		//echo $Limit;
		
		$MinId=-1;
		$OrderASC=false;
		if(isset($_GET['sort']) && $_GET['sort']=="asc")
			$OrderASC=true;
		if(isset($_GET['lastid']))
			$MinId=$_GET['lastid'];
		if(isset($_GET['category']))
		{
            $CatLatinTitle=$postsController->getCatLatinTitle($_GET['category']);
			$Fields=$postsController->loadLanguageCategoryPosts($_GET['category'],$MinId,$OrderASC,$Limit,$MaxDaysToShow);
			$AllPosts=$postsController->loadLanguageCategoryPosts($_GET['category'],$MinId,$OrderASC,null,$MaxDaysToShow);
			$AllPostsCount=count($AllPosts['posts']);
		}
		elseif(isset($_GET['tag']))
		{
		  $tag=str_ireplace("-", " ", $_GET['tag']);
		  $Fields=$postsController->loadTagPosts($tag, $Limit);
		  $AllPosts=$postsController->loadTagPosts($tag, "0,10000");
		  $AllPostsCount=count($AllPosts['posts']);
		}
		else
		{
			$Fields=$postsController->loadAll($MinId,$OrderASC,$Limit,$MaxDaysToShow);
			$AllPosts=$postsController->loadAll($MinId,$OrderASC,null,$MaxDaysToShow);
			$AllPostsCount=count($AllPosts['posts']);
		}
		$Fields['posts']=Sweet2DArray::array_filp($Fields['posts']);
		
		$links=array();
		for($i=0;$i<count($Fields['posts']['id']);$i++)
		{
		    if($Fields['posts']['canonicalurl'][$i]=="")
		    {
    			$LinkTitle="";
    			if($Fields['posts']['linktitle'][$i]!==null && strlen($Fields['posts']['linktitle'][$i])>0)
    				$LinkTitle=$Fields['posts']['linktitle'][$i];
    			else 
    				$LinkTitle=$Fields['posts']['title'][$i];
    			$urlTitle=substr($LinkTitle,0,120);
    			$urlTitle=str_ireplace(" ", "-", $urlTitle);
    			$urlTitle=str_ireplace("/", "-", $urlTitle);
    
//     			$links[$i]=new AppRooter('articles', $urlTitle);
    // 			print_r($Fields);
    			$links[$i]=new AppRooter($Fields['postcats'][$i][0]['latintitle'], $urlTitle);
    			$links[$i]->setFileFormat(".".$Fields['posts']['id'][$i].".html");
    			//$links[$i]->setAdditionalPath("/" . $Fields['posts']['id'][$i] . "/$urlTitle");
    			$links[$i]=$links[$i]->getAbsoluteURL();
		    }
		    else 
		        $links[$i]=DEFAULT_APPURL . $Fields['posts']['canonicalurl'][$i];
			
		}
		$Result=array();
		$Result['fields']=$Fields;
		$Result['links']=$links;
		$Result['catlatintitle']=$CatLatinTitle;
		$Result['pagecount']=(int)($AllPostsCount/$PageSize);
		if($AllPostsCount%$PageSize!=0)
			$Result['pagecount']++;
		return $Result;
	}
	public function load()
	{
		//final String URL = AppURL+"posts/posts.jsp?lastid="+theID+"&updatecount="+UpdateCount+"&maxpost="+MaxPosts+"&postcount="+String.valueOf(PostCount)+"&deviceid="+android_id+"&sort=asc";
		$Posts=$this->LoadPosts();
		$Fields=$Posts['fields'];
		$design=new posts_Design();
		$design->setTitles($Fields['posts']['title']);
		$design->setPosts($Fields['posts']);
		$design->setLinks($Posts['links']);
		if(key_exists('postcats', $Fields))
		  $design->setPostCats($Fields['postcats']);
		else 
		    $design->setPostCats(null);
		return $design->getResponse();
	}
}
?>
