Ext.onReady(function() {	
	MODx.addTab("modx-resource-tabs",{
		title:"SEO"
		,id:"seo-tab"
		,bodyStyle: 'padding:0;'
		,items: [{
			xtype: 'stercseo-vtabs-options'
			,headerCfg: {
				tag: 'div'
				,cls: 'x-tab-panel-header vertical-tabs-header'
				,html:'<h4 id="modx-resource-vtabs-header-title">'+_('stercseo.seo')+'</h4>'
			}
			,items:[{
				title: _('stercseo.redirects')
				,items: [{
					html: '<h4 class="stercseo-header-title">'+_('stercseo.seo')+' - '+_('stercseo.redirects')+'</h4><p>'+_('stercseo.redirects_desc')+'</p>'
					,border: false
					,bodyCssClass: 'stercseo-panel-desc'
				},{
                    xtype: 'container'
                    ,layout: 'form'
                    ,labelAlign: 'top'
                    ,labelSeparator: ''
                    ,items: [{
						xtype: 'stercseo-grid-items'
						,bodyStyle: 'margin-bottom: 15px;'
						,bbar: false
					},{
                        xtype: 'textfield'
                        ,anchor: '100%'
                        ,name: 'test'
                        ,fieldLabel: 'Standaard url overschrijven'
                        ,value: MODx.config.site_url+Ext.getCmp('modx-resource-uri').getValue()
                    }]
                }]
			},{
				title: _('stercseo.findability')
				,items: [{
                    html: '<h4 class="stercseo-header-title">'+_('stercseo.seo')+' - '+_('stercseo.findability')+'</h4><p>'+_('stercseo.findability_desc')+'</p>'
					,border: false
					,bodyCssClass: 'stercseo-panel-desc'
				},{
                    xtype: 'container'
                    ,layout: 'form'
                    ,labelAlign: 'top'
                    ,labelSeparator: ''
                    ,items: [{
                        xtype: 'label'
                        ,text: _('stercseo.searchengine')
                        ,cls: 'x-form-item-label'
                    },{
                        xtype: 'xcheckbox'
                        ,boxLabel: _('stercseo.dontindex')
                        ,description: '<b>'+_('stercseo.dontindex')+'</b><br />'+_('stercseo.dontindex_desc')
                        ,hideLabel: true
                        ,name: 'dontindex'
                        ,inputValue: 1
                        ,checked: true
                    },{
                        xtype: 'xcheckbox'
                        ,boxLabel: _('stercseo.dontfollow')
                        ,description: '<b>'+_('stercseo.dontfollow')+'</b><br />'+_('stercseo.dontfollow_desc')
                        ,hideLabel: true
                        ,name: 'dontfollow'
                        ,inputValue: 1
                        ,checked: true
                    },{
                        xtype: 'modx-combo'
                        ,fieldLabel: _('stercseo.priority')
                        ,description: '<b>'+_('stercseo.priority')+'</b><br />'+_('stercseo.priority_desc')
                        ,store: [_('stercseo.priority_normal'),_('stercseo.priority_important'),_('stercseo.priority_nopriority')]
                    },{
                        xtype: 'xcheckbox'
                        ,boxLabel: _('stercseo.searchable')
                        ,description: '<b>'+_('stercseo.searchable')+'</b><br />'+_('stercseo.searchable_desc')
                        ,hideLabel: true
                        ,name: 'searchable'
                        ,inputValue: 1
                        ,checked: true
                    },{
                        xtype: 'xcheckbox'
                        ,boxLabel: _('stercseo.sitemap')
                        ,description: '<b>'+_('stercseo.sitemap')+'</b><br />'+_('stercseo.sitemap_desc')
                        ,hideLabel: true
                        ,name: 'sitemap'
                        ,inputValue: 1
                        ,checked: true
                    }]
                }]
			},{
				title: _('content')
				,items: [{
					html: '<h4 class="stercseo-header-title">'+_('stercseo.seo')+' - '+_('stercseo.content')+'</h4><p>'+_('stercseo.content_desc')+'</p>'
					,border: false
					,bodyCssClass: 'stercseo-panel-desc'
				},{
                    xtype: 'container'
                    ,layout: 'form'
                    ,labelAlign: 'top'
                    ,labelSeparator: ''
                    ,items: [{
                        xtype: 'panel'
                        ,border: false
                        ,anchor: '100%'
                        ,name: 'test'
                        ,hidden: StercSEO.isHidden('modx-resource-pagetitle')
                        ,fieldLabel: _('pagetitle')
                        ,html: '<p>'+StercSEO.highlightWords(Ext.getCmp('modx-resource-pagetitle').getValue(), ['Lorem'])+'</p>'
                    },{
                        xtype: 'panel'
                        ,border: false
                        ,anchor: '100%'
                        ,name: 'test'
                        ,hidden: StercSEO.isHidden('modx-resource-longtitle')
                        ,fieldLabel: _('longtitle')
                        ,html: '<p>'+StercSEO.highlightWords(Ext.getCmp('modx-resource-longtitle').getValue(), ['Lorem'])+'</p>'
                    },{
                        xtype: 'panel'
                        ,border: false
                        ,anchor: '100%'
                        ,name: 'test'
                        ,hidden: StercSEO.isHidden('modx-resource-introtext')
                        ,fieldLabel: _('introtext')
                        ,html: '<p>'+StercSEO.highlightWords(Ext.getCmp('modx-resource-introtext').getValue(), ['Lorem'])+'</p>'
                    },{
                        xtype: 'panel'
                        ,border: false
                        ,anchor: '100%'
                        ,name: 'test'
                        ,hidden: StercSEO.isHidden('modx-resource-description')
                        ,fieldLabel: _('description')
                        ,html: '<p>'+StercSEO.highlightWords(Ext.getCmp('modx-resource-description').getValue(), ['Lorem'])+'</p>'
                    },{
                        xtype: 'panel'
                        ,border: false
                        ,anchor: '100%'
                        ,name: 'test'
                        ,hidden: StercSEO.isHidden('ta')
                        ,fieldLabel: _('content')
                        ,html: StercSEO.highlightWords(Ext.getCmp('ta').getValue(), ['Lorem'])
                    }]
                }]
			}]
		}]
	});
});
