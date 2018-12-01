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
        $C = "// @flow
import * as React from 'react';
import { Link} from 'react-router-dom';
import { FaEdit } from 'react-icons/fa';
import { IoMdEye,IoMdAddCircle } from 'react-icons/io';
import { MdDeleteForever } from 'react-icons/md';
import SweetTable from '../../../../classes/sweet-table'

class $FileName extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            data: [],
        };
    };
    componentDidMount() {
        this.LoadData();
    }
    LoadData()
    {
            fetch('" . $this->SiteURL . "/api/$ModuleName/$FormNames')
            .then(response => response.json())
            .then(data => {
                this.setState({ data:data })
            });
    };
    render(){
        return <div className={'pagecontent'}>
            <div className={'topoperationsrow'}><Link className={'addlink'}  to={'/$ModuleName/$FormNames/management'}><IoMdAddCircle/></Link></div>
        <SweetTable
            filterable={true}
            className='-striped -highlight'
            defaultPageSize={10}
            data={this.state.data}
            columns={this.columns}
        />
        </div>;
    }
";
        $C = $C . "
columns = [";
        for ($i = 0; $i < count($this->getCurrentTableFields()); $i++) {
            if (FieldType::getFieldType($this->getCurrentTableFields()[$i]) != FieldType::$METAINF && FieldType::getFieldType($this->getCurrentTableFields()[$i]) != FieldType::$LARAVELMETAINF && FieldType::getFieldType($this->getCurrentTableFields()[$i]) != FieldType::$ID) {
                $UCField = $this->getCurrentTableFields()[$i];
                $UCField = trim(strtolower($UCField));
                $PersianField = $trans->getPersian($UCField, $UCField);
                $C = $C . "
{
    Header: '$PersianField',
    accessor: '$UCField'
},";

            }
        }
        $C = $C . "
{
    Header: 'عملیات',
    accessor: 'id',
    Cell: props => <div className={'operationsrow'}>
                   <Link className={'viewlink'}  to={'/$ModuleName/$FormNames/'+props.value}><IoMdEye/></Link>
                   <Link className={'editlink'}  to={'/$ModuleName/$FormNames/management/'+props.value}><FaEdit/></Link>
                   <MdDeleteForever onClick={ () =>{
                    fetch('$this->SiteURL/api/$ModuleName/$FormNames/'+props.value, {
                        method: 'delete',
                        headers: {
                            Accept: 'application/json',
                        },
                        mode: 'cors',
                        crossDomain:true,
                    })
                        .then(res => res.json())
                        .then(res => {
                            if (res.hasOwnProperty('errors')) {
                                alert('خطا','خطایی در حذف اطلاعات بوجود آمد');
                            }
                            else {
                                this.LoadData();
                            }
                            // console.log(res);
                        }).catch(function (error) {
                        alert('خطا','خطایی در حذف اطلاعات بوجود آمد');
                        throw error;
                    });
                }}/>
                </div>,
},";

        $C = $C . "];
        }
