<?php

namespace Modules\common\PublicClasses;

use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Rooter\RooterLink;
use core\CoreClasses\services\ResponseMode;

/**
 *
 * @author nahavandi
 *        
 */
class AppRooter extends RooterLink {
	private $Module,$Page,$Language,$Parameters,$ResponseMode=ResponseMode::HTML,$FileFormat,$AdditionalPath,$appendToCurrentParams;

	public static function redirect($URL,$Time=0)
	{
		$script="<script lang='javascript'>setTimeout(function(){
			window.location.replace(\"" . $URL . "\");},$Time);
			</script>";
		echo $script;
	}
	private static function getLink($Module,$Page,$Language=null,array $Parameters=null,$ResponseMode=ResponseMode::HTML,$IsAbsolute=true,$FileFormat=".jsp",$AddtionalPath="")
	{
		$link="";
		if($Language===null)
			$Language=CurrentLanguageManager::getCurrentLanguageName();
		
		if($Language!=="")
		    $link="$Language";
		if($Module!==null)
		    $link.="/$Module";
		if($Page!==null)
		    $link.="/$Page";
		if($FileFormat!==null)
		    $link.=$FileFormat;
		if($AddtionalPath!==null)
		    $link.=$AddtionalPath;
		if($ResponseMode==ResponseMode::AJAX)
				$link="ajax/" . $link;
		if(!is_null($Parameters))
		{
			if(count($Parameters)>0)
				$link.="?";
			for($i=0;$i<count($Parameters);$i++)
			{
				if($i>0)
					$link.="&";
                $link.=$Parameters[$i]->getField() ;
				if($Parameters[$i]->getValue()!=null)
                    $link.= "=" . $Parameters[$i]->getValue();
			}
		}
		if($IsAbsolute)
			$link=DEFAULT_APPURL . $link;
		else 
			$link="/". $link;
		return $link;
		
	}
	private function addCurrentParameters()
	{
		$items=array_keys($_GET);
		for($i=0;$i<count($items);$i++)
		    if($items[$i]!="language" && $items[$i]!="module" && $items[$i]!="page")
			    $this->addParameter(new UrlParameter($items[$i],$_GET[$items[$i]]));
	}
	public function __construct($Module,$Page)
	{
		$this->FileFormat=".jsp";
		$this->setAdditionalPath("");
		$this->setModule($Module);
		$this->setPage($Page);
		$this->Parameters=array();
		$this->Language=CurrentLanguageManager::getCurrentLanguageName();
	}
    /**
     * @param mixed $appendToCurrentParams
     */
    public function setAppendToCurrentParams($appendToCurrentParams)
    {
        $this->appendToCurrentParams = $appendToCurrentParams;
    }
	public function getAbsoluteURL()
	{
        if($this->appendToCurrentParams)
            $this->addCurrentParameters();
		return $this->getLink($this->Module, $this->Page,$this->Language,$this->Parameters,$this->ResponseMode,true,$this->FileFormat,$this->AdditionalPath);
	}
	public function getRelativeURL()
	{
		return $this->getLink($this->Module, $this->Page,$this->Language,$this->Parameters,$this->ResponseMode,false,$this->FileFormat,$this->AdditionalPath);
	}
	public function getModule()
	{
	    return $this->Module;
	}

	public function setModule($Module)
	{
	    $this->Module = $Module;
	}

	public function getPage()
	{
	    return $this->Page;
	}

	public function setPage($Page)
	{
	    $this->Page = $Page;
	}

	public function getLanguage()
	{
	    return $this->Language;
	}

	public function setLanguage($Language)
	{
	    $this->Language = $Language;
	}
	public function addParameter(UrlParameter $Parameter)
	{
		
		array_push($this->Parameters,$Parameter);
	}
	public function setParameters(array $Parameters)
	{
	    $this->Parameters = $Parameters;
	}
	/**
	 * @param UrlParameter $Parameter
	 * 
	 */
	public function setParameter(UrlParameter $Parameter)
	{
		$found=false;
		foreach ($this->Parameters as &$TheParam)
			if($Parameter->getField()==$TheParam->getField())
			{
				$found=true;
				$TheParam->setValue($Parameter->getValue());
			}
		if(!$found)
			$this->addParameter($Parameter);
	}

	public function getResponseMode()
	{
	    return $this->ResponseMode;
	}

	public function setResponseMode($ResponseMode)
	{
	    $this->ResponseMode = $ResponseMode;
	}

	public function setFileFormat($FileFormat)
	{
	    $this->FileFormat = $FileFormat;
	}

	public function setAdditionalPath($AdditionalPath)
	{
	    $this->AdditionalPath = $AdditionalPath;
	}
}
class UrlParameter
{
	private $Field,$value;
	public function __construct($Field,$Value)
	{
		$this->setField($Field);
		$this->setValue($Value);
	}
	public function getField()
	{
	    return $this->Field;
	}

	public function setField($field)
	{
	    $this->Field = $field;
	}

	public function getValue()
	{
	    return $this->value;
	}

	public function setValue($value)
	{
	    $this->value = $value;
	}
	
}
?>
