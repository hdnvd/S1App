<?php
namespace Modules\shift\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\shift\Controllers\bakhshController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-23 - 2018-02-12 00:11
*@lastUpdate 1396-11-23 - 2018-02-12 00:11
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class bakhsh_Code extends FormCode {
	public function load()
	{
		$bakhshController=new bakhshController();
		$translator=new ModuleTranslator("shift");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$Result=$bakhshController->load($this->getID());
		$design=new bakhsh_Design();
		$design->setData($Result);
		$design->setMessage("");
		}
		catch(DataNotFoundException $dnfex){
			$design=new message_Design();
			$design->setMessageType(MessageType::$ERROR);
			$design->setMessage("آیتم مورد نظر پیدا نشد");
		}
		catch(\Exception $uex){
			$design=new message_Design();
			$design->setMessageType(MessageType::$ERROR);
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
	public function btnGenerate_Click()
	{
		$bakhshController=new bakhshController();
		$translator=new ModuleTranslator("shift");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new bakhsh_Design();
		$txtdaycount=$design->getTxtdaycount()->getValue();
		$Result=$bakhshController->BtnGenerate($this->getID(),$txtdaycount);
		$design->setData($Result);
		$design->setMessage("btnGenerate is done!");
		return $design->getBodyHTML();
	}
}
?>