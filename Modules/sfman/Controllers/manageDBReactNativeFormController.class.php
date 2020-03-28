<?php

namespace Modules\sfman\Controllers;


/**
 * @author Hadi AmirNahavandi
 * @creationDate 1395/10/9 - 2016/12/29 19:36:38
 * @lastUpdate 1395/10/9 - 2016/12/29 19:36:38
 * @SweetFrameworkHelperVersion 1.112
 */
abstract class manageDBReactNativeFormController extends manageDBReactManageFormController
{
    protected function makeReactNativeModuleRoute($formInfo)
    {
        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $RouteFileName = $ModuleName . "_$FormName"."Routes";
        $FileName = $ModuleName . "Routes";
        $C = "
import $RouteFileName from './$RouteFileName';
    let $FileName=Object.assign({}, $RouteFileName.routes);
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

        $upFormName=strtoupper($FormName);
        $PureManageForm="$upFormName"."_MANAGE";
        $PureViewForm="$upFormName"."_VIEW";
        $PureListForm="$upFormName"."_LIST";

        $ManageForm=$ModuleName."_".$FormName."Manage";
        $ViewForm=$ModuleName."_"."$FormName"."View";
        $ListForm=$ModuleName."_"."$FormName"."List";
        $C = "
import SweetRoute from '../../../sweet/architecture/SweetRoute';
import $ManageForm from '../pages/$FormName/$ManageForm';
import $ViewForm from '../pages/$FormName/$ViewForm';
import $ListForm from '../pages/$FormName/$ListForm';
export default class $FileName extends SweetRoute{
    static routes={
        $ManageForm: $ManageForm,
        $ViewForm: $ViewForm,
        $ListForm: $ListForm,
    };
    static " . $PureManageForm . "='$ManageForm';
    static " . $PureViewForm . "='$ViewForm';
    static " . $PureListForm . "='$ListForm';
}";
        $DesignFile = $this->getReactNativeCodeModuleDir() . "/modules/" . $ModuleName . "/routes/" . $FileName . ".js";
        $this->SaveFile($DesignFile, $C);
    }




}

?>