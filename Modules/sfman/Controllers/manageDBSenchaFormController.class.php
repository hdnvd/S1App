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


//    private $SiteURL='http://iflaravel.test';
    private $SiteURL='http://ifinance.sweetsoft.ir';
    protected function makeSenchaListController($formInfo)
    {

        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FormNames = $FormName . "s";
        $UFormNames =ucfirst($FormNames);
        $UFormName =ucfirst($FormName);
        $ModuleNames = $ModuleName . "s";
        $C = "var Action='';\n
        Ext.define('MyApp.view.$ModuleName.$FormNames.Manage$FormNames" . "Controller', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.manage$FormNames',
    onEdit:function(){
            Action='edit';
    },
    onDelete:function(){
        Action='delete';
    },
    onRowClick:function(view, td, cellIndex, record){
        if(Action=='edit')
        {
            this.setCurrentView('widget.manage$FormName', {record: record});
            Action='';
        }
        else if(Action=='delete')
        {
            MyApp.model.$ModuleName.$UFormNames.load(record.data.id,{success:function () {
                this.erase();
            }});
            Action='';
        }
    },
    setCurrentView: function(view, params) {
        var recorditem=params['record'];
        var contentPanel = this.getView('viewport');
        contentPanel.removeAll();
        var Panel=Ext.create(view);
        Panel.setRecord(recorditem);
        // Panel.getForm().findField('title').setFieldLabel('عنوان');
        contentPanel.add(Panel);
    },
});
";

        $DesignFile = $this->getSenchaCodeModuleDir() . "/classic/src/view/" . $ModuleName . "/$FormNames/Manage" . $FormName . "sController.js";
        $this->SaveFile($DesignFile, $C);
    }
    protected function makeSenchaItemController($formInfo)
    {

        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FormNames = $FormName . "s";
        $C = "Ext.define('MyApp.view.$ModuleName.$FormNames.Manage$FormName" . "Controller', {
    
    extend: 'Ext.app.ViewController',
    alias: 'controller.manage$FormName',
});

