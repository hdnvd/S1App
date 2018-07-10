<?php

namespace Modules\posts\Controllers;
use core\CoreClasses\services\Controller;
use Modules\parameters\PublicClasses\ParameterManager;


class updateserviceController extends PostManageCTL {
	public function load()
	{
		$ParamMan=new ParameterManager();
		$Result['publish']=$ParamMan->getParameter("posts_updateservice_publishservice");
		$Result['maxposts']=$ParamMan->getParameter("posts_updateservice_maxposts");
		return $Result;
	}
}
?>
