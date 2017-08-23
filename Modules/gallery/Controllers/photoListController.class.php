<?php

namespace Modules\gallery\Controllers;

use core\CoreClasses\services\Controller;
use Modules\gallery\Entity\gallery_photoEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\gallery\Entity\gallery_viewalbumphotoinfoEntity;
use Modules\gallery\Entity\gallery_albumEntity;
use Modules\parameters\Entity\ParameterEntity;
/**
 *
 * @author hadi
 *        
 */
class photoListController extends Controller{
	private $AlbumIDs;
	public function load($Albumid=null,$MinID=-1)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$Albument=new gallery_albumEntity();
		$FullEnt=new gallery_viewalbumphotoinfoEntity();
		
		if($Albumid===null)
			$Albumid=-1;
		$this->AlbumIDs=array();
		$this->getAlbumSubAlbums($Albumid);//Fills $this->AlbumIDs
		$result=array();
		for($i=0;$i<count($this->AlbumIDs);$i++)
		{
			$result['data'][$i]['albuminfo']=$Albument->Select($this->AlbumIDs[$i], null, null, null, $Language_fid, array(), array(), "0,100");
			$result['data'][$i]['albuminfo']=$result['data'][$i]['albuminfo'][0];
			$result['data'][$i]['photos']=$FullEnt->Select($this->AlbumIDs[$i], null, null, null, null, $Language_fid, null, null, null, null,$MinID,null,999,time(), array("photoid"), array(true), "0,150");	
		}
		$param=new ParameterEntity();
		$result['columns']=$param->getParameter("gallery_columnscount");
		$result['columns']=$result['columns'][0]['value'];
		$result['pagesize']=$param->getParameter("gallery_pagesize");
		$result['pagesize']=$result['pagesize'][0]['value'];
		$result['gallery_highqualitythumbs']=$param->getParameter("gallery_highqualitythumbs");
		$result['gallery_highqualitythumbs']=$result['gallery_highqualitythumbs'][0]['value'];
		return $result;
	}
	private function getAlbumSubAlbums($AlbumID)
	{
		$LanguageID=CurrentLanguageManager::getCurrentLanguageID();
		$GroupEnt=new gallery_albumEntity();
		if($AlbumID>0)
		  array_push($this->AlbumIDs, $AlbumID);
		$tmpGroups=$GroupEnt->Select(null, null, null, $AlbumID, $LanguageID, array(), array(), "0,100");
		for($j=0;$j<count($tmpGroups);$j++)
			$this->getAlbumSubAlbums($tmpGroups[$j]['id']);
	}
}

?>