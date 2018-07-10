<?php
namespace Modules\ocms\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\ocms\Controllers\managedoctorfilesController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-06 - 2018-03-26 16:43
*@lastUpdate 1397-01-06 - 2018-03-26 16:43
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managedoctorfiles_Code extends doctorfilelist_Code {
	public function load()
	{
		return $this->getLoadDesign()->getResponse();
	}
	public function getLoadDesign()
	{
		try{
		$managedoctorfilesController=new managedoctorfilesController();
		$managedoctorfilesController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("ocms");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
			$design=new managedoctorfiles_Design();
			$design->setAdminMode($this->getAdminMode());
			if(isset($_GET['delete'])){
				$Result=$managedoctorfilesController->DeleteItem($this->getID());
			}elseif(isset($_GET['action']) && $_GET['action']=="search_Click"){
				$this->setSearchForm($design);
				return $this->search_Click();
			}else{
				$Result=$managedoctorfilesController->load($this->getHttpGETparameter('pn',-1));
				if(isset($_GET['search']))
					$design=new doctorfilelistsearch_Design();
			}
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
		$this->setTitle("Manage Doctorfiles");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
}
?>