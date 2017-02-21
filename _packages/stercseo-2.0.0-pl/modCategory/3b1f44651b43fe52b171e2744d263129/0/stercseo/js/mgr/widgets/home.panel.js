StercSEO.panel.Home = function(config) {
    config = config || {};
    Ext.apply(config,{
        border: false
        ,baseCls: 'modx-formpanel'
        ,cls: 'container'
        ,items: [{
            html: '<h2>'+_('stercseo.seotab')+'</h2>'
            ,border: false
            ,cls: 'modx-page-header'
        },{
            xtype: 'modx-tabs'
            ,defaults: { border: false ,autoHeight: true }
            ,border: true
            ,activeTab: 0
            ,hideMode: 'offsets'
            ,items: [{
                title: _('stercseo.redirects')
                ,items: [{
                    html: '<p>'+_('stercseo.redirects.description')+'</p>'
                    ,border: false
                    ,bodyCssClass: 'panel-desc'
                },{
                    xtype: 'stercseo-grid-redirects'
                    ,preventRender: true
                    ,cls: 'main-wrapper'
                }]
            }]
        }]
    });
    StercSEO.panel.Home.superclass.constructor.call(this,config);
};
Ext.extend(StercSEO.panel.Home,MODx.Panel);
Ext.reg('stercseo-panel-home',StercSEO.panel.Home);
