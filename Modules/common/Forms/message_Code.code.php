<?php

namespace Modules\common\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/02/20 10:40:48
 *@lastUpdate 2015/02/20 10:40:48
 *@SweetFrameworkHelperVersion 1.102
*/


class message_Code extends FormCode {
    private $message;
	public function load()
	{
		$translator=new ModuleTranslator("common");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		
		$design=new message_Design();
		$design->setMessage($this->message);
		return $design->getBodyHTML();
	}

	public function setMessage($message)
	{
	    $this->message = $message;
	}
}
?>
