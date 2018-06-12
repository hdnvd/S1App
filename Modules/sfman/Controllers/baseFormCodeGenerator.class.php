<?php

namespace Modules\sfman\Controllers;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 1395/10/9 - 2016/12/29 19:36:38
 *@lastUpdate 1395/10/9 - 2016/12/29 19:36:38
 *@SweetFrameworkHelperVersion 1.112
*/


class baseFormCodeGenerator extends baseCodeGenerator {
	private $FormName,$FormCaption,$FormDir,$ControllerDir;
    protected function getUnknownCatchPart($IsManagerButtonAction=false)
    {
        $C = "\n\t\tcatch(\\Exception \$uex){";
        if($IsManagerButtonAction)
            $C .= "\n\t\t\t\$design=\$this->getLoadDesign();";
        else
            $C .= "\n\t\t\t\$design=new message_Design();";

        $C .= "\n\t\t\t\$design->setMessageType(MessageType::\$ERROR);";
        $C .= "\n\t\t\t\$design->setMessage(\"متاسفانه خطایی در اجرای دستور خواسته شده بوجود آمد.\");";
        $C .= "\n\t\t}";
        return $C;
    }
    protected function getNotFoundCatchPart()
    {
        $C = "\n\t\tcatch(DataNotFoundException \$dnfex){";
        $C .= "\n\t\t\t\$design=new message_Design();";
        $C .= "\n\t\t\t\$design->setMessageType(MessageType::\$ERROR);";
        $C .= "\n\t\t\t\$design->setMessage(\"آیتم مورد نظر پیدا نشد\");";
        $C .= "\n\t\t}";
        return $C;
    }
    /**
     * @return mixed
     */
    protected function getControllerDir()
    {
        return $this->ControllerDir;
    }


	private $CodeFile,$ControllerFile,$DesignFile;

    /**
     * @return mixed
     */
    protected function getCodeFile()
    {
        return $this->CodeFile;
    }

    /**
     * @return mixed
     */
    protected function getControllerFile()
    {
        return $this->ControllerFile;
    }

    /**
     * @return mixed
     */
    protected function getDesignFile()
    {
        return $this->DesignFile;
    }

    /**
     * @return mixed
     */
    protected function getFormName()
    {
        return $this->FormName;
    }

    /**
     * @param mixed $FormName
     */
    protected function setFormName($FormName)
    {
        $this->FormName = $FormName;
        $this->CodeFile= $this->getFormDir() . "/" . $FormName ."_Code.code.php";
        $this->DesignFile=$this->getFormDir() . "/" .  $FormName ."_Design.design.php";
        $this->ControllerFile=$this->ControllerDir .  '/' . $FormName ."Controller.class.php";
    }

    /**
     * @return mixed
     */
    protected function getFormCaption()
    {
        return $this->FormCaption;
    }

    /**
     * @param mixed $FormCaption
     */
    protected function setFormCaption($FormCaption)
    {
        $this->FormCaption = $FormCaption;
    }

    /**
     * @return string
     */
    protected function getFormDir()
    {
        return $this->FormDir;
    }

    /**
     * @param string $FormDir
     */
    protected function setFormDir($FormDir)
    {
        $this->FormDir = $FormDir;
    }
    protected function getDesignUsings()
    {
        $C = "\nuse core\\CoreClasses\\services\\FormDesign;";
        $C .= "\nuse core\\CoreClasses\\services\\MessageType;";
        $C .= "\nuse core\\CoreClasses\\services\\baseHTMLElement;";
        $C .= "\nuse core\\CoreClasses\\html\\ListTable;";
        $C .= "\nuse core\\CoreClasses\\html\\UList;";
        $C .= "\nuse core\\CoreClasses\\html\\FormLabel;";
        $C .= "\nuse core\\CoreClasses\\html\\UListElement;";
        $C .= "\nuse core\\CoreClasses\\html\\Div;";
        $C .= "\nuse core\\CoreClasses\\html\\link;";
        $C .= "\nuse core\\CoreClasses\\html\\Lable;";
        $C .= "\nuse core\\CoreClasses\\html\\TextBox;";
        $C .= "\nuse core\\CoreClasses\\html\\DatePicker;";
        $C .= "\nuse core\\CoreClasses\\html\\DataComboBox;";
        $C .= "\nuse core\\CoreClasses\\html\\SweetButton;";
        $C .= "\nuse core\\CoreClasses\\html\\Button;";
        $C .= "\nuse core\\CoreClasses\\html\\CheckBox;";
        $C .= "\nuse core\\CoreClasses\\html\\RadioBox;";
        $C .= "\nuse core\\CoreClasses\\html\\SweetFrom;";
        $C .= "\nuse core\\CoreClasses\\html\\ComboBox;";
        $C .= "\nuse core\\CoreClasses\\html\\FileUploadBox;";
        $C .= "\nuse Modules\\common\\PublicClasses\\AppRooter;";
        $C .= "\nuse Modules\\common\\PublicClasses\\UrlParameter;";
        $C .= "\nuse core\\CoreClasses\\SweetDate;";
        return $C;
    }
	protected function getDesignTopPartCode($AddMessagePart=true)
	{
        $C ="\n\t\t\$Page=new Div();";
        $C .="\n\t\t\$Page->setClass(\"sweet_formtitle\");";
        $C .="\n\t\t\$Page->setId(\"".$this->getCodeModuleName() . "_" . $this->getFormName() ."\");";
        $C .="\n\t\t\$Page->addElement(\$this->getPageTitlePart(\"".$this->getFormCaption()."\"));";
        if($AddMessagePart)
            $C .=$this->getDesignMessageAdding();
        return $C;
	}
    protected function getDesignMessageAdding()
	{
        $C ="\n\t\tif(\$this->getMessage()!=\"\")";
        $C .="\n\t\t\t\$Page->addElement(\$this->getMessagePart());";
        return $C;
    }
	public function setCodeModuleName($ModuleName)
    {
        parent::setCodeModuleName($ModuleName); // TODO: Change the autogenerated stub
        $this->FormDir=$this->getCodeModuleDirectory() . '/Forms';
        $this->ControllerDir=$this->getCodeModuleDirectory() . '/Controllers';
    }

