<?php

namespace Modules\buysell\Entity;
use core\CoreClasses\db\DBField;
use core\CoreClasses\db\TableField;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\selectQuery;
use core\CoreClasses\db\updateQuery;
use core\CoreClasses\db\insertQuery;
use core\CoreClasses\db\dbaccess;


/**
 *@author Hadi AmirNahavandi
 *@CreationDate 1396/2/20 - 2017/05/10 00:23:57
 *@LastUpdate 1396/2/20 - 2017/05/10 00:23:57
 *@TableName component
 *@TableFields title t,price t,usestatus t,role_systemuser_fid t,country_fid t,componentgroup_fid t,adddate t,details t,expiredate t,carmodel_fid t
 *@SweetFrameworkHelperVersion 1.112
 *@TableCreationSQL

CREATE TABLE IF NOT EXISTS sweetp_buysell_component (
`id` int(11) NOT NULL AUTO_INCREMENT,
`title` text NOT NULL,
`price` text NOT NULL,
`usestatus` text NOT NULL,
`role_systemuser_fid` text NOT NULL,
`country_fid` text NOT NULL,
`componentgroup_fid` text NOT NULL,
`adddate` text NOT NULL,
`details` text NOT NULL,
`expiredate` text NOT NULL,
`carmodel_fid` text NOT NULL,
`deletetime` text NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
 */


