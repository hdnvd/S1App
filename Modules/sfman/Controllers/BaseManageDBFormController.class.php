<?php

namespace Modules\sfman\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\SweetDate;
use Modules\common\PublicClasses\AppDate;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\sfman\Entity\sfman_formelementEntity;
use Modules\sfman\Entity\sfman_formelementtypeEntity;
use Modules\sfman\Entity\sfman_formEntity;
use Modules\sfman\Entity\sfman_moduleEntity;
use Modules\sfman\Entity\sfman_tableEntity;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 1395/10/9 - 2016/12/29 19:36:38
 *@lastUpdate 1395/10/9 - 2016/12/29 19:36:38
 *@SweetFrameworkHelperVersion 1.112
*/

abstract class BaseManageDBFormController extends baseFormCodeGenerator {

    protected abstract function getTableFields($TableName);
    protected abstract function getFieldName($i);
    protected abstract function getEntityObjectFieldSetCode($ObjectName,$EntityClassName,$isInsert);
    protected abstract function getIsItemSelected($FormsToGenerate,$ItemName);
    protected abstract function fillGETParamValueGetters($formInfo,&$Params,&$GetterCode);
    protected abstract function fillPostParamValueGetters($formInfo,&$Params,&$GetterCode);
    protected abstract function getFieldFillCode($formInfo,$AddEmptyOption=false);


    public abstract function generateManageForms($FormsToGenerate,$Module,$TableName);


    protected abstract function getTableItemDesignElementDefineCode($formInfo,$i);
    protected abstract function makeTableItemManageDesign($formInfo);
    protected abstract function makeTableItemDesign($formInfo);

    protected abstract function makeTableManageListDesign($formInfo);
    protected abstract function makeTableListDesign($formInfo);
    protected abstract function makeTableSearchDesign($formInfo);




    protected abstract function getTableItemControllerTopCode($formInfo,$isManager);
    protected abstract function getTableItemControllerLoadCode($formInfo,$isManager);
    protected abstract function makeTableItemController($formInfo);
    protected abstract function makeTableItemManageController($formInfo);
    protected abstract function makeTableManageListController($formInfo);
    protected abstract function makeTableListController($formInfo);
    protected abstract function getTableListControllerLoadCode($formInfo,$LoadParams,$MethodName,$EntityClassName,$QueryParams,$isManager);
    protected abstract function getTableListControllerCode($formInfo,$LoadParams,$isManager);
    protected abstract function getActionFormController($formInfo,$ActionName,$isManager);


    protected abstract function getTableItemCode($formInfo,$isManager);
    protected abstract function getActionUsingGetFormCode($formInfo,$ActionName,$FirstParam="\$this->getID(),");
    protected abstract function getActionFormCode($formInfo,$ActionName,$FirstParam="\$this->getID(),",$ParamMethodisPost=true);
    protected abstract function makeTableItemManageCode($formInfo);
    protected abstract function makeTableItemCode($formInfo);
    protected abstract function makeTableManageListCode($formInfo);
    protected abstract function makeTableListCode($formInfo);


    /**
     * @param array $formInfo
     * @param string $changeLogFile
     */
    protected function makeChangeLog(array $formInfo, $changeLogFile,$TableName)
    {
        $C = "\n<?php";
        $C .= "\n/**";
        $C .= "\n*@SweetFrameworkHelperVersion " . manageformController::$SFHVERSION;
        $C .= "\n*@SweetFrameworkVersion " . manageformController::$SFVERSION;
        $C .= "\n*@Date " . $this->getJDate() . " - " . $this->getCDate();
        $C .= "\n*@Module Name " . $formInfo['module']['name'] ;
        $C .= "\n*@ActionTitle Regenerate WholeFormFiles For " .  $formInfo['form']['name'] ;
        $C .= "\n*@ActionCode 1" ;
        $C .= "\n*/";
        $C .= "\n?>";
        file_put_contents($changeLogFile, $C,FILE_APPEND);
        chmod($changeLogFile,0777);

    }

}

class FieldType{
    public static $NORMAL=0;
    public static $FID=1;
    public static $BOOLEAN=2;
    public static $METAINF=3;
    public static $ID=4;
    public static $FILE=5;
    public static $DATE=6;
    public static $AUTOTIME=7;

    public static function getFieldType($FieldName)
    {

        $FieldName=strtolower($FieldName);
        if($FieldName=="id")
            return FieldType::$ID;
        if($FieldName=="role_systemuser_fid" ||
            $FieldName=="deletetime")
            return FieldType::$METAINF;
        if(substr($FieldName,strlen($FieldName)-4)=="_fid")
            return FieldType::$FID;
        if(substr($FieldName,strlen($FieldName)-4)=="_flu")
            return FieldType::$FILE;
        if(substr($FieldName,strlen($FieldName)-5)=="_date")
            return FieldType::$DATE;
        if(substr($FieldName,strlen($FieldName)-5)=="_time")
            return FieldType::$AUTOTIME;
        if(substr($FieldName,0,2)=="is")
            return FieldType::$BOOLEAN;
        return FieldType::$NORMAL;
    }

}
?>
