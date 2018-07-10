<?php

namespace Modules\posts\Exceptions;

use core\CoreClasses\Exception\SweetException;

/**
 *
 * @author nahavandi
 *        
 */
class PostExistsException extends SweetException {
	public function __construct($ErrorMaker)
	{
		parent::__construct("Post Exists!", "1",null);
		$this->setErrorMaker($ErrorMaker);
	}
}

?>