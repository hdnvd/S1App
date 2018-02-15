<?php

namespace Modules\users\PublicClasses;


use core\CoreClasses\db\dbaccess;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\QueryLogic;
use Modules\users\Entity\users_systemroleEntity;
use Modules\users\Entity\users_systemuserroleEntity;
use Modules\users\Entity\users_userlogEntity;
use Modules\common\PublicClasses\AppDate;
/**
 *
 * @author nahavandi
 *        
 */
class AccessController{
	public function getUserAccess($SystemUserID,$Module,$Page,$Action,dbaccess $dbaccess=null,$savelog=true)
	{
	    $AutoCloseDBAccess=false;
	    if($dbaccess==null)
        {
            $AutoCloseDBAccess=true;
            $dbaccess=new dbaccess();
        }
		$roleEnt=new users_systemuserroleEntity($dbaccess);
		if(is_numeric($SystemUserID))
            $roleEnt=$roleEnt->FindOne(new QueryLogic([new FieldCondition(users_systemuserroleEntity::$SYSTEMUSER_FID,$SystemUserID)]));
		else
            $roleEnt=null;
		$accessEnt=new users_systemroleEntity($dbaccess);
		$roleid=-1;
		if($roleEnt!=null && $roleEnt->getId()>0)
		{
			$roleid=$roleEnt->getSystemrole_fid();
			$access=$accessEnt->getRoleAccess($roleid,$Module,$Page,"*");
			if($access)
			{
			    if($savelog)
				    $this->saveLog($SystemUserID, $Module, $Page, $Action);
				if($AutoCloseDBAccess)
                    $dbaccess->close_connection();
				return true;
			}
			else 
			{
				$access=$accessEnt->getRoleAccess($roleid,$Module,$Page,$Action);
				if($access)
				{
                    if($savelog)
                        $this->saveLog($SystemUserID, $Module, $Page, $Action);
                    if($AutoCloseDBAccess)
                        $dbaccess->close_connection();
					return true;
				}
			}
			
			
		}
		else
        {
            if($AutoCloseDBAccess )
                $dbaccess->close_connection();
            return $accessEnt->getRoleAccess(-1,$Module,$Page,"*");
        }
        if($AutoCloseDBAccess )
            $dbaccess->close_connection();
		return false;
	}
	private function saveLog($SystemUserID,$Module, $Page, $Action)
	{
        $dbaccess=new dbaccess();
		$Ent=new users_userlogEntity($dbaccess);
		$Time=AppDate::now();
		$Ent->setAction($Action);
		$Ent->setRole_systemuser_fid($SystemUserID);
		$Ent->setModule($Module);
		$Ent->setPage($Page);
		$Ent->setTime($Time);
		$Ent->Save();
        $dbaccess->close_connection();
	}
}

?>