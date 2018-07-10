<?php
namespace Modules\onlineclass\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\onlineclass\Controllers\courseController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-25 - 2017-10-17 21:18
*@lastUpdate 1396-07-25 - 2017-10-17 21:18
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class course_Code extends FormCode {
	public function load()
	{
		return $this->getLoadDesign()->getBodyHTML();
	}
	public function getLoadDesign()
	{
		$courseController=new courseController();
		$translator=new ModuleTranslator("onlineclass");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$Result=$courseController->load($this->getID());
			$design=new course_Design();
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
		$this->setTitle("Course Information");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
}
?>