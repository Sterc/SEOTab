StercSEO.grid.Items = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'stercseo-grid-items'
        ,cls: 'stercseo-grid'
        ,url: StercSEO.config.connector_url
        ,baseParams: {
            action: 'mgr/redirect/getlist'
            ,resource_id: MODx.request.id
            ,sort: 'id'
        }
        ,loaded: 0
        ,fields: ['id', 'url']
        ,emptyText : '<div class="empty-msg">'+_('stercseo.grid_noresults')+'</div>'
        ,autoHeight: true
        ,paging: true
        ,remoteSort: true
        ,forceFit: true
        ,enableColumnMove: false
        ,enableColumnResize: false
        ,enableColumnHide: false
        ,enableHdMenu: false
        ,columns: [{
            header: _('stercseo.uri_header')
            ,dataIndex: 'url'
            ,width: 700
            ,renderer: function(value){
                return value;
            }
        }]
        ,tbar: [{
            text: _('stercseo.uri_add')
            ,handler: this.createItem
            ,scope: this
        }]
    });
    StercSEO.grid.Items.superclass.constructor.call(this,config);
};
Ext.extend(StercSEO.grid.Items,MODx.grid.Grid,{
    windows: {}

    ,getMenu: function() {
        var m = [];
        m.push({
            text: _('remove')
            ,handler: this.removeItem
        });
        this.addContextMenuItem(m);
    }

    ,createItem: function(btn,e) {
        var id = this.id;

        this.windows.createItem = MODx.load({
            xtype: 'stercseo-window-item-create'
            ,listeners: {
                'success': {fn:function(r) {
                    var myRecord = Ext.data.Record.create([{
                        name: 'url',
                        type: 'string'
                    }]);

                    var newRecord = new myRecord({
                        url: r.a.result.object.url
                    });
                    var store = Ext.getCmp(id).getStore();
                    store.insert(store.getCount(), newRecord);
                    var JsonData = Ext.encode(Ext.pluck(store.data.items, 'data'));
                    Ext.getCmp('sterceseo-urls').setValue(JsonData);
                    MODx.fireResourceFormChange();

                },scope:this}
            }
        });

        this.windows.createItem.fp.getForm().reset();
        this.windows.createItem.show(e.target);
    }

    ,removeItem: function(btn,e) {
        var id = this.id;
        if (!this.menu.record) return false;

        var selectedId = this.menu.record.id;
        var selectedRow = this.getSelectionModel().getSelected();

        Ext.Msg.show({
            title: _('stercseo.uri_remove'),
            msg: _('stercseo.uri_remove_confirm'),
            buttons: Ext.Msg.YESNO,
            fn: function(btn){
                if (btn == 'yes') {
                    if (selectedId) {
                        Ext.Ajax.request({
                            url: StercSEO.config.connectorUrl,
                            params: {
                                action: 'mgr/redirect/remove'
                                , id: selectedId
                            }
                        });
                    }
                    var store = Ext.getCmp(id).getStore();
                    store.remove(selectedRow);
                    var JsonData = Ext.encode(Ext.pluck(store.data.items, 'data'));
                    Ext.getCmp('sterceseo-urls').setValue(JsonData);
                }
            },
            animEl: 'elId',
            icon: Ext.MessageBox.QUESTION
        });

        MODx.fireResourceFormChange();
    }
});
Ext.reg('stercseo-grid-items',StercSEO.grid.Items);

StercSEO.window.CreateItem = function(config) {
    config = config || {};
    this.ident = config.ident || 'stercseo-mecitem'+Ext.id();
    Ext.applyIf(config,{
        title: _('stercseo.item_create')
        ,id: this.ident
        ,modal:true
        ,height: 200
        ,width: 475
        ,url: StercSEO.config.connector_url
        ,baseParams: {
            action: 'mgr/url/return'
            ,id: MODx.request.id
        }
        ,labelAlign: 'left'
        ,labelWidth: 'auto'
        ,action: 'mgr/url/return'
        ,fields: [{
            xtype: 'textfield'
            ,fieldLabel: _('stercseo.uri_label')
            ,labelAlign: 'left'
            ,labelStyle: 'padding: 7px 0px; width: 100%;'
            ,name: 'url'
            ,id: this.ident + '-url'
            ,anchor: '100%'
            ,style: 'width: 98%;'
            ,stripCharsRe: /\s+/g
            ,allowBlank: false
            ,listeners: {
                afterrender: function(field) {
                    field.setValue(MODx.config.site_url);
                }
            }
        },{
            xtype: 'label'
            ,text: _('stercseo.uri_label_desc')
            ,cls: 'desc-under'
        }]
    });
    StercSEO.window.CreateItem.superclass.constructor.call(this,config);
};
Ext.extend(StercSEO.window.CreateItem,MODx.Window);
Ext.reg('stercseo-window-item-create',StercSEO.window.CreateItem);
