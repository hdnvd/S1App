<?php

namespace Modules\sfman\Controllers;


/**
 * @author Hadi AmirNahavandi
 * @creationDate 1395/10/9 - 2016/12/29 19:36:38
 * @lastUpdate 1395/10/9 - 2016/12/29 19:36:38
 * @SweetFrameworkHelperVersion 1.112
 */
abstract class manageDBReactNativeManageFormController extends manageDBReactNativeFormController
{

    private function _getCityAreaFieldCode($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName){

        $GFC=$this->_getGeneralFieldCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName);
        $InitialDataLoadFieldFillCodes=$GFC->getInitialDataLoadFieldFillCodes();
        $StateVariableCodes="selectedAreaValue: -1,";
        $ConstructorCodes="";
        $ImportCodes="";
        $ClassFieldDefinitionCodes="";
        $LoaderMethodCodes="";
        $LoaderMethodCallCodes="";
        $ViewCodes="
                            <CityAreaSelector
                                onAreaSelected={(AreaID)=>this.setState({selectedAreaValue: AreaID})}
                            />";
        $SaveCodes="
									data.append('$PureFieldName', this.state.selectedAreaValue);";
        $FieldCode=new ReactFieldCode($ImportCodes,$ClassFieldDefinitionCodes,$ConstructorCodes,"",$StateVariableCodes,$InitialDataLoadFieldFillCodes,$LoaderMethodCodes,$LoaderMethodCallCodes,$ViewCodes,$SaveCodes,ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT);
        return $FieldCode;
    }
    private function _getForeignIDFieldCode($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName){

        $GFC=$this->_getGeneralFieldCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName);
        $InitialDataLoadFieldFillCodes="Selected$PureFieldName"."Value:data.Data.$PureFieldName,";
        $StateVariableCodes="";
        $CodeStateVariableCodes="";
        $ConstructorCodes="";
        $ImportCodes="";
        $ClassFieldDefinitionCodes="";
        $LoaderMethodCodes="";
        $LoaderMethodCallCodes="";
        $ViewCodes="";
        $SaveCodes="";
        $FiledModule = strtolower($this->getModuleNameFromFIDFieldName($FieldName, $ModuleName));
        $TableName = strtolower($this->getTableNameFromFIDFieldName($FieldName));
        if ($FiledModule != "") {
            $CodeStateVariableCodes .= "\r\n\t\t\t$PureFieldName"."Options:[<Picker.Item label='$TranslatedFieldName' value='-1' style={generalStyles.pickerItem} />],";
            $StateVariableCodes.="\r\n\t\t\tSelected$PureFieldName" . "Value:'-1',";

            $LoaderMethodCallCodes .= "
        this.load" . ucfirst($PureFieldName) . "s();";
            $LoaderMethodCodes .= "
    load" . ucfirst($PureFieldName) . "s = () => {
        new SweetFetcher().Fetch('/$FiledModule/$TableName',SweetFetcher.METHOD_GET, null, data => {
            let $PureFieldName" . "s=data.Data.map(dt=>{return <Picker.Item label={dt.name} value={dt.id} style={generalStyles.pickerItem} />});
            this.setState({" . $PureFieldName . "Options:$PureFieldName" . "s});
        });
    };
                ";

            $ViewCodes="
                            <PickerBox
                                name={'$PureFieldName"."s'}
                                title={'$TranslatedFieldName'}
                                selectedValue ={this.state.Selected$PureFieldName" . "Value}
                                onValueChange={(value, index) => {
                                    this.setState({Selected$PureFieldName" . "Value: value});
                                }}
                                options={this.state.$PureFieldName"."Options}
                            />";
                $SaveCodes="\r\n\t\t\t\t\t\t\t\t\tdata.append('$PureFieldName', this.state.Selected$PureFieldName" . "Value);";
        }
        $FieldCode=new ReactFieldCode($ImportCodes,$ClassFieldDefinitionCodes,$ConstructorCodes,$CodeStateVariableCodes,$StateVariableCodes,$InitialDataLoadFieldFillCodes,$LoaderMethodCodes,$LoaderMethodCallCodes,$ViewCodes,$SaveCodes,ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT);
        return $FieldCode;
    }

    private function _getImageUploadCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName){

        $GFC=$this->_getGeneralFieldCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName);
        $InitialDataLoadFieldFillCodes=$GFC->getInitialDataLoadFieldFillCodes();
        $StateVariableCodes="\r\n\t\t\tSelected$PureFieldName"."Location:'',";
        $ConstructorCodes="";
        $ImportCodes="";
        $ClassFieldDefinitionCodes="";
        $LoaderMethodCodes="";
        $LoaderMethodCallCodes="";
        $ViewCodes="
                            <ImageSelector title='انتخاب $TranslatedFieldName' onConfirm={(path)=>this.setState({Selected$PureFieldName"."Location : path})} />";
        $SaveCodes="\r\n\t\t\t\t\t\t\t\tComponentHelper.appendImageSelectorToFormDataIfNotNull(data,'$PureFieldName',this.state.Selected$PureFieldName"."Location);";
        $FieldCode=new ReactFieldCode($ImportCodes,$ClassFieldDefinitionCodes,$ConstructorCodes,"",$StateVariableCodes,$InitialDataLoadFieldFillCodes,$LoaderMethodCodes,$LoaderMethodCallCodes,$ViewCodes,$SaveCodes,ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT);
        return $FieldCode;
    }
    private function _getBooleanFieldCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName){
        $GFC=$this->_getGeneralFieldCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName);
        $InitialDataLoadFieldFillCodes=$GFC->getInitialDataLoadFieldFillCodes();
        $StateVariableCodes="\r\n\t\t\t$PureFieldName:0,";
        $ConstructorCodes="";
        $ImportCodes="";
        $ClassFieldDefinitionCodes="";
        $LoaderMethodCodes="";
        $LoaderMethodCallCodes="";
        $ViewCodes="
                            <CheckedRow title='$TranslatedFieldName' checked={this.state.$PureFieldName}
                            onPress={() => this.setState({" . $PureFieldName . ": this.state.$PureFieldName==0?1:0})}
                            />";
        $SaveCodes=$GFC->getSaveCodes();
        $FieldCode=new ReactFieldCode($ImportCodes,$ClassFieldDefinitionCodes,$ConstructorCodes,"",$StateVariableCodes,$InitialDataLoadFieldFillCodes,$LoaderMethodCodes,$LoaderMethodCallCodes,$ViewCodes,$SaveCodes,ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT);
        return $FieldCode;
    }

    private function _getLocationFieldCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName){

        $GFC=$this->_getGeneralFieldCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName);
        $InitialDataLoadFieldFillCodes=$GFC->getInitialDataLoadFieldFillCodes();
        $StateVariableCodes="";
        $ConstructorCodes="";
        $ImportCodes="";
        $ClassFieldDefinitionCodes="";
        $LoaderMethodCodes="";
        $LoaderMethodCallCodes="";
        $ViewCodes="
                            <LocationSelector title='محل' navigation={this.props.navigation}/>";
        $SaveCodes="
                                    data.append('latitude', global.SelectedLocation.latitude);
                                    data.append('longitude', global.SelectedLocation.longitude);";
        $FieldCode=new ReactFieldCode($ImportCodes,$ClassFieldDefinitionCodes,$ConstructorCodes,"",$StateVariableCodes,$InitialDataLoadFieldFillCodes,$LoaderMethodCodes,$LoaderMethodCallCodes,$ViewCodes,$SaveCodes,ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT);
        return $FieldCode;
    }
    private function _getGeneralFieldCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName){
        $InitialDataLoadFieldFillCodes="$PureFieldName:data.Data.$PureFieldName,";
        $StateVariableCodes="\r\n\t\t\t$PureFieldName:'',";
        $ConstructorCodes="";
        $ImportCodes="";
        $ClassFieldDefinitionCodes="";
        $LoaderMethodCodes="";
        $LoaderMethodCallCodes="";
        $ViewCodes="
                            <TextBox title={'$TranslatedFieldName'} value={this.state.$PureFieldName} onChangeText={(text) => {this.setState({".$PureFieldName.": text});}}/>";
        $SaveCodes="\r\n\t\t\t\t\t\t\t\t\tdata.append('$PureFieldName', this.state.$PureFieldName);";
        $FieldCode=new ReactFieldCode($ImportCodes,$ClassFieldDefinitionCodes,$ConstructorCodes,"",$StateVariableCodes,$InitialDataLoadFieldFillCodes,$LoaderMethodCodes,$LoaderMethodCallCodes,$ViewCodes,$SaveCodes,ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT);
        return $FieldCode;
    }
    private function _getNumericFieldCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName){
        $GFC=$this->_getGeneralFieldCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName);
        $InitialDataLoadFieldFillCodes=$GFC->getInitialDataLoadFieldFillCodes();
        $DataStateVariableCodes=$GFC->getStateVariableCodes();
        $ConstructorCodes=$GFC->getConstructorCodes();
        $ImportCodes=$GFC->getImportCodes();
        $ClassFieldDefinitionCodes=$GFC->getClassFieldDefinitionCodes();
        $LoaderMethodCodes=$GFC->getLoaderMethodCodes();
        $LoaderMethodCallCodes=$GFC->getLoaderMethodCallCodes();
        $ViewCodes="
                            <TextBox keyboardType='numeric' title={'$TranslatedFieldName'} value={this.state.$PureFieldName} onChangeText={(text) => {this.setState({".$PureFieldName.": text});}}/>";
        $SaveCodes=$GFC->getSaveCodes();

        $FieldCode=new ReactFieldCode($ImportCodes,$ClassFieldDefinitionCodes,$ConstructorCodes,"",$DataStateVariableCodes,$InitialDataLoadFieldFillCodes,$LoaderMethodCodes,$LoaderMethodCallCodes,$ViewCodes,$SaveCodes,ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT);
        return $FieldCode;
    }
    private function _getEmptyCodedFieldCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName){
        $GFC=$this->_getGeneralFieldCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName);
        $InitialDataLoadFieldFillCodes="";
        $StateVariableCodes="";
        $ConstructorCodes="";
        $ImportCodes="";
        $ClassFieldDefinitionCodes="";
        $LoaderMethodCodes="";
        $LoaderMethodCallCodes="";
        $ViewCodes="";;
        $SaveCodes="";
        $FieldCode=new ReactFieldCode($ImportCodes,$ClassFieldDefinitionCodes,$ConstructorCodes,"",$StateVariableCodes,$InitialDataLoadFieldFillCodes,$LoaderMethodCodes,$LoaderMethodCallCodes,$ViewCodes,$SaveCodes,ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT);
        return $FieldCode;
    }
    private function _getAutoFieldCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName){
        return $this->_getEmptyCodedFieldCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName);
    }

    /**
     * @param string $ModuleName
     * @param string $FormName
     * @param string $FieldName
     * @param string $PureFieldName
     * @param string $TranslatedFieldName
     * @return ReactFieldCode
     */
    private function _getFieldCodes($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName)
    {
        if(FieldType::fieldIsAutoGenerated($FieldName))
            return $this->_getAutoFieldCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName);
        if(FieldType::fieldIsLongitude($FieldName))
            return $this->_getEmptyCodedFieldCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName);
        if(FieldType::fieldIsLatitude($FieldName))
            return $this->_getLocationFieldCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName);
        if(FieldType::getFieldType($FieldName)==FieldType::$CLOCK)
            return $this->_getClockFieldCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName);
        if (FieldType::getFieldType($FieldName) == FieldType::$BOOLEAN)
            return $this->_getBooleanFieldCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName);
        if (FieldType::getFieldType($FieldName) == FieldType::$FID) {

            if (FieldType::fieldIsCityAreaFid($FieldName))
                return $this->_getCityAreaFieldCode($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName);
            return $this->_getForeignIDFieldCode($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName);
        }
        if (FieldType::fieldIsImageUpload($FieldName))
            return $this->_getImageUploadCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName);
        if(FieldType::fieldIsNumber($FieldName))
            return $this->_getNumericFieldCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName);

        return $this->_getGeneralFieldCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName);
    }
    private function _codeGeneratorTemplate($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName){
        $InitialDataLoadFieldFillCodes="";
        $StateVariableCodes="";
        $ConstructorCodes="";
        $ImportCodes="";
        $ClassFieldDefinitionCodes="";
        $LoaderMethodCodes="";
        $LoaderMethodCallCodes="";
        $ViewCodes="";
        $SaveCodes="";
        $FieldCode=new ReactFieldCode($ImportCodes,$ClassFieldDefinitionCodes,$ConstructorCodes,"",$StateVariableCodes,$InitialDataLoadFieldFillCodes,$LoaderMethodCodes,$LoaderMethodCallCodes,$ViewCodes,$SaveCodes,ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT);
        return $FieldCode;
    }
    private function _getClockFieldCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName){
        $GFC=$this->_getGeneralFieldCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName);
        $InitialDataLoadFieldFillCodes=$GFC->getInitialDataLoadFieldFillCodes();
        $StateVariableCodes=$GFC->getStateVariableCodes();
        $ConstructorCodes="";
        $ImportCodes="";
        $ClassFieldDefinitionCodes="";
        $LoaderMethodCodes="";
        $LoaderMethodCallCodes="";
        $ViewCodes="
                            <TimeSelector title={'$TranslatedFieldName'} value={this.state.$PureFieldName} onConfirm={(date)=>this.setState({".$PureFieldName.": date})} />";
        $SaveCodes=$GFC->getSaveCodes();
        $FieldCode=new ReactFieldCode($ImportCodes,$ClassFieldDefinitionCodes,$ConstructorCodes,"",$StateVariableCodes,$InitialDataLoadFieldFillCodes,$LoaderMethodCodes,$LoaderMethodCallCodes,$ViewCodes,$SaveCodes,ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT);
        return $FieldCode;
    }
    protected function makeReactNativeItemManageDesign($formInfo)
    {
        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FormNames = $FormName . "s";
        $UFormNames = ucfirst($FormNames);
        $UFormName = ucfirst($FormName);
        $ModuleNames = $ModuleName . "s";
        $FileName = $ModuleName . "_$FormName" . "Manage";
        $Translations = new Translator();
        $PageTitle = "تعریف " . $Translations->getPersian($FormName, $FormName);
        $AllFields = $this->getAllFormsOfFields();
        $Fields = $AllFields['fields'];
        $PersianFields = $AllFields['persianfields'];
        $PureFields = $AllFields['purefields'];
        $FieldCodes=[];
        $DataStateVariableCodes="";
        $CodeStateVariableCodes="";
        $ConstructorCodes="";
        $ImportCodes="";
        $ClassFieldDefinitionCodes="";
        $LoaderMethodCodes="";
        $LoaderMethodCallCodes="";
        $ViewCodes="";
        $SaveCodes="";
        $InitialDataLoadFieldFillCodes="";
        for ($i = 0; $i < count($Fields); $i++) {
            $FC=$this->_getFieldCodes($ModuleName,$FormName,$Fields[$i],$PureFields[$i],$PersianFields[$i]);
            $DataStateVariableCodes.=$FC->getDataStateVariableCodes();
            $CodeStateVariableCodes.=$FC->getStateVariableCodes();
            $ConstructorCodes.=$FC->getConstructorCodes();
            $ImportCodes.=$FC->getImportCodes();
            $ClassFieldDefinitionCodes.=$FC->getClassFieldDefinitionCodes();
            $LoaderMethodCodes.=$FC->getLoaderMethodCodes();
            $LoaderMethodCallCodes.=$FC->getLoaderMethodCallCodes();
            $InitialDataLoadFieldFillCodes.=$FC->getInitialDataLoadFieldFillCodes();
            $ViewCodes.=$FC->getViewCodes();
            $SaveCodes.=$FC->getSaveCodes();
        }

        $C = "import React, {Component} from 'react'
import { CheckBox , Button } from 'react-native-elements';
import {StyleSheet, View, Alert, TextInput, ScrollView, Dimensions,AsyncStorage,Picker,Text,Image } from 'react-native';
import generalStyles from '../../../../styles/generalStyles';
import SweetFetcher from '../../../../classes/sweet-fetcher';
import Common from '../../../../classes/Common';
import AccessManager from '../../../../classes/AccessManager';
import Constants from '../../../../classes/Constants';
import PickerBox from '../../../../sweet/components/PickerBox';
import TextBox from '../../../../sweet/components/TextBox';
import TimeSelector from '../../../../sweet/components/TimeSelector';
import ImageSelector from '../../../../sweet/components/ImageSelector';
import LocationSelector from '../../../../sweet/components/LocationSelector';
import CityAreaSelector from '../../../../sweet/components/CityAreaSelector';
import CheckedRow from '../../../../sweet/components/CheckedRow';
import ComponentHelper from '../../../../classes/ComponentHelper';
$ImportCodes
export default class  $FileName extends Component<{}> {
    $ClassFieldDefinitionCodes
    constructor(props) {
        super(props);
        this.state =
        {
            isLoading:false,
            $DataStateVariableCodes
            $CodeStateVariableCodes
        };";
        $C .= "
        $ConstructorCodes
        this.loadData();
    }
    loadData=()=>{
$LoaderMethodCallCodes
        if(global.itemID>0){
            this.setState({isLoading:true});
            new SweetFetcher().Fetch('/$ModuleName/$FormName/'+global.itemID,SweetFetcher.METHOD_GET, null, data => {
                data.Data.isLoading=false;
                this.setState({".$InitialDataLoadFieldFillCodes."});
            });
        }//IF
    };
$LoaderMethodCodes
    render() {
        const {height: heightOfDeviceScreen} = Dimensions.get('window');
            return (
                <View style={{flex:1}}  >
                    <ScrollView contentContainerStyle={{minHeight: this.height || heightOfDeviceScreen}}>
                        <View style={generalStyles.container}>
                        $ViewCodes";

        $C .= "
                            <View  style={{marginTop: '3%'}}>
                                <Button title='ذخیره' iconPlacement='right' underlineColorAndroid={'transparent'} buttonStyle={generalStyles.saveButton}  textStyle={generalStyles.saveButtonText}  onPress={(e) => {
                                    let formIsValid=true;
                                    if(formIsValid)
                                    {
                                        const data = new FormData();
                                        let id = '';
                                        let method=SweetFetcher.METHOD_POST;
                                        let Separator='';
                                        let action=AccessManager.INSERT;
                                        if (global.itemID > 0)
                                            id = global.itemID;
                                            ";
        $C .= "\r\n\t\t\t\t\t\t\t\tif(id!==''){";
        $C = $C . "\r\n\t\t\t\t\t\t\t\t\tmethod=SweetFetcher.METHOD_PUT;";
        $C = $C . "\r\n\t\t\t\t\t\t\t\t\tSeparator='/';";
        $C = $C . "\r\n\t\t\t\t\t\t\t\t\taction=AccessManager.EDIT;";
        $C = $C . "\r\n\t\t\t\t\t\t\t\t\t\tdata.append('id', id);";
        $C = $C . "\r\n\t\t\t\t\t\t\t\t}
        $SaveCodes";
        $C .= "
                                        new SweetFetcher().Fetch('/$ModuleName/$FormName'+Separator+id, method, data, data => {
                                             if(data.hasOwnProperty('Data'))
                                             {
                                                 Alert.alert('پیام','اطلاعات با موفقیت ذخیره شد.');
                                             }
                                        },null,'$ModuleName','$FormName',this.props.history);
                                    }
                                }}/>
                            </View>

                        </View>
                    </ScrollView>
                </View>
            )
    }
}
    ";
        $DesignFile = $this->getReactNativeCodeModuleDir() . "/modules/" . $ModuleName . "/pages/$FormName/" . $FileName . ".js";
        $this->SaveFile($DesignFile, $C);
    }

}

?>