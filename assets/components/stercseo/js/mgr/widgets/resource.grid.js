StercSEO.grid.Items = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'stercseo-grid-items'
        ,cls: 'stercseo-grid'
        ,url: StercSEO.config.connector_url
        ,baseParams: {
            action: 'mgr/url/getlist'
            ,id: MODx.request.id
        }
        ,loaded: 0
        ,fields: ['url']
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
                return MODx.config.site_url+value;
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

                Ext.getCmp(id).getStore().insert(0, newRecord);

                var JsonData = Ext.encode(Ext.pluck(Ext.getCmp(id).getStore().data.items, 'data'));
                Ext.getCmp('sterceseo-urls').setValue(JsonData);

                MODx.fireResourceFormChange();

            },scope:this}
        }
        });

        this.windows.createItem.fp.getForm().reset();
        this.windows.createItem.show(e.target);
    }
    // ,updateItem: function(btn,e) {
    //     if (!this.menu.record || !this.menu.record.id) return false;
    //     var r = this.menu.record;

    //     if (!this.windows.updateItem) {
    //         this.windows.updateItem = MODx.load({
    //             xtype: 'stercseo-window-item-update'
    //             ,record: r
    //             ,listeners: {
    //                 'success': {fn:function() { this.refresh(); },scope:this}
    //             }
    //         });
    //     }
    //     this.windows.updateItem.fp.getForm().reset();
    //     this.windows.updateItem.fp.getForm().setValues(r);
    //     this.windows.updateItem.show(e.target);
    // }

    ,removeItem: function(btn,e) {
        var id = this.id;
        if (!this.menu.record) return false;

        var selected = Ext.getCmp(id).getSelectionModel().getSelections();

            if(selected.length>0) {
                for(var i=0;i<selected.length;i++) {
                    Ext.getCmp(id).getStore().remove(selected[i]);
                }
            }

            var JsonData = Ext.encode(Ext.pluck(Ext.getCmp(id).getStore().data.items, 'data'));
            Ext.getCmp('sterceseo-urls').setValue(JsonData);

                MODx.fireResourceFormChange();

        return;
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
        ,height: 150
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
            ,fieldLabel: MODx.config.site_url
            ,labelAlign: 'left'
            ,labelStyle: 'padding: 7px 0px; width: auto;'
            ,name: 'url'
            ,id: this.ident+'-url'
            ,anchor: '100%'
            ,style: 'margin-left:2px;'
            ,stripCharsRe: /\s+/g
            ,allowBlank: false
        }]
    });
    StercSEO.window.CreateItem.superclass.constructor.call(this,config);
};
Ext.extend(StercSEO.window.CreateItem,MODx.Window);
Ext.reg('stercseo-window-item-create',StercSEO.window.CreateItem);
