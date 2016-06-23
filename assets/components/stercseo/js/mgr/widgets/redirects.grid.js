StercSEO.grid.Redirects = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'stercseo-grid-redirects'
        ,url: StercSEO.config.connectorUrl
        ,baseParams: {
            action: 'mgr/url/getlist'
        }
        ,save_action: 'mgr/url/updatefromgrid'
        ,autosave: true
        ,fields: ['id','resource','url']
        ,autoHeight: true
        ,paging: true
        ,remoteSort: true
        ,columns: [{
            header: _('id')
            ,dataIndex: 'id'
            ,width: 40
        },{
            header: _('stercseo.url')
            ,dataIndex: 'resource'
            ,width: 240
        },{
            header: _('url')
            ,dataIndex: 'url'
            ,width: 180
        }]
        ,tbar: [{
            text: _('stercseo.global.add')+' '+_('stercseo.url')
            ,handler: this.createRedirect
            ,scope: this
            ,cls:'primary-button'
            ,id: 'btn-add-file'
        }]
    });
    StercSEO.grid.Redirects.superclass.constructor.call(this,config);
};
Ext.extend(StercSEO.grid.Redirects,MODx.grid.Grid,{
    windows: {}

    ,getMenu: function() {
        var m = [];
        m.push({
            text: _('stercseo.global.update')+' '+_('stercseo.url')
            ,handler: this.updateRedirect
        });
        m.push('-');
        m.push({
            text: _('stercseo.global.remove')+' '+_('stercseo.url')
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
            ,title: _('stercseo.global.update')+' '+_('stercseo.url')
            ,action: 'mgr/url/update'
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
            title: _('stercseo.global.remove')+' '+_('stercseo.url')
            ,text: _('stercseo.global.remove_confirm')+' '+_('stercseo.url')
            ,url: this.config.url
            ,params: {
                action: 'mgr/url/remove'
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
        title: _('stercseo.global.add')+' '+_('stercseo.url')
        ,closeAction: 'close'
        ,width: 600
        ,url: StercSEO.config.connectorUrl
        ,action: 'mgr/url/create'
        ,fields: [{
            xtype: 'textfield'
            ,name: 'id'
            ,hidden: true
        },{
            xtype: 'label'
            ,text: _('stercseo.uri_add')
            ,cls: 'desc-under'
        },{
            xtype: 'textfield'
            ,fieldLabel: _('stercseo.uri_add')
            ,name: 'filename'
            ,anchor: '100%'
            ,height: 'auto'
        }]
    });
    StercSEO.window.Redirect.superclass.constructor.call(this,config);
};
Ext.extend(StercSEO.window.Redirect,MODx.Window);
Ext.reg('stercseo-window-redirects',StercSEO.window.Redirect);