<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\buysell\Controllers\manageusersController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-16 - 2017-09-07 01:34
*@lastUpdate 1396-06-16 - 2017-09-07 01:34
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class manageusers_Code extends FormCode {
	public function load()
	{
		try{
		$manageusersController=new manageusersController();
		$translator=new ModuleTranslator("buysell");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
			if(isset($_GET['delete']))
				$Result=$manageusersController->DeleteItem($this->getID());
			else{
				$Result=$manageusersController->load($this->getHttpGETparameter('pn',-1));
			}
			$design=new manageusers_Design();
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
	public function getID()
	{
		$id=-1;
		if(isset($_GET['id']))
			$id=$_GET['id'];
		return $id;
	}
}
?>