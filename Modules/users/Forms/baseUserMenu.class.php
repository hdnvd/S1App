<?php

namespace Modules\users\Forms;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\Controllers\usermenuController;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
use Modules\users\PublicClasses\AccessController;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\services\FormCode;


class baseUserMenu {
	public function getMenuItems()
	{
        $links=array();
        $texts=array();
        $usermenuController=new usermenuController();
        $su=new sessionuser();
        $translator=new ModuleTranslator("users");
        $translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
        $Fields=$usermenuController->load();
        $MenuItems=$Fields['menuitems'];
        $ac=new AccessController();
        $dbaccess=new dbaccess();
        for($i=0;$i<count($MenuItems);$i++)
        {
            if($ac->getUserAccess($su->getSystemUserID(), $MenuItems[$i]->getModule(), $MenuItems[$i]->getPage(), "load",$dbaccess,false))
            {
                $tmplink=new AppRooter($MenuItems[$i]->getModule(), $MenuItems[$i]->getPage());
                $params=$MenuItems[$i]->getParameters();
                $params=explode(";", $params);
                for($pi=0;$pi<count($params);$pi++)
                {
                    $param=explode("=",$params[$pi]);
                    if(count($param)>1)
                        $tmplink->addParameter(new UrlParameter($param[0], $param[1]));
                }
                array_push($links, $tmplink->getAbsoluteURL());
                array_push($texts, $translator->getWordTranslation($MenuItems[$i]->getLatintitle()));
            }
        }
        $dbaccess->close_connection();
        return ['links'=>$links,'texts'=>$texts];
	}
}
?>
