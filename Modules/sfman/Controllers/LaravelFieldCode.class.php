<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 2/17/2018
 * Time: 9:45 AM
 */

namespace Modules\sfman\Controllers;


class LaravelFieldCode extends FieldCode
{
    private $AddGetterCodes = "";
    private $AddFieldSetCodes = "";
    private $UpdateGetterCodes = "";
    private $UpdateFieldSetCodes = "";
    private $ListQueryCodes = "";
    private $ListFieldLoadCodes = "";
    private $SingleLoadFieldLoadCodes = "";

    /**
     * LaravelFieldCode constructor.
     * @param string $AddGetterCodes
     * @param string $AddFieldSetCodes
     * @param string $UpdateGetterCodes
     * @param string $UpdateFieldSetCodes
     * @param string $ListQueryCodes
     * @param string $ListFieldLoadCodes
     * @param string $SingleLoadFieldLoadCodes
     * @param int $AddPolicy
     */
    public function __construct($AddGetterCodes, $AddFieldSetCodes, $UpdateGetterCodes, $UpdateFieldSetCodes, $ListQueryCodes, $ListFieldLoadCodes, $SingleLoadFieldLoadCodes,$AddPolicy)
    {
        $this->setAddPolicy($AddPolicy);
        $this->AddGetterCodes = $AddGetterCodes;
        $this->AddFieldSetCodes = $AddFieldSetCodes;
        $this->UpdateGetterCodes = $UpdateGetterCodes;
        $this->UpdateFieldSetCodes = $UpdateFieldSetCodes;
        $this->ListQueryCodes = $ListQueryCodes;
        $this->ListFieldLoadCodes = $ListFieldLoadCodes;
        $this->SingleLoadFieldLoadCodes = $SingleLoadFieldLoadCodes;
    }

    /**
     * @return string
     */
    public function getAddGetterCodes()
    {
        return $this->AddGetterCodes;
    }

    /**
     * @param string $AddGetterCodes
     */
    public function setAddGetterCodes($AddGetterCodes)
    {
        $this->AddGetterCodes = $AddGetterCodes;
    }

    /**
     * @return string
     */
    public function getAddFieldSetCodes()
    {
        return $this->AddFieldSetCodes;
    }

    /**
     * @param string $AddFieldSetCodes
     */
    public function setAddFieldSetCodes($AddFieldSetCodes)
    {
        $this->AddFieldSetCodes = $AddFieldSetCodes;
    }

    /**
     * @return string
     */
    public function getUpdateGetterCodes()
    {
        return $this->UpdateGetterCodes;
    }

    /**
     * @param string $UpdateGetterCodes
     */
    public function setUpdateGetterCodes($UpdateGetterCodes)
    {
        $this->UpdateGetterCodes = $UpdateGetterCodes;
    }

    /**
     * @return string
     */
    public function getUpdateFieldSetCodes()
    {
        return $this->UpdateFieldSetCodes;
    }

    /**
     * @param string $UpdateFieldSetCodes
     */
    public function setUpdateFieldSetCodes($UpdateFieldSetCodes)
    {
        $this->UpdateFieldSetCodes = $UpdateFieldSetCodes;
    }

    /**
     * @return string
     */
    public function getListQueryCodes()
    {
        return $this->ListQueryCodes;
    }

    /**
     * @param string $ListQueryCodes
     */
    public function setListQueryCodes($ListQueryCodes)
    {
        $this->ListQueryCodes = $ListQueryCodes;
    }

    /**
     * @return string
     */
    public function getListFieldLoadCodes()
    {
        return $this->ListFieldLoadCodes;
    }

    /**
     * @param string $ListFieldLoadCodes
     */
    public function setListFieldLoadCodes($ListFieldLoadCodes)
    {
        $this->ListFieldLoadCodes = $ListFieldLoadCodes;
    }

    /**
     * @return string
     */
    public function getSingleLoadFieldLoadCodes()
    {
        return $this->SingleLoadFieldLoadCodes;
    }

    /**
     * @param string $SingleLoadFieldLoadCodes
     */
    public function setSingleLoadFieldLoadCodes($SingleLoadFieldLoadCodes)
    {
        $this->SingleLoadFieldLoadCodes = $SingleLoadFieldLoadCodes;
    }
}