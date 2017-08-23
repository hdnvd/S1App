<?php

namespace Modules\posts\Controllers;
use core\CoreClasses\services\Controller;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\posts\Entity\posts_postlanguagecategoryEntity;
use Modules\posts\Entity\posts_view_languagecategorypostEntity;
use Modules\posts\Entity\posts_view_languagepostEntity;
use core\CoreClasses\SweetDate;
use Modules\common\PublicClasses\AppDate;
use Modules\posts\Entity\posts_languagecategoryEntity;
use Modules\posts\Entity\posts_posttagEntity;
use Modules\posts\Entity\posts_tagEntity;
use Modules\posts\Entity\posts_postEntity;
use core\CoreClasses\db\dbaccess;


class postsController extends Controller {
	public function loadAll($MinId=-1,$OrderAscending=false,$Limit=null,$MaxDaysToShow=null)
	{
		$dayLength=24*60*60;
		$MinDate=null;
		if($MaxDaysToShow!==null)
		{
		    $MinDate=time()-$dayLength*$MaxDaysToShow;
		    //$MinDate=date('Y-m-d', strtotime('-' . $MaxDaysToShow . ' day'));
		}
		$LanguageID=CurrentLanguageManager::getCurrentLanguageID();
		$CE=new posts_view_languagepostEntity();
		$result['posts']=$CE->Select($LanguageID,$MinId,true,$OrderAscending,$Limit,$MinDate);
		$PLCE=new posts_view_languagecategorypostEntity();
		for($i=0;$i<count($result['posts']);$i++)
			$result['postcats'][$i]=$PLCE->SelectPostCats($result['posts'][$i]['id']);
		return $result;
	}
	
	public function loadLanguageCategoryPosts($LanguageCategoryID,$MinId=-1,$OrderAscending=false,$Limit=null,$MaxDaysToShow=null,$orderBy="post.id")
	{
		$LanguageID=CurrentLanguageManager::getCurrentLanguageID();
		$PLCE=new posts_view_languagecategorypostEntity();
		$CatE=new posts_languagecategoryEntity();
		$result['catInfo']=$CatE->Select(array("*"), $LanguageCategoryID, $LanguageID, null, null, null);
		$result['catInfo']=$result['catInfo'][0];
		$dayLength=24*60*60;
		$MinDate=null;
		if($MaxDaysToShow!==null)
		{
		    $MinDate=time()-$dayLength*$MaxDaysToShow;
		    //$MinDate=date('Y-m-d', strtotime('-' . $MaxDaysToShow . ' day'));
		}

		$result['posts']=$PLCE->Select($LanguageCategoryID,$MinId,true,$OrderAscending,$Limit,$MinDate,$orderBy);
		for($i=0;$i<count($result['posts']);$i++)
			$result['postcats'][$i]=$PLCE->SelectPostCats($result['posts'][$i]['id']);
		return $result;
	}
	public function loadTagPosts($TagTitle,$Limit)
	{
	    $LanguageID=CurrentLanguageManager::getCurrentLanguageID();
	    $DBAccessor=new dbaccess();
	    $DBAccessor->setAutoClose(false);
	    $PTER=new posts_posttagEntity($DBAccessor);
	    $TER=new posts_tagEntity($DBAccessor);
	    $PER=new posts_postEntity($DBAccessor);
	    $TagID=$TER->Select(null, $TagTitle, null, array(), array(), "0,1");
	    $result=array();
	    $result['posts']=array();
	    if(count($TagID)>0)
	    {
	        $PostIDs=$PTER->Select(null, $TagID[0]['id'], null, array(), array(), $Limit);
	        for($i=0;$i<count($PostIDs);$i++)
	        {
	           $result['posts'][$i]=$PER->Select($PostIDs[$i]['post_fid'], null, null, null, null, null, null, null, null, null, null, null, null,null,null,array(),array(),"0,1");
	           $result['posts'][$i]=$result['posts'][$i][0];
	        }
	        $PLCE=new posts_view_languagecategorypostEntity();
	        for($i=0;$i<count($result['posts']);$i++)
	            $result['postcats'][$i]=$PLCE->SelectPostCats($result['posts'][$i]['id']);
	    }
	    $DBAccessor->close_connection();
		return $result;
	}
	public function getAllCount()
	{
		$CE=new posts_view_languagepostEntity();
		return $CE->getCount();
	}
}
?>
