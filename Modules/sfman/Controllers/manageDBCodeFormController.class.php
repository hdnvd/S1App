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

abstract class manageDBCodeFormController extends manageDBControllerFormController {

    public static $ACTIONTYPE_NOTDEFINED=1;
    public static $ACTIONTYPE_LIST=2;
    public static $ACTIONTYPE_SEARCH=3;
    public static $ACTIONTYPE_SAVE=4;
    protected function getIsItemSelected($FormsToGenerate,$ItemName)
    {
        if($FormsToGenerate!=null && array_search($ItemName,$FormsToGenerate)!==false)
            return true;
        return false;
    }
    protected function fillGETParamValueGetters($formInfo,&$Params,&$GetterCode)
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
            elseif($E['type_fid']==9)//DatePicker
            {
                $ParamName="\$" . $E['name'];
                $C.="\n\t\t$ParamName=DatePicker::getTimeFromText(\$_GET['" . $E['name'] . "']);";
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
    protected function fillPostParamValueGetters($formInfo,&$Params,&$GetterCode)
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
            elseif($E['type_fid']==9)//DatePicker
            {
                $ParamName="\$" . $E['name'];
                $C.="\n\t\t$ParamName=\$design->get" . ucwords($E['name']) . "()->getTime();";
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
                $C.="\n\t\tfor(\$fileIndex=0;\$fileIndex<count($ParamName1) && $ParamName1" . "[\$fileIndex]!=null;\$fileIndex++){";
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
    protected function getActionFormCode($formInfo,$ActionName,$FirstParam=null,$ParamMethodisPost=true,$isManager=false)
    {
        if($FirstParam==null)
            $FirstParam="\$this->getID(),";
        $ActionType=null;
        if(strtolower($ActionName)=="search")
            $ActionType=manageDBCodeFormController::$ACTIONTYPE_SEARCH;
        if(strtolower($ActionName)=="save" || strtolower($ActionName)=="btnsave" )
            $ActionType=manageDBCodeFormController::$ACTIONTYPE_SAVE;
        $formName=$formInfo['form']['name'];
        $moduleName=$formInfo['module']['name'];
        $C = "\n\tpublic function $ActionName". "_Click()";
        $C .= "\n\t{";
        $C .= $this->getFormCodeActionInits($isManager);
        $C .= "\n\t\ttry{";
        if($ActionType==manageDBCodeFormController::$ACTIONTYPE_SEARCH){
            $C .= "\n\t\t\$design=\$this->searchForm;";
            $C .= "\n\t\t\$design->setAdminMode(\$this->getAdminMode());";
            $C .= "\n\t\t\$$formName" . "Controller->setAdminMode(\$this->getAdminMode());";
        }
        else
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
        if($ActionType==null)
            $C .= "\n\t\t\$design->setMessage(\"$ActionName is done!\");";
        if($ActionType==manageDBCodeFormController::$ACTIONTYPE_SAVE){
            $C .= "\n\t\t\$design->setMessage(\"اطلاعات با موفقیت ذخیره شد.\");";
            $C .= "\n\t\t\$design->setMessageType(MessageType::\$SUCCESS);";
            if($isManager)
            {
                $C .= "\n\t\tif(\$this->getAdminMode()){";
                $C .= "\n\t\t\t\$ManageListRooter=new AppRooter(\"$moduleName\",\"$formName" . "s\");";
                $C .= "\n\t\t}";
                if(key_exists('userform',$formInfo) && $formInfo['userform']['name']!=null)
                {
                    $C .= "\n\t\telse{";
                    $C .= "\n\t\t\t\$ManageListRooter=new AppRooter(\"$moduleName\",\"" . $formInfo['userform']['name'] . "s\");";
                    $C .= "\n\t\t}";
                }
                $C .= "\n\t\t\tAppRooter::redirect(\$ManageListRooter->getAbsoluteURL(),1000);";
            }
        }
        if($ActionType==manageDBCodeFormController::$ACTIONTYPE_SEARCH){
            $C .= "\n\t\tif(\$Result['data']==null || count(\$Result['data'])==0){";
            $C .= "\n\t\t\t\$design->setMessage(\"متاسفانه هیچ نتیجه ای برای این جستجو پیدا نشد.\");";
            $C .= "\n\t\t\t\$design->setMessageType(MessageType::\$ERROR);";
            $C .= "\n\t\t}else{";
            $C .= "\n\t\t\t\$design->setMessage(\"نتایج جستجو : \");";
            $C .= "\n\t\t\t\$design->setMessageType(MessageType::\$INFORMATION);";
            $C .= "\n\t\t}";

        }
        $C .= "\n\t\t}";
        $C .= $this->getNotFoundCatchPart();
        $C .= $this->getUnknownCatchPart();
        $C .= "\n\t\treturn \$design->getBodyHTML();";
        $C .= "\n\t}";
        return $C;
    }
    protected function getActionUsingGetFormCode($formInfo,$ActionName,$FirstParam="\$this->getID(),")
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

    protected function getTableItemCode($formInfo,$isManager)
    {
        $formName=$formInfo['form']['name'];

        $C = "<?php";
        $C .=$this->getFormNamespaceDefiner();
        $C .= $this->getFormCodeUsage();
        $C.=$this->getFileInfoComment();

        $C .= "\nclass " . $formInfo['form']['name'] . "_Code extends FormCode {";
        if($isManager)
            $C.=<<<EOT
    \nprivate \$adminMode=true;

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
        $C .= "\n\tpublic function load()";
        $C .= "\n\t{";
        $C .= $this->getFormCodeActionInits($isManager);
        $C .= "\n\t\ttry{";
        $C .= "\n\t\t\t\$Result=\$$formName" . "Controller->load(\$this->getID());";
        $C .= "\n\t\t\t\$design=new $formName" . "_Design();";
        if($isManager)
            $C .= "\n\t\t\t\$design->setAdminMode(\$this->adminMode);";

        $C .= "\n\t\t\t\$design->setData(\$Result);";
        $C .= "\n\t\t\t\$design->setMessage(\"\");";
        $C .= "\n\t\t}";
        $C .= $this->getNotFoundCatchPart();
        $C .= $this->getUnknownCatchPart();
        $C .= "\n\t\treturn \$design->getBodyHTML();";
        $C .= "\n\t}";

        $C.=$this->getFormCodeConstructor($formInfo);
        $C .= "\n\tpublic function getID()";
        $C .= "\n\t{";
        $C .= "\n\t\t\$id=-1;";
        $C .= "\n\t\tif(isset(\$_GET['id']))";
        $C .= "\n\t\t\t\$id=\$_GET['id'];";
        $C .= "\n\t\treturn \$id;";
        $C .= "\n\t}";
        return $C;
    }
    protected function getFormCodeConstructor($formInfo)
    {
        $C = "\n\tpublic function __construct(\$namespace)";
        $C .= "\n\t{";
        $C .= "\n\t\tparent::__construct(\$namespace);";
        $C .= "\n\t\t\$this->setTitle(\"".$formInfo['form']['caption']."\");";
        $C .= "\n\t}";
        return $C;
    }
	protected function makeTableItemManageCode($formInfo)
	{
		$formName=$formInfo['form']['name'];
		$C=$this->getTableItemCode($formInfo,true);
		for($i=0;$i<count($formInfo['elements']);$i++)
			if($formInfo['elements'][$i]['type_fid']==7)
				$C.=$this->getActionFormCode($formInfo,$formInfo['elements'][$i]['name'],null,true,true);
		$C .= "\n}";
		$C .= "\n?>";
		file_put_contents($this->getCodeFile(), $C);

		chmod($this->getCodeFile(),0777);

	}
    protected function makeTableItemCode($formInfo)
    {
        $C=$this->getTableItemCode($formInfo,false);
        $C .= "\n}";
        $C .= "\n?>";
        file_put_contents($this->getCodeFile(), $C);

        chmod($this->getCodeFile(),0777);

    }
    protected function makeTableManageListCode($formInfo)
    {
        $formName=$formInfo['form']['name'];
        $ListName=$formInfo['form']['listname'];
        $C = "<?php";
        $C .=$this->getFormNamespaceDefiner();
        $C .= $this->getFormCodeUsage();
        $C.=$this->getFileInfoComment();

        $C .= "\nclass " . $formInfo['form']['name'] . "_Code extends $ListName" . "_Code {";
        $C .= "\n\tpublic function load()";
        $C .= "\n\t{";
        $C .= "\n\t\ttry{";
        $C .= $this->getFormCodeActionInits(true);
        $C .= "\n\t\t\t\$design=new $formName" . "_Design();";
        $C .= "\n\t\t\t\$design->setAdminMode(\$this->getAdminMode());";
        $C .= "\n\t\t\tif(isset(\$_GET['delete'])){";
        $C .= "\n\t\t\t\t\$Result=\$$formName" . "Controller->DeleteItem(\$this->getID());";
        $C .= "\n\t\t\t}elseif(isset(\$_GET['action']) && \$_GET['action']==\"search_Click\"){";
        $C .= "\n\t\t\t\t\$this->setSearchForm(\$design);";
        $C .= "\n\t\t\t\treturn \$this->search_Click();";
        $C .= "\n\t\t\t}else{";
        $C .= "\n\t\t\t\t\$Result=\$$formName" . "Controller->load(\$this->getHttpGETparameter('pn',-1));";
        $C .= "\n\t\t\t\tif(isset(\$_GET['search']))";
        $C .= "\n\t\t\t\t\t\$design=new $ListName" . "search_Design();";
        $C.="\n\t\t\t}";
        $C .= "\n\t\t\t\$design->setData(\$Result);";
        $C .= "\n\t\t\t\$design->setMessage(\"\");";
        $C .= "\n\t\t}";
        $C .= $this->getNotFoundCatchPart();
        $C .= $this->getUnknownCatchPart();
        $C .= "\n\t\treturn \$design->getBodyHTML();";
        $C .= "\n\t}";

        $C.=$this->getFormCodeConstructor($formInfo);
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
    protected function makeTableListCode($formInfo)
    {
        $formName=$formInfo['form']['name'];

        $C = "<?php";
        $C .=$this->getFormNamespaceDefiner();
        $C .= $this->getFormCodeUsage();
        $C.=$this->getFileInfoComment();

        $C .= "\nclass " . $formName . "_Code extends FormCode {";
        $C .= "\n\tprivate \$searchForm='$formName';";
        $C .= "\n\tprotected function setSearchForm(\$searchForm){";
        $C .= "\n\t\t\$this->searchForm=\$searchForm;";
        $C .= "\n\t}";
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
        $C .= "\n\tpublic function load()";
        $C .= "\n\t{";
        $C .= $this->getFormCodeActionInits();
        $C .= "\n\t\ttry{";
        $C .= "\n\t\t\t\$design=new $formName" . "_Design();";
        $C .= "\n\t\t\t\$this->setSearchForm(\$design);";
        $C .= "\n\t\t\tif(isset(\$_GET['action']) && \$_GET['action']==\"search_Click\"){";
        $C .= "\n\t\t\t\treturn \$this->search_Click();";
        $C .= "\n\t\t\t}";
        $C .= "\n\t\t\telse";
        $C .= "\n\t\t\t{";
        $C .= "\n\t\t\t\t\$Result=\$$formName" . "Controller->load(\$this->getHttpGETparameter('pn',-1));";
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

        $C.=$this->getFormCodeConstructor($formInfo);
        for($i=0;$i<count($formInfo['elements']);$i++)
            if($formInfo['elements'][$i]['type_fid']==7)
                $C.=$this->getActionFormCode($formInfo,$formInfo['elements'][$i]['name'],"\$this->getHttpGETparameter('pn',-1),",false);
        $C .= "\n}";

        $C .= "\n?>";
        file_put_contents($this->getCodeFile(), $C);

        chmod($this->getCodeFile(),0777);

    }
}
?>
