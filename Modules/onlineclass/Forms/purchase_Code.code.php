<?php
namespace Modules\onlineclass\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\onlineclass\Controllers\purchaseController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-08-02 - 2017-10-24 14:14
*@lastUpdate 1396-08-02 - 2017-10-24 14:14
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class purchase_Code extends FormCode {
	public function load()
	{
		$purchaseController=new purchaseController();
		$translator=new ModuleTranslator("onlineclass");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		//try{
		$Result=$purchaseController->load($this->getID(),$this->getHttpGETparameter('courseid',-1),$this->getHttpGETparameter('mobile',-1),$this->getHttpGETparameter('deviceid',-1),$this->getHttpGETparameter('username',-1));
		AppRooter::redirect(DEFAULT_PUBLICURL."fa/finance/epayment.jsp?id=".$Result['transaction']['id']);
		$design=new purchase_Design();
		$design->setData($Result);
		$design->setMessage("");
		//}
//		catch(DataNotFoundException $dnfex){
//			$design=new message_Design();
//			$design->setMessageType(MessageType::$ERROR);
//			$design->setMessage("آیتم مورد نظر پیدا نشد");
//		}
//		catch(\Exception $uex){
//			$design=new message_Design();
//			$design->setMessageType(MessageType::$ERROR);
//			$design->setMessage("متاسفانه خطایی در اجرای دستور خواسته شده بوجود آمد.");
//		}
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