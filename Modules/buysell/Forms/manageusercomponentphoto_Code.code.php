<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\Exception\FileSizeError;
use core\CoreClasses\Exception\FileTypeError;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use Modules\buysell\Exceptions\ProductNotFoundException;
use Modules\buysell\Exceptions\ProductPhotoNotFoundException;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\buysell\Controllers\managecomponentphotoController;
use Modules\files\PublicClasses\uploadHelper;
/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-27 - 2017-02-15 13:42
*@lastUpdate 1395-11-27 - 2017-02-15 13:42
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class manageusercomponentphoto_Code extends managecomponentphoto_Code {

    public function __construct($namespace=null)
    {
        parent::__construct($namespace);
        $this->setAdminMode(false);
    }
}
?>