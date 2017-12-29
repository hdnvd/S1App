<?php
namespace Modules\eshop\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\eshop\Entity\eshop_productEntity;
use Modules\eshop\Entity\eshop_pic1Entity;
use Modules\eshop\Entity\eshop_pic2Entity;
use Modules\eshop\Entity\eshop_pic3Entity;
use Modules\eshop\Entity\eshop_pic4Entity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-08-28 - 2017-11-19 00:39
*@lastUpdate 1396-08-28 - 2017-11-19 00:39
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageproductsController extends productlistController {
	private $PAGESIZE=10;
	public function DeleteItem($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$productEnt=new eshop_productEntity($DBAccessor);
		$productEnt->setId($ID);
		if($productEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $productEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$productEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>