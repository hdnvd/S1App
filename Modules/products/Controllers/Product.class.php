<?php
namespace Modules\products\Controllers;
use core\CoreClasses\services\Controller;
use Modules\parameters\PublicClasses\ParameterManager;
use Modules\products\Entity\ProductEntity;
use Modules\products\Entity\productAdditionalInfoEntity;
use Modules\products\Entity\ProductPhotoEntity;
use Modules\languages\PublicClasses\LanguageTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\products\Entity\products_productproductgroupEntity;
use Modules\products\Entity\products_viewgroupproductsinfoEntity;
use Modules\products\Entity\products_productgroupEntity;

/**
 *
 * @author nahavandi
 *        
 */
class Product extends Controller {
    private $GroupIDs;
    public function loadGroupProducts($MotherGroupID)
    {
        $LanguageID=CurrentLanguageManager::getCurrentLanguageID();
        $fullent=new products_viewgroupproductsinfoEntity();
        $GroupEnt=new products_productgroupEntity();
        $PGroupLangEnt=new products_productproductgroupEntity();
        $this->GroupIDs=array();
        $this->getGroupSubgroups($MotherGroupID);//Fills $this->GroupIDs
        //print_r($this->GroupIDs);
        for($i=0;$i<count($this->GroupIDs);$i++)
        {
            $result[$i]['groupinfo']=$GroupEnt->Select($this->GroupIDs[$i], null, $LanguageID, null, null,null, null, null, false);
            $result[$i]['groupinfo']=$result[$i]['groupinfo'][0];
            $result[$i]['products']=$fullent->Select(array("gid"), array($this->GroupIDs[$i]));
            // 			print_r($result[$i]['products']);
    	}
    	return $result;
    }	
    public function loadAllProducts()
    {
        $LanguageID=CurrentLanguageManager::getCurrentLanguageID();
        $fullent=new products_viewgroupproductsinfoEntity();
        $GroupEnt=new products_productgroupEntity();
        $PGroupLangEnt=new products_productproductgroupEntity();
        $this->GroupIDs=array();
        $mainGroups=$GroupEnt->Select(null, "-1", $LanguageID, null, null, null,null, array(), array());
        $mainGroupsCount=count($mainGroups);
        for($mgi=0;$mgi<$mainGroupsCount;$mgi++)
        {
            $this->GroupIDs=array();
            $this->getGroupSubgroups($mainGroups[$mgi]['id']);//Fills $this->GroupIDs
            $result[$mgi]['groupinfo']=$mainGroups[$mgi];
            $result[$mgi]['products']=array();
            $subGICount=count($this->GroupIDs);
            for($subGI=0;$subGI<$subGICount;$subGI++)
            {
                $tmpProduct=$fullent->Select(array("gid"), array($this->GroupIDs[$subGI]));
                $tPICount=count($tmpProduct);
                for($tPI=0;$tPI<$tPICount;$tPI++)
    					array_push($result[$mgi]['products'],$tmpProduct[$tPI]);
            }
        }
        return $result;
    }
    private function getGroupSubgroups($groupID)
    {
        $LanguageID=CurrentLanguageManager::getCurrentLanguageID();
        $GroupEnt=new products_productgroupEntity();
        array_push($this->GroupIDs, $groupID);
        $tmpGroups=$GroupEnt->Select(null, $groupID, $LanguageID, null, null, null, null,null, false);
        for($j=0;$j<count($tmpGroups);$j++)
            $this->getGroupSubgroups($tmpGroups[$j]['id']);
    }
	public function getAdditionalInfosTitle()
	{
		$LangName=CurrentLanguageManager::getCurrentLanguageName();
		$Translator=new LanguageTranslator();
		$Translator->setLanguageName($LangName);
		$additionalInfosTitle=array();
		$parametersCount=ParameterManager::getParameter("productadditionalinfocount");
		if($parametersCount===null)
			$parametersCount=0;
		for($i=0;$i<$parametersCount;$i++)
		{
			$tmpTitle=ParameterManager::getParameter("productinfotitle".($i+1));
			if($tmpTitle!==null)
				$additionalInfosTitle[$i]=$Translator->getWordTranslation($tmpTitle) . ":";
			else
				$additionalInfosTitle[$i]="Untitled";
		}
		return $additionalInfosTitle;
	}
	public function getLanguageProducts($LanguageID,$resultLength=null,$orderby="id")
	{
		$PPE=new products_viewgroupproductsinfoEntity();
		return $PPE->Select(array("language_fid"), array($LanguageID));
	}
	public function getProductByID($ProductID)
	{
		$ent=new ProductEntity();
		$product=$ent->Select($ProductID, null, null, null, null, null, null, null, null, null, null, null, null,null);
		$infoentity=new productAdditionalInfoEntity();
		$photoEntity=new ProductPhotoEntity();
		if(!is_null($product) && count($product)>0)
		{
			$product[0]['additionalinfo']=$infoentity->getProductInfo($ProductID);
			$product[0]['photo']=$photoEntity->getProductPhotos($ProductID);
			$groupEnt=new products_productproductgroupEntity();
			$productgroup=$groupEnt->Select(null, $ProductID, null, "0");
			if(!is_null($productgroup) && count($productgroup)>0)
			{
				$product[0]['groups']=$productgroup;
			}
		}
		
		return $product;
	}
	
}

?>