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
use core\CoreClasses\services\WidgetCode;


class postswidget_Code extends WidgetCode {
	protected function LoadPosts()
	{
		$postsController=new postsController();
		
		$Limit="0,10";
		//echo $Limit;
		
		$MinId=-1;
		$LanguageCategoryID=(string)$this->getField("catid");
		$OrderBy=(string)$this->getField("orderby");
		if($OrderBy=="")
		    $OrderBy="post.id";
		$OrderASC=(string)$this->getField("orderbyasc");
		$Count=(string)$this->getField("count");
		if($OrderASC!=1)
		    $OrderASC=false;
		else 
		    $OrderASC=true;
		$Fields=$postsController->loadLanguageCategoryPosts($LanguageCategoryID,-1,$OrderASC,"0,$Count",null,$OrderBy);
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
		return $Result;
	}
	public function load()
	{
		//final String URL = AppURL+"posts/posts.jsp?lastid="+theID+"&updatecount="+UpdateCount+"&maxpost="+MaxPosts+"&postcount="+String.valueOf(PostCount)+"&deviceid="+android_id+"&sort=asc";
		$Posts=$this->LoadPosts();
		$Fields=$Posts['fields'];
		$design=new postswidget_Design();
		$design->setTitles($Fields['posts']['title']);
		$design->setLinks($Posts['links']);
		return $design->getBodyHTML();
	}
}
?>
