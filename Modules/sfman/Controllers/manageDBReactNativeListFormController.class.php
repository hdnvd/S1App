<?php

namespace Modules\sfman\Controllers;


/**
 * @author Hadi AmirNahavandi
 * @creationDate 1395/10/9 - 2016/12/29 19:36:38
 * @lastUpdate 1395/10/9 - 2016/12/29 19:36:38
 * @SweetFrameworkHelperVersion 1.112
 */
abstract class manageDBReactNativeListFormController extends manageDBReactNativeViewFormController
{

    protected function _getCityAreaFieldSearchCode($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass){
        $GFC=$this->_getGeneralFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
        $InitialDataLoadFieldFillCodes=$GFC->getInitialDataLoadFieldFillCodes();
        $StateVariableCodes="area:'' ,";
        $ConstructorCodes="";
        $ImportCodes="";
        $ClassFieldDefinitionCodes="";
        $LoaderMethodCodes="";
        $LoaderMethodCallCodes="";
        $ViewCodes="
                            <CityAreaSelector
                                onAreaSelected={(AreaID)=>this.setState({area: AreaID})}
                            />";
        $SaveCodes="
									data.append('$PureFieldName', this.state.area);";
        $FieldCode=new ReactFieldCode($ImportCodes,$ClassFieldDefinitionCodes,$ConstructorCodes,"",$StateVariableCodes,$InitialDataLoadFieldFillCodes,$LoaderMethodCodes,$LoaderMethodCallCodes,$ViewCodes,$SaveCodes,ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT);
        return $FieldCode;
    }
    protected function _getForeignIDFieldSearchCode($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass){

        $FieldCode=parent::_getForeignIDFieldManageCode($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
        $ViewCodes="";
        $StateVar="\r\n\t\t\t$PureFieldName" . ":'',";
        $FiledModule = strtolower($this->getModuleNameFromFIDFieldName($FieldName, $ModuleName));
        if ($FiledModule != "") {

            $ViewCodes="
                            <PickerBox
                                name={'$PureFieldName"."s'}
                                title={'$TranslatedFieldName'}
                                isOptional={true}
                                selectedValue ={this.state.SearchFields.$PureFieldName}
                                onValueChange={(value, index) => {
                                    this.setState({SearchFields:{...this.state.SearchFields,$PureFieldName" . ": value}});
                                }}
                                options={this.state.$PureFieldName"."Options}
                            />";
        }
        $FieldCode->setDataStateVariableCodes($StateVar);
        $FieldCode->setViewCodes($ViewCodes);
        return $FieldCode;
    }
    protected function _getBooleanFieldSearchCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass){
        return $this->_getEmptyCodedFieldSearchCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
    }