";

        $DesignFile = $this->getSenchaCodeModuleDir() . "/classic/src/view/" . $ModuleName . "/$FormNames/Manage" . $FormName . "Controller.js";
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
    protected function makeSenchaItemModel($formInfo)
    {

        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FormNames = $FormName . "s";
        $C = "Ext.define('MyApp.view.$ModuleName.$FormNames.Manage$FormName" . "Model', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.$FormName'
});
";

        $DesignFile = $this->getSenchaCodeModuleDir() . "/classic/src/view/" . $ModuleName . "/$FormNames/Manage" . $FormName . "Model.js";
        $this->SaveFile($DesignFile, $C);
    }


    protected function makeSenchaListView($formInfo)
    {

        $trans=new Translator();
        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $PersianFormName  = $trans->getPersian($FormName,$FormName);
        $FormNames = $FormName . "s";
        $FormNameList = $FormName . "List";
        $ModuleNames = $ModuleName . "s";
        $titleFiled=$this->getCurrentTableFields()[$this->getTitleFieldIndex()];
        $ptitleField=$trans->getPersian($titleFiled,$titleFiled);
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
            title: 'فهرست $PersianFormName',
            routeId: '$FormName',
            bind: '{" . $FormNameList . "}',
            scrollable: false,
            listeners: {
                cellclick: 'onRowClick',
            },
            columns: [
                {
                    xtype: 'gridcolumn',
                    width: 40,
                    dataIndex: 'id',
                    text: '#'
                },
                {
                    xtype: 'textfield',
                    cls: 'content-column',
                    dataIndex: 'id',
                    text: 'ID',
                    hidden: true,
                    flex: 2
                },
                {
                    xtype: 'gridcolumn',
                    cls: 'content-column',
                    dataIndex: '$titleFiled',
                    text: '$ptitleField',
                    flex: 1
                },
                {
                    xtype: 'actioncolumn',
                    items: [
                        {
                            xtype: 'button',
                            iconCls: 'x-fa fa-pencil',
                            handler: 'onEdit',
                        },
                        {
                            xtype: 'button',
                            iconCls: 'x-fa fa-close',
                            handler: 'onDelete',
                        },
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
                    bind: '{" . $FormNameList . "}'
                }
            ]
        },
        {
            xtype: 'manage$FormName',
            cls: 'bank-grid',
            title: 'تعریف $PersianFormName جدید',
            routeId: 'add$FormName',
            scrollable: false,
        },

    ]
});";

        $DesignFile = $this->getSenchaCodeModuleDir() . "/classic/src/view/" . $ModuleName . "/$FormNames/Manage" . $FormName . "s.js";
        $this->SaveFile($DesignFile, $C);
    }
    protected function makeSenchaItemView($formInfo)
    {

        $trans=new Translator();
        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $PFormName = $trans->getPersian($FormName,$FormName);
        $FormNames = $FormName . "s";
        $UCFormNames = ucfirst($FormNames);
        $C = "Ext.define('MyApp.view.$ModuleName.$FormNames.Manage$FormName', {
    extend: 'Ext.form.Panel',
    alias: 'widget.manage$FormName',
    requires: [
        'Ext.button.Button',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'Ext.form.field.File',
        'Ext.form.field.HtmlEditor'
    ],
    cls: 'manage$FormName',

    layout: {
        type:'vbox',
        align:'stretch'
    },

    bodyPadding: 10,
    scrollable: true,

    defaults: {
        labelWidth: 60,
        labelSeparator: ''
    },

    items: [
    
        {
            xtype: 'textfield',
            id: 'manage$FormName" ."_id',
            hidden:true,
        },
";

        for ($i = 0; $i < count($this->getCurrentTableFields()); $i++) {
            if (FieldType::getFieldType($this->getCurrentTableFields()[$i]) != FieldType::$METAINF && FieldType::getFieldType($this->getCurrentTableFields()[$i]) != FieldType::$ID) {
                $UCField = $this->getCurrentTableFields()[$i];
                $UCField = trim(strtolower($UCField));
                $PersianField = $trans->getPersian($UCField,$UCField);
                if (FieldType::getFieldType($this->getCurrentTableFields()[$i]) == FieldType::$FID) {
                    $Field=$this->getCurrentTableFields()[$i];
                    $FieldEntityName=substr($Field,0,strlen($Field)-4);
                    $PersianField = $trans->getPersian($FieldEntityName,$FieldEntityName);
                    $C .= "\n{
            xtype: 'combobox',
            fieldLabel: '$PersianField',
            displayField: 'title',
            id: 'manage$FormName" . "_$UCField',
            valueField: 'id',
            store:
                {
                    type:'$FieldEntityName" ."s',
                    autoLoad: true,
                },
        },";
                }
                else
                {

                    $C .= "\n{
            xtype: 'textfield',
            id: 'manage$FormName" . "_$UCField',
            fieldLabel: '$PersianField',
        },";
                }
            }
        }
        $C.="
        {
            xtype: 'button',
            text:  'ذخیره',
            handler:function()
            {
                var the$FormName=null;
                var itemID=Ext.getCmp('manage$FormName" . "_id').getValue();
                if(itemID>0)
                    the$FormName = MyApp.model.$ModuleName.$UCFormNames.load(itemID);
                else
                    the$FormName = Ext.create('MyApp.model.$ModuleName.$UCFormNames', {";
        $FieldSetCode="";
        $FieldLoadCode="";
        for ($i = 0; $i < count($this->getCurrentTableFields()); $i++) {
            if (FieldType::getFieldType($this->getCurrentTableFields()[$i]) != FieldType::$METAINF && FieldType::getFieldType($this->getCurrentTableFields()[$i]) != FieldType::$ID) {
                $UCField = $this->getCurrentTableFields()[$i];
                $Field = trim(strtolower($UCField));
                if($FieldSetCode!="")
                    $FieldSetCode.=",";
                $FieldSetCode .= "$Field: Ext.getCmp('manage$FormName" . "_$Field').getValue()";
                $FieldLoadCode .= "\nExt.getCmp('manage$FormName" . "_$Field').setValue(record.data.$Field);";
            }
        }
        $C.=$FieldSetCode."});
                the$FormName.save({
                    callback: function (records, operation) {
                        Ext.Msg.alert('اطلاعات با موفقیت ذخیره شد.', operation.getResponse().responseText);
                    },
                });

            }
        }
    ],
    setRecord: function(record) {
        var me = this;
        me._record = record;
        this.setData(record.data);
        $FieldLoadCode
        Ext.getCmp('manage$FormName" . "_id').setValue(record.data.id);
        return this;
    },
});
";

        $DesignFile = $this->getSenchaCodeModuleDir() . "/classic/src/view/" . $ModuleName . "/$FormNames/Manage" . $FormName . ".js";
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
            name: 'id'
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
    ],
    
    proxy: {
        type: 'rest',
        url : '".$this->SiteURL."/api/$ModuleName/$FormNames',
        paramsAsJson: false,
        useDefaultXhrHeader: false,
        writer:{
            writeAllFields: true,
        },
        actionMethods: {
            create: 'POST', //When you want to save/create new record
            read: 'GET', //When you want to get data from server side
            update: 'PUT', //When you want to update the record
            destroy: 'DELETE' //When you want to delete the record
        },
    },
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
        $ModelCode.="\n\"id\": 1,";
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
        $C = "Ext.define('MyApp.store.$ModuleName.$UFormNames', {
        extend: 'Ext.data.Store',

    alias: 'store.$FormNames',

    model: 'MyApp.model.$ModuleName.$UFormNames',

    /*proxy: {
        type: 'api',
        url: '~api/$ModuleName/$FormNames'
    },*/
    proxy: {
        type: 'rest',
        url : '".$this->SiteURL."/api/$ModuleName/$FormNames',
        paramsAsJson: false,
        useDefaultXhrHeader: false,
        actionMethods: {
            create: 'POST', //When you want to save/create new record
            read: 'GET', //When you want to get data from server side
            update: 'PUT', //When you want to update the record
            destroy: 'DELETE' //When you want to delete the record
        },
    },
    autoLoad: 'true',

    sorters: {
        direction: 'ASC',
        property: 'id'
    }
});

";

        $DesignFile = $this->getSenchaCodeModuleDir() . "/app/store/" . $ModuleName . "/" . ucfirst($FormName) . "s.js";
        $this->SaveFile($DesignFile, $C);
    }

}

?>