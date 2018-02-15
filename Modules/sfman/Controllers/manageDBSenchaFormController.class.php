<?php

namespace Modules\sfman\Controllers;

use core\CoreClasses\html\CheckBox;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\SweetDate;
use Modules\common\PublicClasses\AppDate;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\sfman\Entity\sfman_formelementEntity;
use Modules\sfman\Entity\sfman_formelementtypeEntity;
use Modules\sfman\Entity\sfman_formEntity;
use Modules\sfman\Entity\sfman_moduleEntity;
use Modules\sfman\Entity\sfman_tableEntity;


/**
 * @author Hadi AmirNahavandi
 * @creationDate 1395/10/9 - 2016/12/29 19:36:38
 * @lastUpdate 1395/10/9 - 2016/12/29 19:36:38
 * @SweetFrameworkHelperVersion 1.112
 */
abstract class manageDBSenchaFormController extends manageDBAndroidCodeController
{


    protected function makeSenchaListController($formInfo)
    {

        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FormNames = $FormName . "s";
        $ModuleNames = $ModuleName . "s";
        $C = "Ext.define('MyApp.view.$ModuleName.$FormNames.Manage$FormNames" . "Controller', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.manage$FormNames'
});
";

        $DesignFile = $this->getSenchaCodeModuleDir() . "/classic/src/view/" . $ModuleName . "/$FormNames/Manage" . $FormName . "sController.js";
        $this->SaveFile($DesignFile, $C);
    }

    protected function makeSenchaListModel($formInfo)
    {

        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FormNames = $FormName . "s";
        $ModuleNames = $ModuleName . "s";
        $FormNameList = $FormName . "List";
        $C = "Ext.define('MyApp.view.$ModuleName.$FormNames.Manage$FormNames" . "Model', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.manage$FormNames',

    requires: [
        'Ext.data.Store',
        'Ext.data.proxy.Memory',
        'Ext.data.field.Integer',
        'Ext.data.field.String',
        'Ext.data.field.Date',
        'Ext.data.field.Boolean',
        'Ext.data.reader.Json'
    ],

    stores: {
        allResults: {
            type: '$FormNames'
        },

        $FormNameList: {
            type: '$FormNames'
        },

    }
});

