StercSEO.grid.Redirects = function(config) {
    config = config || {};
    if (!config.id) {
        config.id = 'stercseo-grid-redirects';
    }
    Ext.applyIf(config,{
        id: config.id
        ,url: StercSEO.config.connectorUrl
        ,baseParams: {
            action: 'mgr/redirect/getlist'
        }
        ,save_action: 'mgr/redirect/updatefromgrid'
        ,autosave: true
        ,fields: ['id','resource','target','url','context_key']
        ,autoHeight: true
        ,paging: true
        ,remoteSort: true
        ,columns: [{
            header: _('id')
            ,dataIndex: 'id'
            ,width: 40
        },{
            header: _('stercseo.uri')
            ,dataIndex: 'url'
            ,width: 180
        },{
            header: _('stercseo.target')
            ,dataIndex: 'target'
            ,width: 240
        },{
            header: _('context')
            ,dataIndex: 'context_key'
            ,width: 180
        }]
        ,tbar: [{
            text: _('stercseo.uri_add')
            ,handler: this.createRedirect
            ,scope: this
            ,cls:'primary-button'
            ,id: 'btn-add-uri'
        },'->',{
            xtype: 'modx-combo-context'
            ,fieldLabel: _('context')
            ,name: 'context_key'
            ,hiddenName: 'context_key'
            ,id: config.id + '-context-filter'
            ,editable: false
            ,anchor: '100%'
            ,baseParams: {
                action: 'context/getlist'
                ,exclude: 'mgr'
            }
            ,listeners: {
                'select': {
                    fn:this.filter,scope: this
                }
            }
            ,emptyText: _('context')
        },{
            xtype: 'textfield'
            ,width: 180
            ,name: "query"
            ,id: config.id + '-search-field'
            ,emptyText: _('search') + '...'
            ,listeners: {
                'change': {
                    fn:this.filter, scope: this
                }
                ,'render': {fn: function(cmp) {
                    new Ext.KeyMap(cmp.getEl(), {
                        key: Ext.EventObject.ENTER
                        ,fn: function() {
                            this.fireEvent('change',this);
                            this.blur();
                            return true;
                        }
                        ,scope: cmp
                    });
                }, scope: this }
            }
        },{
            xtype: 'button',
            id: config.id + '-search-clear',
            text: '<i class="icon icon-times"></i>',
            listeners: {
                click: {
                    fn: this.clearFilter, scope: this
                }
            }  
        }]
    });
    StercSEO.grid.Redirects.superclass.constructor.call(this,config);
};
Ext.extend(StercSEO.grid.Redirects,MODx.grid.Grid,{
    windows: {}

    ,getMenu: function() {
        var m = [];
        m.push({
            text: _('stercseo.uri_update')
            ,handler: this.updateRedirect
        });
        m.push('-');
        m.push({
            text: _('stercseo.uri_remove')
            ,handler: this.removeRedirect
        });
        this.addContextMenuItem(m);
    }
    
    ,createRedirect: function(btn,e) {

        var createRedirect = MODx.load({
            xtype: 'stercseo-window-redirects'
            ,listeners: {
                'success': {fn:function() { this.refresh(); },scope:this}
            }
        });

        createRedirect.show(e.target);
    }

    ,updateRedirect: function(btn,e,isUpdate) {
        if (!this.menu.record || !this.menu.record.id) return false;

        var updateRedirect = MODx.load({
            xtype: 'stercseo-window-redirects'
            ,title: _('stercseo.uri_update')
            ,action: 'mgr/redirect/update'
            ,record: this.menu.record
            ,isUpdate: true
            ,listeners: {
                'success': {fn:function() { this.refresh(); },scope:this}
            }
        });

        updateRedirect.fp.getForm().reset();
        updateRedirect.fp.getForm().setValues(this.menu.record);
        updateRedirect.show(e.target);
    }
    
    ,removeRedirect: function(btn,e) {
        if (!this.menu.record) return false;
        
        MODx.msg.confirm({
            title: _('stercseo.uri_remove')
            ,text: _('stercseo.uri_remove_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/redirect/remove'
                ,id: this.menu.record.id
            }
            ,listeners: {
                'success': {fn:function(r) { this.refresh(); },scope:this}
            }
        });
    }

    ,filter: function (tf, nv, ov) {
        var store = this.getStore();
        var key = tf.getName();
        var value = tf.getValue();
        store.baseParams[key] = value;
        this.getBottomToolbar().changePage(1);
        this.refresh();
    }

    ,clearFilter: function (btn, e) {
        var baseParams = this.getStore().baseParams;
        delete baseParams.query;
        delete baseParams.context_key;
        this.getStore().baseParams = baseParams;
        Ext.getCmp(this.config.id + '-search-field').setValue('');
        Ext.getCmp(this.config.id + '-context-filter').setValue('');
        this.getBottomToolbar().changePage(1);
        this.refresh();
    }
    
});
Ext.reg('stercseo-grid-redirects',StercSEO.grid.Redirects);

StercSEO.window.Redirect = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        title: _('stercseo.uri_add')
        ,closeAction: 'close'
        ,width: 600
        ,url: StercSEO.config.connectorUrl
        ,action: 'mgr/redirect/create'
        ,fields: [{
            xtype: 'textfield'
            ,name: 'id'
            ,hidden: true
        },{
            xtype: 'textfield'
            ,fieldLabel: _('stercseo.uri')
            ,name: 'url'
            ,anchor: '100%'
            ,height: 'auto'
            ,allowBlank: false
        },{
            xtype: 'label'
            ,text: _('stercseo.uri_label')
            ,cls: 'desc-under'
        },{
            xtype: 'modx-combo'
            ,fieldLabel: _('stercseo.target')
            ,name: "resource"
            ,hiddenName: "resource"
            ,url: StercSEO.config.connectorUrl
            ,fields: ['id', 'pagetitle']
            ,displayField: 'pagetitle'
            ,baseParams: {
                action: 'mgr/resource/getlist'
                ,limit: 20
                ,sort: 'pagetitle'
                ,dir: 'asc'
            }
            ,emptyText: _('resource')
            ,anchor: '100%'
            ,allowBlank: false
            ,paging: true
            ,pageSize: 20
        }]
    });
    StercSEO.window.Redirect.superclass.constructor.call(this,config);
};
Ext.extend(StercSEO.window.Redirect,MODx.Window);
Ext.reg('stercseo-window-redirects',StercSEO.window.Redirect);