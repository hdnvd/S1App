<?php
/*
 *@Author:Hadi AmirNahavandi
 *@Last Update:2014/5/08
*/
namespace Modules\users\Forms;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\services\FormCode;
use Modules\users\Entity\userEntity;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\Controllers\signupController;
use core\CoreClasses\File\Uploader;
use Modules\files\PublicClasses\uploadHelper;
use Modules\users\Controllers\signinController;
use Modules\users\Exceptions\UsernameExistsException;
class signup_Code extends FormCode
{
	private $PASSNOTMATCHED=1;
	private $EMPTYField=2;
	private $SUCCESSFUL=3;
	private $PROBLEM=4;
	private $USERNAMEEXISTS=5;
	private $ShowRoles;
	private $DefaultRole=2;
	public function __construct($namespace=null)
	{
	    parent::__construct($namespace);
	    $this->ShowRoles=false;
	}
	public function load()
	{
	
		$design=new signup_Design();
		$translator=new ModuleTranslator("users");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$ctl=new signupController();
		$Fields=$ctl->load();
		$EnabledFields=$Fields['enabledfields'];
		$design->setAdditionalFields($EnabledFields);
		$design->setShowRoles($this->ShowRoles);
		$design->setRoles($Fields['roles']);
		$design->setUserphotoTitle($translator->getWordTranslation("profilepicture"));
		$design->setFemaleTitle($translator->getWordTranslation("female"));
		$design->setMaleTitle($translator->getWordTranslation("male"));
		$design->setFamilyTitle($translator->getWordTranslation("family"));
		$design->setMobTitle($translator->getWordTranslation("mob"));
		$design->setNameTitle($translator->getWordTranslation("name"));
		$design->setPass1Title($translator->getWordTranslation("password"));
		$design->setPass2Title($translator->getWordTranslation("password2"));
		$design->setSexTitle($translator->getWordTranslation("sex"));
		$design->setUsernameTitle($translator->getWordTranslation("username"));
		$design->setSignupButtonTitle($translator->getWordTranslation("signup"));
		$design->setMailTitle($translator->getWordTranslation("email"));
		return $design->getResponse();
	}	
	public function signup_Click()
	{
		$translator=new ModuleTranslator("users");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$this->adduser();
		if($Result==$this->SUCCESSFUL)
			return $translator->getWordTranslation("signupsuccessful");
		elseif ($Result==$this->EMPTYField)
			return $translator->getWordTranslation("emptyfields");
		elseif($Result==$this->PASSNOTMATCHED)
			return $translator->getWordTranslation("passwordnotmatched");
		elseif($Result==$this->USERNAMEEXISTS)
			return $translator->getWordTranslation("usernameexists");
		
	}
	private function adduser()
	{
	    $ctl=new signupController();
	    $Fields=$ctl->load();
	    $EnabledFields=$Fields['enabledfields'];
	    $AdditionalFields=array();
	    for($i=0;$i<count($EnabledFields);$i++)
	    {
	        $FieldName=$EnabledFields[$i]['userinfo_field'];
	        if(isset($_POST['txt'.$FieldName]))
	           $AdditionalFields[$FieldName]=$_POST['txt'.$FieldName];
	        else 
	            $AdditionalFields[$FieldName]="";
	    }
	    
		$mobile=$_POST['usermob'];
		$username=$_POST['username'];
		$pass=$_POST['password'];
		$pass2=$_POST['password2'];
		$name=$_POST['name'];
		$family=$_POST['family'];
		$mail=$_POST['useremail'];
		$ismale=$_POST['ismale'];
		$profilepicture=$_FILES['profilepicture']['name'];
		$profilepictureURL=$this->UploadPhoto($_FILES['profilepicture']['tmp_name'], $_FILES['profilepicture']['name']);
		$profilepictureURL['url']=DEFAULT_PUBLICURL . $profilepictureURL['url'];
		
		if($this->ShowRoles)
		  $Role=$_POST['roleid'];
		else 
		    $Role=$this->DefaultRole;
		if($pass=="")
		{
		    $pass2="defaultpass123";
		    $pass="defaultpass123";
	    }
		$message=-1;
		if($username!="" && $pass!="" && $name!="")
		{	
		  if($pass==$pass2)
		  {
			$userC=new signupController();
			try {
			$userC->signup($ismale, $name, $family, $mobile, $mail, $username, $pass,$profilepictureURL['url'],$Role,$AdditionalFields);
			$message=$this->SUCCESSFUL;
			}
			catch (UsernameExistsException $Ex)
			{
			    $message=$this->USERNAMEEXISTS;
			}
		  }
		  else
			$message=$this->PASSNOTMATCHED;
		}
		else
		 $message=$this->EMPTYField;
		return $message;
	}
	
	
	public function UploadPhoto($tmpfile,$fileName)
	{
		return uploadHelper::UploadFile($tmpfile, $fileName, "content/files/users/img/");
	}
	/*public function saveThumb($filePath,$fileName)
	{
		$thumb = new \Imagick();
		$thumb->readImage($filePath);
		$thumb->resizeImage(300,300,Imagick::FILTER_LANCZOS,1);
		$ThumbPath=DEFAULT_PUBLICPATH . "content/files/products/img/Thumb" . $fileName;
		while(file_exists($ThumbPath))
		{
			$fileName="0". $fileName;
			$ThumbPath=DEFAULT_PUBLICPATH . "content/files/products/img/Thumb" . $fileName;
			$ThumbURL=DEFAULT_PUBLICURL . "content/files/products/img/Thumb" . $fileName;
		}
		$thumb->writeImage($ThumbPath);
		return $ThumbURL;
	}*/
}
?>