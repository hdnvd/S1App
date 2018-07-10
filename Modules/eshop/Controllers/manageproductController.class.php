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
class manageproductController extends Controller {
	private $adminMode=true;
    public function getAdminMode()
    {
        return $this->adminMode;
    }
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
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$productEntityObject=new eshop_productEntity($DBAccessor);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('product_fid',$ID));
		$ColorListEntityObject=new eshop_colorEntity($DBAccessor);
		$result['colors']=$ColorListEntityObject->FindAll(new QueryLogic());
		$result['product']=$productEntityObject;
		if($ID!=-1){
			$productEntityObject->setId($ID);
			if($productEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $productEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$eshop_productcolorEntityEntityObject=new eshop_productcolorEntity($DBAccessor);
			$result['productcolors']=$eshop_productcolorEntityEntityObject->FindAll($RelationLogic);
			$result['product']=$productEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title,$latintitle,$description,$pic1_flu,$pic2_flu,$pic3_flu,$pic4_flu,$price,$code,$adddate,$visitcount,$is_exists,$Colors)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$productEntityObject=new eshop_productEntity($DBAccessor);
		$pic1_fluURL='';
		if($pic1_flu!=null && count($pic1_flu)>0)
			$pic1_fluURL=$pic1_flu[0]['url'];
		$pic2_fluURL='';
		if($pic2_flu!=null && count($pic2_flu)>0)
			$pic2_fluURL=$pic2_flu[0]['url'];
		$pic3_fluURL='';
		if($pic3_flu!=null && count($pic3_flu)>0)
			$pic3_fluURL=$pic3_flu[0]['url'];
		$pic4_fluURL='';
		if($pic4_flu!=null && count($pic4_flu)>0)
			$pic4_fluURL=$pic4_flu[0]['url'];
		$this->ValidateFieldArray([$title,$latintitle,$description,$pic1_fluURL,$pic2_fluURL,$pic3_fluURL,$pic4_fluURL,$price,$code,$adddate,$visitcount,$is_exists],[$productEntityObject->getFieldInfo(eshop_productEntity::$TITLE),$productEntityObject->getFieldInfo(eshop_productEntity::$LATINTITLE),$productEntityObject->getFieldInfo(eshop_productEntity::$DESCRIPTION),$productEntityObject->getFieldInfo(eshop_productEntity::$PIC1_FLU),$productEntityObject->getFieldInfo(eshop_productEntity::$PIC2_FLU),$productEntityObject->getFieldInfo(eshop_productEntity::$PIC3_FLU),$productEntityObject->getFieldInfo(eshop_productEntity::$PIC4_FLU),$productEntityObject->getFieldInfo(eshop_productEntity::$PRICE),$productEntityObject->getFieldInfo(eshop_productEntity::$CODE),$productEntityObject->getFieldInfo(eshop_productEntity::$ADDDATE),$productEntityObject->getFieldInfo(eshop_productEntity::$VISITCOUNT),$productEntityObject->getFieldInfo(eshop_productEntity::$IS_EXISTS)]);
		if($ID==-1){
			$productEntityObject->setTitle($title);
			$productEntityObject->setLatintitle($latintitle);
			$productEntityObject->setDescription($description);
			if($pic1_fluURL!='')
			$productEntityObject->setPic1_flu($pic1_fluURL);
			if($pic2_fluURL!='')
			$productEntityObject->setPic2_flu($pic2_fluURL);
			if($pic3_fluURL!='')
			$productEntityObject->setPic3_flu($pic3_fluURL);
			if($pic4_fluURL!='')
			$productEntityObject->setPic4_flu($pic4_fluURL);
			$productEntityObject->setPrice($price);
			$productEntityObject->setCode($code);
			$productEntityObject->setAdddate($adddate);
			$productEntityObject->setVisitcount($visitcount);
			$productEntityObject->setIs_exists($is_exists);
			$productEntityObject->Save();
		}
		else{
			$productEntityObject->setId($ID);
			if($productEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $productEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$productEntityObject->setTitle($title);
			$productEntityObject->setLatintitle($latintitle);
			$productEntityObject->setDescription($description);
			if($pic1_fluURL!='')
			$productEntityObject->setPic1_flu($pic1_fluURL);
			if($pic2_fluURL!='')
			$productEntityObject->setPic2_flu($pic2_fluURL);
			if($pic3_fluURL!='')
			$productEntityObject->setPic3_flu($pic3_fluURL);
			if($pic4_fluURL!='')
			$productEntityObject->setPic4_flu($pic4_fluURL);
			$productEntityObject->setPrice($price);
			$productEntityObject->setCode($code);
			$productEntityObject->setAdddate($adddate);
			$productEntityObject->setVisitcount($visitcount);
			$productEntityObject->setIs_exists($is_exists);
			$productEntityObject->Save();
			$ID=$productEntityObject->getId();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('product_fid',$ID));
		$eshop_productcolorEntityObject=new eshop_productcolorEntity($DBAccessor);
		$CurrentColors=$eshop_productcolorEntityObject->FindAll($RelationLogic);
		$CurrentColorsCount = count($CurrentColors);
		for ($i = 0; $i < $CurrentColorsCount; $i++) {
			if(array_search($CurrentColors[$i]->getId(),$CurrentColors)===FALSE)
				$CurrentColors[$i]->Remove();
			else
			{
				unset($CurrentColors[$i]);
				$CurrentColors=array_values($CurrentColors);
			}
		}
		$ColorsCount = count($Colors);
		for ($i = 0; $i < $ColorsCount; $i++) {
			$eshop_productcolorEntityObject=new eshop_productcolorEntity($DBAccessor);
			$eshop_productcolorEntityObject->setProduct_fid($ID);
			$eshop_productcolorEntityObject->setColor_fid($Colors[$i]);
			$eshop_productcolorEntityObject->Save();
		}
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>