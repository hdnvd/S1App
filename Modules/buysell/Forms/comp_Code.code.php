<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\buysell\Controllers\compController;
use Modules\files\PublicClasses\uploadHelper;
/**
*@author Hadi AmirNahavandi
*@creationDate 1395-12-07 - 2017-02-25 18:45
*@lastUpdate 1395-12-07 - 2017-02-25 18:45
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class comp_Code extends FormCode {
    
	public function __construct($namespace=null)
	{
		parent::__construct($namespace);
		$this->setTitle("فهرست قطعات");
		$this->setThemePage("menupage.php");
	}
	public function load()
	{
		$compController=new compController();
		$translator=new ModuleTranslator("buysell");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$compController->load($this->getID());
		$design=new comp_Design();
		$design->setData($Result);
		$design->setMessage("");
		return $design->getBodyHTML();
	}
	public function getID()
	{
		$id=-1;
		if(isset($_GET['id']))
			$id=$_GET['id'];
		return $id;
	}
}
?>