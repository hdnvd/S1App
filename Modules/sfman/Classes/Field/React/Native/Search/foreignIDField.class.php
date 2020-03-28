<?php
namespace Modules\sfman\Classes\Field\React\Native\Search;

use Modules\sfman\Classes\Field\React\Native\Manage\reactNativeManageField;

/**
 * Created by PhpStorm.
 * User: Will
 * Date: 12/1/2019
 * Time: 5:46 PM
 */

class foreignIDField extends \Modules\sfman\Classes\Field\React\Native\Manage\foreignIDField
{


    /**
     * @return string
     */
    public function getDataStateVariableCodes()
    {
        $StateVar="\r\n\t\t\t$this->PureFieldName" . ":'',";
        return $StateVar;
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

        $ViewCodes="";
        $FiledModule = strtolower($this->getModuleNameFromFIDFieldName($this->FieldName, $this->ModuleName));
        if ($FiledModule != "") {

            $ViewCodes="
                            <PickerBox
                                name={'$this->PureFieldName"."s'}
                                title={'$this->TranslatedFieldName'}
                                isOptional={true}
                                selectedValue ={this.state.SearchFields.$this->PureFieldName}
                                onValueChange={(value, index) => {
                                    this.setState({SearchFields:{...this.state.SearchFields,$this->PureFieldName" . ": value}});
                                }}
                                options={this.state.$this->PureFieldName"."Options}
                            />";
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