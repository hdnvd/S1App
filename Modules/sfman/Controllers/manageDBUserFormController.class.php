<?php

namespace Modules\sfman\Controllers;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\SweetDate;
use Modules\common\PublicClasses\AppDate;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\sfman\Entity\sfman_formelementEntity;
use Modules\sfman\Entity\sfman_formelementtypeEntity;
use Modules\sfman\Entity\sfman_formEntity;
use Modules\sfman\Entity\sfman_moduleEntity;
use Modules\sfman\Entity\sfman_tableEntity;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 1395/10/9 - 2016/12/29 19:36:38
 *@lastUpdate 1395/10/9 - 2016/12/29 19:36:38
 *@SweetFrameworkHelperVersion 1.112
*/

class manageDBUserFormController extends manageDBSenchaFormController
{

    protected function makeUserManageCode($formName,$GeneralFormInfo)
    {
        $GeneralformName=$GeneralFormInfo['form']['name'];

        $C = "<?php";
        $C .=$this->getFormNamespaceDefiner();
        $C.=$this->getFileInfoComment();

        $C .= "\nclass $formName" . "_Code extends $GeneralformName". "_Code {";
        $C.=<<<EOT
\npublic function __construct(\$namespace=null)
    {
        parent::__construct(\$namespace);
        \$this->setAdminMode(false);
    }
EOT;

        $C .= "\n}";
        $C .= "\n?>";
        file_put_contents($this->getCodeFile(), $C);

        chmod($this->getCodeFile(),0777);
    }
}
?>