    protected function getFormNamespaceDefiner()
	{
        return "\nnamespace Modules\\" . $this->getCodeModuleName() . "\\Forms;";
	}
    protected function getControllerNamespaceDefiner()
    {
        return "\nnamespace Modules\\" . $this->getCodeModuleName() . "\\Controllers;";
    }
    protected function getFormCodeUsage()
	{
        $C = "\nuse core\\CoreClasses\\services\\FormCode;";
        $C .= "\nuse core\\CoreClasses\\services\\MessageType;";
        $C .= "\nuse core\\CoreClasses\\html\\DatePicker;";
        $C .= "\nuse Modules\\common\\PublicClasses\\AppRooter;";
        $C .= "\nuse Modules\\languages\\PublicClasses\\ModuleTranslator;";
        $C .= "\nuse Modules\\languages\\PublicClasses\\CurrentLanguageManager;";
        $C .= "\nuse core\\CoreClasses\\Exception\\DataNotFoundException;";
        $C .= "\nuse Modules\\".$this->getCodeModuleName() . "\\Controllers\\" . $this->getFormName() . "Controller;";
        $C .= "\nuse Modules\\files\\PublicClasses\\uploadHelper;";
        $C .= "\nuse Modules\\common\\Forms\\message_Design;";
        return $C;
	}
	protected function getFormCodeActionInits($isManager=false)
	{
        $C = "\n\t\t\$" . $this->getFormName() . "Controller=new " . $this->getFormName() . "Controller();";
        if($isManager)
            $C.= "\n\t\t\$" . $this->getFormName() . "Controller->setAdminMode(\$this->getAdminMode());";
        $C .= "\n\t\t\$translator=new ModuleTranslator(\"".$this->getCodeModuleName()."\");";
        $C .= "\n\t\t\$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());";
        return $C;
	}
	protected function getControllerUsage()
	{

        $C = "\nuse core\\CoreClasses\\services\\Controller;";
        $C .= "\nuse core\\CoreClasses\\Exception\\DataNotFoundException;";
        $C .= "\nuse core\\CoreClasses\\db\\dbaccess;";
        $C .= "\nuse Modules\\languages\\PublicClasses\\CurrentLanguageManager;";
        $C .= "\nuse Modules\\users\\PublicClasses\\sessionuser;";
        $C .= "\nuse core\\CoreClasses\\db\\QueryLogic;";
        $C .= "\nuse core\\CoreClasses\\db\\FieldCondition;";
        $C .= "\nuse core\\CoreClasses\\db\\LogicalOperator;";

        return $C;
	}
	protected function getControllerActionInits($isManager=false)
	{
        $C = "\n\t\t\$Language_fid=CurrentLanguageManager::getCurrentLanguageID();";
        $C .= "\n\t\t\$DBAccessor=new dbaccess();";
        $C .= "\n\t\t\$su=new sessionuser();";
        $C .= "\n\t\t\$role_systemuser_fid=\$su->getSystemUserID();";
        if($isManager)
        {
            $C .=<<<EOT
        \n\t\t\$UserID=null;
        if(!\$this->getAdminMode())
            \$UserID=\$role_systemuser_fid;
EOT;
        }
        $C .= "\n\t\t\$result=array();";
        return $C;
	}

