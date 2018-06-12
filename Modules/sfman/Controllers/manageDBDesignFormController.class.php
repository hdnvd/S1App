<?php

namespace Modules\sfman\Controllers;
use core\CoreClasses\html\CheckBox;
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

abstract class manageDBDesignFormController extends manageDBCodeFormController {

    protected function getTableItemDesignElementDefineCode($formInfo,$i)
    {
        $E = $formInfo['elements'][$i];
        $ind = $this->getTypeIndex($formInfo['elementtypes'], $E['type_fid']);
        $EType = $formInfo['elementtypes'][$ind]['name'];
        $C = "\n\t/**";
        $C .= " @var $EType";
        $C .= " */";
        $C .= "\n\tprivate \$" . $E['name'] . ";";
        if ($E['type_fid'] == 2 || $E['type_fid'] == 3 || $E['type_fid'] == 4 || $E['type_fid'] == 5 || $E['type_fid'] == 6 || $E['type_fid'] == 8 || $E['type_fid'] == 9)
            $C .= $this->getGetterCode($E['name'], $EType);
        return $C;
    }
	protected function getFieldFillCode($formInfo,$AddEmptyOption=false,$IsManagement=true)
    {
        $TableName=$this->getTableName();
        $FieldFillCode="";
        $FieldBeforeIFFillCode="";
        $FieldFillCode .= "\r\n\t\tif (key_exists(\"$TableName\", \$this->Data)){";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $Ename=$formInfo['elements'][$i]['name'];

            $FieldFillCode .= "\r\n\r\n\t\t\t/******** $Ename" . " ********/";
            $FT=FieldType::getFieldType($Ename);
            if($FT!=FieldType::$METAINF && $FT!=FieldType::$LARAVELMETAINF && $FT!=FieldType::$ID && $Ename!="sortby" && $Ename!="isdesc") {
                if($formInfo['elements'][$i]['type_fid']==3) {
                    if($AddEmptyOption)
                        $FieldBeforeIFFillCode .= "\r\n\t\t\t\$this->$Ename" . "->addOption(\"\", \"مهم نیست\");";
                    if($FT==FieldType::$BOOLEAN)
                    {
                        if(strtolower($Ename)=="ismale")
                        {
                            $FieldBeforeIFFillCode .= "\r\n\t\t\t\$this->$Ename" . "->addOption(1,'مرد');";
                            $FieldBeforeIFFillCode .= "\r\n\t\t\t\$this->$Ename" . "->addOption(0,'زن');";
                        }
                        elseif(strtolower($Ename)=="ismarried")
                        {
                            $FieldBeforeIFFillCode .= "\r\n\t\t\t\$this->$Ename" . "->addOption(1,'متاهل');";
                            $FieldBeforeIFFillCode .= "\r\n\t\t\t\$this->$Ename" . "->addOption(0,'مجرد');";
                        }
                        else
                        {
                            $FieldBeforeIFFillCode .= "\r\n\t\t\t\$this->$Ename" . "->addOption(1,'بله');";
                            $FieldBeforeIFFillCode .= "\r\n\t\t\t\$this->$Ename" . "->addOption(0,'خیر');";
                        }
                    }
                    else
                    {
                        $FieldBeforeIFFillCode .= "\r\n\t\tforeach (\$this->Data['$Ename'] as \$item)";
                        $FieldBeforeIFFillCode .= "\r\n\t\t\t\$this->$Ename" . "->addOption(\$item->getID(), \$item->getTitleField());";
                    }
                    $FieldFillCode .= "\r\n\t\t\t\$this->$Ename" . "->setSelectedValue(\$this->Data['$TableName']->get" . ucwords($Ename) . "());";
                    $FieldFillCode .= "\r\n\t\t\t\$this->setFieldCaption('$Ename',\$this->Data['$TableName']->getFieldInfo('$Ename')->getTitle());";

                }
                elseif($formInfo['elements'][$i]['type_fid']==2) //TextBox
                {
                    $FieldFillCode .= "\r\n\t\t\t\$this->$Ename" . "->setValue(\$this->Data['$TableName']->get" . ucwords($Ename) . "());";
                    $FieldFillCode .= "\r\n\t\t\t\$this->setFieldCaption('$Ename',\$this->Data['$TableName']->getFieldInfo('$Ename')->getTitle());";
                    if($IsManagement)
                        $FieldFillCode .= "\r\n\t\t\t\$this->$Ename" . "->setFieldInfo(\$this->Data['$TableName']->getFieldInfo('$Ename'));";
                }

                elseif($formInfo['elements'][$i]['type_fid']==9) //DatePicker
                {
                    $FieldFillCode .= "\r\n\t\t\t\$this->$Ename" . "->setTime(\$this->Data['$TableName']->get" . ucwords($Ename) . "());";
                    $FieldFillCode .= "\r\n\t\t\t\$this->setFieldCaption('$Ename',\$this->Data['$TableName']->getFieldInfo('$Ename')->getTitle());";

                        $Last3=substr($Ename,strlen($Ename)-3,3);
                        if($Last3=="_to")
                        {
                            $Remaining=substr($Ename,0,strlen($Ename)-3);
                            $FieldFillCode .= "\r\n\t\t\t\$this->setFieldCaption('$Remaining',\$this->Data['$TableName']->getFieldInfo('$Remaining')->getTitle());";

                        }

                    if($IsManagement)
                        $FieldFillCode .= "\r\n\t\t\t\$this->$Ename" . "->setFieldInfo(\$this->Data['$TableName']->getFieldInfo('$Ename'));";
                }
                elseif($formInfo['elements'][$i]['type_fid']==6) {
                    $FieldFillCode .= "\r\n\t\t\t\$this->setFieldCaption('$Ename',\$this->Data['$TableName']->getFieldInfo('$Ename')->getTitle());";
                }
                elseif($formInfo['elements'][$i]['type_fid']==5) {

                    $FieldBeforeIFFillCode .= "\r\n\t\t\$this->$Ename" . "->addOption(\"$Ename\",\"1\");";
                    $FieldFillCode .= "\r\n\t\t\t\$this->$Ename" . "->addSelectedValue(\$this->Data['$TableName']->get" . ucwords($Ename) . "());";
                }
            }
        }
        $FieldFillCode .= "\r\n\t\t}";
        return $FieldBeforeIFFillCode . $FieldFillCode;
    }
    protected function makeTableItemManageDesign($formInfo)
    {
        $FormName=$formInfo['form']['name'];
        $C = "<?php";
        $C .= $this->getFormNamespaceDefiner();
        $C.=$this->getDesignUsings();
        $C.=$this->getFileInfoComment();
        $C .= "\nclass " . $FormName . "_Design extends FormDesign {";
        $C .="\n\tpublic function getBodyHTML(\$command=null)";
        $C .="\n\t{";
        $C.="\n\t\t\$this->FillItems();";
        $C .=$this->getDesignTopPartCode();
        $C .="\n\t\t\$LTable1=new Div();";
        $C .="\n\t\t\$LTable1->setClass(\"formtable\");";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $C .=$this->getDesignAddCode($formInfo,$i,true,false);
        }
        $SecondaryTables=$this->getSecondaryTables();
        $AllCount1 = count($SecondaryTables);
         for ($i = 0; $i < $AllCount1; $i++) {
             $theTable=$this->getTableFieldPart($SecondaryTables[$i],-1);
            $theUCTable=ucwords($theTable);
            if($theTable!=null) {
                $C .="\n\t\t\$LTable1" ."->addElement(\$this->getFieldRowCode(\$this->" . $theUCTable . "s,\$this->getFieldCaption('" . $theUCTable . "s'),null,'',null));";
            }
        }
        $C .="\n\t\t\$Page->addElement(\$LTable1);";
        $C .="\n\t\t\$form=new SweetFrom(\"\", \"POST\", \$Page);";
        $C .="\n\t\t\$form->SetAttribute(\"novalidate\",\"novalidate\");";
        $C .="\n\t\t\$form->SetAttribute(\"data-toggle\",\"validator\");";
        $C .="\n\t\t\$form->setClass('form-horizontal');";
        $C .="\n\t\treturn \$form->getHTML();";
        $C .="\n\t}";
        $C .="\n\tpublic function FillItems()";
        $C .="\n\t{";
        $C.=$this->getFieldFillCode($formInfo);
        for ($i = 0; $i < $AllCount1; $i++) {
            $theTable=$this->getTableFieldPart($SecondaryTables[$i],-1);
            $theTablePrefix=$this->getTableFieldPart($SecondaryTables[$i],-2);
            $theUCTable=ucwords($theTable);
            if($theTable!=null) {
                $C .="\n\t\tif (key_exists(\"$theTable" . "s\", \$this->Data)) {";
                $C .="\n\t\t\$All".$theUCTable."Count = count(\$this->Data['" .$theTable. "s']);";
                $C .="\n\t\tfor (\$i = 0; \$i < \$All".$theUCTable."Count; \$i++) {";
                $C .="\n\t\t\t\$this->$theUCTable" . "s->addOption(\$this->Data['" .$theTable. "s'][\$i]->getTitleField(), \$this->Data['" .$theTable. "s'][\$i]->getId());";
                $C .="\n\t\t}";
                $C .="\n\t}";

                $C .="\n\t\tif (key_exists(\"" .$this->getTableName(). "$theTable" . "s\", \$this->Data)) {";
                $C .="\n\t\t\$All".$theUCTable."Count = count(\$this->Data['" .$this->getTableName(). $theTable. "s']);";
                $C .="\n\t\tfor (\$i = 0; \$i < \$All".$theUCTable."Count; \$i++) {";
                $fidName=$theUCTable;
                if($theTablePrefix!=$theTable)
                    $fidName=ucwords($SecondaryTables[$i]);
                $C .="\n\t\t\t\$this->$theUCTable" . "s->addSelectedValue(\$this->Data['" .$this->getTableName(). $theTable. "s'][\$i]->get".$fidName."_fid());";
                $C .="\n\t\t}";
                $C .="\n\t}";
                }
        }
        $C .="\n\t}";
        $C .=$this->getHasFieldFormDesignConstructor($formInfo);
        $C .= "\n\tprivate \$Data;";
        $C.=$this->getSetterCode("Data","mixed");

        $C.=$this->getIsAdminModeDefine(true);
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $C.=$this->getTableItemDesignElementDefineCode($formInfo,$i);
        }
        for ($i = 0; $i < $AllCount1; $i++) {
            $theTable=$this->getTableFieldPart($SecondaryTables[$i],-1);
            $theUCTable=ucwords($theTable);
            if($theTable!=null) {
                $C .= "\n\t/**";
                $C .= " @var CheckBox";
                $C .= " */";
                $C .= "\n\tprivate \$" . $theUCTable . "s;";
                $C .= $this->getGetterCode($theUCTable . "s", 'CheckBox');
            }
        }
        $C.=$this->getDesignFormRowFunctionCode();
        $C .=<<<EOT

    public function getJSON()
    {
       parent::getJSON();
       \$Result=['message'=>\$this->getMessage(),'messagetype'=>\$this->getMessageType()];
       return json_encode(\$Result);
    }
