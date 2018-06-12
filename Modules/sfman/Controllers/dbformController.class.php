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


class dbformController extends Controller {
	private $ModuleDir;
	private $JDate;
	private $CDate;
	private $SFHVERSION="2.001";
    private $SFVERSION="1.018";
    private $TableName;
    private $TableFields;

	public function load($id)
	{
		$DBAccessor=new dbaccess();
		$result=array();
		$formEnt=new sfman_formEntity($DBAccessor);
		$mEnt=new sfman_moduleEntity($DBAccessor);
		$eEnt=new sfman_formelementEntity($DBAccessor);
		$eTEnt=new sfman_formelementtypeEntity($DBAccessor);
		$result['elementtypes']=$eTEnt->Select(null,null,null,array('id'),array(false),"0,50");
		$result['form']=$formEnt->Select($id,null,null,null,null,array('id'),array(false),"0,1")[0];
		$result['module']=$mEnt->Select($result['form']['module_fid'],null,null,null,array('id'),array(false),"0,1")[0];
		$result['elements']=$eEnt->Select(null,$id,null,null,null,null,array('priority'),array(false),"0,300");
		$DBAccessor->close_connection();
		return $result;
	}
	public function loadElement($id)
	{
		$DBAccessor=new dbaccess();
		$result=array();
		$eEnt=new sfman_formelementEntity($DBAccessor);
		$result['element']=$eEnt->Select($id,null,null,null,null,null,array('id'),array(false),"0,1");
		$DBAccessor->close_connection();
		return $result;
	}
	public function deleteElement($id)
	{
		$DBAccessor=new dbaccess();
		$result=array();
		$eEnt=new sfman_formelementEntity($DBAccessor);
		$result['element']=$eEnt->Delete($id);
		$DBAccessor->close_connection();
		return $result;
	}

	public function addElement($FormID, $ItemType, $ItemName, $ItemTitle)
	{
		$DBAccessor=new dbaccess();
		$eEnt=new sfman_formelementEntity($DBAccessor);
        $Priority=0;
        $MaxPrt=$eEnt->Select(null,$FormID,null,null,null,null,array('priority'),array(true),"0,1");
        if($MaxPrt!=null  && is_array($MaxPrt) && count($MaxPrt)>0)
            $Priority=$MaxPrt[0]['priority']+1;
		$eEnt->Insert($FormID,$ItemType,$ItemName,$ItemTitle,$Priority);
	}

    public function moveUp($elementID)
    {
        $DBAccessor=new dbaccess();
        $eEnt=new sfman_formelementEntity($DBAccessor);
        $theRec=$eEnt->Select($elementID,null,null,null,null,null,array('id'),array(false),"0,1");
        $FormElements=$eEnt->Select(null,$theRec[0]['form_fid'],null,null,null,null,array('priority'),array(false),"0,100");
        $curPrt=$theRec[0]['priority'];
        $beforeCurIndex=-1;
        $tmpPrt=0;
        for($i=0;$i<count($FormElements) && $tmpPrt<$curPrt;$i++,$tmpPrt=$FormElements[$i]['priority'])
        {
            if($tmpPrt<$curPrt)
                $beforeCurIndex=$i;
        }
        $beforeCurPrt=$FormElements[$beforeCurIndex]['priority'];
        if($beforeCurIndex!=-1) {
            $eEnt->Update($FormElements[$beforeCurIndex]['id'],null, null, null, null, $curPrt);
            $eEnt->Update($elementID,null, null, null, null, $beforeCurPrt);
        }
    }

	public function moveDown($elementID)
	{
        $DBAccessor=new dbaccess();
        $eEnt=new sfman_formelementEntity($DBAccessor);
        $theRec=$eEnt->Select($elementID,null,null,null,null,null,array('id'),array(false),"0,1");
        $formInfo=$this->load($theRec[0]['form_fid']);
        $FormElements=$formInfo['elements'];
        $curPrt=$theRec[0]['priority'];
        $beforeCurIndex=-1;
        $tmpPrt=1000;
        for($i=count($FormElements)-1;$i>=0 && $tmpPrt>$curPrt;$i--,$tmpPrt=$FormElements[$i]['priority'])
        {

                $beforeCurIndex=$i;
        }
        $beforeCurPrt=$FormElements[$beforeCurIndex]['priority'];
        if($beforeCurIndex!=-1) {
            $eEnt->Update($FormElements[$beforeCurIndex]['id'],null, null, null, null, $curPrt);
            $eEnt->Update($elementID,null, null, null, null, $beforeCurPrt);
        }
	}

