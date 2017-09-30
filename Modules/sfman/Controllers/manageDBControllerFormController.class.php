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

abstract class manageDBControllerFormController extends manageDBFormController {

    protected function getEntityObjectFieldSetCode($ObjectName,$EntityClassName,$isInsert)
    {
        $InsertCode = "";
        for($i=0; $i<count($this->getCurrentTableFields()); $i++)
        {
            if(FieldType::getFieldType($this->getCurrentTableFields()[$i])!=FieldType::$METAINF && FieldType::getFieldType($this->getCurrentTableFields()[$i])!=FieldType::$ID){
                $UCField=$this->getCurrentTableFields()[$i];

                if($isInsert || trim(strtolower($UCField))!="role_systemuser_fid")
                {
                    $InsertCode .= "\n\t\t\t$ObjectName" . "->set" . ucwords($UCField) . "(\$$UCField";
                    if(FieldType::getFieldType($this->getCurrentTableFields()[$i])==FieldType::$FILE)
                        $InsertCode .="[0]['url']";
                    $InsertCode .=");";
                }
            }
        }
        return $InsertCode;
    }

    protected function getEntityObjectFieldValidateCode($ObjectName,$EntityClassName)
    {
        $ValidateCode = "\n\t\t\$this->ValidateFieldArray([";
        $FieldsCode="";
        $FieldIndex=0;
        for($i=0; $i<count($this->getCurrentTableFields()); $i++)
        {
            if(FieldType::getFieldType($this->getCurrentTableFields()[$i])!=FieldType::$METAINF && FieldType::getFieldType($this->getCurrentTableFields()[$i])!=FieldType::$ID){
                $UCField=$this->getCurrentTableFields()[$i];

                if(trim(strtolower($UCField))!="role_systemuser_fid")
                {
                    if($FieldIndex>0)
                    {
                        $FieldsCode.=",";
                        $ValidateCode.=",";
                    }
                    $ValidateCode .= "\$$UCField";
                    $FieldsCode .= $ObjectName . "->getFieldInfo(";
                    $FieldsCode .= "$EntityClassName" . "::\$" . strtoupper($UCField);
                    if(FieldType::getFieldType($this->getCurrentTableFields()[$i])==FieldType::$FILE)
                        $ValidateCode .="[0]['url']";
                    $FieldsCode.=")";
                    $FieldIndex++;
                }

            }

        }
        $ValidateCode.="],[" . $FieldsCode . "]);";
        return $ValidateCode;
    }

