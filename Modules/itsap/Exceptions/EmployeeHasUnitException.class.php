<?php
namespace Modules\itsap\Exceptions;
use core\CoreClasses\Exception\SweetException;

/**
 *
 * @author nahavandi
 *        
 */
class EmployeeHasUnitException extends SweetException {
	public function __construct($message = null, $code = 0, \Exception $previous = null,$ErrorMaker="unknown")
	{
		parent::__construct("FieldTooSmallException:" . $message, $code, $previous,$ErrorMaker);
	}
}

?>