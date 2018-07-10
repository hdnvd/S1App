<?php

namespace Modules\products\Entity;

use core\CoreClasses\services\EntityClass;
use Modules\products\BusinessObjects\productBO;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\db\dbquery;
use Modules\products\EntityObjects\ProductEO;
use core\CoreClasses\db\DBField;
use core\CoreClasses\db\selectQuery;
use core\CoreClasses\db\updateQuery;
use core\CoreClasses\db\insertQuery;

/**
 *
 * @author Hadi Nahavandi
 * @version 0.1       
 */
class ProductEntity extends EntityClass 
{
	/**
	 * @var updateQuery
	 */
	private $Query;
	public function __construct(dbaccess $DBAccessor=null)
	{
	    $this->setDatabase(new dbquery($DBAccessor));
	    $this->setTableName("product");
	}
	public function Insert($LatinName,$Title,$Description,$MainPhoto,$ThumbnailURL,$AddDate,$Visits,$Rank,$IsPublished,$IsNew,$IsExists,$UserID)
	{
		$Database=new dbquery();
		$query=$Database->InsertInto("product")
		->Set("adddate", $AddDate)
		->Set("visits", $Visits)
		->Set("rank", $Rank)
		->Set("description", $Description)
		->Set("thumburl", $ThumbnailURL)
		->Set("mainphoto", $MainPhoto)
		->Set("title", $Title)
		->Set("latinname", $LatinName)
		->Set("ispublished", $IsPublished)
		->Set("isnew", $IsNew)
		->Set("isdeleted", "0")
		->Set("isexists", $IsExists)
		->Set("role_systemuser_fid", $UserID);
		$query->Execute();
		$ProductId=$query->getInsertedId();
		return $ProductId;
	}
	public function Update($ID,$LatinName,$Title,$Description,$MainPhoto,$ThumbnailURL,$AddDate,$Visits,$Rank,$IsPublished,$IsNew,$IsExists,$UserID)
	{
		$Database=new dbquery();
		$query=$Database->Update("product")
		->NotNullSet("adddate", $AddDate)
		->NotNullSet("visits", $Visits)
		->NotNullSet("rank", $Rank)
		->NotNullSet("description", $Description)
		->NotNullSet("thumburl", $ThumbnailURL)
		->NotNullSet("mainphoto", $MainPhoto)
		->NotNullSet("title", $Title)
		->NotNullSet("latinname", $LatinName)
		->NotNullSet("ispublished", $IsPublished)
		->NotNullSet("isnew", $IsNew)
		->NotNullSet("isexists", $IsExists)
		->NotNullSet("isdeleted", "0")
		->NotNullSet("role_systemuser_fid", $UserID)
		->Where()->Equal("id", $ID);
// 		echo $query->getQueryString();
		$query->Execute();
		return true;
	}
	private function FullSelect(array $Fields,$ID,$LatinName,$Title,$Description,$MainPhoto,$ThumbnailURL,$AddDate,$Visits,$Rank,$IsPublished,$UserID,$Limit, $Orders, $IsDescendings)
	{
		$Database=new dbquery();
		$Query=$Database->Select($Fields)->From("product")->Where()->Equal("isdeleted", "0");
		if($ID!==null)
			$Query=$Query->AndLogic()->Equal("id", $ID);
		if($LatinName!==null)
			$Query=$Query->AndLogic()->Like("latinname", $LatinName);
		if($Title!==null)
			$Query=$Query->AndLogic()->Like("title", $Title);
		if($Description!==null)
			$Query=$Query->AndLogic()->Like("description", $Description);
		if($MainPhoto!==null)
			$Query=$Query->AndLogic()->Like("mainphoto", $MainPhoto);
		if($ThumbnailURL!==null)
			$Query=$Query->AndLogic()->Like("thumburl", $ThumbnailURL);
		if($AddDate!==null)
			$Query=$Query->AndLogic()->Like("adddate", $AddDate);
		if($Visits!==null)
			$Query=$Query->AndLogic()->Equal("visits", $Visits);
		if($Rank!==null)
			$Query=$Query->AndLogic()->Equal("rank", $Rank);
		if($IsPublished!==null)
			$Query=$Query->AndLogic()->Equal("ispublished", $IsPublished);
		if($UserID!==null)
			$Query=$Query->AndLogic()->Equal("role_systemuser_fid", $UserID);
		$Query=$Query->AndLogic()->Equal("isdeleted", "0");
		for($i=0;$Orders!==null && $i<count($Orders);$i++)
		{
		if($IsDescendings!==null && $i<count($IsDescendings))
			$IsDescending=$IsDescendings[$i];
			else
			$IsDescending=false;
			$Query=$Query->AddOrderBy($Orders[$i], $IsDescending);
		}
		if($Limit!==null)
			$Query->setLimit($Limit);
			return $Query->ExecuteAssociated();
	}
	public function Select($ID,$LatinName,$Title,$Description,$MainPhoto,$ThumbnailURL,$AddDate,$Visits,$Rank,$IsPublished,$UserID,$Limit, $Orders,$IsDescendings)
	{
		return $this->FullSelect(array("*"), $ID, $LatinName, $Title, $Description, $MainPhoto, $ThumbnailURL, $AddDate, $Visits, $Rank, $IsPublished, $UserID,$Limit, $Orders, $IsDescendings);
	}
	public function SelectCount($ID,$LatinName,$Title,$Description,$MainPhoto,$ThumbnailURL,$AddDate,$Visits,$Rank,$IsPublished,$UserID,$Limit, $Orders, $IsDescendings)
	{
		return $this->FullSelect(array("count(*) resultcount"), $ID, $LatinName, $Title, $Description, $MainPhoto, $ThumbnailURL, $AddDate, $Visits, $Rank, $IsPublished, $UserID,$Limit, $Orders, $IsDescendings);
	}
	
