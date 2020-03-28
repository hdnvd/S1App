<?php

namespace Modules\sfman\Controllers;

use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\dbaccess;
use Modules\sfman\Classes\Field\FieldCode;
use Modules\sfman\Entity\sfman_formelementtypeEntity;
use Modules\sfman\Entity\sfman_formEntity;
use Modules\sfman\Entity\sfman_moduleEntity;
use Modules\sfman\Entity\sfman_tableEntity;


/**
 * @author Hadi AmirNahavandi
 * @creationDate 1395/10/9 - 2016/12/29 19:36:38
 * @lastUpdate 1395/10/9 - 2016/12/29 19:36:38
 * @SweetFrameworkHelperVersion 1.112
 */
abstract class manageDBFormController extends BaseManageDBFormController
{
    private $TableName;
    private $SecondaryTables;

    protected function getTableFieldPart($theFieldName, $offset)
    {
        return FieldCode::getTableFieldPart($theFieldName,$offset);
    }
    protected function getFieldNameWithoutPostFix($FieldName)
    {
        return FieldCode::getFieldNameWithoutPostFix($FieldName);
    }
    protected function getFieldNameWithoutPreFix($FieldName)
    {
        return FieldCode::getFieldNameWithoutPreFix($FieldName);
    }
    protected function getTableNameFromFIDFieldName($Field)
    {
        return FieldCode::getTableNameFromFIDFieldName($Field);
    }
    protected function getModuleNameFromFIDFieldName($Field,$DefaultModuleName)
    {
        return FieldCode::getModuleNameFromFIDFieldName($Field,$DefaultModuleName);
    }
    protected function getPureFieldName($FieldName)
    {
        return FieldCode::getPureFieldName($FieldName);
    }

    /**
     * @return mixed
     */
    public function getSecondaryTables()
    {
        return $this->SecondaryTables;
    }

    /**
     * @param mixed $SecondaryTables
     */
    public function setSecondaryTables($SecondaryTables)
    {
        $this->SecondaryTables = $SecondaryTables;
    }

    /**
     * @param mixed $TableName
     */
    public function setTableName($TableName)
    {
        $this->TableName = $TableName;
    }

    private $CurrentTableFields;

    /**
     * @param mixed $CurrentTableFields
     */
    public function setCurrentTableFields($CurrentTableFields)
    {
        $this->CurrentTableFields = $CurrentTableFields;
    }

    /**
     * @return mixed
     */
    public function getCurrentTableFields()
    {
        return $this->CurrentTableFields;
    }

    private $IsManagerForm = false;

    /**
     * @return mixed
     */
    public function getTableName()
    {
        return $this->TableName;
    }

    protected function getTableFields($TableName)
    {
        $tblEnt = new sfman_tableEntity(null, $TableName);
        return $tblEnt->GetCollumns();
    }

    protected function getAllFormsOfFields($FieldList=null)
    {
        if($FieldList==null)
            $FieldList=$this->getCurrentTableFields();
        $trans = new Translator();
        $Fields = [];
        $PureFields = [];
        $PersianFields = [];
        $FieldIndex = 0;
        for ($i = 0; $i < count($FieldList); $i++) {
            if (FieldType::getFieldType($FieldList[$i]) != FieldType::$METAINF && FieldType::getFieldType($FieldList[$i]) != FieldType::$LARAVELMETAINF && FieldType::getFieldType($FieldList[$i]) != FieldType::$ID) {
                $UCField = $FieldList[$i];
                $UCField = trim(strtolower($UCField));
                $PersianField = $trans->getPersian($UCField, $UCField);
                $PureFields[$FieldIndex]=$this->getPureFieldName($UCField);
                $Fields[$FieldIndex] = $UCField;
                $PersianFields[$FieldIndex] = $PersianField;
                $FieldIndex++;
            }
            
        }
        return ['fields'=>$Fields,'purefields'=>$PureFields,'persianfields'=>$PersianFields];
    }
    protected function getFieldName($i)
    {
        $fl = $this->CurrentTableFields[$i];
        $Last4Chars = substr($fl, strlen($fl) - 4);
        $EntityName = null;
        $FT = FieldType::getFieldType($fl);
        if (($FT == FieldType::$FID || FieldType::fieldTypesIsFileUpload($FT)) && $fl != "role_systemuser_fid") {
            $FieldName = substr($fl, 0, strlen($fl) - 4);
            $EntityName = $FieldName;
            $LastUnderLinePlace = strrpos($FieldName, "_");
            if ($LastUnderLinePlace > 0)
                $EntityName = substr($FieldName, $LastUnderLinePlace + 1);
        }
        return $EntityName;
    }

