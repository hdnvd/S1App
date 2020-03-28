<?php
namespace Modules\sfman\Classes\Field\React\Native\View;
use Modules\sfman\Classes\Field\React\Native\reactNativeField;
use Modules\sfman\Classes\Field\React\ReactFieldCode;

/**
 * Created by PhpStorm.
 * User: Will
 * Date: 12/1/2019
 * Time: 5:46 PM
 */

class reactNativeViewField extends reactNativeField
{

    protected $ModuleName;
    protected $FormName;
    protected $FieldName;
    protected $PureFieldName;
    protected $TranslatedFieldName;
    protected $LoadedDataSubClass;

    /**
     * @return string
     */
    public function getDataStateVariableCodes()
    {
        return "
                $this->PureFieldName:'',";
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
        $ViewCodes = "
                            <TextRow title={'$this->TranslatedFieldName'} content={this.state.LoadedData.$this->LoadedDataSubClass" . "$this->PureFieldName} />";
        return $ViewCodes;
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