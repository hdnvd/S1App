<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\buysell\Controllers\complistController;
use Modules\files\PublicClasses\uploadHelper;
/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-27 - 2017-02-15 15:29
*@lastUpdate 1395-11-27 - 2017-02-15 15:29
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class complist_Code extends FormCode {
	public function __construct($namespace=null)
	{
		parent::__construct($namespace);
		$this->setTitle("فهرست قطعات");
		$this->setThemePage("menupage.php");
	}
	public function load()
    {
        $complistController = new complistController();
        $translator = new ModuleTranslator("buysell");
        $translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
        $Status=$this->getStatus();
        $Result = $complistController->load($this->getPageNum(),array(),array(),$this->getGroupID(),$Status);
        $design = new complist_Design();
        $design->setData($Result);
        $design->setMessage("");
        return $design->getBodyHTML();
    }
    public function getSortBy()
    {
        $SortBy=-1;
        if(isset($_GET['sort']))
            $SortBy=$_GET['sort'];
        return $SortBy;
    }
    public function getStatus()
    {
        $Status=null;
        if(isset($_GET['s']))
            $Status=$_GET['s'];
        return $Status;
    }
    public function getPageNum()
    {
        $p=-1;
        if(isset($_GET['p']))
            $p=$_GET['p'];
        return $p;
    }

    private function getGroupID()
    {
        $g=-1;
        if(isset($_GET['g']))
            $g=$_GET['g'];
        return $g;
    }
}
?>