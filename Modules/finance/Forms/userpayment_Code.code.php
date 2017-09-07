<?php
namespace Modules\finance\Forms;
use core\CoreClasses\services\FormCode;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\finance\Controllers\manualpaymentController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-15 - 2017-09-06 16:47
*@lastUpdate 1396-06-15 - 2017-09-06 16:47
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class userpayment_Code extends manualpayment_Code {
    public function __construct($namespace)
    {
        parent::__construct($namespace);
        $this->setPageTitle("افزایش اعتبار");
        $this->setDescription("افزایش اعتبار");
        $this->setDisplayManualInfo(false);
    }


}
?>