<?php
namespace Modules\oras\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\oras\Controllers\employeeController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-12 - 2017-10-04 16:08
*@lastUpdate 1396-07-12 - 2017-10-04 16:08
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class employee_Code extends FormCode {
	public function load()
	{
		return $this->getLoadDesign()->getBodyHTML();
	}
	public function getLoadDesign()
	{
		$employeeController=new employeeController();
		$translator=new ModuleTranslator("oras");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$Result=$employeeController->load($this->getID());
			$design=new employee_Design();
			$design->setData($Result);
			$design->setMessage("");
		}
		catch(DataNotFoundException $dnfex){
			$design=new message_Design();
			$design->setMessageType(MessageType::$ERROR);
			$design->setMessage("آیتم مورد نظر پیدا نشد");
		}
//		catch(\Exception $uex){
//			$design=new message_Design();
//			$design->setMessageType(MessageType::$ERROR);
//			$design->setMessage("متاسفانه خطایی در اجرای دستور خواسته شده بوجود آمد.");
//		}
		return $design;
	}
	public function __construct($namespace)
	{
		parent::__construct($namespace);
		$this->setTitle("Employee Information");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
}
?>