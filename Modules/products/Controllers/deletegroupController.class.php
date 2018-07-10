<?php

namespace Modules\products\Controllers;
use core\CoreClasses\services\Controller;
use Modules\products\Entity\ProductGroupEntity;
use Modules\products\Entity\products_productgroupEntity;


class deletegroupController extends Controller {
	public function load($GroupLangID)
	{
		$E=new products_productgroupEntity();
		$E->Update($GroupLangID, null, null, null, null, "1");
	}
}
?>
