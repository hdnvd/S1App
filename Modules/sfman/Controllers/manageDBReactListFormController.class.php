<?php

namespace Modules\sfman\Controllers;


/**
 * @author Hadi AmirNahavandi
 * @creationDate 1395/10/9 - 2016/12/29 19:36:38
 * @lastUpdate 1395/10/9 - 2016/12/29 19:36:38
 * @SweetFrameworkHelperVersion 1.112
 */
abstract class manageDBReactListFormController extends manageDBReactFormController
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
import jMoment from 'moment-jalaali'
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
//            if (FieldType::getFieldType($Fields[$i]) == FieldType::$DATE) {
//                $C = $C . "
//{
//    Header: '$PersianField',
//    id: '$UCField',
//    accessor:data=> jMoment(Number(data.$PureField), 'X').format('jYYYY/jMM/jDD')
//},";
//            } elseif
            if(FieldType::getFieldType($Fields[$i]) == FieldType::$FID) {
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
}

?>