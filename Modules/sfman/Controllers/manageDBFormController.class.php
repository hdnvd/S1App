<?php

namespace Modules\sfman\Controllers;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\dbaccess;
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

abstract class manageDBFormController extends BaseManageDBFormController {
    private $TableName;

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

    private $IsManagerForm=false;

    /**
     * @return mixed
     */
    public function getTableName()
    {
        return $this->TableName;
    }

    protected function getTableFields($TableName)
    {
        $tblEnt=new sfman_tableEntity(null,$TableName);
        return $tblEnt->GetCollumns();
    }
    protected function getFieldName($i)
    {
        $fl = $this->CurrentTableFields[$i];
        $Last4Chars = substr($fl, strlen($fl) - 4);
        $EntityName=null;
        $FT=FieldType::getFieldType($fl);
        if (($FT == FieldType::$FID || $FT ==FieldType::$FILE) && $fl!="role_systemuser_fid") {
            $FieldName = substr($fl, 0, strlen($fl) - 4);
            $EntityName = $FieldName;
            $LastUnderLinePlace = strrpos($FieldName, "_");
            if ($LastUnderLinePlace > 0)
                $EntityName = substr($FieldName, $LastUnderLinePlace+1);
        }
        return $EntityName;
    }
    protected function getIsItemSelected($FormsToGenerate,$ItemName)
    {
        if($FormsToGenerate!=null && array_search($ItemName,$FormsToGenerate)!==false)
            return true;
        return false;
    }

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
    public function generateManageForms($FormsToGenerate,$ModuleID,$TableName)
    {
        $DBAccessor=new dbaccess();
        $ModEnt=new sfman_moduleEntity($DBAccessor);
        $ModEnt->setId($ModuleID);
        $Module=$ModEnt->getName();

        $this->setTableName($TableName);
        $this->setCodeModuleName($Module);
        $fName=$TableName;
        $fName="manage" . $fName;
        $this->setFormName($fName);
        $this->setFormCaption($fName);
        $this->MakeModuleDirectories();
        $this->setCurrentTableFields($this->getTableFields($Module . "_" . $this->getTableName()));
        $formInfo['module']['name']=$Module;
        $formInfo['form']['name']="manage".$TableName;
        $formInfo['form']['caption']="Manage ".ucfirst($TableName);
        $skippedCollumns=0;
        $CurTableFields=$this->getCurrentTableFields();
        $FieldCount=count($CurTableFields);
        for($i=0; $i<$FieldCount; $i++) {
            $E=$CurTableFields[$i];
            $FT=FieldType::getFieldType($E);
            if($FT==FieldType::$METAINF || $FT==FieldType::$ID)
                $skippedCollumns++;
            else
            {
                $formInfo['elements'][$i-$skippedCollumns]['name']=$E;
                $formInfo['elements'][$i-$skippedCollumns]['caption']=$E;
                if($FT==FieldType::$FID)
                    $formInfo['elements'][$i-$skippedCollumns]['type_fid']=3;
                elseif($FT==FieldType::$FILE)
                    $formInfo['elements'][$i-$skippedCollumns]['type_fid']=6;
                elseif($FT==FieldType::$BOOLEAN)
                    $formInfo['elements'][$i-$skippedCollumns]['type_fid']=3;
                elseif($FT==FieldType::$DATE)
                    $formInfo['elements'][$i-$skippedCollumns]['type_fid']=9;
                elseif($FT==FieldType::$AUTOTIME)
                    $formInfo['elements'][$i-$skippedCollumns]['type_fid']=9;
                else
                    $formInfo['elements'][$i-$skippedCollumns]['type_fid']=2;
            }
        }
        $DBAccessor=new dbaccess();
        $eTEnt=new sfman_formelementtypeEntity($DBAccessor);
        $formInfo['elementtypes']=$eTEnt->Select(null,null,null,array('id'),array(false),"0,50");
        $DBAccessor->close_connection();

        $this->setTableName($TableName);
        $formInfo2=$formInfo;
        $formInfo2['elements'][$i-$skippedCollumns]['name']="btnSave";
        $formInfo2['elements'][$i-$skippedCollumns]['caption']="ذخیره";
        $formInfo2['elements'][$i-$skippedCollumns]['type_fid']=7;
        $i++;
        $this->setFormCaption("مدیریت " . "\" . \$this->Data['" . $TableName . "']->getTableTitle() . \"");
        if($this->getIsItemSelected($FormsToGenerate,"manage_item_controller"))
            $this->makeTableItemManageController($formInfo2);
        if($this->getIsItemSelected($FormsToGenerate,"manage_item_code"))
        {
            if($this->getIsItemSelected($FormsToGenerate,"manage_useritem_code"))
                $formInfo2['userform']['name']="manageuser".$TableName;
            $this->makeTableItemManageCode($formInfo2);
            $formInfo2['userform']['name']=null;
        }
        if($this->getIsItemSelected($FormsToGenerate,"manage_item_design"))
        {
            $this->makeTableItemManageDesign($formInfo2);
            $this->saveFormInDB($ModuleID,$formInfo2['form']['name'],$formInfo2['form']['caption']);
        }

        if($this->getIsItemSelected($FormsToGenerate,"manage_useritem_code"))
        {
            $this->setFormName("manageuser".$TableName);
            $this->makeUserManageCode("manageuser".$TableName,$formInfo2);
            $this->saveFormInDB($ModuleID,"manageuser".$TableName,"manageuser".$TableName);
        }


        $formInfo['form']['name']="manage".$TableName . "s";
        $formInfo['form']['caption']="Manage ".ucfirst($TableName) . "s";
        $formInfo['form']['listname']=$TableName . "list";
        $this->setFormName($formInfo['form']['name']);
        $this->setFormCaption("مدیریت " . "\" . \$this->Data['" . $TableName . "']->getTableTitle() . \" ها");
        if($this->getIsItemSelected($FormsToGenerate,"manage_list_controller"))
            $this->makeTableManageListController($formInfo);
        if($this->getIsItemSelected($FormsToGenerate,"manage_list_code"))
        {
            $this->makeTableManageListCode($formInfo);
        }
        if($this->getIsItemSelected($FormsToGenerate,"manage_list_design"))
        {
            $this->saveFormInDB($ModuleID,$formInfo['form']['name'],$formInfo['form']['name']);
            $this->makeTableManageListDesign($formInfo);
        }
        if($this->getIsItemSelected($FormsToGenerate,"manage_userlist_code"))
        {
            $this->setFormName("manageuser".$TableName . "s");
            $this->makeUserManageCode("manageuser".$TableName . "s",$formInfo);
            $this->saveFormInDB($ModuleID,"manageuser".$TableName . "s","manageuser".$TableName . "s");

        }

        $formInfo['form']['name']=$TableName ;
        $formInfo['form']['caption']= ucfirst($TableName) . " Information";
        $this->setFormName($formInfo['form']['name']);
        $this->setFormCaption("اطلاعات " . "\" . \$this->Data['" . $TableName . "']->getTableTitle() . \"");
        if($this->getIsItemSelected($FormsToGenerate,"item_display_controller"))
            $this->makeTableItemController($formInfo);
        if($this->getIsItemSelected($FormsToGenerate,"item_display_code"))
        {
            $this->makeTableItemCode($formInfo);
        }
        if($this->getIsItemSelected($FormsToGenerate,"item_display_design"))
        {
            $this->makeTableItemDesign($formInfo);
            $this->saveFormInDB($ModuleID,$formInfo['form']['name'],$formInfo['form']['name']);
        }


        $skippedCollumns=0;
        for($i=0;$i-$skippedCollumns<count($formInfo2['elements']);$i++) {
            $item=$formInfo2['elements'][$i - $skippedCollumns]['type_fid'];
            if($item==6 || $item==7) {
                array_splice($formInfo2['elements'],$i - $skippedCollumns,1);
                $skippedCollumns++;
            }
        }

        $formInfo2['elements'][$i-$skippedCollumns]['name']="sortby";
        $formInfo2['elements'][$i-$skippedCollumns]['caption']="مرتب سازی بر اساس";
        $formInfo2['elements'][$i-$skippedCollumns]['type_fid']=3;
        $i++;
        $formInfo2['elements'][$i-$skippedCollumns]['name']="isdesc";
        $formInfo2['elements'][$i-$skippedCollumns]['caption']="نوع مرتب سازی";
        $formInfo2['elements'][$i-$skippedCollumns]['type_fid']=3;
        $i++;
        $formInfo2['elements'][$i-$skippedCollumns]['name']="search";
        $formInfo2['elements'][$i-$skippedCollumns]['caption']="جستجو";
        $formInfo2['elements'][$i-$skippedCollumns]['type_fid']=7;

        $ElementCount=count($formInfo2['elements']);
        $addedElements=0;
        for($i2=0;$i2<$ElementCount;$i2++) {
            $item=$formInfo2['elements'][$i2+$addedElements];
            $itemType=$item['type_fid'];
            if(FieldType::getFieldType($item['name'])==FieldType::$AUTOTIME || FieldType::getFieldType($item['name'])==FieldType::$DATE) {
                $NewItem[0]['name']=$item['name']. "_to";
                $NewItem[0]['caption']=$item['caption'];
                $NewItem[0]['type_fid']=$item['type_fid'];
                $formInfo2['elements'][$i2+$addedElements]['name']=$item['name']. "_from";
                $partOne=array_slice($formInfo2['elements'], 0, $i2+$addedElements+1);
                $partTwo=array_slice($formInfo2['elements'], $i2+$addedElements+1);
                $formInfo2['elements']=array_merge($partOne, $NewItem, $partTwo);
                $addedElements++;
                $i++;
            }
        }
        $formInfo2['form']['name']=$TableName . "list";
        $formInfo2['form']['caption']=ucfirst($TableName) . " List";
        $this->setFormName($formInfo2['form']['name']);
        $this->setFormCaption("فهرست " . "\" . \$this->Data['" . $TableName . "']->getTableTitle() . \" ها");
        if($this->getIsItemSelected($FormsToGenerate,"list_controller"))
            $this->makeTableListController($formInfo2);
        if($this->getIsItemSelected($FormsToGenerate,"list_code"))
        {
            $this->makeTableListCode($formInfo2);
        }
        if($this->getIsItemSelected($FormsToGenerate,"list_design"))
        {
            $this->makeTableListDesign($formInfo2);
            $this->saveFormInDB($ModuleID,$formInfo2['form']['name'],$formInfo2['form']['caption']);
        }
        if($this->getIsItemSelected($FormsToGenerate,"search_design"))
        {
            $this->setFormCaption("جستجوی " . "\" . \$this->Data['" . $TableName . "']->getTableTitle() . \"");
            $this->makeTableSearchDesign($formInfo2);
        }

        $formInfo['form']['name']=$TableName;
        $formInfo['form']['caption']=$TableName;
        $formInfo['form']['listname']=$TableName;
        $this->setFormName($formInfo['form']['name']);
        if($this->getIsItemSelected($FormsToGenerate,"android_class"))
        {

            $this->makeAndroidClass($formInfo);
            $this->makeAndroid_List_FragmentRecycler($formInfo);
            $this->makeAndroid_List_Fragment($formInfo);
            $this->makeAndroid_List_FragmentLayout($formInfo);
            $this->makeAndroid_List_ItemFragmentLayout($formInfo);
            $this->makeAndroid_Item_Fragment($formInfo);
            $this->makeAndroid_Item_FragmentLayout($formInfo);
        }

        $DBAccessor->close_connection();
    }

