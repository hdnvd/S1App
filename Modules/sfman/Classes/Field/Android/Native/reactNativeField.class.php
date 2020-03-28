<?php
namespace Modules\sfman\Classes\Field\React\Native;
use Modules\sfman\Classes\Field\FieldCode;
use Modules\sfman\Classes\Field\React\ReactFieldCode;

/**
 * Created by PhpStorm.
 * User: Will
 * Date: 12/1/2019
 * Time: 5:46 PM
 */

class reactNativeField extends ReactFieldCode
{

    protected $ModuleName;
    protected $FormName;
    protected $FieldName;
    protected $PureFieldName;
    protected $TranslatedFieldName;
    protected $LoadedDataSubClass;

    /**
     * reactNativeField constructor.
     * @param $ModuleName
     * @param $FormName
     * @param $FieldName
     * @param $PureFieldName
     * @param $TranslatedFieldName
     * @param $LoadedDataSubClass
     */
    public function __construct($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass)
    {
        $this->ModuleName = $ModuleName;
        $this->FormName = $FormName;
        $this->FieldName = $FieldName;
        $this->PureFieldName = $PureFieldName;
        $this->TranslatedFieldName = $TranslatedFieldName;
        $this->LoadedDataSubClass = $LoadedDataSubClass;
    }


    /**
     * @return string
     */
    public function getDataStateVariableCodes()
    {
        return "";
    }

    /**
     * @return string
     */
    public function getStateVariableCodes()
    {
        return "";
    }

    /**
     * @return string
     */
    public function getConstructorCodes()
    {
        return "";
    }

    /**
     * @return string
     */
    public function getImportCodes()
    {
        return "";
    }

    /**
     * @return string
     */
    public function getClassFieldDefinitionCodes()
    {
        return "";
    }

    /**
     * @return string
     */
    public function getInitialDataLoadFieldFillCodes()
    {
        return "";
    }

    /**
     * @return string
     */
    public function getLoaderMethodCodes()
    {
        return "";
    }

    /**
     * @return string
     */
    public function getLoaderMethodCallCodes()
    {
        return "";
    }

    /**
     * @return string
     */
    public function getViewCodes()
    {
        return "";
    }

    /**
     * @return string
     */
    public function getSaveCodes()
    {
        return "";
    }
    /**
     * @return int
     */
    public function getAddPolicy()
    {
        return ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT;
    }
}