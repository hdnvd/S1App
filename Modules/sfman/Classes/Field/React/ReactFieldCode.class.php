<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 2/17/2018
 * Time: 9:45 AM
 */

namespace Modules\sfman\Classes\Field\React;

use Modules\sfman\Classes\Field\FieldCode;

class ReactFieldCode extends FieldCode
{
    private $DataStateVariableCodes = "";
    private $StateVariableCodes = "";
    private $ConstructorCodes = "";
    private $ImportCodes = "";
    private $ClassFieldDefinitionCodes = "";
    private $InitialDataLoadFieldFillCodes = "";

    private $LoaderMethodCodes = "";
    private $LoaderMethodCallCodes = "";
    private $ViewCodes = "";
    private $SaveCodes = "";
    private $SearchCodes = "";

    /**
     * FieldCode constructor.
     * @param string $StateVariableCodes
     * @param string $DataStateVariableCodes
     * @param string $ConstructorCodes
     * @param string $ImportCodes
     * @param string $ClassFieldDefinitionCodes
     * @param string $InitialDataLoadFieldFillCodes
     * @param string $LoaderMethodCodes
     * @param string $LoaderMethodCallCodes
     * @param string $ViewCodes
     * @param string $SaveCodes
     * @param int $AddPolicy
     */
    /*public function __construct($ImportCodes,$ClassFieldDefinitionCodes,$ConstructorCodes,$StateVariableCodes,$DataStateVariableCodes, $InitialDataLoadFieldFillCodes,$LoaderMethodCodes, $LoaderMethodCallCodes, $ViewCodes ,$SaveCodes,$AddPolicy)
    {
        $this->setAddPolicy($AddPolicy);
        $this->DataStateVariableCodes = $DataStateVariableCodes;
        $this->ConstructorCodes = $ConstructorCodes;
        $this->ImportCodes = $ImportCodes;
        $this->ClassFieldDefinitionCodes = $ClassFieldDefinitionCodes;
        $this->LoaderMethodCodes = $LoaderMethodCodes;
        $this->InitialDataLoadFieldFillCodes = $InitialDataLoadFieldFillCodes;
        $this->LoaderMethodCallCodes = $LoaderMethodCallCodes;
        $this->StateVariableCodes = $StateVariableCodes;
        $this->ViewCodes = $ViewCodes;
        $this->SaveCodes = $SaveCodes;
    }
*/
    /**
     * @return string
     */
    public function getDataStateVariableCodes()
    {
        return $this->DataStateVariableCodes;
    }

    /**
     * @return string
     */
    public function getSaveCodes()
    {
        return $this->SaveCodes;
    }

    /**
     * @param string $SaveCodes
     */
    public function setSaveCodes($SaveCodes)
    {
        $this->SaveCodes = $SaveCodes;
    }

    /**
     * @param string $DataStateVariableCodes
     */
    public function setDataStateVariableCodes($DataStateVariableCodes)
    {
        $this->DataStateVariableCodes = $DataStateVariableCodes;
    }

    /**
     * @return string
     */
    public function getConstructorCodes()
    {
        return $this->ConstructorCodes;
    }

    /**
     * @param string $ConstructorCodes
     */
    public function setConstructorCodes($ConstructorCodes)
    {
        $this->ConstructorCodes = $ConstructorCodes;
    }

    /**
     * @return string
     */
    public function getImportCodes()
    {
        return $this->ImportCodes;
    }

    /**
     * @param string $ImportCodes
     */
    public function setImportCodes($ImportCodes)
    {
        $this->ImportCodes = $ImportCodes;
    }

    /**
     * @return string
     */
    public function getClassFieldDefinitionCodes()
    {
        return $this->ClassFieldDefinitionCodes;
    }

    /**
     * @param string $ClassFieldDefinitionCodes
     */
    public function setClassFieldDefinitionCodes($ClassFieldDefinitionCodes)
    {
        $this->ClassFieldDefinitionCodes = $ClassFieldDefinitionCodes;
    }

    /**
     * @return string
     */
    public function getLoaderMethodCodes()
    {
        return $this->LoaderMethodCodes;
    }

    /**
     * @param string $LoaderMethodCodes
     */
    public function setLoaderMethodCodes($LoaderMethodCodes)
    {
        $this->LoaderMethodCodes = $LoaderMethodCodes;
    }

    /**
     * @return string
     */
    public function getLoaderMethodCallCodes()
    {
        return $this->LoaderMethodCallCodes;
    }

    /**
     * @param string $LoaderMethodCallCodes
     */
    public function setLoaderMethodCallCodes($LoaderMethodCallCodes)
    {
        $this->LoaderMethodCallCodes = $LoaderMethodCallCodes;
    }

    /**
     * @return string
     */
    public function getViewCodes()
    {
        return $this->ViewCodes;
    }

    /**
     * @param string $ViewCodes
     */
    public function setViewCodes($ViewCodes)
    {
        $this->ViewCodes = $ViewCodes;
    }

    /**
     * @return string
     */
    public function getStateVariableCodes()
    {
        return $this->StateVariableCodes;
    }

    /**
     * @param string $StateVariableCodes
     */
    public function setStateVariableCodes($StateVariableCodes)
    {
        $this->StateVariableCodes = $StateVariableCodes;
    }
    /**
     * @return string
     */
    public function getInitialDataLoadFieldFillCodes()
    {
        return $this->InitialDataLoadFieldFillCodes;
    }

    /**
     * @param string $InitialDataLoadFieldFillCodes
     */
    public function setInitialDataLoadFieldFillCodes($InitialDataLoadFieldFillCodes)
    {
        $this->InitialDataLoadFieldFillCodes = $InitialDataLoadFieldFillCodes;
    }
}