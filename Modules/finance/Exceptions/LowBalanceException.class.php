<?php

namespace Modules\finance\Exceptions;

use core\CoreClasses\Exception\SweetException;

/**
 *
 * @author nahavandi
 *        
 */
class LowBalanceException extends SweetException {
	public function __construct()
	{
		parent::__construct("LowBalanceException!", "1",null);
	}
}

?>