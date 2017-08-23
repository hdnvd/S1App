<?php

namespace Modules\products\Forms;

use core\CoreClasses\services\FormCode;
use Modules\products\Controllers\ProductGroupManageController;
use Modules\pages\Controllers\languageManageController;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
use Modules\products\Controllers\listgroupsController;

/**
 *
 * @author Hadi Nahavandi
 *        
 */
class listgroups_Code extends FormCode {
	public function __construct($namespace=null)
	{
		parent::__construct($namespace);
		$this->setThemePage("admin.php");
		$this->setTitle("مدیریت گروه ها");
	}
	public function load()
	{
		$languageID=CurrentLanguageManager::getCurrentLanguageID();
		$design=new listgroups_Design();
		$GroupController=new listgroupsController();
		$res=$GroupController->load();
		$res=$res['groups'];
		$resCount=count($res);
		$editlink=array();
		$deletelinks=array();
		for ($i=0;$i<$resCount;$i++)
		{
			$editlink[$i]=new AppRooter("products", "addgroup");
			$editlink[$i]->addParameter(new UrlParameter("id", $res[$i]['id']));
			$editlink[$i]=$editlink[$i]->getAbsoluteURL(); 
			$deletelinks[$i]=new AppRooter("products", "deletegroup");
			$deletelinks[$i]->addParameter(new UrlParameter("id", $res[$i]['id']));
			$deletelinks[$i]=$deletelinks[$i]->getAbsoluteURL();
		}
		$titles=array("کد","عنوان","عملیات");
		$design->setGroups($res);
		$design->setEditlinks($editlink);
		$design->setTitles($titles);
		$design->setDeletelinks($deletelinks);
		return $design->getBodyHTML();
	}
}

?>