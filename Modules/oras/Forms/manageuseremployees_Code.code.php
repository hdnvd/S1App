<?php
namespace Modules\oras\Forms;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-12 - 2017-10-04 02:52
*@lastUpdate 1396-07-12 - 2017-10-04 02:52
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class manageuseremployees_Code extends manageemployees_Code {
public function __construct($namespace=null)
    {
        parent::__construct($namespace);
        $this->setAdminMode(false);
    }
}
?>