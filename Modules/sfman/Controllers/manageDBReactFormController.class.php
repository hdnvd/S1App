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



    protected function getReactFieldFillCode($FieldName, $PersianFieldName, $PureFieldName, $IsForSearchSake)
    {
        $ReturningCode = "";
        if ($IsForSearchSake) {
            if (FieldType::fieldIsFileUpload($FieldName))
                return "";
        }
        if (FieldType::getFieldType($FieldName) == FieldType::$FID) {
            if (!FieldType::fieldIsUserFid($FieldName)) {
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
            }

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
}

?>