    protected function getIsItemSelected($FormsToGenerate, $ItemName)
    {
        if ($FormsToGenerate != null && array_search($ItemName, $FormsToGenerate) !== false)
            return true;
        return false;
    }

    /**
     * @param array $formInfo
     * @param string $changeLogFile
     */
    protected function makeChangeLog(array $formInfo, $changeLogFile, $TableName)
    {
        $C = "\n<?php";
        $C .= "\n/**";
        $C .= "\n*@SweetFrameworkHelperVersion " . manageformController::$SFHVERSION;
        $C .= "\n*@SweetFrameworkVersion " . manageformController::$SFVERSION;
        $C .= "\n*@Date " . $this->getJDate() . " - " . $this->getCDate();
        $C .= "\n*@Module Name " . $formInfo['module']['name'];
        $C .= "\n*@ActionTitle Regenerate WholeFormFiles For " . $formInfo['form']['name'];
        $C .= "\n*@ActionCode 1";
        $C .= "\n*/";
        $C .= "\n?>";
        file_put_contents($changeLogFile, $C, FILE_APPEND);
        chmod($changeLogFile, 0777);

    }

    public function generateManageForms($FormsToGenerate, $ModuleID, $TableName)
    {
        $DBAccessor = new dbaccess();
        $ModEnt = new sfman_moduleEntity($DBAccessor);
        $ModEnt->setId($ModuleID);
        $Module = $ModEnt->getName();
        $Tables = explode('+', $TableName);
        $TableName = $Tables[0];
        $Tables = array_splice($Tables, 1);
        $this->setSecondaryTables($Tables);
        $this->setTableName($TableName);
        $this->setCodeModuleName($Module);
        $fName = $TableName;
        $fName = "manage" . $fName;
        $this->setFormName($fName);
        $this->setFormCaption($fName);
        $this->MakeModuleDirectories();
        $this->setCurrentTableFields($this->getTableFields($Module . "_" . $this->getTableName()));
        $formInfo['module']['name'] = $Module;
        $formInfo['form']['name'] = "manage" . $TableName;
        $formInfo['form']['caption'] = "Manage " . ucfirst($TableName);
        $skippedCollumns = 0;
        $CurTableFields = $this->getCurrentTableFields();
        $FieldCount = count($CurTableFields);
        for ($i = 0; $i < $FieldCount; $i++) {
            $E = $CurTableFields[$i];
            $FT = FieldType::getFieldType($E);
            if ($FT == FieldType::$METAINF || $FT == FieldType::$LARAVELMETAINF || $FT == FieldType::$ID)
                $skippedCollumns++;
            else {
                $formInfo['elements'][$i - $skippedCollumns]['name'] = $E;
                $formInfo['elements'][$i - $skippedCollumns]['caption'] = $E;
                if ($FT == FieldType::$FID)
                    $formInfo['elements'][$i - $skippedCollumns]['type_fid'] = 3;
                elseif (FieldType::fieldTypesIsFileUpload($FT))
                    $formInfo['elements'][$i - $skippedCollumns]['type_fid'] = 6;
                elseif ($FT == FieldType::$BOOLEAN)
                    $formInfo['elements'][$i - $skippedCollumns]['type_fid'] = 3;
                elseif ($FT == FieldType::$DATE)
                    $formInfo['elements'][$i - $skippedCollumns]['type_fid'] = 9;
                elseif ($FT == FieldType::$AUTOTIME)
                    $formInfo['elements'][$i - $skippedCollumns]['type_fid'] = 9;
                else
                    $formInfo['elements'][$i - $skippedCollumns]['type_fid'] = 2;
            }
        }
        $DBAccessor = new dbaccess();
        $eTEnt = new sfman_formelementtypeEntity($DBAccessor);
        $formInfo['elementtypes'] = $eTEnt->Select(null, null, null, array('id'), array(false), "0,50");
        $DBAccessor->close_connection();

        $this->setTableName($TableName);
        $formInfo2 = $formInfo;
        $formInfo2['elements'][$i - $skippedCollumns]['name'] = "btnSave";
        $formInfo2['elements'][$i - $skippedCollumns]['caption'] = "ذخیره";
        $formInfo2['elements'][$i - $skippedCollumns]['type_fid'] = 7;
        $i++;
        $this->setFormCaption("تعریف " . "\" . \$this->Data['" . $TableName . "']->getTableTitle() . \"");
        if ($this->getIsItemSelected($FormsToGenerate, "manage_item_controller"))
            $this->makeTableItemManageController($formInfo2);
        if ($this->getIsItemSelected($FormsToGenerate, "manage_item_code")) {
            if ($this->getIsItemSelected($FormsToGenerate, "manage_useritem_code"))
                $formInfo2['userform']['name'] = "manageuser" . $TableName;
            $this->makeTableItemManageCode($formInfo2);
            $formInfo2['userform']['name'] = null;
        }
        if ($this->getIsItemSelected($FormsToGenerate, "manage_item_design")) {
            $this->makeTableItemManageDesign($formInfo2);
            $this->saveFormInDB($ModuleID, $formInfo2['form']['name'], $formInfo2['form']['caption']);
        }

        if ($this->getIsItemSelected($FormsToGenerate, "manage_useritem_code")) {
            $this->setFormName("manageuser" . $TableName);
            $this->makeUserManageCode("manageuser" . $TableName, $formInfo2);
            $this->saveFormInDB($ModuleID, "manageuser" . $TableName, "manageuser" . $TableName);
        }


        $formInfo['form']['name'] = "manage" . $TableName . "s";
        $formInfo['form']['caption'] = "Manage " . ucfirst($TableName) . "s";
        $formInfo['form']['listname'] = $TableName . "list";
        $this->setFormName($formInfo['form']['name']);
        $this->setFormCaption(" " . "\" . \$this->Data['" . $TableName . "']->getTableTitle() . \" ها");
        if ($this->getIsItemSelected($FormsToGenerate, "manage_list_controller"))
            $this->makeTableManageListController($formInfo);
        if ($this->getIsItemSelected($FormsToGenerate, "manage_list_code")) {
            $this->makeTableManageListCode($formInfo);
        }
        if ($this->getIsItemSelected($FormsToGenerate, "manage_list_design")) {
            $this->saveFormInDB($ModuleID, $formInfo['form']['name'], $formInfo['form']['name']);
            $this->makeTableManageListDesign($formInfo);
        }
        if ($this->getIsItemSelected($FormsToGenerate, "manage_userlist_code")) {
            $this->setFormName("manageuser" . $TableName . "s");
            $this->makeUserManageCode("manageuser" . $TableName . "s", $formInfo);
            $this->saveFormInDB($ModuleID, "manageuser" . $TableName . "s", "manageuser" . $TableName . "s");

        }

        $formInfo['form']['name'] = $TableName;
        $formInfo['form']['caption'] = ucfirst($TableName) . " Information";
        $this->setFormName($formInfo['form']['name']);
        $this->setFormCaption(" " . "\" . \$this->Data['" . $TableName . "']->getTableTitle() . \"");
        if ($this->getIsItemSelected($FormsToGenerate, "item_display_controller"))
            $this->makeTableItemController($formInfo);
        if ($this->getIsItemSelected($FormsToGenerate, "item_display_code")) {
            $this->makeTableItemCode($formInfo);
        }
        if ($this->getIsItemSelected($FormsToGenerate, "item_display_design")) {
            $this->makeTableItemDesign($formInfo);
            $this->saveFormInDB($ModuleID, $formInfo['form']['name'], $formInfo['form']['name']);
        }


        $skippedCollumns = 0;
        for ($i = 0; $i - $skippedCollumns < count($formInfo2['elements']); $i++) {
            $item = $formInfo2['elements'][$i - $skippedCollumns]['type_fid'];
            if ($item == 6 || $item == 7) {
                array_splice($formInfo2['elements'], $i - $skippedCollumns, 1);
                $skippedCollumns++;
            }
        }

        $formInfo2['elements'][$i - $skippedCollumns]['name'] = "sortby";
        $formInfo2['elements'][$i - $skippedCollumns]['caption'] = "مرتب سازی بر اساس";
        $formInfo2['elements'][$i - $skippedCollumns]['type_fid'] = 3;
        $i++;
        $formInfo2['elements'][$i - $skippedCollumns]['name'] = "isdesc";
        $formInfo2['elements'][$i - $skippedCollumns]['caption'] = "نوع مرتب سازی";
        $formInfo2['elements'][$i - $skippedCollumns]['type_fid'] = 3;
        $i++;
        $formInfo2['elements'][$i - $skippedCollumns]['name'] = "search";
        $formInfo2['elements'][$i - $skippedCollumns]['caption'] = "جستجو";
        $formInfo2['elements'][$i - $skippedCollumns]['type_fid'] = 7;

        $ElementCount = count($formInfo2['elements']);
        $addedElements = 0;
        for ($i2 = 0; $i2 < $ElementCount; $i2++) {
            $item = $formInfo2['elements'][$i2 + $addedElements];
            $itemType = $item['type_fid'];
            if (FieldType::getFieldType($item['name']) == FieldType::$AUTOTIME || FieldType::getFieldType($item['name']) == FieldType::$DATE) {
                $NewItem[0]['name'] = $item['name'] . "_to";
                $NewItem[0]['caption'] = $item['caption'];
                $NewItem[0]['type_fid'] = $item['type_fid'];
                $formInfo2['elements'][$i2 + $addedElements]['name'] = $item['name'] . "_from";
                $partOne = array_slice($formInfo2['elements'], 0, $i2 + $addedElements + 1);
                $partTwo = array_slice($formInfo2['elements'], $i2 + $addedElements + 1);
                $formInfo2['elements'] = array_merge($partOne, $NewItem, $partTwo);
                $addedElements++;
                $i++;
            }
        }
        $formInfo2['form']['name'] = $TableName . "list";
        $formInfo2['form']['caption'] = ucfirst($TableName) . " List";
        $this->setFormName($formInfo2['form']['name']);
        $this->setFormCaption("فهرست " . "\" . \$this->Data['" . $TableName . "']->getTableTitle() . \" ها");
        if ($this->getIsItemSelected($FormsToGenerate, "list_controller"))
            $this->makeTableListController($formInfo2);
        if ($this->getIsItemSelected($FormsToGenerate, "list_code")) {
            $this->makeTableListCode($formInfo2);
        }
        if ($this->getIsItemSelected($FormsToGenerate, "list_design")) {
            $this->makeTableListDesign($formInfo2);
            $this->saveFormInDB($ModuleID, $formInfo2['form']['name'], $formInfo2['form']['caption']);
        }
        if ($this->getIsItemSelected($FormsToGenerate, "search_design")) {
            $this->setFormCaption("جستجوی " . "\" . \$this->Data['" . $TableName . "']->getTableTitle() . \"");
            $this->makeTableSearchDesign($formInfo2);
        }

        $formInfo['form']['name'] = $TableName;
        $formInfo['form']['caption'] = $TableName;
        $formInfo['form']['listname'] = $TableName;
        $this->setFormName($formInfo['form']['name']);
        if ($this->getIsItemSelected($FormsToGenerate, "android_class")) {

            $this->makeAndroidClass($formInfo);
            $this->makeAndroid_List_FragmentRecycler($formInfo);
            $this->makeAndroid_List_Fragment($formInfo);
            $this->makeAndroid_List_FragmentLayout($formInfo);
            $this->makeAndroid_List_ItemFragmentLayout($formInfo);
            $this->makeAndroid_Item_Fragment($formInfo);
            $this->makeAndroid_Item_FragmentLayout($formInfo);
        }
        if ($this->getIsItemSelected($FormsToGenerate, "sencha_codes")) {

            $this->makeSenchaListController($formInfo);
            $this->makeSenchaListModel($formInfo);
            $this->makeSenchaListView($formInfo);

            $this->makeSenchaListDataModel($formInfo);
            $this->makeSenchaListTestData($formInfo);
            $this->makeSenchaListStore($formInfo);

            $this->makeSenchaItemController($formInfo);
            $this->makeSenchaItemModel($formInfo);
            $this->makeSenchaItemView($formInfo);
        }
        if ($this->getIsItemSelected($FormsToGenerate, "laravel_api_codes")) {

            $this->makeLaravelAPIController($formInfo);
        }
        if ($this->getIsItemSelected($FormsToGenerate, "react_codes")) {

            $this->makeReactListDesign($formInfo);
            $this->makeReactItemManageDesign($formInfo);
            $this->makeReactItemViewDesign($formInfo);
            $this->makeReactRoutes($formInfo);
        }
        if ($this->getIsItemSelected($FormsToGenerate, "react_native_codes")) {

            $this->makeReactNativeListDesign($formInfo);
            $this->makeReactNativeItemManageDesign($formInfo);
            $this->makeReactNativeItemViewDesign($formInfo);
//            $this->makeReactItemViewDesign($formInfo);
            $this->makeReactNativeRoutes($formInfo);
        }
        $DBAccessor->close_connection();
    }