";

        $DesignFile = $this->getSenchaCodeModuleDir() . "/classic/src/view/" . $ModuleName . "/$FormNames/Manage" . $FormName . "sModel.js";
        $this->SaveFile($DesignFile, $C);
    }

    protected function makeSenchaListView($formInfo)
    {

        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FormNames = $FormName . "s";
        $FormNameList = $FormName . "List";
        $ModuleNames = $ModuleName . "s";
        $C = "Ext.define('MyApp.view.$ModuleName.$FormNames.Manage$FormNames', {
    extend: 'Ext.tab.Panel',
    xtype: 'manage$FormNames',

    requires: [
        'Ext.grid.Panel',
        'Ext.toolbar.Paging',
        'Ext.grid.column.Date'
    ],

    viewModel: {
        type:'manage$FormNames'
},
    controller: 'manage$FormNames',
    cls: 'shadow',
    activeTab: 0,
    margin: 20,

    items: [
        {
            xtype: 'gridpanel',
            cls: '$FormName-grid',
            title: 'فهرست ',
            routeId: '$FormName',
            bind: '{$FormNameList}',
            scrollable: false,
            columns: [
                {
                    xtype: 'gridcolumn',
                    width: 40,
                    dataIndex: 'identifier',
                    text: '#'
                },
                {
                    xtype: 'gridcolumn',
                    cls: 'content-column',
                    dataIndex: 'title',
                    text: 'عنوان',
                    flex: 1
                },
                {
                    xtype: 'actioncolumn',
                    items: [
                        {
                            xtype: 'button',
                            iconCls: 'x-fa fa-pencil',
                            handler:function(){location.href = '#manage$FormName'}
                        },
                        {
                            xtype: 'button',
                            iconCls: 'x-fa fa-close'
                        },
                        {
                            xtype: 'button',
                            iconCls: 'x-fa fa-ban'
                        }
                    ],

                    cls: 'content-column',
                    width: 120,
                    dataIndex: 'bool',
                    text: 'عملیات',
                    tooltip: 'edit '
                }
            ],
            dockedItems: [
                {
                    xtype: 'pagingtoolbar',
                    dock: 'bottom',
                    itemId: '$FormName" . "PaginationToolbar',
                    displayInfo: true,
                    bind: '{$FormNameList}'
                }
            ]
        },

    ]
});";

        $DesignFile = $this->getSenchaCodeModuleDir() . "/classic/src/view/" . $ModuleName . "/$FormNames/Manage" . $FormName . "s.js";
        $this->SaveFile($DesignFile, $C);
    }

    protected function makeSenchaListDataModel($formInfo)
    {

        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FormNames = $FormName . "s";
        $UFormNames = ucfirst($FormNames);
        $ModuleNames = $ModuleName . "s";
        $ModelCode = "Ext.define('MyApp.model.$ModuleName.$UFormNames', {
    extend: 'MyApp.model.Base',

    fields: [
        {
            type: 'int',
            name: 'identifier'
        },
        ";
        for ($i = 0; $i < count($this->getCurrentTableFields()); $i++) {
            if (FieldType::getFieldType($this->getCurrentTableFields()[$i]) != FieldType::$METAINF && FieldType::getFieldType($this->getCurrentTableFields()[$i]) != FieldType::$ID) {
                $UCField = $this->getCurrentTableFields()[$i];
                $UCField = trim(strtolower($UCField));
                    $ModelCode .= "\n{
            type: 'string',
            name: '$UCField'
        },";
            }
        }
        $ModelCode .= "
    ]
});
";
        $DesignFile = $this->getSenchaCodeModuleDir() . "/app/model/" . $ModuleName . "/" . ucfirst($FormName) . "s.js";
        $this->SaveFile($DesignFile, $ModelCode);
    }
    protected function makeSenchaListTestData($formInfo)
    {

        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FormNames = $FormName . "s";
        $UFormNames = ucfirst($FormNames);
        $ModuleNames = $ModuleName . "s";
        $ModelCode = "Ext.define('MyApp.data.$ModuleName.$UFormNames', {
    extend: 'MyApp.data.Simulated',

    data: [
        ";
        $ModelCode.="
        \n{";
        $ModelCode.="\n\"identifier\": 1,";
        for ($i = 0; $i < count($this->getCurrentTableFields()); $i++) {
            if (FieldType::getFieldType($this->getCurrentTableFields()[$i]) != FieldType::$METAINF && FieldType::getFieldType($this->getCurrentTableFields()[$i]) != FieldType::$ID) {
                $UCField = $this->getCurrentTableFields()[$i];
                $UCField = trim(strtolower($UCField));
                    $ModelCode .= "\n\"$UCField\": \"$UCField" . "TestData\",";
            }
        }
        $ModelCode.="
        \n},";
        $ModelCode .= "
    ]
});
";
        $DesignFile = $this->getSenchaCodeModuleDir() . "/app/data/" . $ModuleName . "/" . ucfirst($FormName) . "s.js";
        $this->SaveFile($DesignFile, $ModelCode);
    }

    protected function makeSenchaListStore($formInfo)
    {

        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FormNames = $FormName . "s";
        $UFormNames = ucfirst($FormNames);
        $ModuleNames = $ModuleName . "s";
        $C = "Ext.define('MyApp.store.$ModuleName.$UFormNames', {
        extend: 'Ext.data.Store',

    alias: 'store.$FormNames',

    model: 'MyApp.model.$ModuleName.$UFormNames',

    proxy: {
        type: 'api',
        url: '~api/$ModuleName/$FormNames'
    },

    autoLoad: 'true',

    sorters: {
        direction: 'ASC',
        property: 'identifier'
    }
});

";

        $DesignFile = $this->getSenchaCodeModuleDir() . "/app/store/" . $ModuleName . "/" . ucfirst($FormName) . "s.js";
        $this->SaveFile($DesignFile, $C);
    }

}

?>