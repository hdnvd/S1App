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
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $Ename=$formInfo['elements'][$i]['name'];

            $FieldFillCode .= "\r\n\r\n\t\t\t/******** $Ename" . " ********/";
            $FT=FieldType::getFieldType($Ename);
            if($FT!=FieldType::$METAINF && $FT!=FieldType::$ID && $Ename!="sortby" && $Ename!="isdesc") {
                if($formInfo['elements'][$i]['type_fid']==3) {
                    if($AddEmptyOption)
                        $FieldFillCode .= "\r\n\t\t\t\$this->$Ename" . "->addOption(\"\", \"مهم نیست\");";
                    if($FT==FieldType::$BOOLEAN)
                    {
                        if(strtolower($Ename)=="ismale")
                        {
                            $FieldFillCode .= "\r\n\t\t\t\$this->$Ename" . "->addOption(1,'مرد');";
                            $FieldFillCode .= "\r\n\t\t\t\$this->$Ename" . "->addOption(0,'زن');";
                        }
                        elseif(strtolower($Ename)=="ismarried")
                        {
                            $FieldFillCode .= "\r\n\t\t\t\$this->$Ename" . "->addOption(1,'متاهل');";
                            $FieldFillCode .= "\r\n\t\t\t\$this->$Ename" . "->addOption(0,'مجرد');";
                        }
                        else
                        {
                            $FieldFillCode .= "\r\n\t\t\t\$this->$Ename" . "->addOption(1,'بله');";
                            $FieldFillCode .= "\r\n\t\t\t\$this->$Ename" . "->addOption(0,'خیر');";
                        }
                    }
                    else
                    {
                        $FieldFillCode .= "\r\n\t\tforeach (\$this->Data['$Ename'] as \$item)";
                        $FieldFillCode .= "\r\n\t\t\t\$this->$Ename" . "->addOption(\$item->getID(), \$item->getTitleField());";
                    }
                    $FieldFillCode .= "\r\n\t\tif (key_exists(\"$TableName\", \$this->Data)){";
                    $FieldFillCode .= "\r\n\t\t\t\$this->$Ename" . "->setSelectedValue(\$this->Data['$TableName']->get" . ucwords($Ename) . "());";
                    $FieldFillCode .= "\r\n\t\t\t\$this->setFieldCaption('$Ename',\$this->Data['$TableName']->getFieldInfo('$Ename')->getTitle());";
                    $FieldFillCode .= "\r\n\t\t}";
                }
                elseif($formInfo['elements'][$i]['type_fid']==2) //TextBox
                {
                    $FieldFillCode .= "\r\n\t\tif (key_exists(\"$TableName\", \$this->Data)){";
                    $FieldFillCode .= "\r\n\t\t\t\$this->$Ename" . "->setValue(\$this->Data['$TableName']->get" . ucwords($Ename) . "());";
                    $FieldFillCode .= "\r\n\t\t\t\$this->setFieldCaption('$Ename',\$this->Data['$TableName']->getFieldInfo('$Ename')->getTitle());";
                    if($IsManagement)
                        $FieldFillCode .= "\r\n\t\t\t\$this->$Ename" . "->setFieldInfo(\$this->Data['$TableName']->getFieldInfo('$Ename'));";
                    $FieldFillCode .= "\r\n\t\t}";
                }

                elseif($formInfo['elements'][$i]['type_fid']==9) //DatePicker
                {
                    $FieldFillCode .= "\r\n\t\tif (key_exists(\"$TableName\", \$this->Data)){";
                    $FieldFillCode .= "\r\n\t\t\t\$this->$Ename" . "->setTime(\$this->Data['$TableName']->get" . ucwords($Ename) . "());";

                    $FieldFillCode .= "\r\n\t\t\t\$this->setFieldCaption('$Ename',\$this->Data['$TableName']->getFieldInfo('$Ename')->getTitle());";
                    if($IsManagement)
                        $FieldFillCode .= "\r\n\t\t\t\$this->$Ename" . "->setFieldInfo(\$this->Data['$TableName']->getFieldInfo('$Ename'));";
                    $FieldFillCode .= "\r\n\t\t}";
                }
                elseif($formInfo['elements'][$i]['type_fid']==6) {
                    $FieldFillCode .= "\r\n\t\tif (key_exists(\"$TableName\", \$this->Data)){";
                    $FieldFillCode .= "\r\n\t\t\t\$this->setFieldCaption('$Ename',\$this->Data['$TableName']->getFieldInfo('$Ename')->getTitle());";
                    $FieldFillCode .= "\r\n\t\t}";
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
            $C .=$this->getDesignAddCode($formInfo,$i);
        }

        $C .="\n\t\t\$Page->addElement(\$LTable1);";
        $C .="\n\t\t\$form=new SweetFrom(\"\", \"POST\", \$Page);";
        $C .="\n\t\t\$form->SetAttribute(\"novalidate\",\"novalidate\");";
        $C .="\n\t\t\$form->setClass('form-horizontal');";
        $C .="\n\t\treturn \$form->getHTML();";
        $C .="\n\t}";
        $C .="\n\tpublic function FillItems()";
        $C .="\n\t{";
        $C.=$this->getFieldFillCode($formInfo);
        $C .="\n\t}";
        $C .="\n\tpublic function __construct()";
        $C .="\n\t{";
        $C .="\n\t\tparent::__construct();";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $C.=$this->getDesignInitialization($formInfo,$i);
        }
        $C .="\n\t}";
        $C .= "\n\tprivate \$Data;";
        $C.=$this->getSetterCode("Data","mixed");
        $C.=<<<EOT
    \nprivate \$adminMode=true;

    /**
     * @param bool \$adminMode
     */
    public function setAdminMode(\$adminMode)
    {
        \$this->adminMode = \$adminMode;
    }
