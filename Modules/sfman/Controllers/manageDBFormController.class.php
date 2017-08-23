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

class manageDBFormController extends baseFormCodeGenerator {
    private $TableName;
    private $TableFields;

    private $IsManagerForm=false;

	private function getTableFields($TableName)
    {
        $tblEnt=new sfman_tableEntity(null,$TableName);
        return $tblEnt->GetCollumns();
    }
    private function getFieldName($i)
    {
        $fl = $this->TableFields[$i];
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
    private function getEntityObjectFieldSetCode($ObjectName,$EntityClassName)
    {
        $InsertCode = "";
        for($i=0;$i<count($this->TableFields);$i++)
        {
            if(FieldType::getFieldType($this->TableFields[$i])!=FieldType::$METAINF && FieldType::getFieldType($this->TableFields[$i])!=FieldType::$ID){
                $UCField=$this->TableFields[$i];

                $InsertCode .= "\n\t\t\t$ObjectName" . "->set" . ucwords($UCField) . "(\$$UCField";
                if(FieldType::getFieldType($this->TableFields[$i])==FieldType::$FILE)
                    $InsertCode .="[0]['url']";
                $InsertCode .=");";
            }

        }
        return $InsertCode;
    }
    private function getIsItemSelected($FormsToGenerate,$ItemName)
    {
        if($FormsToGenerate!=null && array_search($ItemName,$FormsToGenerate)!==false)
            return true;
        return false;
    }
    public function generateManageForms($FormsToGenerate,$Module,$TableName)
	{
        $this->TableName=$TableName;
        $this->setCodeModuleName($Module);
        $fName=$TableName;
        $fName="manage" . $fName;
        $this->setFormName($fName);
        $this->setFormCaption($fName);
        $this->MakeModuleDirectories();
        $this->TableFields=$this->getTableFields($Module . "_" . $this->TableName);
        $formInfo['module']['name']=$Module;
        $formInfo['form']['name']="manage".$TableName;
        $formInfo['form']['caption']="manage ".$TableName;
        $skippedCollumns=0;
        for($i=0;$i<count($this->TableFields);$i++) {
            $E=$this->TableFields[$i];
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
                    $formInfo['elements'][$i-$skippedCollumns]['type_fid']=5;
                else
                    $formInfo['elements'][$i-$skippedCollumns]['type_fid']=2;
            }
        }
        $DBAccessor=new dbaccess();
        $eTEnt=new sfman_formelementtypeEntity($DBAccessor);
        $formInfo['elementtypes']=$eTEnt->Select(null,null,null,array('id'),array(false),"0,50");
        $DBAccessor->close_connection();

        $this->TableName=$TableName;
        $formInfo2=$formInfo;
        $formInfo2['elements'][$i-$skippedCollumns]['name']="btnSave";
        $formInfo2['elements'][$i-$skippedCollumns]['caption']="ذخیره";
        $formInfo2['elements'][$i-$skippedCollumns]['type_fid']=7;
        if($this->getIsItemSelected($FormsToGenerate,"manage_item_controller"))
            $this->makeTableItemManageController($formInfo2);
        if($this->getIsItemSelected($FormsToGenerate,"manage_item_code"))
            $this->makeTableItemManageCode($formInfo2);
        if($this->getIsItemSelected($FormsToGenerate,"manage_item_design"))
            $this->makeTableItemManageDesign($formInfo2);

        $formInfo['form']['name']="manage".$TableName . "s";
        $formInfo['form']['caption']=$formInfo['form']['name'];
        $this->setFormName($formInfo['form']['name']);
        $this->setFormCaption($formInfo['form']['name']);
        if($this->getIsItemSelected($FormsToGenerate,"manage_list_controller"))
            $this->makeTableManageListController($formInfo);
        if($this->getIsItemSelected($FormsToGenerate,"manage_list_code"))
            $this->makeTableManageListCode($formInfo);
        if($this->getIsItemSelected($FormsToGenerate,"manage_list_design"))
            $this->makeTableManageListDesign($formInfo);


        $formInfo['form']['name']=$TableName ;
        $formInfo['form']['caption']=$formInfo['form']['name'];
        $this->setFormName($formInfo['form']['name']);
        $this->setFormCaption($formInfo['form']['name']);
        if($this->getIsItemSelected($FormsToGenerate,"item_display_controller"))
            $this->makeTableItemController($formInfo);
        if($this->getIsItemSelected($FormsToGenerate,"item_display_code"))
            $this->makeTableItemCode($formInfo);
        if($this->getIsItemSelected($FormsToGenerate,"item_display_design"))
            $this->makeTableItemDesign($formInfo);


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
        $skippedCollumns=0;
        for($i=0;$i+$skippedCollumns<count($formInfo2['elements']);$i++) {
            if($formInfo2['elements'][$i]['type_fid']==6) {
                array_splice($formInfo2['elements'],$i + $skippedCollumns,1);
                $skippedCollumns++;
            }
        }
        $formInfo2['form']['name']=$TableName . "list";
        $formInfo2['form']['caption']=$formInfo2['form']['name'];
        $this->setFormName($formInfo2['form']['name']);
        $this->setFormCaption($formInfo2['form']['name']);
        if($this->getIsItemSelected($FormsToGenerate,"list_controller"))
            $this->makeTableListController($formInfo2);
        if($this->getIsItemSelected($FormsToGenerate,"list_code"))
            $this->makeTableListCode($formInfo2);
        if($this->getIsItemSelected($FormsToGenerate,"list_design"))
            $this->makeTableListDesign($formInfo2);

        if($this->getIsItemSelected($FormsToGenerate,"search_design"))
            $this->makeTableSearchDesign($formInfo2);



    }
    private function getTableItemControllerTopCode($formInfo)
    {
        $formName=$formInfo['form']['name'];
        $moduleName=$this->getCodeModuleName();
        $EntityNames=array();

        $EntityClassName=$moduleName . "_" . $this->TableName . "Entity";;
        $C = "<?php";
        $C .= $this->getControllerNamespaceDefiner();
        $C .= $this->getControllerUsage();
        $C .= "\nuse Modules\\$moduleName\\Entity\\$EntityClassName;";
        for($i=0;$i<count($this->TableFields);$i++) {
            $fl1=$this->getFieldName($i);
            if($fl1!=null && array_search($fl1,$EntityNames)==null) {
                $fl = $moduleName . "_" . $fl1 . "Entity";
                $C .= "\nuse Modules\\$moduleName\\Entity\\$fl;";
            }
            $EntityNames[$i]=$fl1;
        }
        $C.=$this->getFileInfoComment();
        $C .= "\nclass $formName" . "Controller extends Controller {";
        $C .= "\n\tpublic function load(\$ID)";
        $C .= "\n\t{";
        $C .= $this->getControllerActionInits();
        $ObjectName="\$" . $this->TableName . "EntityObject";
        $C .= "\n\t\t$ObjectName=new $EntityClassName(\$DBAccessor);";
        return $C;
    }
    private function getTableItemControllerLoadCode($formInfo)
    {
        $ObjectName="\$" . $this->TableName . "EntityObject";
        $C = "\n\t\tif(\$ID!=-1){";
        $C .= "\n\t\t\t$ObjectName" . "->setId(\$ID);";
        $C .= "\n\t\t\t" . "if($ObjectName" . "->getId()==-1)";
        $C .= "\n\t\t\t\tthrow new DataNotFoundException();";
        $C .= "\n\t\t\t\$result['".$this->TableName."']=$ObjectName;";

        return $C;
    }
    private function makeTableItemController($formInfo)
    {
        $moduleName=$this->getCodeModuleName();
        $C =$this->getTableItemControllerTopCode($formInfo);
        $C .= $this->getTableItemControllerLoadCode($formInfo);
        for($i=0;$i<count($this->TableFields);$i++) {
            $fl1=$this->getFieldName($i);
            if($fl1!=null && FieldType::getFieldType($this->TableFields[$i])==FieldType::$FID) {
                $fl = $moduleName . "_" . $fl1 . "Entity";
                $FiledName=substr($this->TableFields[$i],0,strlen($this->TableFields[$i])-4);
                $ObjectName2="\$" . $FiledName . "EntityObject";
                $C .= "\n\t\t\t$ObjectName2=new " .  $fl . "(\$DBAccessor);";
                $C .= "\n\t\t\t$ObjectName2" . "->SetId(\$result['".$this->TableName."']->get".ucwords($this->TableFields[$i])."());";
                $C .= "\n\t\t\tif($ObjectName2" . "->getId()==-1)";
                $C .= "\n\t\t\t\tthrow new DataNotFoundException();";
                $C .= "\n\t\t\t\$result['" . $this->TableFields[$i] . "']=$ObjectName2;";
            }
        }
        $C .="\n\t\t}";


        $C .= "\n\t\t\$result['param1']=\"\";";
        $C .= "\n\t\t\$DBAccessor->close_connection();";
        $C .= "\n\t\treturn \$result;";
        $C .= "\n\t}";
        $C .= "\n}";
        $C .= "\n?>";
        file_put_contents($this->getControllerFile(), $C);

        chmod($this->getControllerFile(),0777);

    }
    private function makeTableItemManageController($formInfo)
    {
        $moduleName=$this->getCodeModuleName();
        $C =$this->getTableItemControllerTopCode($formInfo);
        for($i=0;$i<count($this->TableFields);$i++) {
            $fl1=$this->getFieldName($i);
            if($fl1!=null &&  FieldType::getFieldType($this->TableFields[$i])==FieldType::$FID) {
                $fl = $moduleName . "_" . $fl1 . "Entity";
                $FiledName=substr($this->TableFields[$i],0,strlen($this->TableFields[$i])-4);
                $ObjectName2="\$" . $FiledName . "EntityObject";
                $C .= "\n\t\t\t$ObjectName2=new " .  $fl . "(\$DBAccessor);";
                $C .= "\n\t\t\t\$result['" . $this->TableFields[$i] . "']=$ObjectName2" . "->FindAll(new QueryLogic());";
            }
        }
        $C .= $this->getTableItemControllerLoadCode($formInfo);
        $C .="\n\t\t}";
        $C .= "\n\t\t\$result['param1']=\"\";";
        $C .= "\n\t\t\$DBAccessor->close_connection();";
        $C .= "\n\t\treturn \$result;";
        $C .= "\n\t}";

        for($i=0;$i<count($formInfo['elements']);$i++)
            if($formInfo['elements'][$i]['type_fid']==7)
                $C.=$this->getActionFormController($formInfo,$formInfo['elements'][$i]['name']);

        $C .= "\n}";
        $C .= "\n?>";
        file_put_contents($this->getControllerFile(), $C);

        chmod($this->getControllerFile(),0777);

    }
    private function getTableItemDesignElementDefineCode($formInfo,$i)
    {
        $E = $formInfo['elements'][$i];
        $ind = $this->getTypeIndex($formInfo['elementtypes'], $E['type_fid']);
        $EType = $formInfo['elementtypes'][$ind]['name'];
        $C = "\n\t/**";
        $C .= " @var $EType";
        $C .= " */";
        $C .= "\n\tprivate \$" . $E['name'] . ";";
        if ($E['type_fid'] == 2 || $E['type_fid'] == 3 || $E['type_fid'] == 4 || $E['type_fid'] == 5 || $E['type_fid'] == 6 || $E['type_fid'] == 8)
            $C .= $this->getGetterCode($E['name'], $EType);
        return $C;
    }
	private function getFieldFillCode($formInfo,$AddEmptyOption=false)
    {
        $TableName=$this->TableName;
        $FieldFillCode="";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $Ename=$formInfo['elements'][$i]['name'];

            $FT=FieldType::getFieldType($Ename);
            if($FT!=FieldType::$METAINF && $FT!=FieldType::$ID && $Ename!="sortby" && $Ename!="isdesc") {
                if($formInfo['elements'][$i]['type_fid']==3) {
                    if($AddEmptyOption)
                        $FieldFillCode .= "\r\n\t\t\t\$this->$Ename" . "->addOption(\"\", \"مهم نیست\");";
                    $FieldFillCode .= "\r\n\t\tforeach (\$this->Data['$Ename'] as \$item)";
                    $FieldFillCode .= "\r\n\t\t\t\$this->$Ename" . "->addOption(\$item->getID(), \$item->getTitle());";
                    $FieldFillCode .= "\r\n\t\tif (key_exists(\"$TableName\", \$this->Data))";
                    $FieldFillCode .= "\r\n\t\t\t\$this->$Ename" . "->setSelectedValue(\$this->Data['$TableName']->get" . ucwords($Ename) . "());";
                }
                elseif($formInfo['elements'][$i]['type_fid']==2) {
                    $FieldFillCode .= "\r\n\t\tif (key_exists(\"$TableName\", \$this->Data))";
                    $FieldFillCode .= "\r\n\t\t\t\$this->$Ename" . "->setValue(\$this->Data['$TableName']->get" . ucwords($Ename) . "());";
                }
                elseif($formInfo['elements'][$i]['type_fid']==5) {

                    $FieldFillCode .= "\r\n\t\t\$this->$Ename" . "->addOption(\"$Ename\",\"1\");";
                    $FieldFillCode .= "\r\n\t\tif (key_exists(\"$TableName\", \$this->Data))";
                    $FieldFillCode .= "\r\n\t\t\t\$this->$Ename" . "->addSelectedValue(\$this->Data['$TableName']->get" . ucwords($Ename) . "());";
                }
            }
        }
        return $FieldFillCode;
    }
    private function makeTableItemManageDesign($formInfo)
    {
        $FormName=$formInfo['form']['name'];
        $C = "<?php";
        $C .= $this->getFormNamespaceDefiner();
        $C.=$this->getDesignUsings();
        $C.=$this->getFileInfoComment();
        $C .= "\nclass " . $FormName . "_Design extends FormDesign {";
        $C .= "\n\tprivate \$Data;";

        $C.=$this->getSetterCode("Data","mixed");
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $C.=$this->getTableItemDesignElementDefineCode($formInfo,$i);
        }



        $C .="\n\tpublic function __construct()";
        $C .="\n\t{";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $C.=$this->getDesignInitialization($formInfo,$i);
        }
        $C .="\n\t}";



        $C .="\n\tpublic function getBodyHTML(\$command=null)";
        $C .="\n\t{";
        $C.=$this->getFieldFillCode($formInfo);
        $C .=$this->getDesignTopPartCode();
        $C .="\n\t\t\$LTable1=new ListTable(2);";
        $C .="\n\t\t\$LTable1->setClass(\"formtable\");";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $C .=$this->getDesignAddCode($formInfo,$i);
        }

        $C .="\n\t\t\$Page->addElement(\$LTable1);";
        $C .="\n\t\t\$form=new SweetFrom(\"\", \"POST\", \$Page);";
        $C .="\n\t\treturn \$form->getHTML();";
        $C .="\n\t}";
        $C .= "\n}";

        $C .= "\n?>";
        file_put_contents($this->getDesignFile(), $C);

        chmod($this->getDesignFile(),0777);

    }
    private function makeTableItemDesign($formInfo)
    {
        $TableName=$this->TableName;
        $FormName=$formInfo['form']['name'];
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $formInfo['elements'][$i]['type_fid'] = 1;//Label
        }
        $C = "<?php";
        $C .= $this->getFormNamespaceDefiner();
        $C.=$this->getDesignUsings();
        $C.=$this->getFileInfoComment();
        $C .= "\nclass " . $FormName . "_Design extends FormDesign {";
        $C .= "\n\tprivate \$Data;";

        $C.=$this->getSetterCode("Data","mixed");


        for($i=0;$i<count($formInfo['elements']);$i++) {
            $ft=FieldType::getFieldType($formInfo['elements'][$i]['name']);
            if($ft==FieldType::$NORMAL || $ft==FieldType::$BOOLEAN || $ft==FieldType::$FID|| $ft==FieldType::$FILE)
            $C.=$this->getTableItemDesignElementDefineCode($formInfo,$i);
        }
        $C .="\n\tpublic function __construct()";
        $C .="\n\t{";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $ft=FieldType::getFieldType($formInfo['elements'][$i]['name']);
            if($ft==FieldType::$NORMAL || $ft==FieldType::$BOOLEAN || $ft==FieldType::$FID || $ft==FieldType::$FILE)
            $C.=$this->getDesignInitialization($formInfo,$i);
        }
        $C .="\n\t}";



        $C .="\n\tpublic function getBodyHTML(\$command=null)";
        $C .="\n\t{";
        $C .=$this->getDesignTopPartCode();
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $Ename=$formInfo['elements'][$i]['name'];
            if(FieldType::getFieldType($Ename)==FieldType::$NORMAL || FieldType::getFieldType($Ename)==FieldType::$FILE) {
                $Val="\$this->Data['$TableName']->get" . ucwords($Ename) . "()";
                $C .= "\r\n\t\tif (key_exists(\"$TableName\", \$this->Data)){";
                //$C .= "\r\n\t\t\t\$this->$Ename" . "=new Lable($Val);";
                $C .= "\r\n\t\t\t\$this->$Ename" . "->setText($Val);";
                $C .= "\r\n\t\t}";
            }
            elseif(FieldType::getFieldType($Ename)==FieldType::$FID) {
                $Val="\$this->Data['$Ename']->getID()";
                $C .= "\r\n\t\tif (key_exists(\"$Ename\", \$this->Data)){";
                $C .= "\r\n\t\t\t\$this->$Ename" . "->setText($Val);";
                $C .= "\r\n\t\t}";
            }
        }
        $C .="\n\t\t\$LTable1=new ListTable(2);";
        $C .="\n\t\t\$LTable1->setClass(\"formtable\");";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $E=$formInfo['elements'][$i];
            $C.="\n\t\t\$LTable1->addElement(new Lable(\"" . $E['name'] .  "\"));";
            $C .="\n\t\t\$LTable1->setLastElementClass('form_item_titlelabel');";
            $C.="\n\t\t\$LTable1->addElement(\$this->".$E['name'].");";
            $C .="\n\t\t\$LTable1->setLastElementClass('form_item_datalabel');";
        }

        $C .="\n\t\t\$Page->addElement(\$LTable1);";
        $C .="\n\t\t\$form=new SweetFrom(\"\", \"POST\", \$Page);";
        $C .="\n\t\treturn \$form->getHTML();";
        $C .="\n\t}";
        $C .= "\n}";

        $C .= "\n?>";
        file_put_contents($this->getDesignFile(), $C);

        chmod($this->getDesignFile(),0777);

    }
    private function getPaginationPartCode($forminfo)
    {
        $FormName=$forminfo['form']['name'];
        $C = "\n\tprivate function getPaginationPart(\$PageCount)";
        $C .= "\n\t{";
        $C .= "\n\t\t\$div=new Div();";
        $C .= "\n\t\tfor(\$i=1;\$i<=\$PageCount;\$i++)";
        $C .= "\n\t\t{";
        $C .= "\n\t\t\t\$RTR=null;";
        $C .= "\n\t\t\tif(isset(\$_GET['action']) && \$_GET['action']==\"search_Click\")";
        $C .= "\n\t\t\t\t\$RTR=new AppRooter(\"" . $this->getCodeModuleName() . "\",\"$FormName\");";
        $C .= "\n\t\t\telse";
        $C .= "\n\t\t\t{";
        $C .= "\n\t\t\t\t\$RTR=new AppRooter(\"" . $this->getCodeModuleName() . "\",\"$FormName\");";
        $C .= "\n\t\t\t\t//\$RTR->addParameter(new UrlParameter(\"g\",\$this->Data['groupid']));";
        $C .= "\n\t\t\t}";
        $C .= "\n\t\t\t\$RTR->addParameter(new UrlParameter(\"pn\",\$i));";
        $C .= "\n\t\t\t\$RTR->setAppendToCurrentParams(false);";
        $C .= "\n\t\t\t\$lbl=new Lable(\$i);";
        $C .= "\n\t\t\t\$lnk=new link(\$RTR->getAbsoluteURL(),\$lbl);";
        $C .= "\n\t\t\t\$div->addElement(\$lnk);";
        $C .= "\n\t\t}";
        $C .= "\n\t\treturn \$div;";
        $C .= "\n\t}";
        return $C;
    }
    private function makeTableManageListDesign($formInfo)
    {
        $TableName=$this->TableName;
        $ModuleName=$formInfo['module']['name'];
        $FormName=$formInfo['form']['name'];
        $C = "<?php";
        $C .= $this->getFormNamespaceDefiner();
        $C.=$this->getDesignUsings();
        $C.=$this->getFileInfoComment();
        $C .= "\nclass " . $FormName . "_Design extends FormDesign {";
        $C .= "\n\tprivate \$Data;";
        $C.=$this->getSetterCode("Data","mixed");
        $C .="\n\tpublic function __construct()";
        $C .="\n\t{";
        $C .="\n\t}";
        $C .="\n\tpublic function getBodyHTML(\$command=null)";
        $C .="\n\t{";
        $C .=$this->getDesignTopPartCode();
        $C .="\n\t\t\$addUrl=new AppRooter('$ModuleName','manage$TableName');";
        $C .="\n\t\t\$LblAdd=new Lable('Add New Item');";
        $C .="\n\t\t\$lnkAdd=new link(\$addUrl->getAbsoluteURL(),\$LblAdd);";
        $C .="\n\t\t\$lnkAdd->setClass('linkbutton');";
        $C .="\n\t\t\$lnkAdd->setId('add" . $TableName . "link');";
        $C .="\n\t\t\$Page->addElement(\$lnkAdd);";
        $C .="\n\t\t\$LTable1=new ListTable(3);";
        $C .="\n\t\t\$LTable1->setClass(\"managelist\");";
        $C .="\n\t\t\$LTable1->addElement(new Lable('#'));";
        $C .="\n\t\t\$LTable1->setLastElementClass(\"listtitle\");";
        $C .="\n\t\t\$LTable1->addElement(new Lable('عنوان'));";
        $C .="\n\t\t\$LTable1->setLastElementClass(\"listtitle\");";
        $C .="\n\t\t\$LTable1->addElement(new Lable('عملیات'));";
        $C .="\n\t\t\$LTable1->setLastElementClass(\"listtitle\");";
        $C .="\n\t\tfor(\$i=0;\$i<count(\$this->Data['data']);\$i++){";
        $C .="\n\t\t\t\$url=new AppRooter('$ModuleName','manage$TableName');";
        $C .="\n\t\t\t\$url->addParameter(new UrlParameter('id',\$this->Data['data'][\$i]->getID()));";
        $C .="\n\t\t\t\$delurl=new AppRooter('$ModuleName','manage" . $TableName . "s');";
        $C .="\n\t\t\t\$delurl->addParameter(new UrlParameter('id',\$this->Data['data'][\$i]->getID()));";
        $C .="\n\t\t\t\$delurl->addParameter(new UrlParameter('delete',1));";
        $C .="\n\t\t\t\t\$Title=\$this->Data['data'][\$i]->get".ucwords($this->TableFields[1])."();";
        $C .="\n\t\t\tif(\$this->Data['data'][\$i]->get".ucwords($this->TableFields[1])."()==\"\")";
        $C .="\n\t\t\t\t\$Title='******************';";
        $C .="\n\t\t\t\$lbTit[\$i]=new Lable(\$Title);";
        $C .="\n\t\t\t\$liTit[\$i]=new link(\$url->getAbsoluteURL(),\$lbTit[\$i]);";
        $C .="\n\t\t\t\$lbDel[\$i]=new Lable('حذف');";
        $C .="\n\t\t\t\$liDel[\$i]=new link(\$delurl->getAbsoluteURL(),\$lbDel[\$i]);";
        $C .="\n\t\t\t\$LTable1->addElement(new Lable(\$i+1));";
        $C .="\n\t\t\t\$LTable1->setLastElementClass(\"listcontent\");";
        $C .="\n\t\t\t\$LTable1->addElement(\$liTit[\$i]);";
        $C .="\n\t\t\t\$LTable1->setLastElementClass(\"listcontent\");";
        $C .="\n\t\t\t\$LTable1->addElement(\$liDel[\$i]);";
        $C .="\n\t\t\t\$LTable1->setLastElementClass(\"listcontent\");";
        $C .="\n\t\t}";
        $C .="\n\t\t\$Page->addElement(\$LTable1);";
        $C .="\n\t\t\$Page->addElement(\$this->getPaginationPart(\$this->Data['pagecount']));";
        $C .="\n\t\t\$form=new SweetFrom(\"\", \"POST\", \$Page);";
        $C .="\n\t\treturn \$form->getHTML();";
        $C .="\n\t}";
        $C .=$this->getPaginationPartCode($formInfo);
        $C .= "\n}";

        $C .= "\n?>";
        file_put_contents($this->getDesignFile(), $C);

        chmod($this->getDesignFile(),0777);

    }
    private function makeTableListDesign($formInfo)
    {
        $TableName=$this->TableName;
        $ModuleName=$formInfo['module']['name'];
        $FormName=$formInfo['form']['name'];
        $C = "<?php";
        $C .= $this->getFormNamespaceDefiner();
        $C.=$this->getDesignUsings();
        $C.=$this->getFileInfoComment();
        $C .= "\nclass " . $FormName . "_Design extends FormDesign {";
        $C .= "\n\tprivate \$Data;";
        $C.=$this->getSetterCode("Data","mixed");
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $C.=$this->getTableItemDesignElementDefineCode($formInfo,$i);
        }
        $C .="\n\tpublic function __construct()";
        $C .="\n\t{";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $C.=$this->getDesignInitialization($formInfo,$i);
        }
        $C .="\n\t}";
        $C .="\n\tpublic function getBodyHTML(\$command=null)";
        $C .="\n\t{";
        $C.=$this->getFieldFillCode($formInfo,true);
        $C .=$this->getDesignTopPartCode();
        $C .="\n\t\t\$LTable1=new ListTable(4);";
        $C .="\n\t\t\$LTable1->setClass(\"searchtable\");";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $C .=$this->getDesignAddCode($formInfo,$i);
        }

        $C .= "\n\t\t\t\$this->isdesc->addOption('0','صعودی');";
        $C .= "\n\t\t\t\$this->isdesc->addOption('1','نزولی');";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $E=$formInfo['elements'][$i];
            $C .= "\n\t\t\t\$this->sortby->addOption('".$E['name']."','".$E['name']."');";
            if($E['type_fid']==2) {

                $C .= "\n\t\tif(isset(\$_GET['". $E['name'] . "']))";
                $C .= "\n\t\t\t\$this->" . $E['name'] . "->setValue(\$_GET['" . $E['name'] . "']);";
            }
            if($E['type_fid']==3 || $E['type_fid']==4 || $E['type_fid']==8) {

                $C .= "\n\t\tif(isset(\$_GET['". $E['name'] . "']))";
                $C .= "\n\t\t\t\$this->" . $E['name'] . "->setSelectedValue(\$_GET['" . $E['name'] . "']);";
            }
            if($E['type_fid']==5) {

                $C .= "\n\t\tif(isset(\$_GET['". $E['name'] . "']))";
                $C .= "\n\t\t\t\$this->" . $E['name'] . "->addSelectedValue(\$_GET['" . $E['name'] . "']);";
            }
        }
        $C .="\n\t\t\$Page->addElement(\$LTable1);";
        $C .="\n\t\t\$Div1=new Div();";
        $C .="\n\t\t\$Div1->setClass(\"list\");";
        $C .="\n\t\tif(count(\$this->Data['data'])==0)";
        $C .="\n\t\t{";
        $C .="\n\t\t\tif(isset(\$_GET['action']) && \$_GET['action']==\"search_Click\")";
        $C .="\n\t\t\t\t\$Div1->addElement(new Lable(\"هیچ آیتمی با مشخصات وارد شده پیدا نشد.\"));";
        $C .="\n\t\t\telse";
        $C .="\n\t\t\t\t\$Div1->addElement(new Lable(\"هیچ آیتمی برای نمایش وجود ندارد.\"));";
        $C .="\n\t\t}";
        $C .="\n\t\tfor(\$i=0;\$i<count(\$this->Data['data']);\$i++){";

        $C .="\n\t\t\$innerDiv[\$i]=new Div();";
        $C .="\n\t\t\$innerDiv[\$i]->setClass(\"listitem\");";
        $C .="\n\t\t\t\$url=new AppRooter('$ModuleName','$TableName');";
        $C .="\n\t\t\t\$url->addParameter(new UrlParameter('id',\$this->Data['data'][\$i]->getID()));";
        $C .="\n\t\t\t\t\$Title=\$this->Data['data'][\$i]->get".ucwords($this->TableFields[1])."();";
        $C .="\n\t\t\tif(\$this->Data['data'][\$i]->get".ucwords($this->TableFields[1])."()==\"\")";
        $C .="\n\t\t\t\t\$Title='----------';";
        $C .="\n\t\t\t\$lbTit[\$i]=new Lable(\$Title);";
        $C .="\n\t\t\t\$liTit[\$i]=new link(\$url->getAbsoluteURL(),\$lbTit[\$i]);";
        $C .="\n\t\t\t\$innerDiv[\$i]->addElement(\$liTit[\$i]);";
        $C .="\n\t\t\t\$Div1->addElement(\$innerDiv[\$i]);";
        $C .="\n\t\t}";
        $C .="\n\t\t\$Page->addElement(\$Div1);";
        $C .="\n\t\t\$Page->addElement(\$this->getPaginationPart(\$this->Data['pagecount']));";
        $C .="\n\t\t\$form=new SweetFrom(\"\", \"GET\", \$Page);";
        $C .="\n\t\treturn \$form->getHTML();";
        $C .="\n\t}";

        $C .=$this->getPaginationPartCode($formInfo);
        $C .= "\n}";

        $C .= "\n?>";
        file_put_contents($this->getDesignFile(), $C);

        chmod($this->getDesignFile(),0777);

    }

    private function makeTableSearchDesign($formInfo)
    {
        $TableName=$this->TableName;
        $ModuleName=$formInfo['module']['name'];
        $FormName=$formInfo['form']['name'];
        $C = "<?php";
        $C .= $this->getFormNamespaceDefiner();
        $C.=$this->getDesignUsings();
        $C.=$this->getFileInfoComment();
        $C .= "\nclass " . $FormName . "search_Design extends FormDesign {";
        $C .= "\n\tprivate \$Data;";
        $C.=$this->getSetterCode("Data","mixed");
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $C.=$this->getTableItemDesignElementDefineCode($formInfo,$i);
        }
        $C .="\n\tpublic function __construct()";
        $C .="\n\t{";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $C.=$this->getDesignInitialization($formInfo,$i);
        }
        $C .="\n\t}";
        $C .="\n\tpublic function getBodyHTML(\$command=null)";
        $C .="\n\t{";
        $C.=$this->getFieldFillCode($formInfo,true);
        $C .=$this->getDesignTopPartCode();
        $C .="\n\t\t\$LTable1=new ListTable(4);";
        $C .="\n\t\t\$LTable1->setClass(\"searchtable\");";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $C .=$this->getDesignAddCode($formInfo,$i);
        }

        $C .= "\n\t\t\t\$this->isdesc->addOption('0','صعودی');";
        $C .= "\n\t\t\t\$this->isdesc->addOption('1','نزولی');";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $E=$formInfo['elements'][$i];
            $C .= "\n\t\t\t\$this->sortby->addOption('".$E['name']."','".$E['name']."');";
            if($E['type_fid']==2) {

                $C .= "\n\t\tif(isset(\$_GET['". $E['name'] . "']))";
                $C .= "\n\t\t\t\$this->" . $E['name'] . "->setValue(\$_GET['" . $E['name'] . "']);";
            }
            if($E['type_fid']==3 || $E['type_fid']==4 || $E['type_fid']==8) {

                $C .= "\n\t\tif(isset(\$_GET['". $E['name'] . "']))";
                $C .= "\n\t\t\t\$this->" . $E['name'] . "->setSelectedValue(\$_GET['" . $E['name'] . "']);";
            }
            if($E['type_fid']==5) {

                $C .= "\n\t\tif(isset(\$_GET['". $E['name'] . "']))";
                $C .= "\n\t\t\t\$this->" . $E['name'] . "->addSelectedValue(\$_GET['" . $E['name'] . "']);";
            }
        }
        $C .="\n\t\t\$Page->addElement(\$LTable1);";
        $C .="\n\t\t\$form=new SweetFrom(\"\", \"GET\", \$Page);";
        $C .="\n\t\treturn \$form->getHTML();";
        $C .="\n\t}";
        $C .= "\n}";

        $C .= "\n?>";

        $DesignFile=$this->getFormDir() . "/" .  $FormName ."search_Design.design.php";
        file_put_contents($DesignFile, $C);

        chmod($this->getDesignFile(),0777);

    }

    private function fillGETParamValueGetters($formInfo,&$Params,&$GetterCode)
    {
        $formName=$formInfo['form']['name'];
        $moduleName=$formInfo['module']['name'];
        $Params="";
        $C="";
        for($i=0;$i<count($formInfo['elements']);$i++)
        {
            $E=$formInfo['elements'][$i];
            if($E['type_fid']==2)//TextBox
            {
                $ParamName="\$" . $E['name'];
                $C.="\n\t\t$ParamName=\$_GET['" . $E['name'] . "'];";
                if($Params!="")
                    $Params.=",";
                $Params.=$ParamName;
            }
            else if($E['type_fid']==3)//ComboBox
            {
                $ParamName="\$" . $E['name'] . "_ID";
                $C.="\n\t\t$ParamName=\$_GET['" . $E['name'] . "'];";
                if($Params!="")
                    $Params.=",";
                $Params.=$ParamName;

            }
            else if($E['type_fid']==4)//DataComboBox
            {
                $ParamName="\$" . $E['name'] . "_ID";
                $C.="\n\t\t$ParamName=\$_GET['" . $E['name'] . "'];";
                if($Params!="")
                    $Params.=",";
                $Params.=$ParamName;
            }
            else if($E['type_fid']==5)//CheckBox
            {
                $ParamName="\$" . $E['name'] ;
                $C.="\n\t\t$ParamName=\$_GET['" . $E['name'] . "'];";
                if($Params!="")
                    $Params.=",";
                $Params.=$ParamName;
            }
            /*else if($E['type_fid']==6)//FileUploadBox
            {
                $ParamName1="\$" . $E['name'] . "Paths" ;
                $ParamName2="\$" . $E['name'] . "Names" ;
                $ParamName3="\$" . $E['name'] . "URLs" ;
                $C.="\n\t\t$ParamName1=\$design->get" . ucwords($E['name']) . "()->getSelectedFilesTempPath();";
                $C.="\n\t\t$ParamName2=\$design->get" . ucwords($E['name']) . "()->getSelectedFilesName();";
                $C.="\n\t\t$ParamName3=array();";
                $C.="\n\t\tfor(\$fileIndex=0;\$fileIndex<count($ParamName1);\$fileIndex++){";
                $C.="\n\t\t\t$ParamName3" . "[\$fileIndex]=uploadHelper::UploadFile($ParamName1"."[\$fileIndex], $ParamName2"."[\$fileIndex], \"content/files/$moduleName/$formName/\");";
                $C.="\n\t\t}";


                if($Params!="")
                    $Params.=",";
                $Params.=$ParamName3;
            }*/
            /*else if($E['type_fid']==7)//SweetButton
            {
            }*/
            else if($E['type_fid']==8)//RadioBox
            {
                $ParamName="\$" . $E['name'] ;
                $C.="\n\t\t$ParamName=\$_GET['" . $E['name'] . "'];";
                if($Params!="")
                    $Params.=",";
                $Params.=$ParamName;
            }
        }
        $GetterCode=$C;
    }
    private function fillPostParamValueGetters($formInfo,&$Params,&$GetterCode)
    {
        $formName=$formInfo['form']['name'];
        $moduleName=$formInfo['module']['name'];
        $Params="";
        $C="";
        for($i=0;$i<count($formInfo['elements']);$i++)
        {
            $E=$formInfo['elements'][$i];
            if($E['type_fid']==2)//TextBox
            {
                $ParamName="\$" . $E['name'];
                $C.="\n\t\t$ParamName=\$design->get" . ucwords($E['name']) . "()->getValue();";
                if($Params!="")
                    $Params.=",";
                $Params.=$ParamName;
            }
            else if($E['type_fid']==3)//ComboBox
            {
                $ParamName="\$" . $E['name'] . "_ID";
                $C.="\n\t\t$ParamName=\$design->get" . ucwords($E['name']) . "()->getSelectedID();";
                if($Params!="")
                    $Params.=",";
                $Params.=$ParamName;

            }
            else if($E['type_fid']==4)//DataComboBox
            {
                $ParamName="\$" . $E['name'] . "_ID";
                $C.="\n\t\t$ParamName=\$design->get" . ucwords($E['name']) . "()->getSelectedID();";
                if($Params!="")
                    $Params.=",";
                $Params.=$ParamName;
            }
            else if($E['type_fid']==5)//CheckBox
            {
                $ParamName="\$" . $E['name'] ;
                $C.="\n\t\t$ParamName=\$design->get" . ucwords($E['name']) . "()->getSelectedValues();";
                if($Params!="")
                    $Params.=",";
                $Params.=$ParamName;
            }
            else if($E['type_fid']==6)//FileUploadBox
            {
                $ParamName1="\$" . $E['name'] . "Paths" ;
                $ParamName2="\$" . $E['name'] . "Names" ;
                $ParamName3="\$" . $E['name'] . "URLs" ;
                $C.="\n\t\t$ParamName1=\$design->get" . ucwords($E['name']) . "()->getSelectedFilesTempPath();";
                $C.="\n\t\t$ParamName2=\$design->get" . ucwords($E['name']) . "()->getSelectedFilesName();";
                $C.="\n\t\t$ParamName3=array();";
                $C.="\n\t\tfor(\$fileIndex=0;\$fileIndex<count($ParamName1);\$fileIndex++){";
                $C.="\n\t\t\t$ParamName3" . "[\$fileIndex]=uploadHelper::UploadFile($ParamName1"."[\$fileIndex], $ParamName2"."[\$fileIndex], \"content/files/$moduleName/$formName/\");";
                $C.="\n\t\t}";


                if($Params!="")
                    $Params.=",";
                $Params.=$ParamName3;
            }
            else if($E['type_fid']==7)//SweetButton
            {
            }
            else if($E['type_fid']==8)//RadioBox
            {
                $ParamName="\$" . $E['name'] ;
                $C.="\n\t\t$ParamName=\$design->get" . ucwords($E['name']) . "()->getSelectedValue();";
                if($Params!="")
                    $Params.=",";
                $Params.=$ParamName;
            }
        }
        $GetterCode=$C;
    }
    private function getActionFormCode($formInfo,$ActionName,$FirstParam="\$this->getID(),",$ParamMethodisPost=true)
    {
        $formName=$formInfo['form']['name'];
        $moduleName=$formInfo['module']['name'];
        $C = "\n\tpublic function $ActionName". "_Click()";
        $C .= "\n\t{";
        $C .= $this->getFormCodeActionInits();
        $C .= "\n\t\ttry{";
        $C .= "\n\t\t\$design=new $formName" . "_Design();";
        $GetterCode="";
        $Params="";
        if($ParamMethodisPost)
        $this->fillPostParamValueGetters($formInfo,$Params,$GetterCode);
        else
        $this->fillGETParamValueGetters($formInfo,$Params,$GetterCode);
        $C.=$GetterCode;

        $C .= "\n\t\t\$Result=\$$formName" . "Controller->" . ucwords($ActionName) . "($FirstParam" . "$Params);";
        $C .= "\n\t\t\$design->setData(\$Result);";
        $C .= "\n\t\t\$design->setMessage(\"$ActionName is done!\");";
        $C .= "\n\t\t}";
        $C .= $this->getNotFoundCatchPart();
        $C .= $this->getUnknownCatchPart();
        $C .= "\n\t\treturn \$design->getBodyHTML();";
        $C .= "\n\t}";
        return $C;
    }
    private function getActionUsingGetFormCode($formInfo,$ActionName,$FirstParam="\$this->getID(),")
    {
        $formName=$formInfo['form']['name'];
        $moduleName=$formInfo['module']['name'];
        $C = "\n\tpublic function $ActionName". "_Click()";
        $C .= "\n\t{";
        $C .= $this->getFormCodeActionInits();
        $C .= "\n\t\ttry{";
        $C .= "\n\t\t\$design=new $formName" . "_Design();";
        $Params="";
        for($i=0;$i<count($formInfo['elements']);$i++)
        {
            $E=$formInfo['elements'][$i];
            if($E['type_fid']==2)//TextBox
            {
                $ParamName="\$" . $E['name'];
                $C.="\n\t\t$ParamName=\$design->get" . ucwords($E['name']) . "()->getValue();";
                if($Params!="")
                    $Params.=",";
                $Params.=$ParamName;
            }
            else if($E['type_fid']==3)//ComboBox
            {
                $ParamName="\$" . $E['name'] . "_ID";
                $C.="\n\t\t$ParamName=\$design->get" . ucwords($E['name']) . "()->getSelectedID();";
                if($Params!="")
                    $Params.=",";
                $Params.=$ParamName;

            }
            else if($E['type_fid']==4)//DataComboBox
            {
                $ParamName="\$" . $E['name'] . "_ID";
                $C.="\n\t\t$ParamName=\$design->get" . ucwords($E['name']) . "()->getSelectedID();";
                if($Params!="")
                    $Params.=",";
                $Params.=$ParamName;
            }
            else if($E['type_fid']==5)//CheckBox
            {
                $ParamName="\$" . $E['name'] ;
                $C.="\n\t\t$ParamName=\$design->get" . ucwords($E['name']) . "()->getSelectedValues();";
                if($Params!="")
                    $Params.=",";
                $Params.=$ParamName;
            }
            else if($E['type_fid']==6)//FileUploadBox
            {
                $ParamName1="\$" . $E['name'] . "Paths" ;
                $ParamName2="\$" . $E['name'] . "Names" ;
                $ParamName3="\$" . $E['name'] . "URLs" ;
                $C.="\n\t\t$ParamName1=\$design->get" . ucwords($E['name']) . "()->getSelectedFilesTempPath();";
                $C.="\n\t\t$ParamName2=\$design->get" . ucwords($E['name']) . "()->getSelectedFilesName();";
                $C.="\n\t\t$ParamName3=array();";
                $C.="\n\t\tfor(\$fileIndex=0;\$fileIndex<count($ParamName1);\$fileIndex++){";
                $C.="\n\t\t\t$ParamName3" . "[\$fileIndex]=uploadHelper::UploadFile($ParamName1"."[\$fileIndex], $ParamName2"."[\$fileIndex], \"content/files/$moduleName/$formName/\");";
                $C.="\n\t\t}";


                if($Params!="")
                    $Params.=",";
                $Params.=$ParamName3;
            }
            else if($E['type_fid']==7)//SweetButton
            {
            }
            else if($E['type_fid']==8)//RadioBox
            {
                $ParamName="\$" . $E['name'] ;
                $C.="\n\t\t$ParamName=\$design->get" . ucwords($E['name']) . "()->getSelectedValue();";
                if($Params!="")
                    $Params.=",";
                $Params.=$ParamName;
            }
        }

        $C .= "\n\t\t\$Result=\$$formName" . "Controller->" . ucwords($ActionName) . "($FirstParam" . "$Params);";
        $C .= "\n\t\t\$design->setData(\$Result);";
        $C .= "\n\t\t\$design->setMessage(\"$ActionName is done!\");";
        $C .= "\n\t\t}";
        $C .= $this->getNotFoundCatchPart();
        $C .= $this->getUnknownCatchPart();
        $C .= "\n\t\treturn \$design->getBodyHTML();";
        $C .= "\n\t}";
        return $C;
    }

    private function getTableItemCode($formInfo)
    {
        $formName=$formInfo['form']['name'];

        $C = "<?php";
        $C .=$this->getFormNamespaceDefiner();
        $C .= $this->getFormCodeUsage();
        $C.=$this->getFileInfoComment();

        $C .= "\nclass " . $formInfo['form']['name'] . "_Code extends FormCode {";
        $C .= "\n\tpublic function load()";
        $C .= "\n\t{";
        $C .= $this->getFormCodeActionInits();
        $C .= "\n\t\ttry{";
        $C .= "\n\t\t\t\$Result=\$$formName" . "Controller->load(\$this->getID());";
        $C .= "\n\t\t\t\$design=new $formName" . "_Design();";
        $C .= "\n\t\t\t\$design->setData(\$Result);";
        $C .= "\n\t\t\t\$design->setMessage(\"\");";
        $C .= "\n\t\t}";
        $C .= $this->getNotFoundCatchPart();
        $C .= $this->getUnknownCatchPart();
        $C .= "\n\t\treturn \$design->getBodyHTML();";
        $C .= "\n\t}";
        $C .= "\n\tpublic function getID()";
        $C .= "\n\t{";
        $C .= "\n\t\t\$id=-1;";
        $C .= "\n\t\tif(isset(\$_GET['id']))";
        $C .= "\n\t\t\t\$id=\$_GET['id'];";
        $C .= "\n\t\treturn \$id;";
        $C .= "\n\t}";
        return $C;
    }
	private function makeTableItemManageCode($formInfo)
	{
		$formName=$formInfo['form']['name'];
		$C=$this->getTableItemCode($formInfo);
		for($i=0;$i<count($formInfo['elements']);$i++)
			if($formInfo['elements'][$i]['type_fid']==7)
				$C.=$this->getActionFormCode($formInfo,$formInfo['elements'][$i]['name']);
		$C .= "\n}";
		$C .= "\n?>";
		file_put_contents($this->getCodeFile(), $C);

		chmod($this->getCodeFile(),0777);

	}
    private function makeTableItemCode($formInfo)
    {
        $C=$this->getTableItemCode($formInfo);
        $C .= "\n}";
        $C .= "\n?>";
        file_put_contents($this->getCodeFile(), $C);

        chmod($this->getCodeFile(),0777);

    }
    private function makeTableManageListCode($formInfo)
    {
        $formName=$formInfo['form']['name'];
        $moduleName=$formInfo['module']['name'];

        $C = "<?php";
        $C .=$this->getFormNamespaceDefiner();
        $C .= $this->getFormCodeUsage();
        $C.=$this->getFileInfoComment();

        $C .= "\nclass " . $formInfo['form']['name'] . "_Code extends FormCode {";
        $C .= "\n\tpublic function load()";
        $C .= "\n\t{";
        $C .= "\n\t\ttry{";
        $C .= $this->getFormCodeActionInits();
        $C .= "\n\t\t\tif(isset(\$_GET['delete']))";
        $C .= "\n\t\t\t\t\$Result=\$$formName" . "Controller->DeleteItem(\$this->getID());";
        $C .= "\n\t\t\telse{";
        $C .= "\n\t\t\t\t\$Result=\$$formName" . "Controller->load(\$this->getHttpGETparameter('pn',-1));";
        $C.="\n\t\t\t}";
        $C .= "\n\t\t\t\$design=new $formName" . "_Design();";
        $C .= "\n\t\t\t\$design->setData(\$Result);";
        $C .= "\n\t\t\t\$design->setMessage(\"\");";
        $C .= "\n\t\t}";
        $C .= $this->getNotFoundCatchPart();
        $C .= $this->getUnknownCatchPart();
        $C .= "\n\t\treturn \$design->getBodyHTML();";
        $C .= "\n\t}";
        $C .= "\n\tpublic function getID()";
        $C .= "\n\t{";
        $C .= "\n\t\t\$id=-1;";
        $C .= "\n\t\tif(isset(\$_GET['id']))";
        $C .= "\n\t\t\t\$id=\$_GET['id'];";
        $C .= "\n\t\treturn \$id;";
        $C .= "\n\t}";
        $C .= "\n}";
        $C .= "\n?>";
        file_put_contents($this->getCodeFile(), $C);

        chmod($this->getCodeFile(),0777);

    }
    private function makeTableListCode($formInfo)
    {
        $formName=$formInfo['form']['name'];

        $C = "<?php";
        $C .=$this->getFormNamespaceDefiner();
        $C .= $this->getFormCodeUsage();
        $C.=$this->getFileInfoComment();

        $C .= "\nclass " . $formName . "_Code extends FormCode {";
        $C .= "\n\tpublic function load()";
        $C .= "\n\t{";
        $C .= $this->getFormCodeActionInits();
        $C .= "\n\t\ttry{";

        $C .= "\n\t\t\tif(isset(\$_GET['action']) && \$_GET['action']==\"search_Click\"){";
        $C .= "\n\t\t\t\treturn \$this->search_Click();";
        $C .= "\n\t\t\t}";
        $C .= "\n\t\t\telse";
        $C .= "\n\t\t\t{";
        $C .= "\n\t\t\t\t\$Result=\$$formName" . "Controller->load(\$this->getHttpGETparameter('pn',-1));";
        $C .= "\n\t\t\t\t\$design=new $formName" . "_Design();";
        $C .= "\n\t\t\tif(isset(\$_GET['search']))";
        $C .= "\n\t\t\t\t\t\$design=new $formName" . "search_Design();";
        $C .= "\n\t\t\t\t\$design->setData(\$Result);";
        $C .= "\n\t\t\t\t\$design->setMessage(\"\");";
        $C .= "\n\t\t\t}";
        $C .= "\n\t\t}";
        $C .= $this->getNotFoundCatchPart();
        $C .= $this->getUnknownCatchPart();
        $C .= "\n\t\treturn \$design->getBodyHTML();";
        $C .= "\n\t}";

        for($i=0;$i<count($formInfo['elements']);$i++)
            if($formInfo['elements'][$i]['type_fid']==7)
                $C.=$this->getActionFormCode($formInfo,$formInfo['elements'][$i]['name'],"\$this->getHttpGETparameter('pn',-1),",false);
        $C .= "\n}";
        $C .= "\n?>";
        file_put_contents($this->getCodeFile(), $C);

        chmod($this->getCodeFile(),0777);

    }
	private function makeTableManageListController($formInfo)
	{
        $TableName=$this->TableName;
        $EntityClassName=$this->getCodeModuleName() . "_" . $TableName . "Entity";
		$C = $this->getTableListControllerCode($formInfo,array("PageNum"));
		$C .= "\n\tpublic function DeleteItem(\$ID)";
        $C .= "\n\t{";
        $C .= "\n\t\t\$Language_fid=CurrentLanguageManager::getCurrentLanguageID();";
        $C .= "\n\t\t\$DBAccessor=new dbaccess();";
        $C .= "\n\t\t\$$TableName" . "Ent=new $EntityClassName(\$DBAccessor);";
        $C .= "\n\t\t\$$TableName" . "Ent->setId(\$ID);";
        $C .= "\n\t\tif(\$$TableName" . "Ent->getId()==-1)";
        $C .= "\n\t\t\tthrow new DataNotFoundException();";
        $C .= "\n\t\t\$$TableName" . "Ent->Remove();";
        $C .= "\n\t\treturn \$this->load(-1);";
        $C .= "\n\t\t\$DBAccessor->close_connection();";
        $C .="\n\t}";
		$C .= "\n}";
		$C .= "\n?>";
		file_put_contents($this->getControllerFile(), $C);

		chmod($this->getControllerFile(),0777);

	}
    private function makeTableListController($formInfo)
    {
        $C = $this->getTableListControllerCode($formInfo,array("PageNum"));
        $C .= "\n}";
        $C .= "\n?>";
        file_put_contents($this->getControllerFile(), $C);
        chmod($this->getControllerFile(),0777);

    }
    private function getTableListControllerLoadCode($formInfo,$LoadParams,$MethodName,$EntityClassName,$QueryParams)
    {
        $formName=$formInfo['form']['name'];
        $moduleName=$formInfo['module']['name'];
        $TableName=$this->TableName;
        $C = "\n\tpublic function $MethodName(";
        for ($i=0;$i<count($LoadParams);$i++) {
            if($i>0)
                $C.=",";
            $C.="\$" . $LoadParams[$i];
        }
        $C .=")";
        $C .= "\n\t{";
        $C .= $this->getControllerActionInits();
        for($i=0;$i<count($this->TableFields);$i++) {
            $fl1=$this->getFieldName($i);
            if($fl1!=null &&  FieldType::getFieldType($this->TableFields[$i])==FieldType::$FID) {
                $fl = $moduleName . "_" . $fl1 . "Entity";
                $FiledName=substr($this->TableFields[$i],0,strlen($this->TableFields[$i])-4);
                $ObjectName2="\$" . $FiledName . "EntityObject";
                $C .= "\n\t\t\t$ObjectName2=new " .  $fl . "(\$DBAccessor);";
                $C .= "\n\t\t\t\$result['" . $this->TableFields[$i] . "']=$ObjectName2" . "->FindAll(new QueryLogic());";
            }
        }
        $C .= "\n\t\tif(\$PageNum<=0)";
        $C .= "\n\t\t\t\$PageNum=1;";
        $C .= "\n\t\t\$$TableName" . "Ent=new $EntityClassName(\$DBAccessor);";
        $C .= "\n\t\t\$q=new QueryLogic();";
        if($QueryParams!=null)
            $C.=$QueryParams;
        $C .= "\n\t\t\$allcount=\$$TableName" . "Ent" . "->FindAllCount(\$q);";
        $C .= "\n\t\t\$result['pagecount']=\$this->getPageCount(\$allcount,\$this->PAGESIZE);";
        $C .= "\n\t\t\$q->setLimit(\$this->getPageRowsLimit(\$PageNum,\$this->PAGESIZE));";
        $C .= "\n\t\t\$result['data']=\$$TableName" . "Ent" . "->FindAll(\$q);";


        $C .= "\n\t\t\$result['param1']=\"\";";
        $C .= "\n\t\t\$DBAccessor->close_connection();";
        $C .= "\n\t\treturn \$result;";
        $C .= "\n\t}";
        return $C;
    }
    private function getTableListControllerCode($formInfo,$LoadParams)
    {
        $formName=$formInfo['form']['name'];
        $moduleName=$formInfo['module']['name'];
        $TableName=$this->TableName;
        $EntityClassName=null;
        $EntityNames=array();
        $C = "<?php";
        $C .= $this->getControllerNamespaceDefiner();
        $C .= $this->getControllerUsage();
        $EntityClassName=$moduleName . "_" . $TableName . "Entity";
        $C .= "\nuse Modules\\$moduleName\\Entity\\$EntityClassName;";
        for($i=0;$i<count($this->TableFields);$i++) {
            $fl1=$this->getFieldName($i);
            if($fl1!=null && array_search($fl1,$EntityNames)==null) {
                $fl = $moduleName . "_" . $fl1 . "Entity";
                $C .= "\nuse Modules\\$moduleName\\Entity\\$fl;";
            }
            $EntityNames[$i]=$fl1;
        }

        $C.=$this->getFileInfoComment();
        $C .= "\nclass $formName" . "Controller extends Controller {";
        $C .= "\n\tprivate \$PAGESIZE=10;";
        $C .= $this->getTableListControllerLoadCode($formInfo,$LoadParams,"load",$EntityClassName,null);
        $Qparams="";
        $LoadParams2=$LoadParams;
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $el=$formInfo['elements'][$i];
            if($el['type_fid']!="7" ) {
                if($el['name']!="sortby" && $el['name']!="isdesc")
                    $Qparams.="\t\t\n\$q->addCondition(new FieldCondition(\"".$el['name']."\",\"%\$" . $el['name'] . "%\",LogicalOperator::LIKE));";
                array_push($LoadParams2,$el['name']);
            }
        }
        $Qparams.="\t\t\n\$q->addOrderBy(\$sortby,\$isdesc);";

        for($i=0;$i<count($formInfo['elements']);$i++) {
            $el=$formInfo['elements'][$i];
            if($el['type_fid']!="7") {
            }
        }
        $C .= $this->getTableListControllerLoadCode($formInfo,$LoadParams2,"Search",$EntityClassName,$Qparams);
        return $C;

    }
	private function getActionFormController($formInfo,$ActionName)
	{

        $EntityClassName=$this->getCodeModuleName() . "_" . $this->TableName . "Entity";;
        $ObjectName="\$" . $this->TableName . "EntityObject";
        $InsertCode = "\n\t\t\t$ObjectName=new $EntityClassName(\$DBAccessor);";
        $InsertCode.=$this->getEntityObjectFieldSetCode($ObjectName,$EntityClassName);
        $InsertCode .= "\n\t\t\t$ObjectName" . "->Save();";
        $UpdateCode = "\n\t\t\t$ObjectName=new $EntityClassName(\$DBAccessor);";
        $UpdateCode .= "\n\t\t\t$ObjectName" . "->setId(\$ID);";
        $UpdateCode .= "\n\t\t\tif($ObjectName" . "->getId()==-1)";
        $UpdateCode .= "\n\t\t\t\tthrow new DataNotFoundException();";
        $UpdateCode.=$this->getEntityObjectFieldSetCode($ObjectName,$EntityClassName);
        $UpdateCode .= "\n\t\t\t$ObjectName" . "->Save();";

		$Params="";
		for($i=0;$i<count($formInfo['elements']);$i++)
		{
			$E=$formInfo['elements'][$i];
			if($E['type_fid']==2 || $E['type_fid']==3 || $E['type_fid']==4 || $E['type_fid']==5 || $E['type_fid']==6 || $E['type_fid']==8)//TextBox or checkbox or ...
			{
				$ParamName="\$" . $E['name'];
				if($Params!="")
					$Params.=",";
				$Params.=$ParamName;
			}

		}
		$C  = "\n\tpublic function " . ucwords($ActionName) . "(\$ID,$Params)";
		$C .= "\n\t{";
		$C .= "\n\t\t\$Language_fid=CurrentLanguageManager::getCurrentLanguageID();";
		$C .= "\n\t\t\$DBAccessor=new dbaccess();";
        $C .= "\n\t\t\$su=new sessionuser();";
        $C .= "\n\t\t\$role_systemuser_fid=\$su->getSystemUserID();";
		$C .= "\n\t\t\$result=array();";

        $C .= "\n\t\tif(\$ID==-1){";
        if($InsertCode===null)
            $C .= "\n\t\t\t//INSERT NEW DATA";
        else
            $C .=$InsertCode;
        $C .= "\n\t\t}";
        $C .= "\n\t\telse{";

        if($UpdateCode===null)
            $C .= "\n\t\t\t//UPDATE DATA";
        else
            $C .=$UpdateCode;
        $C .= "\n\t\t}";

        $C .= "\n\t\t\$result=\$this->load(\$ID);";
		$C .= "\n\t\t\$result['param1']=\"\";";
		$C .= "\n\t\t\$DBAccessor->close_connection();";
		$C .= "\n\t\treturn \$result;";
		$C .= "\n\t}";
		return $C;
	}


    /**
     * @param array $formInfo
     * @param string $changeLogFile
     */
    private function makeChangeLog(array $formInfo, $changeLogFile,$TableName)
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
        if(substr($FieldName,0,2)=="is")
            return FieldType::$BOOLEAN;
        return FieldType::$NORMAL;
    }

}
?>
