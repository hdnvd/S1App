<?php

namespace Modules\sfman\Controllers;


/**
 * @author Hadi AmirNahavandi
 * @creationDate 1395/10/9 - 2016/12/29 19:36:38
 * @lastUpdate 1395/10/9 - 2016/12/29 19:36:38
 * @SweetFrameworkHelperVersion 1.112
 */
abstract class manageDBReactManageFormController extends manageDBReactViewFormController
{
    private function getFieldLoadCode($ModuleName,$PureFields,$Fields)
    {
        $C="";
        for ($i = 0; $i < count($Fields); $i++) {
            if (FieldType::getFieldType($Fields[$i]) == FieldType::$FID) {
                if (!FieldType::fieldIsUserFid($Fields[$i])) {
                    $URL = '';
                    $TableName = strtolower($this->getTableNameFromFIDFieldName($Fields[$i]));
                    if (FieldType::fieldIsCityAreaFid($Fields[$i])) {
                        $URL = "'/placeman/provinces'";
                    } else {
                        if ($Fields[$i] == 'placeman_city_fid') {
                            $URL = "'/placeman/provinces'";
                        } else {
                            $URL = "'/$ModuleName/" . $TableName . "'";
                        }
                    }

                    $C = $C . "\r\nnew SweetFetcher().Fetch($URL,SweetFetcher.METHOD_GET,null,
                data=>{
                let Options=data.Data.map(item=><option value={item.id}>{item.name}</option>);
                this.setState({" . $PureFields[$i] . "Options:Options});
            }, 
            null,'$ModuleName" . "." . "$TableName',AccessManager.LIST,
            this.props.history);";
                }
            }
        }




