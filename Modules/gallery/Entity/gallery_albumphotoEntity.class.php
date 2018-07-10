<?php

namespace Modules\gallery\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\selectQuery;
use core\CoreClasses\db\updateQuery;
use core\CoreClasses\db\insertQuery;


/**
 *@author Hadi AmirNahavandi
 *@CreationDate 2014/12/20 21:24:32
 *@LastUpdate 2014/12/20 21:24:32
 *@TableFields album_fid,photo_fid
*/


class gallery_albumphotoEntity extends EntityClass {
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
		$this->setTableName("gallery_albumphoto");
	}
	public function Insert($Album_fid,$Photo_fid)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("album_fid",$Album_fid)
		->Set("photo_fid",$Photo_fid)
		->Set("isdeleted", "0");
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		return $InsertedID;
	}
	public function Update($ID,$Album_fid,$Photo_fid)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("album_fid",$Album_fid)
		->NotNullSet("photo_fid",$Photo_fid)
		->Where()->Equal("isdeleted", "0")->AndLogic()->Equal("id",$ID);
		$this->UpdateQuery->Execute();
	}
	public function Delete($ID)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->Set("isdeleted","1")
		->Where()->Equal("isdeleted", "0")->AndLogic()->Equal("id",$ID);
		$this->UpdateQuery->Execute();
	}
	public function Select($ID,$Album_fid,$Photo_fid,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Album_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("album_fid",$Album_fid);
		if($Photo_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("photo_fid",$Photo_fid);
		for($i=0;$OrderByFields!==null && $i<count($OrderByFields);$i++)
			$this->SelectQuery=$this->SelectQuery->AddOrderBy($OrderByFields[$i], $IsDescendings[$i]);
		if($Limit!==null)
			$this->SelectQuery=$this->SelectQuery->setLimit($Limit);
		$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("isdeleted", "0");
		//echo $this->SelectQuery->getQueryString();
		//die();
		return $this->SelectQuery->ExecuteAssociated();
	}
}
?>
