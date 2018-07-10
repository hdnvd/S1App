<?php

namespace Modules\users\Exceptions;

use core\CoreClasses\Exception\SweetException;
/**
 *
 * @author nahavandi
 *        
 */
class TooSmallPasswordException extends SweetException{
    public function __construct($message = null, $code = 0, Exception $previous = null,$ErrorMaker="unknown")
    {
        parent::__construct("TooSmallPasswordException:" .$message, $code,$previous);
    }
}

?>