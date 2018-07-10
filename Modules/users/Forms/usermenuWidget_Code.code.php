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

		$design=new usermenuWidget_Design();
        $um=new baseUserMenu();
        $res=$um->getMenuItems();
        $design->setLinks($res['links']);
        $design->setTexts($res['texts']);
		return $design->getBodyHTML();
	}
}
?>
