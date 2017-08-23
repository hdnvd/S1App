<?php

namespace Modules\languages\PublicClasses;

/**
 *
 * @author nahavandi
 *        
 */
class LanguageTranslator {
	private $languageName,$langURL;
	public function __construct()
	{
		$this->langURL=DEFAULT_PUBLICPATH . "content/files/languages/";
	}
	public function getWordTranslation($word)
	{
		return $this->getWordTranslationFromFile($word);
	}
	protected function getWordTranslationFromFile($word)
	{
		if(!isset($this->languageName))
			$this->languageName=CurrentLanguageManager::getCurrentLanguageName();
		$iniFile=$this->langURL. $this->languageName . ".ini";
		$words=parse_ini_file($iniFile);
		if(key_exists($word, $words))
			return $words[$word];
		else
			return $word;
	}

	public function setLanguageName($languageName)
	{
	    $this->languageName = $languageName;
	}

	protected function setLangURL($langURL)
	{
	    $this->langURL = $langURL;
	}

	public function getLanguageName()
	{
	    return $this->languageName;
	}
}


?>