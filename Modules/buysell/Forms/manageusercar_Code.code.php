<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\html\GRecaptchaValidationStatus;
use core\CoreClasses\services\FormCode;
use Modules\buysell\Constants;
use Modules\buysell\Exceptions\ProductNotFoundException;
use Modules\buysell\PublicClasses\CarGroups;
use Modules\common\Forms\message_Design;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\buysell\Controllers\managecomponentController;
use Modules\files\PublicClasses\uploadHelper;
/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-26 - 2017-02-14 14:56
*@lastUpdate 1395-11-26 - 2017-02-14 14:56
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class manageusercar_Code extends managecar_Code {
    public function __construct($namespace=null)
    {
        parent::__construct($namespace);
        $this->setAdminMode(false);
    }
}
?>