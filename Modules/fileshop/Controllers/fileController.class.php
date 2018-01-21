<?php
namespace Modules\fileshop\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\fileshop\Entity\fileshop_filecategoryEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\fileshop\Entity\fileshop_fileEntity;
use Modules\users\PublicClasses\User;

/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-15 - 2017-12-06 00:34
*@lastUpdate 1396-09-15 - 2017-12-06 00:34
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class fileController extends Controller {
	public function load($ID,$UserName=null,$Password=null)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$fileEntityObject=new fileshop_fileEntity($DBAccessor);
		$result['file']=$fileEntityObject;
		if($ID!=-1){
			$fileEntityObject->setId($ID);
			if($fileEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$fileshop_filecategoryEntityEntityObject=new fileshop_filecategoryEntity($DBAccessor);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('file_fid',$ID));
			$result['filecategorys']=$fileshop_filecategoryEntityEntityObject->FindAll($RelationLogic);
			$result['file']=$fileEntityObject;
            $user=new User(-1);
            $SystemUserID=$user->getSystemUserIDFromUserPass($UserName,$Password);
			$ispurchased=$fileEntityObject->getFileIsPurchased($ID,$SystemUserID);
            $result['ispurchased']=$ispurchased;

        }
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>