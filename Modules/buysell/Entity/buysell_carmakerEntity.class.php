<?php

namespace Modules\buysell\Entity;
use core\CoreClasses\db\DBField;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\selectQuery;
use core\CoreClasses\db\updateQuery;
use core\CoreClasses\db\insertQuery;
use core\CoreClasses\db\dbaccess;


/**
 *@author Hadi AmirNahavandi
 *@CreationDate 1395/11/25 - 2017/02/13 12:11:45
 *@LastUpdate 1395/11/25 - 2017/02/13 12:11:45
 *@TableName carmaker
 *@TableFields latintitle t,title t,logo t
 *@SweetFrameworkHelperVersion 1.112
 *@TableCreationSQL
 
CREATE TABLE IF NOT EXISTS sweetp_buysell_carmaker (
`id` int(11) NOT NULL AUTO_INCREMENT,
`latintitle` text NOT NULL,
`title` text NOT NULL,
`logo` text NOT NULL,
`deletetime` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/


class buysell_carmakerEntity extends EntityClass {
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
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("buysell_carmaker");
	}
    public function FindAll(QueryLogic $QueryObject)
    {
        $SelectQuery=$this->getDatabase()->Select( new DBField($this->getTableName().".*",true))->From([$this->getTableName(),'buysell_carmodel cm'])->Where()->Equal("cm.carmaker_fid",new DBField($this->getTableName() . '.id',true));
        $this->setSelectQuery($SelectQuery);
        $this->fillSelectParams($QueryObject);

        $SelectQuery=$this->getSelectQuery();
        $SelectQuery->AddGroupBy(new DBField($this->getTableName(). ".id",true));
//        echo $SelectQuery->getQueryString() . "\n";
//        die();
        $results= $SelectQuery->ExecuteAssociated();
        $Objects=array();
        for($i=0;$i<count($results);$i++)
        {
            $class=get_class($this);
            $Objects[$i]=new $class($this->getDatabase()->getDBAccessor(),$this->getTableName());
            $Objects[$i]->loadFromArray($results[$i]);

        }
        return $Objects;
    }
	public function Insert($Latintitle,$Title,$Logo)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("latintitle",$Latintitle)
		->Set("title",$Title)
		->Set("logo",$Logo)
		->Set("deletetime", "-1");
		//echo $this->InsertQuery->getQueryString();
		//die();
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		return $InsertedID;
	}
	public function Update($ID,$Latintitle,$Title,$Logo)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("latintitle",$Latintitle)
		->NotNullSet("title",$Title)
		->NotNullSet("logo",$Logo)
		->Where()->Smaller("deletetime", "0")->AndLogic()->Equal("id",$ID);
		//echo $this->UpdateQuery->getQueryString();
		//die();
		$this->UpdateQuery->Execute();
	}
	public function Delete($ID)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->Set("deletetime", time())
		->Where()->Smaller("deletetime", "0")->AndLogic()->Equal("id",$ID);
		//echo $this->UpdateQuery->getQueryString();
		//die();
		$this->UpdateQuery->Execute();
	}
	public function Select($ID,$Latintitle,$Title,$Logo,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Latintitle!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("latintitle",$Latintitle);
		if($Title!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("title",$Title);
		if($Logo!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("logo",$Logo);
		for($i=0;$OrderByFields!==null && $i<count($OrderByFields);$i++)
			$this->SelectQuery=$this->SelectQuery->AddOrderBy($OrderByFields[$i], $IsDescendings[$i]);
		if($Limit!==null)
			$this->SelectQuery=$this->SelectQuery->setLimit($Limit);
		$this->SelectQuery=$this->SelectQuery->AndLogic()->Smaller("deletetime", "0");
		//echo $this->SelectQuery->getQueryString();
		//die();
		return $this->SelectQuery->ExecuteAssociated();
	}
}
?>
