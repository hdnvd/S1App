<?php

namespace Modules\users\Forms;
use core\CoreClasses\services\FormCode;


class usermenu_Code extends FormCode {
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
