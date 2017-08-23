<?php

namespace Modules\products\Entity;

use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;

/**
 *
 * @author Hadi Nahavandi
 * @version 0.1
 *        
 */
class ProductPhotoEntity extends EntityClass {
    public function __construct(dbaccess $DBAccessor=null)
    {
        $this->setDatabase(new dbquery($DBAccessor));
        $this->setTableName("productphoto");
    }
	public function addPhoto($photo,$photoTitle,$productID,$ProductPhotoNum)
	{
		$Database=new dbquery();
		$query=$Database->InsertInto("productphoto")
		->Set("url", $photo)
		->Set("title",$photoTitle)
		->Set("product_fid", $productID)
		->Set("productphotonum", $ProductPhotoNum)
		->Set("isdeleted", "0");
		$result=$query->Execute();
		return $result;
	}
	public function editPhoto($photoId,$photo,$photoTitle,$productID,$ProductPhotoNum)
	{
		$Database=new dbquery();
		$query=$Database->Update("productphoto")
		->Set("url", $photo)
		->Set("title",$photoTitle)
		->Where()->Equal("id", $photoId)->AndLogic()->Equal("isdeleted", "0");
		$result=$query->Execute();
		return $result;
	}
	public function editProductPhoto($ProductID,$ProductPhotoNum,$photo,$photoTitle)
	{
		$current=$this->getProductPhoto($ProductID, $ProductPhotoNum);
		if(!is_null($current))
		{
			$Database=new dbquery();
			$query=$Database->Update("productphoto")
			->Set("url", $photo)
			->Set("title",$photoTitle);
			$query->Where()->Equal("product_fid", $ProductID)->AndLogic()->Equal("productphotonum", $ProductPhotoNum)->AndLogic()->Equal("isdeleted", "0");
			$result=$query->Execute();
		}
		else 
		{
			$result=$this->addPhoto($photo, $photoTitle, $ProductID, $ProductPhotoNum);
		}
		return $result;
	}
	public function getProductPhotos($ProductID)
	{
		$Database=new dbquery();
		$query=$Database->Select("*")->From("productphoto")->Where()->Equal("product_fid", $ProductID)->AndLogic()->Equal("isdeleted", "0")->AddOrderBy("productphotonum", false);
		$result=$query->ExecuteAssociated();
		return $result;
	}
	public function Update($ID,$Title,$Url,$ProductID,$ProductPhotonum,$IsDeleted)
	{
		$Database=new dbquery();
		$Database->Update("productphoto")
		->NotNullSet("productphotonum", $ProductPhotonum)
		->NotNullSet("title", $Title)
		->NotNullSet("url", $Url)
		->NotNullSet("product_fid", $ProductID)
		->NotNullSet("isdeleted", $IsDeleted)
		->Where()->Equal("id", $ID)
		->Execute();
	}

	public function Select($ID,$Title,$Url,$ProductID,$ProductPhotonum,$Limit, $Orders,$IsDescendings)
	{
	    $Query=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("isdeleted", "0");
	    if($ID!==null)
	        $Query=$Query->AndLogic()->Equal("id", $ID);
	    if($Title!==null)
	        $Query=$Query->AndLogic()->Like("title", $Title);
	    if($Url!==null)
	        $Query=$Query->AndLogic()->Like("url", $Url);
	    if($ProductID!==null)
	        $Query=$Query->AndLogic()->Like("product_fid", $ProductID);
	    if($ProductPhotonum!==null)
	        $Query=$Query->AndLogic()->Like("productphotonum", $ProductPhotonum);
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
// 	    die($Query->getQueryString());
	    return $Query->ExecuteAssociated();
	}
	public function getProductPhoto($ProductID,$ProductPhotoNum)
	{
		$Database=new dbquery();
		$query=$Database->Select("*")->From("productphoto")->Where()->Equal("product_fid", $ProductID)->AndLogic()->Equal("productphotonum", $ProductPhotoNum)->AndLogic()->Equal("isdeleted", "0");
		$result=$query->ExecuteAssociated();
		return $result;
	}
}

?>