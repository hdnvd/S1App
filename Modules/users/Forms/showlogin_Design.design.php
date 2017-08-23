<?php
/*
 *@Author:Hadi AmirNahavandi
*@Last Update:2014/5/08
*/
namespace Modules\users\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\paragraph;
use core\CoreClasses\html\Div;
								class showlogin_Design extends FormDesign
	{
		private $message,$messageType;
		public function setMessage($message)
		{
			$this->message=$message;
		}
		public function getBodyHTML($command="load")
		{
			$page=new Div();
			$page->setClass("messagepage");
			$l1=new Lable($this->message);
			if($this->messageType=="normal" || is_null($this->messageType))
				$l1->setClass("normalmessage");
			elseif($this->messageType=="error")
				$l1->setClass("errormessage");
				$l1->setHtmlContent(false);
			$page->addElement($l1);
			return $page;
		}
	
			/**
			 * @param string $messageType:normal,error,alert,info
			 */
			public function setMessageType($messageType)
			{
			    $this->messageType = $messageType;
			}
}
?>
 