EOT;
        $C .= "\n}";


        $C .= "\n?>";

        $this->SaveFile($this->getDesignFile(),$C);

    }
    private function getHasFieldFormDesignConstructor($formInfo)
    {
        $C ="\n\tpublic function __construct()";
        $C .="\n\t{";
        $C .="\n\t\tparent::__construct();";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $C.=$this->getDesignInitialization($formInfo,$i);
        }
        $SecondaryTables=$this->getSecondaryTables();
        $AllCount1 = count($SecondaryTables);
        for ($i = 0; $i < $AllCount1; $i++) {
            $theTable=$this->getTableFieldPart($SecondaryTables[$i],-1);
            $theUCTable=ucwords($theTable);
            if($theTable!=null) {
                $C .= "\n\n\t\t/******* " . $theUCTable ." *******/";
                $C .= "\n\t\t\$this->" . $theUCTable . "s= new  CheckBox('$theTable" . "[]');";
//                $C .= "\n\t\t\$this->" . $theUCTable . "s->setClass(\"form-control\");";
            }
        }
        $C .="\n\t}";
        return $C;
    }
    protected function makeTableItemDesign($formInfo)
    {
        $TableName=$this->getTableName();
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
            if($ft==FieldType::$NORMAL || $ft==FieldType::$BOOLEAN || $ft==FieldType::$FID|| $ft==FieldType::$FILE || $ft==FieldType::$AUTOTIME || $ft==FieldType::$DATE)
            $C.=$this->getTableItemDesignElementDefineCode($formInfo,$i);
        }
        $C .="\n\tpublic function __construct()";
        $C .="\n\t{";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $ft=FieldType::getFieldType($formInfo['elements'][$i]['name']);
            if($ft==FieldType::$NORMAL || $ft==FieldType::$BOOLEAN || $ft==FieldType::$FID || $ft==FieldType::$FILE || $ft==FieldType::$AUTOTIME || $ft==FieldType::$DATE)
            $C.=$this->getDesignInitialization($formInfo,$i);
        }
        $C .="\n\t}";



        $C .="\n\tpublic function getBodyHTML(\$command=null)";
        $C .="\n\t{";
        $C .=$this->getDesignTopPartCode();

        $C .= "\r\n\t\tif (key_exists(\"$TableName\", \$this->Data)){";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $Ename=$formInfo['elements'][$i]['name'];
            if(FieldType::getFieldType($Ename)==FieldType::$NORMAL || FieldType::getFieldType($Ename)==FieldType::$FILE ) {
                $Val="\$this->Data['$TableName']->get" . ucwords($Ename) . "()";
                $C .= "\r\n\t\t\t\$this->setFieldCaption('$Ename',\$this->Data['$TableName']->getFieldInfo('$Ename')->getTitle());";
                $C .= "\r\n\t\t\t\$this->$Ename" . "->setText($Val);";
            }
            elseif(FieldType::getFieldType($Ename)==FieldType::$BOOLEAN ) {
                $Val="\$this->Data['$TableName']->get" . ucwords($Ename) . "()";
                $TitleField="\$$Ename" . "Title";
                $C .= "\r\n\t\t\t\$this->setFieldCaption('$Ename',\$this->Data['$TableName']->getFieldInfo('$Ename')->getTitle());";
                $C .= "\r\n\t\t\t$TitleField='No';";
                $C .= "\r\n\t\t\tif($Val==1)";
                $C .= "\r\n\t\t\t\t$TitleField='Yes';";
                $C .= "\r\n\t\t\t\$this->$Ename" . "->setText($TitleField);";
            }
            elseif(FieldType::getFieldType($Ename)==FieldType::$FID) {
                $Val="\$this->Data['$Ename']->getID()";
                $C .= "\r\n\t\t\t\$this->setFieldCaption('$Ename',\$this->Data['$TableName']->getFieldInfo('$Ename')->getTitle());";
                $C .= "\r\n\t\t\t\$this->$Ename" . "->setText($Val);";
            }
            elseif(FieldType::getFieldType($Ename)==FieldType::$DATE || FieldType::getFieldType($Ename)==FieldType::$AUTOTIME ) {
                $Val="\$this->Data['$TableName']->get" . ucwords($Ename) . "()";
                $C .= "\r\n\t\t\t\$this->setFieldCaption('$Ename',\$this->Data['$TableName']->getFieldInfo('$Ename')->getTitle());";
                $C .= "\r\n\t\t\t\$". $Ename . "_SD=new SweetDate(true, true, 'Asia/Tehran');";
                $C .= "\r\n\t\t\t\$". $Ename . "_Text=\$". $Ename . "_SD->date(\"l d F Y\",$Val);";
                $C .= "\r\n\t\t\t\$this->$Ename" . "->setText(\$". $Ename . "_Text);";
            }

        }
        $C .= "\r\n\t\t}";
        $C .="\n\t\t\$LTable1=new Div();";
        $C .="\n\t\t\$LTable1->setClass(\"formtable\");";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $C .=$this->getDesignAddCode($formInfo,$i,false,true);
        }
        $C .="\n\t\t\$Page->addElement(\$LTable1);";
        $C .="\n\t\t\$form=new SweetFrom(\"\", \"POST\", \$Page);";
        $C .="\n\t\treturn \$form->getHTML();";
        $C .="\n\t}";

        $C .="\n\tpublic function getJSON()";
        $C .="\n\t{";
        $C .="\n\t\tparent::getJSON();";
        $C .="\n\t\tif (key_exists(\"$TableName\", \$this->Data)){";
        $C .="\n\t\t\t\$Result=\$this->Data['$TableName']->GetArray();";
        $C .="\n\t\t\treturn json_encode(\$Result);";
        $C .="\n\t\t}";
        $C .="\n\t\treturn json_encode(array());";
        $C .="\n\t}";
        $C.=$this->getDesignFormRowFunctionCode();
        $C .= "\n}";
        $C .= "\n?>";
        $this->SaveFile($this->getDesignFile(),$C);

    }

    protected function makeTableManageListDesign($formInfo)
    {
        $TableName=$this->getTableName();
        $ModuleName=$formInfo['module']['name'];
        $FormName=$formInfo['form']['name'];
        $C = "<?php";
        $C .= $this->getFormNamespaceDefiner();
        $C.=$this->getDesignUsings();
        $C.=$this->getFileInfoComment();
        $C .= "\nclass " . $FormName . "_Design extends FormDesign {";
        $C .= "\n\tprivate \$Data;";
        $C.=$this->getSetterCode("Data","mixed");
        $TableNameDotS=$TableName."s";
        $C.=$this->getIsAdminModeDefine(false);
            $C.=<<<EOT
    private \$listPage;
    private \$itemPage;
    private \$itemViewPage;
    /**
     * @param bool \$adminMode
     */
    public function setAdminMode(\$adminMode)
    {
        \$this->adminMode = \$adminMode;
        \$this->itemViewPage = '$TableName';
        if(\$adminMode==true)
        {
            \$this->itemPage = 'manage$TableName';
            \$this->listPage = 'manage$TableNameDotS';
        }
        else
        {
            \$this->itemPage = 'manageuser$TableName';
            \$this->listPage = 'manageuser$TableNameDotS';
        }
    }
EOT;
        $C .="\n\tpublic function __construct()";
        $C .="\n\t{";
        $C .="\n\t\tparent::__construct();";
        $C .="\n\t}";
        $C .="\n\tpublic function getBodyHTML(\$command=null)";
        $C .="\n\t{";
        $C .=$this->getDesignTopPartCode(false);
        $C .="\n\t\t\$addUrl=new AppRooter('$ModuleName',\$this->itemPage);";
        $C .="\n\t\t\$LblAdd=new Lable('افزودن آیتم جدید');";
        $C .="\n\t\t\$lnkAdd=new link(\$addUrl->getAbsoluteURL(),\$LblAdd);";
        $C .="\n\t\t\$lnkAdd->setClass('linkbutton btn btn-primary');";
        $C .="\n\t\t\$lnkAdd->setGlyphiconClass('glyphicon glyphicon-plus');";
        $C .="\n\t\t\$lnkAdd->setId('add" . $TableName . "link');";
        $C .="\n\t\t\$Page->addElement(\$lnkAdd);";

        $C .="\n\t\t\$SearchUrl=new AppRooter('$ModuleName',\$this->listPage);";
        $C .="\n\t\t\$SearchUrl->addParameter(new URLParameter('search',null));";
        $C .="\n\t\t\$LblSearch=new Lable('جستجو');";
        $C .="\n\t\t\$lnkSearch=new link(\$SearchUrl->getAbsoluteURL(),\$LblSearch);";
        $C .="\n\t\t\$lnkSearch->setClass('linkbutton btn btn-primary');";
        $C .="\n\t\t\$lnkSearch->setGlyphiconClass('glyphicon glyphicon-search');";
        $C .="\n\t\t\$lnkSearch->setId('search" . $TableName . "link');";
        $C .="\n\t\t\$Page->addElement(\$lnkSearch);";
        $C .=$this->getDesignMessageAdding();
        $C .="\n\t\t\$TableDiv=new Div();";
        $C .="\n\t\t\$TableDiv->setClass('table-responsive');";
        $C .="\n\t\t\$LTable1=new ListTable(3);";
        $C .="\n\t\t\$LTable1->setHeaderRowCount(1);";
        $C .="\n\t\t\$LTable1->setClass(\"table-striped table-hover managelist\");";
        $C .="\n\t\t\$LTable1->addElement(new Lable('#'));";
        $C .="\n\t\t\$LTable1->setLastElementClass(\"listtitle\");";
        $C .="\n\t\t\$LTable1->addElement(new Lable('عنوان'));";
        $C .="\n\t\t\$LTable1->setLastElementClass(\"listtitle\");";
        $C .="\n\t\t\$LTable1->addElement(new Lable('عملیات'));";
        $C .="\n\t\t\$LTable1->setLastElementClass(\"listtitle\");";
        $C .="\n\t\tfor(\$i=0;\$i<count(\$this->Data['data']);\$i++){";
        $C .="\n\t\t\t\$url=new AppRooter('$ModuleName',\$this->itemPage);";
        $C .="\n\t\t\t\$url->addParameter(new UrlParameter('id',\$this->Data['data'][\$i]->getID()));";
        $C .="\n\t\t\t\$Title=\$this->Data['data'][\$i]->getTitleField();";
        $C .="\n\t\t\tif(\$Title==\"\")";
        $C .="\n\t\t\t\t\$Title='- بدون عنوان -';";
        $C .="\n\t\t\t\$lbTit[\$i]=new Lable(\$Title);";
        $C .="\n\t\t\t\$liTit[\$i]=new link(\$url->getAbsoluteURL(),\$lbTit[\$i]);";

        $C .="\n\t\t\t\$ViewURL=new AppRooter('$ModuleName',\$this->itemViewPage);";
        $C .="\n\t\t\t\$ViewURL->addParameter(new UrlParameter('id',\$this->Data['data'][\$i]->getID()));";
        $C .="\n\t\t\t\$lbView[\$i]=new Lable('مشاهده');";
        $C .="\n\t\t\t\$lnkView[\$i]=new link(\$ViewURL->getAbsoluteURL(),\$lbView[\$i]);";
        $C .="\n\t\t\t\$lnkView[\$i]->setGlyphiconClass('glyphicon glyphicon-eye-open');";
        $C .="\n\t\t\t\$lnkView[\$i]->setClass('btn btn-primary');";

        $C .="\n\t\t\t\$delurl=new AppRooter('$ModuleName',\$this->listPage);";
        $C .="\n\t\t\t\$delurl->addParameter(new UrlParameter('id',\$this->Data['data'][\$i]->getID()));";
        $C .="\n\t\t\t\$delurl->addParameter(new UrlParameter('delete',1));";
        $C .="\n\t\t\t\$lbDel[\$i]=new Lable('حذف');";
        $C .="\n\t\t\t\$lnkDel[\$i]=new link(\$delurl->getAbsoluteURL(),\$lbDel[\$i]);";
        $C .="\n\t\t\t\$lnkDel[\$i]->setGlyphiconClass('glyphicon glyphicon-remove');";
        $C .="\n\t\t\t\$lnkDel[\$i]->setClass('btn btn-danger');";

        $C .="\n\t\t\t\$operationDiv[\$i]=new Div();";
        $C .="\n\t\t\t\$operationDiv[\$i]->setClass('operationspart');";
        $C .="\n\t\t\t\$operationDiv[\$i]->addElement(\$lnkView[\$i]);";
        $C .="\n\t\t\t\$operationDiv[\$i]->addElement(\$lnkDel[\$i]);";

        $C .="\n\t\t\t\$LTable1->addElement(new Lable(\$i+1));";
        $C .="\n\t\t\t\$LTable1->setLastElementClass(\"listcontent\");";
        $C .="\n\t\t\t\$LTable1->addElement(\$liTit[\$i]);";
        $C .="\n\t\t\t\$LTable1->setLastElementClass(\"listcontent\");";
        $C .="\n\t\t\t\$LTable1->addElement(\$operationDiv[\$i]);";
        $C .="\n\t\t\t\$LTable1->setLastElementClass(\"listcontent\");";
        $C .="\n\t\t}";
        $C .="\n\t\t\$TableDiv->addElement(\$LTable1);";
        $C .="\n\t\t\$Page->addElement(\$TableDiv);";
        $C .="\n\t\t\$Page->addElement(\$this->getPaginationPart(\$this->Data['pagecount'],\"".$this->getCodeModuleName()."\",\$this->listPage));";
        $C .="\n\t\t\$form=new SweetFrom(\"\", \"POST\", \$Page);";
        $C .="\n\t\treturn \$form->getHTML();";
        $C .="\n\t}";
        $C .=<<<EOT
    
    public function getJSON()
    {
       parent::getJSON();
       \$Result=['message'=>\$this->getMessage(),'messagetype'=>\$this->getMessageType()];
       return json_encode(\$Result);
    }
EOT;
        $C .= "\n}";
        $C .= "\n?>";
        $this->SaveFile($this->getDesignFile(),$C);

    }

    protected function makeTableListDesign($formInfo)
    {
        $TableName=$this->getTableName();
        $ModuleName=$formInfo['module']['name'];
        $FormName=$formInfo['form']['name'];
        $C = "<?php";
        $C .= $this->getFormNamespaceDefiner();
        $C.=$this->getDesignUsings();
        $C.=$this->getFileInfoComment();
        $C .= "\nclass " . $FormName . "_Design extends FormDesign {";
        $C .= "\n\tprivate \$Data;";
        $C.=$this->getSetterCode("Data","mixed");
        $C.=$this->getIsAdminModeDefine(true);
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $C.=$this->getTableItemDesignElementDefineCode($formInfo,$i);
        }

        $C .="\n\tpublic function getBodyHTML(\$command=null)";
        $C .="\n\t{";
        $C.="\n\t\t\$this->FillItems();";
        $C .=$this->getDesignTopPartCode(false);
        $C .="\n\t\t\$LTable1=new Div();";
        $C .="\n\t\t\$LTable1->setClass(\"searchtable\");";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $C .=$this->getDesignAddCode($formInfo,$i,false);
        }
        $C .="\n\t\t\$Page->addElement(\$LTable1);";
        $C.=$this->getDesignMessageAdding();
        $C .="\n\t\t\$Div1=new Div();";
        $C .="\n\t\t\$Div1->setClass(\"list\");";
        $C .="\n\t\tfor(\$i=0;\$i<count(\$this->Data['data']);\$i++){";

        $C .="\n\t\t\$innerDiv[\$i]=new Div();";
        $C .="\n\t\t\$innerDiv[\$i]->setClass(\"listitem\");";
        $C .="\n\t\t\t\$url=new AppRooter('$ModuleName','$TableName');";
        $C .="\n\t\t\t\$url->addParameter(new UrlParameter('id',\$this->Data['data'][\$i]->getID()));";
        $C .="\n\t\t\t\$Title=\$this->Data['data'][\$i]->getTitleField();";
        $C .="\n\t\t\tif(\$this->Data['data'][\$i]->getTitleField()==\"\")";
        $C .="\n\t\t\t\t\$Title='-- بدون عنوان --';";
        $C .="\n\t\t\t\$lbTit[\$i]=new Lable(\$Title);";
        $C .="\n\t\t\t\$liTit[\$i]=new link(\$url->getAbsoluteURL(),\$lbTit[\$i]);";
        $C .="\n\t\t\t\$innerDiv[\$i]->addElement(\$liTit[\$i]);";
        $C .="\n\t\t\t\$Div1->addElement(\$innerDiv[\$i]);";
        $C .="\n\t\t}";
        $C .="\n\t\t\$Page->addElement(\$Div1);";
        $C .="\n\t\t\$Page->addElement(\$this->getPaginationPart(\$this->Data['pagecount'],\"".$this->getCodeModuleName()."\",\"$FormName\"));";
        $C.="\n\t\t\$PageLink=new AppRooter('".$this->getCodeModuleName()."','$FormName');";
        $C .="\n\t\t\$form=new SweetFrom(\$PageLink->getAbsoluteURL(), \"GET\", \$Page);";
        $C .="\n\t\t\$form->setClass('form-horizontal');";
        $C .="\n\t\treturn \$form->getHTML();";
        $C .="\n\t}";
        $C .="\n\tpublic function getJSON()";
        $C .="\n\t{";
        $C .="\n\t\tparent::getJSON();";
        $C .="\n\t\tif (key_exists(\"data\", \$this->Data)){";
        $C .="\n\t\t\t\$AllCount1 = count(\$this->Data['data']);";
        $C .="\n\t\t\t\$Result=array();";
        $C .="\n\t\t\tfor(\$i=0;\$i<\$AllCount1;\$i++){";
        $C .="\n\t\t\t\t\$Result[\$i]=\$this->Data['data'][\$i]->GetArray();";
        $C .="\n\t\t\t}";
        $C .="\n\t\t\treturn json_encode(\$Result);";
        $C .="\n\t\t}";
        $C .="\n\t\treturn json_encode(array());";
        $C .="\n\t}";
        $C.=$this->getSearchPartFieldSetCode($formInfo);
        $C .=$this->getHasFieldFormDesignConstructor($formInfo);
        $C.=$this->getDesignFormRowFunctionCode();
        $C .= "\n}";
        $C .= "\n?>";
        $this->SaveFile($this->getDesignFile(),$C);

    }
    private function getSearchPartFieldSetCode($formInfo)
    {
        $C ="\n\tpublic function FillItems()";
        $C .="\n\t{";
        $C.=$this->getFieldFillCode($formInfo,true,false);
        $C .= "\n\t\t\t\$this->isdesc->addOption('0','صعودی');";
        $C .= "\n\t\t\t\$this->isdesc->addOption('1','نزولی');";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $E=$formInfo['elements'][$i];
            $C .= "\n\n\t\t/******** ".$E['name']." ********/";
            $C .= $this->getAddToSortByListCode($E);
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

        $C .="\n\t}";
        return $C;
    }
    protected function getAddToSortByListCode($Element)
    {
        $ElementName=$Element['name'];
        $ElementType=$Element['type_fid'];
        $C="";
        if(strtolower($ElementName)!="isdesc" && strtolower($ElementName)!="sortby")
        {
            if($ElementType==9)
            {
                $Last3=substr($ElementName,strlen($ElementName)-3,3);
                if($Last3=="_to")
                {
                    $Remaining=substr($ElementName,0,strlen($ElementName)-3);
                    $C = "\n\t\t\$this->sortby->addOption(\$this->Data['".$this->getTableName() . "']->getTableFieldID('" . $Remaining."'),\$this->getFieldCaption('".$Remaining."'));";
                }
            }

            if($ElementType==2 || $ElementType==3 || $ElementType==4)
                $C = "\n\t\t\$this->sortby->addOption(\$this->Data['".$this->getTableName() . "']->getTableFieldID('" . $ElementName."'),\$this->getFieldCaption('".$ElementName."'));";
        }
        return $C;
    }
    protected function getTitleFieldIndex()
    {
        $Fields=$this->getCurrentTableFields();
        $TitleInd=array_search("title",$Fields);
        if($TitleInd===false)
            $TitleInd=array_search("caption",$Fields);
        if($TitleInd===false)
            $TitleInd=array_search("family",$Fields);
        if($TitleInd===false)
            $TitleInd=array_search("name",$Fields);
        if($TitleInd===false)
            $TitleInd=array_search("latintitle",$Fields);
        if($TitleInd===false)
            $TitleInd=array_search("fullname",$Fields);
        if($TitleInd===false)
            $TitleInd=array_search("mellicode",$Fields);
        if($TitleInd===false)
            $TitleInd=array_search("email",$Fields);
        if($TitleInd===false)
            $TitleInd=array_search("id",$Fields);
        return $TitleInd;
    }
    protected function makeTableSearchDesign($formInfo)
    {
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
        $C .=$this->getHasFieldFormDesignConstructor($formInfo);
        $C .="\n\tpublic function getBodyHTML(\$command=null)";
        $C .="\n\t{";
        $C.="\n\t\t\$this->FillItems();";
        $C .=$this->getDesignTopPartCode();
        $C .="\n\t\t\$LTable1=new Div();";
        $C .="\n\t\t\$LTable1->setClass(\"searchtable\");";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $C .=$this->getDesignAddCode($formInfo,$i,false,false);
        }
        $C .="\n\t\t\$Page->addElement(\$LTable1);";
        $C .="\n\t\t\$form=new SweetFrom(\"\", \"GET\", \$Page);";
        $C .="\n\t\t\$form->setClass('form-horizontal');";
        $C .="\n\t\treturn \$form->getHTML();";
        $C .="\n\t}";
        $C.=$this->getSearchPartFieldSetCode($formInfo);
        $C.=$this->getDesignFormRowFunctionCode();
        $C .= "\n}";
        $C .= "\n?>";
        $DesignFile=$this->getFormDir() . "/" .  $FormName ."search_Design.design.php";
        $this->SaveFile($DesignFile,$C);
    }
}

?>
