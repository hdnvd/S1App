<?php
namespace Modules\sfman\Classes\Field\React\Native\Search;

/**
 * Created by PhpStorm.
 * User: Will
 * Date: 12/1/2019
 * Time: 5:46 PM
 */

class nummericField extends \Modules\sfman\Classes\Field\React\Native\Manage\nummericField
{


    /**
     * @return string
     */
    public function getViewCodes()
    {
        $ViewCodes="
                            <TextBox keyboardType='numeric' title={'$this->TranslatedFieldName'} value={this.state.SearchFields.$this->PureFieldName} onChangeText={(text) => {this.setState({SearchFields:{...this.state.SearchFields,".$this->PureFieldName.": text}});}}/>";

        return $ViewCodes;
    }


}