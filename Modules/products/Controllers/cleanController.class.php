<?php

namespace Modules\products\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\products\Entity\ProductEntity;
use Modules\products\Entity\ProductPhotoEntity;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/07/06 11:26:45
 *@lastUpdate 2015/07/06 11:26:45
 *@SweetFrameworkHelperVersion 1.106
*/


class cleanController extends Controller {
	public function load()
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function clean()
	{
	    $Language_fid=CurrentLanguageManager::getCurrentLanguageID();
	    $DBAccessor=new dbaccess();
	    $result=array();
	    //die(DEFAULT_PUBLICPATH);
	    $PrEnt=new ProductEntity($DBAccessor);
	    $PrPEnt=new ProductPhotoEntity($DBAccessor);
	    $Path="content/files/products/img/";
	    $ThumbDir="content/files/products/img/thumbnails/";
	    $Photos = array_diff(scandir(DEFAULT_PUBLICPATH . $Path), array('..', '.',"thumbnails"));
	    $ThumbCount=0;
	    $MainPhotoCount=0;
	    foreach($Photos as $photo)
	    {
	        $ProductResult=$PrEnt->Select(null, null, null, null, $Path . $photo, null, null, null, null,null , null, "0,1", array("id"), array(false));
	        $ProductPhotoResult=$PrPEnt->Select(null, null, $Path . $photo, null, null,"0,1", array("id"), array(false));
	        if(($ProductResult==null || count($ProductResult)<=0) && ($ProductPhotoResult==null || count($ProductPhotoResult)<=0))
	        {
	            unlink(DEFAULT_PUBLICPATH . $Path .$photo);
	            echo "<br>File " . $photo . "Deleted!";
	            $MainPhotoCount++;
	        }
	    }
	    
	    
	    $Photos = array_diff(scandir(DEFAULT_PUBLICPATH . $ThumbDir), array('..', '.'));
	    foreach($Photos as $photo)
	    {
	        $ProductResult=$PrEnt->Select(null, null, null, null,  null,$ThumbDir . $photo, null, null, null,null , null, "0,1", array("id"), array(false));
	        if($ProductResult==null || count($ProductResult)<=0)
	        {
	            unlink(DEFAULT_PUBLICPATH . $ThumbDir .$photo);
	            echo "<br>File Thumb" . $photo . "Deleted!";
	            $ThumbCount++;
	        }
	    }
	    
	    echo "<br><br>$MainPhotoCount Photos Deleted!";
	    echo "<br><br>$ThumbCount Thumbnails Deleted!";
	    
	    
	    $result['param1']="";
	    $DBAccessor->close_connection();
	    return $result;
	}
}
?>