class buysell_componentEntity extends EntityClass {
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
        $this->setTableName("buysell_component");
    }
    public function Insert($Title,$Price,$Usestatus,$Role_systemuser_fid,$Country_fid,$Componentgroup_fid,$Adddate,$Details,$Expiredate)
    {
        $this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
            ->Set("title",$Title)
            ->Set("price",$Price)
            ->Set("usestatus",$Usestatus)
            ->Set("role_systemuser_fid",$Role_systemuser_fid)
            ->Set("country_fid",$Country_fid)
            ->Set("componentgroup_fid",$Componentgroup_fid)
            ->Set("adddate",$Adddate)
            ->Set("details",$Details)
            ->Set("expiredate",$Expiredate)
            ->Set("deletetime", "-1");
        //echo $this->InsertQuery->getQueryString();
        //die();
        $this->InsertQuery->Execute();
        $InsertedID=$this->InsertQuery->getInsertedId();
        return $InsertedID;
    }
    public function Update($ID,$Title,$Price,$Usestatus,$Role_systemuser_fid,$Country_fid,$Componentgroup_fid,$Adddate,$Details,$Expiredate)
    {
        $this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
            ->NotNullSet("title",$Title)
            ->NotNullSet("price",$Price)
            ->NotNullSet("usestatus",$Usestatus)
            ->NotNullSet("role_systemuser_fid",$Role_systemuser_fid)
            ->NotNullSet("country_fid",$Country_fid)
            ->NotNullSet("componentgroup_fid",$Componentgroup_fid)
            ->NotNullSet("adddate",$Adddate)
            ->NotNullSet("details",$Details)
            ->NotNullSet("expiredate",$Expiredate)
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
    public function Select($ID,$Title,$MinPrice,$MaxPrice,$Usestatus,$Role_systemuser_fid,$Country_fid,$Componentgroup_fid,$Adddate,$Details,$Expiredate,array $OrderByFields,array $IsDescendings,$Limit)
    {
        $this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
        if($ID!==null)
            $this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
        if($Title!==null)
            $this->SelectQuery=$this->SelectQuery->AndLogic()->Like("title",$Title);
        if($MinPrice!==null)
            $this->SelectQuery=$this->SelectQuery->AndLogic()->Bigger("price",$MinPrice);
        if($MaxPrice!==null)
            $this->SelectQuery=$this->SelectQuery->AndLogic()->Smaller("price",$MaxPrice);
        if($Usestatus!==null)
            $this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("usestatus",$Usestatus);
        if($Role_systemuser_fid!==null)
            $this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("role_systemuser_fid",$Role_systemuser_fid);
        if($Country_fid!==null)
            $this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("country_fid",$Country_fid);
        if($Componentgroup_fid!==null)
            $this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("componentgroup_fid",$Componentgroup_fid);
        if($Adddate!==null)
            $this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("adddate",$Adddate);
        if($Details!==null)
            $this->SelectQuery=$this->SelectQuery->AndLogic()->Like("details",$Details);
        if($Expiredate!==null)
            $this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("expiredate",$Expiredate);
        for($i=0;$OrderByFields!==null && $i<count($OrderByFields);$i++)
            $this->SelectQuery=$this->SelectQuery->AddOrderBy($OrderByFields[$i], $IsDescendings[$i]);
        if($Limit!==null)
            $this->SelectQuery=$this->SelectQuery->setLimit($Limit);
        $this->SelectQuery=$this->SelectQuery->AndLogic()->Smaller("deletetime", "0");
        //echo $this->SelectQuery->getQueryString();
        //die();
        return $this->SelectQuery->ExecuteAssociated();
    }
    public function FullSelect($ID,$Title,$MinPrice,$MaxPrice,$Usestatus,$Role_systemuser_fid,$Country_fid,$Componentgroup_fid,$MinAddDate,$Details,$Expiredate,$Carmodel_fid,$Province_fid,$CarGroupID,array $OrderByFields,array $IsDescendings,$Limit)
    {
        $this->SelectQuery=$this->getDatabase()->Select(array("co.*","ci.title city"))->From(array($this->getTableName() . " co" ,"buysell_user u","common_city ci","buysell_carmodel cm","buysell_componentcarmodel cocm"))->Where()->Equal(new DBField("co.role_systemuser_fid",false),new DBField("u.id",false))->AndLogic()->Equal(new DBField("u.common_city_fid",false),new DBField("ci.id",false));
        $this->SelectQuery=$this->SelectQuery->AndLogic()->Equal(new DBField("cocm.component_fid",false),new DBField("co.id",false));
        $this->SelectQuery=$this->SelectQuery->AndLogic()->Equal(new DBField("cocm.carmodel_fid",false),new DBField("cm.id",false));
        if($CarGroupID!==null)
            $this->SelectQuery=$this->SelectQuery->AndLogic()->Equal(new DBField("cm.cargroup_fid",false),$CarGroupID);
        if($Province_fid!==null && $Province_fid>0)
            $this->SelectQuery=$this->SelectQuery->AndLogic()->Equal(new DBField("ci.province_fid",false),$Province_fid);
        if($ID!==null && $ID>0)
            $this->SelectQuery=$this->SelectQuery->AndLogic()->Equal(new DBField("co.id",false),$ID);
        if($Title!==null)
            $this->SelectQuery=$this->SelectQuery->AndLogic()->Like(new DBField("co.title",false),$Title);
        if($MinPrice!==null)
            $this->SelectQuery=$this->SelectQuery->AndLogic()->Bigger("price",$MinPrice);
        if($MaxPrice!==null)
            $this->SelectQuery=$this->SelectQuery->AndLogic()->Smaller("price",$MaxPrice);
        if($Usestatus!==null && $Usestatus>0)
            $this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("usestatus",$Usestatus);
        if($Role_systemuser_fid!==null && $Role_systemuser_fid>0)
            $this->SelectQuery=$this->SelectQuery->AndLogic()->Equal(new DBField("co.role_systemuser_fid",false),$Role_systemuser_fid);
        if($Country_fid!==null && $Country_fid>0)
            $this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("country_fid",$Country_fid);
        if($Componentgroup_fid!==null && $Componentgroup_fid>0)
            $this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("componentgroup_fid",$Componentgroup_fid);
        if($MinAddDate!==null)
            $this->SelectQuery=$this->SelectQuery->AndLogic()->Bigger("adddate",$MinAddDate);
        if($Details!==null)
            $this->SelectQuery=$this->SelectQuery->AndLogic()->Like("details",$Details);
        if($Expiredate!==null)
            $this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("expiredate",$Expiredate);
        if($Carmodel_fid!==null && $Carmodel_fid>0)
            $this->SelectQuery=$this->SelectQuery->AndLogic()->Equal(new DBField("cocm.carmodel_fid",false),$Carmodel_fid);
        for($i=0;$OrderByFields!==null && $i<count($OrderByFields);$i++)
            $this->SelectQuery=$this->SelectQuery->AddOrderBy($OrderByFields[$i], $IsDescendings[$i]);
        if($Limit!==null)
            $this->SelectQuery=$this->SelectQuery->setLimit($Limit);

        $this->SelectQuery=$this->SelectQuery->AndLogic()->Smaller(new DBField("co.deletetime",false), "0");
        $this->SelectQuery=$this->SelectQuery->AddGroupBy(new DBField("co.id",false));
//        echo $this->SelectQuery->getQueryString();
//        die();
        return $this->SelectQuery->ExecuteAssociated();
    }
}
?>
