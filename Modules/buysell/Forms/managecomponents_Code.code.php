<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use Modules\buysell\Exceptions\ProductNotFoundException;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\buysell\Controllers\managecomponentsController;
use Modules\files\PublicClasses\uploadHelper;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-02-23 - 2017-05-13 21:09
*@lastUpdate 1396-02-23 - 2017-05-13 21:09
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class managecomponents_Code extends FormCode {

    public function __construct($namespace=null)
    {
        parent::__construct($namespace);
        $this->setThemePage("admin.php");
        $this->setTitle("مدیریت قطعات");
    }
	public function load()
    {
        $managecomponentsController = new managecomponentsController();
        $translator = new ModuleTranslator("buysell");
        $translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
        $design = new managecomponents_Design();
        if (isset($_GET['delete']))
        {
            try{
                $Result=$managecomponentsController->DeleteItem($this->getID());
                $design->setData($Result);
            }
            catch (ProductNotFoundException $ex)
            {
                $design->setMessage("قطعه مورد نظر وجود ندارد");
                $design->setMessageType(MessageType::$ERROR);
            }
        }
		else{
			$Result=$managecomponentsController->load($this->getID());
            $design->setData($Result);
		}
		$design->setMessage("");
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