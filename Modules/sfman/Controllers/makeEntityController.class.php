<?php
namespace Modules\sfman\Controllers;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\common\PublicClasses\AppDate;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\sfman\Entity\sfman_moduleEntity;
use Modules\sfman\Entity\sfman_tableEntity;

/**
*@author Hadi AmirNahavandi
*@creationDate 1396-03-17 - 2017-06-07 18:07
*@lastUpdate 1396-03-17 - 2017-06-07 18:07
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class makeEntityController extends Controller {
    private $ModuleDir;
    private $JDate;
    private $CDate;
    private $SFHVERSION="2.014";
    private $SFVERSION="1.018";
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
		$moduleEnt=new sfman_moduleEntity($DBAccessor);
		$result['modules']=$moduleEnt->FindAll(new QueryLogic());
		if($ID!=-1){
			//Do Something...
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}

    private function getTitleFieldIndex($Fields)
    {
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
	public function BtnGenerate($ID,$cmbModule,$txtEntity)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$ModEnt=new sfman_moduleEntity($DBAccessor);
		$ModEnt->setId($cmbModule);
		$ModuleName=$ModEnt->getName();
		$result=array();
		$tbl=new sfman_tableEntity($DBAccessor);
        $tbl->setTableName($ModuleName. "_" . $txtEntity);
        $cols=$tbl->GetCollumns();
        $mDir=DEFAULT_APPPATH;
        $this->JDate=AppDate::today();
        $this->CDate=AppDate::cnow();
        $this->ModuleDir=$mDir . "Modules/" .  $ModuleName;
        $this->makeEntityFile($ModuleName,$txtEntity,$DBAccessor);
		if($ID==-1){
			//INSERT NEW DATA
		}
		else{
			//UPDATE DATA
		}
		$result=$this->load(-1);
        $result['module']=$cmbModule;
        $result['entity']=$txtEntity;
		$DBAccessor->close_connection();
		return $result;
	}
	private function getFieldInfoSetCode($FieldName,$EntityClassName)
    {
        $FieldNameInfoVar="\$" . ucfirst($FieldName) . "Info";
        $FieldNameUPPERVar="\$" . strtoupper($FieldName);
        $Info="\n\n\t\t/******** $FieldName ********/";
        $Info.="\n\t\t$FieldNameInfoVar=new FieldInfo();";
        $Info.="\n\t\t$FieldNameInfoVar" . "->setTitle(\"$FieldName\");";
        $Info.="\n\t\t\$this->setFieldInfo($EntityClassName" . "::" . $FieldNameUPPERVar . ",$FieldNameInfoVar);";
        return $Info;
    }
    private function makeEntityFile($mod,$tbl,dbaccess $DBAccessor)
    {
        $ent=$mod."_".$tbl;
        $tbl=new sfman_tableEntity($DBAccessor);
        $tbl->setTableName($ent);
        $cols=$tbl->GetCollumns();
        $C = "<?php";
        $C .= "\nnamespace Modules\\$mod\\Entity;";
        $C .= "\nuse core\\CoreClasses\\services\\EntityClass;";
        $C .= "\nuse core\\CoreClasses\\services\\FieldInfo;";
        $C .= "\nuse core\\CoreClasses\\db\\dbquery;";
        $C .= "\nuse core\\CoreClasses\\db\\dbaccess;";
        $C.=$this->getFileInfoComment();

        $C .= "\nclass $ent" . "Entity extends EntityClass {";
        $C .= "\n\tpublic function __construct(dbaccess \$DBAccessor)";
        $C .= "\n\t{";
        $C .= "\n\t\t\$this->setDatabase(new dbquery(\$DBAccessor));";
        $C .= "\n\t\t\$this->setTableName(\"$ent\");";
        $C .= "\n\t\t\$this->setTableTitle(\"$ent\");";
        $titleField=$cols[$this->getTitleFieldIndex($cols)];
        $C .= "\n\t\t\$this->setTitleFieldName(\"$titleField\");";
        for($i=0;$i<count($cols);$i++)
            if($cols[$i]!="id" && $cols[$i]!="deletetime")
                $C .= $this->getFieldInfoSetCode($cols[$i],$ent . "Entity");

        $C .= "\n\t}";
        for($i=0;$i<count($cols);$i++)
            if($cols[$i]!="id" && $cols[$i]!="deletetime")
            {
                $C .= "\n\tpublic static \$" . strtoupper($cols[$i]) . "=\"" . $cols[$i] . "\";";

                $C .= "\n\t/**";
                $C .= "\n\t * @return mixed";
                $C .= "\n\t */";
                $C .= "\n\tpublic function get" . ucwords($cols[$i]) . "(){";
                $C .= "\n\t\treturn \$this->getField($ent" . "Entity::\$" . strtoupper($cols[$i]). ");";
                $C .= "\n\t}";
                $C .= "\n\t/**";
                $C .= "\n\t * @param mixed \$" . ucwords($cols[$i]);
                $C .= "\n\t */";
                $C .= "\n\tpublic function set" . ucwords($cols[$i]) . "(\$" . ucwords($cols[$i]) . "){";
                $C .= "\n\t\t\$this->setField($ent" . "Entity::\$" . strtoupper($cols[$i]). ",\$" . ucwords($cols[$i]) . ");";
                $C .= "\n\t}";
            }

        $C .= "\n}";
        $C .= "\n?>";
        $file=$this->ModuleDir . "/Entity/" . $ent . "Entity.class.php";
        file_put_contents($file, $C);

        chmod($file,0777);

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