<?php
namespace Modules\buysell\Controllers;
use core\CoreClasses\db\DBField;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\buysell\Entity\buysell_carEntity;
use Modules\buysell\Entity\buysell_carphotoEntity;
use Modules\buysell\Exceptions\ProductNotFoundException;
use Modules\buysell\PublicClasses\Constants;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;

/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-27 - 2017-02-15 13:42
*@lastUpdate 1395-11-27 - 2017-02-15 13:42
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class managecarphotoController extends Controller {
    private $adminMode=true;

    /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
    }

    public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
        $phEnt=new buysell_carphotoEntity($DBAccessor);
        $CEnt=new buysell_carEntity($DBAccessor);
        $su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $UserID=null;
        if(!$this->adminMode)
            $UserID=$role_systemuser_fid;
		if($ID!=-1){
            $q=new QueryLogic();
            $q->addCondition(new FieldCondition(buysell_carphotoEntity::$CAR_FID,$ID));
            $q->setLimit("0,". Constants::$MAXPHOTOCOUNT);
            $result['photos']=$phEnt->FindAll($q);
            $carQL=new QueryLogic();
            $carQL->addCondition(new FieldCondition(new DBField("buysell_car." . buysell_carEntity::$ID,true),$ID));
            if($UserID!=null)
                $carQL->addCondition(new FieldCondition(buysell_carEntity::$ROLE_SYSTEMUSER_FID, $UserID));
            $result['component']=$CEnt->FindOne($carQL);
            if($result['component']==null )
                throw new ProductNotFoundException();

		}
		$DBAccessor->close_connection();
		return $result;
	}
	private function checkCarExistance($CarID,dbaccess $DBAccessor)
    {
        $su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $UserID=null;
        if(!$this->adminMode)
            $UserID=$role_systemuser_fid;
        $CEnt=new buysell_carEntity($DBAccessor);
        $carQL=new QueryLogic();
        $carQL->addCondition(new FieldCondition(new DBField("buysell_car." . buysell_carEntity::$ID,true),$CarID));
        if($UserID!=null)
            $carQL->addCondition(new FieldCondition(buysell_carEntity::$ROLE_SYSTEMUSER_FID, $UserID));
        $result['component']=$CEnt->FindOne($carQL);
        if($result['component']==null )
            throw new ProductNotFoundException();
    }
	public function BtnAddNew($ID,$flPhoto,$thumbnail)
	{
		$DBAccessor=new dbaccess();
        $this->checkCarExistance($ID,$DBAccessor);

        $phEnt=new buysell_carphotoEntity($DBAccessor);
        $phEnt->setCar_fid($ID);
        $phEnt->setImg_flu($flPhoto[0]['url']);
        $phEnt->setThumburl($thumbnail[0]['url']);
        $phEnt->setPriority(0);
        $phEnt->Save();
		$DBAccessor->close_connection();
		return $this->load($ID);
	}
    public function DeletePhoto($CarID, $PhotoID)
    {
        $DBAccessor=new dbaccess();
        $this->checkCarExistance($CarID,$DBAccessor);
        $phEnt=new buysell_carphotoEntity($DBAccessor);
        $phEnt->setId($PhotoID);
        if($phEnt->getId()==-1)
            throw new DataNotFoundException();
        if($phEnt->getCar_fid()!=$CarID)
            throw new ProductNotFoundException();
        else
            $phEnt->Remove();
        $DBAccessor->close_connection();
        return $this->load($CarID);
    }
}
?>