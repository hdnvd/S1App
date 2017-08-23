<?php

namespace Modules\sfman\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\parameters\PublicClasses\ParameterManager;
use core\CoreClasses\SweetDate;
use core\CoreClasses\File\SweetZipArchive;
use Ifsnop\Mysqldump\Mysqldump;
use Ifsnop\Mysqldump\CompressMethod;
use Ifsnop\Mysqldump\CompressManagerFactory;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2016/05/18 19:52:46
 *@lastUpdate 2016/05/18 19:52:46
 *@SweetFrameworkHelperVersion 1.110
*/


class backupController extends Controller {
    private $TMPPath;
    private $BackupPath;
	private	$TMPURL;
	private	$BackupURL;
	private	$Time;
	public function __construct()
	{
	    $this->TMPPath=DEFAULT_PUBLICPATH . "content/files/tmp/";
	    $this->BackupPath=$this->TMPPath . "backups/";
	    $this->TMPURL=DEFAULT_PUBLICURL . "content/files/tmp/";
	    $this->BackupURL=$this->TMPURL . "backups/";
	    date_default_timezone_set("Asia/Tehran");
	    $date = new SweetDate(true, true, 'Asia/Tehran');
	    $this->Time=$date->date("Y-m-d--H-i",false,false);
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
	private function MakeBackup($BackupInfo,$SourceDirectory,$BackupFileName,$MotherDirectory=null)
	{
	    $BackupInfo.="\nBackupTime:$this->Time";
	    $BackupInfo.="\nBackupFrom:" . DEFAULT_APPURL;
	    $BackupFilePath=$this->BackupPath . $BackupFileName;
	    
	    if(!file_exists($this->BackupPath))
	        mkdir($this->BackupPath);
	    if(file_exists($BackupFilePath))
	        unlink($BackupFilePath);
	    
	    $zip = new SweetZipArchive();
	    $zip->AddExcludedPath($this->TMPPath);
	    if ($zip->open($BackupFilePath, \ZipArchive::CREATE)!==TRUE) {
	        exit("cannot open <$filename>\n");
	    }
	    $zip->addFromString("BackupInfo.log", $BackupInfo);
	    if($MotherDirectory==null)
	       $zip->addTree($SourceDirectory);
	    else
	        $zip->addTree($SourceDirectory,$MotherDirectory);
	       
	    $zip->close();
	}
	public function GenerateAppBackup()
	{
		$result=array();
		$paramName="sfman_appbackupcounter";
		$counter=ParameterManager::getParameter($paramName);
		if($counter=="")
            $counter=1;
		
		$FileName="SweetOneBackup-" . $this->Time . " -" . $counter . ".zip"; 
		$BackupInfo="Application Path:" . DEFAULT_APPPATH;
		$this->MakeBackup($BackupInfo, DEFAULT_APPPATH, $FileName,"App");
		
		$counter++;
		ParameterManager::updateParameter($paramName, $counter);
		$result['filepath']=$this->BackupPath . $FileName;
		$result['fileurl']=$this->BackupURL . $FileName;
		return $result;
	}
	
	public function GenerateFrameworkBackup()
	{
	    $result=array();
	    $paramName="sfman_frameworkbackupcounter";
	    $counter=ParameterManager::getParameter($paramName);
	    if($counter=="")
	        $counter=1;
	    $FileName="SweetFrameworkBackup-" . $this->Time . " -" . $counter . ".zip";
	    $BackupInfo="Framework Path:" . DEFAULT_FRAMEWORKPATH;
	    $this->MakeBackup($BackupInfo, DEFAULT_FRAMEWORKPATH, $FileName,"framework");
	    $counter++;
	    ParameterManager::updateParameter($paramName, $counter);
	    $result['filepath']=$this->BackupPath . $FileName;
	    $result['fileurl']=$this->BackupURL . $FileName;
	    return $result;
	}
	public function GenerateFilesBackup()
	{
	    $result=array();
	    $paramName="sfman_filesbackupcounter";
	    $counter=ParameterManager::getParameter($paramName);
	    if($counter=="")
	        $counter=1;
	    $FileName="SweetOneFilesBackup-" . $this->Time . " -" . $counter . ".zip";
	    $FilesPath=DEFAULT_PUBLICPATH . "content/files/";
	    $BackupInfo="Files Path:" . $FilesPath;
	    $this->MakeBackup($BackupInfo, $FilesPath, $FileName,"files");
	    $counter++;
	    ParameterManager::updateParameter($paramName, $counter);
	    $result['filepath']=$this->BackupPath . $FileName;
	    $result['fileurl']=$this->BackupURL . $FileName;
	    return $result;
	}
	public function GenerateThemeBackup()
	{
	    $result=array();
	    $paramName="sfman_themebackupcounter";
	    $counter=ParameterManager::getParameter($paramName);
	    if($counter=="")
	        $counter=1;
	    $FileName=DEFAULT_WEBTHEME . "-ThemeBackup-" . $this->Time . " -" . $counter . ".zip";
	    $BackupInfo="ThemeName:" . DEFAULT_WEBTHEME;
	    $ThemePath=DEFAULT_PUBLICPATH . "content/themes/" .  DEFAULT_WEBTHEME;
	    $this->MakeBackup($BackupInfo, $ThemePath, $FileName,DEFAULT_WEBTHEME);
	    $counter++;
	    ParameterManager::updateParameter($paramName, $counter);
	    $result['filepath']=$this->BackupPath . $FileName;
	    $result['fileurl']=$this->BackupURL . $FileName;
	    return $result;
	}
	
	public function GenerateDBBackup()
	{
	    global $setting_host,$setting_dbuser,$setting_dbpass,$setting_dbname;
	    $result=array();
	    $paramName="sfman_dbbackupcounter";
	    $counter=ParameterManager::getParameter($paramName);
	    if($counter=="")
	        $counter=1;
	    $FileName=$setting_dbname . "Backup-" . $this->Time . "-" . $counter . ".sql.gz";
	    $FilePath=$this->BackupPath . $FileName;
	    if(file_exists($FilePath))
	        unlink($FilePath);
	    $dumpSettings = array(
	        'compress' => Mysqldump::GZIP,
	        'no-data' => false,
	        'add-drop-table' => true,
	        'single-transaction' => true,
	        'lock-tables' => true,
	        'add-locks' => true,
	        'extended-insert' => false,
	        'disable-keys' => true,
	        'skip-triggers' => false,
	        'add-drop-trigger' => true,
	        'routines' => true,
	        'databases' => false,
	        'add-drop-database' => false,
	        'hex-blob' => true,
	        'no-create-info' => false,
	        'where' => ''
	    );
	    $dump = new MySQLDump("mysql:host=$setting_host;dbname=$setting_dbname",$setting_dbuser,$setting_dbpass, $dumpSettings);
	    $dump->start($FilePath);
	    $counter++;
	    ParameterManager::updateParameter($paramName, $counter);
	    $result['filepath']=$FilePath;
	    $result['fileurl']=$this->BackupURL . $FileName;
	    return $result;
	}

	
}
?>
