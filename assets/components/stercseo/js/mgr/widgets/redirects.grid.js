StercSEO.grid.Redirects = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'stercseo-grid-redirects'
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

    ,search: function(tf,nv,ov) {
        var s = this.getStore();
        s.baseParams.query = tf.getValue();
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
        },{
            xtype: 'label'
            ,text: _('stercseo.uri_label')
            ,cls: 'desc-under'
        }]
    });
    StercSEO.window.Redirect.superclass.constructor.call(this,config);
};
Ext.extend(StercSEO.window.Redirect,MODx.Window);
Ext.reg('stercseo-window-redirects',StercSEO.window.Redirect);