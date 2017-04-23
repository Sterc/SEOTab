Ext.onReady(function() {
    //Hide unwanted fields
    MODx.hideField("modx-panel-resource",["uri_override"]);
    MODx.hideField("modx-panel-resource", ["searchable"]);

    //Add new tab
    MODx.addTab("modx-resource-tabs",{
        title:"SEO"
        ,id:"seo-tab"
        ,bodyStyle: 'padding:0;'
        ,items: [{
            xtype: 'stercseo-vtabs-options'
            ,bodyStyle: 'min-height:300px;'
            ,headerCfg: {
                tag: 'div'
                ,cls: 'x-tab-panel-header vertical-tabs-header'
                ,html:'<h4 id="modx-resource-vtabs-header-title">'+_('stercseo.seo')+'</h4>'
            }
            ,items:[{
                title: _('stercseo.findability')
                ,items: [{
                    xtype: 'container'
                    ,layout: 'form'
                    ,labelAlign: 'top'
                    ,labelSeparator: ''
                    //,cls: 'form-with-labels'
                    ,labelWidth: 200
                    ,items: [{
                        xtype: 'modx-combo'
                        ,name: 'index'
                        ,hiddenName: 'index'
                        ,fieldLabel: _('stercseo.index')
                        ,store: new Ext.data.SimpleStore({
                            data: [
                                [1, _("stercseo.index_yes")],
                                [0, _("stercseo.index_no")], ],
                            id: 0,
                            fields: ["value", "text"]
                        })
                        ,valueField: "value"
                        ,displayField: "text"
                        ,mode: "local"
                        ,value: StercSEO.record.index
                        ,listeners: {change: function(){MODx.fireResourceFormChange();}}
                        ,width: 400
                    },{
                        xtype: 'label'
                        ,forId: 'pagetitle'
                        ,text: _('stercseo.index_desc')
                        ,cls: 'desc-under'
                    },{
                        xtype: 'modx-combo'
                        ,name: 'follow'
                        ,hiddenName: 'follow'
                        ,fieldLabel: _('stercseo.follow')
                        ,store: new Ext.data.SimpleStore({
                            data: [
                                [1, _("stercseo.follow_yes")],
                                [0, _("stercseo.follow_no")], ],
                            id: 0,
                            fields: ["value", "text"]
                        })
                        ,valueField: "value"
                        ,displayField: "text"
                        ,mode: "local"
                        ,value: StercSEO.record.follow
                        ,listeners: {change: function(){MODx.fireResourceFormChange();}}
                        ,width: 400
                    },{
                        xtype: 'label'
                        ,forId: 'pagetitle'
                        ,text: _('stercseo.follow_desc')
                        ,cls: 'desc-under'
                    },{
                        xtype: 'modx-combo'
                        ,name: 'stercseo_searchable'
                        ,id: 'stercseo_searchable'
                        ,hiddenName: 'stercseo_searchable'
                        ,fieldLabel: _('stercseo.searchable')
                        ,store: new Ext.data.SimpleStore({
                            data: [
                                [1, _("stercseo.searchable_yes")],
                                [0, _("stercseo.searchable_no")], ],
                            id: 0,
                            fields: ["value", "text"]
                        })
                        ,valueField: "value"
                        ,displayField: "text"
                        ,mode: "local"
                        ,value: StercSEO.record.searchable ? 1 : 0
                        ,listeners: {
                            change: function() {
                                if (Ext.getCmp('modx-resource-searchable')) {
                                    Ext.getCmp('modx-resource-searchable').setValue(this.value);
                                }
                                MODx.fireResourceFormChange();
                            }
                        }
                        ,width: 400
                    },{
                        xtype: 'label'
                        ,forId: 'pagetitle'
                        ,text: _('stercseo.searchable_desc')
                        ,cls: 'desc-under'
                    }]
                }]
            },{
                title: _('stercseo.sitemap')
                ,items: [{
                    xtype: 'container'
                    ,layout: 'form'
                    ,labelAlign: 'top'
                    ,labelSeparator: ''
                    ,labelWidth: 200
                    ,items: [{
                        xtype: 'modx-combo'
                        ,name: 'sitemap'
                        ,hiddenName: 'sitemap'
                        ,fieldLabel: _('stercseo.sitemap_include')
                        ,store: new Ext.data.SimpleStore({
                            data: [
                                [1, _("stercseo.sitemap_include_yes")],
                                [0, _("stercseo.sitemap_include_no")], ],
                            id: 0,
                            fields: ["value", "text"]
                        })
                        ,valueField: "value"
                        ,displayField: "text"
                        ,mode: "local"
                        ,value: StercSEO.record.sitemap ? StercSEO.record.sitemap : 0
                        ,listeners: {change: function(){MODx.fireResourceFormChange();}}
                        ,width: 400
                    },{
                        xtype: 'label'
                        ,forId: 'pagetitle'
                        ,cls: 'desc-under'
                    },{
                        xtype: 'modx-combo'
                        ,name: 'priority'
                        ,hiddenName: 'priority'
                        ,fieldLabel: _('stercseo.priority')
                        ,store: new Ext.data.SimpleStore({
                            data: [
                                [1, _("stercseo.priority_important")],
                                [0.5, _("stercseo.priority_normal")],
                                [0.25, _("stercseo.priority_nopriority")], ],
                            id: 0,
                            fields: ["value", "text"]
                        })
                        ,valueField: "value"
                        ,displayField: "text"
                        ,mode: "local"
                        ,value: StercSEO.record.priority ? StercSEO.record.priority : 0.5
                        ,listeners: {change: function(){MODx.fireResourceFormChange();}}
                        ,width: 400
                    },{
                        xtype: 'label'
                        ,forId: 'pagetitle'
                        ,text: _('stercseo.priority_desc')
                        ,cls: 'desc-under'
                    },{
                        xtype: 'modx-combo'
                        ,name: 'changefreq'
                        ,hiddenName: 'changefreq'
                        ,fieldLabel: _('stercseo.changefreq')
                        ,store: new Ext.data.SimpleStore({
                            data: [
                                ['daily', _("stercseo.changefreq_daily")],
                                ['weekly', _("stercseo.changefreq_weekly")],
                                ['monthly', _("stercseo.changefreq_monthly")], ],
                            id: 0,
                            fields: ["value", "text"]
                        })
                        ,valueField: "value"
                        ,displayField: "text"
                        ,mode: "local"
                        ,value: StercSEO.record.changefreq
                        ,listeners: {change: function(){MODx.fireResourceFormChange();}}
                        ,width: 400
                    },{
                        xtype: 'label'
                        ,forId: 'pagetitle'
                        ,text: _('stercseo.changefreq_desc')
                        ,cls: 'desc-under'
                    }]
                }]
            },{
                title: _('stercseo.redirects')
                ,id: '301-redirects'
                ,items: [{
                    xtype: 'container'
                    ,layout: 'form'
                    ,labelAlign: 'top'
                    ,labelSeparator: ''
                    ,items: [{
                        xtype: 'stercseo-grid-items'
                        ,bodyStyle: 'margin-bottom: 10px;'
                        ,bbar: false
                        ,store: StercSEO.record.test
                    },{
                        xtype: 'label'
                        ,forId: 'pagetitle'
                        ,text: _('stercseo.redirects_desc')
                        ,cls: 'desc-under'
                    },{
                        xtype: 'hidden',
                        name: 'urls',
                        id: 'sterceseo-urls',
                        value: 'false'
                    }]
                }]
            },{
                title: _('stercseo.freeze_uri')
                ,items: [{
                    xtype: 'container'
                    ,layout: 'form'
                    ,labelAlign: 'top'
                    ,labelSeparator: ''
                    ,labelWidth: 200
                    ,items: [{
                        xtype: 'xcheckbox'
                        ,boxLabel: _('stercseo.uri_override')
                        ,hideLabel: true
                        ,name: 'uri_override'
                        ,value: 1
                        ,checked: Ext.getCmp('modx-panel-resource').record.uri_override
                        ,listeners: {
                            check: function(){
                                if(this.getValue()){
                                    Ext.getCmp('stercseo-uri').show();
                                    Ext.getCmp('stercseo-uri-desc').show();
                                    Ext.getCmp('stercseo-uri').setValue(Ext.getCmp('modx-panel-resource').record.uri);
                                }else{
                                    Ext.getCmp('stercseo-uri').hide();
                                    Ext.getCmp('stercseo-uri-desc').hide();
                                    Ext.getCmp('stercseo-uri').setValue();
                                }
                                MODx.fireResourceFormChange();
                            }
                        }
                    },{
                        xtype: 'textfield'
                        ,fieldLabel: _('stercseo.uri_after',{ site_url: MODx.config.site_url })
                        ,name: 'uri'
                        ,id: 'stercseo-uri'
                        ,maxLength: 255
                        ,anchor: '50%'
                        ,hidden: false
                        ,listeners: {change: function(){MODx.fireResourceFormChange();}}
                    },{
                        xtype: 'label'
                        ,forId: 'pagetitle'
                        ,id: 'stercseo-uri-desc'
                        ,text: _('stercseo.uri_after_desc',{ site_url: MODx.config.site_url })
                        ,cls: 'desc-under'
                    },{
                        xtype: 'hidden'
                        ,name: 'olduri'
                        ,value: Ext.getCmp('modx-panel-resource').record.uri
                    }]
                }]
            }]
        }]
    });


    //Check uri
    if(Ext.getCmp('modx-panel-resource').record.uri_override){
        Ext.getCmp('stercseo-uri').show();
        Ext.getCmp('stercseo-uri').setValue(Ext.getCmp('modx-panel-resource').record.uri);
    }else{
        Ext.getCmp('stercseo-uri').hide();
    }

});
