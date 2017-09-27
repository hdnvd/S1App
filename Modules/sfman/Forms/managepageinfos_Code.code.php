<?php
namespace Modules\sfman\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\sfman\Controllers\managepageinfosController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-06 - 2017-09-28 01:28
*@lastUpdate 1396-07-06 - 2017-09-28 01:28
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managepageinfos_Code extends FormCode {    
private $adminMode=true;

    /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
    }
	public function load()
	{
		try{
		$managepageinfosController=new managepageinfosController();
		$managepageinfosController->setAdminMode($this->adminMode);
		$translator=new ModuleTranslator("sfman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
			if(isset($_GET['delete']))
				$Result=$managepageinfosController->DeleteItem($this->getID());
			else{
				$Result=$managepageinfosController->load($this->getHttpGETparameter('pn',-1));
			}
			$design=new managepageinfos_Design();
			$design->setAdminMode($this->adminMode);
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