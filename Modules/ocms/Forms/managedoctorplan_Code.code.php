<?php

namespace Modules\ocms\Forms;

use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use core\CoreClasses\SweetDate;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\ocms\Controllers\managedoctorplanController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;

/**
 * @author Hadi AmirNahavandi
 * @creationDate 1396-09-23 - 2017-12-14 01:18
 * @lastUpdate 1396-09-23 - 2017-12-14 01:18
 * @SweetFrameworkHelperVersion 2.004
 * @SweetFrameworkVersion 2.004
 */
class managedoctorplan_Code extends FormCode
{
    private $adminMode = true;

    /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
    }

    public function getAdminMode()
    {
        return $this->adminMode;
    }

    public function load()
    {
        return $this->getLoadDesign()->getResponse();
    }

    public function getLoadDesign()
    {
        $managedoctorplanController = new managedoctorplanController();
        $managedoctorplanController->setAdminMode($this->getAdminMode());
        $translator = new ModuleTranslator("ocms");
        $translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
        try {
            $Result = $managedoctorplanController->load($this->getID());
            $design = new managedoctorplan_Design();
            $design->setAdminMode($this->adminMode);
            $design->setData($Result);
            $design->setMessage("");
        } catch (DataNotFoundException $dnfex) {
            $design = new message_Design();
            $design->setMessageType(MessageType::$ERROR);
            $design->setMessage("آیتم مورد نظر پیدا نشد");
        } catch (\Exception $uex) {
            $design = new message_Design();
            $design->setMessageType(MessageType::$ERROR);
            $design->setMessage("متاسفانه خطایی در اجرای دستور خواسته شده بوجود آمد.");
        }
        return $design;
    }

    public function __construct($namespace)
    {
        parent::__construct($namespace);
        $this->setTitle("Manage Doctorplan");
    }

    public function getID()
    {
        return $this->getHttpGETparameter('id', -1);
    }

    public function btnSave_Click()
    {
        $managedoctorplanController = new managedoctorplanController();
        $managedoctorplanController->setAdminMode($this->getAdminMode());
        $translator = new ModuleTranslator("ocms");
        $translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
        try {
            $design = new managedoctorplan_Design();
            $start_time = $design->getStart_time()->getAllMinutes();
            $end_time = $design->getEnd_time()->getAllMinutes();
            $datePicker = $design->getDate();
            $datePicker->setHour((int)($start_time / 60));
            $datePicker->setMinute($start_time % 60);
            $start_time=$datePicker->getTime();


            $datePicker->setHour((int)($end_time / 60));
            $datePicker->setMinute($end_time % 60);
            $end_time=$datePicker->getTime();


            $doctor_fid_ID = $design->getDoctor_fid()->getSelectedID();
            $Result = $managedoctorplanController->BtnSave($this->getID(), $start_time, $end_time, $doctor_fid_ID,$this->getHttpGETparameter('username', -1),$this->getHttpGETparameter('password', -1));
            $design->setData($Result);
            $design->setMessage("اطلاعات با موفقیت ذخیره شد.");
            $design->setMessageType(MessageType::$SUCCESS);
            if ($this->getAdminMode()) {
                $ManageListRooter = new AppRooter("ocms", "managedoctorplans");
                $ManageListRooter->addParameter(new UrlParameter('username',$_GET['username']));
                $ManageListRooter->addParameter(new UrlParameter('password',$_GET['password']));
            }
            else
            {
                $ManageListRooter = new AppRooter("ocms", "manageuserdoctorplans");
                $ManageListRooter->addParameter(new UrlParameter('username',$_GET['username']));
                $ManageListRooter->addParameter(new UrlParameter('password',$_GET['password']));

            }
            AppRooter::redirect($ManageListRooter->getAbsoluteURL(), DEFAULT_PAGESAVEREDIRECTTIME);
        } catch (DataNotFoundException $dnfex) {
            $design = new message_Design();
            $design->setMessageType(MessageType::$ERROR);
            $design->setMessage("آیتم مورد نظر پیدا نشد");
        }
//        catch (\Exception $uex) {
//            $design = $this->getLoadDesign();
//            $design->setMessageType(MessageType::$ERROR);
//            $design->setMessage("متاسفانه خطایی در اجرای دستور خواسته شده بوجود آمد.");
//        }
        return $design->getResponse();
    }
}

?>