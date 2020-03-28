<?php

namespace Modules\sfman\Controllers;


/**
 * @author Hadi AmirNahavandi
 * @creationDate 1395/10/9 - 2016/12/29 19:36:38
 * @lastUpdate 1395/10/9 - 2016/12/29 19:36:38
 * @SweetFrameworkHelperVersion 1.112
 */
abstract class manageDBReactViewFormController extends manageDBReactListFormController
{

    protected function makeReactItemViewDesign($formInfo)
    {
        $trans = new Translator();
        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FormNames = $FormName . "s";
        $FileName = $ModuleName . "_$FormName" . "View";
        $PageTitle = " " . $FormName;
        $AllFields = $this->getAllFormsOfFields();
        $Fields = $AllFields['fields'];
        $PersianFields = $AllFields['persianfields'];
        $PureFields = $AllFields['purefields'];
        $C = "// @flow
import * as React from 'react';
import { MDBContainer, MDBRow, MDBCol, MDBInput, MDBBtn,FormInline, Input } from 'mdbreact';
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

class $FileName extends SweetComponent {
    constructor(props) {
        super(props);
        this.state = {
                canEdit:AccessManager.UserCan('$ModuleName','$FormName',AccessManager.EDIT),
            ";
        for ($i = 0; $i < count($Fields); $i++) {
            $C = $C . "\r\n\t\t\t$PureFields[$i]:'',";
            if (FieldType::getFieldType($Fields[$i]) == FieldType::$FID)
                $C = $C . "\r\n\t\t\t$PureFields[$i]Options:[],";
            if (FieldType::fieldIsFileUpload($Fields[$i]))
                $C = $C . "\r\n\t\t\t$PureFields[$i]Preview:'',";
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
        $FieldLoaders = "";
        for ($i = 0; $i < count($PureFields); $i++) {
            $FieldType = FieldType::getFieldType($Fields[$i]);
            if (FieldType::fieldTypesIsFileUpload($FieldType))
                $C = $C . "\r\n$PureFields[$i]Preview:Constants.SiteURL+'/'+data.Data." . $PureFields[$i] . ",";
            elseif ($FieldType != FieldType::$FID)
                $C = $C . "\r\n$PureFields[$i]:data.Data." . $PureFields[$i] . ",";
            else
            {
                $C = $C . "\r\n$PureFields[$i]:data.Data." . $PureFields[$i] . "info.name,";
            }
        }
        $C .= "});
        $FieldLoaders
            }, 
            null,'$ModuleName" . "." . "$FormName',AccessManager.VIEW,
            this.props.history);
        }//IF";

        $C .= "
        
    }
    render(){
        return <MDBContainer>
            <MDBRow>
                <MDBCol md='6'>
                    <form>
                        <p className='h5 text-center mb-4'>$PageTitle</p>
                        ";
        for ($i = 0; $i < count($Fields); $i++) {
            if (FieldType::getFieldType($Fields[$i]) == FieldType::$BOOLEAN) {
                $TrueTitle = $PersianFields[$i] . ' دارد';
                $FalseTitle = $PersianFields[$i] . ' ندارد';
                if ($Fields[$i] == 'ismale' || $Fields[$i] == 'gender') {
                    $FalseTitle = 'زن';
                    $TrueTitle = 'مرد';
                } elseif ($Fields[$i] == 'ismarried') {
                    $FalseTitle = 'مجرد';
                    $TrueTitle = 'متاهل';
                } elseif ($Fields[$i] == 'isactive') {
                    $FalseTitle = 'غیر فعال';
                    $TrueTitle = 'فعال';
                } elseif ($Fields[$i] == 'readonly') {
                    $FalseTitle = 'قابل تغییر';
                    $TrueTitle = 'غیر قابل تغییر';
                }
                $C = $C . "
                         <div className='form-group'>
                            <FormInline>
                            
                           <label>$PersianFields[$i]</label>
                                    <Input
                                        onClick={() => this.setState({" . $PureFields[$i] . " : 0})}
                                        checked={this.state.$PureFields[$i] == 0}
                                        label='$FalseTitle'
                                        type='radio'
                                        id='radio$Fields[$i]1'
                                readOnly={!this.state.canEdit}
                                    />
                                    <Input
                                        onClick={() => this.setState({" . $PureFields[$i] . " : 1})}
                                        checked={this.state.$PureFields[$i] == 1}
                                        label='$TrueTitle'
                                        type='radio'
                                        id='radio$Fields[$i]2'
                                readOnly={!this.state.canEdit}
                                    />
                                </FormInline>
                        </div>";
            } elseif (FieldType::fieldIsFileUpload($Fields[$i])) {
                $C = $C . "<div className='form-group'>
                            <label htmlFor='$PureFields[$i]'>$PersianFields[$i]</label>
                            
                        <ModalImage
                            small={this.state.$PureFields[$i]Preview}
                            large={this.state.$PureFields[$i]Preview}
                            className={'imageuploadpreview'} />
                        </div>
                            ";
            }elseif (FieldType::fieldIsTextArea($Fields[$i])) {
                $C = $C . "
                        <div className='form-group'>
                            <label>$PersianFields[$i]</label>
                            <div dangerouslySetInnerHTML={{__html: this.state.$PureFields[$i]}} />
                        </div>";
            } else {
                $C = $C . "
                        <div className='form-group'>
                            <label>$PersianFields[$i]</label>
                            <label
                                className='valuelabel'>
                                {this.state.$PureFields[$i]}
                            </label>
                        </div>";
            }


        }
        $C = $C . "    
                            <div className='text-center'>
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