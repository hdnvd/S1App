<?php

namespace Modules\sfman\Controllers;
use core\CoreClasses\db\dbaccess;
use Modules\sfman\Entity\sfman_formelementEntity;
use Modules\sfman\Entity\sfman_formelementtypeEntity;
use Modules\sfman\Entity\sfman_formEntity;
use Modules\sfman\Entity\sfman_moduleEntity;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 1395/10/9 - 2016/12/29 19:36:38
 *@lastUpdate 1395/10/9 - 2016/12/29 19:36:38
 *@SweetFrameworkHelperVersion 1.112
*/


class manageformController extends baseFormCodeGenerator {

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
	public function generateCode($FormID)
	{

        $formInfo=$this->load($FormID);
        $mName=$formInfo['module']['name'];
        $this->setCodeModuleName($mName);
        $fName=$formInfo['form']['name'];
        $this->setFormName($fName);
        $this->setFormCaption($formInfo['form']['caption']);
        $this->MakeModuleDirectories();
		$this->makeFormDesign($formInfo);
		$this->makeFormCode($formInfo);
		$this->makeFormController($formInfo);
        $this->makeChangeLog($formInfo);
	}
    private function makeFormDesign($formInfo)
    {
        $C = "<?php";
        $C .= $this->getFormNamespaceDefiner();
        $C.=$this->getDesignUsings();
        $C.=$this->getFileInfoComment();
        $C .= "\nclass " . $this->getFormName() . "_Design extends FormDesign {";
        $C .= "\n\tprivate \$Data;";
        $C.=$this->getSetterCode("Data","mixed");
        $C .= "\n\tprivate \$FieldCaptions;";
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
        $C .="\n\t\t\$this->FieldCaptions=array();";
        for($i=0;$i<count($formInfo['elements']);$i++) {
            $C.=$this->getDesignInitialization($formInfo,$i);
        }
        $C .="\n\t}";



        $C .="\n\tpublic function getBodyHTML(\$command=null)";
        $C .="\n\t{";
        $C .=$this->getDesignTopPartCode();
            $C .="\n\t\t\$LTable1=new Div();";
            $C .="\n\t\t\$LTable1->setClass(\"formtable\");";
            for($i=0;$i<count($formInfo['elements']);$i++) {
                $C .=$this->getDesignAddCode($formInfo,$i,true,false);
            }

        $C .="\n\t\t\$Page->addElement(\$LTable1);";
        $C .="\n\t\t\$form=new SweetFrom(\"\", \"POST\", \$Page);";
        $C .="\n\t\t\$form->setClass('form-horizontal');";
        $C .="\n\t\treturn \$form->getHTML();";
        $C .="\n\t}";
        $C.=$this->getDesignFormRowFunctionCode();
        $C .= "\n}";

        $C .= "\n?>";
        file_put_contents($this->getDesignFile(), $C);

        chmod($this->getDesignFile(),0777);

    }
	private function makeFormCode($formInfo)
	{
		$C = "<?php";
		$C .=$this->getFormNamespaceDefiner();
		$C .= $this->getFormCodeUsage();
        $C.=$this->getFileInfoComment();

		$C .= "\nclass " . $formInfo['form']['name'] . "_Code extends FormCode {";
		$C .= "\n\tpublic function load()";
		$C .= "\n\t{";
		$C .= $this->getFormCodeActionInits();
        $C .= "\n\t\ttry{";
        $C .= "\n\t\t\$Result=\$" . $this->getFormName() . "Controller->load(\$this->getID());";
		$C .= "\n\t\t\$design=new " . $this->getFormName()  . "_Design();";
		$C .= "\n\t\t\$design->setData(\$Result);";
		$C .= "\n\t\t\$design->setMessage(\"\");";$C .= "\n\t\t}";
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
		for($i=0;$i<count($formInfo['elements']);$i++)
			if($formInfo['elements'][$i]['type_fid']==7)
				$C.=$this->getActionFormCode($formInfo,$formInfo['elements'][$i]['name']);
		$C .= "\n}";
		$C .= "\n?>";
		file_put_contents($this->getCodeFile(), $C);

		chmod($this->getCodeFile(),0777);

	}
	private function makeFormController($formInfo)
	{
        $EntityClassName=null;
		$C = "<?php";
		$C .= $this->getControllerNamespaceDefiner();
		$C .= $this->getControllerUsage();
		$C.=$this->getFileInfoComment();
		$C .= "\nclass " . $this->getFormName() . "Controller extends Controller {";
        $C .= "\n\tprivate \$PAGESIZE=10;";
		$C .= "\n\tpublic function load(\$ID)";
		$C .= "\n\t{";
		$C .= $this->getControllerActionInits();
        $C .= "\n\t\tif(\$ID!=-1){";
        $C .= "\n\t\t\t//Do Something...";
        $C .= "\n\t\t}";


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

	private function getActionFormCode($formInfo,$ActionName)
	{
		$formName=$formInfo['form']['name'];
		$moduleName=$formInfo['module']['name'];
		$C = "\n\tpublic function $ActionName". "_Click()";
		$C .= "\n\t{";
		$C .= $this->getFormCodeActionInits();
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
		if($Params!="")
			$C .= "\n\t\t\$Result=\$$formName" . "Controller->" . ucwords($ActionName) . "(\$this->getID(),$Params);";
		else
            $C .= "\n\t\t\$Result=\$$formName" . "Controller->" . ucwords($ActionName) . "(\$this->getID());";
		$C .= "\n\t\t\$design->setData(\$Result);";
		$C .= "\n\t\t\$design->setMessage(\"$ActionName is done!\");";
		$C .= "\n\t\treturn \$design->getBodyHTML();";
		$C .= "\n\t}";
		return $C;
	}
	private function getActionFormController($formInfo,$ActionName)
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
		if($Params!="")
		    $C  = "\n\tpublic function " . ucwords($ActionName) . "(\$ID,$Params)";
		else
            $C  = "\n\tpublic function " . ucwords($ActionName) . "(\$ID)";
		$C .= "\n\t{";
		$C .= $this->getControllerActionInits();

        $C .= "\n\t\tif(\$ID==-1){";
        $C .= "\n\t\t\t//INSERT NEW DATA";
        $C .= "\n\t\t}";
        $C .= "\n\t\telse{";
        $C .= "\n\t\t\t//UPDATE DATA";
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
    private function makeChangeLog(array $formInfo)
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
        file_put_contents($this->getChangeLogFile(), $C,FILE_APPEND);
        chmod($this->getChangeLogFile(),0777);

    }


}
?>
