<?php

namespace Modules\mail\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\mail\Controllers\showboxController;
use core\CoreClasses\Sweet2DArray;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;


class showbox_Code extends FormCode {
	public function load()
	{
		$showboxController=new showboxController();
		$BoxType=1;
		if(isset($_GET['box']))
			$BoxType=$_GET['box'];
		$translator=new ModuleTranslator("mail");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Fields=$showboxController->load($BoxType);
		$Fields=Sweet2DArray::array_filp($Fields);
		$ids=$Fields['id'];
		$links=array();
		
		for($i=0;$i<count($ids);$i++)
		{
			$link=new AppRooter("mail", "showmail");
			$link->addParameter(new UrlParameter("id", $ids[$i]));
			$links[$i]=$link->getAbsoluteURL();
		}
		$texts=$Fields['text'];
		
		$subjects=$Fields['subject'];
		$design=new showbox_Design();
		$design->setSubjects($subjects);
		$design->setTexts($texts);
		$design->setMailLinks($links);
		return $design->getBodyHTML();
	}
}
?>
