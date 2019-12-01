<?php

namespace Modules\sfman\Controllers;


/**
 * @author Hadi AmirNahavandi
 * @creationDate 1395/10/9 - 2016/12/29 19:36:38
 * @lastUpdate 1395/10/9 - 2016/12/29 19:36:38
 * @SweetFrameworkHelperVersion 1.112
 */
abstract class manageDBReactNativeViewFormController extends manageDBReactNativeManageFormController
{

    private function _getCityAreaFieldViewCode($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass)
    {

        $StateVariableCodes = "
                    provinceinfo:{},
                    cityinfo:{},
                    $PureFieldName" . "info:{},";
        $ConstructorCodes = "";
        $ImportCodes = "";
        $ClassFieldDefinitionCodes = "";
        $LoaderMethodCodes = "";
        $LoaderMethodCallCodes = "";

        $ViewCodes = "
                            <TextRow title={'محل'} content={this.state.LoadedData.$LoadedDataSubClass" . "provinceinfo.title+' - '+this.state.LoadedData.$LoadedDataSubClass" . "cityinfo.title+' - '+this.state.LoadedData.$LoadedDataSubClass" . "$PureFieldName" . "info.title} />";
        $SaveCodes = "";
        $FieldCode = new ReactFieldCode($ImportCodes, $ClassFieldDefinitionCodes, $ConstructorCodes,"", $StateVariableCodes,"", $LoaderMethodCodes, $LoaderMethodCallCodes, $ViewCodes, $SaveCodes, ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT);
        return $FieldCode;
    }

    private function _getForeignIDFieldViewCode($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass)
    {
        $GFC = $this->_getGeneralFieldViewCodes($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass);

        $StateVariableCodes = "
                    $PureFieldName" . "info:{},";
        $ConstructorCodes = "";
        $ImportCodes = "";
        $ClassFieldDefinitionCodes = "";
        $LoaderMethodCodes = "";
        $LoaderMethodCallCodes = "";
        $ViewCodes = "";
        $SaveCodes = "";
        $FiledModule = strtolower($this->getModuleNameFromFIDFieldName($FieldName, $ModuleName));
        $TableName = strtolower($this->getTableNameFromFIDFieldName($FieldName));
        if ($FiledModule != "") {
            $ViewCodes = "
                            <TextRow title={'$TranslatedFieldName'} content={this.state.LoadedData.$LoadedDataSubClass" . "$PureFieldName" . "info.name} />";
            $SaveCodes = "";
        }
        $FieldCode = new ReactFieldCode($ImportCodes, $ClassFieldDefinitionCodes, $ConstructorCodes,"", $StateVariableCodes,"", $LoaderMethodCodes, $LoaderMethodCallCodes, $ViewCodes, $SaveCodes, ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT);
        return $FieldCode;
    }

    private function _getPlaceFidViewCode($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass)
    {
        $FFC = $this->_getForeignIDFieldViewCode($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass);

        $ConstructorCodes = $FFC->getConstructorCodes();
        $ImportCodes = $FFC->getImportCodes();
        $ClassFieldDefinitionCodes = $FFC->getClassFieldDefinitionCodes();
        $LoaderMethodCodes = $FFC->getLoaderMethodCodes();
        $LoaderMethodCallCodes = $FFC->getLoaderMethodCallCodes();
        $SaveCodes = $FFC->getSaveCodes();

        /*********************************************************/
        $Fields = $this->getTableFields("placeman_place");
        $AllFields = $this->getAllFormsOfFields($Fields);
        $Fields = $AllFields['fields'];
        $PersianFields = $AllFields['persianfields'];
        $PureFields = $AllFields['purefields'];
        $ViewCodes = "";
        $EndViewCodes = "";
        $StateVars="";
        for ($i = 0; $i < count($Fields); $i++) {
            $FC = $this->_getFieldViewCodes($ModuleName, $FormName, $Fields[$i], $PureFields[$i], $PersianFields[$i], $PureFieldName."info.");
            if ($FC->getAddPolicy() == ReactFieldCode::$ADD_POLICY_TO_TOP)
                $ViewCodes = $FC->getViewCodes() . $ViewCodes;
            elseif ($FC->getAddPolicy() == ReactFieldCode::$ADD_POLICY_TO_BOTTOM)
                $EndViewCodes .= $FC->getViewCodes();
            else
                $ViewCodes .= $FC->getViewCodes();
            $StateVars.=$FC->getDataStateVariableCodes();
        }
        $ViewCodes .= $EndViewCodes;
        /*********************************************************/
        $StateVariableCodes = "
                    $PureFieldName" . "info:{".$StateVars."},";
        $FieldCode = new ReactFieldCode($ImportCodes, $ClassFieldDefinitionCodes, $ConstructorCodes,"", $StateVariableCodes,"", $LoaderMethodCodes, $LoaderMethodCallCodes, $ViewCodes, $SaveCodes, ReactFieldCode::$ADD_POLICY_TO_BOTTOM);
        return $FieldCode;
    }

