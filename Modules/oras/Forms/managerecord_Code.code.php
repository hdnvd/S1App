<?php

namespace Modules\oras\Forms;

use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\oras\Controllers\managerecordController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;

/**
 * @author Hadi AmirNahavandi
 * @creationDate 1396-07-12 - 2017-10-04 03:03
 * @lastUpdate 1396-07-12 - 2017-10-04 03:03
 * @SweetFrameworkHelperVersion 2.002
 * @SweetFrameworkVersion 2.002
 */
class managerecord_Code extends FormCode
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
        return $this->getLoadDesign()->getBodyHTML();
    }

    public function getLoadDesign()
    {
        $managerecordController = new managerecordController();
        $managerecordController->setAdminMode($this->getAdminMode());
        $translator = new ModuleTranslator("oras");
        $translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
        try {
            $Result = $managerecordController->load($this->getID(), $this->getHttpGETparameter('employeeid', -1), $this->getHttpGETparameter('placeid', -1));
            $design = new managerecord_Design();
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
        $this->setTitle("Manage Record");
    }

    public function getID()
    {
        return $this->getHttpGETparameter('id', -1);
    }

    public function btnSave_Click()
    {
        $managerecordController = new managerecordController();
        $managerecordController->setAdminMode($this->getAdminMode());
        $translator = new ModuleTranslator("oras");
        $translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
        try {
            $design = new managerecord_Design();
            $title = $design->getTitle()->getValue();
            $occurance_date = $design->getOccurance_date()->getTime();
            $description = $design->getDescription()->getValue();
            $shifttype_fid_ID = $design->getShifttype_fid()->getSelectedID();
            $recordtype_fid_ID = $design->getRecordtype_fid()->getSelectedID();
            $employee_fid_ID = $this->getHttpGETparameter('employeeid', -1);
            $place_fid_ID = $this->getHttpGETparameter('placeid', -1);
            $file1_fluPaths = $design->getFile1_flu()->getSelectedFilesTempPath();
            $file1_fluNames = $design->getFile1_flu()->getSelectedFilesName();
            $file1_fluURLs = array();
            for ($fileIndex = 0; $fileIndex < count($file1_fluPaths) && $file1_fluPaths[$fileIndex] != null; $fileIndex++) {
                $file1_fluURLs[$fileIndex] = uploadHelper::UploadFile($file1_fluPaths[$fileIndex], $file1_fluNames[$fileIndex], "content/files/oras/managerecord/");
            }
            $file2_fluPaths = $design->getFile2_flu()->getSelectedFilesTempPath();
            $file2_fluNames = $design->getFile2_flu()->getSelectedFilesName();
            $file2_fluURLs = array();
            for ($fileIndex = 0; $fileIndex < count($file2_fluPaths) && $file2_fluPaths[$fileIndex] != null; $fileIndex++) {
                $file2_fluURLs[$fileIndex] = uploadHelper::UploadFile($file2_fluPaths[$fileIndex], $file2_fluNames[$fileIndex], "content/files/oras/managerecord/");
            }
            $file3_fluPaths = $design->getFile3_flu()->getSelectedFilesTempPath();
            $file3_fluNames = $design->getFile3_flu()->getSelectedFilesName();
            $file3_fluURLs = array();
            for ($fileIndex = 0; $fileIndex < count($file3_fluPaths) && $file3_fluPaths[$fileIndex] != null; $fileIndex++) {
                $file3_fluURLs[$fileIndex] = uploadHelper::UploadFile($file3_fluPaths[$fileIndex], $file3_fluNames[$fileIndex], "content/files/oras/managerecord/");
            }
            $file4_fluPaths = $design->getFile4_flu()->getSelectedFilesTempPath();
            $file4_fluNames = $design->getFile4_flu()->getSelectedFilesName();
            $file4_fluURLs = array();
            for ($fileIndex = 0; $fileIndex < count($file4_fluPaths) && $file4_fluPaths[$fileIndex] != null; $fileIndex++) {
                $file4_fluURLs[$fileIndex] = uploadHelper::UploadFile($file4_fluPaths[$fileIndex], $file4_fluNames[$fileIndex], "content/files/oras/managerecord/");
            }
            $Result = $managerecordController->BtnSave($this->getID(), $title, $occurance_date, $description, $shifttype_fid_ID, $recordtype_fid_ID, $employee_fid_ID, $place_fid_ID, $file1_fluURLs, $file2_fluURLs, $file3_fluURLs, $file4_fluURLs);
            $design->setData($Result);
            $design->setMessage("اطلاعات با موفقیت ذخیره شد.");
            $design->setMessageType(MessageType::$SUCCESS);
            $ManageListRooter = new AppRooter("oras", "managerecords");
            if ($employee_fid_ID > 0)
                $ManageListRooter->addParameter(new UrlParameter('employeeid',$employee_fid_ID));
            elseif($place_fid_ID>0)
                $ManageListRooter->addParameter(new UrlParameter('placeid',$place_fid_ID));

            AppRooter::redirect($ManageListRooter->getAbsoluteURL(), DEFAULT_PAGESAVEREDIRECTTIME);
        }catch (DataNotFoundException $dnfex) {
            $design = new message_Design();
            $design->setMessageType(MessageType::$ERROR);
            $design->setMessage("آیتم مورد نظر پیدا نشد");
        }
        catch (\Exception $uex) {
            $design = $this->getLoadDesign();
            $design->setMessageType(MessageType::$ERROR);
            $design->setMessage("متاسفانه خطایی در اجرای دستور خواسته شده بوجود آمد.");
        }
        return $design->getBodyHTML();
    }
}

?>