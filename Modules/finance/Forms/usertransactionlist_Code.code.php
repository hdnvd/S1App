<?php
namespace Modules\finance\Forms;
use core\CoreClasses\services\FormCode;
use Modules\finance\Controllers\usertransactionlistController;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-15 - 2017-09-06 14:09
*@lastUpdate 1396-06-15 - 2017-09-06 14:09
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class usertransactionlist_Code extends FormCode {
	public function load()
	{
		$transactionlistController=new usertransactionlistController();
		$translator=new ModuleTranslator("finance");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		    $Result=$transactionlistController->load($this->getHttpGETparameter('pn',-1));
            $design=new usertransactionlist_Design();
            $design->setData($Result);
            $design->setMessage("");
		}
		catch(DataNotFoundException $dnfex){
			$design=new message_Design();
			$design->setMessage("آیتم مورد نظر پیدا نشد");
		}
		catch(\Exception $uex){
			$design=new message_Design();
			$design->setMessage("متاسفانه خطایی در اجرای دستور خواسته شده بوجود آمد.");
		}
		return $design->getBodyHTML();
	}

}
?>