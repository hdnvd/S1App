<?php
namespace Modules\buysell\Forms;
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