    protected function _getGeneralFieldSearchCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass){

        $FieldCode=parent::_getGeneralFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
        $FieldCode->setViewCodes("
                            <TextBox title={'$TranslatedFieldName'} value={this.state.SearchFields.$PureFieldName} onChangeText={(text) => {this.setState({SearchFields:{...this.state.SearchFields,".$PureFieldName.": text}});}}/>");

        return $FieldCode;
    }
    protected function _getNumericFieldSearchCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass){

        $FieldCode=parent::_getNumericFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
        $ViewCodes="
                            <TextBox keyboardType='numeric' title={'$TranslatedFieldName'} value={this.state.SearchFields.$PureFieldName} onChangeText={(text) => {this.setState({SearchFields:{...this.state.SearchFields,".$PureFieldName.": text}});}}/>";

        $FieldCode->setViewCodes($ViewCodes);

        return $FieldCode;
    }
    protected function _getClockFieldSearchCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass){

        $FieldCode=parent::_getClockFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
        return $FieldCode;
    }

    protected function _getEmptyCodedFieldSearchCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass){
        return parent::_getEmptyCodedFieldManageCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
    }
    /**
     * @param string $ModuleName
     * @param string $FormName
     * @param string $FieldName
     * @param string $PureFieldName
     * @param string $TranslatedFieldName
     * @param string $LoadedDataSubClass
     * @return ReactFieldCode
     */
    protected function _getFieldSearchCodes($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName,$LoadedDataSubClass)
    {
        if(FieldType::fieldIsAutoGenerated($FieldName))
            return $this->_getEmptyCodedFieldSearchCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
        if(FieldType::fieldIsLongitude($FieldName))
            return $this->_getEmptyCodedFieldSearchCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
        if(FieldType::fieldIsLatitude($FieldName))
            return $this->_getEmptyCodedFieldSearchCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
        if(FieldType::getFieldType($FieldName)==FieldType::$CLOCK)
            return $this->_getClockFieldSearchCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
        if (FieldType::getFieldType($FieldName) == FieldType::$BOOLEAN)
            return $this->_getBooleanFieldSearchCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
        if (FieldType::getFieldType($FieldName) == FieldType::$FID) {

            if (FieldType::fieldIsCityAreaFid($FieldName))
                return $this->_getCityAreaFieldSearchCode($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
            if (FieldType::fieldIsPlaceFid($FieldName))
                return $this->_getEmptyCodedFieldSearchCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
            return $this->_getForeignIDFieldSearchCode($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
        }
        if (FieldType::fieldIsImageUpload($FieldName))
            return $this->_getEmptyCodedFieldSearchCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
        if(FieldType::fieldIsNumber($FieldName))
            return $this->_getNumericFieldSearchCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);

        return $this->_getGeneralFieldSearchCodes($ModuleName,$FormName,$FieldName,$PureFieldName,$TranslatedFieldName,$LoadedDataSubClass);
    }

    protected function makeReactNativeListDesign($formInfo)
    {
        $this->makeReactNativeSearchDesign($formInfo);
        $this->makeReactNativeListController($formInfo);
        $this->makeReactNativeListStyle($formInfo);
        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FormNames = $FormName . "s";
        $FileName = $ModuleName . "_$FormName" . "List";
        $SearchFileName = ucfirst($ModuleName) . "_$FormName" . "Search";
        $StyleFileName = $FileName . "Styles";
        $ControllerFileName = $FileName . "Controller";
        $AllFields = $this->getAllFormsOfFields();
        $Fields = $AllFields['fields'];
        $Translations = new Translator();
        $PageTitle = " " . $Translations->getPersian($FormName, $FormName);
        $PersianFields = $AllFields['persianfields'];
        $PureFields = $AllFields['purefields'];
        $FieldDisplayCodes = "";
        for ($i = 0; $i < count($Fields); $i++) {
            if (FieldType::getFieldType($Fields[$i]) == FieldType::$FID) {
                $FieldDisplayCodes .= "
                <Text style={generalStyles.simplelabel}>{item.$PureFields[$i]" . "content}</Text>";
            } elseif (FieldType::fieldIsImageUpload($Fields[$i])) {

                $FieldDisplayCodes .= "
                <Image style={generalStyles.listitemthumbnail} source={{uri: Constants.ServerURL+'/'+item.$PureFields[$i]}}/>
";
            } else {
                $FieldDisplayCodes .= "
                <Text style={generalStyles.simplelabel}>{item.$PureFields[$i]}</Text>";
            }
        }
        $C = "import React from 'react'
import { Button } from 'react-native-elements';
import {StyleSheet, View, Dimensions,Image,TouchableWithoutFeedback,Text,Picker,TextInput,ScrollView,FlatList} from 'react-native';
import generalStyles from '../../../../styles/generalStyles';
import SweetFetcher from '../../../../classes/sweet-fetcher';
import SweetHttpRequest from '../../../../classes/sweet-http-request';
import SweetListPage from '../../../../sweet/components/SweetListPage';
import Common from '../../../../classes/Common';
import AccessManager from '../../../../classes/AccessManager';
import Constants from '../../../../classes/Constants';
import SweetNavigation from '../../../../classes/sweetNavigation';
import ListTopBar from '../../../../sweet/components/ListTopBar';
import PageContainer from '../../../../sweet/components/PageContainer';
import TextRow from '../../../../sweet/components/TextRow';
import PickerBox from '../../../../sweet/components/PickerBox';
import TextBox from '../../../../sweet/components/TextBox';
import TimeSelector from '../../../../sweet/components/TimeSelector';
import LocationSelector from '../../../../sweet/components/LocationSelector';
import CityAreaSelector from '../../../../sweet/components/CityAreaSelector';
import CheckedRow from '../../../../sweet/components/CheckedRow';
import $SearchFileName from './$SearchFileName';
import $StyleFileName from '../../values/styles/$FormName/$StyleFileName';
import $ControllerFileName from '../../controllers/$FormName/$ControllerFileName';
import LogoTitle from '../../../../components/LogoTitle';
import jMoment from 'moment-jalaali';
import moment from 'moment';


export default class $FileName extends SweetListPage {
    state =
    {
        ...super.state,
        $FormNames:[],
        searchFields:null,
        sortField: $ControllerFileName.SORTFIELD_ID,
    };
    async componentDidMount() {
        this._loadData(true, false);
    }
    _loadData=(isRefreshing, forceHideSearchPage)=>{
        let {nextStartRow,$FormNames}=this.state;
        if(isRefreshing)
        {
            $FormNames=[];
            nextStartRow=0;
        }
        this.setState({isRefreshing:isRefreshing,isLoading:true},()=>{
            new $ControllerFileName().loadData(this.state.searchText, this.state.searchFields, nextStartRow, this.state.sortField, (data) => {
            if (forceHideSearchPage) {
               this.removeBackHandler();
            }
                this.setState({
                    $FormNames: [...".$FormNames.", ...data],
                    nextStartRow: nextStartRow + Constants.DEFAULT_PAGESIZE,
                    isLoading: false,
                    isRefreshing: false,
                    displaySearchPage: forceHideSearchPage ? false : this.state.displaySearchPage,
                });
                
            });
            
        });
    };
    render() {
            const renderListItem=({item}) =>{
                        return <TouchableWithoutFeedback onPress={() => {
                                global.".$FormName."ID=item.id;
                                SweetNavigation.navigateToNormalPage(this.props.navigation,'$ModuleName" . "_" . $FormName . "Manage');
                            }}>
                            <View style={generalStyles.ListItem}>
                            $FieldDisplayCodes
                            </View>
                            </TouchableWithoutFeedback>
                        };//renderListItem
            const content=<View style={{flex: 1}}>
                    {this.state.displaySearchPage &&
                    <$SearchFileName dataLoader={searchFields=>{
                            this.setState({searchFields: searchFields}, () => {
                                this._loadData(true, true);
                            });
                        }}
                    />
                    }
                    {!this.state.displaySearchPage &&
                    <View style={generalStyles.listcontainer}>
                {this._getTopBar([{id:$ControllerFileName.SORTFIELD_ID,name: 'جدیدترین ها'}])}
                <PageContainer isLoading={this.state.isLoading}
                               isEmpty={this.state.$FormNames == null || this.state.$FormNames.length == 0}>
                               <View style={generalStyles.listcontainer}>
                    {this._getFlatList(this.state.$ControllerFileName,renderListItem)}
                </View>
                </PageContainer>

                    </View>
                }
                </View>";
        $C .= "
    }
}
    ";
        $DesignFile = $this->getReactNativeCodeModuleDir() . "/modules/" . $ModuleName . "/pages/$FormName/" . $FileName . ".js";
        $this->SaveFile($DesignFile, $C);
    }
    protected function makeReactNativeListStyle($formInfo)
    {
        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FileName = $ModuleName . "_$FormName" . "List";
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
    protected function makeReactNativeListController($formInfo)
    {
        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FormNames = $FormName . "s";
        $FileName = $ModuleName . "_$FormName" . "List";
        $ControllerFileName = $FileName . "Controller";
        $AllFields = $this->getAllFormsOfFields();
        $Fields = $AllFields['fields'];
        $Translations = new Translator();
        $PageTitle = " " . $Translations->getPersian($FormName, $FormName);
        $PersianFields = $AllFields['persianfields'];
        $PureFields = $AllFields['purefields'];

        $C = "import controller from '../../../../sweet/architecture/controller';
import SweetFetcher from '../../../../classes/sweet-fetcher';
import SweetHttpRequest from '../../../../classes/sweet-http-request';
import Constants from '../../../../classes/Constants';
import SweetConsole from '../../../../classes/SweetConsole';
import SweetAlert from '../../../../classes/SweetAlert';
import Common from '../../../../classes/Common';
import AccessManager from '../../../../classes/AccessManager';


export default class $ControllerFileName extends controller {
    static SORTFIELD_ID = 'id';
    loadData = (SearchText, SearchFields,nextStartRow,sortField,onLoad) => {
            let Request=new SweetHttpRequest();
            Request.appendVariablesFromObjectKeys(SearchFields,true);
            Request.appendVariable('__pagesize', Constants.DEFAULT_PAGESIZE);
            if (sortField === $ControllerFileName.SORTFIELD_ID)
                Request.appendVariable('id__sort', '1');
            Request.appendVariable('__startrow', nextStartRow);
            Request.appendVariable('searchtext', SearchText,true);
            let filterString = Request.getParamsString();
            if(filterString!='') filterString='?'+filterString;
            let url='/$ModuleName/$FormName'+filterString;
            new SweetFetcher().Fetch(url,SweetFetcher.METHOD_GET, null, data => {
                onLoad(data.Data);
            });
    };
}
    ";
        $DesignFile = $this->getReactNativeCodeModuleDir() . "/modules/" . $ModuleName . "/controllers/$FormName/" . $ControllerFileName . ".js";
        $this->SaveFile($DesignFile, $C);
    }
    protected function makeReactNativeSearchDesign($formInfo)
    {
        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FormNames = $FormName . "s";
        $FileName = ucfirst($ModuleName) . "_$FormName" . "Search";
        $AllFields = $this->getAllFormsOfFields();
        $Fields = $AllFields['fields'];
        $PersianFields = $AllFields['persianfields'];
        $PureFields = $AllFields['purefields'];

        $Translations = new Translator();
        $PageTitle = " " . $Translations->getPersian($FormName, $FormName);
        $DataStateVariableCodes="";
        $CodeStateVariableCodes="";
        $ConstructorCodes="";
        $ImportCodes="";
        $ClassFieldDefinitionCodes="";
        $LoaderMethodCodes="";
        $LoaderMethodCallCodes="";
        $SearchCodes="";
        $SaveCodes="";
        for ($i = 0; $i < count($Fields); $i++) {
            $FC=$this->_getFieldSearchCodes($ModuleName,$FormName,$Fields[$i],$PureFields[$i],$PersianFields[$i],"");
            $DataStateVariableCodes.=$FC->getDataStateVariableCodes();
            $CodeStateVariableCodes.=$FC->getStateVariableCodes();
            $ConstructorCodes.=$FC->getConstructorCodes();
            $ImportCodes.=$FC->getImportCodes();
            $ClassFieldDefinitionCodes.=$FC->getClassFieldDefinitionCodes();
            $LoaderMethodCodes.=$FC->getLoaderMethodCodes();
            $LoaderMethodCallCodes.=$FC->getLoaderMethodCallCodes();
            $SearchCodes.=$FC->getViewCodes();
            $SaveCodes.=$FC->getSaveCodes();
        }
        $C = "import React, {Component} from 'react'
import {StyleSheet, View, Alert, Dimensions,AsyncStorage,Image,TouchableWithoutFeedback,Text,Picker,TextInput,ScrollView,FlatList } from 'react-native';
import generalStyles from '../../../../styles/generalStyles';
import SweetFetcher from '../../../../classes/sweet-fetcher';
import Common from '../../../../classes/Common';
import AccessManager from '../../../../classes/AccessManager';
import Constants from '../../../../classes/Constants';
import PickerBox from '../../../../sweet/components/PickerBox';
import TextBox from '../../../../sweet/components/TextBox';
import TimeSelector from '../../../../sweet/components/TimeSelector';
import LocationSelector from '../../../../sweet/components/LocationSelector';
import CityAreaSelector from '../../../../sweet/components/CityAreaSelector';
import SweetButton from '../../../../sweet/components/SweetButton';
import CheckedRow from '../../../../sweet/components/CheckedRow';
import SweetHttpRequest from '../../../../classes/sweet-http-request';
import SweetPage from '../../../../sweet/components/SweetPage';
import LogoTitle from '../../../../components/LogoTitle';

export default class $FileName extends SweetPage {
    state =
    {
        SearchFields:{
            $DataStateVariableCodes
        },
        $CodeStateVariableCodes
    };
    async componentDidMount() {
        $LoaderMethodCallCodes
    }
    $LoaderMethodCodes
    render() {
        const {height: heightOfDeviceScreen} =  Dimensions.get('window');
            return (<View style={{flex: 1}}>
                        <ScrollView contentContainerStyle={{minHeight: this.height || heightOfDeviceScreen}}>
                            <View>
                                $SearchCodes
                                <SweetButton title={'جستجو'} onPress={(OnEnd) => {
                                    if(this.props.dataLoader!=null)
                                    {
                                        this.props.dataLoader(this.state.SearchFields);
                                        OnEnd(true);
                                    }
                                    else
                                        OnEnd(false);
                            }}/>
                            </View>
                        </ScrollView>
                </View>
            );";
        $C .= "
    }
}
    ";
        $DesignFile = $this->getReactNativeCodeModuleDir() . "/modules/" . $ModuleName . "/pages/$FormName/" . $FileName . ".js";
        $this->SaveFile($DesignFile, $C);
    }

}

?>