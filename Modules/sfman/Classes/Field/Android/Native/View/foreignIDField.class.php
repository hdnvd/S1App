<?php
namespace Modules\sfman\Classes\Field\React\Native\View;

/**
 * Created by PhpStorm.
 * User: Will
 * Date: 12/1/2019
 * Time: 5:46 PM
 */

class foreignIDField extends reactNativeViewField
{


    /**
     * @return string
     */
    public function getDataStateVariableCodes()
    {
        $StateVariableCodes = "
                    $this->PureFieldName" . "info:{},";
        return $StateVariableCodes;
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
        $FiledModule = strtolower($this->getModuleNameFromFIDFieldName($this->FieldName, $this->ModuleName));
        $ViewCodes="";
        if ($FiledModule != "") {
            $ViewCodes = "
                            <TextRow title={'$this->TranslatedFieldName'} content={this.state.LoadedData.$this->LoadedDataSubClass" . "$this->PureFieldName" . "info.name} />";
        }
        return $ViewCodes;
    }

    /**
     * @return string
     */
    public function getSaveCodes()
    {
        return "";
    }
}