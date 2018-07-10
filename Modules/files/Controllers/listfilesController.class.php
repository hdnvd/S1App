<?php

namespace Modules\files\Controllers;
use core\CoreClasses\services\Controller;
use Modules\files\Entity\FileEntity;


class listfilesController extends Controller {
	public function load()
	{
		$fE=new FileEntity();
		return $fE->Find(null, null);
	}
}
?>