    protected function getTableItemControllerTopCode($formInfo,$isManager)
    {
        $formName=$formInfo['form']['name'];
        $moduleName=$this->getCodeModuleName();
        $EntityNames=array();

        $EntityClassName=$moduleName . "_" . $this->getTableName() . "Entity";;
        $C = "<?php";
        $C .= $this->getControllerNamespaceDefiner();
        $C .= $this->getControllerUsage();
        $C .= "\nuse Modules\\$moduleName\\Entity\\$EntityClassName;";
        for($i=0; $i<count($this->getCurrentTableFields()); $i++) {
            $fl1=$this->getFieldName($i);
            if($fl1!=null && array_search($fl1,$EntityNames)==null) {
                $fl = $moduleName . "_" . $fl1 . "Entity";
                $C .= "\nuse Modules\\$moduleName\\Entity\\$fl;";
            }
            $EntityNames[$i]=$fl1;
        }
        $C.=$this->getFileInfoComment();
        $C .= "\nclass $formName" . "Controller extends Controller {";
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
EOT;
        $C .= "\n\tpublic function load(\$ID)";
        $C .= "\n\t{";
        $C .= $this->getControllerActionInits($isManager);
        $ObjectName="\$" . $this->getTableName() . "EntityObject";
        $C .= "\n\t\t$ObjectName=new $EntityClassName(\$DBAccessor);";
        return $C;
    }
    protected function getTableItemControllerLoadCode($formInfo,$isManager)
    {
        $ObjectName="\$" . $this->getTableName() . "EntityObject";
        $C = "\n\t\t\$result['".$this->getTableName()."']=$ObjectName;";
        $C .= "\n\t\tif(\$ID!=-1){";
        $C .= "\n\t\t\t$ObjectName" . "->setId(\$ID);";
        $C .= "\n\t\t\t" . "if($ObjectName" . "->getId()==-1)";
        $C .= "\n\t\t\t\tthrow new DataNotFoundException();";
        if($isManager)
        {
            $C .="\n\t\t\tif(\$UserID!=null && $ObjectName" . "->getRole_systemuser_fid()!=\$UserID)";
            $C .= "\n\t\t\t\tthrow new DataNotFoundException();";
        }
        $C .= "\n\t\t\t\$result['".$this->getTableName()."']=$ObjectName;";

        return $C;
    }
    protected function makeTableItemController($formInfo)
    {
        $moduleName=$this->getCodeModuleName();
        $C =$this->getTableItemControllerTopCode($formInfo,false);
        $C .= $this->getTableItemControllerLoadCode($formInfo,false);
        for($i=0; $i<count($this->getCurrentTableFields()); $i++) {
            $fl1=$this->getFieldName($i);
            if($fl1!=null && FieldType::getFieldType($this->getCurrentTableFields()[$i])==FieldType::$FID) {
                $fl = $moduleName . "_" . $fl1 . "Entity";
                $FiledName=substr($this->getCurrentTableFields()[$i],0,strlen($this->getCurrentTableFields()[$i])-4);
                $ObjectName2="\$" . $FiledName . "EntityObject";
                $C .= "\n\t\t\t$ObjectName2=new " .  $fl . "(\$DBAccessor);";
                $C .= "\n\t\t\t$ObjectName2" . "->SetId(\$result['".$this->getTableName()."']->get".ucwords($this->getCurrentTableFields()[$i])."());";
                $C .= "\n\t\t\tif($ObjectName2" . "->getId()==-1)";
                $C .= "\n\t\t\t\tthrow new DataNotFoundException();";
                $C .= "\n\t\t\t\$result['" . $this->getCurrentTableFields()[$i] . "']=$ObjectName2;";
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
    protected function makeTableItemManageController($formInfo)
    {
        $moduleName=$this->getCodeModuleName();
        $C =$this->getTableItemControllerTopCode($formInfo,true);
        for($i=0; $i<count($this->getCurrentTableFields()); $i++) {
            $fl1=$this->getFieldName($i);
            if($fl1!=null &&  FieldType::getFieldType($this->getCurrentTableFields()[$i])==FieldType::$FID) {
                $fl = $moduleName . "_" . $fl1 . "Entity";
                $FiledName=substr($this->getCurrentTableFields()[$i],0,strlen($this->getCurrentTableFields()[$i])-4);
                $ObjectName2="\$" . $FiledName . "EntityObject";
                $C .= "\n\t\t\t$ObjectName2=new " .  $fl . "(\$DBAccessor);";
                $C .= "\n\t\t\t\$result['" . $this->getCurrentTableFields()[$i] . "']=$ObjectName2" . "->FindAll(new QueryLogic());";
            }
        }
        $C .= $this->getTableItemControllerLoadCode($formInfo,true);
        $C .="\n\t\t}";
        $C .= "\n\t\t\$result['param1']=\"\";";
        $C .= "\n\t\t\$DBAccessor->close_connection();";
        $C .= "\n\t\treturn \$result;";
        $C .= "\n\t}";

        for($i=0;$i<count($formInfo['elements']);$i++)
            if($formInfo['elements'][$i]['type_fid']==7)
                $C.=$this->getActionFormController($formInfo,$formInfo['elements'][$i]['name'],true);
        $C .= "\n}";
        $C .= "\n?>";
        file_put_contents($this->getControllerFile(), $C);

        chmod($this->getControllerFile(),0777);

    }
	protected function makeTableManageListController($formInfo)
	{
        $TableName=$this->getTableName();
        $EntityClassName=$this->getCodeModuleName() . "_" . $TableName . "Entity";
		$C = $this->getTableListControllerCode($formInfo,array("PageNum"),true);
		$C .= "\n\tpublic function DeleteItem(\$ID)";
        $C .= "\n\t{";
        $C .= "\n\t\t\$Language_fid=CurrentLanguageManager::getCurrentLanguageID();";
        $C .= "\n\t\t\$DBAccessor=new dbaccess();";
        $C.=<<<EOT
\n\t\t\$su=new sessionuser();
        \$role_systemuser_fid=\$su->getSystemUserID();
        \$UserID=null;
        if(!\$this->adminMode)
            \$UserID=\$role_systemuser_fid;
EOT;

        $C .= "\n\t\t\$$TableName" . "Ent=new $EntityClassName(\$DBAccessor);";
        $C .= "\n\t\t\$$TableName" . "Ent->setId(\$ID);";
        $C .= "\n\t\tif(\$$TableName" . "Ent->getId()==-1)";
        $C .= "\n\t\t\tthrow new DataNotFoundException();";

        $C .= "\n\t\tif(\$UserID!=null && \$$TableName" . "Ent->getRole_systemuser_fid()!=\$UserID)";
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
    protected function makeTableListController($formInfo)
    {
        $C = $this->getTableListControllerCode($formInfo,array("PageNum"),false);
        $C .= "\n}";
        $C .= "\n?>";
        file_put_contents($this->getControllerFile(), $C);
        chmod($this->getControllerFile(),0777);

    }
    protected function getTableListControllerLoadCode($formInfo,$LoadParams,$MethodName,$EntityClassName,$QueryParams,$isManager)
    {
        $formName=$formInfo['form']['name'];
        $moduleName=$formInfo['module']['name'];
        $TableName=$this->getTableName();
        $C = "\n\tpublic function $MethodName(";
        for ($i=0;$i<count($LoadParams);$i++) {
            if($i>0)
                $C.=",";
            $C.="\$" . $LoadParams[$i];
        }
        $C .=")";
        $C .= "\n\t{";
        $C .= $this->getControllerActionInits($isManager);
        for($i=0; $i<count($this->getCurrentTableFields()); $i++) {
            $fl1=$this->getFieldName($i);
            if($fl1!=null &&  FieldType::getFieldType($this->getCurrentTableFields()[$i])==FieldType::$FID) {
                $fl = $moduleName . "_" . $fl1 . "Entity";
                $FiledName=substr($this->getCurrentTableFields()[$i],0,strlen($this->getCurrentTableFields()[$i])-4);
                $ObjectName2="\$" . $FiledName . "EntityObject";
                $C .= "\n\t\t\t$ObjectName2=new " .  $fl . "(\$DBAccessor);";
                $C .= "\n\t\t\t\$result['" . $this->getCurrentTableFields()[$i] . "']=$ObjectName2" . "->FindAll(new QueryLogic());";
            }
        }
        $C .= "\n\t\tif(\$PageNum<=0)";
        $C .= "\n\t\t\t\$PageNum=1;";
        $C .= "\n\t\t\$$TableName" . "Ent=new $EntityClassName(\$DBAccessor);";
        $ObjectName="\$$TableName" . "Ent";
        $C .= "\n\t\t\$result['".$this->getTableName()."']=$ObjectName;";
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
    protected function getTableListControllerCode($formInfo,$LoadParams,$isManager)
    {
        $formName=$formInfo['form']['name'];
        $moduleName=$formInfo['module']['name'];
        $TableName=$this->getTableName();
        $EntityClassName=null;
        $EntityNames=array();
        $C = "<?php";
        $C .= $this->getControllerNamespaceDefiner();
        $C .= $this->getControllerUsage();
        $EntityClassName=$moduleName . "_" . $TableName . "Entity";
        $C .= "\nuse Modules\\$moduleName\\Entity\\$EntityClassName;";
        for($i=0; $i<count($this->getCurrentTableFields()); $i++) {
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
        $Qparams="";
        if($isManager)
        {

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

        $Qparams.=<<<EOT
\n\t\t\t\tif(\$UserID!=null)
            \$q->addCondition(new FieldCondition($EntityClassName::\$ROLE_SYSTEMUSER_FID,\$UserID));
EOT;
        }
        $Qparams.="\t\t\n\$q->addOrderBy(\"id\",true);";
        $C .= $this->getTableListControllerLoadCode($formInfo,$LoadParams,"load",$EntityClassName,$Qparams,$isManager);
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
        $C .= $this->getTableListControllerLoadCode($formInfo,$LoadParams2,"Search",$EntityClassName,$Qparams,$isManager);
        return $C;

    }
	protected function getActionFormController($formInfo,$ActionName,$isManager)
	{

        $EntityClassName=$this->getCodeModuleName() . "_" . $this->getTableName() . "Entity";;
        $ObjectName="\$" . $this->getTableName() . "EntityObject";
        $InsertCode=$this->getEntityObjectFieldSetCode($ObjectName,$EntityClassName,true);
        $InsertCode .= "\n\t\t\t$ObjectName" . "->Save();";
        $UpdateCode = "\n\t\t\t$ObjectName" . "->setId(\$ID);";
        $UpdateCode .= "\n\t\t\tif($ObjectName" . "->getId()==-1)";
        $UpdateCode .= "\n\t\t\t\tthrow new DataNotFoundException();";
        if($isManager)
        {
            $UpdateCode .="\n\t\t\tif(\$UserID!=null && $ObjectName" . "->getRole_systemuser_fid()!=\$UserID)";
            $UpdateCode .= "\n\t\t\t\tthrow new DataNotFoundException();";
        }
        $UpdateCode.=$this->getEntityObjectFieldSetCode($ObjectName,$EntityClassName,false);
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
        if($isManager)
        {
            $C .=<<<EOT
        \n\t\t\$UserID=null;
        if(!\$this->adminMode)
            \$UserID=\$role_systemuser_fid;
EOT;
        }
		$C .= "\n\t\t\$result=array();";
        if($InsertCode!==null)
        {

            $C .= "\n\t\t$ObjectName=new $EntityClassName(\$DBAccessor);";
            $C .=$this->getEntityObjectFieldValidateCode($ObjectName,$EntityClassName);
        }
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
}

?>
