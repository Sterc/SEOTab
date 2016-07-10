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
                ,limit: 100
            }
            ,listeners: {
                'success':{fn:function(r) {
                    // MODx.msg.alert('success');
                    // Render the panel again if count remaining from processor is > 0
                    // @todo
                    if(r.remaining && r.remaining > 0) {
                        Ext.getCmp('stercseo-migrate-panel').fireEvent('render');
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
