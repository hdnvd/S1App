<?php
namespace Modules\sfman\Classes\Field\React\Native\View;

use Modules\sfman\Classes\Field\React\ReactFieldCode;

/**
 * Created by PhpStorm.
 * User: Will
 * Date: 12/1/2019
 * Time: 5:46 PM
 */

class imageUploadField extends reactNativeViewField
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
                          <Image style={generalStyles.topimage} source={{uri: Constants.ServerURL+'/'+this.state.LoadedData.$this->LoadedDataSubClass" . "$this->PureFieldName}}/>
";
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
        return ReactFieldCode::$ADD_POLICY_TO_TOP;
    }
}