<?php

namespace Modules\gallery\Forms;

use core\CoreClasses\services\FormCode;
use Modules\gallery\Controllers\addphotoController;

/**
 *
 * @author nahavandi
 *        
 */
class deletephoto_Code extends FormCode {
	public function __construct($namespace=null)
	{
		parent::__construct($namespace);
		$this->setThemePage("admin.php");
	}
	public function load()
	{
		$c=new addphotoController();
		$c->deletephoto($_GET['id']);
		echo "تصویر با موفقیت حذف شد";
	}
}

?>