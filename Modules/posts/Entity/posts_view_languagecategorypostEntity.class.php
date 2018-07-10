<?php

namespace Modules\posts\Entity;

use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\DBField;
use core\CoreClasses\db\baseLogicalQuery;

/**
 *
 * @author nahavandi
 * @desc	This View Is The Same As Posts_postlanguagecategory Table But Have Other Fields Of Post Beside It;
 * 
 */
class posts_view_languagecategorypostEntity extends EntityClass {
	private $Database;
	/**
	 * @var baseLogicalQuery
	 */
	private $Query;
	public function __construct()
	{
		$this->Database=new dbquery();
	} 
	public function Select($LanguageCategoryID,$MinID=-1,$IsPublished=null,$OrderAscending=false,$Limit=null,$MinDate=null,$orderBy="post.id")
	{
		$this->Query=$this->Database->Select("post.*")->From(array("posts_post post","posts_postlanguagecategory plc"))->Where()
		->Equal("post.id", new DBField("plc.post_fid",false))->AndLogic()
		->Bigger("post.id", $MinID)->AndLogic()
		->Equal("post.isdeleted", "0")->AndLogic()
		->Equal("plc.isdeleted", "0");
		$this->Query=$this->Query->AndLogic()->Equal("plc.languagecategory_fid", $LanguageCategoryID);
		if($MinDate!==null)
			$this->Query=$this->Query->AndLogic()->Bigger("post.adddate", $MinDate);
		
		if(!is_null($IsPublished))
		{
			if($IsPublished)
				$this->Query=$this->Query->AndLogic()->Equal("post.ispublished", 1);
			else
				$this->Query=$this->Query->AndLogic()->Equal("post.ispublished", 0);
		}
		$this->Query=$this->Query->AddOrderBy($orderBy, !$OrderAscending);
		if($Limit!==null)
			$this->Query->setLimit($Limit);
//  		echo $this->Query->getQueryString();
		return $this->Query->ExecuteAssociated();
	
	}
	public function SelectPostCats($PostID=null)
	{
		$this->Query=$this->Database->Select("category.*")->From(array("posts_languagecategory category","posts_postlanguagecategory plc"))->Where()
		->Equal("plc.languagecategory_fid", new DBField("category.id",false))
		->AndLogic()->Equal("plc.isdeleted", "0")
		->AndLogic()->Equal("category.isdeleted", "0");
		if($PostID!==null)
			$this->Query=$this->Query->AndLogic()->Equal("plc.post_fid", $PostID);
		//echo $this->Query->getQueryString();
		return $this->Query->ExecuteAssociated();

	}
}

?>