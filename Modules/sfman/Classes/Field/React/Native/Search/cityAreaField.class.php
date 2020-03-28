<?php
namespace Modules\sfman\Classes\Field\React\Native\Search;

/**
 * Created by PhpStorm.
 * User: Will
 * Date: 12/1/2019
 * Time: 5:46 PM
 */

class cityAreaField extends reactNativeItemSearchField
{


    /**
     * @return string
     */
    public function getDataStateVariableCodes()
    {
        $StateVariableCodes="area:'' ,";

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
                            <CityAreaSelector
                                onAreaSelected={(AreaID)=>this.setState({area: AreaID})}
                            />";
        return $ViewCodes;
    }

    /**
     * @return string
     */
    public function getSaveCodes()
    {
        $SaveCodes="
									data.append('$this->PureFieldName', this.state.area);";
        return $SaveCodes;
    }
}