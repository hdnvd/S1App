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
class productController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$productEntityObject=new eshop_productEntity($DBAccessor);
		$result['product']=$productEntityObject;
		if($ID!=-1){
			$productEntityObject->setId($ID);
			if($productEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$eshop_productcolorEntityEntityObject=new eshop_productcolorEntity($DBAccessor);
			$result['productcolors']=$eshop_productcolorEntityEntityObject->FindAll($RelationLogic);
			$result['product']=$productEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>