<?php

namespace Modules\products\EntityObjects;
use core\CoreClasses\services\EntityObject;

/**
 *
 * @author nahavandi
 *        
 */
class productGroupEO extends EntityObject {
	private $LatinName,$MotherGroup;
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
}

?>