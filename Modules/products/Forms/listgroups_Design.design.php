<?php

namespace Modules\products\Forms;

use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\DataTable;
use core\CoreClasses\html\link;
use core\CoreClasses\html\elementGroup;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Lable;

/**
 *
 * @author nahavandi
 *        
 */
class listgroups_Design extends FormDesign {
	private $groups,$editlinks,$titles,$deletelinks;
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\services\FormDesign::getBodyHTML()
	 *
	 */
	public function getBodyHTML($command = "load") {
		
		
		for ($i=0;$i<count($this->groups);$i++)
		{
			$operations[$i]=new elementGroup();
			$edit[$i]=new link($this->editlinks[$i], "ویرایش");
			$delete[$i]=new link($this->deletelinks[$i], "حذف");
			$operations[$i]->addElement($edit[$i]);
			$operations[$i]->addElement($delete[$i]);
			$this->groups[$i]['operations']=$operations;
		}
		$table=new ListTable("3");
		$table->addElement(new Lable("#"));
		$table->addElement(new Lable("عنوان"));
		$table->addElement(new Lable("عملیات"));
		for($i=0;$i<count($this->groups);$i++)
		{
			$table->addElement(new Lable(new Lable($i+1)));
			$table->addElement(new Lable($this->groups[$i]['title']));
			$table->addElement($operations[$i]);
		}
		return $table;
	}

	public function setGroups($groups)
	{
	    $this->groups = $groups;
	}

	public function setEditlinks($editlinks)
	{
	    $this->editlinks = $editlinks;
	}

	public function setTitles($titles)
	{
	    $this->titles = $titles;
	}

	public function setDeletelinks($deletelinks)
	{
	    $this->deletelinks = $deletelinks;
	}
}

?>