<?php
namespace Modules\sfman\Classes\Field\React\Native\Manage;

/**
 * Created by PhpStorm.
 * User: Will
 * Date: 12/1/2019
 * Time: 5:46 PM
 */

class clockField extends reactNativeManageField
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
                            <TimeSelector title={'$this->TranslatedFieldName'} value={this.state.formData.$this->PureFieldName} onConfirm={(date)=>this.setState({formData:{...this.state.formData,".$this->PureFieldName.": date}})} />";
        return $ViewCodes;
    }

}