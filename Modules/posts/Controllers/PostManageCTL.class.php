<?php

namespace Modules\posts\Controllers;

use classes\Telegram\TelegramClient;
use core\CoreClasses\services\Controller;
use Modules\posts\Entity\posts_postEntity;
use Modules\posts\Entity\posts_postlanguagecategoryEntity;
use Modules\common\PublicClasses\AppDate;
use Modules\posts\Exceptions\PostExistsException;
use Modules\posts\Entity\posts_tagEntity;
use core\CoreClasses\db\dbaccess;
use Modules\posts\Entity\posts_posttagEntity;
use Modules\parameters\Entity\ParameterEntity;
use Modules\parameters\PublicClasses\ParameterManager;

/**
 *
 * @author nahavandi
 *        
 */
class PostManageCTL extends Controller {
	public function Add($Title,$FullTitle,$Summary,$Content,$ExternalLink,$Thumbnail,$Rank,$Visits,$IsPublished,$LanguageCategoryIDs,$LinkTitle,$Description,$Tags="",$Keywords="",$CanonicalURL="",$IsUniqueExternalLink=false)
	{
		$Today=time();
//echo $ExternalLink;
//die();
$ExternalLink=trim($ExternalLink);
if(strlen($ExternalLink)>222)
$ExternalLink=substr($ExternalLink,0,222);
		$PE2=new posts_postEntity(new dbaccess());
		$search=$PE2->Select(null, $Title, $Summary, $Content, $ExternalLink, null, null, null, null, null, null,null,null,null,null,array(),array(),"0,1");
        $searchExt=$PE2->Select(null, null, null, null, $ExternalLink, null, null, null, null, null, null,null,null,null,null,array(),array(),"0,1");

        if(!is_null($search) && count($search)>0)
			throw new PostExistsException($this);
		elseif ($IsUniqueExternalLink && (!is_null($searchExt) && count($searchExt)>0))
            throw new PostExistsException($this);
		else
		{
		   $DBAccessor=new dbaccess();
		    $PE=new posts_postEntity($DBAccessor);
			$PLCE=new posts_postlanguagecategoryEntity($DBAccessor);
			$DBAccessor->beginTransaction();
			$PostID=$PE->Insert($Title, $Summary, $Content, $ExternalLink, $Thumbnail, $Rank, $Visits, $IsPublished, $Today,$Today,$LinkTitle,$Description,$Keywords,$CanonicalURL);
//            $PostID=0;
            for($i=0;$i<count($LanguageCategoryIDs);$i++)
			{
			    $this->DoTelegramJobs($FullTitle, $Summary, $Content,$PostID, $ExternalLink, $Thumbnail, $IsPublished, $LanguageCategoryIDs[$i]);
			    $PLCE->Insert($PostID, $LanguageCategoryIDs[$i]);
			}
			$this->setTags($PostID, $Tags, $DBAccessor);
			$DBAccessor->commit();
			$DBAccessor->close_connection();
			return true;
		}
		return false;
	}
	private function DoTelegramJobs($Title,$Summary,$Content,$PostID,$ExternalLink,$Thumbnail,$IsPublished,$CatID)
	{
	    $PMan=new ParameterManager();
	    $ChatID=$PMan->getParameter("posts_cat" . $CatID . "_telegramchatid");
	    $BotToken=$PMan->getParameter("posts_telegram_bottoken");
	    if($ChatID!="" && $IsPublished)
	        $this->PublishOnTelegram($Title . "\n" .DEFAULT_PUBLICURL . $PostID . ".tgp". "\n\n" . $ChatID,$Thumbnail, $ChatID, $BotToken);
	}
	private function PublishOnTelegram($Content,$ThumbnailURL,$ChatID,$BotToken)
	{
//	    echo $ThumbnailURL;
	    $TC=new TelegramClient($BotToken);
	    if($ThumbnailURL=="")
	        $TC->sendMessage($ChatID, $Content, false, "", "");
	    else
            $TC->sendPhoto($ChatID, $ThumbnailURL, $Content, "", "",TelegramClient::$PHOTOSENDMODE_LINK);
	}
	protected function deletePostTags($PostID,$DBAccessor)
	{
	    
	    $PTEnt=new posts_posttagEntity($DBAccessor);
	    $PTEnt2=new posts_posttagEntity(new dbaccess());
	    $PTags=$PTEnt2->Select(null, null, $PostID, array(), array(), "0,1000");
	    for($i=0;$i<count($PTags);$i++)
	        $PTEnt->Delete($PTags[$i]['id']);

	}
	protected function setTags($PostID,$Tags,$DBAccessor)
	{
	    if(strlen(trim($Tags))>0)
	    {
	       $TEnt=new posts_tagEntity($DBAccessor);
	       $TEntR=new posts_tagEntity(new dbaccess());
	       $PTEntR=new posts_posttagEntity(new dbaccess());
	       $PTEnt=new posts_posttagEntity($DBAccessor);
	       $Tags=explode(",", $Tags);
	        $TagIDs=array();
	       for ($i=0;$i<count($Tags);$i++)
	       {
	           $FoundTag=$TEntR->Select(null, $Tags[$i], null, array(), array(), "0,1");
	           if(count($FoundTag)>0)
	               $TagIDs[$i]=$FoundTag[0]['id'];
	           else 
	               $TagIDs[$i]=$TEnt->Insert($Tags[$i], $Tags[$i]);
	       }
	       for($i=0;$i<count($TagIDs);$i++)
	           $PTEnt->Insert($TagIDs[$i], $PostID);
	    }
	}
}

?>