<?php
namespace Modules\sfman\Classes\Field\React\Native\Manage;

/**
 * Created by PhpStorm.
 * User: Will
 * Date: 12/1/2019
 * Time: 5:46 PM
 */

class cityAreaField extends reactNativeManageField
{

    /**
     * @return string
     */
    public function getDataStateVariableCodes()
    {
        return "area: -1,";
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
        return "
                            <CityAreaSelectorModal area={this.state.formData.area}
                                onSelect={(placeObject)=>this.setState({formData:{...this.state.formData,area: placeObject.area}})}
                            />";
    }

    /**
     * @return string
     */
    public function getSaveCodes()
    {
        return "";
    }
}