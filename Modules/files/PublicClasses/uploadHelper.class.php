<?php

namespace Modules\files\PublicClasses;

use core\CoreClasses\Exception\FileExistsError;
use core\CoreClasses\File\Uploader;
use core\CoreClasses\Exception\FileTypeError;
use core\CoreClasses\Exception\FileSizeError;
/**
 *
 * @author nahavandi
 *        
 */
class uploadHelper {
	/**
	 * @param String $tmpfile :Address Of File In Temp Folder
	 * @param String $fileName :Name Of File
	 * @param String $uploadPlace :Where To Upload File
	 * @return Null if Upload Unsucccessful and The Uploaded URL if Upload Successful
	 */
	public static function UploadFile($tmpfile,$fileName,$uploadPlace,array $fileTypes=null,$maxSize=2000,$Override=false,$fileType=null)
	{
		$uploader=new Uploader();
		$newName=$fileName;
		$i=1;
		$Uploaded=false;
		$pinf=pathinfo($fileName);
		$ext=$pinf['extension'];
        $fname=$pinf['filename'];
        $url=null;
		do
		{
			try{

                $address=DEFAULT_PUBLICPATH. $uploadPlace . $newName;
                $uploader->uploadFile($tmpfile, $address,$Override,$fileTypes,$maxSize,$fileType);
                $url['url']=$uploadPlace . rawurlencode($newName);
                $url['path']=DEFAULT_PUBLICPATH . $uploadPlace . $newName;
                $url['name']=$newName;
                $Uploaded=true;
                return $url;
            }
            catch (FileExistsError $ex)
            {
                $newName=$fname . "-" .$i. ".".$ext;
                $i++;
                $Uploaded=false;
            }
		}while ($i<1000000);
		return null;
	}
	public static function UploadPrivateFile($tmpfile,$fileName,$uploadPlace,$Override=false,array $fileTypes=null,$maxSize=2000,$fileType=null)
	{
		$uploader=new Uploader();
		$newName=$fileName;
		$dir=DEFAULT_PRIVATEPATH. $uploadPlace;
		if(!is_dir($dir))
		{
			mkdir($dir);
			chmod($dir, 0700);
		}
		if(is_dir(DEFAULT_PRIVATEPATH. $uploadPlace))
		do
		{
			$address=$dir . $newName;
			$result=$uploader->uploadFile($tmpfile, $address,$Override,$fileTypes,$maxSize,$fileType);
			$url['path']=$dir . $newName;
			$url['name']=$newName;
			$newName="0" . $newName;
		}while ($result==2);
		if($result==1)
			return null;
		else
		{
			chmod($url['path'], 0700);
			return $url;
		}
	}
	public static function UploadPrivateFileInput($FileInputName,$uploadPlace,$FileName,$Override=false,array $fileTypes=null,$maxSize=2000)
	{
		if(is_null($FileName))
			$FileName=$_FILES[$FileInputName]['name'];
		return uploadHelper::UploadPrivateFile($_FILES[$FileInputName]['tmp_name'], $FileName, $uploadPlace,$Override,$fileTypes,$maxSize,$_FILES[$FileInputName]['type']);
	}
	/**
	 * @param String $FileInputName :Name Of Input[type=file]
	 * @param String $uploadPlace :Where To Upload File
	 * @return Null if Upload Unsucccessful and The Uploaded URL if Upload Successful
	 */
	public static function UploadFileInput($FileInputName,$uploadPlace,array $fileTypes=null,$maxSize=2000,$FileName=null)
	{
		if($FileName===null)
			return uploadHelper::UploadFile($_FILES[$FileInputName]['tmp_name'], $_FILES[$FileInputName]['name'], $uploadPlace,$fileTypes,$maxSize,false,$_FILES[$FileInputName]['type']);
		else
			return uploadHelper::UploadFile($_FILES[$FileInputName]['tmp_name'], $FileName, $uploadPlace,$fileTypes,$maxSize,true,$_FILES[$FileInputName]['type']);
	}
}

?>