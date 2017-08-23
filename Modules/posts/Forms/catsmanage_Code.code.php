<?php

namespace Modules\posts\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\posts\Controllers\catsmanageController;
use core\CoreClasses\Sweet2DArray;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;


class catsmanage_Code extends FormCode {
	public function __construct($namespace=null)
	{
		parent::__construct($namespace);
		$this->setTitle("مدیریت موضوعات");
		$this->setThemePage("admin.php");
	}
	public function load()
	{
		$catsmanageController=new catsmanageController();
		$translator=new ModuleTranslator("posts");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Fields=$catsmanageController->load();
		$Fields['cats']=Sweet2DArray::array_filp($Fields['cats']);
		
		$design=new catsmanage_Design();
		
		$design->setCategoryTitles($Fields['cats']['title']);
		$design->setDeleteCaption($translator->getWordTranslation("delete"));
		
		$links=array();
		$deleteLinks=array();
		for($i=0;$i<count($Fields['cats']['id']);$i++)
		{
			$link=new AppRooter("posts", "catmanage");
			$link->setParameter(new UrlParameter("id", $Fields['cats']['id'][$i]));
			$links[$i]=$link->getAbsoluteURL();
			$link2=$link;
			$link2->setParameter(new UrlParameter("delete",1));
			
			$deleteLinks[$i]=$link2->getAbsoluteURL();
		}
		$design->setEditLinks($links);
		$design->setDeleteLinks($deleteLinks);
		return $design->getBodyHTML();
	}
}
?>