    private function _getImageUploadViewCodes($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass)
    {
        $StateVariableCodes = "";
        $ConstructorCodes = "";
        $ImportCodes = "";
        $ClassFieldDefinitionCodes = "";
        $LoaderMethodCodes = "";
        $LoaderMethodCallCodes = "";
        $ViewCodes = "
                          <Image style={generalStyles.topimage} source={{uri: Constants.ServerURL+'/'+this.state.LoadedData.$LoadedDataSubClass" . "$PureFieldName}}/>
";
        $SaveCodes = "";
        $FieldCode = new ReactFieldCode($ImportCodes, $ClassFieldDefinitionCodes, $ConstructorCodes,"", $StateVariableCodes,"", $LoaderMethodCodes, $LoaderMethodCallCodes, $ViewCodes, $SaveCodes, ReactFieldCode::$ADD_POLICY_TO_TOP);
        return $FieldCode;
    }

    private function _getBooleanFieldViewCodes($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass)
    {
        $GFC = $this->_getGeneralFieldViewCodes($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass);

        $StateVariableCodes = "";
        $ConstructorCodes = "";
        $ImportCodes = "";
        $ClassFieldDefinitionCodes = "";
        $LoaderMethodCodes = "";
        $LoaderMethodCallCodes = "";
        $ViewCodes = "
                            {this.state.LoadedData.$LoadedDataSubClass" . "$PureFieldName==1 && <TextRow title={''} content={'$TranslatedFieldName'} />}";
        $SaveCodes = $GFC->getSaveCodes();
        $FieldCode = new ReactFieldCode($ImportCodes, $ClassFieldDefinitionCodes, $ConstructorCodes,"", $StateVariableCodes,"", $LoaderMethodCodes, $LoaderMethodCallCodes, $ViewCodes, $SaveCodes, ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT);
        return $FieldCode;
    }

    private function _getLocationFieldViewCodes($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass)
    {
        $StateVariableCodes = "
                    latitude:0.0,
                    longitude:0.0,";
        $ConstructorCodes = "";
        $ImportCodes = "";
        $ClassFieldDefinitionCodes = "";
        $LoaderMethodCodes = "";
        $LoaderMethodCallCodes = "";
        $ViewCodes = "
                            <View style={generalStyles.mapContainer}>
                                <SimpleMap style={generalStyles.map} latitude={parseFloat(this.state.LoadedData.".$LoadedDataSubClass."latitude)+0} longitude={parseFloat(this.state.LoadedData.".$LoadedDataSubClass."longitude)+0} />
                            </View>";
        $SaveCodes = "";
        $FieldCode = new ReactFieldCode($ImportCodes, $ClassFieldDefinitionCodes, $ConstructorCodes,"", $StateVariableCodes,"", $LoaderMethodCodes, $LoaderMethodCallCodes, $ViewCodes, $SaveCodes, ReactFieldCode::$ADD_POLICY_TO_BOTTOM);
        return $FieldCode;
    }

    private function _getGeneralFieldViewCodes($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass)
    {
        $StateVariableCodes = "
                $PureFieldName:'',";
        $ConstructorCodes = "";
        $ImportCodes = "";
        $ClassFieldDefinitionCodes = "";
        $LoaderMethodCodes = "";
        $LoaderMethodCallCodes = "";
        $ViewCodes = "
                            <TextRow title={'$TranslatedFieldName'} content={this.state.LoadedData.$LoadedDataSubClass" . "$PureFieldName} />";
        $SaveCodes = "";
        $FieldCode = new ReactFieldCode($ImportCodes, $ClassFieldDefinitionCodes, $ConstructorCodes,"", $StateVariableCodes,"", $LoaderMethodCodes, $LoaderMethodCallCodes, $ViewCodes, $SaveCodes, ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT);
        return $FieldCode;
    }

    private function _getEmptyCodedFieldViewCodes($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass)
    {
        $StateVariableCodes = "";
        $ConstructorCodes = "";
        $ImportCodes = "";
        $ClassFieldDefinitionCodes = "";
        $LoaderMethodCodes = "";
        $LoaderMethodCallCodes = "";
        $ViewCodes = "";;
        $SaveCodes = "";
        $FieldCode = new ReactFieldCode($ImportCodes, $ClassFieldDefinitionCodes, $ConstructorCodes,"", $StateVariableCodes,"", $LoaderMethodCodes, $LoaderMethodCallCodes, $ViewCodes, $SaveCodes, ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT);
        return $FieldCode;
    }