	public function editElement($id, $FormID, $ItemType, $ItemName, $ItemTitle)
	{
		$DBAccessor=new dbaccess();
		$eEnt=new sfman_formelementEntity($DBAccessor);
		$eEnt->Update($id,$FormID,$ItemType,$ItemName,$ItemTitle,null);
	}
	private function getTableFields($TableName)
    {
        $tblEnt=new sfman_tableEntity(null,$TableName);
        return $tblEnt->GetCollumns();
    }
    public function generateManageForms($Module,$TableName)
	{
        $this->TableName=$TableName;
        $mDir=DEFAULT_APPPATH;
        $this->JDate=AppDate::today();
        $this->CDate=AppDate::cnow();
        $mName=$Module;
        $fName=$TableName;
        $fName="manage" . $fName;
        $this->ModuleDir=$mDir . "Modules/" .  $mName;
        $controllerFile=$this->ModuleDir . '/Controllers/' . $fName ."Controller.class.php";
        $FormDir=$this->ModuleDir . '/Forms';
        $codeFile= $FormDir . "/" . $fName ."_Code.code.php";
        $designFile=$FormDir . "/" .  $fName ."_Design.design.php";

        if($this->TableName!=null)
            $this->TableFields=$this->getTableFields($mName . "_" . $this->TableName);
        $formInfo['module']['name']=$Module;
        $formInfo['form']['name']="manage".$TableName;
        $formInfo['form']['caption']="manage ".$TableName;

        $skippedCollumns=0;
        for($i=0;$i<count($this->TableFields);$i++) {
            $E=$this->TableFields[$i];
            if($E=="deletetime" || $E=="id" || $E=="role_systemuser_fid")
                $skippedCollumns++;
            else
            {
                $formInfo['elements'][$i-$skippedCollumns]['name']=$E;
                $formInfo['elements'][$i-$skippedCollumns]['caption']=$E;
                if(substr($E,strlen($E)-4)=="_fid")
                    $formInfo['elements'][$i-$skippedCollumns]['type_fid']=3;
                elseif(substr($E,0,2)=="is")
                    $formInfo['elements'][$i-$skippedCollumns]['type_fid']=5;
                else
                    $formInfo['elements'][$i-$skippedCollumns]['type_fid']=2;
            }
        }
        $formInfo['elements'][$i-$skippedCollumns]['name']="btnSave";
        $formInfo['elements'][$i-$skippedCollumns]['caption']="ذخیره";
        $formInfo['elements'][$i-$skippedCollumns]['type_fid']=7;
        $DBAccessor=new dbaccess();
        $eTEnt=new sfman_formelementtypeEntity($DBAccessor);
        $formInfo['elementtypes']=$eTEnt->Select(null,null,null,array('id'),array(false),"0,50");
        $DBAccessor->close_connection();
        $this->generateCode(-1,null,$formInfo);
        $FieldFillCode="";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $Ename=$formInfo['elements'][$i]['name'];
            if($Ename!="deletetime" && $Ename!="id" && $Ename!="role_systemuser_fid" ) {
                if($formInfo['elements'][$i]['type_fid']==3) {
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
        $this->generateTableManageController($formInfo,$controllerFile,$TableName);
        $this->makeFormDesign($formInfo,$designFile,null,$FieldFillCode);
        $this->TableName=$TableName;
        $formInfo['form']['name']="manage".$TableName . "s";
        $this->generateCode(-1,$TableName,$formInfo);
        $formInfo['form']['name']=$TableName . "list";
        $this->generateCode(-1,$TableName,$formInfo);
       // $this->makeManageFormCode($codeFile,$TableName);
       // $this->makeManageFormController($controllerFile,$TableName);
      //  $this->makeChangeLog($changeLogFile,$TableName);
	}
    private function getFieldName($i)
    {
            $fl = $this->TableFields[$i];
            $Last4Chars = substr($fl, strlen($fl) - 4);
        $EntityName=null;
            if ($Last4Chars == "_fid" && $fl!="role_systemuser_fid") {
                $FieldName = substr($fl, 0, strlen($fl) - 4);
                $EntityName = $FieldName;
                $LastUnderLinePlace = strrpos($FieldName, "_");
                if ($LastUnderLinePlace > 0)
                    $EntityName = substr($FieldName, $LastUnderLinePlace+1);
            }
        return $EntityName;
    }
    private function generateTableManageController($formInfo,$controllerFile,$TableName)
    {
        $formName=$formInfo['form']['name'];
        $moduleName=$formInfo['module']['name'];
        $EntityNames=array();

        $EntityClassName=$moduleName . "_" . $TableName . "Entity";;
        $C = "<?php";
        $C .= "\nnamespace Modules\\$moduleName\\Controllers;";
        $C .= "\nuse core\\CoreClasses\\services\\Controller;";
        $C .= "\nuse core\\CoreClasses\\db\\dbaccess;";
        $C .= "\nuse core\\CoreClasses\\db\\QueryLogic;";
        $C .= "\nuse Modules\\languages\\PublicClasses\\CurrentLanguageManager;";
        $C .= "\nuse Modules\\users\\PublicClasses\\sessionuser;";
        $C .= "\nuse Modules\\$moduleName\\Entity\\$EntityClassName;";
        for($i=0;$i<count($this->TableFields);$i++) {
            $fl1=$this->getFieldName($i);
            if($fl1!=null && array_search($fl1,$EntityNames)==null) {
                $fl = $moduleName . "_" . $fl1 . "Entity";
                //echo array_search($fl,$EntityNames);
                $C .= "\nuse Modules\\$moduleName\\Entity\\$fl;";
            }
            $EntityNames[$i]=$fl1;
        }
        $C.=$this->getFileInfoComment();
        $C .= "\nclass $formName" . "Controller extends Controller {";
        $C .= "\n\tpublic function load(\$ID)";
        $C .= "\n\t{";
        $C .= "\n\t\t\$Language_fid=CurrentLanguageManager::getCurrentLanguageID();";
        $C .= "\n\t\t\$DBAccessor=new dbaccess();";
        $C .= "\n\t\t\$su=new sessionuser();";
        $C .= "\n\t\t\$role_systemuser_fid=\$su->getSystemUserID();";
        $C .= "\n\t\t\$result=array();";
        $ObjectName="\$" . $TableName . "EntityObject";
        $C .= "\n\t\t$ObjectName=new $EntityClassName(\$DBAccessor);";
        for($i=0;$i<count($this->TableFields);$i++) {
            $fl1=$this->getFieldName($i);
            if($fl1!=null) {
                $fl = $moduleName . "_" . $fl1 . "Entity";
                $FiledName=substr($this->TableFields[$i],0,strlen($this->TableFields[$i])-4);
                $ObjectName2="\$" . $FiledName . "EntityObject";
                $C .= "\n\t\t\t$ObjectName2=new " .  $fl . "(\$DBAccessor);";
                $C .= "\n\t\t\t\$result['" . $this->TableFields[$i] . "']=$ObjectName2" . "->FindAll(new QueryLogic());";
            }
        }
        $C .= "\n\t\tif(\$ID!=-1){";
        $C .= "\n\t\t\t$ObjectName" . "->setId(\$ID);";
        $C .= "\n\t\t\t\$result['$TableName']=$ObjectName;";
        $C .= "\n\t\t}";
        $C .= "\n\t\t\$result['param1']=\"\";";
        $C .= "\n\t\t\$DBAccessor->close_connection();";
        $C .= "\n\t\treturn \$result;";
        $C .= "\n\t}";

        $InsertCode = "\n\t\t\t$ObjectName=new $EntityClassName(\$DBAccessor);";
        $InsertCode.=$this->getEntityObjectFieldSetCode($ObjectName,$EntityClassName);
        $InsertCode .= "\n\t\t\t$ObjectName" . "->Save();";

        $UpdateCode = "\n\t\t\t$ObjectName=new $EntityClassName(\$DBAccessor);";
        $UpdateCode .= "\n\t\t\t$ObjectName" . "->setId(\$ID);";
        $UpdateCode.=$this->getEntityObjectFieldSetCode($ObjectName,$EntityClassName);
        $UpdateCode .= "\n\t\t\t$ObjectName" . "->Save();";
        for($i=0;$i<count($formInfo['elements']);$i++)
            if($formInfo['elements'][$i]['type_fid']==7)
                $C.=$this->getActionFormController($formInfo,$formInfo['elements'][$i]['name'],$InsertCode,$UpdateCode);

        $C .= "\n}";
        $C .= "\n?>";
        file_put_contents($controllerFile, $C);

        chmod($controllerFile,0777);

    }
    private function getEntityObjectFieldSetCode($ObjectName,$EntityClassName)
    {
        $InsertCode = "";
        for($i=0;$i<count($this->TableFields);$i++)
        {
            if($this->TableFields[$i]!="id" && $this->TableFields[$i]!="deletetime"){
                $UCField=$this->TableFields[$i];
                $InsertCode .= "\n\t\t\t$ObjectName" . "->set" . ucwords($UCField) . "(\$$UCField);";}
        }
        return $InsertCode;
    }
	private function getDesignUsings()
	{
        $C = "\nuse core\\CoreClasses\\services\\FormDesign;";
        $C .= "\nuse core\\CoreClasses\\html\\ListTable;";
        $C .= "\nuse core\\CoreClasses\\html\\Div;";
        $C .= "\nuse core\\CoreClasses\\html\\link;";
        $C .= "\nuse core\\CoreClasses\\html\\Lable;";
        $C .= "\nuse core\\CoreClasses\\html\\TextBox;";
        $C .= "\nuse core\\CoreClasses\\html\\DataComboBox;";
        $C .= "\nuse core\\CoreClasses\\html\\SweetButton;";
        $C .= "\nuse core\\CoreClasses\\html\\CheckBox;";
        $C .= "\nuse core\\CoreClasses\\html\\RadioBox;";
        $C .= "\nuse core\\CoreClasses\\html\\SweetFrom;";
        $C .= "\nuse core\\CoreClasses\\html\\ComboBox;";
        $C .= "\nuse core\\CoreClasses\\html\\FileUploadBox;";
        $C .= "\nuse Modules\\common\\PublicClasses\\AppRooter;";
        $C .= "\nuse Modules\\common\\PublicClasses\\UrlParameter;";
        return $C;
	}
	public function generateCode($FormID,$TableName=null,$formInfo=null)
	{
        $this->TableName=$TableName;
        $mDir=DEFAULT_APPPATH;
        $this->JDate=AppDate::today();
        $this->CDate=AppDate::cnow();

        $mName=$formInfo['module']['name'];
        $fName=$formInfo['form']['name'];
        $this->ModuleDir=$mDir . "Modules/" .  $mName;
        $FormDir=$this->ModuleDir . '/Forms';
        $codeFile= $FormDir . "/" . $fName ."_Code.code.php";
        $designFile=$FormDir . "/" .  $fName ."_Design.design.php";
        $controllerFile=$this->ModuleDir . '/Controllers/' . $fName ."Controller.class.php";
        $changeLogFile=$this->ModuleDir . "/changelog.php";
        if($this->TableName!=null){
            $this->TableFields=$this->getTableFields($mName . "_" . $this->TableName);
        }
	    if($formInfo===null)
		    $formInfo=$this->load($FormID);



		$this->makeModuleDir("");
		$this->makeModuleDir("Forms");
		$this->makeModuleDir("Controllers");
		$this->makeModuleDir("Entity");
		$this->makeModuleDir("Exceptions");
		$this->makeModuleDir("Files");
		$this->makeModuleDir("Files/JS");
		$this->makeModuleDir("Files/PHP");
		$this->makeModuleDir("Files/Text");
		$this->makeModuleDir("PublicClasses");
		$this->makeModuleDir("languages");

		$this->makeFormDesign($formInfo,$designFile,$TableName);
		$this->makeFormCode($formInfo,$codeFile,$TableName);
		$this->makeFormController($formInfo,$controllerFile,$TableName);
        $this->makeChangeLog($formInfo,$changeLogFile,$TableName);
	}
    private function makeFormDesign($formInfo,$designFile,$TableName=null,$FieldFillCode="")
    {
        $ModuleName=$formInfo['module']['name'];
        $FormName=$formInfo['form']['name'];
        $C = "<?php";
        $C .= "\nnamespace Modules\\" . $ModuleName . "\\Forms;";
        $C.=$this->getDesignUsings();
        $C.=$this->getFileInfoComment();
        $C .= "\nclass " . $FormName . "_Design extends FormDesign {";
        $C .= "\n\tprivate \$Data;";

        $C.=$this->getSetterCode("Data","mixed");
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $E=$formInfo['elements'][$i];
            $ind=$this->getTypeIndex($formInfo['elementtypes'],$E['type_fid']);
            $EType=$formInfo['elementtypes'][$ind]['name'];
            $C .= "\n\t/**";
            $C .= " @var $EType";
            $C .= " */";
            $C .= "\n\tprivate \$" . $E['name'] . ";";
            if($E['type_fid']==2 || $E['type_fid']==3 || $E['type_fid']==4 || $E['type_fid']==5 || $E['type_fid']==6 || $E['type_fid']==8)
                $C.=$this->getGetterCode($E['name'],$EType);
        }



        $C .="\n\tpublic function __construct()";
        $C .="\n\t{";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $C.=$this->getDesignInitialization($formInfo,$i);
        }
        $C .="\n\t}";



        $C .="\n\tpublic function getBodyHTML(\$command=null)";
        $C .="\n\t{";
        $C.=$FieldFillCode;
        $C .="\n\t\t\$Page=new Div();";
        $C .="\n\t\t\$Page->setClass(\"sweet_formtitle\");";
        $C .="\n\t\t\$Page->setId(\"".$ModuleName . "_" . $FormName ."\");";
        $C .="\n\t\t\$PageTitlePart=new Div();";
        $C .="\n\t\t\$PageTitlePart->setClass(\"sweet_pagetitlepart\");";
        $C .="\n\t\t\$PageTitlePart->addElement(new Lable(\"".$formInfo['form']['caption']."\"));";
        $C .="\n\t\t\$Page->addElement(\$PageTitlePart);";
        $C .="\n\t\t\$MessagePart=new Div();";
        $C .="\n\t\t\$MessagePart->setClass(\"sweet_messagepart\");";
        $C .="\n\t\t\$MessagePart->addElement(new Lable(\$this->getMessage()));";
        $C .="\n\t\t\$Page->addElement(\$MessagePart);";

        if($this->TableName==null)
        {
            $C .="\n\t\t\$LTable1=new ListTable(2);";
            $C .="\n\t\t\$LTable1->setClass(\"formtable\");";
            for($i=0;$i<count($formInfo['elements']);$i++) {
                $C .=$this->getDesignAddCode($formInfo,$i);
            }
        }
        else
        {
            $fieldcount=count($this->TableFields);
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
            $C .="\n\t\t\$LTable1->addElement(new Lable('Title'));";
            $C .="\n\t\t\$LTable1->setLastElementClass(\"listtitle\");";
            $C .="\n\t\t\$LTable1->addElement(new Lable('Operations'));";
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
            $C .="\n\t\t\t\$lbDel[\$i]=new Lable('Delete');";
            $C .="\n\t\t\t\$liDel[\$i]=new link(\$delurl->getAbsoluteURL(),\$lbDel[\$i]);";
            $C .="\n\t\t\t\$LTable1->addElement(new Lable(\$i+1));";
            $C .="\n\t\t\t\$LTable1->setLastElementClass(\"listcontent\");";
            $C .="\n\t\t\t\$LTable1->addElement(\$liTit[\$i]);";
            $C .="\n\t\t\t\$LTable1->setLastElementClass(\"listcontent\");";
            $C .="\n\t\t\t\$LTable1->addElement(\$liDel[\$i]);";
            $C .="\n\t\t\t\$LTable1->setLastElementClass(\"listcontent\");";
            $C .="\n\t\t}";
        }
        $C .="\n\t\t\$Page->addElement(\$LTable1);";
        $C .="\n\t\t\$form=new SweetFrom(\"\", \"POST\", \$Page);";
        $C .="\n\t\treturn \$form->getHTML();";
        $C .="\n\t}";
        $C .= "\n}";

        $C .= "\n?>";
        file_put_contents($designFile, $C);

        chmod($designFile,0777);

    }
	private function makeFormCode($formInfo,$codeFile,$TableName=null)
	{
		$formName=$formInfo['form']['name'];
		$moduleName=$formInfo['module']['name'];
		$C = "<?php";
		$C .= "\nnamespace Modules\\" . $formInfo['module']['name'] . "\\Forms;";
		$C .= "\nuse core\\CoreClasses\\services\\FormCode;";
		$C .= "\nuse Modules\\languages\\PublicClasses\\ModuleTranslator;";
		$C .= "\nuse Modules\\languages\\PublicClasses\\CurrentLanguageManager;";
		$C .= "\nuse Modules\\".$formInfo['module']['name'] . "\\Controllers\\" . $formInfo['form']['name'] . "Controller;";
		$C .= "\nuse Modules\\files\\PublicClasses\\uploadHelper;";
        $C.=$this->getFileInfoComment();

		$C .= "\nclass " . $formInfo['form']['name'] . "_Code extends FormCode {";
		$C .= "\n\tpublic function load()";
		$C .= "\n\t{";
		$C .= "\n\t\t\$$formName" . "Controller=new $formName" . "Controller();";
		$C .= "\n\t\t\$translator=new ModuleTranslator(\"$moduleName\");";
		$C .= "\n\t\t\$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());";
		if($TableName==null)
        {
            $C .= "\n\t\t\$Result=\$$formName" . "Controller->load(\$this->getID());";
        }
        else
        {
            $C .= "\n\t\tif(isset(\$_GET['delete']))";
            $C .= "\n\t\t\t\$Result=\$$formName" . "Controller->DeleteItem(\$this->getID());";
            $C .= "\n\t\telse{";
            $C .= "\n\t\t\t\$Result=\$$formName" . "Controller->load(\$this->getID(),\$this->getHttpGETparameter('pn',-1));";
            $C.="\n\t\t}";
        }
		$C .= "\n\t\t\$design=new $formName" . "_Design();";
		$C .= "\n\t\t\$design->setData(\$Result);";
		$C .= "\n\t\t\$design->setMessage(\"\");";
		$C .= "\n\t\treturn \$design->getBodyHTML();";
		$C .= "\n\t}";
		$C .= "\n\tpublic function getID()";
		$C .= "\n\t{";
		$C .= "\n\t\t\$id=-1;";
		$C .= "\n\t\tif(isset(\$_GET['id']))";
		$C .= "\n\t\t\t\$id=\$_GET['id'];";
		$C .= "\n\t\treturn \$id;";
		$C .= "\n\t}";
		for($i=0;$i<count($formInfo['elements']);$i++)
			if($formInfo['elements'][$i]['type_fid']==7)
				$C.=$this->getActionFormCode($formInfo,$formInfo['elements'][$i]['name']);
		$C .= "\n}";
		$C .= "\n?>";
		file_put_contents($codeFile, $C);

		chmod($codeFile,0777);

	}
	private function makeFormController($formInfo,$controllerFile,$TableName=null,$IsManager=true)
	{
		$formName=$formInfo['form']['name'];
		$moduleName=$formInfo['module']['name'];

        $EntityClassName=null;
		$C = "<?php";
		$C .= "\nnamespace Modules\\$moduleName\\Controllers;";
		$C .= "\nuse core\\CoreClasses\\services\\Controller;";
		$C .= "\nuse core\\CoreClasses\\db\\dbaccess;";
		$C .= "\nuse Modules\\languages\\PublicClasses\\CurrentLanguageManager;";
        $C .= "\nuse Modules\\users\\PublicClasses\\sessionuser;";
        $C .= "\nuse core\\CoreClasses\\db\\QueryLogic;";
        if($TableName!=null) {
            $EntityClassName=$moduleName . "_" . $TableName . "Entity";
            $C .= "\nuse Modules\\$moduleName\\Entity\\$EntityClassName;";
        }
		$C.=$this->getFileInfoComment();
		$C .= "\nclass $formName" . "Controller extends Controller {";
        $C .= "\n\tprivate \$PAGESIZE=10;";
		$C .= "\n\tpublic function load(\$ID";
		if($TableName!=null)
		    $C.=",\$PageNum";
        $C .=")";
		$C .= "\n\t{";
		$C .= "\n\t\t\$Language_fid=CurrentLanguageManager::getCurrentLanguageID();";
		$C .= "\n\t\t\$DBAccessor=new dbaccess();";
        $C .= "\n\t\t\$su=new sessionuser();";
        $C .= "\n\t\t\$role_systemuser_fid=\$su->getSystemUserID();";
        $C .= "\n\t\t\$result=array();";
        if($TableName==null)
        {
            $C .= "\n\t\tif(\$ID!=-1){";
            $C .= "\n\t\t\t//Do Something...";
            $C .= "\n\t\t}";
        }
        else
        {

            $C .= "\n\t\tif(\$PageNum<=0)";
            $C .= "\n\t\t\t\$PageNum=1;";
            $C .= "\n\t\t\$$TableName" . "Ent=new $EntityClassName(\$DBAccessor);";
            $C .= "\n\t\t\$q=new QueryLogic();";
            $C .= "\n\t\t\$allcount=\$$TableName" . "Ent" . "->FindAllCount(\$q);";
            $C .= "\n\t\t\$result['pagecount']=\$this->getPageCount(\$allcount,\$this->PAGESIZE);";
            $C .= "\n\t\t\$q->setLimit(\$this->getPageRowsLimit(\$PageNum,\$allcount));";
            $C .= "\n\t\t\$result['data']=\$$TableName" . "Ent" . "->FindAll(\$q);";
        }

		$C .= "\n\t\t\$result['param1']=\"\";";
		$C .= "\n\t\t\$DBAccessor->close_connection();";
		$C .= "\n\t\treturn \$result;";
		$C .= "\n\t}";
        if($TableName==null)
        {
            for($i=0;$i<count($formInfo['elements']);$i++)
                if($formInfo['elements'][$i]['type_fid']==7)
                    $C.=$this->getActionFormController($formInfo,$formInfo['elements'][$i]['name']);
        }
        elseif($IsManager)
        {
            $C .= "\n\tpublic function DeleteItem(\$ID)";
            $C .= "\n\t{";
            $C .= "\n\t\t\$Language_fid=CurrentLanguageManager::getCurrentLanguageID();";
            $C .= "\n\t\t\$DBAccessor=new dbaccess();";
            $C .= "\n\t\t\$$TableName" . "Ent=new $EntityClassName(\$DBAccessor);";

            $C .= "\n\t\t\$$TableName" . "Ent->setId(\$ID);";
            $C .= "\n\t\t\$$TableName" . "Ent->Remove();";

            $C .= "\n\t\treturn \$this->load(-1);";
            $C .= "\n\t\t\$DBAccessor->close_connection();";
            $C .="\n\t}";
        }
		$C .= "\n}";
		$C .= "\n?>";
		file_put_contents($controllerFile, $C);

		chmod($controllerFile,0777);

	}

