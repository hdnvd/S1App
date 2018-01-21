<?php

namespace Modules\ocms\Controllers;

use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\common\Entity\common_cityEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\ocms\Entity\ocms_specialityEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\ocms\Entity\ocms_doctorEntity;

/**
 * @author Hadi AmirNahavandi
 * @creationDate 1396-09-23 - 2017-12-14 01:18
 * @lastUpdate 1396-09-23 - 2017-12-14 01:18
 * @SweetFrameworkHelperVersion 2.004
 * @SweetFrameworkVersion 2.004
 */
class doctorlistController extends Controller
{
    private $PAGESIZE = 10;

    public function getData($PageNum, QueryLogic $QueryLogic)
    {
        $Language_fid = CurrentLanguageManager::getCurrentLanguageID();
        $DBAccessor = new dbaccess();
        $su = new sessionuser();
        $role_systemuser_fid = $su->getSystemUserID();
        $result = array();
        $specialityEntityObject = new ocms_specialityEntity($DBAccessor);
        $result['speciality_fid'] = $specialityEntityObject->FindAll(new QueryLogic());
        $common_cityEntityObject = new common_cityEntity($DBAccessor);
        $result['common_city_fid'] = $common_cityEntityObject->FindAll(new QueryLogic());
        if ($PageNum <= 0)
            $PageNum = 1;
        $UserID = null;
        if (!$this->getAdminMode())
            $UserID = $role_systemuser_fid;
        if ($UserID != null)
            $QueryLogic->addCondition(new FieldCondition(ocms_doctorEntity::$ROLE_SYSTEMUSER_FID, $UserID));
        $doctorEnt = new ocms_doctorEntity($DBAccessor);
        $result['doctor'] = $doctorEnt;
        $allcount = $doctorEnt->FindAllCount($QueryLogic);
        $result['pagecount'] = $this->getPageCount($allcount, $this->PAGESIZE);
        $QueryLogic->setLimit($this->getPageRowsLimit($PageNum, $this->PAGESIZE));
        $result['data'] = $doctorEnt->FindAll($QueryLogic);
        $DBAccessor->close_connection();
        return $result;
    }

    private $adminMode = true;

    public function getAdminMode()
    {
        return $this->adminMode;
    }

    /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
    }

    public function load($PageNum, $SpecialityID = -1, $PresenceTypeID = -1)
    {
        $DBAccessor = new dbaccess();
        $doctorEnt = new ocms_doctorEntity($DBAccessor);
        $q = new QueryLogic();
        $q->addOrderBy("id", true);
        if ($SpecialityID > 0)
            $q->addCondition(new FieldCondition(ocms_doctorEntity::$SPECIALITY_FID, $SpecialityID));

        if ($PresenceTypeID > 0) {
            /*
             *
             *
                public static int PRESENCETYPE_INOFFICE=1;
                public static int PRESENCETYPE_INHOME=2;
                public static int PRESENCETYPE_BYTEL=3;
             */
            if ($PresenceTypeID == 1)
                $q->addCondition(new FieldCondition(ocms_doctorEntity::$ISACTIVEONPLACE, 1));
            elseif ($PresenceTypeID == 2)
                $q->addCondition(new FieldCondition(ocms_doctorEntity::$ISACTIVEONHOME, 1));
            elseif ($PresenceTypeID == 3)
                $q->addCondition(new FieldCondition(ocms_doctorEntity::$ISACTIVEONPHONE, 1));
        }
        $DBAccessor->close_connection();
        return $this->getData($PageNum, $q);
    }

    public function Search($PageNum, $name, $family, $nezam_code, $mellicode, $mobile, $email, $tel, $ismale, $speciality_fid, $education, $matabtel, $matabaddress, $longitude, $latitude, $common_city_fid, $isactiveonphone, $isactiveonplace, $isactiveonhome, $sortby, $isdesc)
    {
        $DBAccessor = new dbaccess();
        $doctorEnt = new ocms_doctorEntity($DBAccessor);
        $q = new QueryLogic();
        $q->addOrderBy("id", true);
        $q->addCondition(new FieldCondition("name", "%$name%", LogicalOperator::LIKE));
        $q->addCondition(new FieldCondition("family", "%$family%", LogicalOperator::LIKE));
        $q->addCondition(new FieldCondition("nezam_code", "%$nezam_code%", LogicalOperator::LIKE));
        $q->addCondition(new FieldCondition("mellicode", "%$mellicode%", LogicalOperator::LIKE));
        $q->addCondition(new FieldCondition("mobile", "%$mobile%", LogicalOperator::LIKE));
        $q->addCondition(new FieldCondition("email", "%$email%", LogicalOperator::LIKE));
        $q->addCondition(new FieldCondition("tel", "%$tel%", LogicalOperator::LIKE));
        $q->addCondition(new FieldCondition("ismale", "%$ismale%", LogicalOperator::LIKE));
        $q->addCondition(new FieldCondition("speciality_fid", "%$speciality_fid%", LogicalOperator::LIKE));
        $q->addCondition(new FieldCondition("education", "%$education%", LogicalOperator::LIKE));
        $q->addCondition(new FieldCondition("matabtel", "%$matabtel%", LogicalOperator::LIKE));
        $q->addCondition(new FieldCondition("matabaddress", "%$matabaddress%", LogicalOperator::LIKE));
        $q->addCondition(new FieldCondition("longitude", "%$longitude%", LogicalOperator::LIKE));
        $q->addCondition(new FieldCondition("latitude", "%$latitude%", LogicalOperator::LIKE));
        $q->addCondition(new FieldCondition("common_city_fid", "%$common_city_fid%", LogicalOperator::LIKE));
        $q->addCondition(new FieldCondition("isactiveonphone", "%$isactiveonphone%", LogicalOperator::LIKE));
        $q->addCondition(new FieldCondition("isactiveonplace", "%$isactiveonplace%", LogicalOperator::LIKE));
        $q->addCondition(new FieldCondition("isactiveonhome", "%$isactiveonhome%", LogicalOperator::LIKE));
        $sortByField = $doctorEnt->getTableField($sortby);
        if ($sortByField != null)
            $q->addOrderBy($sortByField, $isdesc);
        $DBAccessor->close_connection();
        return $this->getData($PageNum, $q);
    }
}

?>