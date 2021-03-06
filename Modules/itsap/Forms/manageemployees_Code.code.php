<?php
namespace Modules\itsap\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\itsap\Exceptions\EmployeeHasUnitException;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\itsap\Controllers\manageemployeesController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-17 - 2017-12-08 11:51
*@lastUpdate 1396-09-17 - 2017-12-08 11:51
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageemployees_Code extends employeelist_Code {
	public function load()
	{
		return $this->getLoadDesign()->getResponse();
	}
	public function getLoadDesign()
	{
		try
{
		$manageemployeesController=new manageemployeesController();
		$manageemployeesController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("itsap");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
			$design=new manageemployees_Design();
			$design->setAdminMode($this->getAdminMode());
			if(isset($_GET['delete'])) {
                $Result = $manageemployeesController->DeleteItem($this->getID(), $this->getHttpGETparameter('uid', -1));
            }elseif(isset($_GET['setasadmin'])){
                    $Result=$manageemployeesController->SetAsAdmin($this->getID(),$this->getHttpGETparameter('uid',-1));
            }elseif(isset($_GET['removeunit'])){
                $Result=$manageemployeesController->RemoveUnit($this->getID(),$this->getHttpGETparameter('uid',-1));
			}elseif(isset($_GET['action']) && $_GET['action']=="search_Click"){
				$this->setSearchForm($design);
				return $this->search_Click();
			}else{
				$Result=$manageemployeesController->load($this->getHttpGETparameter('pn',-1),$this->getHttpGETparameter('uid',-1));
				if(isset($_GET['search']))
					$design=new employeelistsearch_Design();
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
	public function btnmove_Click()
    {

        $manageemployeesController=new manageemployeesController();
        $manageemployeesController->setAdminMode($this->getAdminMode());
        $design=new manageemployees_Design();
        $MelliCode=$design->getTxtMellicode()->getValue();
        try
        {
            $res=$manageemployeesController->AddToUnit($MelliCode,$this->getHttpGETparameter('uid', -1));
            $design=$this->getLoadDesign();
            $design->setMessageType(MessageType::$SUCCESS);
            $design->setMoveMessage("انتقال با موفقیت انجام گرفت.");
        }
        catch(EmployeeHasUnitException $euex){
            $design->setMessageType(MessageType::$ERROR);
            $design->setMoveMessage("این شخص هنوز در یک بخش مشغول به کار است.");
        }
        catch(DataNotFoundException $dnfex){
            $design->setMessageType(MessageType::$ERROR);
            $design->setMoveMessage("هیچ شخصی با این کد ملی پیدا نشد");
        }
        catch(\Exception $uex){
            $design->setMessageType(MessageType::$ERROR);
            $design->setMoveMessage("متاسفانه خطایی در اجرای دستور خواسته شده بوجود آمد.");
        }
        return $design->getResponse();
    }
	public function __construct($namespace)
	{
		parent::__construct($namespace);
		$this->setTitle("Manage Employees");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
}
?>