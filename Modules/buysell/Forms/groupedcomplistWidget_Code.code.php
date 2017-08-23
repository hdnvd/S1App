<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\WidgetCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\buysell\Controllers\complistWidgetController;
use Modules\files\PublicClasses\uploadHelper;
/**
*@author Hadi AmirNahavandi
*@creationDate 1395-12-20 - 2017-03-10 15:04
*@lastUpdate 1395-12-20 - 2017-03-10 15:04
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class groupedcomplistWidget_Code extends WidgetCode {
	public function load()
	{
		$complistWidgetController=new complistWidgetController("buysell");
		$translator=new ModuleTranslator("buysell");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$complistWidgetController->load(-1,array(),array(),-1,null);
		$design=new groupedcomplistWidget_Design();
		$design->setData($Result);
		return $design->getBodyHTML();
	}
}
?>