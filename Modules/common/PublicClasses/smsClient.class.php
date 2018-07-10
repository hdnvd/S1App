<?php
namespace Modules\common\PublicClasses;
class smsClient
{
	private $soapClientObj,$UserName,$Password,$From,$url;
  	public function __construct($UserName,$Password,$FromNumber)
  	{
  		$this->url="http://www.onlinepanel.ir/post/send.asmx?wsdl";
		$this->From=$FromNumber;
		$this->UserName=$UserName;
		$this->Password=$Password;
  	}
  	public function sendSms($To,$MessageText)
  	{
  		if(!is_array($To))
  			$To=array($To);
  	ini_set("soap.wsdl_cache_enabled", "0");
  	$status=array();
  try {
  	$recID=array(0);
  	$status=0x0;
$client = new \SoapClient($this->url);
 $parameters['username'] = $this->UserName;
    $parameters['password'] = $this->Password;
    $parameters['from'] = $this->From;
    $parameters['to'] = $To;
    $parameters['text'] =$MessageText;
    $parameters['isflash'] = false;
    $parameters['udh'] = "";
    $parameters['recId'] = &$recID;
    $parameters['status'] = &$status;
//$result=$client->GetCredit(array("username"=>"9367356253","password"=>"11472010"))->GetCreditResult;
$response=$client->SendSms($parameters);
return $recID;
return true;
 } catch (SoapFault $ex) {
    echo $ex->faultstring;
}
  	}
}

?>
