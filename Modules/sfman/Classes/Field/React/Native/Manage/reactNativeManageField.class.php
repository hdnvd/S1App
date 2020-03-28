<?php
namespace Modules\sfman\Classes\Field\React\Native\Manage;
use Modules\sfman\Classes\Field\React\Native\reactNativeField;
use Modules\sfman\Classes\Field\React\ReactFieldCode;

/**
 * Created by PhpStorm.
 * User: Will
 * Date: 12/1/2019
 * Time: 5:46 PM
 */

class reactNativeManageField extends reactNativeField
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
        return "\r\n\t\t\t$this->PureFieldName:'',";
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
        return "$this->PureFieldName:data.Data.$this->PureFieldName,";
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
                            <TextBox title={'$this->TranslatedFieldName'} value={this.state.formData.$this->PureFieldName} onChangeText={(text) => {this.setState({formData:{...this.state.formData,".$this->PureFieldName.": text}});}}/>";
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