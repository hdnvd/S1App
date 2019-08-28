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


    protected abstract function makeAndroidClass($formInfo);
    protected abstract function makeAndroid_List_FragmentRecycler($formInfo);
    protected abstract function makeAndroid_List_Fragment($formInfo);
    protected abstract function makeAndroid_List_FragmentLayout($formInfo);
    protected abstract function makeAndroid_List_ItemFragmentLayout($formInfo);
    protected abstract function makeAndroid_Item_Fragment($formInfo);
    protected abstract function makeAndroid_Item_FragmentLayout($formInfo);






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



    protected abstract function makeSenchaListController($formInfo);
    protected abstract function makeSenchaListModel($formInfo);
    protected abstract function makeSenchaListView($formInfo);
    protected abstract function makeSenchaListDataModel($formInfo);
    protected abstract function makeSenchaListTestData($formInfo);
    protected abstract function makeSenchaListStore($formInfo);
    protected abstract function makeSenchaItemController($formInfo);
    protected abstract function makeSenchaItemModel($formInfo);
    protected abstract function makeSenchaItemView($formInfo);

    protected abstract function makeLaravelAPIController($formInfo);
    protected abstract function makeReactListDesign($formInfo);
    protected abstract function makeReactItemManageDesign($formInfo);
    protected abstract function makeReactItemViewDesign($formInfo);
    protected abstract function makeReactRoutes($formInfo);


    protected abstract function makeReactNativeListDesign($formInfo);
    protected abstract function makeReactNativeItemManageDesign($formInfo);
    protected abstract function makeReactNativeItemViewDesign($formInfo);
    protected abstract function makeReactNativeRoutes($formInfo);

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
    public static $TEXT=0;
    public static $FID=1;
    public static $BOOLEAN=2;
    public static $METAINF=3;
    public static $ID=4;
    public static $FILE=5;
    public static $DATE=6;
    public static $AUTOTIME=7;
    public static $LARAVELMETAINF=8;
    public static $IMAGE=9;
    public static $TEXTAREA=10;
    public static $CLOCK=11;
    public static $POSITIVENUMBER=12;
    public static $FLOAT=13;
    public static $INTEGER=14;
    public static $PRICE=15;
    public static $DOUBLE=16;
    public static $BIGPOSITIVENUMBER=17;



    public static function getFieldType($FieldName)
    {

        $FieldName=strtolower($FieldName);
        if($FieldName=="id")
            return FieldType::$ID;
        if($FieldName=="role_systemuser_fid" ||
            $FieldName=="deletetime")
            return FieldType::$METAINF;
        if($FieldName=="readonly" ||
            $FieldName=="gender")
            return FieldType::$BOOLEAN;
        if(substr($FieldName,strlen($FieldName)-3)=="_id")
            return FieldType::$FID;
        if(substr($FieldName,strlen($FieldName)-4)=="_fid")
            return FieldType::$FID;
        if(substr($FieldName,strlen($FieldName)-4)=="_flu")
            return FieldType::$FILE;
        if(substr($FieldName,strlen($FieldName)-4)=="_igu")
            return FieldType::$IMAGE;
        if(substr($FieldName,strlen($FieldName)-5)=="_date")
            return FieldType::$DATE;
        if(substr($FieldName,strlen($FieldName)-4)=="_clk")
            return FieldType::$CLOCK;
        if(substr($FieldName,strlen($FieldName)-5)=="_time")
            return FieldType::$AUTOTIME;
        if(substr($FieldName,strlen($FieldName)-3)=="_te")
            return FieldType::$TEXTAREA;
        if(substr($FieldName,strlen($FieldName)-4)=="_int")
            return FieldType::$INTEGER;
        if(substr($FieldName,strlen($FieldName)-4)=="_flt")
            return FieldType::$FLOAT;
        if(substr($FieldName,strlen($FieldName)-4)=="_dbl")
            return FieldType::$DOUBLE;
        if(substr($FieldName,strlen($FieldName)-4)=="_num")
            return FieldType::$POSITIVENUMBER;
        if(substr($FieldName,strlen($FieldName)-5)=="_bnum")
            return FieldType::$BIGPOSITIVENUMBER;
        if(substr($FieldName,strlen($FieldName)-4)=="_prc")
            return FieldType::$PRICE;
        if(substr($FieldName,0,2)=="is" || substr($FieldName,0,4)=="can_" || substr($FieldName,0,4)=="has_")
            return FieldType::$BOOLEAN;
        if($FieldName=="updated_at" || $FieldName=="created_at" )
            return FieldType::$LARAVELMETAINF;
        return FieldType::$TEXT;
    }
