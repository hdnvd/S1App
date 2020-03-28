<?php
namespace Modules\sfman\Classes\Field\React\Native\Manage;

/**
 * Created by PhpStorm.
 * User: Will
 * Date: 12/1/2019
 * Time: 5:46 PM
 */

class locationField extends reactNativeManageField
{

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

        $ViewCodes="
                            <SweetLocationSelector location={SweetLocationSelector.getLocationInfoFromObject(this.state.formData)}
                                                   onLocationChange={(region)=>{
                                                       this.setState({formData:{...this.state.formData,region}});
                                                   }}/>";
        return $ViewCodes;
    }

    /**
     * @return string
     */
    public function getSaveCodes()
    {

        $PostFix="";
        if(strpos($this->FieldName,"_flt")!==false)
            $PostFix="flt";
        $SaveCodes="
                                        data.append('latitude$PostFix', this.state.formData.latitude);
                                        data.append('longitude$PostFix', this.state.formData.longitude);
                                    ";
        return $SaveCodes;
    }
}