EOT;
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $C.=$this->getTableItemDesignElementDefineCode($formInfo,$i);
        }
        $C.=$this->getDesignFormRowFunctionCode();
        $C .= "\n}";

        $C .= "\n?>";
        file_put_contents($this->getDesignFile(), $C);

        chmod($this->getDesignFile(),0777);

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
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $Ename=$formInfo['elements'][$i]['name'];
            if(FieldType::getFieldType($Ename)==FieldType::$NORMAL || FieldType::getFieldType($Ename)==FieldType::$FILE) {
                $Val="\$this->Data['$TableName']->get" . ucwords($Ename) . "()";
                $C .= "\r\n\t\tif (key_exists(\"$TableName\", \$this->Data)){";
                $C .= "\r\n\t\t\t\$this->setFieldCaption('$Ename',\$this->Data['$TableName']->getFieldInfo('$Ename')->getTitle());";
                $C .= "\r\n\t\t\t\$this->$Ename" . "->setText($Val);";
                $C .= "\r\n\t\t}";
            }
            elseif(FieldType::getFieldType($Ename)==FieldType::$FID) {
                $Val="\$this->Data['$Ename']->getID()";
                $C .= "\r\n\t\tif (key_exists(\"$Ename\", \$this->Data)){";
                $C .= "\r\n\t\t\t\$this->setFieldCaption('$Ename',\$this->Data['$TableName']->getFieldInfo('$Ename')->getTitle());";
                $C .= "\r\n\t\t\t\$this->$Ename" . "->setText($Val);";
                $C .= "\r\n\t\t}";
            }
            elseif(FieldType::getFieldType($Ename)==FieldType::$DATE || FieldType::getFieldType($Ename)==FieldType::$AUTOTIME ) {
                $Val="\$this->Data['$TableName']->get" . ucwords($Ename) . "()";
                $C .= "\r\n\t\tif (key_exists(\"$TableName\", \$this->Data)){";
                $C .= "\r\n\t\t\t\$this->setFieldCaption('$Ename',\$this->Data['$TableName']->getFieldInfo('$Ename')->getTitle());";
                $C .= "\r\n\t\t\t\$". $Ename . "_SD=new SweetDate();";
                $C .= "\r\n\t\t\t\$". $Ename . "_Text=\$". $Ename . "_SD->date(\"l d F Y\",$Val);";
                $C .= "\r\n\t\t\t\$this->$Ename" . "->setText(\$". $Ename . "_Text);";
                $C .= "\r\n\t\t}";
            }
        }
        $C .="\n\t\t\$LTable1=new Div();";
        $C .="\n\t\t\$LTable1->setClass(\"formtable\");";
