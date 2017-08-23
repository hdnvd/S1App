<?php

namespace Modules\products\BusinessObjects;

use core\CoreClasses\services\BusinessObject;

/**
 *
 * @author nahavandi
 *        
 */
class productGroupBO extends BusinessObject {
	private $LatinName,$MotherGroup,$GroupID,$Title;
	public function __construct($LatinName,$MotherGroup)
	{
		$this->LatinName=$LatinName;
		$this->MotherGroup=$MotherGroup;
	}
	public function getLatinName()
	{
	    return $this->LatinName;
	}

	public function setLatinName($LatinName)
	{
	    $this->LatinName = $LatinName;
	}

	public function getMotherGroup()
	{
	    return $this->MotherGroup;
	}

	public function setMotherGroup($MotherGroup)
	{
	    $this->MotherGroup = $MotherGroup;
	}

	public function getGroupID()
	{
	    return $this->GroupID;
	}

	public function setGroupID($GroupID)
	{
	    $this->GroupID = $GroupID;
	}

	public function getTitle()
	{
	    return $this->Title;
	}

	public function setTitle($Title)
	{
	    $this->Title = $Title;
	}
}

?>