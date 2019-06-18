<?php

namespace Modules\sfman\Controllers;


/**
 * @author Hadi AmirNahavandi
 * @creationDate 1395/10/9 - 2016/12/29 19:36:38
 * @lastUpdate 1395/10/9 - 2016/12/29 19:36:38
 * @SweetFrameworkHelperVersion 1.112
 */
abstract class manageDBReactNativeFormController extends manageDBReactFormController
{
    protected function makeReactNativeRoutes($formInfo)
    {
        $trans = new Translator();
        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FormNames = $FormName . "s";
        $UFormNames = ucfirst($FormNames);
        $UFormName = ucfirst($FormName);
        $ModuleNames = $ModuleName . "s";
        $FileName = $ModuleName . "_$FormName" . "List";

        $AllFields = $this->getAllFormsOfFields();
        $Fields = $AllFields['fields'];
        $PersianFields = $AllFields['persianfields'];
        $PureFields = $AllFields['purefields'];
        $C = "// @flow
import * as React from 'react';
import { Link} from 'react-router-dom';
import { FaEdit } from 'react-icons/fa';
import { IoMdEye,IoMdAddCircle } from 'react-icons/io';
import { MdDeleteForever } from 'react-icons/md';
import SweetTable from '../../../../classes/sweet-table'
import moment from 'moment-jalaali'
import SweetFetcher from '../../../../classes/sweet-fetcher';
import SweetAlert from '../../../../classes/SweetAlert';
import Constants from '../../../../classes/Constants';
import AccessManager from '../../../../classes/AccessManager';
import { MDBContainer, MDBBtn, MDBModal, MDBModalBody, MDBModalHeader, MDBModalFooter,FormInline, Input } from 'mdbreact';
import Common from '../../../../classes/Common';
import SweetComponent from '../../../../classes/sweet-component';
import SweetHttpRequest from '../../../../classes/sweet-http-request';

class $FileName extends SweetComponent {
    constructor(props) {
        super(props);
        this.state = {
            data: [],
            pages:1,
            page:0,
            canEdit:AccessManager.UserCan('$ModuleName','$FormName',AccessManager.EDIT),
            canInsert:AccessManager.UserCan('$ModuleName','$FormName',AccessManager.INSERT),
            canDelete:AccessManager.UserCan('$ModuleName','$FormName',AccessManager.DELETE),
            displaySearchWindow:false,
            ";
        for ($i = 0; $i < count($Fields); $i++) {
            if (FieldType::getFieldType($Fields[$i]) == FieldType::$FID)
                $C = $C . "\r\n            $PureFields[$i]Options:[],";
        }
        $C .= "
        };
    };
    ";
        $DesignFile = $this->getReactCodeModuleDir() . "/modules/" . $ModuleName . "/pages/$FormName/" . $FileName . ".js";
        $this->SaveFile($DesignFile, $C);
    }


    protected function makeReactNativeListDesign($formInfo)
    {
        $trans = new Translator();
        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FormNames = $FormName . "s";
        $UFormNames = ucfirst($FormNames);
        $UFormName = ucfirst($FormName);
        $ModuleNames = $ModuleName . "s";
        $FileName = $ModuleName . "_$FormName" . "List";
        $AllFields = $this->getAllFormsOfFields();
        $Fields = $AllFields['fields'];
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
        $C = "import React, {Component} from 'react'
import { Button } from 'react-native-elements';
import {StyleSheet, View, Alert, Dimensions,AsyncStorage,Image,TouchableWithoutFeedback,Text,TextInput,FlatList } from 'react-native';
import generalStyles from '../../../../styles/generalStyles';
import SweetFetcher from '../../../../classes/sweet-fetcher';
import Common from '../../../../classes/Common';
import AccessManager from '../../../../classes/AccessManager';
import Constants from '../../../../classes/Constants';


export default class $FileName extends Component<{}> {
    state =
    {
        $FormNames:[],
        nextStartRow:0,
        SearchText:'',
        isLoading:false,
        isRefreshing:false,
    };
    async componentDidMount() {
        this._loadData('',true);
    }
    _loadData=(SearchText,isRefreshing)=>{
        let {nextStartRow,$FormNames}=this.state;
        if(isRefreshing)
        {
            $FormNames=[];
            nextStartRow=0;
        }
        this.setState({isRefreshing:isRefreshing,isLoading:true});
        new SweetFetcher().Fetch('/$ModuleName/$FormName?searchtext='+SearchText+'&__startrow='+nextStartRow+'&__pagesize='+Constants.DEFAULT_PAGESIZE,SweetFetcher.METHOD_GET, null, data => {
            this.setState({".$FormNames.":[...$FormNames,...data.Data],nextStartRow:nextStartRow+Constants.DEFAULT_PAGESIZE,isLoading:false,isRefreshing:false,SearchText:SearchText});
        });
    };
    render() {
        const {height: heightOfDeviceScreen} =  Dimensions.get('window');
            return (<View style={{flex: 1}}>
                <View style={generalStyles.searchbar}>
                    <TextInput placeholder='' underlineColorAndroid={'transparent'} style={generalStyles.searchbarinput}
                               onChangeText={(text) => {
                                   this._loadData(text,true);
                               }}/>
                </View>
                <View style={generalStyles.listcontainer}>
                    <FlatList
                        data={this.state.$FormNames}
                        showsVerticalScrollIndicator={false}
                        onEndReached={()=>this._loadData(this.state.SearchText,false)}
                        onRefresh={()=>this._loadData(this.state.SearchText,true)}
                        refreshing={this.state.isRefreshing}
                        keyExtractor={item => item.id}
                        onEndReachedThreshold={0.3}
                        renderItem={({item}) =>
                        <TouchableWithoutFeedback onPress={() => {
                                global.itemID=item.id;
                                this.props.navigation.navigate('$ModuleName" . "_" . $FormName . "Manage', { name: '$ModuleName" . "_" . $FormName . "Manage' });
                            }}>
                            <View style={generalStyles.ListItem}>
                            $FieldDisplayCodes
                            </View>
                            </TouchableWithoutFeedback>
                        }
                    />
                </View>
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