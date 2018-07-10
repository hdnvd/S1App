<?php
namespace Modules\ocms\Forms;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-30 - 2017-12-21 18:44
*@lastUpdate 1396-09-30 - 2017-12-21 18:44
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageuserdoctorplan_Code extends managedoctorplan_Code {
public function __construct($namespace=null)
    {
        parent::__construct($namespace);
        $this->setAdminMode(false);
    }
}
?>