<?php

namespace Modules\posts\Entity;

use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\DBField;
use core\CoreClasses\db\selectQuery;

/**
 *
 * @author nahavandi
 *       
 */
class posts_view_languagepostEntity extends EntityClass {
    /**
     * @var selectQuery
     */
	private $Database;
	public function __construct()
	{

	    $this->Database=new dbquery();
	} 
// 	public function getCount()
// 	{
// 		$Query=$this->Database->Select("count(*) c")->From(array("posts_post post","posts_postlanguagecategory plc","posts_languagecategory lc"))->Where()
// 		->Equal("post.id", new DBField("plc.post_fid",false))->AndLogic()
// 		->Equal("plc.languagecategory_fid", new DBField("lc.id",false))->AndLogic()
// 		->Equal("post.isdeleted", "0")->AndLogic()
// 		->Equal("post.ispublished", 1);
// 		$result=$Query->ExecuteAssociated();
// 		return $result[0]['c'];
// 	}
	public function Select($LanguageID,$MinID=-1,$IsPublished=null,$OrderAscending=false,$Limit=null,$MinDate=null)
	{
		$Query=$this->Database->Select("post.*")->From(array("posts_post post","posts_postlanguagecategory plc","posts_languagecategory lc"))->Where()
		->Equal("post.id", new DBField("plc.post_fid",false))->AndLogic()
		->Equal("plc.languagecategory_fid", new DBField("lc.id",false))->AndLogic()
		->Equal("lc.language_fid", $LanguageID)->AndLogic()
		->Bigger("post.id", $MinID)->AndLogic()
		->Equal("post.isdeleted", "0")->AndLogic()
		->Equal("plc.isdeleted", "0")->AndLogic()
		->Equal("lc.isdeleted", "0");
		if($MinDate!==null)
			$Query=$Query->AndLogic()->Bigger("post.adddate", $MinDate);
		if($IsPublished!==null)
		{
			if($IsPublished)
				$Query=$Query->AndLogic()->Equal("post.ispublished", 1);
			else
				$Query=$Query->AndLogic()->Equal("post.ispublished", 0);
		}
			$Query=$Query->AddOrderBy("post.id", !$OrderAscending);
			$Query=$Query->AddGroupBy("post.id");
		if($Limit!==null)
			$Query->setLimit($Limit);
//   		echo $Query->getQueryString();
//   		die();
		return $Query->ExecuteAssociated();

	}
}

?>