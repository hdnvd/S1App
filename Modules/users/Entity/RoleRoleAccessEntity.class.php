<?php

namespace Modules\users\Entity;

use core\CoreClasses\db\dbaccess;
use core\CoreClasses\db\DBField;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;

/**
 *
 * @author nahavandi
 *
 */
class RoleRoleAccessEntity extends EntityClass
{
    public function getRoleAccess($RoleID, $Module, $Page, $Action)
    {

        $DBAccessor=new dbaccess();
        $Database = new dbquery($DBAccessor);
        $Query = $Database->Select("*")->From(["role_systemroletask srt", 'role_systemtask st'])->Where()
            ->Equal('srt.systemtask_fid', new DBField('st.id', false))
            ->AndLogic()->Equal("module", $Module)->AndLogic()->Equal("page", $Page);
        $res = $Query->ExecuteAssociated();

        if (is_array($res) && count($res) > 0)//If A Record For this Module Page Exists
        {
            $Query = $Database->Select(["srt.systemrole_fid as roleid", 'st.module as module', 'st.page as page', 'st.action as action'])->From(["role_systemroletask srt", 'role_systemtask st'])
                ->Where()
                ->Equal('srt.systemtask_fid', new DBField('st.id', false))
                ->AndLogic()->Equal("module", $Module)->AndLogic()->Equal("page", $Page)
                ->AndLogic()->Equal("srt.systemrole_fid", $RoleID)
                ->AndLogic()->Equal("action", $Action);
            $res = $Query->ExecuteAssociated();
            $DBAccessor->close_connection();
            if (is_array($res) && count($res) > 0)
                return true;
            else
                return false;
        } else
            return true;
    }
}

?>