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


class baseCodeGenerator extends Controller {
    public static $SFHVERSION="2.004";
    public static $SFVERSION="1.021";
	private $CodeModuleDir;
    private $AndroidCodeModuleDir;
    private $SenchaCodeModuleDir;
    private $ReactCodeModuleDir;
    private $ReactNativeCodeModuleDir;
    private $LaravelCodeModuleDir;

    /**
     * @return mixed
     */
    public function getSenchaCodeModuleDir()
    {
        return $this->SenchaCodeModuleDir;
    }

    /**
     * @return mixed
     */
    public function getLaravelCodeModuleDir()
    {
        return $this->LaravelCodeModuleDir;
    }
    /**
     * @return mixed
     */
    public function getAndroidCodeModuleDir()
    {
        return $this->AndroidCodeModuleDir;
    }

    /**
     * @return string
     */
    public function getReactCodeModuleDir()
    {
        return $this->ReactCodeModuleDir;
    }

    /**
     * @return string
     */
    public function getReactNativeCodeModuleDir()
    {
        return $this->ReactNativeCodeModuleDir;
    }

    /**
     * @param null $CodeModuleName
     */
    protected function setCodeModuleName($CodeModuleName)
    {
        $this->CodeModuleName = $CodeModuleName;
        $mDir=DEFAULT_APPPATH;
        $this->CodeModuleDir=$mDir . "Modules/" .  $CodeModuleName;
        $this->AndroidCodeModuleDir=$mDir . "Android/Modules/" .  $CodeModuleName;
        $this->SenchaCodeModuleDir=$mDir . "Sencha/Modules/" .  $CodeModuleName;
        $this->ReactCodeModuleDir=$mDir . "React/Modules/" .  $CodeModuleName;
        $this->ReactNativeCodeModuleDir=$mDir . "ReactNative/Modules/" .  $CodeModuleName;
        $this->LaravelCodeModuleDir=$mDir . "Laravel/Modules/" .  $CodeModuleName;
        $this->changeLogFile=$this->CodeModuleDir . "/changelog.php";
    }

    /**
     * @return string
     */
    protected function getCodeModuleDirectory()
    {
        return $this->CodeModuleDir;
    }

    /**
     * @return null
     */
    protected function getCodeModuleName()
    {
        return $this->CodeModuleName;
    }
    private $CodeModuleName;
    private $changeLogFile;

    /**
     * @return string
     */
    protected function getChangeLogFile()
    {
        return $this->changeLogFile;
    }
	private $JDate;

    /**
     * @return string
     */
    protected function getJDate()
    {
        return $this->JDate;
    }

    /**
     * @return string
     */
    protected function getCDate()
    {
        return $this->CDate;
    }
	private $CDate;


	protected function MakeModuleDirectories()
    {
        $this->makeModuleDir("");
        $this->makeAndroidModuleDir("");
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
    }
    public function __construct($ModuleName=null)
    {
        parent::__construct($ModuleName);
        $this->JDate=AppDate::today();
        $this->CDate=AppDate::cnow();
    }
	protected function getSetterCode($DataName,$DataType)
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
	protected function getGetterCode($DataName,$DataType)
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

	private function makeModuleDir($Dir)
	{
		$Dir=$this->CodeModuleDir . "/" .$Dir;
		//echo $Dir . "<br>";
		if(!file_exists($Dir)) {
			mkdir($Dir);
			chmod($Dir,0755);
			file_put_contents($Dir . "/index.html",file_get_contents($this->getTextsDirectory() . "accessdenied.txt"));
			chmod($Dir . "/index.html",0644);
		}
	}
    private function makeAndroidModuleDir($Dir)
    {
        $Dir=$this->AndroidCodeModuleDir . "/" .$Dir;
        //echo $Dir . "<br>";
        if(!file_exists($Dir)) {
            mkdir($Dir);
            chmod($Dir,0755);
        }
    }
    /**
     * @return string
     */
    protected function getFileInfoComment()
    {
        $C = "\n/**";
        $C .= "\n*@author Hadi AmirNahavandi";
        $C .= "\n*@creationDate " . $this->JDate . " - " . $this->CDate;
        $C .= "\n*@lastUpdate " . $this->JDate . " - " . $this->CDate;
        $C .= "\n*@SweetFrameworkHelperVersion " . baseCodeGenerator::$SFHVERSION;
        $C .= "\n*@SweetFrameworkVersion " . baseCodeGenerator::$SFHVERSION;
        $C .= "\n*/";
        return $C;
    }

}
?>
