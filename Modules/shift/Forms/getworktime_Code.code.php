<?php
namespace Modules\shift\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\shift\Controllers\getworktimeController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-17 - 2018-04-06 18:22
*@lastUpdate 1397-01-17 - 2018-04-06 18:22
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class getworktime_Code extends FormCode {
	public function load()
	{
		$getworktimeController=new getworktimeController();
		$translator=new ModuleTranslator("shift");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$Result=$getworktimeController->load($this->getID());
		$design=new getworktime_Design();
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
		$getworktimeController=new getworktimeController();
		$translator=new ModuleTranslator("shift");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new getworktime_Design();
		$txtdaycount=$design->getTxtdaycount()->getValue();
        $startdate=$design->getStartdate()->getTime();
		$Result=$getworktimeController->BtnGenerate($this->getHttpGETparameter('bakhshid',-1),$startdate,$txtdaycount);
		$design->setData($Result);
//		$design->setMessage("btnGenerate is done!");
		return $design->getBodyHTML();
	}
}
?>