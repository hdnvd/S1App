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

    protected function _getCityAreaFieldManageCode($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass){

        $GFC=$this->_getGeneralFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
        $InitialDataLoadFieldFillCodes=$GFC->getInitialDataLoadFieldFillCodes();
        $StateVariableCodes="area: -1,";
        $ConstructorCodes="";
        $ImportCodes="";
        $ClassFieldDefinitionCodes="";
        $LoaderMethodCodes="";
        $LoaderMethodCallCodes="";
        $ViewCodes="
                            <CityAreaSelectorModal area={this.state.formData.area}
                                onSelect={(placeObject)=>this.setState({formData:{...this.state.formData,area: placeObject.area}})}
                            />";
        /*$SaveCodes="
									data.append('$PureFieldName', this.state.formData.selectedAreaValue);";*/
        $SaveCodes="";

        $FieldCode=new ReactFieldCode($ImportCodes,$ClassFieldDefinitionCodes,$ConstructorCodes,"",$StateVariableCodes,$InitialDataLoadFieldFillCodes,$LoaderMethodCodes,$LoaderMethodCallCodes,$ViewCodes,$SaveCodes,ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT);
        return $FieldCode;
    }
    protected function _getForeignIDFieldManageCode($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass){

        $GFC=$this->_getGeneralFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
        $InitialDataLoadFieldFillCodes="$PureFieldName".":data.Data.$PureFieldName,";
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
            $CodeStateVariableCodes .= "\r\n\t\t\t$PureFieldName"."Options:null,";
            $StateVariableCodes.="\r\n\t\t\t$PureFieldName" . ":'-1',";

            $LoaderMethodCallCodes .= "
        this.load" . ucfirst($PureFieldName) . "s();";
            $LoaderMethodCodes .= "
    load" . ucfirst($PureFieldName) . "s = () => {
        new SweetFetcher().Fetch('/$FiledModule/$TableName',SweetFetcher.METHOD_GET, null, data => {
            this.setState({" . $PureFieldName . "Options:data.Data});
        });
    };
                ";

            $ViewCodes="
                            <PickerBox
                                name={'$PureFieldName"."s'}
                                title={'$TranslatedFieldName'}
                                selectedValue ={this.state.formData.$PureFieldName" . "}
                                onValueChange={(value, index) => {
                                    this.setState({formData:{...this.state.formData,$PureFieldName" . ": value}});
                                }}
                                options={this.state.$PureFieldName"."Options}
                            />";
//                $SaveCodes="\r\n\t\t\t\t\t\t\t\t\tdata.append('$PureFieldName', this.state.formData.Selected$PureFieldName" . "Value);";
            $SaveCodes="";

        }
        $FieldCode=new ReactFieldCode($ImportCodes,$ClassFieldDefinitionCodes,$ConstructorCodes,$CodeStateVariableCodes,$StateVariableCodes,$InitialDataLoadFieldFillCodes,$LoaderMethodCodes,$LoaderMethodCallCodes,$ViewCodes,$SaveCodes,ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT);
        return $FieldCode;
    }

    protected function _getImageUploadFieldManageCodes($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName,$LoadedDataSubClass){

        $GFC=$this->_getGeneralFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
        $InitialDataLoadFieldFillCodes=$GFC->getInitialDataLoadFieldFillCodes();
        $StateVariableCodes="\r\n\t\t\tSelected$PureFieldName"."Location:'',";
        $ConstructorCodes="";
        $ImportCodes="";
        $ClassFieldDefinitionCodes="";
        $LoaderMethodCodes="";
        $LoaderMethodCallCodes="";
        $ViewCodes="
                            <ImageSelector title='انتخاب $TranslatedFieldName' onConfirm={(path,onEnd)=>{onEnd(true);this.setState({formData:{...this.state.formData,$PureFieldName:ComponentHelper.getImageSelectorNormalPath(path)},Selected$PureFieldName"."Location : path});}} />";
//        $SaveCodes="\r\n\t\t\t\t\t\t\t\tComponentHelper.appendImageSelectorToFormDataIfNotNull(data,'$PureFieldName',this.state.formData.Selected$PureFieldName"."Location);";
        $SaveCodes="";
        $FieldCode=new ReactFieldCode($ImportCodes,$ClassFieldDefinitionCodes,$ConstructorCodes,"",$StateVariableCodes,$InitialDataLoadFieldFillCodes,$LoaderMethodCodes,$LoaderMethodCallCodes,$ViewCodes,$SaveCodes,ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT);
        return $FieldCode;
    }
    protected function _getBooleanFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass){
        $GFC=$this->_getGeneralFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
        $InitialDataLoadFieldFillCodes=$GFC->getInitialDataLoadFieldFillCodes();
        $StateVariableCodes="\r\n\t\t\t$PureFieldName:0,";
        $ConstructorCodes="";
        $ImportCodes="";
        $ClassFieldDefinitionCodes="";
        $LoaderMethodCodes="";
        $LoaderMethodCallCodes="";
        $ViewCodes="
                            <CheckedRow title='$TranslatedFieldName' checked={this.state.formData.$PureFieldName}
                            onPress={() => this.setState({formData:{...this.state.formData," . $PureFieldName . ": this.state.formData.$PureFieldName==0?1:0}})}
                            />";
        $SaveCodes=$GFC->getSaveCodes();
        $FieldCode=new ReactFieldCode($ImportCodes,$ClassFieldDefinitionCodes,$ConstructorCodes,"",$StateVariableCodes,$InitialDataLoadFieldFillCodes,$LoaderMethodCodes,$LoaderMethodCallCodes,$ViewCodes,$SaveCodes,ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT);
        return $FieldCode;
    }

    protected function _getLocationFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass){

        $GFC=$this->_getGeneralFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
        $InitialDataLoadFieldFillCodes=$GFC->getInitialDataLoadFieldFillCodes();
        $StateVariableCodes="";
        $ConstructorCodes="";
        $ImportCodes="";
        $ClassFieldDefinitionCodes="";
        $LoaderMethodCodes="";
        $LoaderMethodCallCodes="";
        $PostFix="";
        if(strpos($FieldName,"_flt")!==false)
            $PostFix="flt";
        $ViewCodes="
                            <SweetLocationSelector location={SweetLocationSelector.getLocationInfoFromObject(this.state.formData)}
                                                   onLocationChange={(region)=>{
                                                       this.setState({formData:{...this.state.formData,region}});
                                                   }}/>";
        $SaveCodes="
                                        data.append('latitude$PostFix', this.state.formData.latitude);
                                        data.append('longitude$PostFix', this.state.formData.longitude);
                                    ";
        $FieldCode=new ReactFieldCode($ImportCodes,$ClassFieldDefinitionCodes,$ConstructorCodes,"",$StateVariableCodes,$InitialDataLoadFieldFillCodes,$LoaderMethodCodes,$LoaderMethodCallCodes,$ViewCodes,$SaveCodes,ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT);
        return $FieldCode;
    }
    protected function _getGeneralFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass){
        $InitialDataLoadFieldFillCodes="$PureFieldName:data.Data.$PureFieldName,";
        $StateVariableCodes="\r\n\t\t\t$PureFieldName:'',";
        $ConstructorCodes="";
        $ImportCodes="";
        $ClassFieldDefinitionCodes="";
        $LoaderMethodCodes="";
        $LoaderMethodCallCodes="";
        $ViewCodes="
                            <TextBox title={'$TranslatedFieldName'} value={this.state.formData.$PureFieldName} onChangeText={(text) => {this.setState({formData:{...this.state.formData,".$PureFieldName.": text}});}}/>";
//        $SaveCodes="\r\n\t\t\t\t\t\t\t\t\tdata.append('$PureFieldName', this.state.formData.$PureFieldName);";
        $SaveCodes="";

        $FieldCode=new ReactFieldCode($ImportCodes,$ClassFieldDefinitionCodes,$ConstructorCodes,"",$StateVariableCodes,$InitialDataLoadFieldFillCodes,$LoaderMethodCodes,$LoaderMethodCallCodes,$ViewCodes,$SaveCodes,ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT);
        return $FieldCode;
    }
    protected function _getNumericFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass){
        $GFC=$this->_getGeneralFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
        $InitialDataLoadFieldFillCodes=$GFC->getInitialDataLoadFieldFillCodes();
        $DataStateVariableCodes=$GFC->getDataStateVariableCodes();
        $StateVariableCodes=$GFC->getStateVariableCodes();
        $ConstructorCodes=$GFC->getConstructorCodes();
        $ImportCodes=$GFC->getImportCodes();
        $ClassFieldDefinitionCodes=$GFC->getClassFieldDefinitionCodes();
        $LoaderMethodCodes=$GFC->getLoaderMethodCodes();
        $LoaderMethodCallCodes=$GFC->getLoaderMethodCallCodes();
        $ViewCodes="
                            <TextBox keyboardType='numeric' title={'$TranslatedFieldName'} value={this.state.formData.$PureFieldName} onChangeText={(text) => {this.setState({formData:{...this.state.formData,".$PureFieldName.": text}});}}/>";
        $SaveCodes=$GFC->getSaveCodes();

        $FieldCode=new ReactFieldCode($ImportCodes,$ClassFieldDefinitionCodes,$ConstructorCodes,$StateVariableCodes,$DataStateVariableCodes,$InitialDataLoadFieldFillCodes,$LoaderMethodCodes,$LoaderMethodCallCodes,$ViewCodes,$SaveCodes,ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT);
        return $FieldCode;
    }
    protected function _getEmptyCodedFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass){
        $GFC=$this->_getGeneralFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
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
    protected function _getAutoFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass){
        return $this->_getEmptyCodedFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
    }

    /**
     * @param string $ModuleName
     * @param string $FormName
     * @param string $FieldName
     * @param string $PureFieldName
     * @param string $TranslatedFieldName
     * @return ReactFieldCode
     */
    protected function _getFieldManageCodes($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName,$LoadedDataSubClass)
    {

        if(FieldType::fieldIsAutoGenerated($FieldName))
            return $this->_getAutoFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
        if(FieldType::fieldIsLongitude($FieldName))
            return $this->_getEmptyCodedFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
        if(FieldType::fieldIsLatitude($FieldName))
            return $this->_getLocationFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
        if(FieldType::getFieldType($FieldName)==FieldType::$CLOCK)
            return $this->_getClockFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
        if (FieldType::getFieldType($FieldName) == FieldType::$BOOLEAN)
            return $this->_getBooleanFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
        if (FieldType::getFieldType($FieldName) == FieldType::$FID) {

            if (FieldType::fieldIsCityAreaFid($FieldName))
                return $this->_getCityAreaFieldManageCode($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
            return $this->_getForeignIDFieldManageCode($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
        }
        if (FieldType::fieldIsImageUpload($FieldName))
            return $this->_getImageUploadFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
        if(FieldType::fieldIsNumber($FieldName))
            return $this->_getNumericFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);

        return $this->_getGeneralFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
    }
    private function _codeGeneratorTemplate($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass){
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
    protected function _getClockFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass){
        $GFC=$this->_getGeneralFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
        $InitialDataLoadFieldFillCodes=$GFC->getInitialDataLoadFieldFillCodes();
        $StateVariableCodes=$GFC->getStateVariableCodes();
        $ConstructorCodes="";
        $ImportCodes="";
        $ClassFieldDefinitionCodes="";
        $LoaderMethodCodes="";
        $LoaderMethodCallCodes="";
        $ViewCodes="
                            <TimeSelector title={'$TranslatedFieldName'} value={this.state.formData.$PureFieldName} onConfirm={(date)=>this.setState({formData:{...this.state.formData,".$PureFieldName.": date}})} />";
        $SaveCodes=$GFC->getSaveCodes();
        $FieldCode=new ReactFieldCode($ImportCodes,$ClassFieldDefinitionCodes,$ConstructorCodes,"",$StateVariableCodes,$InitialDataLoadFieldFillCodes,$LoaderMethodCodes,$LoaderMethodCallCodes,$ViewCodes,$SaveCodes,ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT);
        return $FieldCode;
    }
    protected function makeReactNativeItemManageDesign($formInfo)
    {
        $this->makeReactNativeManagementController($formInfo);
        $this->makeReactNativeManagementStyle($formInfo);
        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FormNames = $FormName . "s";
        $UFormNames = ucfirst($FormNames);
        $UFormName = ucfirst($FormName);
        $ModuleNames = $ModuleName . "s";
        $FileName = $ModuleName . "_$FormName" . "Manage";
        $StyleFileName = $FileName . "Styles";
        $ControllerFileName = $FileName . "Controller";
        $Translations = new Translator();
        $PageTitle = "اطلاعات " . $Translations->getPersian($FormName, $FormName);
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
            $FC=$this->_getFieldManageCodes($ModuleName,$FormName,$Fields[$i],$PureFields[$i],$PersianFields[$i],"");
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

        $C = "import React from 'react'

import $StyleFileName from '../../values/styles/$FormName/$StyleFileName';
import $ControllerFileName from '../../controllers/$FormName/$ControllerFileName';
import { CheckBox } from 'react-native-elements';
import {StyleSheet, View, TextInput, ScrollView, Dimensions,Picker,Text,Image } from 'react-native';
import generalStyles from '../../../../styles/generalStyles';
import SweetFetcher from '../../../../classes/sweet-fetcher';
import Common from '../../../../classes/Common';
import AccessManager from '../../../../classes/AccessManager';
import Constants from '../../../../classes/Constants';
import PickerBox from '../../../../sweet/components/PickerBox';
import TextBox from '../../../../sweet/components/TextBox';
import TimeSelector from '../../../../sweet/components/TimeSelector';
import ImageSelector from '../../../../sweet/components/ImageSelector';

import SweetLocationSelector from '../../../../sweet/components/SweetLocationSelector';
import CityAreaSelectorModal from '../../../../sweet/components/CityAreaSelectorModal';
import SweetButton from '../../../../sweet/components/SweetButton';
import CheckedRow from '../../../../sweet/components/CheckedRow';
import ComponentHelper from '../../../../classes/ComponentHelper';
import SweetPage from '../../../../sweet/components/SweetPage';
import LogoTitle from '../../../../components/LogoTitle';
import SweetAlert from '../../../../classes/SweetAlert';
$ImportCodes
export default class  $FileName extends SweetPage {
    $ClassFieldDefinitionCodes
    constructor(props) {
        super(props);
        this.state =
        {
            isLoading:false,
            formData:{},
            $CodeStateVariableCodes
        };";
        $C .= "
        $ConstructorCodes
        this.loadData();
    }
    loadData=()=>{
        $LoaderMethodCallCodes
        if(global.".$FormName."ID!=null)
        {
            this.setState({isLoading:true},()=>{
                new $ControllerFileName().load(global.".$FormName."ID,(data)=>{
                    this.setState({isLoading:false,formData:data});
                });
            });
        }
    };
$LoaderMethodCodes
    render() {
        let Window = Dimensions.get('window');
            return (
                <View style={{flex:1}}  >
                  <View style={{height:this.getManagementPageHeight()}}>
                    <ScrollView contentContainerStyle={{minHeight: this.height || Window.height}}>
                        <View style={generalStyles.container}>
                        $ViewCodes";

        $C .= "
                            

                        </View>
                    </ScrollView>
                        </View>
                    <View style={generalStyles.actionButtonContainer}>
                                <SweetButton title='ذخیره' style={generalStyles.actionButton} onPress={(OnEnd) => {
                                    let formIsValid=true;
                                    if(formIsValid)
                                    {
                                        const data =Common.appendObject2FormData(this.state.formData,new FormData());
                                        new $ControllerFileName().save(global.".$FormName."ID,data,(data)=>{
                                                 SweetAlert.displaySimpleAlert('پیام','اطلاعات با موفقیت ذخیره شد.');
                                                 OnEnd(true);
                                        },(error)=>{OnEnd(false)}); 
        $SaveCodes";
        $C .= "
                                    }
                                    else
                                        OnEnd(false);
                                }}/>
                            </View>
                </View>
            )
    }
}
    ";
        $DesignFile = $this->getReactNativeCodeModuleDir() . "/modules/" . $ModuleName . "/pages/$FormName/" . $FileName . ".js";
        $this->SaveFile($DesignFile, $C);
    }
    protected function makeReactNativeManagementStyle($formInfo)
    {
        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FileName = $ModuleName . "_$FormName" . "Manage";
        $StyleFileName = $FileName . "Styles";

        $C = "import {Dimensions, StyleSheet} from 'react-native';
let Window = Dimensions.get('window');
export default StyleSheet.create(
    {
        test:
            {
                width: '100%',

            },
    }
);
    ";
        $DesignFile = $this->getReactNativeCodeModuleDir() . "/modules/" . $ModuleName . "/values/styles/$FormName/" . $StyleFileName . ".js";
        $this->SaveFile($DesignFile, $C);
    }
    protected function makeReactNativeManagementController($formInfo)
    {
        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FormNames = $FormName . "s";
        $FileName = $ModuleName . "_$FormName" . "Manage";
        $ControllerFileName = $FileName . "Controller";
        $AllFields = $this->getAllFormsOfFields();
        $Fields = $AllFields['fields'];
        $Translations = new Translator();
        $PageTitle = " " . $Translations->getPersian($FormName, $FormName);
        $PersianFields = $AllFields['persianfields'];
        $PureFields = $AllFields['purefields'];
        $IdField=$FormName."ID";
        $C = "import controller from '../../../../sweet/architecture/controller';
import SweetFetcher from '../../../../classes/sweet-fetcher';
import SweetHttpRequest from '../../../../classes/sweet-http-request';
import Constants from '../../../../classes/Constants';
import SweetConsole from '../../../../classes/SweetConsole';
import SweetAlert from '../../../../classes/SweetAlert';
import Common from '../../../../classes/Common';
import AccessManager from '../../../../classes/AccessManager';


export default class $ControllerFileName extends controller {
    load($IdField,onLoad)
    {
        if($IdField>0){
            this.setState({isLoading:true});
            new SweetFetcher().Fetch('/$ModuleName/$FormName/'+$IdField,SweetFetcher.METHOD_GET, null, data => {
                onLoad(data.Data);
            });
        }//if
    }
    save($IdField,data,onSave,onError)
    {
        let method=SweetFetcher.METHOD_POST;
        let recordIdentifier='';
        let action=AccessManager.INSERT;
        if($IdField!=null || $IdField.length>=1){
            method=SweetFetcher.METHOD_PUT;
            recordIdentifier='/'+requestID;
            action=AccessManager.EDIT;
            data.append('id', $IdField);
        }//if
        new SweetFetcher().Fetch('/$ModuleName/$FormName'+recordIdentifier, method, data, data => {
            if(data.hasOwnProperty('Data'))
                onSave(data.Data);
            else
                onError(null);
        },error=>{onError(error);},'$ModuleName','$FormName',null);
    }
}
    ";
        $DesignFile = $this->getReactNativeCodeModuleDir() . "/modules/" . $ModuleName . "/controllers/$FormName/" . $ControllerFileName . ".js";
        $this->SaveFile($DesignFile, $C);
    }
}


?>