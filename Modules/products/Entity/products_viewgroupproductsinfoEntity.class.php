<?php

namespace Modules\products\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\selectQuery;
use core\CoreClasses\db\updateQuery;
use core\CoreClasses\db\insertQuery;
use Modules\common\Entity\selectabaleEntity;


class products_viewgroupproductsinfoEntity extends selectabaleEntity {
	/**
	 * @var updateQuery
	 */
	private $UpdateQuery;
	/**
	 * @var selectQuery
	 */
	private $SelectQuery;
	/**
	 * @var insertQuery
	 */
	private $InsertQuery;
	public function __construct()
	{
		$this->setDatabase(new dbquery());
		$this->setTableName("products_viewgroupproductsinfo");
	}
	public function SelectByFields($ID,$Latinname,$Title,$Description,$Mainphoto,$Thumburl,$Visits,$Rank,$Ispublished,$Adddate,$Role_systemuser_fid,$Gtitle,$Gid,$Gmother_fid,$Language_fid,array $OrderByFields,array $IsDescendings)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Latinname!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("latinname",$Latinname);
		if($Title!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("title",$Title);
		if($Description!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("description",$Description);
		if($Mainphoto!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("mainphoto",$Mainphoto);
		if($Thumburl!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("thumburl",$Thumburl);
		if($Visits!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("visits",$Visits);
		if($Rank!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("rank",$Rank);
		if($Ispublished!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("ispublished",$Ispublished);
		if($Adddate!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("adddate",$Adddate);
		if($Role_systemuser_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("role_systemuser_fid",$Role_systemuser_fid);
		if($Gtitle!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("gtitle",$Gtitle);
		if($Gid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("gid",$Gid);
		if($Gmother_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("gmother_fid",$Gmother_fid);
		if($Language_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("language_fid",$Language_fid);
		for($i=0;$OrderByFields!==null && $i<count($OrderByFields);$i++)
			$this->SelectQuery=$this->SelectQuery->AddOrderBy($OrderByFields[$i], $IsDescendings[$i]);
		$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("isdeleted", "0");
		//echo $this->SelectQuery->getQueryString();
		//die();
		return $this->SelectQuery->ExecuteAssociated();
	}
}
?>
