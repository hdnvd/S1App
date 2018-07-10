<?php

namespace Modules\gallery\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\selectQuery;
use core\CoreClasses\db\updateQuery;
use core\CoreClasses\db\insertQuery;
use core\CoreClasses\db\TableField;
use core\CoreClasses\db\DBField;


/**
 *@author Hadi AmirNahavandi
 *@CreationDate 2014/12/23 12:29:25
 *@LastUpdate 2014/12/23 12:29:25
 *@TableFields albumid,photoid,latintitle,title,mother_fid,language_fid,title,description,thumburl,url
*/


class gallery_viewalbumphotoinfoEntity extends EntityClass {
	/**
	 * @var selectQuery
	 */
	private $SelectQuery;
	public function __construct()
	{
		$this->setDatabase(new dbquery());
		$this->setTableName("gallery_viewalbumphotoinfo");
	}
	public function Select($Albumid,$Photoid,$AlbumLatintitle,$AlbumTitle,$AlbumMother_fid,$Language_fid,$PhotoTitle,$PhotoDescription,$PhotoThumburl,$PhotoUrl,$MinPhotoid,$MinDate,$MinPublishDate,$MaxPublishDate,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("a.id albumid","a.latintitle albumlatintitle","a.title albumtitle","a.mother_fid albummother_fid","language_fid","p.id photoid","p.title phototitle","p.description photodescription","p.thumburl photothumburl","p.url photourl","p.adddate padddate","p.publishdate ppublishdate","p.lastupdate plastupdate"))->From(array("gallery_photo p","gallery_album a","gallery_albumphoto ap"))->Where()->Equal("ap.photo_fid",new DBField("p.id",false))->AndLogic()->Equal("ap.album_fid",new DBField("a.id",false));
		if($Albumid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("a.id",$Albumid);
		if($MinDate!==null)
		    $this->SelectQuery=$this->SelectQuery->AndLogic()->Bigger("cast(p.adddate as signed)",$MinDate);
		
		if($MinPublishDate!==null)
		    $this->SelectQuery=$this->SelectQuery->AndLogic()->Bigger("cast(p.publishdate as signed)",$MinPublishDate);
		if($MaxPublishDate!==null)
		    $this->SelectQuery=$this->SelectQuery->AndLogic()->Smaller("cast(p.publishdate as signed)",$MaxPublishDate);
		if($MinPhotoid!==null)
		    $this->SelectQuery=$this->SelectQuery->AndLogic()->Bigger("p.id",$MinPhotoid);
		if($Photoid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("p.id",$Photoid);
		if($AlbumLatintitle!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("albumlatintitle",$AlbumLatintitle);
		if($AlbumTitle!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("a.title",$AlbumTitle);
		if($AlbumMother_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("mother_fid",$AlbumMother_fid);
		if($Language_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("language_fid",$Language_fid);
		if($PhotoTitle!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("p.title",$PhotoTitle);
		if($PhotoDescription!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("description",$PhotoDescription);
		if($PhotoThumburl!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("thumburl",$PhotoThumburl);
		if($PhotoUrl!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("url",$PhotoUrl);
		for($i=0;$OrderByFields!==null && $i<count($OrderByFields);$i++)
			$this->SelectQuery=$this->SelectQuery->AddOrderBy($OrderByFields[$i], $IsDescendings[$i]);
		if($Limit!==null)
			$this->SelectQuery=$this->SelectQuery->setLimit($Limit);
		$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("ap.isdeleted", "0");
		$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("p.isdeleted", "0");
		$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("a.isdeleted", "0");
// 		echo $this->SelectQuery->getQueryString();
// 		die();
		return $this->SelectQuery->ExecuteAssociated();
	}
}
?>