    protected function saveFormInDB($ModuleID,$FormName,$FormCaption)
    {
        $DBAccessor=new dbaccess();
        $Fent=new sfman_formEntity($DBAccessor);
        $q=new QueryLogic();
        $q->addCondition(new FieldCondition("name",$FormName));
        $q->addCondition(new FieldCondition("module_fid",$ModuleID));
        $Fent=$Fent->FindOne($q);
        if($Fent==null)
        {
            $Fent=new sfman_formEntity($DBAccessor);
            $Fent->Insert($FormName,$FormCaption,$ModuleID,true);
        }
        else
        {
            $ID=$Fent->getId();
            $Fent=new sfman_formEntity($DBAccessor);
            $Fent->Update($ID,$FormName,$FormCaption,$ModuleID,true);
        }
        $DBAccessor->close_connection();
    }

    protected function deletFormFromDB($ModuleID,$FormName)
    {
        $DBAccessor=new dbaccess();
        $Fent=new sfman_formEntity($DBAccessor);
        $q=new QueryLogic();
        $q->addCondition(new FieldCondition("name",$FormName));
        $q->addCondition(new FieldCondition("module_fid",$ModuleID));
        $Fent=$Fent->FindOne($q);
        if($Fent!=null)
        {
            $Fent->Delete($Fent->getId());
        }
        $DBAccessor->close_connection();
    }
    private function DeleteManageCodeFile($FilePath)
    {
        if(file_exists($FilePath))
            unlink($FilePath);

    }
    public function DeleteManageCodes($FormsToDelete,$ModuleID,$TableName)
    {
        $ModEnt=new sfman_moduleEntity(new dbaccess());
        $ModEnt->setId($ModuleID);
        $Module=$ModEnt->getName();
        $this->setCodeModuleName($Module);
        $this->setFormName("manage".$TableName);
        if($this->getIsItemSelected($FormsToDelete,"manage_item_controller"))
        {
            $file=$this->getControllerFile();
            $this->DeleteManageCodeFile($file);
        }
        if($this->getIsItemSelected($FormsToDelete,"manage_item_code"))
        {
            $file=$this->getCodeFile();
            $this->DeleteManageCodeFile($file);
            $this->deletFormFromDB($ModuleID,$this->getFormName());
        }
        if($this->getIsItemSelected($FormsToDelete,"manage_item_design"))
        {
            $file=$this->getDesignFile();
            $this->DeleteManageCodeFile($file);
        }

        if($this->getIsItemSelected($FormsToDelete,"manage_useritem_code"))
        {
            $this->setFormName("manageuser".$TableName);
            $file=$this->getCodeFile();
            $this->DeleteManageCodeFile($file);
            $this->deletFormFromDB($ModuleID,$this->getFormName());
        }

        $this->setFormName("manage".$TableName . "s");
        if($this->getIsItemSelected($FormsToDelete,"manage_list_controller"))
        {
            $file=$this->getControllerFile();
            $this->DeleteManageCodeFile($file);
        }
        if($this->getIsItemSelected($FormsToDelete,"manage_list_code"))
        {
            $file=$this->getCodeFile();
            $this->DeleteManageCodeFile($file);
            $this->deletFormFromDB($ModuleID,$this->getFormName());
        }
        if($this->getIsItemSelected($FormsToDelete,"manage_list_design"))
        {
            $file=$this->getDesignFile();
            $this->DeleteManageCodeFile($file);
        }
        if($this->getIsItemSelected($FormsToDelete,"manage_userlist_code"))
        {
            $this->setFormName("manageuser".$TableName . "s");$file=$this->getCodeFile();
            $file=$this->getCodeFile();
            $this->DeleteManageCodeFile($file);
            $this->deletFormFromDB($ModuleID,$this->getFormName());

        }

        $this->setFormName($TableName);
        if($this->getIsItemSelected($FormsToDelete,"item_display_controller"))
        {
            $file=$this->getControllerFile();
            $this->DeleteManageCodeFile($file);
        }
        if($this->getIsItemSelected($FormsToDelete,"item_display_code"))
        {
            $file=$this->getCodeFile();

            $this->DeleteManageCodeFile($file);
        }
        if($this->getIsItemSelected($FormsToDelete,"item_display_design"))
        {
            $file=$this->getDesignFile();
            $this->DeleteManageCodeFile($file);
            $this->deletFormFromDB($ModuleID,$this->getFormName());

        }


        $this->setFormName($TableName . "list");
        if($this->getIsItemSelected($FormsToDelete,"list_controller"))
        {
            $file=$this->getControllerFile();
            $this->DeleteManageCodeFile($file);
        }
        if($this->getIsItemSelected($FormsToDelete,"list_code"))
        {
            $file=$this->getCodeFile();
            $this->DeleteManageCodeFile($file);
        }
        if($this->getIsItemSelected($FormsToDelete,"list_design"))
        {
            $file=$this->getDesignFile();
            $this->DeleteManageCodeFile($file);
            $this->deletFormFromDB($ModuleID,$this->getFormName());

        }
        if($this->getIsItemSelected($FormsToDelete,"search_design"))
         {
             $this->setFormName($TableName . "listsearch");
                $file=$this->getDesignFile();
                $this->DeleteManageCodeFile($file);

         }
    }
    protected function getIsAdminModeDefine($ShowSetter)
    {
        $C=<<<EOT
\n\tprivate \$adminMode=true;
    public function getAdminMode()
    {
        return \$this->adminMode;
    }
    
EOT;
        if($ShowSetter)
            $C.=<<<EOT
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
    protected function SaveFile($File,$Content)
    {
        file_put_contents($File, $Content);
        chmod($File,0777);
    }
    protected abstract function makeUserManageCode($formName, $GeneralformInfo);
}

?>
