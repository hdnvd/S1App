<?php

namespace Modules\posts\Controllers;
use core\CoreClasses\services\Controller;
use Modules\posts\Entity\posts_languagecategoryEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\posts\Entity\posts_postEntity;
use core\CoreClasses\SweetDate;
use Modules\common\PublicClasses\AppDate;
use Modules\posts\Entity\posts_postlanguagecategoryEntity;
use core\CoreClasses\db\dbaccess;
use Modules\posts\Entity\posts_posttagEntity;
use Modules\posts\Entity\posts_tagEntity;


class postmanageController extends PostManageCTL {
	public function load($PostID=null)
	{
		$LanguageID=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$CE=new posts_languagecategoryEntity();
		$PCE=new posts_postlanguagecategoryEntity();
		$PE=new posts_postEntity($DBAccessor);
		$PTE=new posts_posttagEntity($DBAccessor);
		$TE=new posts_tagEntity($DBAccessor);
		$result['cats']=$CE->Select(array("*"), null, $LanguageID, null, null,null);
		if(!is_null($PostID))
		{
		    $result['postcats']=$PCE->Select(array("*"), null, $PostID, null);
		    $result['posttags']="";
			$result['post']=$PE->Select($PostID, null, null, null, null, null, null, null, null, null, null,null,null,null,null,array(),array(),"0,1");
			$PostTags=$PTE->Select(null, null, $PostID, array(), array(), "0,100");
			for($i=0;$i<count($PostTags);$i++)
			{
			    $Tag=$TE->Select($PostTags[$i]['tag_fid'], null, null, array(), array(), "0,1");
			    if($i!=0)
			     $result['posttags'].=",";
			    $result['posttags'].=$Tag[0]['title'];
			}
		
		}return $result;
	}
	
	public function Edit($PostID,$Title,$Summary,$Content,$ExternalLink,$Thumbnail,$Rank,$Visits,$IsPublished,$LanguageCategoryIDs,$LinkTitle,$Description,$Tags="",$Keywords="",$CanonicalURL="")
	{
		$Today=time();
		$PE=new posts_postEntity(new dbaccess());
		$PE->Update($PostID, $Title, $Summary, $Content, $ExternalLink, $Thumbnail, $Rank, $Visits, $IsPublished, $Today,$Today,$LinkTitle,$Description,$Keywords,$CanonicalURL);
		$PLCE=new posts_postlanguagecategoryEntity();
		$POSTCATS=$PLCE->Select(array("*"), null, $PostID,null);
		for($i=0;$i<count($POSTCATS);$i++)
			$PLCE->Delete($POSTCATS[$i]['id']);
		for($i=0;$i<count($LanguageCategoryIDs);$i++)
		    $PLCE->Insert($PostID, $LanguageCategoryIDs[$i]);
		
		$DBAccessor=new dbaccess();
		$DBAccessor->beginTransaction();
		$this->deletePostTags($PostID, $DBAccessor);
		$this->setTags($PostID, $Tags, $DBAccessor);
		$DBAccessor->commit();
		$DBAccessor->close_connection();
		
		
		return true;
	}
	public function delete($ID)
	{
		$LanguageID=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$PE=new posts_postEntity($DBAccessor);
		$PLCE=new posts_postlanguagecategoryEntity($DBAccessor);
		$PLCE2=new posts_postlanguagecategoryEntity();
		
        $DBAccessor->beginTransaction();
		$PE->Delete($ID);
		$POSTCATS=$PLCE2->Select(array("*"), null, $ID,null);
		for($i=0;$i<count($POSTCATS);$i++)
			$PLCE->Delete($POSTCATS[$i]['id']);
		$this->deletePostTags($ID, $DBAccessor);
		$DBAccessor->commit();
		$DBAccessor->close_connection();
		
		
		return true;
	}
}
?>
