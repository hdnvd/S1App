<?php
namespace Modules\sfman\Classes\Field\React\Native\View;

/**
 * Created by PhpStorm.
 * User: Will
 * Date: 12/1/2019
 * Time: 5:46 PM
 */

class cityAreaField extends reactNativeViewField
{


    /**
     * @return string
     */
    public function getDataStateVariableCodes()
    {
        $StateVariableCodes = "
                    provinceinfo:{},
                    cityinfo:{},
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

        $ViewCodes = "
                            <TextRow title={'محل'} content={this.state.LoadedData.$this->LoadedDataSubClass" . "provinceinfo.title+' - '+this.state.LoadedData.$this->LoadedDataSubClass" . "cityinfo.title+' - '+this.state.LoadedData.$this->LoadedDataSubClass" . "$this->PureFieldName" . "info.title} />";
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