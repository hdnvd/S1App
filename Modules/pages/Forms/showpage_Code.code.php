<?php
namespace Modules\pages\Forms;
use \core\CoreClasses\services;
use \core\CoreClasses\services\FormCode;
use core\CoreClasses\db\dbquery;
use Modules\pages\Entity\pageEntity;
use Modules\pages\Entity\languageEntity;
use Modules\pages\EntityObjects\pageEntityObject;
use Modules\pages\Controllers\pageManageController;
use Modules\pages\Controllers\pageLoadController;
	class showpage_Code extends FormCode
	{
		private $Page;
		public function __construct($namespace=null)
		{
			parent::__construct($namespace);
			$this->LoadFromDB($_GET['pageid']);
			$this->setTitle($this->Page['page'][0]['title']);
		}
		public function load()
		{
			$design=new showpage_Design();
			$design=$this->loadPageText($design);
			return $design->getBodyHTML();
		}
		private function LoadFromDB($pageID)
		{
			$pageController=new pageLoadController();
			$this->Page=$pageController->LoadPage($pageID);
		}
		public function loadPageText(showpage_Design $design)
		{
			$page=$this->Page;
			if(!is_null($page))
			{
				$pageContent=$page['page'];
				$pageTags=$page['tags'];
				$pageTag=null;
				for($i=0;$i<count($pageTags);$i++)
				{
					$pageTag[$i]=$pageTags[$i]['title'] . "  ";
				}
				$design->tags=$pageTag;
				if(!is_null($pageContent))
					$pageContent=$pageContent[0];
				$lbltitle=$pageContent['title'];
				$design->setLbltitle($lbltitle);
				$lblcontent=$pageContent['content'];
				$design->setLblcontent($lblcontent);
				$lbltags=$pageTag;
				$design->setLbltags($lbltags);
				$design->lblthumb="عکس صفحه";
			}
			return $design;
		}
	}
?>

 