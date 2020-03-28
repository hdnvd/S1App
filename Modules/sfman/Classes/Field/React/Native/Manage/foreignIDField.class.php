<?php
namespace Modules\sfman\Classes\Field\React\Native\Manage;

/**
 * Created by PhpStorm.
 * User: Will
 * Date: 12/1/2019
 * Time: 5:46 PM
 */

class foreignIDField extends reactNativeManageField
{


    /**
     * @return string
     */
    public function getInitialDataLoadFieldFillCodes()
    {
        return "$this->PureFieldName".":data.Data.$this->PureFieldName,";
    }

    /**
     * @return string
     */
    public function getDataStateVariableCodes()
    {
        $FiledModule = strtolower($this->getModuleNameFromFIDFieldName($this->FieldName, $this->ModuleName));
        $StateVariableCodes="";
        if ($FiledModule != "") {
            $StateVariableCodes.="\r\n\t\t\t$this->PureFieldName" . ":'-1',";
        }
        return $StateVariableCodes;
    }

    /**
     * @return string
     */
    public function getStateVariableCodes()
    {
        $CodeStateVariableCodes="";
        $FiledModule = strtolower($this->getModuleNameFromFIDFieldName($this->FieldName, $this->ModuleName));
        if ($FiledModule != "") {
            $CodeStateVariableCodes .= "\r\n\t\t\t$this->PureFieldName"."Options:null,";
        }
        return $CodeStateVariableCodes;
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
        $LoaderMethodCodes="";
        $FiledModule = strtolower($this->getModuleNameFromFIDFieldName($this->FieldName, $this->ModuleName));
        $TableName = strtolower($this->getTableNameFromFIDFieldName($this->FieldName));
        if ($FiledModule != "") {
            $LoaderMethodCodes .= "
    load" . ucfirst($this->PureFieldName) . "s = () => {
        new SweetFetcher().Fetch('/$FiledModule/".$TableName."',SweetFetcher.METHOD_GET, null, data => {
            this.setState({" . $this->PureFieldName . "Options:data.Data});
        });
    };
                ";
        }
        return $LoaderMethodCodes;
    }

    /**
     * @return string
     */
    public function getLoaderMethodCallCodes()
    {
        $LoaderMethodCallCodes="";
        $FiledModule = strtolower($this->getModuleNameFromFIDFieldName($this->FieldName, $this->ModuleName));
        if ($FiledModule != "") {
            $LoaderMethodCallCodes .= "
        this.load" . ucfirst($this->PureFieldName) . "s();";
        }
        return $LoaderMethodCallCodes;
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
                                selectedValue ={this.state.formData.$this->PureFieldName" . "}
                                onValueChange={(value, index) => {
                                    this.setState({formData:{...this.state.formData,$this->PureFieldName" . ": value}});
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