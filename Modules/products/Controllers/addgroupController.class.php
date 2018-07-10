<?php

namespace Modules\products\Controllers;

use core\CoreClasses\services\Controller;
use Modules\products\BusinessObjects\productGroupBO;
use Modules\products\Entity\ProductGroupEntity;
use Modules\pages\Entity\languageEntity;
use Modules\products\Entity\ProductEntity;
use Modules\products\BusinessObjects\productGroupLangBO;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\products\Entity\products_productgroupEntity;

/**
 *
 * @author nahavandi
 *        
 */
class addgroupController extends Controller {
	private $GroupInfo;
	public function addGroup($LatinTitle,$Title,$MotherID)
	{
		$LanguageID=CurrentLanguageManager::getCurrentLanguageID();
		$entity=new products_productgroupEntity();
		$entity->Insert($LanguageID, $Title, $LatinTitle, $MotherID);
		return true;
	}
	public function editGroup($GroupID,$LatinTitle,$Title,$MotherID)
	{
		$LanguageID=CurrentLanguageManager::getCurrentLanguageID();
		$entity=new products_productgroupEntity();
		$entity->Update($GroupID, $MotherID, null, $Title, $LatinTitle, null);
		return true;
	}
	public function load($GroupID)
	{
		$Lang=CurrentLanguageManager::getCurrentLanguageID();
		$entity=new products_productgroupEntity();
		$result['groups']=$entity->Select(null, null, $Lang, null, null,null, "0,100", null, null);

		if($GroupID!==null)
			$result['group']=$entity->Select($GroupID, null, null, null, null,null, "0,100", null, null);
		return $result;
	}
	public function loadAllGroupLangsLinkArray($languageID)
	{
		return $this->loadGroupLangsLinkArray(-1,$languageID);
		
	}
	private function loadGroupLangsLinkArray($groupID,$languageID)
	{
		$ent=new ProductGroupEntity();
		$groups=$ent->getSubGroupLangs($groupID,$languageID);

		if(!is_null($groups))
			for($i=0;$i<count($groups);$i++)
			{
				$groups[$i]['type']="group";
				$link=new AppRooter("products", "showproductlist");
				$link->addParameter(new UrlParameter("groupid", $groups[$i]['glangid']));
				$groups[$i]['link']= $link->getAbsoluteURL();
				$subs=$this->loadGroupLangsLinkArray($groups[$i]['gid'],$languageID);
				if($subs===null)
					$subs=$this->loadGroupLangProductsLinkArray($groups[$i]['glangid']);
				elseif($this->loadGroupLangProductsLinkArray($groups[$i]['glangid'])!==null)
					$subs=array_merge($subs,$this->loadGroupLangProductsLinkArray($groups[$i]['glangid']));
				$groups[$i]['subgroups']=$subs;

			}

			
		return $groups;
	}
	private function loadGroupLangProductsLinkArray($groupLangID)
	{
		$ent=new ProductEntity();
		$result=$ent->getGroupLangProducts($groupLangID);
		if(!is_null($result))
			
		{
			for($i=0;$i<count($result);$i++)
			{
				$result[$i]['type']="product";
				$link=new AppRooter("products", "showproduct");
				$link->addParameter(new UrlParameter("productid", $result[$i]['id']));
				$result[$i]['link']=$link->getAbsoluteURL();
			}
		}
		return $result;
	}
	public function loadAllGroupLangs($LanguageID)
	{
		$ent=new ProductGroupEntity();
		return $ent->getLanguageGroups($LanguageID);
	}
	public function loadGroupLang($groupLangID)
	{
		$ent=new ProductGroupEntity();
		return $ent->getGroupLang($groupLangID);
	}
	
}

?>