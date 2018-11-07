<?php
namespace Modules\gallery\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\gallery\Entity\gallery_albumphotoEntity;
use Modules\gallery\Entity\gallery_photoEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-08-16 - 2018-11-07 14:24
*@lastUpdate 1397-08-16 - 2018-11-07 14:24
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class instasyncController extends Controller {
	private $PAGESIZE=10;
	private function downloadImage($URL,$FilePath)
    {
        set_time_limit(0);
        $fp = fopen ($FilePath, 'w+');
        $ch = curl_init(str_replace(" ","%20",$URL));
        curl_setopt($ch, CURLOPT_TIMEOUT, 50);
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
    }
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
        $loader=new \InstagramClient("8575326782.c195ddb.2974a9252d744da7998fb500f08f6d4f");
        $images=$loader->getSelfImages();
        for($i=0;$i<count($images);$i++)
        {
            $PhotoPath= 'content/files/gallery/img/insta' .$images[$i]['id'] .".jpg";
            $ThumbnailPath='content/files/gallery/img/thumbnails/insta' .$images[$i]['id'] .".jpg";
            $galleryEnt=new gallery_photoEntity();
            if(!file_exists(DEFAULT_PUBLICPATH . $PhotoPath))
            {
                $Context=$images[$i]['caption'];
                $Contexts=explode(",",$Context);
                $this->downloadImage($images[$i]['url'],DEFAULT_PUBLICPATH . $PhotoPath);
                $this->downloadImage($images[$i]['thumbnailurl'],DEFAULT_PUBLICPATH . $ThumbnailPath);
                $PhotoID=$galleryEnt->Insert($Contexts[0],$Contexts[1],$ThumbnailPath,$PhotoPath,time(),time(),time());
                $albumEnt=new gallery_albumphotoEntity();
                $albumEnt->Insert(6,$PhotoID);
                echo "Inserted $Contexts[0]";
            }
        }
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>