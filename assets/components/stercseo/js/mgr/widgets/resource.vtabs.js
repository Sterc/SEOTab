StercSEO.panel.Options = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        cls: 'vertical-tabs-panel'
        ,anchor: '100%'
        ,monitorResize: true
        ,border: false
        ,defaults: {
            bodyCssClass: 'vertical-tabs-body'
            ,autoScroll: true
            ,autoHeight: true
            ,autoWidth: true
            ,border: false
        }
        ,listeners:{    //Dirty fix
            tabchange: function(tb, pnl){
                this.fixPanelWidth();
                if(pnl.id == '301-redirects'){
                    if(Ext.getCmp('stercseo-grid-items').loaded == 0){
                        Ext.getCmp('stercseo-grid-items').loaded = 1;
                        Ext.getCmp('stercseo-grid-items').refresh();
                    }
                }
            }
            ,resize: function(){
                var pnl = this.getActiveTab();
                if(pnl != null){ this.fixPanelWidth(); }
            }
            ,scope: this
        }
    });
    StercSEO.panel.Options.superclass.constructor.call(this,config);
};
Ext.extend(StercSEO.panel.Options,MODx.VerticalTabs,{
    fixPanelWidth: function(){
        var pnl = this;
        var w = this.bwrap.getWidth();
        pnl.body.setWidth(w);
        pnl.doLayout();
    }
});
Ext.reg('stercseo-vtabs-options',StercSEO.panel.Options);