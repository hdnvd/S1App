<?php

namespace Modules\users\Forms;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\Controllers\usermenuController;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
use core\CoreClasses\Sweet2DArray;
use core\CoreClasses\services\WidgetCode;
use Modules\users\PublicClasses\AccessController;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\html\link;


class usermenuWidget_Code extends WidgetCode {
	public function load()
	{
		$usermenuController=new usermenuController();
		$links=array();
		$texts=array();
		$su=new sessionuser();
		$translator=new ModuleTranslator("users");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Fields=$usermenuController->load();
		$design=new usermenuWidget_Design();
		$MenuItems=Sweet2DArray::array_filp($Fields['menuitems']);
		$ac=new AccessController();
		for($i=0;$i<count($MenuItems['id']);$i++)
		{
			if($ac->getUserAccess($su->getSystemUserID(), $MenuItems['module'][$i], $MenuItems['page'][$i], "load"))
			{
				$tmplink=new AppRooter($MenuItems['module'][$i], $MenuItems['page'][$i]);
				$params=$MenuItems['parameters'][$i];
				$params=explode(";", $params);
				for($pi=0;$pi<count($params);$pi++)
				{
				    $param=explode("=",$params[$pi]);
				    if(count($param)>1)
				        $tmplink->addParameter(new UrlParameter($param[0], $param[1]));
				}
                array_push($links, $tmplink->getAbsoluteURL());
				array_push($texts, $translator->getWordTranslation($MenuItems['latintitle'][$i]));
			}
		}
		$design->setLinks($links);
		$design->setTexts($texts);
		return $design->getBodyHTML();
	}
}
?>
