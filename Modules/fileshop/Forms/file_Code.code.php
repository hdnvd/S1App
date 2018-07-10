<?php
namespace Modules\fileshop\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\fileshop\Controllers\fileController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-09 - 2017-11-30 16:33
*@lastUpdate 1396-09-09 - 2017-11-30 16:33
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class file_Code extends FormCode {
	public function load()
	{
		return $this->getLoadDesign()->getResponse();
	}
	public function getLoadDesign()
	{
		$fileController=new fileController();
		$translator=new ModuleTranslator("fileshop");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$Result=$fileController->load($this->getID(),$this->getHttpGETparameter('username',-1),$this->getHttpGETparameter('password',-1));
			$design=new file_Design();
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
		return $design;
	}
	public function __construct($namespace)
	{
		parent::__construct($namespace);
		$this->setTitle("File Information");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
}
?>