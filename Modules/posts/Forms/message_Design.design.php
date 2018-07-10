<?php

namespace Modules\posts\Forms;

use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\paragraph;

/**
 *
 * @author nahavandi
 *        
 */
class message_Design extends FormDesign {
	private $message;
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\services\FormDesign::getBodyHTML()
	 *
	 */
	public function getBodyHTML($command = "load") {
		$pMessage=new paragraph($this->message);
		return $pMessage;
	}

	public function setMessage($message)
	{
	    $this->message = $message;
	}
}

?>