    protected function saveFormInDB($ModuleID, $FormName, $FormCaption)
    {
        $DBAccessor = new dbaccess();
        $Fent = new sfman_formEntity($DBAccessor);
        $q = new QueryLogic();
        $q->addCondition(new FieldCondition("name", $FormName));
        $q->addCondition(new FieldCondition("module_fid", $ModuleID));
        $Fent = $Fent->FindOne($q);
        if ($Fent == null) {
            $Fent = new sfman_formEntity($DBAccessor);
            $Fent->Insert($FormName, $FormCaption, $ModuleID, true);
        } else {
            $ID = $Fent->getId();
            $Fent = new sfman_formEntity($DBAccessor);
            $Fent->Update($ID, $FormName, $FormCaption, $ModuleID, true);
        }
        $DBAccessor->close_connection();
    }

    protected function deletFormFromDB($ModuleID, $FormName)
    {
        $DBAccessor = new dbaccess();
        $Fent = new sfman_formEntity($DBAccessor);
        $q = new QueryLogic();
        $q->addCondition(new FieldCondition("name", $FormName));
        $q->addCondition(new FieldCondition("module_fid", $ModuleID));
        $Fent = $Fent->FindOne($q);
        if ($Fent != null) {
            $Fent->Delete($Fent->getId());
        }
        $DBAccessor->close_connection();
    }

