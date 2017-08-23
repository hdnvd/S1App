<?php

namespace Modules\languages\PublicClasses;

/**
 *
 * @author Hadi Nahavandi
 *        
 */
class CurrentLanguageManager {

	public static function getCurrentLanguageID()
	{
$lang=DEFAULT_LANGUAGE;
		if(isset($_GET['language']))
			$lang=$_GET['language'];
		if($lang=="fa")
			return 2;
		elseif ($lang=="en")
			return 3;
		else
			return 2;
	} 
	public static function getCurrentLanguageName()
	{
		if (isset($_GET['language']))
			return $_GET['language'];
		else
			return DEFAULT_LANGUAGE;
	}
	
	
	
}

?>
