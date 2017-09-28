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
    protected function getUnknownCatchPart()
    {
        $C = "\n\t\tcatch(\\Exception \$uex){";
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
        $C .= "\nuse core\\CoreClasses\\html\\ListTable;";
        $C .= "\nuse core\\CoreClasses\\html\\UList;";
        $C .= "\nuse core\\CoreClasses\\html\\UListElement;";
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
	protected function getDesignTopPartCode()
	{
        $C ="\n\t\t\$Page=new Div();";
        $C .="\n\t\t\$Page->setClass(\"sweet_formtitle\");";
        $C .="\n\t\t\$Page->setId(\"".$this->getCodeModuleName() . "_" . $this->getFormName() ."\");";
        $C .="\n\t\t\$PageTitlePart=new Div();";
        $C .="\n\t\t\$PageTitlePart->setClass(\"sweet_pagetitlepart\");";
        $C .="\n\t\t\$PageTitlePart->addElement(new Lable(\"".$this->getFormCaption()."\"));";
        $C .="\n\t\t\$Page->addElement(\$PageTitlePart);";
        $C .="\n\t\tif(\$this->getMessage()!=\"\"){";
        $C .="\n\t\t\t\$MessagePart=new Div();";
        $C .="\n\t\t\tif(\$this->getMessageType()==MessageType::\$ERROR)";
        $C .="\n\t\t\t\t\$MessagePart->setClass(\"sweet_messagepart alert alert-danger\");";
        $C .="\n\t\t\telse";
        $C .="\n\t\t\t\t\$MessagePart->setClass(\"sweet_messagepart alert alert-success\");";
        $C .="\n\t\t\t\$MessagePart->addElement(new Lable(\$this->getMessage()));";
        $C .="\n\t\t\t\$Page->addElement(\$MessagePart);";
        $C .="\n\t\t}";
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
            $C.= "\n\t\t\$" . $this->getFormName() . "Controller->setAdminMode(\$this->adminMode);";
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
        if(!\$this->adminMode)
            \$UserID=\$role_systemuser_fid;
EOT;
        }
        $C .= "\n\t\t\$result=array();";
        return $C;
	}

    protected function getDesignAddCode(array $formInfo,$ElementIndex)
    {
        $E=$formInfo['elements'][$ElementIndex];
        $ElementTypeIndex=$this->getTypeIndex($formInfo['elementtypes'],$E['type_fid']);
        $C ="\n\n\t\t/******** ".$E['name']." ********/";

        if($E['type_fid']==1)//Label
        {

            $C .="\n\t\t\$LTable1->addElement(\$this->".$E['name'].",2);";
            $C .="\n\t\t\$LTable1->setLastElementClass('form_item_fulllabel');";
        }
        else if($E['type_fid']==2)//TextBox
        {
            $C .="\n\t\t\$lbl" . ucfirst($E['name']) . "=new Lable(\"". $E['caption'] . "\");";
//            $C .="\n\t\t\$lblTitle->SetAttribute(\"for\",\$this->" .$E['name'] . "->getId());";
            $C .="\n\t\t\$LTable1->addElement(\$lbl" . ucfirst($E['name']) . ");";
            $C .="\n\t\t\$LTable1->setLastElementClass('form_item_caption');";
            $C.="\n\t\t\$LTable1->addElement(\$this->".$E['name'].");";
            $C .="\n\t\t\$LTable1->setLastElementClass('form_item_field');";
        }
        else if($E['type_fid']==3)//ComboBox
        {
            $C .="\n\t\t\$lbl" . ucfirst($E['name']) . "=new Lable(\"". $E['caption'] . "\");";
//            $C .="\n\t\t\$lblTitle->SetAttribute(\"for\",\$this->" .$E['name'] . "->getId());";
            $C .="\n\t\t\$LTable1->addElement(\$lbl" . ucfirst($E['name']) . ");";
            $C .="\n\t\t\$LTable1->setLastElementClass('form_item_caption');";
            $C.="\n\t\t\$LTable1->addElement(\$this->".$E['name'].");";
            $C .="\n\t\t\$LTable1->setLastElementClass('form_item_field');";
        }
        else if($E['type_fid']==4)//DataComboBox
        {
            $C .="\n\t\t\$lbl" . ucfirst($E['name']) . "=new Lable(\"". $E['caption'] . "\");";
//            $C .="\n\t\t\$lblTitle->SetAttribute(\"for\",\$this->" .$E['name'] . "->getId());";
            $C .="\n\t\t\$LTable1->addElement(\$lbl" . ucfirst($E['name']) . ");";
            $C .="\n\t\t\$LTable1->setLastElementClass('form_item_caption');";
            $C.="\n\t\t\$LTable1->addElement(\$this->".$E['name'].");";
            $C .="\n\t\t\$LTable1->setLastElementClass('form_item_field');";
        }
        else if($E['type_fid']==5)//CheckBox
        {

            $C .="\n\t\t\$LTable1->addElement(\$this->".$E['name'].",2);";
            $C .="\n\t\t\$LTable1->setLastElementClass('form_item_checkbox');";
        }
        else if($E['type_fid']==6)//FileUploadBox
        {
            $C .="\n\t\t\$lbl" . ucfirst($E['name']) . "=new Lable(\"". $E['caption'] . "\");";
//            $C .="\n\t\t\$lblTitle->SetAttribute(\"for\",\$this->" .$E['name'] . "->getId());";
            $C .="\n\t\t\$LTable1->addElement(\$lbl" . ucfirst($E['name']) . ");";
            $C.="\n\t\t\$LTable1->setLastElementClass('form_item_caption');";
            $C.="\n\t\t\$LTable1->addElement(\$this->".$E['name'].");";
            $C .="\n\t\t\$LTable1->setLastElementClass('form_item_field');";
        }
        else if($E['type_fid']==7)//SweetButton
        {
            $C .="\n\t\t\$LTable1->addElement(\$this->".$E['name'].",2);";
            $C .="\n\t\t\$LTable1->setLastElementClass('form_item_sweetbutton');";
        }
        else if($E['type_fid']==8)//RadioButton
        {

            $C .="\n\t\t\$LTable1->addElement(\$this->".$E['name'].",2);";
            $C .="\n\t\t\$LTable1->setLastElementClass('form_item_radio');";
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
        else if($E['type_fid']==2)//TextBox
        {
            $C .="\"" . $E['name'] . "\");";
            $C .= "\n\t\t\$this->" . $E['name'] . "->setClass(\"form-control\");";
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
            $C .= "\n\t\t\$this->" . $E['name'] . "->setClass(\"form-control\");";
        }
        else if($E['type_fid']==6)//FileUploadBox
        {
            $C.="\"" . $E['name'] . "\");";
            $C .= "\n\t\t\$this->" . $E['name'] . "->setClass(\"form-control\");";
        }
        else if($E['type_fid']==7)//SweetButton
        {
            $C.="true,\"" . $E['caption'] . "\");";
            $C.="\n\t\t\$this->". $E['name']."->setAction(\"".$E['name']."\");";
            $C .= "\n\t\t\$this->" . $E['name'] . "->setClass(\"btn btn-primary\");";
        }
        else if($E['type_fid']==8)//RadioBox
        {
            $C.="\"" . $E['name'] . "\");";
            $C.="\n\t\t\$this->". $E['name']."->addOption(\"".$E['name']."\",$ElementIndex);";
            $C .= "\n\t\t\$this->" . $E['name'] . "->setClass(\"form-control\");";
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
