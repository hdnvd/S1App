<?php
namespace Modules\sfman\Classes\Field\React\Native\Manage;

/**
 * Created by PhpStorm.
 * User: Will
 * Date: 12/1/2019
 * Time: 5:46 PM
 */

class imageUploadField extends reactNativeManageField
{

    /**
     * @return string
     */
    public function getDataStateVariableCodes()
    {
        return "\r\n\t\t\t$this->PureFieldName"."Path:'',";
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
                            <SweetImageSelector title='$this->TranslatedFieldName' onConfirm={(path)=>{
                                this.setState({formData:{...this.state.formData,$this->PureFieldName"."Path:ComponentHelper.getImageSelectorNormalPath(path)});
                            }} url={Constants.SiteURL+'/'+this.state.formData.".$this->PureFieldName."}/>";
    }

    /**
     * @return string
     */
    public function getSaveCodes()
    {
        return "";
    }
}