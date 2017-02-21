Ext.onReady(function() {
    MODx.load({ xtype: 'stercseo-page-home'});
});

StercSEO.page.Home = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        components: [{
            xtype: 'stercseo-panel-home'
            ,renderTo: 'stercseo-panel-home-div'
        }]
    });
    StercSEO.page.Home.superclass.constructor.call(this,config);
};
Ext.extend(StercSEO.page.Home,MODx.Component);
Ext.reg('stercseo-page-home',StercSEO.page.Home);