<?php
namespace Modules\sfman\Classes\Field\React\Native\Search;

use Modules\sfman\Classes\Field\React\Native\Manage\reactNativeManageField;
use Modules\sfman\Classes\Field\React\ReactFieldCode;

/**
 * Created by PhpStorm.
 * User: Will
 * Date: 12/1/2019
 * Time: 5:46 PM
 */

class reactNativeItemSearchField extends reactNativeManageField
{

    public function getViewCodes()
    {
        $vc="
                            <TextBox title={'$this->TranslatedFieldName'} value={this.state.SearchFields.$this->PureFieldName} onChangeText={(text) => {this.setState({SearchFields:{...this.state.SearchFields,".$this->PureFieldName.": text}});}}/>";
        return $vc;
    }
}