<?php

namespace Modules\gallery\Controllers;

use classes\Telegram\TelegramClient;
use core\CoreClasses\services\Controller;
use Modules\gallery\Entity\gallery_photoEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\gallery\Entity\gallery_albumEntity;
use Modules\gallery\Entity\gallery_albumphotoEntity;
use Modules\parameters\PublicClasses\ParameterManager;
/**
 *
 * @author hadi
 *        
 */
class addphotoController extends Controller{
	public function load()
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$Ent=new gallery_albumEntity();
		$result=array();
		$result['albums']=$Ent->Select(null, null, null, null, $Language_fid, array("id"), array(true), "0,100");
		return $result;
	}
	public function loadPhotoInfo($ID)
	{
		$result=array();
		if($ID!==null)
		{
			$GPEnt=new gallery_albumphotoEntity();
			$AlbumPhoto=$GPEnt->Select(null, null, $ID, array(), array(), "0,1");
			$result['albumid']=$AlbumPhoto[0]['album_fid'];
				
			$PEnt=new gallery_photoEntity();
			$photo=$PEnt->Select($ID, null, null, null, null,null,null,null, array(), array(), "0,1");
			$result['photo']=$photo[0];
		}
		return $result;
	}
	public function addphoto($title,$description,$thumburl,$url,$Album_Fid)
	{
		$LangID=CurrentLanguageManager::getCurrentLanguageID();
		$ent=new gallery_photoEntity();
		$entalbum=new gallery_albumphotoEntity();
//        $photoID=0;
		$photoID=$ent->Insert($title, $description, $thumburl, $url,time(),time(),time()-1);
		$entalbum->Insert($Album_Fid, $photoID);
		$this->DoTelegramJobs($title, $description, $thumburl, $url, $photoID, $Album_Fid);
		return $photoID;
	}
	private function DoTelegramJobs($Title,$description,$thumburl,$photourl,$photoID,$Album_Fid)
	{
	    $PMan=new ParameterManager();
// 	    echo "AID:" . $Album_Fid;
	    $ChatID=$PMan->getParameter("gallery_album" . $Album_Fid . "_telegramchatid");
	    $BotToken=$PMan->getParameter("gallery_telegram_bottoken");
	    $Path=DEFAULT_PUBLICPATH . $photourl;
	    if($ChatID!="")
	        $this->PublishOnTelegram($Path, $Title . "\n" . $description . "\n\n" . DEFAULT_PUBLICURL . $photoID . ".tgg". "\n\n" . $ChatID, $ChatID, $BotToken);
	}
	private function PublishOnTelegram($photo,$caption,$ChatID,$BotToken)
	{
	    $TC=new TelegramClient($BotToken);
	    $TC->sendPhoto($ChatID, $photo, $caption, "", "",TelegramClient::$PHOTOSENDMODE_UPLOAD);
	}
	public function sendphoto($title,$description,$thumburl,$url,$Album_Fid,$photopath,$photoname)
	{
		$LangID=CurrentLanguageManager::getCurrentLanguageID();
		$ent=new gallery_photoEntity();
		$entalbum=new gallery_albumphotoEntity();
		
		/*
		if($result)
		    $result="Mail Sent";
		else
		    $result="Mail Failed";
		echo $result;*/
		$photoID=$ent->Insert($title, $description, $thumburl, $url,time(),time(),-1);
		$entalbum->Insert($Album_Fid, $photoID);
		$email = new \PHPMailer();
		$email->From      = 'webmaster@sweetsoft.ir';
		$email->FromName  = 'Sweet Software Group';
		$email->Subject   = 'New Photo Received';
		$email->Body      = "<table><tr><td>عنوان:</td><td>$title</td></tr><tr><td>توضیحات:</td><td>$description</td></tr></table>";
		$email->AddAddress( 'hadi.nahavandi2010@gmail.com' );
                $email->AddAddress( 'nahavandi.hadi@gmail.com' );
                $email->AddAddress( 'hadi.nahavandi@yahoo.com' );
		$email->isHTML(true);
		//echo $photopath;
		$email->AddAttachment( $photopath , $photoname );
		$result=$email->Send();
		
		return $photoID;
	}
	public function editphoto($ID,$title,$description,$thumburl,$url,$Album_Fid)
	{
		$LangID=CurrentLanguageManager::getCurrentLanguageID();
		$ent=new gallery_photoEntity();
		$entalbum=new gallery_albumphotoEntity();
		$ent->Update($ID,$title, $description, $thumburl, $url,null,time(),null);
		$GroupPhoto=$entalbum->Select(null, null, $ID, array(), array(), "0,1");
		$entalbum->Update($GroupPhoto[0]['id'], $Album_Fid,null);
	}
	public function deletephoto($photoid)
	{
		$ent=new gallery_photoEntity();
		$result=$ent->Delete($photoid);
		$PAEnt=new gallery_albumphotoEntity();
		$Albums=$PAEnt->Select(null, null, $photoid, array(), array(),null);
		for($i=0;$i<count($Albums);$i++)
			$PAEnt->Delete($Albums[$i]['id']);
		return $result;
	}
	public function changepublishstate($photoid)
	{
	    $LangID=CurrentLanguageManager::getCurrentLanguageID();
	    $ent=new gallery_photoEntity();
	    $res=$ent->Select($photoid, null, null, null, null, null, null, null, array("id"), array(false), "0,1");
	    if($res[0]['publishdate']>999 && $res[0]['publishdate']<time())
	       $ent->Update($photoid,null, null, null, null,null,null,-1);
	    else 
	    {
	       $ent->Update($photoid,null, null, null, null,null,null,time()-1);
	       $ALEnt=new gallery_albumphotoEntity();
	       $Albums=$ALEnt->Select(null, null, $photoid, array('id'), array(false), "0,100");
// 	       print_r($Albums);
	       for($i=0;$i<count($Albums);$i++)
	           $this->DoTelegramJobs($res[0]['title'], $res[0]['description'], $res[0]['thumburl'], $res[0]['url'], $photoid, $Albums[$i]['album_fid']);
	    }
	        
	}
}

?>