//    private static function fieldTypesIsOneOf($TypeOfInputField,$FieldType)
//    {
//        if($FieldType==FieldType::$TEXT)
//            return true;
//    }

    public static function fieldTypeIsNumber($FieldType)
    {
        if($FieldType==FieldType::$INTEGER)
            return true;
        if($FieldType==FieldType::$FLOAT)
            return true;
        if($FieldType==FieldType::$DOUBLE)
            return true;
        if($FieldType==FieldType::$POSITIVENUMBER)
            return true;
        if($FieldType==FieldType::$BIGPOSITIVENUMBER)
            return true;
        if($FieldType==FieldType::$PRICE)
            return true;
        return false;
    }

    public static function fieldIsNumber($FieldName)
    {

        $FieldType=FieldType::getFieldType($FieldName);
        return FieldType::fieldTypeIsNumber($FieldType);
    }
    public static function fieldTypesIsText($FieldType)
    {
        if($FieldType==FieldType::$TEXT)
            return true;
        if(FieldType::fieldTypesIsTextArea($FieldType))
            return true;
        return false;
    }
    public static function fieldIsCityAreaFid($FieldName)
    {
        $FieldType=FieldType::getFieldType($FieldName);
        if($FieldType!=FieldType::$FID)
            return false;
        if(strtolower($FieldName)=="placeman_area_fid" || strtolower($FieldName)=="area_fid")
            return true;
        return false;
    }
    public static function fieldIsPlaceFid($FieldName)
    {
        $FieldType=FieldType::getFieldType($FieldName);
        if($FieldType!=FieldType::$FID)
            return false;
        if(strtolower($FieldName)=="placeman_place_fid" || strtolower($FieldName)=="place_fid")
            return true;
        return false;
    }
    public static function fieldIsLatitude($FieldName)
    {
        if(strtolower($FieldName)=="latitude")
            return true;
        return false;
    }
    public static function fieldIsLongitude($FieldName)
    {
        if(strtolower($FieldName)=="longitude")
            return true;
        return false;
    }
    public static function fieldIsLocation($FieldName)
    {
        return (FieldType::fieldIsLatitude($FieldName)||FieldType::fieldIsLongitude($FieldName));
    }
    public static function fieldIsAutoGenerated($FieldName)
    {
        $FieldType=FieldType::getFieldType($FieldName);
        if($FieldType==FieldType::$LARAVELMETAINF)
            return true;
        if($FieldType==FieldType::$AUTOTIME)
            return true;
        if($FieldType==FieldType::$METAINF)
            return true;
        if(strtolower($FieldName)=="visits")
            return true;
        return false;
    }
    public static function fieldTypesIsTextArea($FieldType)
    {
        if($FieldType==FieldType::$TEXTAREA)
            return true;
        return false;
    }

    public static function fieldIsText($FieldName)
    {
        $FieldType=FieldType::getFieldType($FieldName);
        return FieldType::fieldTypesIsText($FieldType);
    }
    public static function fieldIsTextArea($FieldName)
    {
        $FieldType=FieldType::getFieldType($FieldName);
        return FieldType::fieldTypesIsTextArea($FieldType);
    }
    public static function fieldTypesIsFileUpload($FieldType)
    {
        if($FieldType==FieldType::$FILE)
            return true;
        if($FieldType==FieldType::$IMAGE)
            return true;
        return false;
    }

    public static function fieldIsFileUpload($FieldName)
    {

        $FieldType=FieldType::getFieldType($FieldName);
        return FieldType::fieldTypesIsFileUpload($FieldType);
    }
    public static function fieldTypesIsImageUpload($FieldType)
    {
        if($FieldType==FieldType::$IMAGE)
            return true;
        return false;
    }
    public static function fieldIsImageUpload($FieldName)
    {

        $FieldType=FieldType::getFieldType($FieldName);
        return FieldType::fieldTypesIsImageUpload($FieldType);
    }

}
?>