export default $FileName;
";

        $DesignFile = $this->getReactCodeModuleDir() . "/modules/" . $ModuleName . "/pages/$FormName/" . $FileName . ".js";
        $this->SaveFile($DesignFile, $C);
    }

    protected function makeReactItemManageDesign($formInfo)
    {
        $trans = new Translator();
        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FormNames = $FormName . "s";
        $UFormNames = ucfirst($FormNames);
        $UFormName = ucfirst($FormName);
        $ModuleNames = $ModuleName . "s";
        $FileName = $ModuleName . "_$FormName" . "Manage";
        $Fields = [];
        $PureFields = [];
        $PersianFields = [];
        $FieldIndex = 0;
        for ($i = 0; $i < count($this->getCurrentTableFields()); $i++) {
            if (FieldType::getFieldType($this->getCurrentTableFields()[$i]) != FieldType::$METAINF && FieldType::getFieldType($this->getCurrentTableFields()[$i]) != FieldType::$LARAVELMETAINF && FieldType::getFieldType($this->getCurrentTableFields()[$i]) != FieldType::$ID) {
                $UCField = $this->getCurrentTableFields()[$i];
                $UCField = trim(strtolower($UCField));
                $PersianField = $trans->getPersian($UCField, $UCField);
                if (FieldType::getFieldType($UCField) == FieldType::$FID)
                    $PureFields[$FieldIndex] = substr($UCField, 0, strlen($UCField) - 4);
                else
                    $PureFields[$FieldIndex] = $UCField;

                $Fields[$FieldIndex] = $UCField;
                $PersianFields[$FieldIndex] = $PersianField;
                $FieldIndex++;
            }
        }
        $C = "// @flow
import * as React from 'react';
import { MDBContainer, MDBRow, MDBCol, MDBInput, MDBBtn,FormInline, Input } from 'mdbreact';
import  DatePicker  from '../../../../PersianDatePicker/components/DatePicker';
import '../../../../scss/datepicker.scss'
import moment from 'moment-jalaali'
class $FileName extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            ";
        for ($i = 0; $i < count($Fields); $i++) {
            $C = $C . "\r\n\t$Fields[$i]:'',";
            if (FieldType::getFieldType($Fields[$i]) == FieldType::$FID)
                $C = $C . "\r\n\t$Fields[$i]Options:[],";
        }

        $C .= "
        };
        fetch('" . $this->SiteURL . "/api/$ModuleName/$FormNames/'+this.props.match.params.id)
            .then(response => response.json())
            .then(data => {
                 this.setState({ ";
        for ($i = 0; $i < count($Fields); $i++)
            $C = $C . "$Fields[$i]:data.$Fields[$i],";

        $C .= "});";
        for ($i = 0; $i < count($Fields); $i++)
            if (FieldType::getFieldType($Fields[$i]) == FieldType::$FID) {
                $C = $C . "\r\nfetch('" . $this->SiteURL . "/api/$ModuleName/" . $PureFields[$i] . "s')
            .then(response => response.json())
            .then(data => {
                let Options=data.map(item=><option value={item.id}>{item.title}</option>);
                this.setState({" . $Fields[$i] . "Options:Options})
            });";
            }
        $C .= "
            });
    }
    render(){
        return <MDBContainer>
            <MDBRow>
                <MDBCol md='6'>
                    <form>
                        <p className='h5 text-center mb-4'>$FileName</p>
                        ";
        for ($i = 0; $i < count($Fields); $i++) {
            if (FieldType::getFieldType($Fields[$i]) == FieldType::$FID) {
                $C = $C . "
                    <div className='grey-text'>
                        <select className='browser-default custom-select' value={this.state.$Fields[$i]} onChange={(event)=>{this.setState({" . $Fields[$i] . ":event.target.value})}}>
                                <option>$PersianFields[$i]</option>
                                {this.state.$Fields[$i]Options}
                            </select>
                            </div>";

            } elseif (FieldType::getFieldType($Fields[$i]) == FieldType::$BOOLEAN) {
                $TrueTitle=$PersianFields[$i] . ' دارد';
                $FalseTitle=$PersianFields[$i] . ' ندارد';
                if($Fields[$i]=='ismale')
                {

                    $FalseTitle='زن';
                    $TrueTitle='مرد';
                }
                elseif($Fields[$i]=='ismarried')
                {

                    $FalseTitle='مجرد';
                    $TrueTitle='متاهل';
                }
                elseif($Fields[$i]=='isactive')
                {

                    $FalseTitle='غیر فعال';
                    $TrueTitle='فعال';
                }
                $C = $C . "
                        <div className='grey-text'>
                            <FormInline>
                                    <Input
                                        onClick={() => this.setState({" . $Fields[$i] . " : 0})}
                                        checked={this.state.$Fields[$i] === 0}
                                        label='$FalseTitle'
                                        type='radio'
                                        id='radio$Fields[$i]1'
                                    />
                                    <Input
                                        onClick={() => this.setState({" . $Fields[$i] . " : 1})}
                                        checked={this.state.$Fields[$i] === 1}
                                        label='$TrueTitle'
                                        type='radio'
                                        id='radio$Fields[$i]2'
                                    />
                                </FormInline>
                        </div>";
            }
            elseif(FieldType::getFieldType($Fields[$i]) == FieldType::$DATE) {
                $C = $C . "
                        <div className='grey-text'>
                            <DatePicker
                                label='$PersianFields[$i]'
                                group
                                value={this.state.$Fields[$i]}
                                onChange={(value)=>{this.setState({" . $Fields[$i] . ":value})}}
                            />
                        </div>";
            }
            else {
                $C = $C . "
                        <div className='grey-text'>
                            <MDBInput
                                label='$PersianFields[$i]'
                                group
                                type='text'
                                validate
                                value={this.state.$Fields[$i]}
                                onChange={(event)=>{this.setState({" . $Fields[$i] . ":event.target.value})}}
                            />
                        </div>";
            }


        }
        $C = $C . "    
                        <div className='text-center'>
                            <MDBBtn onClick={()=> {
                            let id = '';
                                if (this.props.match.params.id > 0)
                                    id = '/' + this.props.match.params.id;
                                const data = new FormData();
                                ";
        for ($i = 0; $i < count($Fields); $i++)
            $C = $C . "\r\n\tdata.append('$Fields[$i]', this.state.$Fields[$i]);";
        $C .= "\r\n\tif(id!=='')";
        $C = $C . "\r\n\tdata.append('_method', 'PUT');";

        $C .= "
                                fetch('" . $this->SiteURL . "/api/$ModuleName/$FormNames'+id, {
                                    method: 'post',
                                    headers: {
                                        Accept: 'application/json',
                                    },
                                    mode: 'cors',
                                    crossDomain:true,
                                    body: data
                                })
                                    .then(res => res.json())
                                    .then(res => {
                                        if (res.hasOwnProperty('errors')) {
                                            alert('خطا','خطایی در ثبت اطلاعات بوجود آمد');
                                        }
                                        else {
                                            return this.props.history.push('/$ModuleName/$FormNames');   

                                            //alert('پیام',res.message);
                                        }
                                        // console.log(res);
                                    }).catch(function (error) {
                                    alert('خطا','خطایی در ثبت اطلاعات بوجود آمد');
                                    throw error;
                                });
                            }
                            }>ذخیره</MDBBtn>
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
        $ListFileName = $ModuleName . "_$FormName" . "List";
        $EditFileName = $ModuleName . "_$FormName" . "Manage";
        $ViewFileName = $ModuleName . "_$FormName";
        $C = "

const $ListFileName = React.lazy(() => import('./modules/$ModuleName/pages/$FormName/$ListFileName'));
routes.push({ path: '/$ModuleName/$FormNames',exact:true, name: 'لیست اطلاعات',component:$ListFileName});
const $EditFileName = React.lazy(() => import('./modules/$ModuleName/pages/$FormName/$EditFileName'));
routes.push({ path: '/$ModuleName/$FormNames/management/:id',exact:false, name: 'مدیریت اطلاعات',component:$EditFileName});
routes.push({ path: '/$ModuleName/$FormNames/management',exact:false, name: 'مدیریت اطلاعات',component:$EditFileName});
";
        $DesignFile = $this->getReactCodeModuleDir() . "/routes.js";

        $this->SaveFile($DesignFile, $C, true);
    }
}

?>