<?php
namespace Modules\common\PublicClasses;

/**
 * Created by PhpStorm.
 * User: Will
 * Date: 1/24/2018
 * Time: 1:21 PM
 */
class UrlParameter
{
    private $Field,$value;
    public function __construct($Field,$Value)
    {
        $this->setField($Field);
        $this->setValue($Value);
    }
    public function getField()
    {
        return $this->Field;
    }

    public function setField($field)
    {
        $this->Field = $field;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

}