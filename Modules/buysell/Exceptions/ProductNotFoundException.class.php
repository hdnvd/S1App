<?php
namespace Modules\buysell\Exceptions;
/**
 * Created by PhpStorm.
 * User: Hadi
 * Date: 08/02/2017
 * Time: 16:20
 */
class ProductNotFoundException extends \core\CoreClasses\Exception\SweetException
{
    public function __construct($message = null, $code = 0, Exception $previous = null,$ErrorMaker="unknown")
    {
        parent::__construct("ProductNotFoundException:" .$message, $code,$previous);
    }
}