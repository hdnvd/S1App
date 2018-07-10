<?php

namespace Modules\languages\PublicClasses;

/**
 *
 * @author nahavandi
 *        
 */
class ModuleTranslator extends LanguageTranslator {
	private $ModuleName;
	public function __construct($ModuleName)
	{
		$langURL=DEFAULT_APPPATH . "Modules/" .  $ModuleName .  "/languages/";
		$this->setLangURL($langURL);
	}
}

?>