<?php

namespace Modules\files\Controllers;
use core\CoreClasses\services\Controller;
use Modules\files\Entity\FileEntity;


class fileuploadController extends Controller {
	public function load()
	{
		return null;
	}
	public function upload($Url,$Title)
	{
		$fE=new FileEntity();
		return $fE->Insert($Url, $Title);
	}
}
?>