    private function _getAutoFieldViewCodes($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass)
    {
        return $this->_getEmptyCodedFieldViewCodes($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass);
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
    private function _getFieldViewCodes($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass)
    {

        if (FieldType::fieldIsAutoGenerated($FieldName))
            return $this->_getAutoFieldViewCodes($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass);
        if (FieldType::fieldIsLongitude($FieldName))
            return $this->_getEmptyCodedFieldViewCodes($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass);
        if (FieldType::fieldIsLatitude($FieldName))
            return $this->_getLocationFieldViewCodes($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass);
        if (FieldType::getFieldType($FieldName) == FieldType::$CLOCK)
            return $this->_getClockFieldViewCodes($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass);
        if (FieldType::getFieldType($FieldName) == FieldType::$BOOLEAN)
            return $this->_getBooleanFieldViewCodes($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass);
        if (FieldType::getFieldType($FieldName) == FieldType::$FID) {

            if (FieldType::fieldIsCityAreaFid($FieldName))
                return $this->_getCityAreaFieldViewCode($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass);
            if (FieldType::fieldIsPlaceFid($FieldName))
                return $this->_getPlaceFidViewCode($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass);
            return $this->_getForeignIDFieldViewCode($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass);
        }
        if (FieldType::fieldIsImageUpload($FieldName))
            return $this->_getImageUploadViewCodes($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass);
        return $this->_getGeneralFieldViewCodes($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass);
    }

    private function _codeGeneratorTemplate($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass)
    {

        $GFC = $this->_getGeneralFieldViewCodes($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass);
        $StateVariableCodes = "";
        $ConstructorCodes = "";
        $ImportCodes = "";
        $ClassFieldDefinitionCodes = "";
        $LoaderMethodCodes = "";
        $LoaderMethodCallCodes = "";
        $ViewCodes = "";
        $SaveCodes = "";
        $FieldCode = new ReactFieldCode($ImportCodes, $ClassFieldDefinitionCodes, $ConstructorCodes,"", $StateVariableCodes,"", $LoaderMethodCodes, $LoaderMethodCallCodes, $ViewCodes, $SaveCodes, ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT);
        return $FieldCode;
    }

    private function _getClockFieldViewCodes($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass)
    {
        $GFC = $this->_getGeneralFieldViewCodes($ModuleName, $FormName, $FieldName, $PureFieldName, $TranslatedFieldName, $LoadedDataSubClass);

        $StateVariableCodes = $GFC->getDataStateVariableCodes();
        $ConstructorCodes = "";
        $ImportCodes = "";
        $ClassFieldDefinitionCodes = "";
        $LoaderMethodCodes = "";
        $LoaderMethodCallCodes = "";
        $ViewCodes = $GFC->getViewCodes();
        $SaveCodes = $GFC->getSaveCodes();
        $FieldCode = new ReactFieldCode($ImportCodes, $ClassFieldDefinitionCodes, $ConstructorCodes,"", $StateVariableCodes,"", $LoaderMethodCodes, $LoaderMethodCallCodes, $ViewCodes, $SaveCodes, ReactFieldCode::$ADD_POLICY_TO_WITH_CURRENT);
        return $FieldCode;
    }

    protected function makeReactNativeItemViewDesign($formInfo)
    {
        $this->makeReactNativeViewStyle($formInfo);
        $this->makeReactNativeViewController($formInfo);
        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FormNames = $FormName . "s";
        $UFormNames = ucfirst($FormNames);
        $UFormName = ucfirst($FormName);
        $ModuleNames = $ModuleName . "s";
        $FileName = $ModuleName . "_$FormName" . "View";
        $ControllerFileName = $FileName . "Controller";
        $StyleFileName = $FileName . "Styles";
        $Translations = new Translator();
        $PageTitle = "اطلاعات " . $Translations->getPersian($FormName, $FormName);
        $AllFields = $this->getAllFormsOfFields();
        $Fields = $AllFields['fields'];
        $PersianFields = $AllFields['persianfields'];
        $PureFields = $AllFields['purefields'];
        $FieldCodes = [];
        $StateVariableCodes = "";
        $ConstructorCodes = "";
        $ImportCodes = "";
        $ClassFieldDefinitionCodes = "";
        $LoaderMethodCodes = "";
        $LoaderMethodCallCodes = "";
        $ViewCodes = "";
        $EndViewCodes = "";
        $SearchCodes="";
        for ($i = 0; $i < count($Fields); $i++) {
            $FC = $this->_getFieldViewCodes($ModuleName, $FormName, $Fields[$i], $PureFields[$i], $PersianFields[$i], "");
            $StateVariableCodes .= $FC->getDataStateVariableCodes();
            $ConstructorCodes .= $FC->getConstructorCodes();
            $ImportCodes .= $FC->getImportCodes();
            $ClassFieldDefinitionCodes .= $FC->getClassFieldDefinitionCodes();
            $LoaderMethodCodes .= $FC->getLoaderMethodCodes();
            $LoaderMethodCallCodes .= $FC->getLoaderMethodCallCodes();
            if ($FC->getAddPolicy() == ReactFieldCode::$ADD_POLICY_TO_TOP)
                $ViewCodes = $FC->getViewCodes() . $ViewCodes;
            elseif ($FC->getAddPolicy() == ReactFieldCode::$ADD_POLICY_TO_BOTTOM)
                $EndViewCodes .= $FC->getViewCodes();
            else
                $ViewCodes .= $FC->getViewCodes();
        }
        $ViewCodes .= $EndViewCodes;

        $C = "import React, {Component} from 'react';
import {StyleSheet,View,ScrollView,Dimensions,Text,Image} from 'react-native';
import generalStyles from '../../../../styles/generalStyles';
import Constants from '../../../../classes/Constants';
import Common from '../../../../classes/Common';
import TextRow from '../../../../sweet/components/TextRow';
import SweetButton from '../../../../sweet/components/SweetButton';
import SimpleMap from '../../../../components/SimpleMap';
import SweetAlert from '../../../../classes/SweetAlert';
import SweetPage from '../../../../sweet/components/SweetPage';
import PageContainer from '../../../../sweet/components/PageContainer';
import SweetTopCarousel from '../../../../sweet/components/SweetTopCarousel';
import ViewBox from '../../../../sweet/components/ViewBox';
import $ControllerFileName from '../../controllers/$FormName/$ControllerFileName';
import $StyleFileName from '../../values/styles/$FormName/$StyleFileName';
$ImportCodes
export default class $FileName extends SweetPage {
    $ClassFieldDefinitionCodes
    constructor(props) {
        super(props);
        $ConstructorCodes
    }
    componentDidMount(){
        super.componentDidMount();
        this.loadData();
    }
    
    loadData = () => {
        this.setState({isLoading: true},()=>{
            new $ControllerFileName().load(global.$FormName"."ID,(data)=>{
                this.setState({LoadedData: {...data}, isLoading: false});
            });
        });
    };
$LoaderMethodCallCodes
$LoaderMethodCodes
    render() {
        let Window = Dimensions.get('window');
        let content=<View style={{flex: 1}}>
                {this.state.LoadedData != null &&
                    <View>
                        <ScrollView contentContainerStyle={{minHeight: this.height || Window.height}}>
                            <View style={generalStyles.containerWithNoBG}>
                            <ViewBox title={'اطلاعات'}>
                                $ViewCodes
                            </ViewBox>
                            </View>
                        </ScrollView>
                     </View>
                }
                </View>
        return (<PageContainer isLoading={this.state.isLoading}>{content}</PageContainer>);
    }
}
    ";
        $DesignFile = $this->getReactNativeCodeModuleDir() . "/modules/" . $ModuleName . "/pages/$FormName/" . $FileName . ".js";
        $this->SaveFile($DesignFile, $C);
    }
    private function makeReactNativeViewStyle($formInfo)
    {
        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FileName = $ModuleName . "_$FormName" . "View";
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
    private function makeReactNativeViewController($formInfo)
    {
        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FileName = $ModuleName . "_$FormName" . "View";
        $ControllerFileName = $FileName . "Controller";
        $C = "import controller from '../../../../sweet/architecture/controller';
import SweetFetcher from '../../../../classes/sweet-fetcher';
import SweetHttpRequest from '../../../../classes/sweet-http-request';
import Constants from '../../../../classes/Constants';
import SweetConsole from '../../../../classes/SweetConsole';
import SweetAlert from '../../../../classes/SweetAlert';
import Common from '../../../../classes/Common';
import AccessManager from '../../../../classes/AccessManager';


export default class $ControllerFileName extends controller {
    load($FormName"."Id,onLoad)
    {
        new SweetFetcher().Fetch('/trapp/$FormName/' + $FormName"."Id, SweetFetcher.METHOD_GET, null, data => {
            onLoad(data.Data);
        });
    }
}
    ";
        $DesignFile = $this->getReactNativeCodeModuleDir() . "/modules/" . $ModuleName . "/controllers/$FormName/" . $ControllerFileName . ".js";
        $this->SaveFile($DesignFile, $C);
    }

}

?>