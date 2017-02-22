StercSEO.panel.Migrate = function(config) {
    config = config || {};
    Ext.apply(config,{
        border: false
        ,baseCls: 'modx-formpanel'
        ,id: 'stercseo-migrate-panel'
        ,cls: 'container'
        ,items: [{
            html: '<h2>'+_('stercseo.seotab')+' - '+_('stercseo.migrate')+'</h2>'
            ,border: false
            ,cls: 'modx-page-header'
        },{
            xtype: 'modx-panel'
            ,defaults: { border: false ,autoHeight: true }
            ,border: true
            ,activeItem: 0
            ,hideMode: 'offsets'
            ,cls: 'x-tab-panel-bwrap main-wrapper'
            ,items: [{
                html: '<p>'+_('stercseo.migrate_desc')+'</p>'
                ,border: false
            }]
         },{
            xtype: 'modx-panel'
            ,defaults: { border: false ,autoHeight: true }
            ,border: true
            ,activeItem: 0
            ,hideMode: 'offsets'
            ,cls: 'x-tab-panel-bwrap main-wrapper'
            ,items: [{
                html: '<h2>'+_('stercseo.migrate_status')+'</h2>'
                ,border: false
            },{
                id: 'stercseo-migrate-panel-status'
                ,html: ''
                ,border: false
            }]
        }]
        ,listeners: {
            'render': {fn: this.migrateRedirects, scope:this }
        }
    });
    StercSEO.panel.Migrate.superclass.constructor.call(this,config);
};
Ext.extend(StercSEO.panel.Migrate,MODx.Panel,{
    migrateRedirects: function(){
        MODx.Ajax.request({
            url: StercSEO.config.connectorUrl
            ,params: {
                action: 'mgr/redirect/migrate'
            }
            ,listeners: {
                'success':{fn:function(r) {
                    if(r.total) {
                        var message;
                        if(r.total == 0) {
                            // No redirects found in resource properties, success!
                            message = '<p>'+_('stercseo.migrate_success_msg')+'</p>';
                            MODx.msg.alert(_('stercseo.migrate_success'), _('stercseo.migrate_success_msg'), function() {
                                location.href = MODx.config.manager_url + '?a=home&namespace=' + MODx.request.namespace;
                            });
                        } else {
                            // Processing redirects
                            message = '<p>'+_('stercseo.migrate_running')+'</p>';
                            Ext.getCmp('stercseo-migrate-panel').fireEvent('render');
                        }
                        Ext.getCmp('stercseo-migrate-panel-status').update(message);
                    }
                },scope:this}
                ,'failure':{fn:function(r) {
                    // MODx.msg.alert('error');
                }, scope:this}
            }
        });
    }
});
Ext.reg('stercseo-panel-migrate',StercSEO.panel.Migrate);
