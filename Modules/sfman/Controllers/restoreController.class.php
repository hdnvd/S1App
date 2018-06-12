<?php

namespace Modules\sfman\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\File\SweetZipArchive;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 1395/3/1 - 2016/05/21 21:19:45
 *@lastUpdate 1395/3/1 - 2016/05/21 21:19:45
 *@SweetFrameworkHelperVersion 1.112
*/


class restoreController extends Controller {
    private $TMPPath;
    private $BackupTempPath;
    public function __construct()
    {
        $this->TMPPath=DEFAULT_PUBLICPATH . "content/files/tmp/";
        $this->BackupTempPath=$this->TMPPath . "BackTemp/";
    }
	public function load()
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function restoreApp($Name,$TempName)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
		$result['param1']="";
		$BackupPath=$this->TMPPath . $Name;
		for($i=0;file_exists($BackupPath . $i);$i++);
		$BackupPath .=$i;
		move_uploaded_file($TempName, $BackupPath);
		$sZipA=new SweetZipArchive();
		$sZipA->open($BackupPath);
		$sZipA->extractTo($this->BackupTempPath . $Name . $i);
		unlink($BackupPath);
		$this->rrmdir(DEFAULT_APPPATH);
		rename($this->BackupTempPath . $Name . $i . "/App/", DEFAULT_APPPATH);
		
		$DBAccessor->close_connection();
		return $result;
	}
	public function restoreFramework($Name,$TempName)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
		$result['param1']="";
		$BackupPath=$this->TMPPath . $Name;
		for($i=0;file_exists($BackupPath . $i);$i++);
		$BackupPath .=$i;
		move_uploaded_file($TempName, $BackupPath);
		$sZipA=new SweetZipArchive();
		$sZipA->open($BackupPath);
		$sZipA->extractTo($this->BackupTempPath . $Name . $i);
		unlink($BackupPath);
		$this->rrmdir(DEFAULT_FRAMEWORKPATH);
		rename($this->BackupTempPath . $Name . $i . "/framework/", DEFAULT_FRAMEWORKPATH);
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
	                }
	            }
	        }
	        reset($objects);
	        rmdir($dir);
	    }
	}
}
?>