        return $C;
    }

    protected function makeReactItemManageDesign($formInfo)
    {
        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FormNames = $FormName . "s";
        $UFormNames = ucfirst($FormNames);
        $UFormName = ucfirst($FormName);
        $ModuleNames = $ModuleName . "s";
        $FileName = $ModuleName . "_$FormName" . "Manage";
        $Translations=new Translator();
        $PageTitle = "تعریف " . $Translations->getPersian($FormName,$FormName);
        $AllFields = $this->getAllFormsOfFields();
        $Fields = $AllFields['fields'];
        $PersianFields = $AllFields['persianfields'];
        $PureFields = $AllFields['purefields'];
        $C = "// @flow
import * as React from 'react';
import { MDBContainer, MDBRow, MDBCol, MDBInput, MDBBtn,FormInline, Input } from 'mdbreact';
import  DatePicker  from '../../../../PersianDatePicker/components/DatePicker';
import '../../../../scss/datepicker.scss'
import jMoment from 'moment-jalaali'
import SweetFetcher from '../../../../classes/sweet-fetcher';
import InputMask from 'react-input-mask';
import Constants from '../../../../classes/Constants';
import AccessManager from '../../../../classes/AccessManager';
import Common from '../../../../classes/Common';
import SweetComponent from '../../../../classes/sweet-component';
import ModalImage from 'react-modal-image'
import SweetButton from '../../../../classes/sweet-button';
import SweetAlert from '../../../../classes/SweetAlert';

import CKEditor from '@ckeditor/ckeditor5-react';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
class $FileName extends SweetComponent {
    constructor(props) {
        super(props);
        this.state = {
                canEdit:AccessManager.UserCan('$ModuleName','$FormName',this.props.match.params.id>0?AccessManager.EDIT:AccessManager.INSERT),
            ";
        for ($i = 0; $i < count($Fields); $i++) {

            if(!FieldType::fieldIsUserFid($Fields[$i])){

                if(FieldType::getFieldType($Fields[$i]) == FieldType::$BOOLEAN)
                    $C = $C . "\r\n\t\t\t$PureFields[$i]:0,";
                else
                    $C = $C . "\r\n\t\t\t$PureFields[$i]:'',";
                if (FieldType::getFieldType($Fields[$i]) == FieldType::$FID)
                    $C = $C . "\r\n\t\t\t$PureFields[$i]Options:[],";
                if (FieldType::fieldIsFileUpload($Fields[$i]))
                    $C = $C . "\r\n\t\t\t$PureFields[$i]Preview:'',";
            }

        }

        $C .= "
        };
        if(this.props.match.params.id>0){
        new SweetFetcher().Fetch('/$ModuleName/$FormName/'+this.props.match.params.id, SweetFetcher.METHOD_GET,null, 
        data => {
            data.Data=Common.convertNullKeysToEmpty(data.Data);
            ";
        $C .= "
                 this.setState({ ";
        for ($i = 0; $i < count($PureFields); $i++) {
            if (FieldType::fieldIsFileUpload($Fields[$i]))
                $C = $C . "$PureFields[$i]Preview:Constants.SiteURL+'/'+data.Data." . $PureFields[$i] . ",";
                $C = $C . "$PureFields[$i]:data.Data." . $PureFields[$i] . ",";
        }

        $C .= "});
            }, 
            null,'$ModuleName" . "." . "$FormName',AccessManager.VIEW,
            this.props.history);
        }//IF
        ";
        $C.=$this->getFieldLoadCode($ModuleName,$PureFields,$Fields);
        $C .= "
    }
    editorConfiguration = {
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList'],
    };
    render(){
        return <MDBContainer>
            <MDBRow>
                <MDBCol md='6'>
                    <form>
                        <p className='h5 text-center mb-4'>$PageTitle</p>
                        ";
        for ($i = 0; $i < count($Fields); $i++) {
            $C .= $this->getReactFieldFillCode($Fields[$i], $PersianFields[$i], $PureFields[$i], false);
        }
        $C = $C . "    
                            <div className='text-center'>
                            {this.state.canEdit && 
                                <SweetButton value={'ذخیره'}
                                    onButtonPress={(afterFetchListener) => {
                                let id = '';
                                let method=SweetFetcher.METHOD_POST;
                                let Separator='';
                                let action=AccessManager.INSERT;
                                    if (this.props.match.params.id > 0)
                                        id = this.props.match.params.id;
                                    const data = new FormData();
                                    ";
        for ($i = 0; $i < count($PureFields); $i++) {
            if (!FieldType::fieldIsUserFid($Fields[$i])) {
                $C = $C . "\r\n\t\t\t\t\t\t\t\t\tdata.append('$PureFields[$i]', this.state.$PureFields[$i]);";
            }
        }

        $C .= "\r\n\t\t\t\t\t\t\t\tif(id!==''){";
        $C = $C . "\r\n\t\t\t\t\t\t\t\t\tmethod=SweetFetcher.METHOD_PUT;";
        $C = $C . "\r\n\t\t\t\t\t\t\t\t\tSeparator='/';";
        $C = $C . "\r\n\t\t\t\t\t\t\t\t\taction=AccessManager.EDIT;";
        $C = $C . "\r\n\t\t\t\t\t\t\t\t\t\tdata.append('id', id);";
        $C = $C . "\r\n\t\t\t\t\t\t\t\t}";
        $C .= "
                                    new SweetFetcher().Fetch('/$ModuleName/$FormName'+Separator+id,method,data, 
                                    res => {
                                                return this.props.history.push('/$ModuleName/$FormNames');
                                                //console.log(res);
                                        },(error)=>{
                                            let status=error.response.status;
                                            afterFetchListener();
                                            SweetAlert.displaySimpleAlert('خطای پیش بینی نشده','خطایی در ذخیره اطلاعات به وجود آمد'+status.toString().trim());

                                        },
                                        '$ModuleName" . "." . "$FormName',action,
                                        this.props.history);
                                    
                                }
                                }
                                />
                            }
                            <MDBBtn onClick={() =>
                             {
                                this.props.history.push('/$ModuleName/$FormNames');
                             }
                            }>برگشت</MDBBtn>
                        </div>
                    </form>
                </MDBCol>
            </MDBRow>
        </MDBContainer>
    }
}

export default $FileName;
";
        $DesignFile = $this->getReactCodeModuleDir() . "/modules/" . $ModuleName . "/pages/$FormName/" . $FileName . ".js";
        $this->SaveFile($DesignFile, $C);
    }

}

?>