	protected function getDesignFormRowFunctionCode()
    {
        $result="";
        return $result;

    }
    protected function getDesignAddCode(array $formInfo,$ElementIndex,$IsManager=true,$IsInfoForm=false)
    {
        $E=$formInfo['elements'][$ElementIndex];
//        $C ="\n\n\t\t/******** ".$E['name']." ********/";

        $C ="";
        $InvalidMessage='';
        if($IsManager)
            $InvalidMessage='لطفا این فیلد را به طور صحیح وارد کنید';
        $DefaultItemPart="\n\t\t\$LTable1" ."->addElement(\$this->getFieldRowCode(\$this->" . $E['name'] . ",\$this->getFieldCaption('" . $E['name'] . "'),null,'$InvalidMessage',null));";
        $SingleItemPart="\n\t\t\$LTable1" ."->addElement(\$this->getSingleFieldRowCode(\$this->" . $E['name'] . "));";
        if($IsInfoForm)
            return "\n\t\t\$LTable1" ."->addElement(\$this->getInfoRowCode(\$this->" . $E['name'] . ",\$this->getFieldCaption('" . $E['name'] . "')));";

        if($E['type_fid']==1)//Label
        {
            $C.=$SingleItemPart;
        }
        else if($E['type_fid']==2)//TextBox
        {
            $C .=$DefaultItemPart;
        }
        else if($E['type_fid']==3)//ComboBox
        {
            $C .=$DefaultItemPart;
        }
        else if($E['type_fid']==4)//DataComboBox
        {
            $C .=$DefaultItemPart;
        }
        else if($E['type_fid']==5)//CheckBox
        {
            $C.=$SingleItemPart;
        }
        else if($E['type_fid']==6)//FileUploadBox
        {
            $C .=$DefaultItemPart;
        }
        else if($E['type_fid']==7)//SweetButton
        {
            $C.=$SingleItemPart;
        }
        else if($E['type_fid']==8)//RadioButton
        {
            $C.=$SingleItemPart;
        }
        else if($E['type_fid']==9)//DatePicker
        {
            $C.=$DefaultItemPart;
        }
        return $C;
    }
    protected function getDesignInitialization(array $formInfo,$ElementIndex)
    {
        $E=$formInfo['elements'][$ElementIndex];
        $ElementTypeIndex=$this->getTypeIndex($formInfo['elementtypes'],$E['type_fid']);
        $EType=$formInfo['elementtypes'][$ElementTypeIndex]['name'];
        $C = "\n\n\t\t/******* " . $E['name'] ." *******/";
        $C .= "\n\t\t\$this->" . $E['name'] . "= new " . $EType . "(";
        if($E['type_fid']==1)//Label
        {
            $C.="\"" . $E['caption'] . "\");";
        }
        else if($E['type_fid']==2 || $E['type_fid']==9)//TextBox Or DatePicker
        {
            $C .="\"" . $E['name'] . "\");";
            $C .= "\n\t\t\$this->" . $E['name'] . "->setClass(\"form-control\");";
//            $C .= "\n\t\t\$this->" . $E['name'] . "->setRequired(true);";
        }
        else if($E['type_fid']==3)//ComboBox
        {
            $C.="\"" . $E['name'] . "\");";
            $C .= "\n\t\t\$this->" . $E['name'] . "->setClass(\"form-control\");";
        }
        else if($E['type_fid']==4)//DataComboBox
        {
            $C.="\$this->Data['" . $E['name'] . "'],\"" . $E['name'] . "\");";
            $C .= "\n\t\t\$this->" . $E['name'] . "->setClass(\"form-control\");";
        }
        else if($E['type_fid']==5)//CheckBox
        {
            $C.="\"" . $E['name'] . "\");";
        }
        else if($E['type_fid']==6)//FileUploadBox
        {
            $C.="\"" . $E['name'] . "\");";
            $C .= "\n\t\t\$this->" . $E['name'] . "->setClass(\"form-control-file\");";
        }
        else if($E['type_fid']==7)//SweetButton
        {
            $C.="true,\"" . $E['caption'] . "\");";
            $C.="\n\t\t\$this->". $E['name']."->setAction(\"".$E['name']."\");";
            $C.="\n\t\t\$this->". $E['name']."->setDisplayMode(Button::\$DISPLAYMODE_BUTTON);";
            $C .= "\n\t\t\$this->" . $E['name'] . "->setClass(\"btn btn-primary\");";
        }
        else if($E['type_fid']==8)//RadioBox
        {
            $C.="\"" . $E['name'] . "\");";
            $C.="\n\t\t\$this->". $E['name']."->addOption(\"".$E['name']."\",$ElementIndex);";
        }
        return $C;
    }
    protected function getTypeIndex($ElementTypes,$ID)
    {
        for($i=0;$i<count($ElementTypes);$i++)
            if($ElementTypes[$i]['id']==$ID)
                return $i;
        return -1;
    }


}
?>