//        for($i=0;$i<count($formInfo['elements']);$i++) {
//            $E=$formInfo['elements'][$i];
//            $C.="\n\t\t\$LTable1->addElement(new Lable(\$this->getFieldCaption('".$E['name']."')));";
////            $C .="\n\t\t\$LTable1->setLastElementClass('form_item_titlelabel');";
//            $C.="\n\t\t\$LTable1->addElement(\$this->".$E['name'].");";
////            $C .="\n\t\t\$LTable1->setLastElementClass('form_item_datalabel');";
//        }
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $C .=$this->getDesignAddCode($formInfo,$i,false);
        }
        $C .="\n\t\t\$Page->addElement(\$LTable1);";
        $C .="\n\t\t\$form=new SweetFrom(\"\", \"POST\", \$Page);";
        $C .="\n\t\treturn \$form->getHTML();";
        $C .="\n\t}";

        $C.=$this->getDesignFormRowFunctionCode();
        $C .= "\n}";

        $C .= "\n?>";
        file_put_contents($this->getDesignFile(), $C);

        chmod($this->getDesignFile(),0777);

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
            $C.=<<<EOT
    \n\tprivate \$adminMode=true;
    private \$listPage;
    private \$itemPage;

    /**
     * @param bool \$adminMode
     */
    public function setAdminMode(\$adminMode)
    {
        \$this->adminMode = \$adminMode;
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
    public function getAdminMode()
    {
        return \$this->adminMode;
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
        $C .="\n\t\t\$LTable1->setClass(\"table-striped managelist\");";
        $C .="\n\t\t\$LTable1->addElement(new Lable('#'));";
        $C .="\n\t\t\$LTable1->setLastElementClass(\"listtitle\");";
        $C .="\n\t\t\$LTable1->addElement(new Lable('عنوان'));";
        $C .="\n\t\t\$LTable1->setLastElementClass(\"listtitle\");";
        $C .="\n\t\t\$LTable1->addElement(new Lable('عملیات'));";
        $C .="\n\t\t\$LTable1->setLastElementClass(\"listtitle\");";
        $C .="\n\t\tfor(\$i=0;\$i<count(\$this->Data['data']);\$i++){";
        $C .="\n\t\t\t\$url=new AppRooter('$ModuleName',\$this->itemPage);";
        $C .="\n\t\t\t\$url->addParameter(new UrlParameter('id',\$this->Data['data'][\$i]->getID()));";
        $C .="\n\t\t\t\$delurl=new AppRooter('$ModuleName',\$this->listPage);";
        $C .="\n\t\t\t\$delurl->addParameter(new UrlParameter('id',\$this->Data['data'][\$i]->getID()));";
        $C .="\n\t\t\t\$delurl->addParameter(new UrlParameter('delete',1));";
//        $TitleInd=$this->getTitleFieldIndex();
//        if($TitleInd!=-1)
//            $TitleField=$this->getCurrentTableFields()[$TitleInd];
//        else
//            $TitleField=$this->getCurrentTableFields()[1];
        $C .="\n\t\t\t\$Title=\$this->Data['data'][\$i]->getTitleField();";
        $C .="\n\t\t\tif(\$this->Data['data'][\$i]->getTitleField()==\"\")";
        $C .="\n\t\t\t\t\$Title='- بدون عنوان -';";
        $C .="\n\t\t\t\$lbTit[\$i]=new Lable(\$Title);";
        $C .="\n\t\t\t\$liTit[\$i]=new link(\$url->getAbsoluteURL(),\$lbTit[\$i]);";
        $C .="\n\t\t\t\$lbDel[\$i]=new Lable('حذف');";
        $C .="\n\t\t\t\$liDel[\$i]=new link(\$delurl->getAbsoluteURL(),\$lbDel[\$i]);";
        $C .="\n\t\t\t\$liDel[\$i]->setGlyphiconClass('glyphicon glyphicon-remove');";
        $C .="\n\t\t\t\$liDel[\$i]->setClass('btn btn-danger');";
        $C .="\n\t\t\t\$LTable1->addElement(new Lable(\$i+1));";
        $C .="\n\t\t\t\$LTable1->setLastElementClass(\"listcontent\");";
        $C .="\n\t\t\t\$LTable1->addElement(\$liTit[\$i]);";
        $C .="\n\t\t\t\$LTable1->setLastElementClass(\"listcontent\");";
        $C .="\n\t\t\t\$LTable1->addElement(\$liDel[\$i]);";
        $C .="\n\t\t\t\$LTable1->setLastElementClass(\"listcontent\");";
        $C .="\n\t\t}";
        $C .="\n\t\t\$TableDiv->addElement(\$LTable1);";
        $C .="\n\t\t\$Page->addElement(\$TableDiv);";
        $C .="\n\t\t\$Page->addElement(\$this->getPaginationPart(\$this->Data['pagecount'],\"".$this->getCodeModuleName()."\",\$this->listPage));";
        $C .="\n\t\t\$form=new SweetFrom(\"\", \"POST\", \$Page);";
        $C .="\n\t\treturn \$form->getHTML();";
        $C .="\n\t}";
        $C .= "\n}";

        $C .= "\n?>";
        file_put_contents($this->getDesignFile(), $C);

        chmod($this->getDesignFile(),0777);

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
        $C.=<<<EOT
    \n\tprivate \$adminMode=true;

    /**
     * @param bool \$adminMode
     */
    public function setAdminMode(\$adminMode)
    {
        \$this->adminMode = \$adminMode;
    }
    public function getAdminMode()
    {
        return \$this->adminMode;
    }
EOT;
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
            $C .=$this->getDesignAddCode($formInfo,$i);
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

//        $TitleInd=$this->getTitleFieldIndex();
//        if($TitleInd!=-1)
//            $TitleField=$this->getCurrentTableFields()[$TitleInd];
//        else
//            $TitleField=$this->getCurrentTableFields()[1];
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

        $C .="\n\tpublic function FillItems()";
        $C .="\n\t{";
        $C.=$this->getFieldFillCode($formInfo,true,false);

        $C .= "\n\t\t\t\$this->isdesc->addOption('0','صعودی');";
        $C .= "\n\t\t\t\$this->isdesc->addOption('1','نزولی');";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $E=$formInfo['elements'][$i];
            $C .= "\n\n\t\t/******** ".$E['name']." ********/";
            $C .= "\n\t\t\$this->sortby->addOption('".$E['name']."',\$this->getFieldCaption('".$E['name']."'));";
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
        $C .="\n\tpublic function __construct()";
        $C .="\n\t{";
        $C .="\n\t\tparent::__construct();";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $C.=$this->getDesignInitialization($formInfo,$i);
        }
        $C .="\n\t}";

        $C.=$this->getDesignFormRowFunctionCode();
        $C .= "\n}";

        $C .= "\n?>";
        file_put_contents($this->getDesignFile(), $C);

        chmod($this->getDesignFile(),0777);

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
            $TitleInd=array_search("mellicode",$Fields);
        if($TitleInd===false)
            $TitleInd=array_search("email",$Fields);
        if($TitleInd===false)
            $TitleInd=array_search("id",$Fields);
        return $TitleInd;
    }
    protected function makeTableSearchDesign($formInfo)
    {
        $TableName=$this->getTableName();
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
        $C .="\n\t\tparent::__construct();";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $C.=$this->getDesignInitialization($formInfo,$i);
        }
        $C .="\n\t}";
        $C .="\n\tpublic function getBodyHTML(\$command=null)";
        $C .="\n\t{";

        $C.="\n\t\t\$this->FillItems();";
        $C .=$this->getDesignTopPartCode();
        $C .="\n\t\t\$LTable1=new Div();";
        $C .="\n\t\t\$LTable1->setClass(\"searchtable\");";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $C .=$this->getDesignAddCode($formInfo,$i);
        }


        $C .="\n\t\t\$Page->addElement(\$LTable1);";
        $C .="\n\t\t\$form=new SweetFrom(\"\", \"GET\", \$Page);";
        $C .="\n\t\t\$form->setClass('form-horizontal');";
        $C .="\n\t\treturn \$form->getHTML();";
        $C .="\n\t}";

        $C .="\n\tpublic function FillItems()";
        $C .="\n\t{";
        $C.=$this->getFieldFillCode($formInfo,true,false);
        $C .= "\n\t\t\t\$this->isdesc->addOption('0','صعودی');";
        $C .= "\n\t\t\t\$this->isdesc->addOption('1','نزولی');";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $E=$formInfo['elements'][$i];
            $C .= "\n\n\t\t/******** ".$E['name']." ********/";
            if($E['type_fid']==2 || $E['type_fid']==3 || $E['type_fid']==4 || $E['type_fid']==9)
                if(strtolower($E['name'])!="sortby" && strtolower($E['name'])!="isdesc")
                    $C .= "\n\t\t\$this->sortby->addOption('".$E['name']."',\$this->getFieldCaption('".$E['name']."'));";
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
        $C.=$this->getDesignFormRowFunctionCode();
        $C .= "\n}";

        $C .= "\n?>";

        $DesignFile=$this->getFormDir() . "/" .  $FormName ."search_Design.design.php";
        file_put_contents($DesignFile, $C);

        chmod($DesignFile,0777);

    }
}

?>
