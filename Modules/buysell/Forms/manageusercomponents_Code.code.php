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
class manageusercomponents_Code extends managecomponents_Code {

    public function __construct($namespace=null)
    {
        parent::__construct($namespace);
        $this->setAdminMode(false);
    }
}
?>