	public function getGroupLangProducts($GroupID,$Limit="0,30")
	{
		$Database=new dbquery();
		$query=$Database->Select(array("p.id As id","p.title AS text","p.mainphoto","p.thumburl"))->From(array("productgrouplang pgl","productproductgroup ppg","product p"))->Where()
		->Equal("p.isdeleted", "0")->AndLogic()
		->Equal("p.id", new DBField("ppg.product_fid",false))->AndLogic()
		->Equal("pgl.id", new DBField("ppg.productgrouplang_fid",false))->AndLogic()
		->Equal("pgl.id", $GroupID)
		->setLimit($Limit);
		$result=$query->ExecuteAssociated();
		return $result;
	}
	
	
	
	public function getGroupLangProductsCount($GroupID)
	{
		$Database=new dbquery();
		$query=$Database->Select(array("count(*) resultcount"))->From(array("productgrouplang pgl","productproductgroup ppg","product p"))->Where()
		->Equal("p.isdeleted", "0")->AndLogic()
		->Equal("p.id", new DBField("ppg.product_fid",false))->AndLogic()
		->Equal("pgl.id", new DBField("ppg.productgrouplang_fid",false))->AndLogic()
		->Equal("pgl.id", $GroupID);
		$result=$query->ExecuteAssociated();
		return $result;
	}
	

	
	public function getLangProducts($LanguageID,$resultLength=null,$orderby="id")
	{
	
		$Database=new dbquery();
		$query=$Database->Select("p.*")->From(array("product p","productproductgroup pg","productgrouplang pgl"))->Where()->Equal("p.id", new DBField("pg.product_fid",false))->AndLogic()->Equal("pgl.id", new DBField("pg.productgrouplang_fid",false))->AndLogic()->Equal("pgl.language_fid", $LanguageID)->AndLogic()->Equal("p.isdeleted", "0")->AddOrderBy($orderby, true);
		if(!is_null($resultLength))
			$query->setLimit("0,$resultLength");
		return $query->ExecuteAssociated();
	}
	public function getLangProductsCount($LanguageID)
	{
	
		$Database=new dbquery();
		$query=$Database->Select(array("count(*) resultcount"))->From(array("product p","productproductgroup pg","productgrouplang pgl"))->Where()->Equal("p.id", new DBField("pg.product_fid",false))->AndLogic()->Equal("pgl.id", new DBField("pg.productgrouplang_fid",false))->AndLogic()->Equal("pgl.language_fid", $LanguageID)->AndLogic()->Equal("p.isdeleted", "0");
		return $query->ExecuteAssociated();
	}
	public function Delete($ProductID)
	{
		$Database=new dbquery();
		$Database->Update("product")->Set("isdeleted", "1")->Where()->Equal("id", $ProductID)->Execute();
	}
	
}

?>