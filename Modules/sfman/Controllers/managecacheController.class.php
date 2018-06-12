<?php

namespace Modules\sfman\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2016/05/14 16:05:05
 *@lastUpdate 2016/05/14 16:05:05
 *@SweetFrameworkHelperVersion 1.109
*/


class managecacheController extends Controller {
    private $deletedFiles=0;
//     private $deletedBytes=0;
	public function load()
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	private function rrmdir($dir) {
	    if (is_dir($dir)) {
	        $objects = scandir($dir);
	        foreach ($objects as $object) {
	            if ($object != "." && $object != "..") {
	                if (filetype($dir."/".$object) == "dir")
	                    $this->rrmdir($dir."/".$object);
	                else 
	                {
	                    unlink($dir."/".$object);
	                    $this->deletedFiles++;
// 	                    $this->deletedBytes+=filesize($dir."/".$object);
	                }
	            }
	        }
	        reset($objects);
	        rmdir($dir);
	    }
	}
	public function clearcache()
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
		$cachePath=DEFAULT_PUBLICPATH . "content/files/tmp/";
		if(file_exists($cachePath))
		    $this->rrmdir($cachePath);
		mkdir($cachePath);
		$result['deletedfiles']=$this->deletedFiles;
// 		$result['deletedbytes']=$this->deletedBytes;
		$DBAccessor->close_connection();
		return $result;
	}
}
?>
