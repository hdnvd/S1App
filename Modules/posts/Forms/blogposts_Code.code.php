<?php

namespace Modules\posts\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\posts\Controllers\postsController;
use core\CoreClasses\Sweet2DArray;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
use core\CoreClasses\services\ResponseMode;


class blogposts_Code extends posts_Code {
	public function __construct($namespace=null)
	{
		parent::__construct($namespace);
		
		if(isset($_GET['tag']))
		    $Title=str_ireplace("-", " ", $_GET['tag']);
		else 
		    $Title="فهرست مقالات";
		if(isset($_GET['pn']))
			$Title.=" | صفحه " . $_GET['pn'];
		
		$this->setTitle($Title);
	}
	public function load()
	{
		$Posts=$this->LoadPosts();
		$Fields=$Posts['fields'];
		if($Fields!==null && count($Fields['posts'])>0)
		{
			$design=new blogposts_Design();
			$design->setTitles($Fields['posts']['title']);
			$design->setPosts($Fields['posts']);
			$design->setLinks($Posts['links']);
			$design->setPostCats($Fields['postcats']);
			(isset($_GET['pn']))?$Page=$_GET['pn']:$Page=1;
			$design->setCurrentPage($Page);
			$design->setPageCount($Posts['pagecount']);
			$PageLink=new AppRooter("articles", "");
			$PageLink->setFileFormat("");
			$design->setPageLink($PageLink->getAbsoluteURL());
			return $design->getResponse();
		}
		else 
		{
		    return "هیچ مطلبی در این بخش موجود نیست.";
		}
	}
}
?>
