<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\WidgetCode;
use Modules\buysell\Controllers\carlistWidgetController;
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
class groupedcarlistWidget_Code extends WidgetCode {
	public function load()
	{
		$carlistWidgetController=new carlistWidgetController("buysell");
		$translator=new ModuleTranslator("buysell");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$GroupID=(string)$this->getField("groupid");
		$Result=$carlistWidgetController->load(-1,$GroupID);
		$design=new groupedcarlistWidget_Design();
		$design->setData($Result);
		return $design->getBodyHTML();
	}
}
?>