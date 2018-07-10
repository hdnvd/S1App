<?php

namespace Modules\common\PublicClasses;

use core\CoreClasses\Exception\SweetValidator;
use Modules\common\Controllers\Validator_Controller;
/**
 *
 * @author nahavandi
 *        
 */
class Validator {
	private $Regex,$Max,$Min,$IsRequired,$IsNumeric;
	public function __construct($ValidationRoleID)
	{
		$Ctl=new Validator_Controller();
		$Fields=$Ctl->load($ValidationRoleID);
		$this->Regex=$Fields[0]['regex'];
		$this->Max=$Fields[0]['max'];
		$this->Min=$Fields[0]['min'];
		$this->IsRequired=$Fields[0]['isrequired'];
		$this->IsNumeric=$Fields[0]['isnumeric'];
	}
	public static function Validate($Parameter,$ValidationRoleID)
	{
		$Parameter=trim($Parameter);
		$Ctl=new Validator_Controller();
		$Fields=$Ctl->load($ValidationRoleID);
		if(count($Fields>0))
			if(!$Fields[0]['isrequired'] && count($Parameter)==0)
				return SweetValidator::MATCHED;
			else
			{
				$Validator=new SweetValidator();
				return $Validator->Validate($Parameter,"/". $Fields[0]['regex'] . "/", $Fields[0]['isnumeric'], $Fields[0]['min'], $Fields[0]['max']);
			}
		return false;
	}
	
	public static  function getAllValidators()
	{
		$Ctl=new Validator_Controller();
		$Fields=$Ctl->loadAll();
		return $Fields;
	}

	public function getRegex()
	{
	    return $this->Regex;
	}

	public function getMax()
	{
	    return $this->Max;
	}

	public function getMin()
	{
	    return $this->Min;
	}

	public function getIsRequired()
	{
	    return $this->IsRequired;
	}

	public function getIsNumeric()
	{
	    return $this->IsNumeric;
	}
}

?>