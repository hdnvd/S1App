<?php

namespace Modules\shift\Exceptions;

use core\CoreClasses\Exception\SweetException;
/**
 *
 * @author nahavandi
 *        
 */
class MultipleBakhshException extends SweetException{
    public function __construct($message = null, $code = 0, Exception $previous = null,$ErrorMaker="unknown")
    {
        parent::__construct($message, $code,$previous);
    }
}

?>