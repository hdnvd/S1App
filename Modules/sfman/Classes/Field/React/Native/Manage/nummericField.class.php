<?php
namespace Modules\sfman\Classes\Field\React\Native\Manage;

/**
 * Created by PhpStorm.
 * User: Will
 * Date: 12/1/2019
 * Time: 5:46 PM
 */

class nummericField extends reactNativeManageField
{
    /**
     * @return string
     */
    public function getViewCodes()
    {
        $ViewCodes="
                            <TextBox keyboardType='numeric' title={'$this->TranslatedFieldName'} value={this.state.formData.$this->PureFieldName} onChangeText={(text) => {this.setState({formData:{...this.state.formData,".$this->PureFieldName.": text}});}}/>";
        return $ViewCodes;
    }

}