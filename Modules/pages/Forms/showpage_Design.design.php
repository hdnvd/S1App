<?php
namespace Modules\pages\Forms;
use \core\CoreClasses\services;
use \core\CoreClasses\services\FormDesign;
use \core\CoreClasses\html\elementGroup;
use \core\CoreClasses\html\paragraph;
use \core\CoreClasses\html\TextBox;
use \core\CoreClasses\html\DataComboBox;
use \core\CoreClasses\html\Button;
use \core\CoreClasses\html\form;
use \core\CoreClasses\html\TextArea;
use \core\CoreClasses\html\DataTable;
use \core\CoreClasses\html\Image;
use \core\CoreClasses\html\htmlcode;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\link;
	class showpage_Design extends FormDesign
	{
		private $lblname;
		private $lbltitle;
		private $lblcontent;
		private $lbltags;
		public function setLblname($lblname)
		{
			$this->lblname=$lblname;
		}
		public function setLbltitle($lbltitle)
		{
			$this->lbltitle=$lbltitle;
		}
		public function setLblcontent($lblcontent)
		{
			$this->lblcontent=$lblcontent;
		}
		public function setLbltags($lbltags)
		{
			$this->lbltags=$lbltags;
		}
		public function setBtnsave($btnsave)
		{
			$this->btnsave=$btnsave;
		}
		public function getBodyHTML($command=null)
		{

			$listTable=new ListTable(1);
			$lbltitle=new paragraph($this->lbltitle,"lbltitle","lbltitle");
// 			$listTable->addElement($lbltitle);
			$lblcontent=new paragraph($this->lblcontent,"lblcontent","lblcontent");
			$listTable->addElement($lblcontent);
			for($i=0;$i<count($this->tags);$i++)
			{
				$link="?module=pages&page=listpages&tag=" . $this->tags[$i];
				$link=new link($link, $this->tags[$i]);
				$lbltags=new paragraph($link,"Show Contents Of Tag " . $this->tags[$i],"lbltags");
				$listTable->addElement($lbltags);
			}
			$lblThumb=new paragraph($this->lblthumb);
// 			$listTable->addElement($lblThumb);
			$PageContent=$listTable->getHTML();
			return $PageContent;
		}
	}
?>
 