	private function getSetterCode($DataName,$DataType)
	{
		$CDataName=ucwords($DataName);
		$C = "\n\t/**";
		$C .= "\n\t * @param $DataType \$$DataName";
		$C .= "\n\t */";
		$C .= "\n\tpublic function set$CDataName(\$$DataName)";
		$C .= "\n\t{";
		$C .= "\n\t\t\$this->$DataName = \$$DataName;";
		$C .= "\n\t}";
		return $C;
	}
	private function getGetterCode($DataName,$DataType)
	{
		$CDataName=ucwords($DataName);
		$C = "\n\t/**";
		$C .= "\n\t * @return $DataType";
		$C .= "\n\t */";
		$C .= "\n\tpublic function get$CDataName()";
		$C .= "\n\t{";
		$C .= "\n\t\treturn \$this->$DataName;";
		$C .= "\n\t}";
		return $C;
	}
	private function getActionFormCode($formInfo,$ActionName)
	{
		$formName=$formInfo['form']['name'];
		$moduleName=$formInfo['module']['name'];
		$C = "\n\tpublic function $ActionName". "_Click()";
		$C .= "\n\t{";
		$C .= "\n\t\t\$$formName" . "Controller=new $formName" . "Controller();";
		$C .= "\n\t\t\$translator=new ModuleTranslator(\"$moduleName\");";
		$C .= "\n\t\t\$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());";
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
		$C .= "\n\t\t\$Result=\$$formName" . "Controller->" . ucwords($ActionName) . "(\$this->getID(),$Params);";
		$C .= "\n\t\t\$design->setData(\$Result);";
		$C .= "\n\t\t\$design->setMessage(\"$ActionName is done!\");";
		$C .= "\n\t\treturn \$design->getBodyHTML();";
		$C .= "\n\t}";
		return $C;
	}
	private function getActionFormController($formInfo,$ActionName,$InsertCode=null,$UpdateCode=null)
	{
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

	private function getDesignAddCode(array $formInfo,$ElementIndex)
	{
		$E=$formInfo['elements'][$ElementIndex];
		$ElementTypeIndex=$this->getTypeIndex($formInfo['elementtypes'],$E['type_fid']);

		if($E['type_fid']==1)//Label
		{
			$C ="\n\t\t\$LTable1->addElement(\$this->".$E['name'].",2);";
            $C .="\n\t\t\$LTable1->setLastElementClass('form_item_fulllabel');";
		}
		else if($E['type_fid']==2)//TextBox
		{
			$C ="\n\t\t\$LTable1->addElement(new Lable(\"". $E['caption'] . "\"));";
            $C .="\n\t\t\$LTable1->setLastElementClass('form_item_caption');";
			$C.="\n\t\t\$LTable1->addElement(\$this->".$E['name'].");";
            $C .="\n\t\t\$LTable1->setLastElementClass('form_item_field');";
		}
		else if($E['type_fid']==3)//ComboBox
		{
			$C ="\n\t\t\$LTable1->addElement(new Lable(\"". $E['caption'] . "\"));";
            $C .="\n\t\t\$LTable1->setLastElementClass('form_item_caption');";
			$C.="\n\t\t\$LTable1->addElement(\$this->".$E['name'].");";
            $C .="\n\t\t\$LTable1->setLastElementClass('form_item_field');";
		}
		else if($E['type_fid']==4)//DataComboBox
		{
			$C ="\n\t\t\$LTable1->addElement(new Lable(\"". $E['caption'] . "\"));";
            $C .="\n\t\t\$LTable1->setLastElementClass('form_item_caption');";
			$C.="\n\t\t\$LTable1->addElement(\$this->".$E['name'].");";
            $C .="\n\t\t\$LTable1->setLastElementClass('form_item_field');";
		}
		else if($E['type_fid']==5)//CheckBox
		{

			$C ="\n\t\t\$LTable1->addElement(\$this->".$E['name'].",2);";
            $C .="\n\t\t\$LTable1->setLastElementClass('form_item_checkbox');";
		}
		else if($E['type_fid']==6)//FileUploadBox
		{
			$C ="\n\t\t\$LTable1->addElement(new Lable(\"". $E['caption'] . "\"));";
            $C.="\n\t\t\$LTable1->setLastElementClass('form_item_caption');";
			$C.="\n\t\t\$LTable1->addElement(\$this->".$E['name'].");";
            $C .="\n\t\t\$LTable1->setLastElementClass('form_item_field');";
		}
		else if($E['type_fid']==7)//SweetButton
		{
			$C ="\n\t\t\$LTable1->addElement(\$this->".$E['name'].",2);";
            $C .="\n\t\t\$LTable1->setLastElementClass('form_item_sweetbutton');";
		}
		else if($E['type_fid']==8)//RadioButton
		{

			$C ="\n\t\t\$LTable1->addElement(\$this->".$E['name'].",2);";
            $C .="\n\t\t\$LTable1->setLastElementClass('form_item_radio');";
		}
		return $C;
	}
	private function getDesignInitialization(array $formInfo,$ElementIndex)
	{
		$E=$formInfo['elements'][$ElementIndex];
		$ElementTypeIndex=$this->getTypeIndex($formInfo['elementtypes'],$E['type_fid']);
		$EType=$formInfo['elementtypes'][$ElementTypeIndex]['name'];
		$C = "\n\t\t\$this->" . $E['name'] . "= new " . $EType . "(";
		if($E['type_fid']==1)//Label
		{
			$C.="\"" . $E['caption'] . "\");";
		}
		else if($E['type_fid']==2)//TextBox
		{
			$C.="\"" . $E['name'] . "\");";
		}
		else if($E['type_fid']==3)//ComboBox
		{
			$C.="\"" . $E['name'] . "\");";
		}
		else if($E['type_fid']==4)//DataComboBox
		{
			$C.="\$this->Data['" . $E['name'] . "'],\"" . $E['name'] . "\");";
		}
		else if($E['type_fid']==5)//CheckBox
		{
			$C.="\"" . $E['name'] . "\");";
		}
		else if($E['type_fid']==6)//FileUploadBox
		{
			$C.="\"" . $E['name'] . "\");";
		}
		else if($E['type_fid']==7)//SweetButton
		{
			$C.="true,\"" . $E['caption'] . "\");";
			$C.="\n\t\t\$this->". $E['name']."->setAction(\"".$E['name']."\");";
		}
		else if($E['type_fid']==8)//RadioBox
		{
			$C.="\"" . $E['name'] . "\");";
			$C.="\n\t\t\$this->". $E['name']."->addOption(\"".$E['name']."\",$ElementIndex);";
		}
	return $C;
	}
	private function getTypeIndex($ElementTypes,$ID)
	{
		for($i=0;$i<count($ElementTypes);$i++)
			if($ElementTypes[$i]['id']==$ID)
				return $i;
		return -1;
	}
	private function makeModuleDir($Dir)
	{
		$Dir=$this->ModuleDir . "/" .$Dir;
		if(!file_exists($Dir)) {
			mkdir($Dir);
			chmod($Dir,0755);
			file_put_contents($Dir . "/index.html",file_get_contents($this->getTextsDirectory() . "accessdenied.txt"));
			chmod($Dir . "/index.html",0644);
		}
	}

    /**
     * @param array $formInfo
     * @param string $changeLogFile
     */
    private function makeChangeLog(array $formInfo, $changeLogFile,$TableName=null)
    {
        $C = "\n<?php";
        $C .= "\n/**";
        $C .= "\n*@SweetFrameworkHelperVersion " . $this->SFHVERSION;
        $C .= "\n*@SweetFrameworkVersion " . $this->SFVERSION;
        $C .= "\n*@Date " . $this->JDate . " - " . $this->CDate;
        $C .= "\n*@Module Name " . $formInfo['module']['name'] ;
        $C .= "\n*@ActionTitle Regenerate WholeFormFiles For " .  $formInfo['form']['name'] ;
        $C .= "\n*@ActionCode 1" ;
        $C .= "\n*/";
        $C .= "\n?>";
        file_put_contents($changeLogFile, $C,FILE_APPEND);
        chmod($changeLogFile,0777);

    }

    /**
     * @return string
     */
    private function getFileInfoComment()
    {
        $C = "\n/**";
        $C .= "\n*@author Hadi AmirNahavandi";
        $C .= "\n*@creationDate " . $this->JDate . " - " . $this->CDate;
        $C .= "\n*@lastUpdate " . $this->JDate . " - " . $this->CDate;
        $C .= "\n*@SweetFrameworkHelperVersion " . $this->SFHVERSION;
        $C .= "\n*@SweetFrameworkVersion " . $this->SFVERSION;
        $C .= "\n*/";
        return $C;
    }

}
?>