    private function DeleteManageCodeFile($FilePath)
    {
        if (file_exists($FilePath))
            unlink($FilePath);

    }

    public function DeleteManageCodes($FormsToDelete, $ModuleID, $TableName)
    {
        $ModEnt = new sfman_moduleEntity(new dbaccess());
        $ModEnt->setId($ModuleID);
        $Module = $ModEnt->getName();
        $this->setCodeModuleName($Module);
        $this->setFormName("manage" . $TableName);
        if ($this->getIsItemSelected($FormsToDelete, "manage_item_controller")) {
            $file = $this->getControllerFile();
            $this->DeleteManageCodeFile($file);
        }
        if ($this->getIsItemSelected($FormsToDelete, "manage_item_code")) {
            $file = $this->getCodeFile();
            $this->DeleteManageCodeFile($file);
            $this->deletFormFromDB($ModuleID, $this->getFormName());
        }
        if ($this->getIsItemSelected($FormsToDelete, "manage_item_design")) {
            $file = $this->getDesignFile();
            $this->DeleteManageCodeFile($file);
        }

        if ($this->getIsItemSelected($FormsToDelete, "manage_useritem_code")) {
            $this->setFormName("manageuser" . $TableName);
            $file = $this->getCodeFile();
            $this->DeleteManageCodeFile($file);
            $this->deletFormFromDB($ModuleID, $this->getFormName());
        }

        $this->setFormName("manage" . $TableName . "s");
        if ($this->getIsItemSelected($FormsToDelete, "manage_list_controller")) {
            $file = $this->getControllerFile();
            $this->DeleteManageCodeFile($file);
        }
        if ($this->getIsItemSelected($FormsToDelete, "manage_list_code")) {
            $file = $this->getCodeFile();
            $this->DeleteManageCodeFile($file);
            $this->deletFormFromDB($ModuleID, $this->getFormName());
        }
        if ($this->getIsItemSelected($FormsToDelete, "manage_list_design")) {
            $file = $this->getDesignFile();
            $this->DeleteManageCodeFile($file);
        }
        if ($this->getIsItemSelected($FormsToDelete, "manage_userlist_code")) {
            $this->setFormName("manageuser" . $TableName . "s");
            $file = $this->getCodeFile();
            $file = $this->getCodeFile();
            $this->DeleteManageCodeFile($file);
            $this->deletFormFromDB($ModuleID, $this->getFormName());

        }

        $this->setFormName($TableName);
        if ($this->getIsItemSelected($FormsToDelete, "item_display_controller")) {
            $file = $this->getControllerFile();
            $this->DeleteManageCodeFile($file);
        }
        if ($this->getIsItemSelected($FormsToDelete, "item_display_code")) {
            $file = $this->getCodeFile();

            $this->DeleteManageCodeFile($file);
        }
        if ($this->getIsItemSelected($FormsToDelete, "item_display_design")) {
            $file = $this->getDesignFile();
            $this->DeleteManageCodeFile($file);
            $this->deletFormFromDB($ModuleID, $this->getFormName());

        }


        $this->setFormName($TableName . "list");
        if ($this->getIsItemSelected($FormsToDelete, "list_controller")) {
            $file = $this->getControllerFile();
            $this->DeleteManageCodeFile($file);
        }
        if ($this->getIsItemSelected($FormsToDelete, "list_code")) {
            $file = $this->getCodeFile();
            $this->DeleteManageCodeFile($file);
        }
        if ($this->getIsItemSelected($FormsToDelete, "list_design")) {
            $file = $this->getDesignFile();
            $this->DeleteManageCodeFile($file);
            $this->deletFormFromDB($ModuleID, $this->getFormName());

        }
        if ($this->getIsItemSelected($FormsToDelete, "search_design")) {
            $this->setFormName($TableName . "listsearch");
            $file = $this->getDesignFile();
            $this->DeleteManageCodeFile($file);

        }
    }

    protected function getIsAdminModeDefine($ShowSetter)
    {
        $C = <<<EOT
\n\tprivate \$adminMode=true;
    public function getAdminMode()
    {
        return \$this->adminMode;
    }
    
EOT;
        if ($ShowSetter)
            $C .= <<<EOT
    /**
     * @param bool \$adminMode
     */
    public function setAdminMode(\$adminMode)
    {
        \$this->adminMode = \$adminMode;
    }
EOT;
        return $C;
    }

    protected function SaveFile($File, $Content,$IsAppend=false)
    {
        $lastSlash=strrpos($File,'/');
        $FileDir=substr($File,0,$lastSlash);
        if(!is_dir($FileDir)){
            //Directory does not exist, so lets create it.
            mkdir($FileDir, 0755, true);
        }
        if(!$IsAppend)
            file_put_contents($File, $Content);
        else
            file_put_contents($File, $Content,FILE_APPEND);
        chmod($File, 0777);
    }

    protected abstract function makeUserManageCode($formName, $GeneralformInfo);
}

?>
