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
    protected function makeReactNativeModuleRoute($formInfo)
    {
        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $RouteFileName = $ModuleName . "_$FormName"."Routes";
        $FileName = $ModuleName . "Routes";
        $C = "
import $RouteFileName from './$RouteFileName';
    let $FileName=Object.assign({}, $RouteFileName);
export default $FileName;
    ";
        $DesignFile = $this->getReactNativeCodeModuleDir() . "/modules/" . $ModuleName . "/routes/" . $FileName . ".js";
        $this->SaveFile($DesignFile, $C);
    }
    protected function makeReactNativeRoutes($formInfo)
    {
        $this->makeReactNativeModuleRoute($formInfo);
        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FileName = $ModuleName . "_$FormName"."Routes";
        $ManageForm=$ModuleName."_"."$FormName"."Manage";
        $ViewForm=$ModuleName."_"."$FormName"."View";
        $ListForm=$ModuleName."_"."$FormName"."List";
        $C = "
import $ManageForm from '../pages/$FormName/$ManageForm';
import $ViewForm from '../pages/$FormName/$ViewForm';
import $ListForm from '../pages/$FormName/$ListForm';
    let $FileName={
        $ManageForm: $ManageForm,
        $ViewForm: $ViewForm,
        $ListForm: $ListForm,
    };
export default $FileName;
    ";
        $DesignFile = $this->getReactNativeCodeModuleDir() . "/modules/" . $ModuleName . "/routes/" . $FileName . ".js";
        $this->SaveFile($DesignFile, $C);
    }




}

?>