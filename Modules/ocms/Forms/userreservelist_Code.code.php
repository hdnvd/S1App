<?php
namespace Modules\ocms\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\ocms\Controllers\doctorreservelistController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-03 - 2018-01-23 00:07
*@lastUpdate 1396-11-03 - 2018-01-23 00:07
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class userreservelist_Code extends doctorreservelist_Code {

	public function __construct($namespace)
	{
		parent::__construct($namespace);
		$this->setTitle("User ReserveList List");
		$this->setServiceName('getuserreserves');
	}
}
?>