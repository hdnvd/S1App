<?php

namespace Modules\posts\Controllers;
use core\CoreClasses\services\Controller;
use Modules\posts\Entity\posts_view_languagepostEntity;
use Modules\posts\Entity\posts_postEntity;
use Modules\posts\Entity\posts_posttagEntity;
use Modules\posts\Entity\posts_tagEntity;
use core\CoreClasses\db\dbaccess;
use Modules\parameters\Entity\ParameterEntity;
use Modules\posts\Entity\posts_postlanguagecategoryEntity;
use Modules\posts\Entity\posts_languagecategoryEntity;


class postController extends Controller {
	public function load($PostID)
	{
	    $DBAccessor=new dbaccess();
		$DBAccessor->setAutoClose(false);
		$PE=new posts_postEntity($DBAccessor);
		$PLC=new posts_postlanguagecategoryEntity();
		$LC=new posts_languagecategoryEntity();
		$CatIds=$PLC->Select(array("*"), null, $PostID, null);
		for($i=0;$i<count($CatIds);$i++)
		{
		    $result['postcats'][$i]=$LC->Select(array("*"), $CatIds[$i]['languagecategory_fid'], null, null, null, null);
		}
		$result['post']=$PE->Select( $PostID, null, null, null, null, null, null, null, null, null, null,null,null,null,null,array(),array(),"0,1");
        
		$result['posttags']=array();
		if(count($result['post'])>0)
		{
		    $PTEntR=new posts_posttagEntity($DBAccessor);
		    $TEntR=new posts_tagEntity($DBAccessor);
		    $TagIDs=$PTEntR->Select(null, null, $PostID, array(), array(), "0,100");
		    for($i=0;$i<count($TagIDs);$i++)
		    {
		        $result['posttags'][$i]=$TEntR->Select($TagIDs[$i]['tag_fid'], null, null, array(), array(), "0,1");
		        $result['posttags'][$i]=$result['posttags'][$i][0]['title'];
		    }
		}
		if($result['post']!==null && count($result['post'])>0)
			$PE->Update($PostID, null, null, null, null, null, null, ((int)$result['post'][0]['visits']+1), null, null, null,null,null,null,null);
		$param=new ParameterEntity();
		$param=$param->getParameter("posts_showexternallinks");
		$param=$param[0]['value'];
		$result['showexternallinks']=$param;
		return $result;
	}
}
?>
