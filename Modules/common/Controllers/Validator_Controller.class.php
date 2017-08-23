<?php

namespace Modules\common\Controllers;

use Modules\common\Entity\validation_validationroleEntity;
/**
 *
 * @author nahavandi
 *        
 */
class Validator_Controller {
	public function load($ID)
	{
		$Ent=new validation_validationroleEntity();
		return $Ent->Select(array("id"), array($ID));
	}
	public function loadAll()
	{
		$Ent=new validation_validationroleEntity();
		return $Ent->Select(array(), array());
	}
}

?>