Ext.onReady(function() {
    MODx.load({ xtype: 'stercseo-page-migrate'});
});

StercSEO.page.Migrate = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        components: [{
            xtype: 'stercseo-panel-migrate'
            ,renderTo: 'stercseo-panel-migrate-div'
        }]
    });
    StercSEO.page.Migrate.superclass.constructor.call(this,config);
};
Ext.extend(StercSEO.page.Migrate,MODx.Component);
Ext.reg('stercseo-page-migrate',StercSEO.page.Migrate);