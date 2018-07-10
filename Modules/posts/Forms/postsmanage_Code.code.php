<?php

namespace Modules\posts\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\posts\Controllers\postsmanageController;
use core\CoreClasses\Sweet2DArray;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;


class postsmanage_Code extends FormCode {
	public function __construct($namespace=null)
	{
		parent::__construct($namespace);
		$this->setTitle("مدیریت مطالب");
		$this->setThemePage("admin.php");
	}
	public function load()
	{
		$postsmanageController=new postsmanageController();
		$translator=new ModuleTranslator("posts");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Fields=$postsmanageController->load();
		$Fields['posts']=Sweet2DArray::array_filp($Fields['posts']);
		
		$design=new postsmanage_Design();
		$design->setPostTitles($Fields['posts']['title']);
		$design->setDeleteCaption("حذف");
		
		$links=array();
		$deleteLinks=array();
		$PublishLinks=array();
		$PublishTexts=array();
		for($i=0;$i<count($Fields['posts']['id']);$i++)
		{
			$link=new AppRooter("posts", "postmanage");
			$link->setParameter(new UrlParameter("id", $Fields['posts']['id'][$i]));
			$links[$i]=$link->getAbsoluteURL();
			
			$link->setParameter(new UrlParameter("delete",1));
			$deleteLinks[$i]=$link->getAbsoluteURL();
			
			$link->setParameter(new UrlParameter("delete",0));
			$publishlink=$link;
			if($Fields['posts']['ispublished'][$i]=="1")
			{
				$publish="0";
				$PublishTexts[$i]="عدم انتشار";
			}
			else
			{
				$publish="1";
				$PublishTexts[$i]="انتشار";
			}
			$publishlink->setParameter(new UrlParameter("publish",$publish ));
			$PublishLinks[$i]=$publishlink->getAbsoluteURL();
			
			
		}
		$design->setPostLinks($links);
		$design->setDeleteLinks($deleteLinks);
		$design->setPublishLinks($PublishLinks);
		$design->setPublishTexts($PublishTexts);
		return $design->getBodyHTML();
	}
}
?>
