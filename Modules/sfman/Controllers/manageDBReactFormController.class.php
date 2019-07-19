<?php

namespace Modules\sfman\Controllers;


/**
 * @author Hadi AmirNahavandi
 * @creationDate 1395/10/9 - 2016/12/29 19:36:38
 * @lastUpdate 1395/10/9 - 2016/12/29 19:36:38
 * @SweetFrameworkHelperVersion 1.112
 */
abstract class manageDBReactFormController extends manageDBLaravelAPIFormController
{


//    private $SiteURL='http://iflaravel.test';
    private $SiteURL = 'http://ifi.test';

    protected function makeReactListDesign($formInfo)
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
        $C.="
        };
    };
    searchParams={};
    toggleSearchWindow = () => {
        this.setState({
            displaySearchWindow: !this.state.displaySearchWindow
        });
    };
    componentDidMount() {
        this.LoadData(Constants.DefaultPageSize,1,null,null);
    }
    LoadData(pageSize,page,sorted,filtered)
    {
        let RecordStart=((page-1)*pageSize);
        let Request=new SweetHttpRequest();
        Request.appendVariables(filtered,'id','value');
        Request.appendVariablesWithPostFix(sorted,'id','desc','__sort');
        Request.appendVariable('__pagesize',pageSize);
        Request.appendVariable('__startrow',RecordStart);
        let filterAndSortString=Request.getParamsString();
        if(filterAndSortString!='') filterAndSortString='?'+filterAndSortString;
        let url='/$ModuleName/$FormName'+filterAndSortString;
        new SweetFetcher().Fetch(url, SweetFetcher.METHOD_GET, null, 
        data => {
            let Pages=Math.ceil(data.RecordCount/Constants.DefaultPageSize);
            for(let i=0;i<data.Data.length;i++)
                    data.Data[i]=Common.convertNullKeysToEmpty(data.Data[i]);
            this.setState({data: data.Data,pages:Pages})
        }, 
        null,'$ModuleName" . "." . "$FormName',AccessManager.LIST,
        this.props.history);
        ";
        for ($i = 0; $i < count($Fields); $i++) {
            if (FieldType::getFieldType($Fields[$i]) == FieldType::$FID) {
                $URL = '';

                $TableName=strtolower($this->getTableNameFromFIDFieldName($Fields[$i]));
                if ($Fields[$i] == 'common_city_fid') {
                    $URL = "'/placeman/provinces'";
                } else {
                    $URL = "'/$ModuleName/" . $TableName . "'";
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
        $C.="
    };
    searchData=()=>
    {
        this.toggleSearchWindow();
        if(this.searchParams!=null)
            this.LoadData(Constants.DefaultPageSize,1,null,Common.ObjectToIdValueArray(this.searchParams));
    };
    render(){
        return <div className={'pagecontent'}>
            <MDBContainer className={'searchcontainer'}>
                <MDBBtn onClick={this.toggleSearchWindow}>جستجو</MDBBtn>
                <MDBModal isOpen={this.state.displaySearchWindow} toggle={this.toggleSearchWindow}>
                    <MDBModalHeader toggle={this.toggleSearchWindow}>جستجو</MDBModalHeader>
                    <MDBModalBody>
                        ";
        for ($i = 0; $i < count($Fields); $i++) {
            $C .= $this->getReactFieldFillCode($Fields[$i], $PersianFields[$i], $PureFields[$i], true);
        }
        $C .= "
                    </MDBModalBody>
                    <MDBModalFooter>
                        <MDBBtn color='secondary' onClick={this.toggleSearchWindow}>بستن</MDBBtn>
                        <MDBBtn color='primary' onClick={this.searchData}>جستجو</MDBBtn>
                    </MDBModalFooter>
                </MDBModal>
            </MDBContainer>
            <div className={'topoperationsrow'}>{this.state.canInsert && <Link className={'addlink'}  to={'/$ModuleName/$FormNames/management'}><IoMdAddCircle/></Link>}</div>
        <SweetTable
            filterable={false}
            className='-striped -highlight'
            defaultPageSize={Constants.DefaultPageSize}
            data={this.state.data}
            pages={this.state.pages}
            columns={this.columns}
            excludedExportColumns={'id'}
            manual
            onFetchData={(state, instance) => {
                this.setState({loading: true,page:state.page});
                this.LoadData(state.pageSize,state.page+1,state.sorted,state.filtered);
            }}
        />
        </div>;
    }
";
        $C = $C . "
columns = [";
        for ($i = 0; $i < count($Fields); $i++) {
            $UCField = $Fields[$i];
            $PureField = $PureFields[$i];
            $UCField = trim(strtolower($UCField));
            $PureField = trim(strtolower($PureField));
            $PersianField = $trans->getPersian($UCField, $UCField);
            if (FieldType::getFieldType($Fields[$i]) == FieldType::$DATE) {
                $C = $C . "
{
    Header: '$PersianField',
    id: '$UCField',
    accessor:data=> data.$PureField
},";
            } elseif (FieldType::getFieldType($Fields[$i]) == FieldType::$FID) {
                $C = $C . "
{
    Header: '$PersianField',
    id: '$PureField',
    accessor: data=>data.$PureField" . "content,
},";
            }
            elseif (FieldType::getFieldType($Fields[$i]) == FieldType::$BOOLEAN) {
                $C = $C . "
{
    Header: '$PersianField',
    id: '$PureField',
    accessor: data=>data.$PureField==0?'خیر':'بله',
},";
            }
            elseif (!FieldType::fieldIsFileUpload($Fields[$i]) && !FieldType::fieldIsTextArea($Fields[$i])) {
                $C = $C . "
{
    Header: '$PersianField',
    accessor: '$PureField'
},";
            }
        }
        $C = $C . "
{
    Header: 'عملیات',
    accessor: 'id',
    Cell: props => <div className={'operationsrow'}>
                   {!this.state.canEdit &&
                    <Link className={'viewlink'}  to={'/$ModuleName/$FormNames/view/'+props.value}><IoMdEye/></Link>
                   }
                   {this.state.canEdit &&
                    <Link className={'editlink'}  to={'/$ModuleName/$FormNames/management/'+props.value}><FaEdit/></Link>
                   }
                   {this.state.canDelete &&
                       <MdDeleteForever onClick={ 
                       () =>{
                         SweetAlert.displayDeleteAlert(()=>{
                            new SweetFetcher().Fetch('/$ModuleName/$FormName/' + props.value, SweetFetcher.METHOD_DELETE, null,
                                data => {
                                    this.LoadData(Constants.DefaultPageSize,this.state.page+1,null,null);
                                },(error)=>{
                                            let status=error.response.status;
                                            SweetAlert.displaySimpleAlert('خطای پیش بینی نشده ','خطایی در حذف اطلاعات به وجود آمد'+status.toString().trim());
                                        },'$ModuleName" . "." . "$FormName',AccessManager.DELETE,this.props.history);
                         });
                        }
                        }/>
                 }
                </div>,
},";

        $C = $C . "];
        }
export default $FileName;
";

        $DesignFile = $this->getReactCodeModuleDir() . "/modules/" . $ModuleName . "/pages/$FormName/" . $FileName . ".js";
        $this->SaveFile($DesignFile, $C);
    }

    private function getFieldLoadCode($ModuleName,$PureFields,$Fields)
    {
        $C="";
        for ($i = 0; $i < count($Fields); $i++) {
            if (FieldType::getFieldType($Fields[$i]) == FieldType::$FID) {
                $URL = '';
                $TableName=strtolower($this->getTableNameFromFIDFieldName($Fields[$i]));
                if ($Fields[$i] == 'common_city_fid') {
                    $URL = "'/placeman/provinces'";
                } else {
                    $URL = "'/$ModuleName/" . $TableName . "'";
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
import moment from 'moment-jalaali'
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
            if(FieldType::getFieldType($Fields[$i]) == FieldType::$BOOLEAN)
                $C = $C . "\r\n\t\t\t$PureFields[$i]:0,";
            else
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
        for ($i = 0; $i < count($PureFields); $i++)
            $C = $C . "\r\n\t\t\t\t\t\t\t\t\tdata.append('$PureFields[$i]', this.state.$PureFields[$i]);";
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
import moment from 'moment-jalaali'
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
//            else {
//
//                $URL = '';
//                $TableName=strtolower($this->getTableNameFromFIDFieldName($Fields[$i]));
//                if ($Fields[$i] == 'common_city_fid') {
//                    $URL = "'/placeman/provinces'";
//                } else {
//                    $URL = "'/$ModuleName/" . $TableName . "'";
//                }
//                $URL = $URL . "+'/'+data.Data.$PureFields[$i]";
//                $FieldLoaders = $FieldLoaders . "\r\nnew SweetFetcher().Fetch($URL,SweetFetcher.METHOD_GET,null,
//                data=>{
//                this.setState({" . $PureFields[$i] . ":data.Data.name});
//            },
//            null,'$ModuleName" . "." . "$TableName',AccessManager.VIEW,
//            this.props.history);";
//            }
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

    protected function makeReactRoutes($formInfo)
    {
        $trans = new Translator();
        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FormNames = $FormName . "s";
        $UFormNames = ucfirst($FormNames);
        $UFormName = ucfirst($FormName);
        $ModuleNames = $ModuleName . "s";
        $FormNamePersian=$trans->getPersian($FormName,$FormName);
        $ListFileName = $ModuleName . "_$FormName" . "List";
        $EditFileName = $ModuleName . "_$FormName" . "Manage";
        $ViewFileName = $ModuleName . "_$FormName" . "View";;
        $C = "

            const $ListFileName = React.lazy(() => import('./modules/$ModuleName/pages/$FormName/$ListFileName'));
            routes.push({ path: '/$ModuleName/$FormNames',exact:true, name: 'لیست $FormNamePersian',component:$ListFileName});
            const $EditFileName = React.lazy(() => import('./modules/$ModuleName/pages/$FormName/$EditFileName'));
            const $ViewFileName = React.lazy(() => import('./modules/$ModuleName/pages/$FormName/$ViewFileName'));
            routes.push({ path: '/$ModuleName/$FormNames/management/:id',exact:false, name: 'ویرایش $FormNamePersian',component:$EditFileName});
            routes.push({ path: '/$ModuleName/$FormNames/management',exact:false, name: 'تعریف $FormNamePersian',component:$EditFileName});
            routes.push({ path: '/$ModuleName/$FormNames/view/:id',exact:false, name: '$FormNamePersian',component:$ViewFileName});
";
        $DesignFile = $this->getReactCodeModuleDir() . "/routes.js";

        $this->SaveFile($DesignFile, $C, true);
    }

    private function getReactFieldFillCode($FieldName, $PersianFieldName, $PureFieldName, $IsForSearchSake)
    {
        $ReturningCode = "";
        if ($IsForSearchSake) {
            if (FieldType::fieldIsFileUpload($FieldName))
                return "";
        }
        if (FieldType::getFieldType($FieldName) == FieldType::$FID) {
            $ReturningCode = $ReturningCode . "
                    <div className='form-group'>
                        <label htmlFor='$PureFieldName'>$PersianFieldName</label>
                        <select 
                                id='$PureFieldName'
                                className='browser-default custom-select'
                                ";
            if ($IsForSearchSake) {
                $ReturningCode .= "onChange={(event)=>{this.searchParams.$PureFieldName=event.target.value;}}>
                                <option value={''}>همه</option>";
            } else {
                $ReturningCode .= "value={this.state.$PureFieldName}
                                disabled={!this.state.canEdit}
                                onChange={(event)=>{this.setState({" . $PureFieldName . ":event.target.value})}}>
                                <option value={''}>انتخاب کنید</option>";
            }
            $ReturningCode .= "\r\n                                {this.state.$PureFieldName" . "Options}
                            </select>
                            </div>";

        } elseif (FieldType::getFieldType($FieldName) == FieldType::$BOOLEAN) {
            $TrueTitle = $PersianFieldName . ' دارد';
            $FalseTitle = $PersianFieldName . ' ندارد';
            if ($FieldName == 'ismale' || $FieldName == 'gender') {
                $FalseTitle = 'زن';
                $TrueTitle = 'مرد';
            } elseif ($FieldName == 'ismarried') {
                $FalseTitle = 'مجرد';
                $TrueTitle = 'متاهل';
            } elseif ($FieldName == 'isactive') {
                $FalseTitle = 'غیر فعال';
                $TrueTitle = 'فعال';
            } elseif ($FieldName == 'readonly') {
                $FalseTitle = 'قابل تغییر';
                $TrueTitle = 'غیر قابل تغییر';
            }
            $ReturningCode = $ReturningCode . "
                         <div className='form-group'>
                            <FormInline>
                            
                           <label>$PersianFieldName</label>
                                    <Input
                                        onClick={() => this.setState({" . $PureFieldName . " : 0})}
                                        checked={this.state.$PureFieldName == 0}
                                        label='$FalseTitle'
                                        type='radio'
                                        id='radio$FieldName" . "1'
                                readOnly={!this.state.canEdit}
                                    />
                                    <Input
                                        onClick={() => this.setState({" . $PureFieldName . " : 1})}
                                        checked={this.state.$PureFieldName == 1}
                                        label='$TrueTitle'
                                        type='radio'
                                        id='radio$FieldName" . "2'
                                readOnly={!this.state.canEdit}
                                    />
                                </FormInline>
                        </div>";
        } elseif (FieldType::fieldIsFileUpload($FieldName)) {
            $ReturningCode = $ReturningCode . "<div className='form-group'>
                            <label htmlFor='$PureFieldName'>$PersianFieldName</label>
                            <input
                            className='form-control file'
                            readOnly={!this.state.canEdit}
                            id='$PureFieldName'
                            group
                            type='file'
                            onChange={(event)=>{
                                let file=event.target.files[0];
                                let reader = new FileReader();
                                let url = reader.readAsDataURL(file);
                                reader.onloadend = function (e) {
                                    this.setState({
                                        $PureFieldName" . "Preview: [reader.result]
                                });
                                }.bind(this);
                                this.setState({ $PureFieldName : file})
                            }}
                        />
                        {this.state.$PureFieldName!='' &&
                        <ModalImage
                            small={this.state.$PureFieldName" . "Preview}
                            large={this.state.$PureFieldName" . "Preview}
                            className={'imageuploadpreview'} />
                        }
                        </div>
                            ";
        }
        elseif (FieldType::fieldIsTextArea($FieldName) && !$IsForSearchSake) {
            $ReturningCode = $ReturningCode . "<div className='form-group'>
                            <label htmlFor='$PureFieldName'>$PersianFieldName</label>
                            <CKEditor
                                className='form-control'
                                id='content'
                                readOnly={!this.state.canEdit}
                                group
                                editor={ ClassicEditor }
                                config={ this.editorConfiguration }
                                data={this.state.$PureFieldName}
                                onChange={ ( event, editor ) => {
                                    this.setState({". $PureFieldName .":editor.getData()});
                                } }
                            />
                            </div>";
        }
        else {
            $InputStart = "<input
                                className='form-control'";
            if (!$IsForSearchSake) {
                if (FieldType::getFieldType($FieldName) == FieldType::$DATE) {
                    $InputStart = "                            <InputMask
                                mask='9999/99/99'
                                className='form-control ltr_field'";
                } elseif ($FieldName == "nationalcode" || $FieldName == "mellicode" || $FieldName == "hesabno" || $FieldName == "hmeli") {

                    $InputStart = "<InputMask
                                mask='9999999999'
                                className='form-control ltr_field'";
                } elseif ($FieldName == "personelno") {

                    $InputStart = "<InputMask
                                mask='9999999999'
                                className='form-control ltr_field'";
                }
            }

            $ReturningCode = $ReturningCode . "
                        <div className='form-group'>
                            <label htmlFor='$PureFieldName'>$PersianFieldName</label>
                            $InputStart
                                id='$PureFieldName'
                                type='text'";
                if ($IsForSearchSake) {
                $ReturningCode .= "
                                onChange={(event)=>{this.searchParams.$PureFieldName=event.target.value;}}";
                }
                else
                {
                    $ReturningCode.="
                                readOnly={!this.state.canEdit}
                                group
                                validate
                                value={this.state.$PureFieldName}
                                onChange={(event)=>{this.setState({" . $PureFieldName . ":event.target.value})}}";
                }
            $ReturningCode.="/>
                        </div>";
        }
        return $ReturningCode;


    }
}

?>