<?php

namespace Modules\buysell\Forms;

use core\CoreClasses\html\GRecaptchaValidationStatus;
use core\CoreClasses\services\FormCode;
use Modules\buysell\PublicClasses\CarGroups;
use Modules\common\Forms\message_Design;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\buysell\Controllers\managecarController;
use Modules\files\PublicClasses\uploadHelper;

/**
 * @author Hadi AmirNahavandi
 * @creationDate 1396-03-25 - 2017-06-15 02:03
 * @lastUpdate 1396-03-25 - 2017-06-15 02:03
 * @SweetFrameworkHelperVersion 2.001
 * @SweetFrameworkVersion 1.018
 */
class managecar_Code extends FormCode
{
    public function load()
    {
        $managecarController = new managecarController();
        $translator = new ModuleTranslator("buysell");
        $translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
        $carmakerID=$this->getHttpGETparameter('carmaker_fid_id',-1);
        if($carmakerID>0)
        {
            $Result = $managecarController->loadCarModels($carmakerID);
        }
        else
        {
            $Result = $managecarController->load($this->getID(),$this->getHttpGETparameter('groupid',1));
        }
        $design = new managecar_Design();
        $design->setData($Result);
        $design->setMessage("");
        return $design->getResponse();
    }

    public function getID()
    {
        $id = -1;
        if (isset($_GET['id']))
            $id = $_GET['id'];
        return $id;
    }

    public function btnSave_Click()
    {
        $design = new managecar_Design();
        $recaptchaStatus = $design->getRecaptcha()->getValidationStatus();
        if ($recaptchaStatus == GRecaptchaValidationStatus::$VALID) {
            try {
                $managecarController = new managecarController();
                $translator = new ModuleTranslator("buysell");
                $translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
                $details = $design->getDetails()->getValue();
                $price = $design->getPrice()->getValue();
                $adddate = $design->getAdddate()->getValue();
                $body_carcolor_fid_ID = $design->getBody_carcolor_fid()->getSelectedID();
                $inner_carcolor_fid_ID = $design->getInner_carcolor_fid()->getSelectedID();
                $paytype_fid_ID = $design->getPaytype_fid()->getSelectedID();
                $cartype_fid_ID = $design->getCartype_fid()->getSelectedID();
                $usagecount = $design->getUsagecount()->getValue();
                $wheretodate = $design->getWheretodate()->getValue();
                $carbodystatus_fid_ID = $design->getCarbodystatus_fid()->getSelectedID();
                $makedate = $design->getMakedate()->getSelectedID();
                $carstatus_fid_ID = -1;
                $shasitype_fid_ID = $design->getShasitype_fid()->getSelectedID();
                $isautogearbox = $design->getIsautogearbox()->getSelectedValues();
                $carmodel_fid_ID = $design->getCarmodel_fid()->getSelectedID();
                $cartagtype_fid_ID = $design->getCartagtype_fid()->getSelectedID();
                $carentitytype_fid_ID = $design->getCarentitytype_fid()->getSelectedID();
                $carGroup=$this->getHttpGETparameter('groupid',1);
                $Result = $managecarController->BtnSave($this->getID(), $details, $price, $adddate, $body_carcolor_fid_ID, $inner_carcolor_fid_ID, $paytype_fid_ID, $cartype_fid_ID, $usagecount, $wheretodate, $carbodystatus_fid_ID, $makedate, $carstatus_fid_ID, $shasitype_fid_ID, $isautogearbox, $carmodel_fid_ID, $cartagtype_fid_ID, $carentitytype_fid_ID);
                $design->setData($Result);

                $cg=new CarGroups();
                $groupName=$cg->getGroupName($carGroup);
                if ($Result['id'] >= 0) {
                    $Ar = new AppRooter($groupName, 'managecarphoto');
                    $Ar->addParameter(new UrlParameter('id', $Result['id']));
                    $design->setMessage(AppRooter::redirect($Ar->getAbsoluteURL()));
                } else {
                    $design->setMessage("خطایی در ذخیره تغییرات بوجود آمد");
                }
            } catch (\Exception $UnE) {
                $design = new message_Design();
                $design->setMessage("خطایی در ذخیره تغییرات بوجود آمد");

            }
            return $design->getBodyHTML();
        } else if ($recaptchaStatus == GRecaptchaValidationStatus::$NOTCLICKED) {
            $design = new message_Design();
            $design->setMessageType("error");
            $design->setMessage("سوال امنیتی پاسخ داده نشده");
            return $design->getBodyHTML();
        } else {
            $design = new message_Design();
            $design->setMessageType("error");
            $design->setMessage("پاسخ سوال امنیتی صحیح نبود،لطفا دوباره تلاش کنید");
            return $design->getBodyHTML();
        }

    }
}

?>