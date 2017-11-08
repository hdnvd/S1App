<?php
namespace Modules\onlineclass\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\onlineclass\Entity\onlineclass_courseEntity;
use Modules\onlineclass\Entity\onlineclass_tutorEntity;
use Modules\onlineclass\Entity\onlineclass_levelEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-25 - 2017-10-17 21:18
*@lastUpdate 1396-07-25 - 2017-10-17 21:18
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class courseController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$courseEntityObject=new onlineclass_courseEntity($DBAccessor);
		$result['course']=$courseEntityObject;
		if($ID!=-1){
			$courseEntityObject->setId($ID);
			if($courseEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['course']=$courseEntityObject;
			$tutorEntityObject=new onlineclass_tutorEntity($DBAccessor);
			$tutorEntityObject->SetId($result['course']->getTutor_fid());
			if($tutorEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['tutor_fid']=$tutorEntityObject;
			$levelEntityObject=new onlineclass_levelEntity($DBAccessor);
			$levelEntityObject->SetId($result['course']->getLevel_fid());
			if($levelEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['level_fid']=$levelEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>