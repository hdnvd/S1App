<?php

namespace Modules\pages\Entity;

use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\Sweet2DArray;

/**
 *
 * @author Hadi Nahavandi
 * @version 0.1
 * @last Edit 2014 May 13 22:49
 *        
 */
class languageEntity extends EntityClass {
	public function getLanguages()
	{
		$Database=new dbquery();
		$result=$Database->Select("id,title as text")->From("language")->ExecuteAssociated();
		return $result;
	}
}

?>